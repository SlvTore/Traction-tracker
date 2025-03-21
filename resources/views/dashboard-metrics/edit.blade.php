@extends('layouts.app')

@section('title', 'Edit Metric')

@section('content_header')
    <div class="row">
        <div class="col-lg-8 d-flex align-items-center">
            <a href="{{ route('metrics') }}" class="text-decoration-none text-dark">
                <i class="bi bi-arrow-bar-left fw-bold fs-1 me-2"></i>
            </a>
            <h2 class="mb-0">
                {{ __('Metrics') }}
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
        <div class="col-lg-4">
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-calendar-range"></i></span>
                <input type="text" class="form-control" id="daterangepicker" placeholder="Select date range">
            </div>
        </div>
        <div class="col-lg-4">

        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-secondary-subtle">
                    <div class="row">
                        <div class="col-3" style="border-right: 1.5px solid #666;">
                            <h4>This Period</h4>
                            <h2 id="focusValue" class="text-center"></h2>

                        </div>
                        <div class="col-3" style="border-right: 1.5px solid #666;">
                            <h4>Vs Last Period</h4>
                            <h4 id="lastValue" class="fw-bold"></h4>
                            <p id="lastValuePercentage" class="text-center"></p>
                        </div>
                        <div class="col-3" style="border-right: 1.5px solid #666;">
                            <h4>Vs Yearly Period</h4>
                            <h5></h5>
                        </div>
                        <div class="col-3">
                            <h4>Total of Value</h4>
                            <h5></h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <table id="metricsTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Value</th>
                                <th>Status</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- No initial rows -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <form id="metricForm" action="{{ route('metric-records.store', $metric->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="metricTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="metricTitle" name="title" value="{{ old('title') }}">
                        </div>
                        <div class="mb-3">
                            <label for="metricDate" class="form-label">Date</label>
                            <input type="date" class="form-control" id="metricDate" name="date" value="{{ old('date') }}">
                        </div>
                        <div class="mb-3">
                            <label for="metricValue" class="form-label">Value</label>
                            <input type="text" class="form-control" id="metricValue" name="value" value="{{ old('value') }}">
                        </div>
                        <div class="mb-3">
                            <label for="metricStatus" class="form-label">Status</label>
                            <select class="form-select" id="metricStatus" name="status">
                                <option value="warning">Warning</option>
                                <option value="success">Success</option>
                                <option value="fail">Fail</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="metricNotes" class="form-label">Notes</label>
                            <textarea class="form-control" id="metricNotes" name="notes">{{ old('notes') }}</textarea>
                        </div>
                        <button type="button" class="btn btn-outline-primary w-100" id="saveButton" onclick="saveMetric()">
                            <span id="saveButtonText">Insert Data</span>
                            <span id="saveLoading" class="d-none">
                                <div class="spinner-grow spinner-grow-sm text-light" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </span>
                        </button>
                        <button type="button" class="btn btn-outline-danger d-none w-100 mt-2" id="deleteButton" onclick="deleteMetric()">
                            <span id="deleteButtonText">Delete Data</span>
                            <span id="deleteLoading" class="d-none">
                                <div class="spinner-grow spinner-grow-sm text-light" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
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
    <script title="metrics-table">
        let selectedRow = null;

        $(document).ready(function() {
            // Initialize DataTable with AJAX source
            let table = $('#metricsTable').DataTable({
                ajax: {
                    url: '{{ route("metric-records.getRecords", $metric->id) }}',
                    dataSrc: 'data'
                },
                columns: [
                    { data: null, render: function (data, type, row, meta) {
                        return meta.row + 1;
                    }},
                    { data: 'title' },
                    { data: 'date' },
                    { data: 'value' },
                    { data: 'status', render: function(data, type, row) {
                        return '<span class="badge bg-' + (data === 'success' ? 'success' : (data === 'fail' ? 'danger' : 'warning')) + '">' + data.charAt(0).toUpperCase() + data.slice(1) + '</span>';
                    }},
                    { data: 'notes' }
                ]
            });

            // Event handler for row selection
            $('#metricsTable tbody').on('click', 'tr', function() {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                    clearForm();
                    selectedRow = null;
                } else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                    selectedRow = table.row(this).index();
                    populateForm(table.row(this).data());
                }
            });
        });

        function populateForm(data) {
            $('#metricTitle').val(data.title);
            $('#metricDate').val(data.date);
            $('#metricValue').val(data.value);
            $('#metricStatus').val(data.status);
            $('#metricNotes').val(data.notes);
            $('#saveButton').text('Edit Data');
            $('#deleteButton').removeClass('d-none');
        }

        function clearForm() {
            $('#metricForm')[0].reset();
            $('#saveButton').text('Insert Data');
            $('#deleteButton').addClass('d-none');
        }

        function showLoading(buttonId, loadingId) {
            $(buttonId).prop('disabled', true);
            $(loadingId).removeClass('d-none');
        }

        function hideLoading(buttonId, loadingId) {
            $(buttonId).prop('disabled', false);
            $(loadingId).addClass('d-none');
        }

        function saveMetric() {
            let table = $('#metricsTable').DataTable();
            let formData = {
                _token: '{{ csrf_token() }}',
                title: $('#metricTitle').val(),
                date: $('#metricDate').val(),
                value: $('#metricValue').val(),
                status: $('#metricStatus').val(),
                notes: $('#metricNotes').val()
            };

            showLoading('#saveButton', '#saveLoading');

            if (selectedRow !== null) {
                // Update existing row
                $.ajax({
                    url: '{{ route("metric-records.update", ":id") }}'.replace(':id', table.row(selectedRow).data().id),
                    type: 'PUT',
                    data: formData,
                    success: function(response) {
                        hideLoading('#saveButton', '#saveLoading');
                        alert('Data updated successfully');
                        table.ajax.reload();
                        clearForm();
                        selectedRow = null;
                    },
                    error: function(xhr) {
                        console.error('Error updating data');
                        hideLoading('#saveButton', '#saveLoading');
                        alert('Error updating data');
                    }
                });
            } else {
                // Add new row
                $.ajax({
                    url: '{{ route("metric-records.store", $metric->id) }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        hideLoading('#saveButton', '#saveLoading');
                        alert('Data inserted successfully');
                        table.ajax.reload();
                        clearForm();
                    },
                    error: function(xhr) {
                        console.error('Error saving data');
                        hideLoading('#saveButton', '#saveLoading');
                        alert('Error saving data');
                    }
                });
            }
        }

        function deleteMetric() {
            let table = $('#metricsTable').DataTable();
            if (selectedRow !== null) {
                showLoading('#deleteButton', '#deleteLoading');
                $.ajax({
                    url: '{{ route("metric-records.destroy", ":id") }}'.replace(':id', table.row(selectedRow).data().id),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        table.row(selectedRow).remove().draw();
                        clearForm();
                        selectedRow = null;
                        hideLoading('#deleteButton', '#deleteLoading');
                        location.reload();
                    },
                    error: function(xhr) {
                        console.error('Error deleting data');
                        hideLoading('#deleteButton', '#deleteLoading');
                    }
                });
            }
        }
    </script>

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


    <script title="metric-chart">
        let chart = null; // Global variable to store the chart instance
        let originalData = []; // To store the original data from DataTables

        // Function to initialize the ApexChart
        function initializeChart(data) {
            const days = data.map(item => item.date);
            const values = data.map(item => item.value);

            // Calculate the total sum of all values
            const totalSum = values.reduce((sum, current) => sum + current, 0);

            const options = {
                chart: {
                    type: 'line',
                    height: 350,
                    toolbar: {
                        show: true,
                        tools: {
                            download: true,
                            selection: true,
                            zoom: true,
                            zoomin: true,
                            zoomout: true,
                            pan: true,
                            reset: true
                        }
                    },
                    events: {
                        // Add dataPointSelection event handler
                        dataPointSelection: function(event, chartContext, config) {
                            // Get the selected point's index and value
                            const selectedIndex = config.dataPointIndex;
                            const selectedValue = values[selectedIndex];

                            // Calculate the percentage of the total
                            const percentage = (selectedValue / totalSum) * 100;
                            const formattedPercentage = percentage.toFixed(2) + '%';

                            // Update the focusValue element
                            document.getElementById('focusValue').innerHTML =
                                `${selectedValue.toLocaleString()} (${formattedPercentage})`;

                            // Handle comparison with previous period
                            updateLastPeriodComparison(selectedIndex, values, totalSum);
                        }
                    }
                },
                series: [{
                    name: 'Metric Value',
                    data: values
                }],
                xaxis: {
                    categories: days,
                    title: {
                        text: 'Date'
                    },
                    labels: {
                        rotate: -45,
                        trim: false,
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    title: {
                        text: 'Value'
                    },
                    labels: {
                        formatter: function(val) {
                            return val.toFixed(2);
                        }
                    }
                },
                title: {
                    text: 'Metric Trends',
                    align: 'center'
                },
                markers: {
                    size: 5,
                    hover: {
                        size: 7
                    }
                },
                tooltip: {
                    enabled: true,
                    shared: false,
                    intersect: true,
                    y: {
                        formatter: function(val) {
                            return val.toFixed(2);
                        }
                    }
                },
                // Add annotations for better visual reference
                annotations: {
                    yaxis: [{
                        y: data.length > 0 ? Math.max(...values) : 0,
                        borderColor: '#00E396',
                        label: {
                            borderColor: '#00E396',
                            style: {
                                color: '#fff',
                                background: '#00E396'
                            },
                            text: 'Highest Value'
                        }
                    }, {
                        y: data.length > 0 ? Math.min(...values) : 0,
                        borderColor: '#FF4560',
                        label: {
                            borderColor: '#FF4560',
                            style: {
                                color: '#fff',
                                background: '#FF4560'
                            },
                            text: 'Lowest Value'
                        }
                    }]
                }
            };

            if (chart === null) {
                // Create a new chart if it doesn't exist
                chart = new ApexCharts(document.querySelector("#chart"), options);
                chart.render();
            } else {
                // Update the existing chart
                chart.updateOptions(options);
            }

            // Set default values (showing the latest point's data)
            if (values.length > 0) {
                const latestIndex = values.length - 1;
                const latestValue = values[latestIndex];
                const latestPercentage = (latestValue / totalSum * 100).toFixed(2);

                document.getElementById('focusValue').innerHTML =
                    `${latestValue.toLocaleString()} (${latestPercentage}%)`;

                // Set up the last period comparison for the most recent point
                updateLastPeriodComparison(latestIndex, values, totalSum);
            } else {
                // If no data is available
                document.getElementById('focusValue').innerHTML = 'No data available';
                document.getElementById('lastValue').innerHTML = 'N/A';
                document.getElementById('lastValuePercentage').innerHTML = 'No data for comparison';
            }
        }

        // Function to update the chart from table data
        function updateChartFromTable() {
            const table = $('#metricsTable').DataTable();
            const tableData = table.rows().data().toArray();
            if (tableData.length === 0) {
                console.warn('No data available in DataTables to update the chart.');
                return;
            }

            // Transform data for the chart
            const chartData = tableData.map(row => ({
                date: row.date,
                value: parseFloat(row.value)
            }));

            // Store the original data for date range filtering
            originalData = chartData;

            // Initialize or update the chart with the transformed data
            initializeChart(chartData);
        }

        // Function to update the last period comparison
        function updateLastPeriodComparison(currentIndex, values, totalSum) {
            const lastValueEl = document.getElementById('lastValue');
            const lastValuePercentageEl = document.getElementById('lastValuePercentage');

            // Check if we have a previous period to compare with
            if (currentIndex > 0) {
                const currentValue = values[currentIndex];
                const previousValue = values[currentIndex - 1];

                // Calculate the percentage change
                const percentageChange = ((currentValue - previousValue) / previousValue) * 100;

                // Determine if it's an increase or decrease
                const isIncrease = percentageChange > 0;

                // Format the percentage change with + or - sign
                const formattedChange = (isIncrease ? '+' : '') + percentageChange.toFixed(2) + '%';

                // Set the text and color based on increase/decrease
                lastValueEl.innerHTML = formattedChange;
                lastValueEl.className = isIncrease ? 'text-success fw-bold' : 'text-danger fw-bold';

                // Calculate percentages of total for both periods
                const currentPercentage = (currentValue / totalSum * 100).toFixed(2);
                const previousPercentage = (previousValue / totalSum * 100).toFixed(2);

                // Update the description text
                lastValuePercentageEl.innerHTML = `from ${previousPercentage}% to ${currentPercentage}%`;
            } else {
                // If there's no previous period (first data point)
                lastValueEl.innerHTML = 'N/A';
                lastValueEl.className = '';
                lastValuePercentageEl.innerHTML = 'No previous data for comparison';
            }
        }

        // Initialize on document ready
        $(document).ready(function() {
            const table = $('#metricsTable').DataTable();

            // Trigger chart update after table initialization
            table.on('xhr', function() {
                updateChartFromTable();
            });

            // Trigger chart update after any table redraw
            table.on('draw', function() {
                updateChartFromTable();
            });
        });
    </script>
@endpush
