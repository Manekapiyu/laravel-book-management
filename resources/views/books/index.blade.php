@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2> All Books</h2>
    <a href="{{ route('books.create') }}" class="btn btn-primary">+ Add New Book</a>
</div>

<!-- Filter -->
<form method="GET" action="{{ route('books.index') }}" class="row g-2 mb-4">
    <div class="col-md-3">
        <select name="category" class="form-select" onchange="this.form.submit()">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </div>
</form>

<!-- Books Table -->
<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead class="table-header-blue ">

                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Category</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>Rs{{ number_format($book->price,2) }}</td>

                        <td>
                            @if($book->stock <= 0)
                                <span class="badge bg-danger">Out of stock</span>
                            @else
                                <span class="badge bg-success">{{ $book->stock }}</span>
                            @endif
                        </td>

                        <td>{{ $book->category?->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('books.destroy', $book) }}"
                                  method="POST" class="d-inline-block">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete this book?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center py-3">No books found</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $books->links() }}
</div>

<hr class="my-5">

<!-- ISSUE BOOK FORM -->
<h3>Issue a Book</h3>
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form method="POST" action="{{ route('borrow.issue') }}" class="row g-3">
            @csrf

            <div class="col-md-4">
                <label class="form-label">Select User</label>
                <select name="user_id" class="form-select">
                    @foreach(\App\Models\User::all() as $u)
                        <option value="{{ $u->id }}">{{ $u->name }} (ID: {{ $u->id }})</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Select Book</label>
                <select name="book_id" class="form-select">
                    @foreach(\App\Models\Book::all() as $b)
                        <option value="{{ $b->id }}">{{ $b->title }} (Stock: {{ $b->stock }})</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 d-grid">
                <label class="form-label">&nbsp;</label>
                <button class="btn btn-outline-primary">Issue Book</button>
            </div>
        </form>
    </div>
</div>

<!-- RETURN FORM -->
<h3> Return a Book</h3>
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form method="POST" action="{{ route('borrow.return') }}" class="row g-3">
            @csrf

            <div class="col-md-8">
                <label class="form-label">Borrowing Record</label>
                <select name="borrowing_id" class="form-select">
                    @foreach(\App\Models\Borrowing::where('status','issued')->with('user','book')->get() as $br)
                        <option value="{{ $br->id }}">
                            {{ $br->id }} - {{ $br->book->title }} 
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 d-grid">
                <label class="form-label">&nbsp;</label>
                <button class="btn btn-outline-success ">Return Book</button>
            </div>
        </form>
    </div>
</div>
@endsection
