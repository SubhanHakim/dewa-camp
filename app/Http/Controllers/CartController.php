<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request)
    {
        // Periksa apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk menambahkan item ke cart.');
        }
    
        // Validasi input
        $request->validate([
            'item_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);
    
        // Ambil data produk dari database
        $product = Item::findOrFail($request->item_id);
    
        // Hitung subtotal
        $subtotal = $request->quantity * $product->price_per_day;
    
        // Simpan data ke tabel carts
        Cart::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'item_id' => $product->id,
            ],
            [
                'quantity' => $request->quantity,
                'price' => $product->price_per_day,
                'subtotal' => $subtotal,
            ]
        );
    
        return redirect()->back()->with('success', 'Item berhasil ditambahkan ke cart!');
    }

    public function index()
    {
        // Ambil data cart berdasarkan user yang login
        $cartItems = Cart::where('user_id', Auth::id())->get();

        // Kirim data ke view
        return view('dashboard', compact('cartItems'));
    }

    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'cart_id' => 'required|integer|exists:carts,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Cari cart berdasarkan ID
        $cart = Cart::findOrFail($request->cart_id);

        // Perbarui quantity dan subtotal
        $cart->quantity = $request->quantity;
        $cart->subtotal = $cart->price * $request->quantity;
        $cart->save();

        return response()->json(['success' => true, 'message' => 'Cart updated successfully']);
    }
}
