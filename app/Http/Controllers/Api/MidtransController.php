<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\Item; // Pastikan model Item digunakan untuk mengurangi stok
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Notification;
use Midtrans\Config;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
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
                            $transaction->update(['status' => 'challenge']);
                        } else {
                            $transaction->update(['status' => 'success']);
                            $this->reduceStock($transaction); 
                        }
                    }
                    break;

                case 'settlement':
                    $transaction->update(['status' => 'success']);
                    $this->reduceStock($transaction); 
                    break;

                case 'pending':
                    $transaction->update(['status' => 'pending']);
                    break;

                case 'deny':
                    $transaction->update(['status' => 'failed']);
                    break;

                case 'expire':
                    $transaction->update(['status' => 'expired']);
                    break;

                case 'cancel':
                    $transaction->update(['status' => 'failed']);
                    break;

                default:
                    $transaction->update(['status' => 'unknown']);
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


    private function reduceStock($transaction)
    {
        $cartItems = Cart::where('user_id', $transaction->user_id)->get();

        foreach ($cartItems as $cartItem) {
            $item = $cartItem->item;   
            if ($item) {
                $item->stock -= $cartItem->quantity;
                if ($item->stock < 0) {
                    $item->stock = 0; 
                }
                $item->save();
            }
        }


        Cart::where('user_id', $transaction->user_id)->delete();
    }

    public function transactionHistory(Request $request)
    {
        try {
        
            $userId = $request->user()->id;

  
            $transactions = Transaction::where('user_id', $userId)
                ->orderBy('created_at', 'desc') // Urutkan berdasarkan waktu transaksi terbaru
                ->get();


            if ($transactions->isEmpty()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'No transactions found',
                    'data' => []
                ], 200);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Transaction history retrieved successfully',
                'data' => $transactions
            ], 200);
        } catch (\Exception $e) {
            Log::error("Transaction History Error", [
                'message' => $e->getMessage()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve transaction history'
            ], 500);
        }
    }
}