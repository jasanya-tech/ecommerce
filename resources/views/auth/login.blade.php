@extends('customer.main')
@section('containers')
    <div class="content pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 contents py-5 px-5 mt-5 rounded">
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
                                        <input type="password" class="form-control" id="password" name="password" required>
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
@endsection
