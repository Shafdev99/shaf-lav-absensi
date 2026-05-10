{{-- Content --}}
@extends('layout.app')

@section('title', 'Absensi Siswa')

@section('content')
    <div class="content content-sm">

        <div class="container">

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                Absensi
            </div>
            {{-- End Breadcrumb --}}

            <div class="d-flex justify-content-start align-items-center gap-1">
                <h6 class="me-2">
                    Mapel :
                </h6>
                <h5>
                    <span class="badge bg-blobe">
                        {{ $susun_jadwal->mapel->nama_mapel ?? 'Belum Ditentukan' }}
                    </span>
                </h5>
            </div>

            <div class="row mt-4">
                <div class="col-lg-5 col-md-12 col-12 mx-auto mt-3 mt-lg-0 mt-md-0">

                    <div class="card p-lg-3 p-2 card-content">

                        {{-- Header Button --}}
                        <div class="d-flex mt-lg-2 mb-3 mb-lg-0">

                            {{-- Tombol Buat Jadwal --}}
                            {{-- <a class="btn btn-primary d-none d-lg-block d-md-block me-2"
                                href="{{ route('proses.susun.jadwal') }}">
                                <i class="bi bi-arrow-repeat"></i>
                                Buat Jadwal
                            </a> --}}

                            {{-- Tombol Reset Jadwal --}}
                            {{-- <a href="{{ route('reset.jadwal') }}" class="btn btn-default-2 d-none d-lg-block d-md-block">
                                <i class="bi bi-x-circle"></i>
                                <span class="ms-1">
                                    Reset Jadwal
                                </span>
                            </a> --}}

                            <div class="d-inline d-lg-none ms-lg-auto align-self-center fw-bold">
                                <i class="bi bi-person-vcard-fill mx-2 d-lg-none" style="font-size: 16px;"></i>
                                Susun Jadwal
                            </div>

                        </div>
                        {{-- End Header Button --}}


                        <h6>
                            Scanner Absensi
                        </h6>

                        <div>
                            <div class="d-flex align-items-center mt-2">
                                <div class="scanner-placeholder d-flex align-items-center justify-content-center">
                                    <i class="bi bi-upc-scan" style="font-size: 24px;"></i>
                                </div>
                                <div class="ms-3">
                                    <p class="mb-1">Pindai QR Code untuk melakukan absensi</p>
                                    <p class="mb-0 text-muted" style="font-size: 12px;">Pastikan QR Code terlihat jelas</p>
                                </div>
                            </div>
                        </div>




                    </div>

                </div>
                <div class="col-lg-7 col-md-12 col-12 mt-3 mt-lg-0 mt-md-0">

                    <div class="card p-lg-3 p-2 card-content">

                        {{-- Header Button --}}
                        {{-- <div class="d-flex mt-lg-2 mb-3 mb-lg-0">

                            <div class="d-inline d-lg-none ms-lg-auto align-self-center fw-bold">
                                <i class="bi bi-person-vcard-fill mx-2 d-lg-none" style="font-size: 16px;"></i>
                                Absensi Siswa
                            </div>

                        </div> --}}
                        {{-- End Header Button --}}

                        <h5>
                            Kelas :
                            <span class="badge bg-blobe">
                                {{ $susun_jadwal->tingkat . ' ' . $susun_jadwal->nama_jurusan . ' ' . $susun_jadwal->kelas->nama_kelas ?? '-' }}
                            </span>
                        </h5>

                        {{-- Table --}}
                        <div class="table-responsive mt-3 desktop-table">
                            <table class="table align-middle">

                                <thead>
                                    <tr class="tr-table">
                                        <th colspan="2" class="text-center">
                                            Daftar Siswa
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                        </div>

                    </div>

                </div>
            @endsection

            @push('scripts')
                <script type="text/javascript">
                    /*
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        |--------------------------------------------------------------------------
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        | NOTIF SUKSES  
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        |--------------------------------------------------------------------------
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        */

                    @if (session('sukses'))

                        toastr.success(
                            "{{ session('sukses') }}"
                        );
                    @endif

                    /*
                    |--------------------------------------------------------------------------
                    | NOTIF VALIDASI
                    |--------------------------------------------------------------------------
                    */

                    @if ($errors->any())

                        @foreach ($errors->all() as $error)

                            toastr.warning(
                                '{{ ucwords($error) }}'
                            );
                        @endforeach
                    @endif
                </script>
            @endpush
