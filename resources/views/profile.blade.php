@extends('layouts.app')

@section('title', 'Profile')

@section('content_header')
    <div class="row align-items-center mb-3">
        <div class="col-lg-8">
            <h2 class="fw-bold">{{ __('Profile') }}</h2>
            <p class="text-muted mb-0">Manage your account settings</p>
        </div>
    </div>
@endsection

@section('content')
<div class="custom-content">
    <div class="container-fluid">
        <div class="row">
            
            <!-- User Information -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">User Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Name</label>
                            <p class="form-control-plaintext">{{ auth()->user()->name }}</p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <p class="form-control-plaintext">{{ auth()->user()->email }}</p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Role</label>
                            <p class="form-control-plaintext">
                                <span class="badge 
                                    @if(auth()->user()->isBusinessOwner()) bg-warning
                                    @elseif(auth()->user()->isAdministrator()) bg-primary
                                    @elseif(auth()->user()->isStaff()) bg-success
                                    @elseif(auth()->user()->isBusinessInvestigator()) bg-info
                                    @else bg-secondary
                                    @endif
                                ">
                                    {{ auth()->user()->roles ? ucwords(str_replace('-', ' ', auth()->user()->roles->name)) : 'No Role' }}
                                </span>
                            </p>
                        </div>
                        
                        @if(auth()->user()->company)
                        <div class="mb-3">
                            <label class="form-label fw-bold">Company</label>
                            <p class="form-control-plaintext">{{ auth()->user()->company }}</p>
                        </div>
                        @endif
                        
                        @if(auth()->user()->phone_number)
                        <div class="mb-3">
                            <label class="form-label fw-bold">Phone Number</label>
                            <p class="form-control-plaintext">{{ auth()->user()->phone_number }}</p>
                        </div>
                        @endif
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <p class="form-control-plaintext">
                                <span class="badge {{ auth()->user()->status ? 'bg-success' : 'bg-danger' }}">
                                    {{ auth()->user()->status ? 'Active' : 'Inactive' }}
                                </span>
                            </p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Last Sign In</label>
                            <p class="form-control-plaintext">
                                {{ auth()->user()->last_signin ? auth()->user()->last_signin->format('d M Y, H:i') : 'Never' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Business Information (for Business Owners and connected users) -->
            @if(auth()->user()->businesses->isNotEmpty())
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Business Information</h5>
                    </div>
                    <div class="card-body">
                        @foreach(auth()->user()->businesses as $business)
                        <div class="mb-4 p-3 border rounded">
                            <h6 class="fw-bold">{{ $business->business_name }}</h6>
                            
                            <div class="mb-2">
                                <label class="form-label fw-bold text-muted">Public Dashboard ID</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ $business->public_id }}" readonly>
                                    <button class="btn btn-outline-secondary" type="button" onclick="copyToClipboard('{{ $business->public_id }}')">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                                <small class="text-muted">Share this ID with Business Investigators</small>
                            </div>
                            
                            @if(auth()->user()->isBusinessOwner())
                            <div class="mb-2">
                                <label class="form-label fw-bold text-muted">Staff Invitation Code</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ $business->invitation_code }}" readonly>
                                    <button class="btn btn-outline-secondary" type="button" onclick="copyToClipboard('{{ $business->invitation_code }}')">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                    <button class="btn btn-warning" type="button" onclick="regenerateCode()">
                                        <i class="fas fa-refresh"></i>
                                    </button>
                                </div>
                                <small class="text-muted">Share this code with staff members (keep it secret!)</small>
                            </div>
                            @endif
                            
                            <div class="mb-2">
                                <label class="form-label fw-bold text-muted">Created Date</label>
                                <p class="form-control-plaintext">{{ $business->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            
        </div>
        
        <!-- Account Actions -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Account Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary" onclick="editProfile()">
                                <i class="fas fa-edit"></i> Edit Profile
                            </button>
                            
                            <button class="btn btn-warning" onclick="changePassword()">
                                <i class="fas fa-key"></i> Change Password
                            </button>
                            
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
    .custom-content {
        background-color: white;
        border-radius: 10px 10px 0 0;
        padding: 20px;
        min-height: calc(100vh - 100px); 
        margin-top: 5px; 
        border: 1px solid #e9ecef;
    }
    
    .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border-radius: 0.5rem;
    }
    
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
        border-radius: 0.5rem 0.5rem 0 0 !important;
    }
    
    .form-control-plaintext {
        border: none;
        background-color: #f8f9fa;
        padding: 0.375rem 0.75rem;
        border-radius: 0.375rem;
        margin-bottom: 0;
    }
    
    .badge {
        font-size: 0.875em;
        padding: 0.5em 0.75em;
    }
    </style>
@endpush

@push('scripts')
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                alert('Copied to clipboard!');
            }, function(err) {
                console.error('Could not copy text: ', err);
            });
        }

        function regenerateCode() {
            if (confirm('Are you sure you want to regenerate the invitation code? This will invalidate the current code.')) {
                fetch('/business/regenerate-code', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Invitation code regenerated successfully!');
                        location.reload();
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while regenerating the code.');
                });
            }
        }

        function editProfile() {
            alert('Edit profile functionality would be implemented here.');
            // You can implement a modal or redirect to edit form
        }

        function changePassword() {
            alert('Change password functionality would be implemented here.');
            // You can implement a modal or redirect to password change form
        }
    </script>
@endpush