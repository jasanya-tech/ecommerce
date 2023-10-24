@extends('customer.main')

@section('containers')
    <main id="main">
        <section id="order-details" class="portfolio mt-5">
            <div class="container">
                <div class="section-title" data-aos="fade-left">
                    <h2>Detail Pesanan</h2>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <span style="color: #009970">
                                        Detail Pesanan #
                                    </span>
                                    {{ $order->invoice }}
                                </h5>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Tanggal Pemesanan</th>
                                            <td>{{ $order->created_at->timezone('Asia/Jakarta') }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Total Harga</th>
                                            <td>{{ GlobalHelper::formatRupiah($order->total) }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Status</th>
                                            <td>{{ $order->status }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Pembayaran</th>
                                            <td>{{ $order->payment->name }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <h5 class="card-title" style="color: #009970">Detail Produk</h5>
                                <div class="table-responsive">
                                    <table class="table  table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nama Produk</th>
                                                <th scope="col">Harga Satuan</th>
                                                <th scope="col">Kuantitas</th>
                                                <th scope="col">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->listOrder as $item)
                                                <tr>
                                                    <td>{{ $item->product->name }}</td>
                                                    <td>{{ GlobalHelper::formatRupiah($item->product->price) }}</td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>{{ GlobalHelper::formatRupiah($item->sub_total) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <h5 class="card-title" style="color: #009970">Alamat Pengiriman</h5>
                                <p>{{ $order->address }}</p>

                                <h5 class="card-title" style="color: #009970">Catatan Tambahan</h5>
                                <p>{{ $order->additional_note }}</p>

                                <h5 class="card-title" style="color: #009970">Bukti Pembayaran</h5>
                                @if ($order->payment_proof)
                                    <img src="{{ FileHelper::getImage('orders/' . $order->payment_proof) }}"
                                        class="img-fluid" alt="Bukti Pembayaran">
                                @else
                                    <p>Bukti pembayaran belum diunggah.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
