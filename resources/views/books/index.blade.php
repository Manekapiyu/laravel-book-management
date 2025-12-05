@extends('layouts.app')

@section('content')
    <div style="margin-bottom:20px;">
        <a href="{{ route('books.create') }}">Add New Book</a>
    </div>

    <form method="GET" action="{{ route('books.index') }}">
        <label>Filter by category:</label>
        <select name="category" onchange="this.form.submit()">
            <option value="">All</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </form>

    <table style="margin-top:10px;">
        <thead>
            <tr>
                <th>Title</th><th>Author</th><th>Price</th><th>Stock</th>
                <th>Category</th><th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ number_format($book->price, 2) }}</td>
                <td>
                    {{ $book->stock }}
                    @if($book->stock <= 0)
                        <div style="color:red">Out of stock</div>
                    @endif
                </td>
                <td>{{ $book->category?->name }}</td>
                <td>
                    <a href="{{ route('books.edit', $book) }}">Edit</a>
                    <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
                <tr><td colspan="6">No books found</td></tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top:10px;">
        {{ $books->links() }}
    </div>

    <hr>

    <h3>Issue a Book</h3>
    <form method="POST" action="{{ route('borrow.issue') }}">
        @csrf

        <label>User:</label>
        <select name="user_id" required>
            @foreach(\App\Models\User::limit(50)->get() as $u)
                <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
            @endforeach
        </select>

        <label>Book:</label>
        <select name="book_id" required>
            @foreach(\App\Models\Book::all() as $b)
                <option value="{{ $b->id }}">{{ $b->title }} (Stock: {{ $b->stock }})</option>
            @endforeach
        </select>

        <button type="submit">Issue</button>
    </form>

    <h3>Return a Book</h3>
    <form method="POST" action="{{ route('borrow.return') }}">
        @csrf
        <label>Borrowing Record:</label>
        <select name="borrowing_id" required>
            @foreach(\App\Models\Borrowing::where('status','issued')->with('user','book')->get() as $br)
                <option value="{{ $br->id }}">
                    #{{ $br->id }} - {{ $br->book->title }} by {{ $br->user->name }} (issued: {{ $br->issued_at }})
                </option>
            @endforeach
        </select>

        <button type="submit">Return</button>
    </form>
@endsection
