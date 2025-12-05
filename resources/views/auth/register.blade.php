@extends('layouts.app')

<head>
    <meta charset="utf-8">
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">


@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="container d-flex justify-content-center register-container">
            <div class="register-card text-center">

                <img src="{{ asset('images/book-logo.png') }}" 
                     alt="Book Logo" 
                     style="height:70px; width:auto; margin-bottom:10px;">

                <h3 class="mb-4">REGISTER</h3>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3 text-start">
                        <label for="name" class="form-label">Name</label>
                        <input id="name" 
                               type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               name="name" 
                               value="{{ old('name') }}" 
                               required autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 text-start">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" 
                               type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email" 
                               value="{{ old('email') }}" 
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 text-start">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" 
                               type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password" 
                               required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 text-start">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input id="password_confirmation" 
                               type="password"
                               class="form-control @error('password_confirmation') is-invalid @enderror"
                               name="password_confirmation" 
                               required>
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

       
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('login') }}">Already registered?</a>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection

