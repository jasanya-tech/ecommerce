<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset(env('APP_COMPANY_LOGO')) }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ env('APP_COMPANY') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/images/users/{{ auth()->user()->image }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ GlobalHelper::isCurrentUrl('admin') }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header"></li>
                <li class="nav-item {{ GlobalHelper::isCurrentUrl('admin/master/*', 'menu-open') }}">
                    <a href="#" class="nav-link {{ GlobalHelper::isCurrentUrl('admin/master/*') }}">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Master Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{ route('category.index') }}"
                                class="nav-link {{ GlobalHelper::isCurrentUrl('admin/master/category*') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kategori Product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('product.index') }}"
                                class="nav-link {{ GlobalHelper::isCurrentUrl('admin/master/product*') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}"
                                class="nav-link {{ GlobalHelper::isCurrentUrl('admin/master/user*') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('order.index') }}"
                                class="nav-link {{ GlobalHelper::isCurrentUrl('admin/master/order*') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Order</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ GlobalHelper::isCurrentUrl('admin/report/*', 'menu-open') }}">
                    <a href="#" class="nav-link {{ GlobalHelper::isCurrentUrl('admin/report/*') }}">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- <li class="nav-item ">
                            <a href="{{ route('report.index.pengiriman') }}"
                                class="nav-link {{ GlobalHelper::isCurrentUrl('admin/report/pengiriman*') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pengiriman</p>
                            </a>
                        </li> --}}
                        <li class="nav-item ">
                            <a href="{{ route('report.index.transaction') }}"
                                class="nav-link {{ GlobalHelper::isCurrentUrl('admin/report/transaction*') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Transaction</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
