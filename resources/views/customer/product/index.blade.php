@extends('customer.main')

@section('containers')
    <main id="main">

        <section id="products" class="portfolio mt-5">
            <div class="container">
                <div class="section-title d-flex justify-content-between" data-aos="fade-left">
                    <h2>Products</h2>
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
                                <label for="sort-price" class="form-label">Sort by:</label>
                                <select id="sort" class="form-select" name="sort_option">
                                    <option value="">All</option>
                                    <option value="name_asc" @selected(request()->sort_option == 'name_asc')>Name (asc)
                                    </option>
                                    <option value="name_desc" @selected(request()->sort_option == 'name_desc')>Name
                                        (desc)
                                    </option>
                                    <option value="price_asc" @selected(request()->sort_option == 'price_asc')>Price
                                        (asc)
                                    </option>
                                    <option value="price_desc" @selected(request()->sort_option == 'price_desc')>Price
                                        (desc)
                                    </option>
                                    <option value="stock_asc" @selected(request()->sort_option == 'stock_asc')>Stock
                                        (asc)
                                    </option>
                                    <option value="stock_desc" @selected(request()->sort_option == 'stock_desc')>Stock
                                        (desc)
                                    </option>
                                </select>
                            </div>
                            <!-- Search Input -->
                            <div class="mb-3">
                                <label for="search-input" class="form-label">Search Products</label>
                                <input type="text" class="form-control" name="search" id="search-input"
                                    placeholder="Search">
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

                    @foreach ($products as $product)
                        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                            <div class "portfolio-wrap">
                                <a href="{{ route('product.user.show', $product->id) }}">
                                    <img src="{{ FileHelper::getImage('products/' . $product->name . '/' . $product->image[0]->image) }}"
                                        class="img-fluid" alt="">
                                </a>
                                <div class="portfolio-info">
                                    <a href="{{ route('product.user.show', $product->id) }}">
                                        <h4 class="mt-3">{{ $product->name }}</h4>
                                    </a>
                                    <p>{{ GlobalHelper::formatRupiah($product->price) }}</p>
                                    <p><strong>Stock:</strong> {{ $product->stock }} pcs</p>
                                    <div class="portfolio-links">
                                        <form id="addToCartForm_{{ $product->id }}"
                                            action="{{ route('user.cart.store', $product->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="quantity" value="1">
                                            <a href="#" class="portfolio-button" data-product="Product 3"
                                                data-price="14.99" onclick="addToCart({{ $product->id }})">
                                                <i class="bx bx-cart"></i> Add to Cart
                                            </a>
                                        </form>
                                    </div>
                                </div>
                                <div class="portfolio-description">
                                    <p>{{ $product->thumbnail }}
                                    </p>
                                    <a href="{{ route('product.user.show', $product->id) }}"
                                        class="portfolio-details-button"><i class="bx bx-link"></i> Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

    </main>
    @push('scripts')
        <script>
            function addToCart(productId) {
                // Munculkan form dengan JavaScript
                document.getElementById('addToCartForm_' + productId).submit();
            }
        </script>
    @endpush
@endsection
