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
                                    <div class="dropdown-filter">
                                        <button type="button" class="btn btn-primary" id="filter-button">
                                            Print
                                        </button>

                                        <div id="filter-content" class="collapse">
                                            <a class="dropdown-item"
                                                href="{{ route('report.print.transaction', ['type' => 'pdf']) }}">pdf</a>
                                            <a class="dropdown-item"
                                                href="{{ route('report.print.transaction', ['type' => 'excel']) }}">excel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">No</th>
                                                <th>No. Pesanan</th>
                                                <th>No. Resi</th>
                                                <th>Tanggal Pesanan</th>
                                                <th>Total Harga</th>
                                                <th>Status</th>
                                                <th>Pembayaran</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <a href="{{ route('order.show', $order->id) }}" target="_blank">
                                                            {{ $order->invoice }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $order->no_resi }}</td>
                                                    <td>{{ $order->created_at->timezone('Asia/Jakarta') }}</td>
                                                    <td>{{ GlobalHelper::formatRupiah($order->total) }}</td>
                                                    <td>{{ $order->status }}</td>
                                                    <td>{{ $order->payment->name }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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
