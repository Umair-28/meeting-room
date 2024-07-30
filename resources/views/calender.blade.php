@extends('layout.app')

@section('header')
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top p-3">
    <a class="navbar-brand" href="{{ route('home') }}">MeetUp</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
            @if (session('admin'))
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
<div class="container-fluid p-3" style="margin-top: 70px;">
    <h4 class="text-center mb-4">Scheduled Meetings</h4>

    <!-- Display Success Message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        @foreach ($meetings as $meeting)
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card shadow-sm bg-primary">
                    <div class="card-body">
                        <strong>Meeting Title:</strong>
                        <h5 class="card-title" style="display: inline">{{ $meeting->title }}</h5>
                        <p class="card-text"><strong>Organizer:</strong> {{ $meeting->organizer }}</p>
                        <p class="card-text"><strong>Date:</strong> {{ $meeting->date_time->format('Y-m-d') }}</p>
                        <p class="card-text"><strong>Time:</strong> {{ $meeting->date_time->format('h:i A') }}</p>
                        <p class="card-text">
                            <strong>Participants:</strong>
                            {{ implode(', ', $meeting->participants) }}
                        </p>
                        @if (session('admin'))
                            <a href="/dashboard/schedule-meeting/{{ $meeting->id }}" class="btn btn-primary">Update</a>
                            <form action="{{ route('deleteMeeting', $meeting->id) }}" method="POST" onclick="return confirmDelete()" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this meeting?');
    }
</script>
@endsection
