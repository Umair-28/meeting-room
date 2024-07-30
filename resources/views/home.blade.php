@extends('layout.app')

@section('header')
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top p-3">
    <a class="navbar-brand" href="{{ route('home') }}">MeetUp</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('schedule') }}">Schedule a Meeting</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('showCalender') }}">Meeting Calendar</a>
            </li>
            @if(session('admin'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">Manage Employees</a>
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
<div class="jumbotron jumbotron-fluid mt-2 p-3 d-flex flex-column justify-content-between">
    <div class="container main-section">
        <div class="row">
            <div class="col-lg-5 col-md-12 text-content" style="margin-top:50px;">
                <h4 class="display-5">MeetUp</h4>
                <p class="lead">Easily book the meeting room for your meetings. Click on "Meeting Calendar" to view and "Schedule a Meeting" to book a slot.</p>
                <a class="button-6" role="button" href="{{ route('schedule') }}">Schedule a Meeting</a>
            </div>
            <div class="col-lg-6 col-md-12 images-container">
                <img src="{{ asset('images/2.jpg') }}" alt="Image 2" class="overlay-image-3 img-fluid d-block mx-auto mt-3">
                <img src="{{ asset('images/3.jpg') }}" alt="Image 3" class="overlay-image-2 img-fluid d-block mx-auto mt-3">
                <img src="{{ asset('images/4.jpg') }}" alt="Image 4" class="overlay-image-1 img-fluid d-block mx-auto mt-3">
            </div>
        </div>
    </div>
</div>
@endsection


