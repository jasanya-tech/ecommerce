@extends('admin.main')

@section('container')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Order</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Order</li>
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
                                        <a href="{{ route('order.create') }}" class="btn btn-primary">Add Order</a>
                                    </div>
                                    <div class="dropdown-filter">
                                        <button type="button" class="btn btn-primary" id="filter-button">
                                            Filter
                                        </button>
                                        <div id="filter-content" class="collapse">
                                            <form action="{{ url()->current() }}" method="GET">
                                                <div class="form-group">
                                                    <label for="filter">Filter by Status:</label>
                                                    <div class="input-group">
                                                        <select id="filter" class="custom-select" name="status_filter">
                                                            <option value="">All</option>
                                                            <option value="Silahkan Lakukan Pembayaran"
                                                                @selected(request()->status_filter == 'Silahkan Lakukan Pembayaran')>
                                                                Silahkan Lakukan Pembayaran
                                                            </option>
                                                            <option value="Pesanan Diproses" @selected(request()->status_filter == 'Pesanan Diproses')>
                                                                Pesanan Diproses
                                                            </option>
                                                            <option value="Pesanan Dikirim" @selected(request()->status_filter == 'Pesanan Dikirim')>
                                                                Pesanan Dikirim
                                                            </option>
                                                            <option value="Pesanan Diterima" @selected(request()->status_filter == 'Pesanan Diterima')>
                                                                Pesanan Diterima
                                                            </option>
                                                            <option value="Pesanan Dibatalkan" @selected(request()->status_filter == 'Pesanan Dibatalkan')>
                                                                Pesanan Dibatalkan
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sort">Sort by:</label>
                                                    <div class="input-group">
                                                        <select id="sort" class="custom-select" name="sort_option">
                                                            <option value="">All</option>
                                                            <option value="created_at_asc" @selected(request()->sort_option == 'created_at_asc')>
                                                                tanggal
                                                                pesanan (asc)
                                                            </option>
                                                            <option value="created_at_desc" @selected(request()->sort_option == 'created_at_desc')>
                                                                tanggal
                                                                pesanan
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
                                            <th>No. Pesanan</th>
                                            <th>Tanggal Pesanan</th>
                                            <th>Total Harga</th>
                                            <th>Status</th>
                                            <th>Pembayaran</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $order->invoice }}</td>
                                                <td>{{ $order->created_at->timezone('Asia/Jakarta') }}</td>
                                                <td>{{ GlobalHelper::formatRupiah($order->total) }}</td>
                                                <td>{{ $order->status }}</td>
                                                <td>{{ $order->payment->name }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-default dropdown-toggle"
                                                            data-toggle="dropdown">
                                                            &#8942; <!-- Ini adalah karakter Unicode untuk tiga titik -->
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item"
                                                                href="{{ route('order.edit', $order->id) }}">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('order.show', $order->id) }}">
                                                                <i class="fas fa-eye"></i> Show
                                                            </a>
                                                            <form action="{{ route('order.destroy', $order->id) }}"
                                                                method="POST" class="delete-form">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a class="dropdown-item" href="#"
                                                                    onclick="confirmPopup(this,'Apakah Anda yakin ingin menghapus pesanan ini?');">
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
                                    {!! $orders->appends($_GET)->links() !!}
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

                @if (request()->search != '' || request()->stock_filter != '' || request()->sort_option != '')
                    $('#filter-content').collapse('toggle');
                    @if (request()->sort_option != '')
                        $('#orderOptions').collapse('toggle');
                    @endif
                @endif
            });
        </script>
    @endpush
@endsection
