<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register User</title>

    <!-- Styles -->
    <link href="{{ asset('../css/Register/signup.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Scripts -->

    <!-- Fonts -->

    <style>
        .divider-with-text {
            display: flex;
            align-items: center;
            text-align: center;
            width: 40%;
            margin: 0 auto;
        }

        .divider-with-text::before,
        .divider-with-text::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #ced4da;
            margin: 0 10px;
        }

        .divider-with-text span {
            padding: 0 10px;
            color: #6c757d;
            font-size: 0.9em;
            white-space: nowrap;
        }

        .m-btn-register {
            background-color: #232E66;
            height: 50px;
        }

        .m-btn-register:hover {
            background-color: #232E66;
            cursor: default;
        }

    </style>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5 p-0">
                <img src="../../public/Assets/Images/Register bg.png" alt="Register-bg" class="img-fluid w-100 h-100">
            </div>
            <div class="col-lg-7 d-flex align-items-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="text-center mb-4">

                            </div>
                            <div class="text-center mb-5">
                                <img src="../../public/Assets/Images/Maxy Logo.png" alt="Logo" class="img-fluid w-50">
                                <h1 class="fw-bold">Create an Account</h1>
                                <p class="lead">Are you ready to join us! component variant main layer. Pixel strikethrough style text</p>
                            </div>
                            <form>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter your name">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Enter your email">
                                    <div class="email-text form-text"> We'll never share your email with anyone else.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Enter your password">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="m-btn-register btn w-100 text-white fw-bold">Register</button>
                                </div>
                                <div class="divider-with-text mb-3">
                                    <span>or</span>
                                </div>
                                <div class="mb-3">
                                    <button type="button" class="btn btn-outline-white w-100">
                                        <i class="fab fa-google"></i> Sign up with Google
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
