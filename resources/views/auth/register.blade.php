<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/customer/auth') }}/fonts/icomoon/style.css">

    <link rel="stylesheet" href="{{ asset('assets/customer/auth') }}/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/customer/auth') }}/css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('assets/customer/auth') }}/css/style.css">

    <title>Login #7</title>
</head>

<body>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('assets/customer/auth') }}/images/undraw_remotely_2j6y.svg" alt="Image"
                        class="img-fluid">
                </div>
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h3>{{ env('APP_COMPANY') }} Register</h3>
                                {{-- <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur
                                    adipisicing.</p> --}}
                            </div>
                            <form action="{{ route('auth.register.process') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                        class="form-control" id="name">
                                </div>
                                @error('name')
                                    <span class="help-block" style="color:red;">{{ $message }}</span>
                                    <br>
                                @enderror
                                <br>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" value="{{ old('email') }}"
                                        class="form-control" id="email">
                                </div>
                                @error('email')
                                    <span class="help-block" style="color:red;">{{ $message }}</span>
                                    <br>
                                @enderror
                                <br>
                                <div class="form-group">
                                    <label for="phone_number">No. hp</label>
                                    <input type="text" name="phone_number" value="{{ old('phone_number') }}"
                                        class="form-control" id="phone_number">
                                </div>
                                @error('phone_number')
                                    <span class="help-block" style="color:red;">{{ $message }}</span>
                                    <br>
                                @enderror
                                <br>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" value="{{ old('password') }}"
                                        class="form-control" id="password">
                                </div>
                                @error('password')
                                    <span class="help-block" style="color:red;">{{ $message }}</span>
                                    <br>
                                @enderror
                                <br>
                                <div class="form-group">
                                    <label for="password_confirmation">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation"
                                        value="{{ old('password_confirmation') }}" class="form-control"
                                        id="password_confirmation">
                                </div>
                                @error('password_confirmation')
                                    <span class="help-block" style="color:red;">{{ $message }}</span>
                                @enderror
                                <br>

                                <input type="submit" value="Register" class="btn btn-block btn-primary">
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <script src="{{ asset('assets/customer/auth') }}/js/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('assets/customer/auth') }}/js/popper.min.js"></script>
    <script src="{{ asset('assets/customer/auth') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/customer/auth') }}/js/main.js"></script>
</body>

</html>
