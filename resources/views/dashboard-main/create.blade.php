@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Header -->
    <div class="mb-4">
        <a href="{{ url()->previous() }}" class="text-decoration-none text-dark fw-bold">
            &larr; Dashboard
        </a>
    </div>

    <!-- Time Range -->
    <div class="d-flex align-items-center bg-light p-3 rounded w-auto mb-4">
        <div class="d-flex align-items-center bg-white p-2 rounded me-2">
            <i class="fas fa-calendar-alt text-secondary me-2"></i>
            <span>Time</span>
            <input type="text" class="border-0 bg-transparent ms-2" value="1-02-2020" readonly>
        </div>
        <span class="text-secondary mx-2">→</span>
        <div class="d-flex align-items-center bg-white p-2 rounded">
            <i class="fas fa-calendar-alt text-secondary me-2"></i>
            <span>Month</span>
            <input type="text" class="border-0 bg-transparent ms-2" value="28-02-2020" readonly>
        </div>
    </div>

    <!-- Table -->
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Owner</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a href="#" class="text-primary text-decoration-none">Dashboard1</a></td>
                        <td>Owner1</td>
                        <td>Feb 2, 2025</td>
                        <td>1 Day</td>
                        <td>
                            <button class="btn btn-sm text-secondary"><i class="fas fa-pen"></i></button>
                            <button class="btn btn-sm text-secondary"><i class="fas fa-trash"></i></button>
                            <button class="btn btn-sm text-secondary"><i class="fas fa-share"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="#" class="text-primary text-decoration-none">Dashboard2</a></td>
                        <td>Owner2</td>
                        <td>Feb 2, 2025</td>
                        <td>Just Now</td>
                        <td>
                            <button class="btn btn-sm text-secondary"><i class="fas fa-pen"></i></button>
                            <button class="btn btn-sm text-secondary"><i class="fas fa-trash"></i></button>
                            <button class="btn btn-sm text-secondary"><i class="fas fa-share"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Dashboard Button -->
    <div class="d-flex justify-content-end mt-4">
        <a href="{{ route('dashboard.create') }}" class="btn btn-primary">Add Dashboard</a>
    </div>
</div>
@endsection
