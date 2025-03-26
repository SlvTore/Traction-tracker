@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
    <div class="row">
        <div class="col-lg-8">
            <h2>
                {{ __('Dashboard') }}
            </h2>
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
    <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-calendar-range"></i></span>
            <input type="text" class="form-control" id="daterangepicker" placeholder="Select date range">
        </div>
    </div>
</div>

<div class="button-index position-fixed" style="bottom: 30px; right: 30px; z-index: 1000;">
    <a href="{{ route('dashboard') }}" class="btn btn-lg rounded-circle shadow-lg d-flex align-items-center justify-content-center" style="background-color: #282458; width: 60px; height: 60px;">
        <i class="bi bi-plus-lg text-white fs-2"></i>
    </a>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script title="metric-range-picker-fixed">
        $(document).ready(function() {
            // Initialize daterangepicker with standard behavior
            $('#daterangepicker').daterangepicker({
                opens: 'left',
                autoUpdateInput: true,
                locale: {
                    format: 'YYYY-MM-DD',
                    applyLabel: 'Apply',
                    cancelLabel: 'Cancel'
                },
                ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                'This Quarter': [moment().startOf('quarter'), moment().endOf('quarter')],
                'This Year': [moment().startOf('year'), moment().endOf('year')],
                'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
                },
                startDate: moment().subtract(30, 'days'),
                endDate: moment()
            });

            // Handle apply event (when user selects a date range)
            $('#daterangepicker').on('apply.daterangepicker', function(ev, picker) {
                // Filter data based on the selected date range
                const startDate = picker.startDate.format('YYYY-MM-DD');
                const endDate = picker.endDate.format('YYYY-MM-DD');
                const filteredData = filterDataByDateRange(startDate, endDate);

                // Update the chart with filtered data
                initializeChart(filteredData);
            });

            // CRITICAL FIX: Force reinitialization of the picker on click
            $('#daterangepicker').on('click', function(e) {
                if ($(this).data('daterangepicker') === undefined) {
                    // If the daterangepicker instance was destroyed, recreate it
                    $(this).daterangepicker({
                        opens: 'left',
                        autoUpdateInput: true,
                        locale: {
                            format: 'YYYY-MM-DD',
                            applyLabel: 'Apply',
                            cancelLabel: 'Cancel'
                        },
                        ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                        'This Quarter': [moment().startOf('quarter'), moment().endOf('quarter')],
                        'This Year': [moment().startOf('year'), moment().endOf('year')],
                        'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
                        },
                        startDate: moment().subtract(30, 'days'),
                        endDate: moment()
                    });

                    // Reattach the apply event handler
                    $(this).on('apply.daterangepicker', function(ev, picker) {
                        const startDate = picker.startDate.format('YYYY-MM-DD');
                        const endDate = picker.endDate.format('YYYY-MM-DD');
                        const filteredData = filterDataByDateRange(startDate, endDate);
                        initializeChart(filteredData);
                    });
                }

                // Force the picker to show
                var picker = $(this).data('daterangepicker');
                if (picker) {
                    picker.show();

                    // Additional fix to ensure the calendar is visible
                    $('.daterangepicker').show();
                }
            });

            // Fix for Bootstrap modal conflicts if you're using Bootstrap
            // This prevents Bootstrap modal from capturing events that should go to daterangepicker
            $(document).on('click', '.daterangepicker', function(e) {
                e.stopPropagation();
            });
        });

        // Function to filter data by date range
        function filterDataByDateRange(startDate, endDate) {
            return originalData.filter(item => {
                return item.date >= startDate && item.date <= endDate;
            });
        }

        // Add a small debug helper to check for daterangepicker issues
        function checkDaterangepicker() {
            if ($('#daterangepicker').length === 0) {
                console.error('Daterangepicker input element not found');
            }

            if ($('#daterangepicker').data('daterangepicker') === undefined) {
                console.error('Daterangepicker instance is missing');

                // Auto-fix: reinitialize
                $('#daterangepicker').trigger('click');
            }

            if ($('.daterangepicker').length === 0) {
                console.error('Daterangepicker container is missing from DOM');
            }
        }

        // Check for issues periodically
        setInterval(checkDaterangepicker, 5000);
    </script>

@endpush

