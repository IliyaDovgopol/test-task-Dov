<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <!-- Condition to display the top navigation bar only if not on the login or register page -->
    @if (!request()->is('login') && !request()->is('register'))
        <!-- Top navigation bar -->
        <nav class="navbar">
            <div class="container">
                <a href="{{ url('/home') }}" class="navbar-brand">Home</a>

                <!-- User panel -->
                <div class="navbar-user">
                    @if(auth()->check())
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-link">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn">Login</a>
                        <a href="{{ route('register') }}" class="btn">Register</a>
                    @endif
                </div>
            </div>
        </nav>
    @endif

    <div class="container">
        @yield('content')
    </div>

</body>
</html>
