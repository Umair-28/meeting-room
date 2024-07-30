@extends('layout.app')

@section('header')
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="#">Meeting Room Booking</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/meetings">Meeting Calendar</a>
            </li>
            @if(session('admin'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">Manage Employess</a>
            </li>
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link">Logout</button>
                </form>
            </li>
        @endif

        </ul>
    </div>
</nav>
@endsection

@section('content')
<div class="container mt-5">
    <h1>Meeting Room Calendar</h1>
    <a href="{{ route('meetings.create') }}" class="btn btn-primary mb-3">Book Meeting Room</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Organizer</th>
                <th>Start Time</th>
                <th>End Time</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
@endsection

@section('footer')
<footer class="bg-light py-3">
    <div class="container">
        <span class="text-muted">© 2024 Meeting Room Booking System</span>
    </div>
</footer>
@endsection
