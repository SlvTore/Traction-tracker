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
                                <div class="timeline" id="activityTimeline">
                                    @foreach($activities as $activity)
                                        <div class="timeline-item" data-type="{{ $activity['type'] }}" data-branch="{{ $activity['branch'] ?? '' }}">
                                            <div class="timeline-marker bg-{{ $activity['color'] }}">
                                                <i class="bi {{ $activity['icon'] }} text-white"></i>
                                            </div>
                                            <div class="timeline-content">
                                                <div class="timeline-header">
                                                    <h6 class="mb-1">{{ $activity['title'] }}</h6>
                                                    <small class="text-muted">{{ $activity['created_at']->diffForHumans() }}</small>
                                                </div>
                                                <div class="timeline-body">
                                                    <p class="mb-1">
                                                        <strong>{{ $activity['user'] }}</strong> 
                                                        @if(isset($activity['branch']))
                                                            from <span class="badge bg-primary">{{ $activity['branch'] }}</span>
                                                        @endif
                                                        {{ $activity['description'] }}
                                                    </p>
                                                    @if(isset($activity['value']))
                                                        <div class="metric-achievement">
                                                            <span class="text-{{ $activity['color'] }}">
                                                                <i class="bi bi-arrow-up-right"></i> Value: {{ $activity['value'] }}
                                                            </span>
                                                            @if(isset($activity['date']))
                                                                <small class="text-muted">| Date: {{ \Carbon\Carbon::parse($activity['date'])->format('M d, Y') }}</small>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    @if($activities->isEmpty())
                                        <div class="text-center py-5">
                                            <i class="bi bi-activity text-muted" style="font-size: 3rem;"></i>
                                            <h5 class="text-muted mt-3">No Activities Found</h5>
                                            <p class="text-muted">Start creating metrics and inviting users to see activities here.</p>
                                        </div>
                                    @endif
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
                
                // Show/hide timeline items based on filters
                $('.timeline-item').each(function() {
                    let show = true;
                    
                    // Activity type filter
                    if (activityType && activityType !== 'all') {
                        const itemType = $(this).data('type');
                        if (itemType !== activityType) {
                            show = false;
                        }
                    }
                    
                    // Business filter
                    if (businessFilter && businessFilter !== 'all') {
                        const itemBranch = $(this).data('branch');
                        if (itemBranch !== businessFilter) {
                            show = false;
                        }
                    }
                    
                    // Show or hide the item
                    if (show) {
                        $(this).slideDown(300);
                    } else {
                        $(this).slideUp(300);
                    }
                });
                
                // Check if any items are visible
                setTimeout(() => {
                    const visibleItems = $('.timeline-item:visible').length;
                    if (visibleItems === 0) {
                        if ($('#no-results').length === 0) {
                            $('#activityTimeline').append(`
                                <div id="no-results" class="text-center py-5">
                                    <i class="bi bi-search text-muted" style="font-size: 3rem;"></i>
                                    <h5 class="text-muted mt-3">No Activities Match Your Filter</h5>
                                    <p class="text-muted">Try adjusting your filter criteria.</p>
                                </div>
                            `);
                        }
                    } else {
                        $('#no-results').remove();
                    }
                }, 350);
            }
        });
    </script>
@endpush