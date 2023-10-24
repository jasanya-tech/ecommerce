@extends('customer.main')

@section('containers')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Product Details</h2>
                    <ol>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Product Details</li>
                    </ol>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= Portfolio Details Section ======= -->
        <section id="portfolio-details" class="portfolio-details">
            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-8">
                        <div class="portfolio-details-slider swiper">
                            <div class="swiper-wrapper align-items-center">

                                @foreach ($product->image as $image)
                                    <div class="swiper-slide">
                                        <img
                                            src="{{ FileHelper::getImage('products/' . $product->name . '/' . $image->image) }}">
                                    </div>
                                @endforeach

                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="portfolio-info">
                            <h3>Product information</h3>
                            <ul>
                                <li><strong>Category</strong>: {{ $product->category->name }}</li>
                                <li><strong>Price</strong>: {{ GlobalHelper::formatRupiah($product->price) }}</li>
                                <li><strong>Stock</strong>: {{ $product->stock }} pcs</li>
                            </ul>
                            <form action="{{ route('user.cart.store', $product->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantity:</label>
                                    <div class="input-group quantity-input">
                                        <button type="button" class="quantity-button minus"
                                            onclick="decreaseQuantity()">-</button>
                                        <input type="number" id="quantity" name="quantity" class="form-control"
                                            min="1" value="1" max="{{ $product->stock }}">
                                        <button type="button" class="quantity-button plus"
                                            onclick="increaseQuantity()">+</button>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                                <a href="{{ route('user.order.create', $product->id) }}" class="btn btn-success">Beli
                                    Sekarang</a>
                            </form>
                        </div>
                        <div class="portfolio-description">
                            <h2>Deskripsi</h2>
                            <p>
                                {!! $product->description !!}
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Portfolio Details Section -->

    </main><!-- End #main -->
    @push('scripts')
        <script>
            function decreaseQuantity() {
                var quantityInput = document.getElementById("quantity");
                if (quantityInput.value > 1) {
                    quantityInput.value = parseInt(quantityInput.value) - 1;
                }
            }

            function increaseQuantity(stock) {
                var quantityInput = document.getElementById("quantity");
                if (!parseInt(quantityInput.value) >= stock) {
                    quantityInput.value = parseInt(quantityInput.value) + 1;
                } else if (parseInt(quantityInput.value) >= stock) {
                    quantityInput.value = stock;
                } else {
                    quantityInput.value = parseInt(quantityInput.value) + 1;
                }
            }
        </script>
    @endpush
@endsection
