@extends('layouts.app')

@section('title', 'Dashboard Feeds')

@section('content_header')
    <div class="row">
        <div class="col-lg-8">
            <h2 class="fw-bolder">
                {{ __('Activity Feeds') }}
            </h2>
            <p class="text-muted">Track achievements and metrics across all business branches</p>
        </div>
        <div class="col-lg-4">
            <form class="d-flex" role="search">
                <input class="form-control me-2 rounded" type="search" placeholder="Search activities..." aria-label="Search">
                <button class="btn btn-outline-success" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>
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
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-funnel"></i></span>
                                <select class="form-select" id="activityTypeFilter">
                                    <option selected>All Activities</option>
                                    <option value="metric_updated">Metric Updates</option>
                                    <option value="user_created">New Users</option>
                                    <option value="achievement">Achievements</option>
                                    <option value="milestone">Milestones</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-building"></i></span>
                                <select class="form-select" id="businessFilter">
                                    <option selected>All Branches</option>
                                    <option value="main">Main Office</option>
                                    <option value="branch1">Branch 1</option>
                                    <option value="branch2">Branch 2</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-calendar-range"></i></span>
                                <input type="text" class="form-control" id="dateRangeFilter" placeholder="Select date range">
                            </div>
                        </div>
                    </div>

                    <!-- Activity Timeline -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="timeline-container">
                                <div class="timeline">
                                    <!-- Sample Activity Items -->
                                    <div class="timeline-item">
                                        <div class="timeline-marker bg-success">
                                            <i class="bi bi-graph-up text-white"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="timeline-header">
                                                <h6 class="mb-1">Sales Metric Updated</h6>
                                                <small class="text-muted">2 hours ago</small>
                                            </div>
                                            <div class="timeline-body">
                                                <p class="mb-1"><strong>John Doe</strong> from <span class="badge bg-primary">Branch 1</span> updated the monthly sales metric</p>
                                                <div class="metric-achievement">
                                                    <span class="text-success">
                                                        <i class="bi bi-arrow-up-right"></i> +15.5% from last month
                                                    </span>
                                                    <small class="text-muted">| Target achieved: 105%</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="timeline-item">
                                        <div class="timeline-marker bg-info">
                                            <i class="bi bi-person-plus text-white"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="timeline-header">
                                                <h6 class="mb-1">New Team Member</h6>
                                                <small class="text-muted">5 hours ago</small>
                                            </div>
                                            <div class="timeline-body">
                                                <p class="mb-1"><strong>Jane Smith</strong> joined <span class="badge bg-secondary">Branch 2</span> as Sales Manager</p>
                                                <small class="text-muted">Welcome to the team!</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="timeline-item">
                                        <div class="timeline-marker bg-warning">
                                            <i class="bi bi-trophy text-white"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="timeline-header">
                                                <h6 class="mb-1">Milestone Achievement</h6>
                                                <small class="text-muted">1 day ago</small>
                                            </div>
                                            <div class="timeline-body">
                                                <p class="mb-1"><span class="badge bg-success">Main Office</span> reached <strong>10,000 customers</strong> milestone</p>
                                                <div class="metric-achievement">
                                                    <span class="text-warning">
                                                        <i class="bi bi-star-fill"></i> Major milestone achieved!
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="timeline-item">
                                        <div class="timeline-marker bg-danger">
                                            <i class="bi bi-exclamation-triangle text-white"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="timeline-header">
                                                <h6 class="mb-1">Metric Alert</h6>
                                                <small class="text-muted">2 days ago</small>
                                            </div>
                                            <div class="timeline-body">
                                                <p class="mb-1"><span class="badge bg-warning">Branch 1</span> customer satisfaction metric needs attention</p>
                                                <div class="metric-achievement">
                                                    <span class="text-danger">
                                                        <i class="bi bi-arrow-down-right"></i> -5.2% below target
                                                    </span>
                                                    <small class="text-muted">| Action required</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="timeline-item">
                                        <div class="timeline-marker bg-success">
                                            <i class="bi bi-graph-up text-white"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="timeline-header">
                                                <h6 class="mb-1">Revenue Milestone</h6>
                                                <small class="text-muted">3 days ago</small>
                                            </div>
                                            <div class="timeline-body">
                                                <p class="mb-1"><span class="badge bg-primary">Branch 2</span> exceeded monthly revenue target</p>
                                                <div class="metric-achievement">
                                                    <span class="text-success">
                                                        <i class="bi bi-arrow-up-right"></i> +22.8% above target
                                                    </span>
                                                    <small class="text-muted">| Outstanding performance!</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Load More Button -->
                    <div class="text-center mt-4">
                        <button class="btn btn-outline-primary">
                            <i class="bi bi-arrow-clockwise"></i> Load More Activities
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    <style>
        .timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 15px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e9ecef;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 30px;
        }

        .timeline-marker {
            position: absolute;
            left: -23px;
            top: 0;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .timeline-content {
            background: #fff;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 15px;
            margin-left: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .timeline-content:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }

        .timeline-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 10px;
        }

        .timeline-header h6 {
            margin: 0;
            color: #495057;
            font-weight: 600;
        }

        .timeline-body p {
            color: #6c757d;
            line-height: 1.5;
        }

        .metric-achievement {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 8px;
        }

        .timeline-container {
            max-height: 800px;
            overflow-y: auto;
            padding-right: 10px;
        }

        .timeline-container::-webkit-scrollbar {
            width: 6px;
        }

        .timeline-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .timeline-container::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }

        .timeline-container::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        @media (max-width: 768px) {
            .timeline {
                padding-left: 20px;
            }

            .timeline-marker {
                left: -18px;
                width: 24px;
                height: 24px;
            }

            .timeline-content {
                margin-left: 15px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize daterangepicker
            $('#dateRangeFilter').daterangepicker({
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

            $('#dateRangeFilter').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
                // Here you would filter the timeline based on the selected date range
                filterTimeline();
            });

            $('#dateRangeFilter').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                // Clear the filter
                filterTimeline();
            });

            // Filter handlers
            $('#activityTypeFilter, #businessFilter').on('change', function() {
                filterTimeline();
            });

            function filterTimeline() {
                const activityType = $('#activityTypeFilter').val();
                const businessFilter = $('#businessFilter').val();
                const dateRange = $('#dateRangeFilter').val();
                
                // In a real implementation, this would make an AJAX call to filter the timeline
                console.log('Filtering timeline:', {
                    activityType: activityType,
                    business: businessFilter,
                    dateRange: dateRange
                });
            }
        });
    </script>
@endpush