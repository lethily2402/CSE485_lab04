<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
Route::get('/', function () {
    return view('welcome');
});

Route::resource('orders', OrderController::class);
