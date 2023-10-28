@extends('customer.main')

@section('containers')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">
            <a href="#about" class="btn-get-started scrollto">Get Started</a>
        </div>
    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container">

                <div class="row content">
                    <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                        <h2>Tentang Kami</h2>
                        <h3>Selamat datang di {{ env('APP_COMPANY') }}</h3>
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-left" data-aos-delay="200">
                        <p>
                            Kami adalah tujuan terbaik untuk semua kebutuhan furnitur Anda. Di {{ env('APP_COMPANY') }},
                            kami
                            memahami betapa pentingnya furnitur dalam menciptakan suasana yang nyaman dan indah di rumah
                            Anda. Itulah mengapa kami berkomitmen untuk menyediakan koleksi furnitur berkualitas tinggi
                            dengan berbagai gaya, desain, dan harga yang sesuai dengan berbagai kebutuhan dan anggaran.
                        </p>
                        <ul>
                            <li><i class="ri-check-double-line"></i> Koleksi Luas, Kami menawarkan beragam pilihan furnitur,
                                mulai dari sofa, meja, kursi, lemari, tempat tidur, hingga dekorasi rumah
                            </li>
                            <li><i class="ri-check-double-line"></i>Kualitas Terbaik, Kami hanya bekerja dengan produsen
                                furnitur terkemuka yang mengutamakan kualitas</li>
                            <li><i class="ri-check-double-line"></i> Harga Terjangkau, Kami tahu bahwa anggaran adalah
                                pertimbangan utama dalam setiap pembelian</li>
                        </ul>
                        <p class="fst-italic">
                            Terima kasih telah memilih {{ env('APP_COMPANY') }} sebagai destinasi furnitur Anda. Kami
                            berharap
                            dapat membantu Anda mengubah rumah Anda menjadi tempat yang Anda impikan
                        </p>
                    </div>
                </div>

            </div>
        </section><!-- End About Section -->

        <!-- ======= Counts Section ======= -->
        <section id="counts" class="counts">
            <div class="container">

                <div class="row counters">

                    <div class="col-lg-6 col-6 text-center">
                        <span data-purecounter-start="0" data-purecounter-end="{{ $countCategory }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Category</p>
                    </div>

                    <div class="col-lg-6 col-6 text-center">
                        <span data-purecounter-start="0" data-purecounter-end="{{ $countProduct }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Product</p>
                    </div>

                </div>

            </div>
        </section><!-- End Counts Section -->

        {{-- <!-- ======= Why Us Section ======= -->
        <section id="why-us" class="why-us">
            <div class="container">

                <div class="row">
                    <div class="col-lg-4 d-flex align-items-stretch" data-aos="fade-right">
                        <div class="content">
                            <h3>Why Choose Bethany for your company website?</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit
                                Asperiores dolores sed et. Tenetur quia eos. Autem tempore quibusdam vel necessitatibus
                                optio ad corporis.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-8 d-flex align-items-stretch">
                        <div class="icon-boxes d-flex flex-column justify-content-center">
                            <div class="row">
                                <div class="col-xl-4 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                                    <div class="icon-box mt-4 mt-xl-0">
                                        <i class="bx bx-receipt"></i>
                                        <h4>Corporis voluptates sit</h4>
                                        <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut
                                            aliquip</p>
                                    </div>
                                </div>
                                <div class="col-xl-4 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="200">
                                    <div class="icon-box mt-4 mt-xl-0">
                                        <i class="bx bx-cube-alt"></i>
                                        <h4>Ullamco laboris ladore pan</h4>
                                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                                            deserunt</p>
                                    </div>
                                </div>
                                <div class="col-xl-4 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="300">
                                    <div class="icon-box mt-4 mt-xl-0">
                                        <i class="bx bx-images"></i>
                                        <h4>Labore consequatur</h4>
                                        <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End .content-->
                    </div>
                </div>

            </div>
        </section><!-- End Why Us Section --> --}}

        <section id="products" class="portfolio">
            <div class="container">
                <div class="section-title" data-aos="fade-left">
                    <h2>Products</h2>
                    <a href="{{ route('product.user.index') }}">
                        <p>Telusuri Semua Product</p>
                    </a>
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

        <section id="contact" class="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4" data-aos="fade-right">
                        <div class="section-title">
                            <h2>Contact</h2>
                            <p>Selamat datang di halaman kontak kami. Kami sangat senang mendengar dari Anda. Gunakan
                                informasi kontak di bawah ini untuk menghubungi kami, memberikan umpan balik, atau
                                mengajukan
                                pertanyaan. Tim kami siap untuk membantu Anda dengan permintaan Anda. Jangan ragu untuk
                                menghubungi kami, dan kami akan merespons secepat mungkin. Terima kasih atas kunjungan Anda!
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
                        <iframe style="border:0; width: 100%; height: 270px;"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.3527724123894!2d106.73053351431124!3d-6.139060411097965!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f7edca42a809%3A0xf7721d9e6310e565!2sKecamatan%20Cengkareng%2C%20Kota%20Jakarta%20Barat%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sen!2sid!4v1669436057778!5m2!1sen!2sid"
                            frameborder="0" allowfullscreen></iframe>
                        <div class="info mt-4">
                            <i class="bi bi-geo-alt"></i>
                            <h4>Location:</h4>
                            <p>Cengkareng, Jakarta Barat Indonesia</p>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mt-4">
                                <div class="info">
                                    <i class="bi bi-envelope"></i>
                                    <h4>Email:</h4>
                                    <p>zaqiasyifa@gmail.com</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="info w-100 mt-4">
                                    <i class="bi bi-phone"></i>
                                    <h4>Call:</h4>
                                    <p>+62 895 3220 21652</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    @push('scripts')
        <script>
            function addToCart(productId) {
                // Munculkan form dengan JavaScript
                document.getElementById('addToCartForm_' + productId).submit();
            }
        </script>
    @endpush
@endsection
