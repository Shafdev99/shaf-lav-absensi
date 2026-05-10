@extends('layout.auth')
@section('title', Request::is('alur-pendaftaran') ? 'Alur Pendaftaran' : 'Syarat Pendaftaran')
@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-8 col mx-auto">
            <div class="error p-3 mt-2 card card-content">

                {{-- Back Button --}}
                <div>
                    <a href="{{ route('halaman.daftar') }}" class="btn btn-primary rounded-pill mb-3 px-3 py-2">
                        <i class="bi bi-chevron-left me-1"></i>
                        Kembali
                    </a>
                </div>
                {{-- End --}}

                {{-- Ucapan --}}
                <i class="bi bi-journal-text text-center" style="font-size: 70px; color: green;"></i>
                <h3 class="login-title text-center mb-4">
                    @if (Request::is('alur-pendaftaran'))
                        Alur Pendaftaran
                    @else
                        Syarat Pendaftaran
                    @endif
                </h3>
                <p class="text-center text-muted">
                    Silakan baca
                    @if (Request::is('alur-pendaftaran'))
                        alur Pendaftaran
                    @else
                        syarat Pendaftaran
                    @endif
                    dibawah ini sebelum melakukan pendaftaran SPMB di SMK Konohagakure
                </p>
                {{-- End --}}

                {{-- Alert --}}
                <div class="alert alert-primary fw-bold" role="alert">
                    Harap dibaca baik-baik dan seksama!
                </div>
                {{-- End --}}

                {{-- Content --}}
                <div class="p-3">
                    @if (Request::is('alur-pendaftaran'))
                        {!! $alur->alur !!}
                    @else
                        {!! $syarat->syarat !!}
                    @endif
                </div>
                {{-- End --}}
            </div>
        </div>
    </div>

@endsection
