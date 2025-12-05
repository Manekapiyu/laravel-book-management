<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Books CRUD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1><a href="{{ route('books.index') }}">Books Management</a></h1>

        @if(session('success'))
            <div style="color:green; margin-bottom:10px;">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div style="color:red; margin-bottom:10px;">
                <ul>
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>
