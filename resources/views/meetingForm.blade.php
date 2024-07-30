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
                <a class="nav-link" href="">Schedule a Meeting</a>
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
<div class="container-fluid form-section p-3 mt-3 d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="container main-section border p-4 rounded shadow" style="width:100%; max-width: 600px; background-color: rgba(255, 255, 255, 0.8);">
        <h4 class="text-center">Meeting Room Booking Form</h4>

        <!-- Display Success Message -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            {{ session('success') }}
        </div>
        @endif

        <!-- Display Validation Errors -->
        @if($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('scheduleMeeting') }}" class="needs-validation" novalidate>
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="meetingTitle" class="form-label">Meeting Title</label>
                    <input type="text" name="title" value="{{old('title')}}" class="form-control" id="meetingTitle" required>
                    <div class="invalid-feedback">
                        Please enter a meeting title.
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="organizer" class="form-label">Organizer</label>
                    <input type="text" class="form-control" value="{{old('organizer')}}" name="organizer" id="organizer" required>
                    <div class="invalid-feedback">
                        Please enter the organizer's name.
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="meetingDate" class="form-label">Date</label>
                    <input type="date" class="form-control" name="date" value="{{old('date')}}" id="meetingDate" required>
                    <div class="invalid-feedback">
                        Please select a date.
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="meetingTime" class="form-label">Time</label>
                    <input type="time" class="form-control" name="time" id="meetingTime" required>
                    <div class="invalid-feedback">
                        Please select a time.
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-3">
                    <label for="participants" class="form-label">Select Participants</label>
                    <select class="form-control select2" name="participants[]" id="participants" multiple="multiple" required>
                        @foreach($users as $user)
                        <option value="{{ $user->name }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Please select participants.
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#participants').select2({
            placeholder: 'Select participants',
            closeOnSelect: false,
            templateResult: function (data) {
                if (!data.id) { return data.text; }
                var $result = $('<span><input type="checkbox" style="margin-right: 10px;">' + data.text + '</span>');
                return $result;
            },
            templateSelection: function (data) {
                return data.text;
            }
        });
    });
</script>

<script>
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
@endsection
