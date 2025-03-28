@extends('layouts.app')

@section('title', 'User')

@section('content_header')
    <div class="row align-items-center mb-3">
        <div class="col-lg-8">
            <h2 class="fw-bold">
                {{ __('User') }}
            </h2>
            <p class="text-muted mb-0">Manage account</p>
        </div>
    </div>
@endsection

@section('content')
<div class="custom-content">
    <div class="container">
        
    <!-- Filter Role -->
    <div class="filter-role-container mb-3 d-flex justify-content-end">
        <div class="filter-role-card">
            <label for="roleFilterID" class="filter-role-label">Role</label>
            <select id="roleFilterID" class="filter-role-select">
                <option value="all">All</option>
                <option value="member">Member</option>
                <option value="admin">Admin</option>
                <option value="startup owner">Startup Owner</option>
                <option value="mentor">Mentor</option>
            </select>
        </div>
    </div>
    
        <!-- User Table -->
        <table class="table">
            <thead>
                <tr>
                    <th class="fw-normal">Name</th>
                    <th class="fw-normal">Email</th>
                    <th class="fw-normal">Role</th>
                    <th class="fw-normal">Last Sign In</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roles->name ?? 'N/A' }}</td>
                        <td>{{ $user->last_sign_in ? $user->last_sign_in->format('d M Y, H:i') : 'Never' }}</td>
                    </tr>
                @endforeach   
            </tbody>

            <!-- Add User Button -->
            <div class="position-fixed bottom-3 end-3">
                <a href="{{ route('users.create') }}" class="add-user-btn text-white" style="background-color: #232E66;">
                    <i class="bi bi-plus-circle me-2"></i> Add User
                </a>
            </div>

        </table>
    </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('css/Metrics-dashboard/index.css') }}">
    <style>
    .custom-content {
        background-color: white;
        border-radius: 10px 10px 0 0;
        padding: 20px;
        min-height: calc(100vh - 100px); 
        margin-top: 5px; 
        padding-bottom: 40px; 
        border: 1px solid light grey;
    }
    
    .filter-role-container {
        width: 100%;
    }

    .filter-role-card {
        width: 268px;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
    }

    .filter-role-label {
        color: #8C89B4;
        font-size: 14px;
        margin-bottom: 5px;
        display: block;
    }

    .filter-role-select {
        width: 100%;
        height: 40px;
        border: none;
        outline: none;
    }
    
    .add-user-btn {
        position: fixed;
        bottom: 20px;
        right: 20px;
        
        padding: 12px 20px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        font-weight: bold;
    }

    .add-user-btn i {
        font-size: 18px;
    }
    </style>
@endpush


@push('scripts')
    <script src="https://cdn.datatables.net/2.2.2/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('table').DataTable(); 
        });
    </script>
@endpush