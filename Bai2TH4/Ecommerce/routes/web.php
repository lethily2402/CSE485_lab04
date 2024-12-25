<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
})->name('index');
Route::resource('orders', OrderController::class);
Route::resource('customers', CustomerController::class);
Route::resource('products', ProductController::class);
Route::get('customers/history/{id}', [CustomerController::class, 'history'])->name('customers.history');
