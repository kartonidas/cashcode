<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('products');
});

Auth::routes();

Route::get('/products', [App\Http\Controllers\ProductController::class, 'list'])->name('products');
Route::get('/product/new', [App\Http\Controllers\ProductController::class, 'create'])->name('product.create');
Route::get('/product/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit');
