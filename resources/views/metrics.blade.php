
<x-app-layout>
    <x-slot name="header">
        <div class="container">
            <h2 class="h4">
                {{ __('Metrics') }}
            </h2>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="row">
            <div class="col-md-8">
                <!-- Konten Utama -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Selamat Datang</h5>
                        <p class="card-text">Konten dashboard Anda di sini</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <!-- Sidebar -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Sidebar</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
