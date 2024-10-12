<!-- resources/views/home.blade.php -->

@extends('layouts.app')

@section('title', 'User Dashboard')

@section('content')
<div class="dashboard-container">
    <h1 class="dashboard-title">User Dashboard</h1>
    <p class="dashboard-welcome">Welcome, {{ auth()->user()->name }}!</p>

	<div class="user-details">
        <p>Name: <strong>{{ auth()->user()->name }}</strong></p>
        <p>Email: <strong>{{ auth()->user()->email }}</strong></p>
    </div>

    <!-- Available actions -->
    <h2 class="section-title">Available actions</h2>
    <ul class="dashboard-actions">
        <li><a href="{{ route('pageA') }}">Page A</a></li>
        <li><a href="{{ route('pageB') }}">Page B</a></li>

    <!-- Administrative actions -->
    @if(auth()->user()->role === 'admin')
            <li><a href="{{ route('statistics') }}">Statistics</a></li>
            <li><a href="{{ route('reports') }}">Reports</a></li>
        </ul>
    @endif
</div>
@endsection
