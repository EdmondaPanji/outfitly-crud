<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

// Halaman Produk
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index'); // Daftar semua produk
    Route::get('/{id}', [ProductController::class, 'show'])->name('products.show'); // Detail produk
});

// Halaman Keranjang
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index'); // Halaman keranjang
    Route::post('/add/{id}', [CartController::class, 'add'])->name('cart.add'); // Tambahkan item ke keranjang
    Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove'); // Hapus item dari keranjang
    Route::delete('/clear', [CartController::class, 'clear'])->name('cart.clear'); // Kosongkan keranjang
    Route::patch('/update/{id}', [CartController::class, 'update'])->name('cart.update'); // Perbarui jumlah item di keranjang
});

// Halaman Checkout
Route::prefix('checkout')->group(function () {
    Route::get('/', [CartController::class, 'checkout'])->name('cart.checkout'); // Halaman checkout
    Route::post('/complete', [CartController::class, 'completeCheckout'])->name('cart.completeCheckout'); // Proses checkout
});

// Redirect from the root URL to the products index page
Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::patch('/cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');
