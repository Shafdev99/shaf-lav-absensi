<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('/css/googlefont.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/dist/css/dropify.css') }}">
    <link rel="stylesheet" href="{{ asset('/dist/fonts/dropify.ttf') }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet"> --}}
    <link rel="icon" href="{{ asset('/img/logo/shaf-logo.png') }}" type="image/png" sizes="16x16" />
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}" />
    <title> {{ ucwords(Auth::user()->role) }} | @yield('title')</title>
</head>

<body>
    <div class="" id="overlay"></div>
    <div class="containter main-contain">

        <!-- Sidebar -->
        <aside class="sidebar">

            <!-- Head Sidebar -->
            <div class="head d-flex">
                <img src="{{ asset('/img/logo/shaf-logo.png') }}" alt="shaf-logo" class="img-fluid head-logo" />
                <h4 class="head-title ms-2">BISA</h4>
                <a href="javascript:void(0);" onclick="slide()" class="ms-auto me-4 d-block d-lg-none text-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-x-lg " viewBox="0 0 16 16">
                        <path
                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                    </svg>
                </a>
            </div>

            <span class=" badge-blobe py-2 px-5 mt-3">
                {{ session('tahun_ajar') . ' ' . ucwords(session('semester')) }}
            </span>

            <!-- List Menu -->
            <div class="menu-list mt-4">

                <!-- List Header -->
                <h6 class="list-head">
                    Menu {{ ucwords(Auth::user()->role) }}
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-box-fill ms-2" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.004-.001.274-.11a.75.75 0 0 1 .558 0l.274.11.004.001zm-1.374.527L8 5.962 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339Z" />
                    </svg>
                </h6>

                {{-- Sidebar Menu --}}
                @include('layout.sidebar')
                {{-- End --}}

                <div class="card card-app-info text-center">
                    Shaf Bisa adalah web app buku induk siswa sekolah
                </div>
            </div>
        </aside>
        <!-- End -->

        <!-- Main Content -->
        <main class="main-content mx-auto">
            <!-- Nav Content -->
            <div class="nav-content d-flex justify-content-between">
                <h5 class="nav-title align-self-end d-flex">
                    <a href="javascript:void(0);" class="hum-menu me-2" onclick="slide()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-list d-lg-none d-inline" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                        </svg>
                    </a>
                    <div class="align-item-center" style="margin-top: -1px;">
                        {{-- Logo --}}
                        @if (Request::is('beranda'))
                            <i class="bi bi-house-door-fill"></i>
                        @else
                            <i class="bi bi-grid-fill"></i>
                        @endif
                        {{-- Salam --}}
                        <span class="ucapan-salam">
                            {{ Request::is('beranda') ? 'Selamat datang!' : 'Semangat kerjanya!' }}
                        </span>
                    </div>
                </h5>
                <div class="nav-date align-self-center ms-auto me-3">
                    <a href="javascript:void(0);" class="dropdown-toggle d-block d-lg-none text-dark"
                        id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-calendar3" viewBox="0 0 16 16">
                            <path
                                d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857z" />
                            <path
                                d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                        </svg>
                    </a>
                    <ul class="dropdown-menu shadow dropdown-menu-user" aria-labelledby="dropdownMenuButton2">
                        <li class="dropdown-item dropdown-username text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-calendar3" viewBox="0 0 16 16">
                                <path
                                    d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857z" />
                                <path
                                    d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                            </svg>
                            @php
                                function hari_ini()
                                {
                                    $hari = date('D');

                                    switch ($hari) {
                                        case 'Sun':
                                            $hari_ini = 'Minggu';
                                            break;

                                        case 'Mon':
                                            $hari_ini = 'Senin';
                                            break;

                                        case 'Tue':
                                            $hari_ini = 'Selasa';
                                            break;

                                        case 'Wed':
                                            $hari_ini = 'Rabu';
                                            break;

                                        case 'Thu':
                                            $hari_ini = 'Kamis';
                                            break;

                                        case 'Fri':
                                            $hari_ini = 'Jumat';
                                            break;

                                        case 'Sat':
                                            $hari_ini = 'Sabtu';
                                            break;

                                        default:
                                            $hari_ini = 'Tidak di ketahui';
                                            break;
                                    }

                                    return $hari_ini . ', ';
                                }
                            @endphp
                            {{ hari_ini() }}
                            {{ \Carbon\Carbon::parse(date('d M Y'))->translatedFormat('d F Y') }}
                        </li>
                    </ul>
                    <span class="d-none d-lg-inline">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-calendar3" viewBox="0 0 16 16">
                            <path
                                d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857z" />
                            <path
                                d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                        </svg>
                        {{ hari_ini() }}
                        {{ \Carbon\Carbon::parse(date('d M Y'))->translatedFormat('d F Y') }}
                    </span>
                </div>
                <div class="nav-profile d-flex me-4 align-self-center">
                    <a href="javascript:void(0);" class="dropdown-toggle d-block d-lg-none" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('/img/logo/shaf-logo.png') }}"
                            class="img-fluid rounded-pill img-user align-self-center me-3" width="30"
                            alt="user-photo">
                    </a>
                    <ul class="dropdown-menu shadow dropdown-menu-user" aria-labelledby="dropdownMenuButton1">
                        @php
                            $nama = explode(' ', Auth::user()->name);
                        @endphp
                        <li class="dropdown-item dropdown-username">
                            {{ ucwords($nama[0]) }}
                        </li>
                        <li class="dropdown-item dropdown-user-role">{{ ucwords(Auth::user()->role) }}</li>
                        <hr>
                        <li>
                            <a class="dropdown-item dropdown-user-menu" href="{{ route('profil') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                </svg>
                                Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item dropdown-user-menu" href="javascript:void(0);"
                                data-bs-toggle="modal" data-bs-target="#modalLogout">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                                    <path fill-rule="evenodd"
                                        d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                                </svg>
                                Logout
                            </a>
                        </li>
                    </ul>
                    <img src="{{ Auth::user()?->foto_profil ? asset('storage/' . Auth::user()->foto_profil) : asset('img/logo/profile.jpg') }}"
                        class="d-none d-lg-block img-fluid rounded-pill img-user align-self-center me-3"
                        alt="user-photo">

                    <div class="nav-user">
                        <span class="d-block user-name">{{ ucwords($nama[0]) }}</span>
                        <span class="user-role">{{ ucwords(Auth::user()->role) }}</span>
                    </div>
                </div>
            </div>

            {{-- Content --}}
            @yield('content')
            {{-- End --}}

            <!-- Footer -->
            <footer class="footer ">
                Copyright &copy; 2024 {{ date('Y') != '2024' ? ' - ' . date('Y') : ' ' }} <a href=""
                    class="text-decoration-none">
                    Shaf.dev
                </a> - M. Fila Shaufiq.
            </footer>

            {{-- Modal Log Out --}}
            <div class="modal fade" id="modalLogout" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="modalLogoutLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header border-bottom">
                            <h6 class="modal-title fw-bold" id="modalLogoutLabel">Keluar</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('/logout') }}" method="post">
                                @csrf
                                <p class="text-center peringatan-modal">Anda yakin ingin keluar dari aplikasi ini?</p>
                                <div class="button-modal d-flex justify-content-center">
                                    <input type="hidden" name="id" id="id-siswa">
                                    <button type="button" class="btn btn-default-2 me-2"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-box-arrow-right me-1"></i>
                                        Keluar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End --}}

        </main>

    </div>

    <script src="{{ asset('/js/popper.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('/js/toastr.min.js') }}"></script>
    <script src="{{ asset('/dist/js/dropify.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script> --}}
    <script src="{{ asset('/js/script.js') }}"></script>

    <script>
        toastr.options = {
            "positionClass": "toast-bottom-right"
        }
    </script>
    {{-- Script per Section --}}
    @stack('scripts')
    {{-- End Script --}}
</body>

</html>
