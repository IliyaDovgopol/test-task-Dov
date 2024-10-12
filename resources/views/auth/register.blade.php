<!-- resources/views/auth/register.blade.php -->

@extends('layouts.app')

@section('title', 'Register')

@section('content')

<div class="login-container">
    <h1>Register</h1>

    <form action="{{ route('register') }}" method="post" class="login-form">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>
        <button type="submit">Register</button>
    </form>

    <!-- Link to login page -->
    <p class="register-prompt">
        Already have an account? <a href="{{ route('login') }}">Login</a>
    </p>
</div>

@endsection
