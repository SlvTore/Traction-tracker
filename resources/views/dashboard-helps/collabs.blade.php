@extends('layouts.app')

@section('title', 'Help Center')

@section('content_header')
    <div class="row">
        <div class="col-lg-8">
            <h2>
                {{ __('Help Center') }}
            </h2>
            <h6 class="mb-0 ms-1">
                {{ __('Users and Collaborations') }}
            </h6>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 d-flex align-items-center">
                        <a href="{{ route('helpIndex') }}" class="btn btn-outline-secondary rounded-circle me-3">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                        <div class="flex-grow-1 d-flex justify-content-center">
                            <h2>Users and Collaborations</h2>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <!-- User Management Section -->
                    <div class="col-md-12 mt-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-pin-angle-fill me-2 text-primary"></i>
                            <h4 class="mb-0">User Management</h4>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Create and manage user accounts within your organization</li>
                            <li class="list-group-item">Assign different roles and permissions to users</li>
                            <li class="list-group-item">Monitor user activity and engagement with projects</li>
                            <li class="list-group-item">Reset passwords and manage account settings</li>
                        </ul>
                    </div>

                    <!-- Collaboration Features Section -->
                    <div class="col-md-12 mt-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-pin-angle-fill me-2 text-primary"></i>
                            <h4 class="mb-0">Collaboration Features</h4>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Share projects and tasks with team members</li>
                            <li class="list-group-item">Comment on tasks and exchange feedback in real-time</li>
                            <li class="list-group-item">Track changes and updates made by collaborators</li>
                            <li class="list-group-item">Set up notifications for important collaboration events</li>
                        </ul>
                    </div>

                    <!-- How to Use Section -->
                    <div class="col-md-12 mt-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-pin-angle-fill me-2 text-primary"></i>
                            <h4 class="mb-0">How to Use</h4>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Send collaboration invites to team members via email</li>
                            <li class="list-group-item">Accept or decline collaboration requests from other users</li>
                            <li class="list-group-item">Configure project visibility and access permissions</li>
                            <li class="list-group-item">Utilize shared workspaces for enhanced team productivity</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
