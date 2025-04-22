<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;
use Midtrans\Transaction as MidtransTransaction;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    
        // Ambil cart user yang sedang login
        $cartItems = Cart::where('user_id', Auth::id())->get();
    
        // Cek kalau cart kosong
        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Cart kamu masih kosong.');
        }
    
        // Hitung total harga
        $total = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });
    
        // Generate order_id unik
        $orderId = 'ORDER-' . strtoupper(uniqid());
    
        // Simpan data transaksi ke database
        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'order_id' => $orderId,
            'total' => $total,
            'payment_status' => 'pending', // gunakan payment_status agar konsisten dengan callback
        ]);
    
        // Persiapkan item untuk dikirim ke Midtrans
        $items = $cartItems->map(function ($item) {
            return [
                'id' => $item->id,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'name' => $item->item->name ?? 'Item', // fallback kalau name null
            ];
        })->toArray();
    
        // Data customer
        $user = Auth::user();
        $customerDetails = [
            'first_name' => $user->name,
            'email' => $user->email,
        ];
    
        // Parameter Snap Midtrans
        $snapParams = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $total,
            ],
            'item_details' => $items,
            'customer_details' => $customerDetails,
        ];
    
        // Generate Snap Token dari Midtrans
        try {
            $snapToken = Snap::getSnapToken($snapParams);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal membuat Snap Token: ' . $e->getMessage());
        }
    
        return view('checkout', compact('snapToken', 'transaction'));
    }
    

    public function webhook(Request $request)
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        try {
            $notification = new Notification();

            $transactionStatus = $notification->transaction_status;
            $paymentType       = $notification->payment_type;
            $orderId           = $notification->order_id;
            $fraudStatus       = $notification->fraud_status ?? null;

            // Logging data callback (opsional tapi sangat membantu saat debug)
            Log::info("Midtrans callback received", [
                'order_id' => $orderId,
                'transaction_status' => $transactionStatus,
                'payment_type' => $paymentType,
                'fraud_status' => $fraudStatus,
            ]);

            $transaction = Transaction::where('order_id', $orderId)->first();

            if (!$transaction) {
                Log::warning("Transaction not found for order_id: " . $orderId);
                return response()->json(['message' => 'Transaction not found'], 404);
            }

            switch ($transactionStatus) {
                case 'capture':
                    if ($paymentType == 'credit_card') {
                        if ($fraudStatus == 'challenge') {
                            $transaction->update(['payment_status' => 'challenge']);
                        } else {
                            $transaction->update(['payment_status' => 'success']);
                        }
                    }
                    break;

                case 'settlement':
                    $transaction->update(['payment_status' => 'success']);
                    break;

                case 'pending':
                    $transaction->update(['payment_status' => 'pending']);
                    break;

                case 'deny':
                    $transaction->update(['payment_status' => 'failed']);
                    break;

                case 'expire':
                    $transaction->update(['payment_status' => 'expired']);
                    break;

                case 'cancel':
                    $transaction->update(['payment_status' => 'failed']);
                    break;

                default:
                    $transaction->update(['payment_status' => 'unknown']);
                    break;
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Transaction updated successfully'
            ], 200);
        } catch (\Exception $e) {
            Log::error("Midtrans Callback Error", [
                'message' => $e->getMessage()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Callback error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function checkTransactionStatus($orderId)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');

        $status = MidtransTransaction::status($orderId);

        return response()->json($status);
    }

    public function index()
{
    $transactions = Transaction::where('user_id', Auth::id())
        ->where('status', 'success')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('transactions.history', compact('transactions'));
}
}
