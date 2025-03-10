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
                                <th>ID</th>
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
                    <div class="mt-3">
                        <button type="button" class="btn btn-success" onclick="addNewRow()">
                            <i class="bi bi-plus-circle me-2"></i>Add Row
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <form id="metricForm" action="{{ route('metrics.update', $metric->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="metricTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="metricTitle" name="title" value="{{ $metric->title }}">
                        </div>
                        <div class="mb-3">
                            <label for="metricDate" class="form-label">Date</label>
                            <input type="date" class="form-control" id="metricDate" name="date" value="{{ $metric->date }}">
                        </div>
                        <div class="mb-3">
                            <label for="metricValue" class="form-label">Value</label>
                            <input type="text" class="form-control" id="metricValue" name="value"
                                   value="{{ $metric->edited_value ?? $metric->value }}">
                        </div>
                        <div class="mb-3">
                            <label for="metricStatus" class="form-label">Status</label>
                            <select class="form-select" id="metricStatus" name="status">
                                <option value="warning" {{ $metric->status == 'warning' ? 'selected' : '' }}>Warning</option>
                                <option value="success" {{ $metric->status == 'success' ? 'selected' : '' }}>Success</option>
                                <option value="fail" {{ $metric->status == 'fail' ? 'selected' : '' }}>Fail</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="metricNotes" class="form-label">Notes</label>
                            <textarea class="form-control" id="metricNotes" name="notes">{{ $metric->notes }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" onclick="deleteRow()">Delete</button>
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
        // Initialize DataTable
        $('#metricsTable').DataTable();

        // Populate form with existing metric data if editing
        @if(isset($metric))
        // Inisialisasi form dengan data metrik yang ada
        let table = $('#metricsTable').DataTable();
        let statusBadge = '<span class="badge bg-{{ $metric->status == "success" ? "success" : ($metric->status == "fail" ? "danger" : "warning") }}">{{ ucfirst($metric->status) }}</span>';

        // Tambahkan data ke DataTable
        table.row.add([
            1, // ID (bisa disesuaikan)
            '{{ $metric->title }}',
            '{{ $metric->date }}',
            '{{ $metric->value }}',
            statusBadge,
            '{{ $metric->notes }}'
        ]).draw();
        @endif

        // Event handler for row selection
        $('#metricsTable tbody').on('click', 'tr', function() {
            let table = $('#metricsTable').DataTable();
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

        function addNewRow() {
            let table = $('#metricsTable').DataTable();
            let newRow = [
                table.rows().count() + 1, // ID
                '', // Title
                '', // Date
                '', // Value
                '', // Status
                '' // Notes
            ];
            table.row.add(newRow).draw();
        }

        function populateForm(data) {
            $('#metricTitle').val(data[1]);
            $('#metricDate').val(data[2]);
            $('#metricValue').val(data[3]);
            $('#metricStatus').val(data[4].includes('success') ? 'success' : (data[4].includes('fail') ? 'fail' : 'warning'));
            $('#metricNotes').val(data[5]);
        }

        function clearForm() {
            $('#metricForm')[0].reset();
        }

       function updateRow() {
           if (selectedRow !== null) {
               // Update UI
               let table = $('#metricsTable').DataTable();
               let statusBadge = '<span class="badge bg-' + ($('#metricStatus').val() === 'success' ? 'success' : ($('#metricStatus').val() === 'fail' ? 'danger' : 'warning')) + '">' + $('#metricStatus').val().charAt(0).toUpperCase() + $('#metricStatus').val().slice(1) + '</span>';

               table.row(selectedRow).data([
                   selectedRow + 1,
                   $('#metricTitle').val(),
                   $('#metricDate').val(),
                   $('#metricValue').val(), // Nilai yang diedit
                   statusBadge,
                   $('#metricNotes').val()
               ]).draw();

               // Send data to server
               $.ajax({
                   url: '{{ route("metrics.update", $metric->id) }}',
                   type: 'POST',
                   data: {
                       _token: '{{ csrf_token() }}',
                       _method: 'PUT',
                       // Tidak mengirim title dan date untuk mencegah perubahan di index
                       value: $('#metricValue').val(), // Akan disimpan sebagai edited_value
                       status: $('#metricStatus').val(),
                       notes: $('#metricNotes').val()
                   },
                   success: function(response) {
                       console.log('Data saved successfully');
                   },
                   error: function(xhr) {
                       console.error('Error saving data');
                   }
               });

               clearForm();
               selectedRow = null;
           }
       }

        function deleteRow() {
            if (selectedRow !== null) {
                let table = $('#metricsTable').DataTable();
                table.row(selectedRow).remove().draw();
                clearForm();
                selectedRow = null;
            }
        }
    </script>
@endpush
