@extends('admin.main')

@section('container')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">User</li>
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
                                        <a href="{{ route('user.create') }}" class="btn btn-primary">Add User</a>
                                    </div>
                                    <div class="dropdown-filter">
                                        <button type="button" class="btn btn-primary" id="filter-button">
                                            Filter
                                        </button>
                                        <div id="filter-content" class="collapse">
                                            <form action="{{ url()->current() }}" method="GET">
                                                <div class="form-group">
                                                    <label for="filter">Filter by Role:</label>
                                                    <div class="input-group">
                                                        <select id="filter" class="custom-select" name="role">
                                                            <option value="">All</option>
                                                            <option value="admin" @selected(request()->role == 'admin')>Admin
                                                            </option>
                                                            <option value="member" @selected(request()->role == 'member')>Member
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="search">Search:</label>
                                                    <div class="input-group">
                                                        <input type="text" id="search" name="search"
                                                            value="{{ request()->search }}" class="form-control"
                                                            placeholder="Search...">
                                                        <div class="input-group-append">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sort">Sort by:</label>
                                                    <div class="input-group">
                                                        <select id="sort" class="custom-select" name="sort_option">
                                                            <option value="">All</option>
                                                            <option value="name_asc" @selected(request()->sort_option == 'name_asc')>Name (asc)
                                                            </option>
                                                            <option value="name_desc" @selected(request()->sort_option == 'name_desc')>Name
                                                                (desc)
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-left">
                                                    <button type="submit" class="btn btn-primary m-1" id="apply-button">
                                                        Apply
                                                    </button>
                                                    <a href="{{ url()->current() }}" class="btn btn-secondary m-1"
                                                        id="clear-button">
                                                        Clear
                                                    </a>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Nomer Handphone</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone_number }}</td>
                                                <td>{{ $user->role == 1 ? 'admin' : 'member' }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-default dropdown-toggle"
                                                            data-toggle="dropdown">
                                                            &#8942; <!-- Ini adalah karakter Unicode untuk tiga titik -->
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item"
                                                                href="{{ route('user.edit', $user->id) }}">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('user.show', $user->id) }}">
                                                                <i class="fas fa-eye"></i> Show
                                                            </a>
                                                            <form action="{{ route('user.destroy', $user->id) }}"
                                                                method="POST" class="delete-form">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a class="dropdown-item" href="#"
                                                                    onclick="confirmPopup(this,'Apakah Anda yakin ingin menghapus user ini, jika anda menghapus user ini, maka data pesanan akan dihapus?');">
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
                                    {!! $users->appends($_GET)->links() !!}
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
    @push('scripts')
        <script>
            $(document).ready(function() {
                // Sembunyikan filter saat halaman dimuat
                $('#filter-content').collapse('hide');

                // Tampilkan atau sembunyikan filter saat tombol "Filter" ditekan
                $('#filter-button').on('click', function() {
                    $('#filter-content').collapse('toggle');
                });

                @if (request()->search != '' || request()->role != '' || request()->sort_option != '')
                    $('#filter-content').collapse('toggle');
                    @if (request()->sort_option != '')
                        $('#orderOptions').collapse('toggle');
                    @endif
                @endif
            });
        </script>
    @endpush
@endsection
