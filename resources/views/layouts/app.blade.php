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

    <title>
        Desa {{ $desa->nama_desa ?? '' }} - @yield('title')
    </title>

    <!-- Favicon -->
    <link href="{{ optional($desa)->logo ? asset(Storage::url($desa->logo)) : asset('favicon.ico') }}" rel="icon" type="image/png">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <!-- Icons -->
    <link href="{{ asset('/js/plugins/nucleo/css/nucleo.css') }}" rel="stylesheet" />
    <link href="{{ asset('/js/plugins/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />

    <!-- CSS Files -->
    <link href="{{ asset('/css/argon-dashboard.css?v=1.1.2') }}" rel="stylesheet" />
    @yield('styles')
</head>

<body class="">
    <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
        @include('layouts.components.sidebar')
    </nav>
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
            <div class="container-fluid">
                <!-- Brand -->
                <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">@yield('title')</a>
                <!-- Form -->
                @yield('form-search')
                <!-- User -->
                <ul class="navbar-nav align-items-center d-none d-md-flex">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <div class="media align-items-center">
                                    <span class="avatar avatar-sm">
                                        <img alt="Foto Profil" src="{{ auth()->user()->foto_profil ? asset(Storage::url(auth()->user()->foto_profil)) : asset('img/theme/team-4-800x800.jpg') }}">
                                    </span>
                                    <div class="media-body ml-2 d-none d-lg-block">
                                        <span class="mb-0 text-sm font-weight-bold">{{ auth()->user()->nama ?? auth()->user()->name ?? 'User' }}</span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                                <a href="{{ route('profil') }}" class="dropdown-item">
                                    <i class="ni ni-single-02"></i>
                                    <span>Profil Saya</span>
                                </a>
                                <a href="{{ route('pengaturan') }}" class="dropdown-item">
                                    <i class="ni ni-settings-gear-65"></i>
                                    <span>Pengaturan</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('keluar') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('form-keluar').submit();">
                                    <i class="ni ni-user-run"></i>
                                    <span>Keluar</span>
                                </a>

                                <form id="form-keluar" action="{{ route('keluar') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>
        <!-- End Navbar -->

        <!-- Header -->
        @yield('content-header')

        <!-- Page content -->
        <div class="container-fluid mt--7">
            @yield('content')
        </div>
    </div>

    <!--   Core   -->
    <script src="{{ asset('/js/plugins/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <!--   Optional JS   -->

    <!--   Argon JS   -->
    <script src="{{ asset('/js/argon-dashboard.min.js?v=1.1.2') }}"></script>
    <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
    <script>
        const baseURL = $('meta[name="base-url"]').attr('content');
        window.TrackJS &&
            TrackJS.install({
                token: "ee6fab19c5a04ac1a32a645abde4613a",
                application: "argon-dashboard-free"
            });
    </script>
    <script src="{{ asset('/js/script.js') }}"></script>
    @stack('scripts')
</body>

</html>