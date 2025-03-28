@extends('layouts.app')

@section('title', 'Create User')

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
        <h2 class="fw-bold mb-3">Personal</h2>

        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="row">
                <!-- Isi form bagian Kiri -->
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>

                <!-- Isi form bagian Kanan -->
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select">
                            <option value="" disabled selected>Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role }}">{{ $role }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Company</label>
                        <input type="text" name="company" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone number</label>
                        <input type="text" name="phone-number" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="save-user-btn text-white" style="background-color: #232E66;">
                    Save
                </button>
            </div>
        </form>
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

    .save-user-btn {
        padding: 12px 20px; 
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        font-weight: bold;
        border: none;
    }

    .save-user-bt-info i {
        font-size: 18px;
    }

    .save-user-bt-info:hover {
        background-color: #151540; 
    }
    </style>
@endpush