@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
    <div class="row">
        <div class="col-lg-8">
            <h2>
                {{ __('Dashboard') }}
            </h2>
        </div>
    </div>
@endsection

@section('content')
    <!-- Controls -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-3 align-items-center">
                <!-- Insert Metrics -->
                <div class="col-md-3 d-flex align-items-center">
                    <select class="form-control rounded" id="metrics" name="metrics">
                        <option value="" disabled selected>Insert Metrics</option>
                        <option value="revenue">Order</option>
                        <option value="users">Revenue Growth</option>
                        <option value="sales">Average Sales of Customers</option>
                        <option value="sales">Best Selling Products</option>
                        <option value="sales">Number of New Customer</option>
                        <option value="sales">Number of Loyal Customer</option>
                        <option value="sales">Customer Loyalty Level</option>
                        <option value="sales">Services Time</option>
                        <option value="sales">Stock Out Rate</option>
                        <option value="sales">COGS (Cost of Goods Sold)</option>
                        <option value="sales">Promotion Success</option>
                        <option value="sales">Customer Feedbacks</option>
                        <option value="sales">Stock Rotation</option>
                        <option value="sales">Profit Margin</option>
                    </select>
                    <span class="ms-2 text-primary" style="cursor: pointer; font-size: 1.2rem;">
                        <i class="fas fa-plus"></i>
                    </span>
                </div>
                
                <!-- Time and Month (as Range) -->
                <div class="col-md-5 d-flex justify-content-center">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-calendar-alt"></i> Time
                        </span>
                        <input type="text" class="form-control text-center" id="time-range" name="time-range" placeholder="1-02-2020">
                        <span class="input-group-text">→</span>
                        <input type="text" class="form-control text-center" id="month-range" name="month-range" placeholder="28-02-2020">
                    </div>
                </div>

                <div class="col-md-4">
                    <input type="text" class="form-control" id="dashboardName" name="dashboardName" placeholder="Enter Dashboard Name">
                </div>
            </div>
        </div>
    </div>

    <!-- Cards -->
    <div class="row g-4">
        <!-- Order Chart -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body chart-container">
                    <div id="orderChart"></div>
                </div>
            </div>
        </div>

        <!-- Return Chart -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body chart-container">
                    <div id="returnChart"></div>
                </div>
            </div>
        </div>

        <!-- Order Cost Chart -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body chart-container">
                    <div id="orderCostChart"></div>
                </div>
            </div>
        </div>

        <!-- Notes -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Note</h5>
                    <textarea class="form-control flex-grow-1" rows="4" placeholder="Write your notes here..."></textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- Save Button -->
    <div class="row mt-4">
        <div class="col text-end">
            <button class="btn btn-primary px-5" style="background-color: #232E66; border-color: #232E66;">Save</button>
        </div>
    </div>

    <!-- Custom CSS -->
    <style>
        .chart-container {
            height: 280px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    </style>

    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        function generateMultiSeriesChart(elementId, title, dataSeries, colors) {
            var options = {
                chart: {
                    type: 'bar',
                    height: 250
                },
                title: {
                    text: title,
                    align: 'center'
                },
                series: dataSeries,
                xaxis: {
                    categories: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"]
                },
                colors: colors,
                plotOptions: {
                    bar: {
                        columnWidth: '50%',
                        dataLabels: {
                            enabled: false // Disable data labels
                        }
                    }
                },
                dataLabels: {
                    enabled: false // Ensure data labels are disabled
                },
                legend: {
                    show: false // Hide legend
                }
            };

            var chart = new ApexCharts(document.querySelector("#" + elementId), options);
            chart.render();
        }

        window.onload = function () {
            generateMultiSeriesChart("orderChart", "Order", [
                { data: [10, 20, 30, 40, 50, 40, 30] },
                { data: [20, 30, 40, 50, 30, 20, 10] },
                { data: [30, 40, 50, 30, 20, 10, 40] }
            ], ["#1FCB4F", "#5951D2", "#056DB1"]);

            generateMultiSeriesChart("returnChart", "Return", [
                { data: [5, 7, 6, 8, 4, 6, 5] },
                { data: [6, 8, 7, 9, 5, 7, 6] },
                { data: [7, 9, 8, 10, 6, 8, 7] }
            ], ["#1FCB4F", "#5951D2", "#056DB1"]);

            generateMultiSeriesChart("orderCostChart", "Order Cost", [
                { data: [250, 300, 270, 320, 290, 310, 330] },
                { data: [260, 310, 280, 330, 300, 320, 340] },
                { data: [270, 320, 290, 340, 310, 330, 350] }
            ], ["#1FCB4F", "#5951D2", "#056DB1"]);
        };
    </script>
@endsection