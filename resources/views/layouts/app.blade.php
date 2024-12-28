<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
        <link rel="icon" href="{{asset('storage/larisin_bulet.ico')}}" type="image/x-icon" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }} - @yield('titlepage')</title>

        <script src="{{asset('larisin/js/plugin/webfont/webfont.min.js')}}"></script>
        <script>
        WebFont.load({
            google: { families: ["Public Sans:300,400,500,600,700"] },
            custom: {
            families: [
                "Font Awesome 5 Solid",
                "Font Awesome 5 Regular",
                "Font Awesome 5 Brands",
                "simple-line-icons",
            ],
            urls: ["larisin/css/fonts.min.css"],
            },
            active: function () {
            sessionStorage.fonts = true;
            },
        });
        </script>

        <!-- CSS Files -->
        <link rel="stylesheet" href="{{asset('larisin/css/bootstrap.min.css')}}" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('larisin/css/plugins.min.css')}}" />
        <link rel="stylesheet" href="{{asset('larisin/css/kaiadmin.min.css')}}" />

        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link rel="stylesheet" href="{{asset('larisin/css/kaiadmin.css')}}" />
    </head>
    <body class="font-sans antialiased">
        <div class="wrapper">
            @include('layouts.navigation')
            <div class="main-panel">
                <div class="main-header">
                    <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">
                        <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                        </div>
                        <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                    </div>
                    <!-- Navbar Header -->
                    <nav
                    class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">                
                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                        <li class="nav-item topbar-icon dropdown hidden-caret">
                            <a class="nav-link" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                            <i class="fas fa-layer-group"></i>
                            </a>
                            <div class="dropdown-menu quick-actions animated fadeIn">
                            <div class="quick-actions-header">
                                <span class="title mb-1">{{__('Aksi Cepat')}}</span>
                                <span class="subtitle op-7">{{__('Shortcuts')}}</span>
                            </div>
                            <div class="quick-actions-scroll scrollbar-outer">
                                <div class="quick-actions-items">
                                <div class="row m-0">
                                    <a class="col-6 col-md-4 p-0" href="{{route('kontak')}}">
                                    <div class="quick-actions-item">
                                        <div
                                        class="avatar-item bg-warning rounded-circle"
                                        >
                                        <i class="fas fa-user-tie"></i>
                                        </div>
                                        <span class="text">{{__('Kontak')}}</span>
                                    </div>
                                    </a>
                                    <a class="col-6 col-md-4 p-0" href="{{route('product')}}">
                                    <div class="quick-actions-item">
                                        <div
                                        class="avatar-item bg-danger rounded-circle"
                                        >
                                        <i class="fas fa-box"></i>
                                        </div>
                                        <span class="text">{{__('Produk / Barang')}}</span>
                                    </div>
                                    </a>
                                    <a class="col-6 col-md-4 p-0" href="#">
                                    <div class="quick-actions-item">
                                        <div
                                        class="avatar-item bg-primary rounded-circle"
                                        >
                                        <i class="fas fa-file-invoice-dollar"></i>
                                        </div>
                                        <span class="text">{{__('Penjualan')}}</span>
                                    </div>
                                    </a>
                                    <a class="col-6 col-md-4 p-0" href="#">
                                    <div class="quick-actions-item">
                                        <div
                                        class="avatar-item bg-secondary rounded-circle"
                                        >
                                        <i class="fas fa-credit-card"></i>
                                        </div>
                                        <span class="text">{{__("Pembelian")}}</span>
                                    </div>
                                    </a>
                                </div>
                                </div>
                            </div>
                            </div>
                        </li>
                
                        <li class="nav-item topbar-user dropdown hidden-caret">
                            <a
                            class="dropdown-toggle profile-pic"
                            data-bs-toggle="dropdown"
                            href="#"
                            aria-expanded="false"
                            >
                            <div class="avatar-sm">
                                <img
                                src="{{asset('larisin/img/user.png')}}"
                                alt="..."
                                class="avatar-img rounded-circle"
                                />
                            </div>
                            <span class="profile-username">
                                <span class="op-7">Hai,</span>
                                <span class="fw-bold">{{Auth::user()->name}}</span>
                            </span>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                            <div class="dropdown-user-scroll scrollbar-outer">
                                <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                    <img
                                        src="{{asset('larisin/img/user.png')}}"
                                        alt="image profile"
                                        class="avatar-img rounded"
                                    />
                                    </div>
                                    <div class="u-text">
                                    <h4>{{Auth::user()->name}}</h4>
                                    <p class="text-muted">{{Auth::user()->email}}</p>
                                    </div>
                                </div>
                                </li>
                                <li>
                                <div class="dropdown-divider"></div>
                                
                                <form method="POST" action="{{ route('logout') }}" class="text-center">
                                    @csrf
            
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                                        <i class="fas fa-sign-out-alt"></i>
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                                </li>
                            </div>
                            </ul>
                        </li>
                        </ul>
                    </div>
                    </nav>
                    <!-- End Navbar -->
                </div>
                <div class="container">
                    <div class="page-inner">
                        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                            <div>
                                <h3 class="fw-bold mb-3">@yield('titlepage')</h3>
                                <h6 class="op-7 mb-2">@yield('subtitlepage')</h6>
                            </div>
                            <div class="ms-md-auto py-2 py-md-0">
                                @yield('page_actionbutton')
                            </div>
                            {{-- page content --}}
                            
                        </div>
                        {{$slot}}
                    </div>
                </div>
            </div>
        </div>
        {{-- <script src="{{asset('larisin/js/core/jquery-3.7.1.min.js')}}"></script>
        <script src="{{asset('larisin/js/core/popper.min.js')}}"></script> --}}
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
       
        <!-- jQuery Scrollbar -->
        <script src="{{asset('larisin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>

        <!-- Chart JS -->
        <script src="{{asset('larisin/js/plugin/chart.js/chart.min.js')}}"></script>

        <!-- jQuery Sparkline -->
        <script src="{{asset('larisin/js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

        <!-- Chart Circle -->
        <script src="{{asset('larisin/js/plugin/chart-circle/circles.min.js')}}"></script>

        <!-- Datatables -->
        <script src="{{asset('larisin/js/plugin/datatables/datatables.min.js')}}"></script>

        <!-- Bootstrap Notify -->
        <script src="{{asset('larisin/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

        <!-- jQuery Vector Maps -->
        <script src="{{asset('larisin/js/plugin/jsvectormap/jsvectormap.min.js')}}"></script>
        <script src="{{asset('larisin/js/plugin/jsvectormap/world.js')}}"></script>

        <!-- Sweet Alert -->
        <script src="{{asset('larisin/js/plugin/sweetalert/sweetalert.min.js')}}"></script>

        <!-- Kaiadmin JS -->
        <script src="{{asset('larisin/js/kaiadmin.min.js')}}"></script>

        <!-- Kaiadmin DEMO methods, don't include it in your project! -->
        <script src="{{asset('larisin/js/setting-demo.js')}}"></script>
        <script src="{{asset('larisin/js/kaiadmin.js')}}"></script>
        <script src="{{asset('larisin/js/larisin.js')}}"></script>
        <script>
        $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#177dff",
            fillColor: "rgba(23, 125, 255, 0.14)",
        });

        $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#f3545d",
            fillColor: "rgba(243, 84, 93, .14)",
        });

        $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#ffa534",
            fillColor: "rgba(255, 165, 52, .14)",
        });
        
        </script>
         @yield('additional_js')
    </body>
</html>
