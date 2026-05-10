<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" /> --}}

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('/css/googlefont.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/dist/css/dropify.css') }}">
    <link rel="stylesheet" href="{{ asset('/dist/fonts/dropify.ttf') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('/img/logo/shaf-logo.png') }}" type="image/png" sizes="16x16" />
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/auth.css') }}" />
    <title>Shaf Absensi - @yield('title')</title>
</head>

<body>
    <div class="container-fluid container-login">
        <div class="row {{ !Request::is('halaman-daftar') ? 'mb-5' : '' }} ">
            <div class="col">
                @if (!Request::is('halaman-daftar'))
                    <div class="mb-5 pt-4 ps-lg-3 ps-md-3 logo-page">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('/img/logo/shaf-logo.png') }}" alt="shaf-logo"
                                class="head-logo img-fluid mx-auto me-2" style="margin-top: -5px !important" />
                            <h4 class="head-title d-inline">Absensi</h4>
                        </a>
                    </div>
                @endif

                {{-- Card Login --}}
                @yield('content')
                {{-- End --}}
            </div>
        </div>

        @if (!Request::is('halaman-daftar'))
            <!-- Footer -->
            <div class="text-center footer-second">
                Copyright &copy; 2024
                <a href="" class="text-decoration-none"> Shaf.dev </a> - M. Fila Shaufiq.
            </div>
        @endif
    </div>

    <script src="{{ asset('/js/popper.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('/js/toastr.min.js') }}"></script>
    <script src="{{ asset('/dist/js/dropify.min.js') }}"></script>
    <script src="{{ asset('/js/script.js') }}"></script>

    {{-- Script per Section --}}
    @stack('scripts')
    {{-- End Script --}}
</body>

</html>
