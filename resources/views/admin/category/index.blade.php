@extends('admin.main')

@section('container')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Kategori</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Kategori</li>
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
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between mb-3">
                                    <div>
                                        <a href="{{ route('category.create') }}" class="btn btn-primary">Add Category</a>
                                    </div>
                                    <div>
                                        <form action="{{ url()->current() }}" method="GET" class="form-inline">
                                            <div class="input-group">
                                                <input type="text" name="search" class="form-control"
                                                    placeholder="Search..." value="{{ request()->search }}">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                            @if (request()->search != '')
                                                <a href="{{ url()->current() }}" class="btn btn-secondary ml-2">Clear
                                                    Search</a>
                                            @endif
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">No</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-default dropdown-toggle"
                                                            data-toggle="dropdown">
                                                            &#8942; <!-- Ini adalah karakter Unicode untuk tiga titik -->
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item"
                                                                href="{{ route('category.edit', $category->id) }}">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </a>
                                                            <form action="{{ route('category.destroy', $category->id) }}"
                                                                method="POST" class="delete-form">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a class="dropdown-item" href="#"
                                                                    onclick="confirmPopup(this,'Apakah Anda yakin ingin menghapus kategori ini, jika anda menghapus kategori ini, maka data product yang berkategori ini akan dihapus?');">
                                                                    <i class="fas fa-trash-alt"></i> Delete
                                                                </a>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    {!! $categories->appends($_GET)->links() !!}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
