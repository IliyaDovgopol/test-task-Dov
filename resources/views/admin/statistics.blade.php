<!-- resources/views/admin/statistics.blade.php -->

@extends('layouts.app')

@section('title', 'User Activity Statistics')

@section('content')
<div class="container">
    <h1>User Activity Statistics</h1>

    <!-- Filter form -->
    <form method="GET" action="{{ route('statistics') }}">
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}">
        </div>

        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
        </div>

        <div class="form-group">
            <label for="user_id">User</label>
            <select id="user_id" name="user_id" class="form-control">
                <option value="">All users</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="action">Action</label>
            <select id="action" name="action" class="form-control">
                <option value="">All actions</option>
                <option value="login" {{ request('action') == 'login' ? 'selected' : '' }}>Login</option>
                <option value="logout" {{ request('action') == 'logout' ? 'selected' : '' }}>Logout</option>
                <option value="registration" {{ request('action') == 'registration' ? 'selected' : '' }}>Registration</option>
                <option value="buy_cow" {{ request('action') == 'buy_cow' ? 'selected' : '' }}>Buy a Cow</option>
                <option value="download" {{ request('action') == 'download' ? 'selected' : '' }}>Download</option>
                <option value="page-a" {{ request('action') == 'page-a' ? 'selected' : '' }}>View Page A</option>
                <option value="page-b" {{ request('action') == 'page-b' ? 'selected' : '' }}>View Page B</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <!-- Results table -->
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Date</th>
                <th>User</th>
                <th>Action</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($activities as $activity)
                <tr>
                    <td>{{ $activity->created_at }}</td>
                    <td>{{ $activity->user->name }}</td>
                    <td>{{ $activity->action }}</td>
                    <td>{{ $activity->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
