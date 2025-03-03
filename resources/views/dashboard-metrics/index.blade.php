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
                                    <option value="4">Not Shared with Me</option>
                                    <option value="5">Shared with me</option>
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
                                        <th scope="col">Trend</th>
                                        <th scope="col">Value</th>
                                        <th scope="col">Change</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($metrics as $metric)
                                        <tr>
                                            @foreach($metric as $data)
                                                <td>{!! $data !!}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
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
@endpush
