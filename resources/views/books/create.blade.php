@extends('layouts.app')

@section('content')
<h2>Add Book</h2>

<form method="POST" action="{{ route('books.store') }}">
    @csrf

    <label>Title</label>
    <input type="text" name="title" value="{{ old('title') }}" required>

    <label>Author</label>
    <input type="text" name="author" value="{{ old('author') }}" required>

    <label>Price</label>
    <input type="text" name="price" value="{{ old('price') }}" required>

    <label>Stock</label>
    <input type="number" name="stock" min="0" value="{{ old('stock',0) }}" required>

    <label>Category</label>
    <select name="book_category_id" required>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ old('book_category_id') == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>

    <button type="submit">Create</button>
</form>
@endsection
