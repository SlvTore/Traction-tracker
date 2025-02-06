<x-guest-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 d-flex align-items-center p-0">
                    <div class="container login-form">
                        <div class="d-flex justify-content-start">
                            <a href="{{ route('home') }}"><img src="{{ asset('images/Maxy-Logo.png') }}" alt="Logo" class="img-fluid mt-3" style="width: 100px; height: auto;"></a>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="text-center mb-5">
                                </div>
                                <div class="text-center mb-4">
                                    <h1 class="fw-bold">Log In</h1>
                                    <p class="lead">Welcome back! Enter your credentials to access your account.</p>
                                </div>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required autofocus>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required autocomplete="current-password">
                                    </div>
                                     <!-- Validation Errors -->
                                     <x-auth-validation-errors class=" alert alert-danger" :errors="$errors" />
                                    <div class="mb-2">
                                        <button type="submit" class="m-btn-login btn w-100 text-white fw-bold">Log In</button>
                                    </div>
                                    <p class="mt-2 text-center">Don't have an account? <a href="{{ route('register') }}">Sign up for free</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>
</x-guest-layout>
