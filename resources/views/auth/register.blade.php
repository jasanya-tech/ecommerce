@extends('customer.main')
@section('containers')
    <div class="content pt-5">
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
                                        <input type="email" class="form-control"value="{{ old('email') }}" id="email"
                                            name="email" required>
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
@endsection
