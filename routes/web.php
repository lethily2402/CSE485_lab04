<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
});

Route::resource('orders', OrderController::class);
Route::resource('customers', CustomerController::class);
Route::get('customers/history/{id}', [CustomerController::class, 'history'])->name('customers.history');