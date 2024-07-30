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
<div class="container-fluid" style="margin-top: 100px;">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Employees</h2>
        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">Add Employee</a>
    </div>

    <table class="table table-striped table-responsive">
        <thead>
            <tr>
                <th>Name</th>
                <th>Department</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->department }}</td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editEmployeeModal"
                        data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-department="{{ $user->department }}">Edit</button>
                    <form action="{{ route('deleteEmployee', $user->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEmployeeModalLabel">Add Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addEmployeeForm" method="POST" action="{{ route('addEmployee') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="employeeName" class="form-label">Employee Name</label>
                        <input type="text" class="form-control" id="employeeName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="employeeDepartment" class="form-label">Department</label>
                        <input type="text" class="form-control" id="employeeDepartment" name="department" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEmployeeModalLabel">Edit Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editEmployeeForm" method="POST" action="{{ route('updateEmployee') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="employeeId" name="id">
                    <div class="mb-3">
                        <label for="editEmployeeName" class="form-label">Employee Name</label>
                        <input type="text" class="form-control" id="editEmployeeName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEmployeeDepartment" class="form-label">Department</label>
                        <input type="text" class="form-control" id="editEmployeeDepartment" name="department" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const editEmployeeModal = document.getElementById('editEmployeeModal');
        editEmployeeModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var name = button.getAttribute('data-name');
            var department = button.getAttribute('data-department');

            var modalTitle = editEmployeeModal.querySelector('.modal-title');
            var modalBodyInputId = editEmployeeModal.querySelector('#employeeId');
            var modalBodyInputName = editEmployeeModal.querySelector('#editEmployeeName');
            var modalBodyInputDepartment = editEmployeeModal.querySelector('#editEmployeeDepartment');

            modalTitle.textContent = 'Edit Employee';
            modalBodyInputId.value = id;
            modalBodyInputName.value = name;
            modalBodyInputDepartment.value = department;
        });
    });
</script>

