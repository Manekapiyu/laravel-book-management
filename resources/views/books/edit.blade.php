@extends('layouts.app')

@section('content')
<h2>Edit Book</h2>

<form method="POST" action="{{ route('books.update', $book) }}">
    @csrf
    @method('PUT')

    <label>Title</label>
    <input type="text" name="title" value="{{ old('title', $book->title) }}" required>

    <label>Author</label>
    <input type="text" name="author" value="{{ old('author', $book->author) }}" required>

    <label>Price</label>
    <input type="text" name="price" value="{{ old('price', $book->price) }}" required>

    <label>Stock</label>
    <input type="number" name="stock" min="0" value="{{ old('stock', $book->stock) }}" required>

    <label>Category</label>
    <select name="book_category_id" required>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ old('book_category_id', $book->book_category_id) == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>

    <button type="submit">Update</button>
</form>
@endsection
