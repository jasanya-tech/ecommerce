@extends('admin.main')

@section('container')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Detail User</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="stock">Email</label>
                                    <input type="text" class="form-control" value="{{ $user->email }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="phone_number">Nomor Handphone</label>
                                    <input type="text" class="form-control" value="{{ $user->phone_number }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="thumbnail">Role</label>
                                    <input type="text" class="form-control"
                                        value="{{ $user->role == 1 ? 'admin' : 'member' }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="images">Images</label>
                                    <div class="row">
                                        @if ($user->image)
                                            <img src="{{ FileHelper::getImage('users/' . $user->image) }}" class="img-fluid"
                                                alt="User Image">
                                        @else
                                            <p>No image available</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="m-1">
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                    </div>
                    <div class="m-1">
                        <form method="POST" action="{{ route('user.destroy', $user->id) }}">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-danger" href="#"
                                onclick="confirmPopup(this,'Apakah Anda yakin ingin menghapus user ini, jika anda menghapus user ini, maka data pesanan akan dihapus?');">
                                Delete
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
