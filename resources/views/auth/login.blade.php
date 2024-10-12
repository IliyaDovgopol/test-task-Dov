<!-- resources/views/auth/login.blade.php -->

@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div class="login-container">
    <h1>Login</h1>

    <form action="{{ route('login') }}" method="post" class="login-form">
        @csrf
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>

    <!-- Link to registration -->
    <p class="register-prompt">
        Don't have an account? <a href="{{ route('register') }}">Register</a>
    </p>
</div>

@endsection
