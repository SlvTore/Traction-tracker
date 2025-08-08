@extends('layouts.app')

@section('title', 'User Management')

@section('content_header')
    <div class="row align-items-center mb-3">
        <div class="col-lg-8">
            <h2 class="fw-bold">{{ __('User Management') }}</h2>
            <p class="text-muted mb-0">Manage users and their roles</p>
        </div>
        <div class="col-lg-4 text-end">
            @if(auth()->user()->canManageUsers())
                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add User
                </a>
            @endif
        </div>
    </div>
@endsection

@section('content')
<div class="custom-content">
    <div class="container-fluid">
        
        <!-- Business Information Card (for Business Owners) -->
        @if(auth()->user()->isBusinessOwner())
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Business Dashboard Information</h5>
                    </div>
                    <div class="card-body">
                        @if(auth()->user()->businesses->isNotEmpty())
                            @php $business = auth()->user()->businesses->first(); @endphp
                            <p><strong>Public Dashboard ID:</strong> 
                                <code>{{ $business->public_id }}</code>
                                <button class="btn btn-sm btn-outline-secondary ms-2" onclick="copyToClipboard('{{ $business->public_id }}')">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </p>
                            <p><strong>Staff Invitation Code:</strong> 
                                <code>{{ $business->invitation_code }}</code>
                                <button class="btn btn-sm btn-outline-secondary ms-2" onclick="copyToClipboard('{{ $business->invitation_code }}')">
                                    <i class="fas fa-copy"></i>
                                </button>
                                <button class="btn btn-sm btn-warning ms-2" onclick="regenerateCode()">
                                    <i class="fas fa-refresh"></i> Regenerate
                                </button>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
        
        <!-- Users Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Users</h5>
            </div>
            <div class="card-body">
                <table id="users-table" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Company</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Last Sign In</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.min.css">
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
    
    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
        border-top: none;
    }
    
    code {
        background-color: #f8f9fa;
        color: #e83e8c;
        padding: 0.2rem 0.4rem;
        border-radius: 0.25rem;
        font-size: 0.875em;
    }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.datatables.net/2.2.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
        $(document).ready(function () {
            $('#users-table').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: '{{ route("user.index") }}',
                    type: 'GET'
                },
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'role', name: 'role' },
                    { data: 'company', name: 'company', defaultContent: '-' },
                    { data: 'phone_number', name: 'phone_number', defaultContent: '-' },
                    { data: 'status', name: 'status' },
                    { data: 'last_signin', name: 'last_signin' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ],
                pageLength: 25,
                responsive: true,
                language: {
                    search: "Search users:",
                    lengthMenu: "Show _MENU_ users per page",
                    info: "Showing _START_ to _END_ of _TOTAL_ users",
                    infoEmpty: "No users found",
                    infoFiltered: "(filtered from _MAX_ total users)"
                }
            });
        });

        function promoteUser(userId) {
            if (confirm('Are you sure you want to promote this user to Administrator?')) {
                fetch(`/users/${userId}/promote`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        $('#users-table').DataTable().ajax.reload();
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while promoting the user.');
                });
            }
        }

        function deleteUser(userId) {
            if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
                fetch(`/users/${userId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        $('#users-table').DataTable().ajax.reload();
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the user.');
                });
            }
        }

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
    </script>
@endpush