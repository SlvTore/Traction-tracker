@extends('layouts.app')

@section('title', 'Users Management')

@section('content_header')
    <div class="row">
        <div class="col-lg-8">
            <h2 class="fw-bolder">
                {{ __('Users Management') }}
            </h2>
            <p class="text-muted">Manage user accounts, access rights, and organizational hierarchy</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- Filter Options -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-funnel"></i></span>
                                <select class="form-select" id="roleFilter">
                                    <option value="">All Roles</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Manager">Manager</option>
                                    <option value="Member">Member</option>
                                    <option value="Startup Owner">Startup Owner</option>
                                    <option value="Mentor">Mentor</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-building"></i></span>
                                <select class="form-select" id="companyFilter">
                                    <option value="">All Companies</option>
                                    <option value="Main Office">Main Office</option>
                                    <option value="Branch 1">Branch 1</option>
                                    <option value="Branch 2">Branch 2</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-toggle-on"></i></span>
                                <select class="form-select" id="statusFilter">
                                    <option value="">All Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-calendar-range"></i></span>
                                <input type="text" class="form-control" id="daterangepicker" placeholder="Last sign in range">
                            </div>
                        </div>
                    </div>

                    <!-- Users Table -->
                    <div class="row mt-4 mx-1 mb-2">
                        <div class="col-md-12">
                            <table class="table" id="usersTable">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Company</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Last Sign In</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-circle me-2">
                                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold">{{ $user->name }}</div>
                                                        @if($user->description)
                                                            <small class="text-muted">{{ $user->description }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <span class="badge role-badge role-{{ strtolower(str_replace(' ', '-', $user->roles->name ?? 'unknown')) }}">
                                                    {{ $user->roles->name ?? 'No Role' }}
                                                </span>
                                            </td>
                                            <td>{{ $user->company ?? 'N/A' }}</td>
                                            <td>{{ $user->phone_number ?? 'N/A' }}</td>
                                            <td>
                                                @if($user->status)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($user->last_signin)
                                                    {{ \Carbon\Carbon::parse($user->last_signin)->format('d M Y, H:i') }}
                                                @else
                                                    <span class="text-muted">Never</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="User Actions">
                                                    <a href="{{ route('dashboard.users.edit', $user->user_id) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('dashboard.users.destroy', $user->user_id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this user?')">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Organizational Hierarchy Section -->
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <h5 class="mb-3">
                                <i class="bi bi-diagram-3"></i> Organizational Hierarchy
                            </h5>
                            <div class="hierarchy-container">
                                <div class="hierarchy-level">
                                    <div class="hierarchy-title">Management</div>
                                    <div class="hierarchy-users">
                                        @foreach($users->where('roles.name', 'Admin') as $admin)
                                            <div class="hierarchy-user admin">
                                                <div class="user-avatar">{{ strtoupper(substr($admin->name, 0, 2)) }}</div>
                                                <div class="user-info">
                                                    <div class="user-name">{{ $admin->name }}</div>
                                                    <div class="user-role">{{ $admin->roles->name ?? 'Admin' }}</div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="hierarchy-level">
                                    <div class="hierarchy-title">Branch Managers</div>
                                    <div class="hierarchy-users">
                                        @foreach($users->where('roles.name', 'Manager') as $manager)
                                            <div class="hierarchy-user manager">
                                                <div class="user-avatar">{{ strtoupper(substr($manager->name, 0, 2)) }}</div>
                                                <div class="user-info">
                                                    <div class="user-name">{{ $manager->name }}</div>
                                                    <div class="user-role">{{ $manager->company ?? 'Manager' }}</div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="hierarchy-level">
                                    <div class="hierarchy-title">Team Members</div>
                                    <div class="hierarchy-users">
                                        @foreach($users->whereIn('roles.name', ['Member', 'Startup Owner', 'Mentor']) as $member)
                                            <div class="hierarchy-user member">
                                                <div class="user-avatar">{{ strtoupper(substr($member->name, 0, 2)) }}</div>
                                                <div class="user-info">
                                                    <div class="user-name">{{ $member->name }}</div>
                                                    <div class="user-role">{{ $member->roles->name ?? 'Member' }}</div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add User Button -->
                    <div class="button-index position-fixed" style="bottom: 30px; right: 30px; z-index: 1000;">
                        <a href="{{ route('dashboard.users.create') }}" class="btn btn-lg rounded-circle shadow-lg d-flex align-items-center justify-content-center" style="background-color: #282458; width: 60px; height: 60px;">
                            <i class="bi bi-person-plus text-white fs-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    <style>
        .avatar-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 14px;
        }

        .role-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }

        .role-admin {
            background-color: #dc3545;
        }

        .role-manager {
            background-color: #fd7e14;
        }

        .role-member {
            background-color: #198754;
        }

        .role-startup-owner {
            background-color: #0d6efd;
        }

        .role-mentor {
            background-color: #6f42c1;
        }

        .role-unknown {
            background-color: #6c757d;
        }

        .hierarchy-container {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-top: 15px;
        }

        .hierarchy-level {
            margin-bottom: 25px;
        }

        .hierarchy-title {
            font-weight: 600;
            color: #495057;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #dee2e6;
        }

        .hierarchy-users {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .hierarchy-user {
            background: white;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 200px;
            transition: all 0.3s ease;
        }

        .hierarchy-user:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
            transform: translateY(-2px);
        }

        .hierarchy-user.admin {
            border-left: 4px solid #dc3545;
        }

        .hierarchy-user.manager {
            border-left: 4px solid #fd7e14;
        }

        .hierarchy-user.member {
            border-left: 4px solid #198754;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 16px;
        }

        .user-name {
            font-weight: 600;
            color: #495057;
            margin-bottom: 2px;
        }

        .user-role {
            font-size: 0.85rem;
            color: #6c757d;
        }

        @media (max-width: 768px) {
            .hierarchy-users {
                flex-direction: column;
            }

            .hierarchy-user {
                min-width: 100%;
            }
        }
    </style>
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            const usersTable = $('#usersTable').DataTable({
                pageLength: 10,
                responsive: true,
                order: [[0, 'asc']],
                columnDefs: [
                    { orderable: false, targets: [7] } // Disable ordering on Actions column
                ]
            });

            // Initialize daterangepicker
            $('#daterangepicker').daterangepicker({
                opens: 'left',
                autoUpdateInput: false,
                locale: {
                    format: 'YYYY-MM-DD',
                    applyLabel: 'Apply',
                    cancelLabel: 'Clear'
                },
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            });

            $('#daterangepicker').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
                applyFilters();
            });

            $('#daterangepicker').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                applyFilters();
            });

            // Filter handlers
            $('#roleFilter, #companyFilter, #statusFilter').on('change', function() {
                applyFilters();
            });

            function applyFilters() {
                const roleFilter = $('#roleFilter').val();
                const companyFilter = $('#companyFilter').val();
                const statusFilter = $('#statusFilter').val();
                const dateRange = $('#daterangepicker').val();

                // Apply role filter
                if (roleFilter) {
                    usersTable.column(2).search(roleFilter);
                } else {
                    usersTable.column(2).search('');
                }

                // Apply company filter
                if (companyFilter) {
                    usersTable.column(3).search(companyFilter);
                } else {
                    usersTable.column(3).search('');
                }

                // Apply status filter
                if (statusFilter) {
                    if (statusFilter === '1') {
                        usersTable.column(5).search('Active');
                    } else {
                        usersTable.column(5).search('Inactive');
                    }
                } else {
                    usersTable.column(5).search('');
                }

                usersTable.draw();
            }

            // Clear all filters
            $('#clearFilters').on('click', function() {
                $('#roleFilter, #companyFilter, #statusFilter').val('');
                $('#daterangepicker').val('');
                usersTable.search('').columns().search('').draw();
            });
        });
    </script>
@endpush