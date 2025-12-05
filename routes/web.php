<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;

Route::get('/', [BookController::class, 'index'])->name('books.index');

Route::resource('books', BookController::class)->except(['show']);

// Borrowing endpoints (form submissions)
Route::post('/borrow/issue', [BorrowingController::class, 'issue'])->name('borrow.issue');
Route::post('/borrow/return', [BorrowingController::class, 'returnBook'])->name('borrow.return');
