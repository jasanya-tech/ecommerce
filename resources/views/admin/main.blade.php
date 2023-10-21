<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_COMPANY') }}</title>
    <link rel="icon" href="{{ asset(env('APP_COMPANY_LOGO')) }}" type="image/x-icon" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/dist/css/adminlte.min.css">
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        @include('admin.partials.navbar')
        @include('admin.partials.sidebar')

        @yield('container')
        @include('admin.partials.footer')
    </div>
    <script src="{{ asset('assets/admin') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets/admin') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('assets/admin') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/admin') }}/dist/js/adminlte.js"></script>

    <!-- jQuery Mapael -->
    <script src="{{ asset('assets/admin') }}/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="{{ asset('assets/admin') }}/plugins/raphael/raphael.min.js"></script>
    <script src="{{ asset('assets/admin') }}/plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="{{ asset('assets/admin') }}/plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="{{ asset('assets/admin') }}/plugins/chart.js/Chart.min.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('assets/admin') }}/dist/js/demo.js"></script>
    <script src="{{ asset('assets/admin') }}/dist/js/pages/dashboard2.js"></script>

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
</body>
