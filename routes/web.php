<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function() {
    if (Auth::check()) {
        // User is logged in → show books
        return app(BookController::class)->index(request());
    } else {
        // User not logged in → show registration page
        return redirect()->route('register');
    }
})->name('home');

// Books and Borrowing routes 
Route::middleware(['auth','admin'])->group(function () {
    Route::resource('books', BookController::class)->except(['show']);

    Route::post('/borrow/issue', [BorrowingController::class, 'issue'])->name('borrow.issue');
    Route::post('/borrow/return', [BorrowingController::class, 'returnBook'])->name('borrow.return');
});




// Auth routes 
require __DIR__.'/auth.php';
