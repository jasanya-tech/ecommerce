<footer id="footer">

    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-5 col-md-6 footer-contact">
                    <h3>{{ env('APP_COMPANY') }}</h3>
                    <p>
                        Cengkareng <br>
                        Jakarta Barat<br>
                        Indonesia <br><br>
                        <strong>Phone:</strong> +62 895 3220 21652<br>
                        <strong>Email:</strong> zaqiasyifa@gmail.com<br>
                    </p>
                </div>

                <div class="col-lg-4 col-md-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="/#hero">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="/#about">About us</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('product.user.index') }}">Products</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Category</h4>
                    <ul>
                        @foreach ($categories as $category)
                            <li><i class="bx bx-chevron-right"></i> <a
                                    href="{{ route('product.user.index.by.category', $category->id) }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <div class="container d-md-flex py-4">

        <div class="me-md-auto text-center text-md-start">
            <div class="copyright">
                &copy; Copyright <strong><span>{{ env('APP_COMPANY') }}</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
        <div class="social-links text-center text-md-right pt-3 pt-md-0">
            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
    </div>
</footer><!-- End Footer -->
