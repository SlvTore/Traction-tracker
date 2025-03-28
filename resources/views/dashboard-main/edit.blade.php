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
<!-- Top Cards -->
<div class="row g-3 mb-4">
    <!-- Total Buyer -->
    <div class="col-md-3">
        <div class="card text-center" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); border: none;">
            <div class="card-body position-relative">
                <h6 class="card-title text-muted fw-bold mb-2" style="font-size: 0.85rem;">Total Buyer</h6>
                <h2 class="fw-bold">40,689</h2>
                <br>
                <p class="mb-0">
                    <span class="text-success fw-bold">
                        <i class="bi bi-graph-up-arrow me-1"></i> 8.5%
                    </span>
                    <span class="text-dark fw-bold">Up from yesterday</span>
                </p>
                <i class="bi bi-people-fill position-absolute top-0 end-0 m-3 text-primary" style="font-size: 2rem;"></i>
            </div>
        </div>
    </div>

    <!-- Total Order -->
    <div class="col-md-3">
        <div class="card text-center" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); border: none;">
            <div class="card-body position-relative">
                <h6 class="card-title text-muted fw-bold mb-2" style="font-size: 0.85rem;">Total Order</h6>
                <h2 class="fw-bold">10,293</h2>
                <br>
                <p class="mb-0">
                    <span class="text-success fw-bold">
                        <i class="bi bi-graph-up-arrow me-1"></i> 1.3%
                    </span>
                    <span class="text-dark fw-bold">Up from yesterday</span>
                </p>
                <i class="bi bi-box-seam-fill position-absolute top-0 end-0 m-3 text-warning" style="font-size: 2rem;"></i>
            </div>
        </div>
    </div>

    <!-- Total Sales -->
    <div class="col-md-3">
        <div class="card text-center" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); border: none;">
            <div class="card-body position-relative">
                <h6 class="card-title text-muted fw-bold mb-2" style="font-size: 0.85rem;">Total Sales</h6>
                <h2 class="fw-bold">$89,000</h2>
                <br>
                <p class="mb-0">
                    <span class="text-danger fw-bold">
                        <i class="bi bi-graph-down-arrow me-1"></i> 4.3%
                    </span>
                    <span class="text-dark fw-bold">Down from yesterday</span>
                </p>
                <i class="bi bi-graph-up-arrow position-absolute top-0 end-0 m-3 text-success" style="font-size: 2rem;"></i>
            </div>
        </div>
    </div>

    <!-- Total Pending -->
    <div class="col-md-3">
        <div class="card text-center" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); border: none;">
            <div class="card-body position-relative">
                <h6 class="card-title text-muted fw-bold mb-2" style="font-size: 0.85rem;">Total Pending</h6>
                <h2 class="fw-bold">2,040</h2>
                <br>
                <p class="mb-0">
                    <span class="text-success fw-bold">
                        <i class="bi bi-graph-up-arrow me-1"></i> 1.8%
                    </span>
                    <span class="text-dark fw-bold">Up from yesterday</span>
                </p>
                <i class="bi bi-clock-fill position-absolute top-0 end-0 m-3 text-danger" style="font-size: 2rem;"></i>
            </div>
        </div>
    </div>
</div>

    <!-- Middle Section -->
    <div class="row g-4">
        <!-- Update Progress Chart -->
<div class="col-md-8">
    <div class="card shadow-sm" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); border: none;">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title mb-0">Update Progress</h5>
                <div class="dropdown">
                    <button class="btn btn-warning btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Monthly
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#">Daily</a></li>
                        <li><a class="dropdown-item" href="#">Weekly</a></li>
                        <li><a class="dropdown-item" href="#">Monthly</a></li>
                        <li><a class="dropdown-item" href="#">Annually</a></li>
                    </ul>
                </div>
            </div>
            <div id="updateProgressChart"></div>
        </div>
    </div>
</div>

   <!-- Metrics Goals -->
<div class="col-md-4">
    <div class="card shadow-sm" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); border: none;">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title mb-0">Metrics Goals</h5>
                <div class="dropdown">
                    <button class="btn btn-primary btn-sm" type="button" id="metricsDropdownButton" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 50%; width: 40px; height: 40px; padding: 0; display: flex; justify-content: center; align-items: center;">
                        <i class="bi bi-plus" style="font-size: 1.2rem;"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="metricsDropdownButton">
                        <li><a class="dropdown-item" href="#">Order</a></li>
                        <li><a class="dropdown-item" href="#">Revenue Growth</a></li>
                        <li><a class="dropdown-item" href="#">Average Sales of Customers</a></li>
                        <li><a class="dropdown-item" href="#">Best Selling Products</a></li>
                        <li><a class="dropdown-item" href="#">Number of New Customer</a></li>
                        <li><a class="dropdown-item" href="#">Number of Loyal Customer</a></li>
                        <li><a class="dropdown-item" href="#">Customer Loyalty Level</a></li>
                        <li><a class="dropdown-item" href="#">Services Time</a></li>
                        <li><a class="dropdown-item" href="#">Stock Out Rate</a></li>
                        <li><a class="dropdown-item" href="#">COGS (Cost Of Goods Sold)</a></li>
                        <li><a class="dropdown-item" href="#">Promotion Success</a></li>
                        <li><a class="dropdown-item" href="#">Customer Feedback</a></li>
                        <li><a class="dropdown-item" href="#">Stock Rotation</a></li>
                        <li><a class="dropdown-item" href="#">Profit Margin</a></li>
                    </ul>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item shadow-sm rounded mb-3" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); border: none;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="fw-bold">Best Selling Product</span>
                            <br>
                            <small class="text-muted">26 Mar 2025, 2 hours ago</small>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <span class="text-success">Success</span>
                        </div>
                    </div>
                </li>
                <li class="list-group-item shadow-sm rounded mb-3" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); border: none;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="fw-bold">Profit Margin</span>
                            <br>
                            <small class="text-muted">27 Mar 2025</small>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-x-circle-fill text-danger me-2"></i>
                            <span class="text-danger">Report</span>
                        </div>
                    </div>
                </li>
                <li class="list-group-item shadow-sm rounded mb-3" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); border: none;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="fw-bold">Promotion Success</span>
                            <br>
                            <small class="text-muted">27 Mar 2025</small>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-exclamation-circle-fill text-warning me-2"></i>
                            <span class="text-warning">Warning</span>
                        </div>
                    </div>
                </li>
                <li class="list-group-item shadow-sm rounded mb-3" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); border: none;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="fw-bold">Stock Rotation</span>
                            <br>
                            <small class="text-muted">28 Mar 2025</small>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-x-circle-fill text-danger me-2"></i>
                            <span class="text-danger">Report</span>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
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
        // Update Progress Chart
        var options = {
            chart: {
                type: 'bar',
                height: 300
            },
            series: [
                {
                    name: 'Progress',
                    data: [30, 40, 35, 50, 49, 60, 70, 91, 125, 100, 80, 60]
                }
            ],
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            colors: ['#FFC107', '#E0E0E0']
        };

        var chart = new ApexCharts(document.querySelector("#updateProgressChart"), options);
        chart.render();
    </script>
@endsection