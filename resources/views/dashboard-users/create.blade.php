@extends('layouts.app')

@section('title', 'Create User')

@section('content_header')
    <div class="row">
        <div class="col-lg-8">
            <h2 class="fw-bolder">
                {{ __('Create New User') }}
            </h2>
            <p class="text-muted">Add a new user to the system</p>
        </div>
        <div class="col-lg-4 text-end">
            <a href="{{ route('dashboard.users') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back to Users
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">User Information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.users.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <!-- Name Field -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Password Field -->
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                           id="password" name="password" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Minimum 6 characters</small>
                            </div>

                            <!-- Phone Number Field -->
                            <div class="col-md-6 mb-3">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" 
                                       id="phone_number" name="phone_number" value="{{ old('phone_number') }}" 
                                       placeholder="+62 xxx xxxx xxxx">
                                @error('phone_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Role Field -->
                            <div class="col-md-6 mb-3">
                                <label for="role_id" class="form-label">Role <span class="text-danger">*</span></label>
                                <select class="form-select @error('role_id') is-invalid @enderror" id="role_id" name="role_id" required>
                                    <option value="">Select Role</option>
                                    @foreach($roles as $roleId => $roleName)
                                        <option value="{{ $roleId }}" {{ old('role_id') == $roleId ? 'selected' : '' }}>
                                            {{ $roleName }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Company Field -->
                            <div class="col-md-6 mb-3">
                                <label for="company" class="form-label">Company/Branch</label>
                                <select class="form-select @error('company') is-invalid @enderror" id="company" name="company">
                                    <option value="">Select Company/Branch</option>
                                    <option value="Main Office" {{ old('company') == 'Main Office' ? 'selected' : '' }}>Main Office</option>
                                    <option value="Branch 1" {{ old('company') == 'Branch 1' ? 'selected' : '' }}>Branch 1</option>
                                    <option value="Branch 2" {{ old('company') == 'Branch 2' ? 'selected' : '' }}>Branch 2</option>
                                    <option value="Branch 3" {{ old('company') == 'Branch 3' ? 'selected' : '' }}>Branch 3</option>
                                </select>
                                @error('company')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Description Field -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description/Notes</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3" 
                                      placeholder="Additional information about the user">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status Field -->
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="status" name="status" value="1" 
                                       {{ old('status', 1) ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">
                                    Active User
                                </label>
                            </div>
                            <small class="form-text text-muted">Uncheck to create an inactive user account</small>
                        </div>

                        <!-- Access Rights Preview -->
                        <div class="mb-4" id="accessRightsPreview" style="display: none;">
                            <h6 class="text-muted">Access Rights Preview</h6>
                            <div class="alert alert-info" id="accessInfo">
                                <!-- Will be populated by JavaScript -->
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('dashboard.users') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-person-plus"></i> Create User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .form-label {
            font-weight: 600;
            color: #495057;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }

        .btn-outline-secondary:hover {
            color: #495057;
        }

        .invalid-feedback {
            display: block;
        }

        .access-item {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 5px;
        }

        .access-item i {
            color: #28a745;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            const togglePassword = document.getElementById('togglePassword');
            const passwordField = document.getElementById('password');
            
            togglePassword.addEventListener('click', function() {
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
                
                const icon = this.querySelector('i');
                icon.classList.toggle('bi-eye');
                icon.classList.toggle('bi-eye-slash');
            });

            // Role-based access rights preview
            const roleSelect = document.getElementById('role_id');
            const accessPreview = document.getElementById('accessRightsPreview');
            const accessInfo = document.getElementById('accessInfo');

            const rolePermissions = {
                'Admin': [
                    'Full system access',
                    'Manage all users',
                    'View all metrics and reports',
                    'Manage business settings',
                    'Access all branches data'
                ],
                'Manager': [
                    'Manage branch users',
                    'View branch metrics',
                    'Create and edit reports',
                    'Limited administrative access'
                ],
                'Member': [
                    'View assigned metrics',
                    'Update own records',
                    'Basic reporting access'
                ],
                'Startup Owner': [
                    'Manage startup metrics',
                    'View performance reports',
                    'Access mentorship features'
                ],
                'Mentor': [
                    'View mentee progress',
                    'Access guidance tools',
                    'Review startup metrics'
                ]
            };

            roleSelect.addEventListener('change', function() {
                const selectedRole = this.options[this.selectedIndex].text;
                
                if (selectedRole && rolePermissions[selectedRole]) {
                    const permissions = rolePermissions[selectedRole];
                    let permissionsHtml = '<strong>' + selectedRole + ' Access Rights:</strong><br>';
                    
                    permissions.forEach(permission => {
                        permissionsHtml += '<div class="access-item"><i class="bi bi-check-circle-fill"></i>' + permission + '</div>';
                    });
                    
                    accessInfo.innerHTML = permissionsHtml;
                    accessPreview.style.display = 'block';
                } else {
                    accessPreview.style.display = 'none';
                }
            });

            // Form validation feedback
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        field.classList.remove('is-invalid');
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    
                    // Scroll to first invalid field
                    const firstInvalid = form.querySelector('.is-invalid');
                    if (firstInvalid) {
                        firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        firstInvalid.focus();
                    }
                }
            });

            // Real-time validation
            const inputs = form.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.hasAttribute('required') && !this.value.trim()) {
                        this.classList.add('is-invalid');
                    } else {
                        this.classList.remove('is-invalid');
                    }
                });

                input.addEventListener('input', function() {
                    if (this.classList.contains('is-invalid') && this.value.trim()) {
                        this.classList.remove('is-invalid');
                    }
                });
            });
        });
    </script>
@endpush