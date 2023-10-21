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
    <link rel="stylesheet" href="/assets/customer/auth/bootstrap.min.css">


    <title>{{ env('APP_COMPANY') }}</title>
</head>

<body>
    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 contents  bg-white py-5 px-5 mt-5 rounded">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="form-block">
                                <div class="mb-4">
                                    <h3><strong>{{ env('APP_COMPANY') }}</strong> Register </h3>
                                    @if (session()->has('warning'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ session('warning') }}
                                        </div>
                                    @endif
                                </div>
                                <form action="{{ route('auth.register.process') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Name</label>
                                        <input type="text" class="form-control" value="{{ old('name') }}"
                                            id="name" name="name" required>
                                        @error('name')
                                            <span class="help-block" style="color:red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" class="form-control"value="{{ old('email') }}"
                                            id="email" name="email" required>
                                        @error('email')
                                            <span class="help-block" style="color:red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="phone_number">No. hp</label>
                                        <input type="text" class="form-control" value="{{ old('phone_number') }}"
                                            id="phone_number" name="phone_number" required>
                                        @error('phone_number')
                                            <span class="help-block" style="color:red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="password">password</label>
                                        <input type="password" class="form-control" value="{{ old('password') }}"
                                            id="password" name="password" required>
                                        @error('password')
                                            <span class="help-block" style="color:red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="password_confirmation">konfirmasi
                                            password</label>
                                        <input type="password" class="form-control"
                                            value="{{ old('password_confirmation') }}" id="password_confirmation"
                                            name="password_confirmation" required>
                                        @error('password_confirmation')
                                            <span class="help-block" style="color:red;">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <input type="submit" value="Register"
                                        class="btn btn-pill text-white btn-block btn-primary mb-2">
                                    <span>Mempunyai akun? <a href="/auth/login" class="text-primary">Login</a></span>
                                </form>
                            </div>
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
