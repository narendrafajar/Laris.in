<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts and icons -->
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
    <link rel="stylesheet" href="{{asset('larisin/css/plugins.min.css')}}" />
    <link rel="stylesheet" href="{{asset('larisin/css/kaiadmin.min.css')}}" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{asset('larisin/css/kaiadmin.css')}}" />
    </head>
    <body>
        <div class="center-container">
            <div class="center-element">
                {{$slot}}
            </div>
        </div>
        {{-- <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Registered &reg; RenWebTech 2024</div>
                    </div>
                </div>
            </footer>
        </div> --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <!--   Core JS Files   -->
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script src="{{asset('larisin/js/core/popper.min.js')}}"></script>
        <script src="{{asset('larisin/js/core/bootstrap.min.js')}}"></script>

        <!-- Bootstrap Notify -->
        <script src="{{asset('larisin/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

        <!-- Sweet Alert -->
        <script src="{{asset('larisin/js/plugin/sweetalert/sweetalert.min.js')}}"></script>

        <!-- Kaiadmin JS -->
        <script src="{{asset('larisin/js/kaiadmin.min.js')}}"></script>

        <!-- Kaiadmin DEMO methods, don't include it in your project! -->
        <script src="{{asset('larisin/js/setting-demo.js')}}"></script>
        <script src="{{asset('larisin/js/kaiadmin.js')}}"></script>
        <script src="{{ asset('larisin/js/larisin.js') }}"></script>
        {{-- @stack('scripts') <!-- Untuk menambahkan script tambahan jika diperlukan --> --}}
    </body>
</html>
