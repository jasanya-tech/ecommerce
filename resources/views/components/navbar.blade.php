 <header id="header" class="fixed-top d-flex align-items-center">
     <div class="container">
         <div class="header-container d-flex align-items-center justify-content-between">
             <div class="logo">
                 <h1 class="text-light"><a href="{{ route('home') }}"><span>{{ env('APP_COMPANY') }}</span></a></h1>
                 <!-- Uncomment below if you prefer to use an image logo -->
                 <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
             </div>

             <nav id="navbar" class="navbar">
                 <ul>
                     <li><a class="nav-link scrollto {{ GlobalHelper::isCurrentUrl('') }}" href="/#hero">Home</a>
                     </li>
                     <li><a class="nav-link scrollto" href="/#about">About</a></li>
                     <li class="dropdown">
                         <a href="{{ route('product.user.index') }}"
                             class="{{ GlobalHelper::isCurrentUrl('product*') }}"><span>Products</span> <i
                                 class="bi bi-chevron-down"></i></a>
                         <ul>
                             @foreach ($categories as $category)
                                 <li><a class="{{ GlobalHelper::isCurrentUrl('product/category/' . $category->id) }}"
                                         href="{{ route('product.user.index.by.category', $category->id) }}">{{ $category->name }}</a>
                                 </li>
                             @endforeach
                         </ul>
                     </li>
                     <li><a class="nav-link scrollto {{ GlobalHelper::isCurrentUrl('cart*') }}"
                             href="{{ route('user.cart.index') }}">Cart</a></li>
                     <li><a class="nav-link scrollto {{ GlobalHelper::isCurrentUrl('order*') }}"
                             href="{{ route('user.order.index') }}">Order</a></li>
                     <li><a class="nav-link scrollto" href="/#contact">Contact</a></li>
                     @if (auth()->user())
                         <li class="dropdown">
                             <a class="dropdown-toggle me-3" href="#" id="userDropdown" role="button"
                                 data-bs-toggle="dropdown" aria-expanded="false">
                                 <img src="{{ FileHelper::getImage('users/' . auth()->user()->image) }}"
                                     alt="User Profile" class="img-fluid rounded-circle"
                                     style="width: 30px; height: 30px;">
                             </a>
                             <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                 <!-- Isi dropdown menu untuk pengguna di sini -->
                                 <li><a class="dropdown-item" href="{{ route('profile.index') }}">Profil Saya</a></li>
                                 <li><a class="dropdown-item" href="{{ route('auth.logout') }}">Keluar</a></li>
                             </ul>
                         </li>
                     @else
                         <li><a class="getstarted scrollto" href="{{ route('auth.login') }}">Login</a></li>
                     @endif

                 </ul>
                 <i class="bi bi-list mobile-nav-toggle"></i>
             </nav><!-- .navbar -->

         </div><!-- End Header Container -->
     </div>
 </header><!-- End Header -->
