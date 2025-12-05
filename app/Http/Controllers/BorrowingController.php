<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrowing;
use App\Models\Book;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BorrowingController extends Controller
{
    // Issue a book
    public function issue(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
        ]);

        DB::transaction(function () use ($validated) {
            $book = Book::lockForUpdate()->find($validated['book_id']);

            if (!$book) {
                abort(404, 'Book not found');
            }

            if ($book->stock <= 0) {
                abort(400, 'Book is out of stock');
            }

            // decrement stock
            $book->decrement('stock', 1);

            Borrowing::create([
                'user_id' => $validated['user_id'],
                'book_id' => $validated['book_id'],
                'issued_at' => Carbon::now(),
                'status' => 'issued',
            ]);
        });

        return back()->with('success', 'Book issued successfully.');
    }

    // Return a book 
    public function returnBook(Request $request)
    {
        $validated = $request->validate([
            'borrowing_id' => 'required|exists:borrowings,id',
        ]);

        DB::transaction(function () use ($validated) {
            $borrow = Borrowing::lockForUpdate()->find($validated['borrowing_id']);

            if (!$borrow) abort(404, 'Borrowing not found');
            if ($borrow->status === 'returned') abort(400, 'Already returned');

            $book = Book::lockForUpdate()->find($borrow->book_id);
            $book->increment('stock', 1);

            $borrow->update([
                'returned_at' => Carbon::now(),
                'status' => 'returned',
            ]);
        });

        return back()->with('success', 'Book returned successfully.');
    }
}
