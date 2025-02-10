<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Laravel'))</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        @stack('styles')

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        @stack('scripts')
    </head>
    <body class="@yield('body-class')">
        <div class="container-fluid">
            <div class="row min-vh-100">
                <!-- Left Sidebar Navigation -->
                <div class="col-lg-3 shadow-sm p-0">
                    @include('layouts.navigation')
                </div>

                <!-- Right Content Area -->
                <div class="col-lg-9 bg-light">
                    <!-- Page Heading -->
                    <header class="bg-white shadow-sm mb-4">
                        <div class="container-fluid py-3">
                            @yield('content_header')
                        </div>
                    </header>

                    <!-- Page Content -->
                    <main class="py-4">
                        <div class="container-fluid">
                            @yield('content')
                        </div>
                    </main>
                </div>
            </div>
        </div>

        @stack('modals')
        @stack('footer-scripts')
    </body>
</html>
