<x-guest-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Setup Wizard</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/register.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

        <style>
            .wizard-step {
                display: none;
            }
            .wizard-step.active {
                display: block;
            }
            .role-card {
                border: 2px solid #e9ecef;
                border-radius: 10px;
                padding: 20px;
                margin: 10px 0;
                cursor: pointer;
                transition: all 0.3s ease;
            }
            .role-card:hover {
                border-color: #007bff;
                box-shadow: 0 4px 8px rgba(0,123,255,0.1);
            }
            .role-card.selected {
                border-color: #007bff;
                background-color: #f8f9fa;
            }
            .progress-indicator {
                display: flex;
                justify-content: space-between;
                margin-bottom: 30px;
            }
            .progress-step {
                width: 30px;
                height: 30px;
                border-radius: 50%;
                background-color: #e9ecef;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #6c757d;
                font-weight: bold;
                position: relative;
            }
            .progress-step.active {
                background-color: #007bff;
                color: white;
            }
            .progress-step.completed {
                background-color: #28a745;
                color: white;
            }
            .progress-line {
                flex: 1;
                height: 2px;
                background-color: #e9ecef;
                margin: 14px 10px;
                position: relative;
            }
            .progress-line.completed {
                background-color: #28a745;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 p-0 bg-wrapper">
                    <div class="row justify-content-end">
                        <div class="register-form col-lg-6 d-flex align-items-center p-3">
                            <div class="container">
                                <div class="d-flex justify-content-end mt-1">
                                    <img src="{{ asset('images/Maxy-Logo.png') }}" alt="Logo" class="img-fluid mt-1" style="width: 100px; height: auto;">
                                </div>
                                
                                <!-- Progress Indicator -->
                                <div class="progress-indicator">
                                    <div class="progress-step active" id="step-1">1</div>
                                    <div class="progress-line" id="line-1"></div>
                                    <div class="progress-step" id="step-2">2</div>
                                    <div class="progress-line" id="line-2"></div>
                                    <div class="progress-step" id="step-3">3</div>
                                </div>

                                <div class="row justify-content-center">
                                    <div class="col-md-10">
                                        
                                        <!-- Step 1: Role Selection -->
                                        <div class="wizard-step active" id="wizard-step-1">
                                            <div class="text-center mb-4">
                                                <h2 class="fw-bold">Choose Your Role</h2>
                                                <p class="lead">Select the role that best describes your position</p>
                                            </div>
                                            
                                            <div id="role-selection">
                                                @foreach($roles as $role)
                                                <div class="role-card" data-role="{{ $role->name }}">
                                                    <h5 class="fw-bold">
                                                        @if($role->name === 'business-owner')
                                                            <i class="fas fa-crown text-warning"></i> Business Owner
                                                        @elseif($role->name === 'staff')
                                                            <i class="fas fa-users text-primary"></i> Staff
                                                        @elseif($role->name === 'business-investigator')
                                                            <i class="fas fa-search text-info"></i> Business Investigator
                                                        @endif
                                                    </h5>
                                                    <p class="text-muted mb-0">{{ $role->description }}</p>
                                                </div>
                                                @endforeach
                                            </div>
                                            
                                            <div class="d-flex justify-content-end mt-4">
                                                <button type="button" class="btn btn-primary" id="next-to-step-2" disabled>
                                                    Next <i class="fas fa-arrow-right"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Step 2: User Information -->
                                        <div class="wizard-step" id="wizard-step-2">
                                            <div class="text-center mb-4">
                                                <h2 class="fw-bold">Your Information</h2>
                                                <p class="lead">Please provide your details</p>
                                            </div>
                                            
                                            <form id="user-info-form">
                                                @csrf
                                                <input type="hidden" id="selected-role" name="role">
                                                
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Full Name</label>
                                                    <input type="text" class="form-control" id="name" name="name" required>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email Address</label>
                                                    <input type="email" class="form-control" id="email" name="email" required>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="password" class="form-control" id="password" name="password" required>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="company" class="form-label">Company (Optional)</label>
                                                    <input type="text" class="form-control" id="company" name="company">
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="phone_number" class="form-label">Phone Number (Optional)</label>
                                                    <input type="text" class="form-control" id="phone_number" name="phone_number">
                                                </div>
                                            </form>
                                            
                                            <div class="d-flex justify-content-between mt-4">
                                                <button type="button" class="btn btn-secondary" id="back-to-step-1">
                                                    <i class="fas fa-arrow-left"></i> Back
                                                </button>
                                                <button type="button" class="btn btn-primary" id="next-to-step-3">
                                                    Next <i class="fas fa-arrow-right"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Step 3: Completion -->
                                        <div class="wizard-step" id="wizard-step-3">
                                            <div class="text-center mb-4">
                                                <h2 class="fw-bold">Complete Setup</h2>
                                                <p class="lead">Review your information and complete the setup</p>
                                            </div>
                                            
                                            <div id="review-info" class="mb-4">
                                                <!-- Review information will be populated by JavaScript -->
                                            </div>
                                            
                                            <div class="d-flex justify-content-between mt-4">
                                                <button type="button" class="btn btn-secondary" id="back-to-step-2">
                                                    <i class="fas fa-arrow-left"></i> Back
                                                </button>
                                                <button type="button" class="btn btn-success" id="complete-setup">
                                                    <i class="fas fa-check"></i> Complete Setup
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <p class="text-center mt-3">Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Business Access Modal -->
        <div class="modal fade" id="businessAccessModal" tabindex="-1" aria-labelledby="businessAccessModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="businessAccessModalLabel">Business Access</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="business-access-form">
                            @csrf
                            <input type="hidden" id="modal-role" name="role">
                            
                            <div class="mb-3">
                                <label for="public_id" class="form-label">Business Dashboard ID</label>
                                <input type="text" class="form-control" id="public_id" name="public_id" required>
                                <div class="form-text">Enter the Business Dashboard ID provided by your Business Owner</div>
                            </div>
                            
                            <div class="mb-3" id="invitation-code-field" style="display: none;">
                                <label for="invitation_code" class="form-label">Staff Invitation Code</label>
                                <input type="text" class="form-control" id="invitation_code" name="invitation_code">
                                <div class="form-text">Enter the invitation code provided by your Business Owner</div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="validate-business-access">Join Business</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            let selectedRole = '';
            let currentStep = 1;

            // Role selection
            document.querySelectorAll('.role-card').forEach(card => {
                card.addEventListener('click', function() {
                    document.querySelectorAll('.role-card').forEach(c => c.classList.remove('selected'));
                    this.classList.add('selected');
                    selectedRole = this.dataset.role;
                    document.getElementById('selected-role').value = selectedRole;
                    document.getElementById('next-to-step-2').disabled = false;
                });
            });

            // Navigation
            document.getElementById('next-to-step-2').addEventListener('click', function() {
                if (selectedRole) {
                    goToStep(2);
                }
            });

            document.getElementById('back-to-step-1').addEventListener('click', function() {
                goToStep(1);
            });

            document.getElementById('next-to-step-3').addEventListener('click', function() {
                if (validateUserForm()) {
                    updateReviewInfo();
                    goToStep(3);
                }
            });

            document.getElementById('back-to-step-2').addEventListener('click', function() {
                goToStep(2);
            });

            document.getElementById('complete-setup').addEventListener('click', function() {
                submitRegistration();
            });

            function goToStep(step) {
                // Hide all steps
                document.querySelectorAll('.wizard-step').forEach(s => s.classList.remove('active'));
                
                // Show current step
                document.getElementById('wizard-step-' + step).classList.add('active');
                
                // Update progress indicator
                updateProgressIndicator(step);
                currentStep = step;
            }

            function updateProgressIndicator(step) {
                for (let i = 1; i <= 3; i++) {
                    const stepEl = document.getElementById('step-' + i);
                    const lineEl = document.getElementById('line-' + i);
                    
                    if (i < step) {
                        stepEl.classList.add('completed');
                        stepEl.classList.remove('active');
                        if (lineEl) lineEl.classList.add('completed');
                    } else if (i === step) {
                        stepEl.classList.add('active');
                        stepEl.classList.remove('completed');
                    } else {
                        stepEl.classList.remove('active', 'completed');
                        if (lineEl) lineEl.classList.remove('completed');
                    }
                }
            }

            function validateUserForm() {
                const form = document.getElementById('user-info-form');
                const formData = new FormData(form);
                
                if (!formData.get('name') || !formData.get('email') || !formData.get('password')) {
                    alert('Please fill in all required fields');
                    return false;
                }
                
                if (formData.get('password') !== formData.get('password_confirmation')) {
                    alert('Passwords do not match');
                    return false;
                }
                
                return true;
            }

            function updateReviewInfo() {
                const form = document.getElementById('user-info-form');
                const formData = new FormData(form);
                
                const reviewHTML = `
                    <div class="card">
                        <div class="card-body">
                            <h6><strong>Role:</strong> ${selectedRole.charAt(0).toUpperCase() + selectedRole.slice(1).replace('-', ' ')}</h6>
                            <h6><strong>Name:</strong> ${formData.get('name')}</h6>
                            <h6><strong>Email:</strong> ${formData.get('email')}</h6>
                            ${formData.get('company') ? `<h6><strong>Company:</strong> ${formData.get('company')}</h6>` : ''}
                            ${formData.get('phone_number') ? `<h6><strong>Phone:</strong> ${formData.get('phone_number')}</h6>` : ''}
                        </div>
                    </div>
                `;
                
                document.getElementById('review-info').innerHTML = reviewHTML;
            }

            function submitRegistration() {
                const form = document.getElementById('user-info-form');
                const formData = new FormData(form);
                
                fetch('{{ route("wizard.store") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        if (data.role === 'staff' || data.role === 'business-investigator') {
                            showBusinessAccessModal(data.role);
                        } else {
                            window.location.href = data.redirect_url;
                        }
                    } else {
                        alert('Registration failed: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Registration failed. Please try again.');
                });
            }

            function showBusinessAccessModal(role) {
                document.getElementById('modal-role').value = role;
                
                if (role === 'staff') {
                    document.getElementById('invitation-code-field').style.display = 'block';
                    document.getElementById('invitation_code').required = true;
                } else {
                    document.getElementById('invitation-code-field').style.display = 'none';
                    document.getElementById('invitation_code').required = false;
                }
                
                new bootstrap.Modal(document.getElementById('businessAccessModal')).show();
            }

            document.getElementById('validate-business-access').addEventListener('click', function() {
                const form = document.getElementById('business-access-form');
                const formData = new FormData(form);
                
                fetch('{{ route("wizard.validate-business") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        window.location.href = '{{ route("dashboard") }}';
                    } else {
                        alert('Validation failed: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Validation failed. Please try again.');
                });
            });
        </script>
    </body>
    </html>
</x-guest-layout>