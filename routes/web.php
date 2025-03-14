<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

// Halaman utama - langsung ke katalog produk
Route::get('/', [ProductController::class, 'index']);

// CRUD Produk
Route::resource('products', ProductController::class);

// Keranjang
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Duplikat route products.index (sebenernya udah di resource)
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');