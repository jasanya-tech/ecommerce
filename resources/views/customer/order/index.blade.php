@extends('customer.main')

@section('containers')
    <main id="main">
        <section id="order-list" class="portfolio mt-5">
            <div class="container">
                <div class="section-title d-flex justify-content-between" data-aos="fade-left">
                    <h2>Daftar Pesanan</h2>
                    <div class="d-flex">
                        <div class="dropdown m-2">
                            <button class="btn btn-secondary" type="button" data-bs-toggle="collapse"
                                data-bs-target="#filter-collapse" aria-expanded="false" aria-controls="filter-collapse">
                                Filter
                            </button>
                        </div>
                    </div>
                </div>


                <!-- Filter Collapse - Hidden by default -->
                <div class="collapse mb-2" id="filter-collapse">
                    <div class="card card-body">
                        <form action="">
                            <!-- Sort by Price -->
                            <div class="mb-3">
                                <label for="sort">Sort by:</label>
                                <div class="input-group">
                                    <select id="sort" class="form-select" name="sort_option">
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
                            <div class="mb-3">
                                <label for="filter">Filter by Status:</label>
                                <select id="filter" class="form-select" name="status_filter">
                                    <option value="">All</option>
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

                            <div class="d-flex justify-content-left">
                                <button type="submit" class="btn btn-primary m-1" id="apply-button">
                                    Apply
                                </button>
                                <a href="{{ url()->current() }}" class="btn btn-secondary m-1" id="clear-button">
                                    Clear
                                </a>
                            </div>
                        </form>
                    </div>
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
