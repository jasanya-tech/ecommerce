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
                     <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                     <li><a class="nav-link scrollto" href="#about">About</a></li>
                     <li><a class="nav-link scrollto" href="#services">Services</a></li>
                     <li><a class="nav-link scrollto " href="#portfolio">Portfolio</a></li>
                     <li><a class="nav-link scrollto" href="#team">Team</a></li>
                     <li class="dropdown">
                         <a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
                         <ul>
                             <li><a href="#">Drop Down 1</a></li>
                             <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i
                                         class="bi bi-chevron-right"></i></a>
                                 <ul>
                                     <li><a href="#">Deep Drop Down 1</a></li>
                                     <li><a href="#">Deep Drop Down 2</a></li>
                                     <li><a href="#">Deep Drop Down 3</a></li>
                                     <li><a href="#">Deep Drop Down 4</a></li>
                                     <li><a href="#">Deep Drop Down 5</a></li>
                                 </ul>
                             </li>
                             <li><a href="#">Drop Down 2</a></li>
                             <li><a href="#">Drop Down 3</a></li>
                             <li><a href="#">Drop Down 4</a></li>
                         </ul>
                     </li>
                     <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                     {{-- <li><a class="getstarted scrollto" href="#about">Get Started</a></li> --}}
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
                                 <li><a class="dropdown-item" href="#">Profil Saya</a></li>
                                 <li><a class="dropdown-item" href="#">Pengaturan</a></li>
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
