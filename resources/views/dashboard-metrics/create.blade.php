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
                                    ['title' => 'Total Penjualan', 'text' => 'Mengukur jumlah total transaksi yang terjadi dalam periode tertentu', 'id' => 'btncheck1'],
                                    ['title' => 'Revenue Growth', 'text' => 'Melihat Pertumbuhan Pendapatan dari waktu ke waktu untuk memahami tren bisnis', 'id' => 'btncheck2'],
                                    ['title' => 'Rata-rata Penjualan per Pelanggan', 'text' => 'Menunjukan sebarapa besar rata-rata pembelian setiap pelanggan', 'id' => 'btncheck3'],
                                    ['title' => 'Jumlah Pelanggan Baru', 'text' => 'Mengukur aktivitas akuisisi pelanggan baru', 'id' => 'btncheck4'],
                                    ['title' => 'Penjualan Produk Terlaris', 'text' => 'Mengidentifikasi produk dengan performa terbaik untuk strategi stok dan pemasaran', 'id' => 'btncheck5'],
                                    ['title' => 'Total Penjualan', 'text' => 'Mengukur Jumlah Tertentu total', 'id' => 'btncheck6'],
                                    ['title' => 'Jumlah Pelanggan Setia', 'text' => 'Menunjukkan jumlah pelanggan yang melakukan pembelian berulang', 'id' => 'btncheck7'],
                                    ['title' => 'Tingkat Loyalitas Pelanggan', 'text' => 'Mengukur retensi pelanggan berdasarkan frekuensi dan konsistensi dalam pembelian', 'id' => 'btncheck8'],
                                    ['title' => 'Waktu Layanan', 'text' => 'Mengevaluasi efisiensi pelayanan pelanggan dan operasional', 'id' => 'btncheck9'],
                                    ['title' => 'Tingkat Kehabisan Stok', 'text' => 'Mengontrol frekuensi kehabisan produk agar tidak mengganggu performa penjualan', 'id' => 'btncheck10'],
                                    ['title' => 'Cost of Goods Sold (COGS)', 'text' => 'menentukan biaya produksi barang yang dijual untuk menghitung profitabilitas', 'id' => 'btncheck11'],
                                    ['title' => 'Keberhasilan Promosi', 'text' => 'Mengukur dampak kampanya promosi terhadap penjualan dan keterlibatan pelanggan', 'id' => 'btncheck12'],
                                    ['title' => 'Feedback Pelanggan', 'text' => 'Menilai kepuasan pelanggan dan menemukan area perbaikan', 'id' => 'btncheck13'],
                                    ['title' => 'Total Penjualan', 'text' => 'Mengukur Jumlah Tertentu total', 'id' => 'btncheck14'],
                                ];
                            @endphp

                            @foreach ($cards as $card)
                                <div class="col">
                                    <div class="card h-100">
                                        <div class="card-header">
                                            <h6 class="card-title">{{ $card['title'] }}</h6>
                                        </div>
                                        <div class="card-body d-flex flex-column">
                                            <p class="card-text mt-0 flex-grow-1">{{ $card['text'] }}</p>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="{{ $card['id'] }}" name="selected_metrics[]" value="{{ $card['title'] }}" >
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
