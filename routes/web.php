<?php

use App\Http\Controllers\Api\MidtransController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ItemController;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::get('/', [ItemController::class, 'index'])->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.post');

Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register.post');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/dashboard', [CartController::class, 'index'])->middleware('auth')->name('dashboard');

Route::get('/cara-sewa', function () {
    return view('sewa');
})->name('cara-sewa');

Route::get('/syarat-ketentuan', function () {
    return view('syarat');
})->name('syarat-ketentuan');

Route::get('/pembayaran', function () {
    return view('pembayaran');
})->name('pembayaran');

Route::get('/pengiriman', function () {
    return view('pengiriman');
})->name('pengiriman');

Route::get('/product/{id}', [ItemController::class, 'show'])->name('product.detail');

Route::post('/cart/add', [CartController::class, 'add'])->middleware('auth')->name('cart.add');

Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');


Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::get('/checkout', [CheckoutController::class, 'process'])->middleware('auth')->name('checkout.process');



Route::post('/midtrans/webhook', [CheckoutController::class, 'webhook'])->name('midtrans.webhook');

Route::get('/midtrans/check-status/{orderId}', [CheckoutController::class, 'checkTransactionStatus']);

Route::get('/transaction-history', [CheckoutController::class, 'index'])->name('transactions.history');