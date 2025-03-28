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
    <div class="mb-3 d-flex justify-content-end" style="position: relative; width: 268px;">
        <div style="position: absolute; top: 5px; left: 15px; color: #8C89B4; font-size: 14px; pointer-events: none;">
            Role
        </div>
        <select id="roleFilter" class="form-select" style="width: 100%; height: 60px; padding-top: 20px;">
            <option value="all">All</option>
            <option value="member">Member</option>
            <option value="admin">Admin</option>
            <option value="startup owner">Startup Owner</option>
            <option value="mentor">Mentor</option>
        </select>
    </div>
    
        <!-- User Table -->
        <table class="table">
            <thead>
                <tr>
                    <th class="fw-normal">Name</th>
                    <th class="fw-normal">Email</th>
                    <th class="fw-normal">Role</th>
                    <th class="fw-normal">Last Sign in</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role_id) }}</td>
                        <td>{{ $user->last_sign_in ? $user->last_sign_in->format('d M Y, H:i') : 'Never' }}</td>
                    </tr>
                @endforeach                
            </tbody>

            <!-- Add User Button -->
            <div class="position-fixed bottom-3 end-3">
                <a href="{{ route('users.create') }}" class="add-user-btn">
                    <i class="fas fa-plus-circle"></i> Add User
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
    
    .add-user-btn {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
        background-color: #1E1E50; 
        color: white;
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
