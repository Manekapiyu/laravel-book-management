@extends('layouts.app')

@section('content')
<h2 class="mb-4"> Edit Book</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('books.update', $book) }}" method="POST" class="row g-3">
            @csrf
            @method('PUT')

            <div class="col-md-6">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control"
                       required value="{{ old('title', $book->title) }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">Author</label>
                <input type="text" name="author" class="form-control"
                       required value="{{ old('author', $book->author) }}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Price</label>
                <input type="number" name="price" class="form-control"
                       step="0.01" required value="{{ old('price', $book->price) }}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control"
                       required min="0" value="{{ old('stock', $book->stock) }}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Category</label>
                <select name="book_category_id" class="form-select" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}"
                            {{ $book->book_category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12">
                <button class="btn btn-warning">Update Book</button>
                <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>
            </div>

        </form>
    </div>
</div>
@endsection
