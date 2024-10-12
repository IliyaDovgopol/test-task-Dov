<!-- resources/views/page-b.blade.php -->

@extends('layouts.app')

@section('title', 'Page B - Download File')

@section('content')
<div class="container">
    <h1>Page B</h1>

    <!-- Direct link to download the file -->
    <a href="{{ asset('downloads/download.exe') }}" id="download-button" class="btn btn-primary" download>Download File</a>
</div>
@endsection
