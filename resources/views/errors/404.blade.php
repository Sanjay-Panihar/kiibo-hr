@extends('layouts.app')
@section('title', 'Page Not Found')
@section('content')
<div class="d-flex flex-column align-items-center justify-content-center vh-100">
    <h1 class="display-1 fw-bold">404</h1>
    <h5 class="card-title fw-semibold mb-4">Page Not Found</h5>
    <p class="mb-4">Sorry, the page you are looking for could not be found.</p>
    <a href="{{ url('/') }}" class="btn btn-primary">Go Home</a>
</div>
@endsection
