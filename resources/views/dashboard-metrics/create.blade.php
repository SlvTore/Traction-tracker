

@extends('layouts.app')

@section('title', 'Metrics')

@section('content_header')
    <div class="row">
        <div class="col-lg-8">
            <h2>
                {{ __('Metrics') }}
            </h2>
            <h5 class=" ms-1"></h5>
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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="card-title">Which Metrics Would you like to choose?</h5>
                        </div>
                    </div>
                    <form action="{{ route('metrics.store') }}" method="POST">
                        @csrf
                        <div class="row row-cols-1 row-cols-md-4 g-4">
                            @php
                                $cards = [
                                    ['title' => 'Total Sales', 'text' => 'Measures the total number of transactions that occurred within a specific period', 'id' => 'btncheck1'],
                                    ['title' => 'Revenue Growth', 'text' => 'Tracks revenue growth over time to understand business trends', 'id' => 'btncheck2'],
                                    ['title' => 'Average Sales per Customer', 'text' => 'Indicates the average purchase amount per customer', 'id' => 'btncheck3'],
                                    ['title' => 'Number of New Customers', 'text' => 'Measures the activity of acquiring new customers', 'id' => 'btncheck4'],
                                    ['title' => 'Best-Selling Products', 'text' => 'Identifies top-performing products for stock and marketing strategies', 'id' => 'btncheck5'],
                                    ['title' => 'Number of New Customers', 'text' => 'Tracks the total number of new customers acquired', 'id' => 'btncheck6'],
                                    ['title' => 'Number of Loyal Customers', 'text' => 'Shows the number of customers making repeat purchases', 'id' => 'btncheck7'],
                                    ['title' => 'Customer Loyalty Rate', 'text' => 'Measures customer retention based on purchase frequency and consistency', 'id' => 'btncheck8'],
                                    ['title' => 'Service Time', 'text' => 'Evaluates customer service and operational efficiency', 'id' => 'btncheck9'],
                                    ['title' => 'Stockout Rate', 'text' => 'Monitors the frequency of stockouts to avoid disrupting sales performance', 'id' => 'btncheck10'],
                                    ['title' => 'Cost of Goods Sold (COGS)', 'text' => 'Determines the production cost of goods sold to calculate profitability', 'id' => 'btncheck11'],
                                    ['title' => 'Promotion Success', 'text' => 'Measures the impact of promotional campaigns on sales and customer engagement', 'id' => 'btncheck12'],
                                    ['title' => 'Customer Feedback', 'text' => 'Assesses customer satisfaction and identifies areas for improvement', 'id' => 'btncheck13'],
                                    ['title' => 'Profit Margin', 'text' => 'Calculates the profitability of the business by analyzing revenue and costs', 'id' => 'btncheck14'],
                                ];  @endphp

                            @foreach ($cards as $card)
                                @php
                                    // Memeriksa apakah metric dengan judul ini sudah ada di database
                                    $isExisting = in_array($card['title'], $existingMetrics ?? []);
                                @endphp
                                <div class="col">
                                    <div class="card h-100 {{ $isExisting ? 'bg-light' : '' }}">
                                        <div class="card-header">
                                            <h6 class="card-title">{{ $card['title'] }}</h6>
                                            @if($isExisting)
                                                <span class="badge bg-success">Imported</span>
                                            @endif
                                        </div>
                                        <div class="card-body d-flex flex-column">
                                            <p class="card-text mt-0 flex-grow-1">{{ $card['text'] }}</p>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="{{ $card['id'] }}"
                                                    name="selected_metrics[]" value="{{ $card['title'] }}"
                                                    {{ $isExisting ? 'checked disabled' : '' }}>
                                                <label class="form-check-label" for="{{ $card['id'] }}"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-4 d-flex justify-content-end">
                                <button type="submit" class="btn text-white" style="background-color: #282458;"><i class="bi bi-plus-circle me-2"></i>Import Metrics</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
