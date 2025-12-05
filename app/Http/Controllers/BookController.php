<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookCate;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Optionally add auth middleware if you want:
    // public function __construct() { $this->middleware('auth'); }

    public function index(Request $request)
    {
        $categories = BookCate::all();
        $query = Book::with('category');

        if ($request->filled('category')) {
            $query->where('book_category_id', $request->category);
        }

        $books = $query->paginate(10);

        return view('books.index', compact('books','categories'));
    }

    public function create()
    {
        $categories = BookCate::all();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'book_category_id' => 'required|exists:book_cate,id',
        ]);

        Book::create($validated);

        return redirect()->route('books.index')->with('success','Book created.');
    }

    public function edit(Book $book)
    {
        $categories = BookCate::all();
        return view('books.edit', compact('book','categories'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'book_category_id' => 'required|exists:book_cate,id',
        ]);

        $book->update($validated);

        return redirect()->route('books.index')->with('success','Book updated.');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success','Book deleted.');
    }
}
