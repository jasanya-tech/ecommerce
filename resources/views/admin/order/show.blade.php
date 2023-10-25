@extends('admin.main')

@section('container')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Detail Order</h1>
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
                                    <label for="name">No. Pesanan</label>
                                    <input type="text" class="form-control" value="{{ $order->invoice }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="stock">Tanggal Pesanan</label>
                                    <input type="text" class="form-control"
                                        value="{{ $order->created_at->timezone('Asia/Jakarta') }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="price">Status</label>
                                    <input type="text" class="form-control" value="{{ $order->status }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="price">Pembayaran</label>
                                    <input type="text" class="form-control" value="{{ $order->payment->name }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="thumbnail">Alamat Pengiriman</label>
                                    <input type="text" class="form-control" value="{{ $order->address }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="thumbnail">Catatan Tambahan</label>
                                    <input type="text" class="form-control" value="{{ $order->additional_note }}"
                                        readonly>
                                </div>

                                <div class="form-group">
                                    <label for="images">Bukti Pembayaran</label>
                                    <div class="col-md-3">
                                        <img src="{{ FileHelper::getImage('orders/' . $order->payment_proof) }}"
                                            class="img-fluid" alt="Product Image">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="images">Produk dalam Pesanan</label>
                                    <div class="row">
                                        @foreach ($order->listOrder as $listOrder)
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <img src="{{ FileHelper::getImage('/products/' . $listOrder->product->name . '/' . $listOrder->product->image[0]->image) }}"
                                                        class="card-img-top" alt="Product Image">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{ $listOrder->product->name }}</h5>
                                                        <p class="card-text">Harga:
                                                            {{ GlobalHelper::formatRupiah($listOrder->product->price) }}</p>
                                                        <p class="card-text">Jumlah: {{ $listOrder->quantity }}</p>
                                                        <p class="card-text">Sub Total:
                                                            {{ GlobalHelper::formatRupiah($listOrder->sub_total) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="total-price">Total Harga Pesanan</label>
                                    <input type="text" class="form-control"
                                        value="{{ GlobalHelper::formatRupiah($order->total) }}" readonly>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="m-1">
                        <a href="{{ route('order.edit', $order->id) }}" class="btn btn-primary">Edit</a>
                    </div>
                    <div class="m-1">
                        <form method="POST" action="{{ route('order.destroy', $order->id) }}">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-danger" href="#"
                                onclick="confirmPopup(this,'Apakah Anda yakin ingin menghapus pesanan ini?');">
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
