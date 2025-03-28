
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <style>
            body {
                font-family: 'Inter', sans-serif;
            }

            .form-control-dark {
                border-color: var(--bs-gray);
            }

            .form-control-dark:focus {
                border-color: #fff;
                box-shadow: 0 0 0 .25rem rgba(255, 255, 255, .25);
            }

            .text-small {
                font-size: 85%;
            }

            .dropdown-toggle:not(:focus) {
                outline: 0;
            }

            .btn-yellow {
                background-color: #FBB041;
                border-color: #FBB041;
            }

            .btn-yellow:hover {
                background-color: #e9a23a;
                border-color: #e9a23a;
            }
        </style>
    </head>
    <body>
        <header class="p-3 mb-3 border-bottom">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none me-lg-4">
                        <img src="{{ asset('images/maxy-logo.png') }}" alt="Logo" width="110px" height="32" class="me-2">
                        <span class="fs-4 fw-bold">Traction Tracker</span>
                    </a>

                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                        <li><a href="#" class="nav-link px-2 link-body-emphasis">Home</a></li>
                        <li><a href="#" class="nav-link px-2 link-body-emphasis">Features</a></li>
                        <li><a href="#" class="nav-link px-2 link-body-emphasis">Pricing</a></li>
                        <li><a href="#" class="nav-link px-2 link-body-emphasis">About</a></li>
                    </ul>

                    <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                        <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
                    </form>

                    @if (Route::has('login'))
                        <div class="text-end">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-yellow">Dashboard</a>
                                <button type="button" class="btn btn-outline-dark me-2" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</button>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-dark me-2">Login</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-yellow">Sign up</a>
                                @endif
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </header>

        <main>
            <div class="container py-5">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h1 class="display-4 fw-bold mb-4">Track and Accelerate Your Business Growth</h1>
                        <p class="lead mb-4">Traction Tracker provides powerful tools to monitor your key business metrics, visualize growth, and make data-driven decisions.</p>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                            <a href="#" class="btn btn-yellow btn-lg px-4 me-md-2">Get Started</a>
                            <a href="#" class="btn btn-outline-secondary btn-lg px-4">Learn More</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <img src="{{ asset('images/heroes.png') }}" class="img-fluid me-0" alt="Dashboard Preview">
                    </div>
                </div>
            </div>
        </main>

        <!-- Bootstrap JS Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
