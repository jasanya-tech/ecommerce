@extends('admin.main')

@section('container')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
                            <li class="breadcrumb-item active">Edit User</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @if (session('message'))
                            <div class="mb-5 alert alert-{{ session('status') }} alert-dismissible">
                                {{ session('message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true" class="btn btn-sm btn-dark">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="card card-primary">
                            <form action="{{ route('user.update', $user->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" class="form-control" value="{{ old('name', $user->name) }}"
                                            id="name" name="name" placeholder="Masukan Name Kategori">
                                        @error('name')
                                            <span class="help-block" style="color:red;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" value="{{ old('email', $user->email) }}"
                                            id="email" name="email" placeholder="Masukan email">
                                        @error('email')
                                            <span class="help-block" style="color:red;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="phone_number">Nomer Handphone</label>
                                        <input type="text" class="form-control"
                                            value="{{ old('phone_number', $user->phone_number) }}" id="phone_number"
                                            name="phone_number" placeholder="Masukan Nomer Handphone">
                                        @error('phone_number')
                                            <span class="help-block" style="color:red;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="text" class="form-control" value="{{ old('password') }}"
                                            id="password" name="password" placeholder="Masukan Nomer Handphone">
                                        @error('password')
                                            <span class="help-block" style="color:red;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="role" value="1"
                                                id="admin" @checked(old('role', $user->role) == 1)>
                                            <label class="form-check-label" for="admin">
                                                Admin
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="role" value="2"
                                                id="member" @checked(old('role', $user->role) == 2)>
                                            <label class="form-check-label" for="member">
                                                Member
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputFile">File input</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="image" class="custom-file-input"
                                                    id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                        </div>
                                        @error('image')
                                            <span class="help-block" style="color:red;">{{ $message }}</span>
                                        @enderror
                                        <p>*kosongkan jika tidak ingin update image</p>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    @push('scripts')
        <script>
            $(function() {
                bsCustomFileInput.init();
            });
        </script>
    @endpush
@endsection
