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
                        <button type="button" class="btn btn-primary" id="saveButton" onclick="saveMetric()">Insert Data</button>
                        <button type="button" class="btn btn-danger d-none" id="deleteButton" onclick="deleteMetric()">Delete Data</button>
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
    <script>
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

            if (selectedRow !== null) {
                // Update existing row
                $.ajax({
                    url: '{{ route("metric-records.update", ":id") }}'.replace(':id', table.row(selectedRow).data().id),
                    type: 'PUT',
                    data: formData,
                    success: function(response) {
                        let statusBadge = '<span class="badge bg-' + (formData.status === 'success' ? 'success' : (formData.status === 'fail' ? 'danger' : 'warning')) + '">' + formData.status.charAt(0).toUpperCase() + formData.status.slice(1) + '</span>';
                        table.row(selectedRow).data({
                            id: table.row(selectedRow).data().id,
                            title: formData.title,
                            date: formData.date,
                            value: formData.value,
                            status: statusBadge,
                            notes: formData.notes
                        }).draw();
                        clearForm();
                        selectedRow = null;
                    },
                    error: function(xhr) {
                        console.error('Error updating data');
                    }
                });
            } else {
                // Add new row
                $.ajax({
                    url: '{{ route("metric-records.store", $metric->id) }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        let statusBadge = '<span class="badge bg-' + (formData.status === 'success' ? 'success' : (formData.status === 'fail' ? 'danger' : 'warning')) + '">' + formData.status.charAt(0).toUpperCase() + formData.status.slice(1) + '</span>';
                        table.row.add({
                            id: response.data.id,
                            title: formData.title,
                            date: formData.date,
                            value: formData.value,
                            status: statusBadge,
                            notes: formData.notes
                        }).draw();
                        clearForm();
                    },
                    error: function(xhr) {
                        console.error('Error saving data');
                    }
                });
            }
        }

        function deleteMetric() {
            let table = $('#metricsTable').DataTable();
            if (selectedRow !== null) {
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
                    },
                    error: function(xhr) {
                        console.error('Error deleting data');
                    }
                });
            }
        }
    </script>
@endpush
