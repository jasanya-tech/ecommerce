<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset(env('APP_COMPANY_LOGO')) }}" type="image/x-icon" />

    <link rel="stylesheet" href="/assets/customer/auth/fonts/icomoon/style.css">

    <link rel="stylesheet" href="/assets/customer/auth/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/customer/auth/css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="/assets/customer/auth/css/style.css">

    <title>{{ env('APP_COMPANY') }}</title>
</head>

<body>
    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="form-block">
                                <div class="mb-4">
                                    <h3><strong>{{ env('APP_COMPANY') }}</strong> Login </h3>
                                    @if (session()->has('errors'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ session('errors') }}
                                        </div>
                                    @endif
                                </div>
                                <form action="{{ route('auth.login.process') }}" method="post">
                                    @csrf
                                    <div class="form-group first">
                                        <label for="email">email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ old('email') }}" autofocus required>
                                    </div>
                                    <div class="form-group last mb-4">
                                        <label for="password">password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            required>
                                    </div>


                                    <input type="submit" value="Login"
                                        class="btn btn-pill text-white btn-block btn-primary mb-2">
                                    <span>Tidak Mempunyai akun? <a href="/auth/register"
                                            class="text-primary">register</a></span>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <script src="/assets/customer/auth/js/jquery-3.3.1.min.js"></script>
    <script src="/assets/customer/auth/js/popper.min.js"></script>
    <script src="/assets/customer/auth/js/bootstrap.min.js"></script>
    <script src="/assets/customer/auth/js/main.js"></script>
</body>

</html>
