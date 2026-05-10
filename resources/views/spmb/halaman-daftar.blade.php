@extends('layout.auth')
@section('title', 'Halaman Daftar SPMB')
@section('content')

    {{-- Jumbotron --}}
    <div class="row jumbotron bg-image" style="background-image: url('{{ asset('storage/' . $background) }}');">
        <div class="col mx-auto text-center bg-image-overlay">

            {{-- Navbar --}}
            <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container-fluid">
                    <a class="navbar-brand fw-bold" href="#">
                        <img width="50" src="{{ asset('storage/' . $logo) }}" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav ms-auto bg-glass">
                            <a class="nav-link" aria-current="page" href="{{ route('alur.pendaftaran') }}">Alur
                                Pendaftaran</a>
                            <a class="nav-link" href="{{ route('unduh.brosur') }}">Unduh Brosur</a>
                            @if ($sosmed->count() < 2)
                                @foreach ($sosmed as $item)
                                    <a class="nav-link" href="{{ $item->link_sosmed }}">{{ $item->nama_sosmed }}</a>
                                @endforeach
                            @else
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Sosial Media
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach ($sosmed as $item)
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ $item->link_sosmed }}">{{ $item->nama_sosmed }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </nav>
            {{-- End --}}

            {{-- Text --}}
            <div class="text-center mb-4 spmb-section-text mx-auto">
                <span class="spmb-text-welcome">
                    Selamat Datang di
                </span>
                <br>
                <span class="spmb-nama-sekolah">
                    {{ $setting->nama_sekolah }}
                </span>
                <br>
                <div class="spmb-text-penjelasan">
                    Sistem Penerimaan Murid Baru Sudah Di Buka <br>
                    Bagi calon murid baru yang ingin mendaftar bisa langsung mengisi formulir dibawah ini dan jika ingin
                    melihat status penerimaan murid baru bisa menekan tombol cek status.
                </div>
            </div>
            {{-- End --}}

            {{-- Button --}}
            <div>
                <a href="{{ route('syarat.pendaftaran') }}" class="btn btn-outline-light mx-auto">
                    <i class="bi bi-journals"></i>
                    Syarat Pendaftaran
                </a>
                <a href="{{ route('cek.status') }}" class="btn btn-primary bg-gradient border-0 mx-auto">
                    <i class="bi bi-person-check"></i>
                    Cek Status
                </a>
            </div>
            {{-- End --}}

            {{-- Button To Formulir --}}
            <div class="card card-content mb-5 mt-5 py-2 px-3 mx-auto btn-to-formulir">
                <div class="d-block d-lg-flex">
                    <i class="bi bi-clipboard2-data me-3 text-dark icon-to-formulir"></i>
                    <div>
                        <h4 class="login-title align-self-center">
                            Formulir Pendaftaran
                        </h4>
                        <div class="dekripsi-to-formulir">
                            Calon Murid Baru SMK
                            Konohagakure
                        </div>
                    </div>
                    <a href="{{ route('form.daftar') }}"
                        class="ms-auto align-self-center btn btn-primary bg-gradient shadow-sm py-2 my-3 my-lg-0 my-md-0 fw-bold">
                        <i class="bi bi-box-arrow-in-right me-1"></i>
                        DAFTAR
                    </a>
                </div>
            </div>
            {{-- End --}}
            <br>
            <!-- Footer -->
            <div class="text-center footer-second mt-lg-5 mt-md-5">
                Copyright &copy; 2024
                <a href="" class="text-decoration-none"> Shaf.dev </a> - M. Fila Shaufiq.
            </div>

        </div>
    </div>
    {{-- End --}}

@endsection
