@extends('layouts.app')

@section('title', 'Metrics')

@section('content_header')
    <div class="row">
        <div class="col-lg-8">
            <h2>
                {{ __('Metrics') }}
            </h2>
            <h5 class=" ms-1">Visualization</h5>
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

    <div class="row">
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body bg-secondary-subtle">
                    <div class="row ">
                        <div class="col-3" style="border-right: 1.5px solid #666;">
                            <h4>This Period</h4>
                            <h5>1000</h5>
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
                            <h4>Total of Metrics</h4>
                            <h5></h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="period-switch">
                            <h6>
                                <span>
                                    <select class="select border-0" id="periodSelect">
                                        <option selected>Day</option>
                                        <option value="1">Week</option>
                                        <option value="2">Month</option>
                                        <option value="3">Quarter</option>
                                        <option value="4">Year</option>
                                    </select>
                                </span>
                                Period Measurement
                            </h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="chart"></div> <!-- Ensure the ID is 'chart' -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mt-3">
           <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Records</h4>
                </div>
               <div class="card-body">
                    <table id="metricsTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Value</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($metrics as $index => $metric)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><a href="{{ route('metrics.visual', ['id' => $metric->id]) }}">{{ $metric->title }}</a></td>
                                    <td>{{ $metric->date }}</td>
                                    <td>{{ $metric->value }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Metric Actions">
                                            <a href="{{ route('metrics.edit', $metric->id) }}" class="btn btn-outline-primary">Edit</a>
                                            <form action="{{ route('metrics.destroy', $metric->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this metric?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
               </div>
           </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(function() {
            $('#daterangepicker').daterangepicker({
                opens: 'left',
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear',
                    format: 'YYYY-MM-DD'
                }
            });

            $('#daterangepicker').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
            });

            $('#daterangepicker').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

            // Initialize DataTables
            $('#metricsTable').DataTable();

            // Initialize ApexCharts
            var options = {
                chart: {
                    type: 'line'
                },
                series: [{
                    name: 'Metric Value',
                    data: @json($metricValues) // Ensure this is an array of numeric values
                }],
                xaxis: {
                    categories: @json($metricCategories) // Ensure this is an array of categories
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        });
    </script>
@endpush
