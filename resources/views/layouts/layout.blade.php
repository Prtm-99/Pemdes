@php
    $desa = App\Desa::find(1);
@endphp
<!--
=========================================================
* Argon Dashboard - v1.1.2
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2020 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ url('') }}">

    <title>@yield('title')</title>

    <!-- Favicon -->
    <link href="{{ asset(optional($desa)->logo ? Storage::url($desa->logo) : 'favicon.png') }}" rel="icon" type="image/png">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="{{ asset('/js/plugins/nucleo/css/nucleo.css') }}" rel="stylesheet">
    <link href="{{ asset('/js/plugins/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    <!-- CSS Files -->
    <link href="{{ asset('/css/argon-dashboard.css?v=1.1.2') }}" rel="stylesheet">

    @yield('styles')
</head>
<style>
    /* Header Styles */
    header.navbar {
        z-index: 1000;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 70px;
        background: blur !important;
        transition: background 0.3s ease, padding 0.3s ease;
        display: flex;
        align-items: center;
        padding: 0 20px;
    }

    header.navbar.scrolled {
        background: linear-gradient(135deg, #1c4e80, #0865FE) !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    header.navbar h1 {
        font-family: 'Poppins', sans-serif !important;
        font-weight: 600;
        color: white !important;
        margin: 0;
        font-size: 1.5rem;
        transition: all 0.3s ease;
    }

    /* Centered Navigation */
    .navbar-center {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
    }

    .nav-link {
        font-family: 'Poppins', sans-serif !important;
        font-weight: 500;
        position: relative;
        color: white !important;
        padding: 10px 15px;
    }

    .nav-link.active {
        font-weight: 700;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -5px;
        left: 50%;
        background-color: white;
        transition: width 0.3s ease, left 0.3s ease;
    }

    .nav-link:hover::after {
        width: 100%;
        left: 0;
    }

    /* Mobile Menu Button */
    .navbar-toggler {
        border: none;
        padding: 0.5rem;
    }

    .navbar-toggler:focus {
        outline: none;
    }

    /* Footer Styles */
    .footer {
        flex-shrink: 0;
        background: linear-gradient(135deg, #1c4e80, #0865FE);
        color: white;
        padding: 3rem 0;
    }

    .footer h5,
    .footer .font-weight-bold {
        color: white !important;
    }

    .copyright {
        background-color: white;
        width: 100%;
        text-align: center;
        padding: 10px 0;
        font-weight: 600;
    }

    /* Mobile Sidebar */
    .sidebar-mobile {
        position: fixed;
        top: 0;
        left: -300px;
        width: 250px;
        height: 100%;
        background: linear-gradient(135deg, #1c4e80, #0865FE);
        color: white;
        transition: left 0.3s ease;
        z-index: 1001;
        overflow-y: auto;
    }

    .sidebar-mobile.active {
        left: 0;
    }

    .sidebar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        background-color: white;
    }

    .sidebar-header h3 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 600;
        color: #1c4e80;
    }

    .close-btn {
        background: none;
        border: none;
        color: #1c4e80;
        font-size: 1.5rem;
        cursor: pointer;
    }

    .sidebar-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar-menu li {
        padding: 10px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        transition: background 0.3s ease;
    }

    .sidebar-menu li:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    .sidebar-menu li a {
        color: white;
        text-decoration: none;
        display: flex;
        align-items: center;
        font-size: 1rem;
    }

    .sidebar-menu li a i {
        margin-right: 10px;
        font-size: 1.2rem;
    }

    /* Overlay */
    .overlay-mobile {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        display: none;
    }

    .overlay-mobile.active {
        display: block;
    }

    /* Responsive Adjustments */
    @media (max-width: 991.98px) {
        .navbar-center {
            position: static;
            left: auto;
            transform: none;
            width: 100%;
            margin-top: 10px;
        }
        
        .navbar-nav {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    @media (min-width: 768px) {
        .sidebar-mobile {
            display: none;
        }
        .overlay-mobile {
            display: none;
        }
    }
</style>
<body>
    <!-- Sidebar for Mobile -->
    <div class="sidebar-mobile" id="sidebar-mobile">
        <div class="sidebar-header">
            <h3>Menu</h3>
            <button class="close-btn" id="close-sidebar-mobile">&times;</button>
        </div>
        <ul class="sidebar-menu">
            <li>
                <a class="nav-link @if (Request::routeIs('home.index')) active @endif" href="{{ route('home.index') }}">
                    <span class="nav-link-inner--text">Beranda</span>
                </a>
            </li>
            <li>
                <a class="nav-link @if (Request::segment(1) == 'pemerintahan-desa') active @endif" href="{{ route('pemerintahan-desa') }}">
                    <span class="nav-link-inner--text">Informasi</span>
                </a>
            </li>
            <li>
                <a class="nav-link @if (Request::segment(1) == 'berita') active @endif" href="{{ route('berita') }}">
                    <span class="nav-link-inner--text">Berita</span>
                </a>
            </li>
            <li>
                <a class="nav-link @if (Request::segment(1) == 'gallery') active @endif" href="{{ route('gallery') }}">
                    <span class="nav-link-inner--text">Gallery</span>
                </a>
            </li>
            <li>
                <a class="nav-link @if (Request::segment(1) == 'umkm') active @endif" href="{{ route('umkm.show', ['umkm' => $umkm->id ?? 1]) }}">
                    <span class="nav-link-inner--text">UMKM</span>
                </a>
            </li>
            @php
                $firstPopulation = \App\Population::first();
            @endphp
            @if ($firstPopulation)
                <li>
                    <a class="nav-link @if (Request::segment(1) == 'populations') active @endif" href="{{ route('populations.show', $firstPopulation->id) }}">
                        <span class="nav-link-inner--text">Lihat Populasi</span>
                    </a>
                </li>
            @endif
            @auth
                <li>
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <span class="nav-link-inner--text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('keluar') }}" onclick="event.preventDefault(); document.getElementById('form-keluar').submit();">
                        <span class="nav-link-inner--text">Keluar</span>
                    </a>
                    <form id="form-keluar" action="{{ route('keluar') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endauth
        </ul>
    </div>

    <!-- Overlay for Mobile -->
    <div class="overlay-mobile" id="overlay-mobile"></div>

    <!-- Header -->
    <header class="navbar navbar-expand-lg navbar-light fixed-top" 
            x-data="{ scrolled: false }" 
            x-on:scroll.window="scrolled = (window.scrollY > 50)"
            x-bind:class="{ 'scrolled': scrolled }">
        <div class="container-fluid">
            <!-- Logo and Village Name -->
            <div class="d-flex align-items-center">
                <img height="55px" src="{{ optional($desa)->logo ? url(Storage::url($desa->logo)) : url('/storage/Logo0.png') }}" alt="logo" class="mr-3">
                <h1 class="text-base font-weight-600 text-uppercase">{{ $desa->nama_desa ?? 'Desa Sukorejo' }}</h1>
            </div>

            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" id="navbar-toggler">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Desktop Navigation - Centered -->
            <div class="collapse navbar-collapse" id="navbar-collapse-main">
                <div class="navbar-center">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link nav-link-icon font-weight-bold @if (Request::routeIs('home.index')) active @endif" 
                               href="{{ route('home.index') }}">
                                <span class="nav-link-inner--text">Beranda</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-icon font-weight-bold @if (Request::segment(1) == 'pemerintahan-desa') active @endif" 
                               href="{{ route('pemerintahan-desa') }}">
                                <span class="nav-link-inner--text">Informasi</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-icon font-weight-bold @if (Request::segment(1) == 'berita') active @endif" 
                               href="{{ route('berita') }}">
                                <span class="nav-link-inner--text">Berita</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-icon font-weight-bold @if (Request::segment(1) == 'gallery') active @endif" 
                               href="{{ route('gallery') }}">
                                <span class="nav-link-inner--text">Gallery</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-icon font-weight-bold @if (Request::segment(1) == 'umkm') active @endif" 
                               href="{{ route('umkm.show', ['umkm' => $umkm->id ?? 1]) }}">
                                <span class="nav-link-inner--text">UMKM</span>
                            </a>
                        </li>
                        @php
                            $firstPopulation = \App\Population::first();
                        @endphp
                        @if ($firstPopulation)
                            <li class="nav-item">
                                <a class="nav-link nav-link-icon font-weight-bold @if (Request::segment(1) == 'populations') active @endif" 
                                   href="{{ route('populations.show', $firstPopulation->id) }}">
                                    <span class="nav-link-inner--text">Lihat Populasi</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            <!-- Admin Menu (Right Side) -->
            @auth
            <div class="ml-auto d-none d-lg-block">
                <div class="dropdown">
                    <a class="btn btn-neutral dropdown-toggle" href="#" role="button" id="adminMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-shield"></i> Admin
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="adminMenu">
                        <a class="dropdown-item" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                        <a class="dropdown-item" href="{{ route('keluar') }}" onclick="event.preventDefault(); document.getElementById('form-keluar').submit();">
                            <i class="fas fa-sign-out-alt"></i> Keluar
                        </a>
                        <form id="form-keluar" action="{{ route('keluar') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
            @endauth
        </div>
    </header>

    <!-- Main Content -->
    <div class="wrapper">
        <div class="content">
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer text-white">
        <div class="container">
            <div class="row">
                <!-- Column 1: Logo and Village Name -->
                <div class="col-12 col-md-4 text-center mb-4">
                    <div class="d-flex align-items-center justify-content-center">
                        <img height="90px" src="{{ optional($desa)->logo ? url(Storage::url($desa->logo)) : url('/storage/Logo0.png') }}" alt="logo">
                        <div class="ml-3 text-left">
                            <h5 class="mb-0" style="font-weight: 600; font-size: 20px;">Pemerintah Desa {{ $desa->nama_desa ?? 'Sukorejo' }}</h5>
                            <p class="mb-0">Kecamatan {{ $desa->nama_kecamatan ?? 'Kebomas' }}, Kabupaten {{ $desa->nama_kabupaten ?? 'Gresik' }}, Provinsi {{ $desa->nama_provinsi ?? 'Jawa Timur' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Column 2: Village Contact -->
                <div class="col-12 col-md-4 text-center mb-4">
                    <h5 class="font-weight-bold">Kontak Desa</h5>
                    <p><i class="fas fa-phone"></i> {{ $desa->telepon ?? '095150208664' }}</p>
                    <p><i class="fas fa-envelope"></i> {{ $desa->email ?? 'sukorejo@gmail.com' }}</p>
                    <p><i class="fas fa-clock"></i> Senin - Kamis (08.00 - 15.00) &amp; Jum'at (08.00 - 11.00)</p>
                    <p><i class="fas fa-map-marker-alt"></i> {{ $desa->alamat ?? 'Jl. Jambu Raya RT. 003 RW. 02 No. 30' }}</p>
                </div>

                <!-- Column 3: Social Media -->
                <div class="col-12 col-md-4 text-center">
                    <h5 class="font-weight-bold mt-3">Media Sosial</h5>
                    <div class="social-links mt-2" style="font-size: 24px;">
                        <a href="#" class="text-white"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Copyright -->
    <div class="row">
        <div class="col-md-12">
            <p class="text-muted mb-0 copyright font-weight-bold font-">&copy; 2025 KKN 46 SISTEM INFORMASI UMG. All rights reserved.</p>
        </div>
    </div>

    <!-- Core JS -->
    <script src="{{ url('/js/plugins/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ url('/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Alpine JS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>

    <!-- Argon JS -->
    <script src="{{ url('/js/argon-dashboard.min.js?v=1.1.2') }}"></script>

    <script>
        // Mobile Sidebar Toggle
        document.getElementById('navbar-toggler').addEventListener('click', function() {
            document.getElementById('sidebar-mobile').classList.add('active');
            document.getElementById('overlay-mobile').classList.add('active');
        });

        document.getElementById('close-sidebar-mobile').addEventListener('click', function() {
            document.getElementById('sidebar-mobile').classList.remove('active');
            document.getElementById('overlay-mobile').classList.remove('active');
        });

        document.getElementById('overlay-mobile').addEventListener('click', function() {
            document.getElementById('sidebar-mobile').classList.remove('active');
            document.getElementById('overlay-mobile').classList.remove('active');
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>

    @stack('scripts')
</body>
</html>