<!-- resources/views/page-a.blade.php -->

@extends('layouts.app')

@section('title', 'Page A - Buy a Cow')

@section('content')
<div class="container">
    <h1>Page A</h1>

    <!-- Button to buy a cow -->
    <form id="buy-cow-form">
        @csrf
        <button type="submit" id="buy-button">Buy a Cow</button>
    </form>

    <!-- Thank you message, initially hidden -->
    <div id="thank-you-message" style="display:none;">
        <p>Thank you for buying the cow!</p>
    </div>

    <!-- Error message, initially hidden -->
    <div id="error-message" style="display:none; color: red;">
        <p>An error occurred while buying the cow. Please try again.</p>
    </div>
</div>

<!-- JavaScript to send form via AJAX -->
<script>
    document.getElementById('buy-cow-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent page reload

        // Get the CSRF token from the hidden input
        const csrfToken = document.querySelector('input[name="_token"]').value;

        // Send data to the server via fetch
        fetch("{{ route('buyCow') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({})
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network error');
            }
            return response.json();
        })
        .then(data => {
            // Successfully handled request
            document.getElementById('buy-button').style.display = 'none'; // Hide the button
            document.getElementById('thank-you-message').style.display = 'block'; // Show the thank you message
        })
        .catch(error => {
            // Handle errors
            console.error('Error:', error);
            document.getElementById('error-message').style.display = 'block'; // Show the error message
        });
    });
</script>
@endsection
