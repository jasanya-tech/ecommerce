@extends('customer.main')

@section('containers')
    <main id="main">
        <section id="order-list" class="portfolio mt-5">
            <div class="container">
                <div class="section-title" data-aos="fade-left">
                    <h2>Daftar Pesanan</h2>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-md-12">
                        @if ($orders->isEmpty())
                            <p>Daftar pesanan Anda kosong. Silakan <a
                                    href="{{ route('product.user.index') }}">berbelanja</a>.</p>
                        @else
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title" style="color: #009970">Pesanan Anda</h5>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No. Pesanan</th>
                                                    <th scope="col">Tanggal Pemesanan</th>
                                                    <th scope="col">Total Harga</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $order)
                                                    <tr>
                                                        <th scope="row">{{ $order->invoice }}</th>
                                                        <td>{{ $order->created_at->timezone('Asia/Jakarta') }}</td>
                                                        <td>{{ GlobalHelper::formatRupiah($order->total) }}</td>
                                                        <td>{{ $order->status }}</td>
                                                        <td>
                                                            <a href="{{ route('user.order.show', $order->id) }}"
                                                                class="btn btn-primary">Detail</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
