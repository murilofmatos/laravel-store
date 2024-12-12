<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('product.show');

Route::get('/admin/products', [AdminController::class, 'index'])->name('admin.products');
Route::post('/admin/products', [AdminController::class, 'store'])->name('admin.products.store');

Route::get('/admin/products/{product:slug}/edit', [AdminController::class, 'edit'])->name('admin.products.edit');
Route::get('/admin/products/create', [AdminController::class, 'create'])->name('admin.products.create');

Route::put('/admin/products/{product}', [AdminController::class, 'update'])->name('admin.products.update');
Route::get('/admin/products/{product}/delete', [AdminController::class, 'destroy'])->name('admin.products.destroy');

