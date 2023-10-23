<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="{{ route('admin.dashboard') }}" role="button"><i
                    class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="{{ route('auth.logout') }}" role="button">
                {{-- <i class="fas fa-expand-arrows-alt"></i> --}}
                logout
            </a>
        </li>
    </ul>
</nav>
