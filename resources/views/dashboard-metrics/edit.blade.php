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
                <div class="card-body bg-secondary-subtle">
                    <div class="row">
                        <div class="col-3" style="border-right: 1.5px solid #666;">
                            <h4>This Period</h4>
                            <h5></h5>
                        </div>
                        <div class="col-3" style="border-right: 1.5px solid #666;">
                            <h4>Vs Last Period</h4>
                            <h5></h5>
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
                        <div class="period-switch">
                            <h6>
                                <span>
                                    <select name="period-measurement" class="select border-0" id="periodSelect">
                                        <option selected>Daily</option>
                                        <option value="1">Weekly</option>
                                        <option value="2">Monthly</option>
                                        <option value="4">Yearly</option>
                                    </select>
                                </span>
                                Period Measurement
                            </h6>
                        </div>
                    </div>
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
                        <button type="button" class="btn btn-primary" id="saveButton" onclick="saveMetric()">
                            <span id="saveButtonText">Insert Data</span>
                            <span id="saveLoading" class="d-none">
                                <div class="spinner-grow spinner-grow-sm text-light" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </span>
                        </button>
                        <button type="button" class="btn btn-danger d-none" id="deleteButton" onclick="deleteMetric()">
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
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
    <script title="metric-chart">
        // Function to initialize the ApexChart
        let chart = null; // Global variable to store the chart instance

        function initializeChart(data) {
            const days = data.map(item => item.date);
            const values = data.map(item => item.value);

            const options = {
                chart: {
                    type: 'line',
                    height: 350,
                    toolbar: {
                        show: true
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
                    }
                },
                yaxis: {
                    title: {
                        text: 'Value'
                    }
                },
                title: {
                    text: 'Metric Trends',
                    align: 'center'
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
        }

        // Function to fetch data from DataTables and update the chart
        function updateChartFromTable() {
            const table = $('#metricsTable').DataTable();
            const tableData = table.rows().data().toArray(); // Get all rows data from DataTables

            // Jika tidak ada data, jangan update chart
            if (tableData.length === 0) {
                console.warn('No data available in DataTables to update the chart.');
                return;
            }

            // Transform data for the chart
            const chartData = tableData.map(row => ({
                date: row.date, // Assuming 'date' is in the format 'YYYY-MM'
                value: parseFloat(row.value) // Convert value to a number
            }));

            // Initialize or update the chart with the transformed data
            initializeChart(chartData);
        }

        // Event listener to update the chart whenever DataTables data changes
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
