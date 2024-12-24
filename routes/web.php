<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ReaderController;
use App\Http\Controllers\BorrowController;
use App\Models\Book;
use Illuminate\Support\Facades\Route;

// Index: Hàm trả về giao diện quản lý
// Create: Hàm trả về giao diện tạo element
// Store: Hàm lưu dữ liệu mà người dùng tạo tại giao diện.
// Edit: Hàm trả về giao diện chỉnh sửa element
// Update: Hàm cập nhật dữ liệu mà người dùng chỉnh sửa tại giao diện
Route::resource('books', BookController::class);
Route::resource('readers', ReaderController::class);
Route::resource('borrows', BorrowController::class);
