<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

// Public
Route::get('/', [ProductController::class, 'index']);
Route::get('/cart', [CartController::class, 'view']);
Route::post('/cart/add/{id}', [CartController::class, 'add']);
Route::post('/cart/send', [CartController::class, 'sendQuery']);

// Admin (authenticated)
Route::middleware('auth')->group(function () {
    Route::get('/admin', [ProductController::class, 'admin']);
    Route::get('/admin/create', [ProductController::class, 'create']);
    Route::post('/admin/store', [ProductController::class, 'store']);
    Route::get('/admin/edit/{id}', [ProductController::class, 'edit']);
    Route::post('/admin/update/{id}', [ProductController::class, 'update']);
    Route::delete('/admin/delete/{id}', [ProductController::class, 'destroy']);
});
