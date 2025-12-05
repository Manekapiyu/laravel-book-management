@extends('layouts.app')

@section('content')

    <link href="{{ asset('css/register.css') }}" rel="stylesheet">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="container d-flex justify-content-center register-container">
                <div class="register-card text-center">

                    <img src="{{ asset('images/book-logo.png') }}" alt="Book Logo"
                        style="height:70px; width:auto; margin-bottom:10px;">

                    <h3 class="mb-4">LOGIN</h3>

                    @if (session('status'))
                        <div class="alert alert-success mb-3">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-3 text-start">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 text-start">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 text-start">
                            <label for="remember_me" class="form-check-label">
                                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                Remember Me
                            </label>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('register') }}">Create an account</a>

                            <button type="submit" class="btn btn-primary">
                                Login Now
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

@endsection