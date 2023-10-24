<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ env('APP_COMPANY') }} | {{ $title }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link rel="icon" href="{{ asset(env('APP_COMPANY_LOGO')) }}" type="image/x-icon" />

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/assets/customer/vendor/aos/aos.css" rel="stylesheet">
    <link href="/assets/customer/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/customer/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/customer/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/assets/customer/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/assets/customer/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/assets/customer/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="/assets/customer/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Bethany
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/bethany-free-onepage-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

    <style>
        .quantity-input {
            display: flex;
            align-items: center;
            width: 150px;
            justify-content: space-between;
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow: hidden;
        }

        .quantity-button {
            width: 30px;
            height: 30px;
            background: #f8f8f8;
            border: none;
            cursor: pointer;
            transition: background 0.3s, color 0.3s;
        }

        .quantity-button:hover {
            background: #357abf;
            color: #fff;
        }

        .quantity-button.plus {
            border-radius: 0 5px 5px 0;
        }

        .quantity-button.minus {
            border-radius: 5px 0 0 5px;
        }

        input[type="number"] {
            height: 30px;
            width: 50px;
            border: none;
            text-align: center;
            border-left: 1px solid #ccc;
            border-right: 1px solid #ccc;
            outline: none;
        }
    </style>
</head>

<body>

    <x-Navbar />
    @yield('containers')
    <x-Footer />
    <!-- Vendor JS Files -->
    <script src="/assets/customer/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="/assets/customer/vendor/aos/aos.js"></script>
    <script src="/assets/customer/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/customer/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="/assets/customer/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="/assets/customer/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="/assets/customer/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="/assets/customer/js/main.js"></script>

    <script src="{{ asset('assets/admin') }}/plugins/jquery/jquery.min.js"></script>
    @stack('scripts')
</body>

</html>
