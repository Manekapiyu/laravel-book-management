<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Books Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar mb-4 ">
        <div class="navbar-container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('books.index') }}">
    <img src="{{ asset('images/book-logo.png') }}" 
         alt="Book Logo" 
         style=" padding-left: 10px ;height: 40px; width: 50px;">
    Book Management System
</a>
        </div>
    </nav>

    <div class="container">

   
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Fix these errors:</strong>
                <ul class="mb-0">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
