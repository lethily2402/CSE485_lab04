<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
})->name('index');
Route::resource('customers', CustomerController::class);
Route::resource('products', ProductController::class);
