@extends('layouts.app')

@section('title', 'Metrics')

@section('content_header')
    <div class="row">
        <div class="col-lg-8">
            <h2>
                {{ __('Metrics') }}
            </h2>
            <h5 class=" ms-1">Transaction</h5>
        </div>

        <div class="col-lg-4">
            <form class="d-flex" role="search">
                <input class="form-control me-2 rounded" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i></button>
            </form>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group">
                                <label class="input-group-text" for="inputGroupSelect01"><i class="bi bi-funnel"></i></label>
                                <select class="form-select" id="inputGroupSelect01">
                                    <option selected>All</option>
                                    <option value="1">Created by Me</option>
                                    <option value="2">Starred Metrics</option>
                                    <option value="3">Certified Metrics</option>
                                    <option value="4">Not Shared with Me</option>
                                    <option value="5">Shared with me</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <label class="input-group-text" for="inputGroupSelect02"><i class="bi bi-wrench-adjustable"></i></label>
                                <select class="form-select" id="inputGroupSelect02">
                                    <option selected>All</option>
                                    <option value="1">Created by Me</option>
                                    <option value="2">Starred Metrics</option>
                                    <option value="3">Certified Metrics</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <input type="date" class="form-control rounded" id="datepicker" name="datepicker">
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <table class="table" id="metricsTable">
                                <thead>
                                    <tr>
                                        <th scope="col">Metrics</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Value</th>
                                        <th scope="col">Change</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sortedMetrics = collect($metrics)->sortByDesc('favorite')->toArray();
                                    @endphp
                                    @foreach($sortedMetrics as $index => $metric)
                                        @php
                                            // Get the most recent record date instead of using the metric's updated_at
                                            $latestRecord = \App\Models\MetricRecord::where('metric_id', $metric['id'])
                                                            ->orderBy('date', 'desc')
                                                            ->first();

                                            // Calculate days difference based on the record date, not the metric updated_at
                                            $lastUpdated = $latestRecord ? \Carbon\Carbon::parse($latestRecord->date) : null;
                                            $daysAgo = $lastUpdated ? $lastUpdated->diffInDays(\Carbon\Carbon::now()) : 0;
                                            // Always use red color regardless of days
                                            $iconColor = 'text-danger';
                                            $popoverText = $lastUpdated ? "Data updated {$daysAgo} days ago" : "No records available";

                                            // Check if warning condition is met
                                            $needsUpdate = $lastUpdated && $daysAgo > 3;
                                            $buttonBorderStyle = $needsUpdate ? 'border: 2px solid #dc3545;' : '';
                                        @endphp
                                        <tr>
                                            <td>
                                                {{ $metric['title'] }}
                                                @if($needsUpdate)
                                                    <i class="bi bi-exclamation-circle-fill {{ $iconColor }}"
                                                    data-bs-toggle="popover"
                                                    data-bs-html="true"
                                                    data-bs-trigger="hover focus"
                                                    data-bs-title="{{ $popoverText }}"
                                                    data-bs-content="<div class='popover-content'>
                                                        <p><strong>Last Updated: {{ $lastUpdated->format('d M Y') }}</strong></p>
                                                        <p>This metric needs to be updated.</p>
                                                    </div>"
                                                    data-bs-custom-class="popover-danger"
                                                    >
                                                    </i>
                                                @endif
                                            </td>
                                            <td>{{ $metric['date'] }}</td>
                                            <td class="metric-value">{{ $metric['value'] }}</td>
                                            <td>{{ $metric['change_percentage'] ?? '0%' }}</td>
                                            <td>
                                                 <div class="btn-group" role="group" aria-label="Metric Actions">
                                                        <a href="{{ route('metrics.edit', $metric['id']) }}">
                                                            <button type="button" class="btn position-relative my-1 text-white"
                                                                style="background-color: #232E66; {{ $buttonBorderStyle }}">
                                                                Record
                                                                @if($needsUpdate)
                                                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                                        !
                                                                    </span>
                                                                @endif
                                                            </button>
                                                        </a>

                                                        <form action="{{ route('metrics.destroy', $metric['id']) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-danger mx-3 my-1" onclick="return confirm('Are you sure you want to delete this metric?')">
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
                    <div class="button-index position-fixed" style="bottom: 30px; right: 30px; z-index: 1000;">
                        <a href="{{ route('metrics.create') }}" class="btn btn-lg rounded-circle shadow-lg d-flex align-items-center justify-content-center" style="background-color: #282458; width: 60px; height: 60px;">
                            <i class="bi bi-plus-lg text-white fs-2"></i>
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
    <link rel="stylesheet" href="{{ asset('css/Metrics-dashboard/index.css') }}">
    <style>
    .popover {
        transition: opacity 0.3s linear;
    }
    .popover-danger {
        border-color: #dc3545;
    }

    .popover-danger .popover-header {
        background-color: #f8d7da;
        color: #842029;
    }

    .popover-content {
        padding: 5px 0;
    }

    .popover-content p {
        margin-bottom: 8px;
    }

    .popover-content a:hover {
        text-decoration: none;
        opacity: 0.9;
    }
    </style>
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#metricsTable').DataTable({
                // Anda dapat menambahkan opsi konfigurasi DataTables di sini
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
        let activePopover = null;
        let timeout = null;

        // Initialize all popovers
        popoverTriggerList.forEach(function (popoverTriggerEl) {
            const popover = new bootstrap.Popover(popoverTriggerEl, {
                html: true,
                sanitize: false,
                trigger: 'manual',
                placement: 'auto',
                content: popoverTriggerEl.getAttribute('data-bs-content'),
                title: popoverTriggerEl.getAttribute('data-bs-title')
            });

            // Show popover on mouseenter
            popoverTriggerEl.addEventListener('mouseenter', function () {
                // Clear any pending hide timeout
                if (timeout) {
                    clearTimeout(timeout);
                    timeout = null;
                }

                // Hide any other active popover
                if (activePopover && activePopover !== popover) {
                    activePopover.hide();
                }

                popover.show();
                activePopover = popover;

                // Add mouseover event listener to the popover once it's shown
                setTimeout(() => {
                    const popoverElement = document.querySelector('.popover');
                    if (popoverElement) {
                        popoverElement.addEventListener('mouseover', function() {
                            if (timeout) {
                                clearTimeout(timeout);
                                timeout = null;
                            }
                        });

                        popoverElement.addEventListener('mouseleave', function() {
                            timeout = setTimeout(() => {
                                popover.hide();
                                activePopover = null;
                            }, 300);
                        });
                    }
                }, 100);
            });

            // Set up delayed hide on mouseleave
            popoverTriggerEl.addEventListener('mouseleave', function () {
                timeout = setTimeout(() => {
                    // Only hide if mouse isn't over the popover
                    if (!document.querySelector('.popover:hover')) {
                        popover.hide();
                        activePopover = null;
                    }
                }, 500); // Increased delay to give more time to move to popover
            });
        });

        // Close popover when clicking elsewhere on the page
        document.addEventListener('click', function(event) {
            if (activePopover && !event.target.closest('.popover') &&
                !event.target.hasAttribute('data-bs-toggle')) {
                activePopover.hide();
                activePopover = null;
            }
        });
    });
</script>
@endpush
