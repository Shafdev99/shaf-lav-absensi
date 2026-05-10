<!-- Content -->
@extends('layout.app')
@section('title', 'Detail Data Pendaftar')
@section('content')
    <div class="content">

        <div class="container ">

            <!-- Breadcrumb -->
            <div class="breadcrumb">
                @if ($menu === 'rekap')
                    <a href="{{ route('spmb.rekap') }}">Data
                        Rekap SPMB </a>
                @else
                    <a href="{{ route('pendaftar') }}">Data
                        Pendaftar </a>
                @endif
                /
                Detail Pendaftar
            </div>

            <div class="row mt-4">
                <div class="col col-lg-9 mx-auto">
                    {{-- Head Button --}}
                    <div class="d-flex mt-2 mb-4 px-2 justify-content-between">
                        @php
                            $url = parse_url(url()->full());
                        @endphp
                        @if ($menu === 'rekap')
                            <a href="{{ route('spmb.rekap', $url['query'] ?? false) }}" class="btn btn-primary ms-2">
                                <i class="bi bi-arrow-left"></i>
                                Kembali
                            </a>
                        @else
                            <a href="{{ route('pendaftar', $url['query'] ?? false) }}" class="btn btn-primary ms-2">
                                <i class="bi bi-arrow-left"></i>
                                Kembali
                            </a>
                        @endif
                        <h6 class="fw-bold align-self-center me-2">Detail Data</h6>
                    </div>
                    {{-- End --}}

                    {{-- Data Pendaftar --}}
                    <div class="error mx-auto mt-2 card card-content">

                        <div class="container-fluid mt-4 mb-3">
                            <div class="d-flex form-label-spmb">
                                <h5 class="fw-bold bg-success bg-gradient text-white px-3 py-2 rounded shadow-sm">
                                    Data Pendaftar
                                </h5>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col">

                                    {{-- Nama Lengkap --}}
                                    <div class="mb-4 mt-2">
                                        <label for="nama-lengkap" class="form-label">
                                            Nama Lengkap
                                        </label>
                                        <h5>
                                            {{ $pendaftar?->nama_lengkap }}
                                        </h5>
                                    </div>

                                    {{-- Email --}}
                                    <div class="mb-4">
                                        <label for="email" class="form-label">
                                            Email
                                        </label>
                                        <h5>
                                            {{ $pendaftar?->email ? $pendaftar?->email : '-' }}
                                        </h5>
                                    </div>

                                    {{-- Tanggal Lahir --}}
                                    <div class="mb-4 ">
                                        <label for="tanggal-lahir" class="form-label">
                                            Tanggal Lahir
                                        </label>
                                        <h5>
                                            {{ \Carbon\Carbon::parse($pendaftar?->tanggal_lahir)->translatedFormat('d F Y') }}
                                        </h5>
                                    </div>

                                    {{-- Tempat Lahir --}}
                                    <div class="mb-4">
                                        <label for="tempat-lahir" class="form-label">
                                            Tempat Lahir
                                        </label>
                                        <h5>
                                            {{ $pendaftar?->tempat_lahir }}
                                        </h5>
                                    </div>

                                    {{-- NIK --}}
                                    <div class="mb-4">
                                        <label for="nik" class="form-label">
                                            NIK
                                        </label>
                                        <h5>
                                            {{ $pendaftar?->nik }}
                                        </h5>
                                    </div>

                                    {{-- NISN --}}
                                    <div class="mb-4">
                                        <label for="nisn" class="form-label">
                                            NISN
                                        </label>
                                        <h5>
                                            {{ $pendaftar?->nisn }}
                                        </h5>
                                    </div>
                                </div>

                                <div class="col">
                                    {{-- Alamat --}}
                                    <div class="mb-4 mt-2">
                                        <label for="alamat" class="form-label">
                                            Alamat
                                        </label>
                                        <h5>
                                            {{ $pendaftar?->alamat }}
                                        </h5>
                                    </div>

                                    {{-- Jenis Kelamin --}}
                                    <div class="mb-4">
                                        <label for="jenis-kelamin" class="form-label">
                                            Jenis Kelamin
                                        </label>
                                        <h5>
                                            {{ $pendaftar?->jenis_kelamin }}
                                        </h5>
                                    </div>

                                    {{-- Agama --}}
                                    <div class="mb-4">
                                        <label for="agama" class="form-label">
                                            Agama
                                        </label>
                                        <h5>
                                            {{ $pendaftar?->religion->agama }}
                                        </h5>
                                    </div>

                                    {{-- Foto --}}
                                    <div class="">
                                        <label for="foto" class="form-label">Foto Pendaftar</label><br>
                                        <img width="100px" class="img-thumbnail img-fluid"
                                            src="{{ $pendaftar?->foto ? asset('storage/' . $pendaftar?->foto) : asset('img/logo/profile.jpg') }}"
                                            alt="foto-pendaftar">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Asal Sekolah --}}
                    <div class="error mx-auto mt-5 card card-content">

                        <div class="container-fluid mt-4">
                            <div class="d-flex form-label-spmb">
                                <h5 class="fw-bold bg-success bg-gradient text-white px-3 py-2 rounded shadow-sm">
                                    Asal Sekolah
                                </h5>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col">

                                    {{-- Nama Sekolah --}}
                                    <div class="mb-4 mt-2">
                                        <label for="asal_sekolah" class="form-label">
                                            Nama Sekolah
                                        </label>
                                        <h5>
                                            {{ $pendaftar?->berkas?->asal_sekolah }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col">
                                    {{-- Alamat Sekolah --}}
                                    <div class="mb-4 mt-2">
                                        <label for="alamat_sekolah" class="form-label">
                                            Alamat Sekolah
                                        </label>
                                        <h5>
                                            {{ $pendaftar?->berkas?->alamat_sekolah }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Berkas Pendaftaran --}}
                    <div class="error mx-auto mt-5 card card-content">

                        <div class="container-fluid mt-4">
                            <div class="d-flex form-label-spmb">
                                <h5 class="fw-bold bg-success bg-gradient text-white px-3 py-2 rounded shadow-sm">
                                    Berkas Pendaftaran
                                </h5>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col">

                                    {{-- Nomor Ijazah / STTB / Tahun --}}
                                    <div class="mb-4 mt-2">
                                        <label for="no_ijazah" class="form-label">
                                            Nomor Ijazah / STTB / Tahun
                                        </label>
                                        <h5>
                                            {{ $pendaftar?->berkas?->no_ijazah }}
                                        </h5>
                                    </div>

                                    {{-- Rata-rata Nilai --}}
                                    <div class="mb-4">
                                        <label for="rata_nilai" class="form-label">
                                            Rata-rata Nilai
                                        </label>
                                        <h5>
                                            {{ $pendaftar?->berkas?->rata_nilai }}
                                        </h5>
                                    </div>

                                    {{-- File Ijazah/SKHU --}}
                                    <div class="mb-4">
                                        <label for="ijazah" class="form-label">
                                            File Ijazah/SKHU
                                        </label>
                                        <br>
                                        <img width="100px" class="img-fluid img-thumbnail"
                                            src="{{ asset('storage/' . $pendaftar?->berkas?->ijazah) }}" alt="Ijazah">
                                        <a class="btn btn-primary py-1 px-2 ms-3"
                                            onclick="tampilBerkas('{{ $pendaftar?->berkas?->ijazah }}')">
                                            Lihat
                                        </a>
                                    </div>

                                    {{-- Kartu Keluarga --}}
                                    <div class="mb-4">
                                        <label for="kartu_keluarga" class="form-label">
                                            Kartu Keluarga
                                        </label>
                                        <br>
                                        <img width="100px" class="img-fluid img-thumbnail"
                                            src="{{ asset('storage/' . $pendaftar?->berkas?->kartu_keluarga) }}"
                                            alt="kartu_keluarga">
                                        <a class="btn btn-primary py-1 px-2 ms-3"
                                            onclick="tampilBerkas('{{ $pendaftar?->berkas?->kartu_keluarga }}')">
                                            Lihat
                                        </a>

                                    </div>
                                </div>
                                <div class="col">
                                    {{-- Akta Kelahiran --}}
                                    <div class="mb-4 mt-2">
                                        <label for="akta_kelahiran" class="form-label">
                                            Akta Kelahiran
                                        </label>
                                        <br>
                                        <img width="100px" class="img-fluid img-thumbnail"
                                            src="{{ asset('storage/' . $pendaftar?->berkas?->akta_kelahiran) }}"
                                            alt="akta_kelahiran">
                                        <a class="btn btn-primary py-1 px-2 ms-3"
                                            onclick="tampilBerkas('{{ $pendaftar?->berkas?->akta_kelahiran }}')">
                                            Lihat
                                        </a>
                                    </div>

                                    {{-- Piagam Prestasi --}}
                                    <div class="mb-4">
                                        <label for="piagam_prestasi" class="form-label">Piagam Prestasi</label>
                                        <br>
                                        @if ($pendaftar?->berkas?->piagam_prestasi)
                                            <img width="100px" class="img-fluid img-thumbnail"
                                                src="{{ asset('storage/' . $pendaftar?->berkas?->piagam_prestasi) }}"
                                                alt="piagam_prestasi">
                                            <a class="btn btn-primary py-1 px-2 ms-3"
                                                onclick="tampilBerkas('{{ $pendaftar?->berkas?->piagam_prestasi }}')">
                                                Lihat
                                            </a>
                                        @else
                                            <h5>
                                                File tidak ada!
                                            </h5>
                                        @endif
                                    </div>

                                    {{-- Kartu Penerima Bantuan --}}
                                    <div class="mb-4">
                                        <label for="penerima_bantuan" class="form-label">Kartu Penerima
                                            Bantuan</label>
                                        <br>
                                        @if ($pendaftar?->berkas?->kartu_bantuan)
                                            <img width="100px" class="img-fluid img-thumbnail"
                                                src="{{ asset('storage/' . $pendaftar?->berkas?->kartu_bantuan) }}"
                                                alt="kartu_bantuan">
                                            <a class="btn btn-primary py-1 px-2 ms-3"
                                                onclick="tampilBerkas('{{ $pendaftar?->berkas?->kartu_bantuan }}')">
                                                Lihat
                                            </a>
                                        @else
                                            <h5>
                                                File tidak ada!
                                            </h5>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Data Orang Tua --}}
                    <div class="error mx-auto mt-5 card card-content">

                        <div class="container-fluid mt-4">
                            <div class="d-flex form-label-spmb">
                                <h5 class="fw-bold bg-success bg-gradient text-white px-3 py-2 rounded shadow-sm">
                                    Data Orang Tua
                                </h5>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col">

                                    {{-- Nama Ayah --}}
                                    <div class="mb-4 mt-2">
                                        <label for="nama_ayah" class="form-label">
                                            Nama Ayah
                                        </label>
                                        <h5>
                                            {{ $pendaftar?->ayah?->nama_ayah }}
                                        </h5>
                                    </div>

                                    {{-- Pekerjaan Ayah --}}
                                    <div class="mb-4">
                                        <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah
                                            <span class="text-danger">*</span>
                                        </label>
                                        <h5>
                                            {{ $pendaftar?->ayah?->pekerjaan_ayah }}
                                        </h5>
                                    </div>

                                    {{-- Nama Ibu --}}
                                    <div class="mb-4">
                                        <label for="nama_ibu" class="form-label">Nama Ibu
                                            <span class="text-danger">*</span>
                                        </label>
                                        <h5>
                                            {{ $pendaftar?->ibu?->nama_ibu }}
                                        </h5>
                                    </div>

                                </div>
                                <div class="col">
                                    {{-- Pekerjaan Ibu --}}
                                    <div class="mb-4 mt-2">
                                        <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu
                                            <span class="text-danger">*</span>
                                        </label>
                                        <h5>
                                            {{ $pendaftar?->ibu?->pekerjaan_ibu }}
                                        </h5>
                                    </div>

                                    {{-- Alamat Orang Tua --}}
                                    <div class="mb-4">
                                        <label for="alamat_ortu" class="form-label">Alamat Orang Tua
                                            <span class="text-danger">*</span>
                                        </label>
                                        <h5>
                                            {{ $pendaftar?->ayah?->alamat_ayah }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Data Wali --}}
                    <div class="error mx-auto mt-5 card card-content">

                        <div class="container-fluid mt-4">
                            <div class="d-flex form-label-spmb">
                                <h5 class="fw-bold bg-success bg-gradient text-white px-3 py-2 rounded shadow-sm">
                                    Data Wali
                                </h5>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col">

                                    {{-- Nama Wali --}}
                                    <div class="mb-4 mt-2">
                                        <label for="nama_wali" class="form-label">Nama Wali
                                        </label>
                                        <h5>
                                            {{ $pendaftar?->wali?->nama_walmur ? $pendaftar?->wali?->nama_walmur : '-' }}
                                        </h5>
                                    </div>

                                    {{-- Pekerjaan Wali --}}
                                    <div class="mb-4 mt-2">
                                        <label for="pekerjaan_wali" class="form-label">
                                            Pekerjaan Wali
                                        </label>
                                        <h5>
                                            {{ $pendaftar?->wali?->pekerjaan_walmur ? $pendaftar?->wali?->pekerjaan_walmur : '-' }}
                                        </h5>
                                    </div>

                                </div>
                                <div class="col">
                                    {{-- Alamat Wali --}}
                                    <div class="mb-4 mt-2">
                                        <label for="alamat_wali" class="form-label">
                                            Alamat Wali
                                        </label>
                                        <h5>
                                            {{ $pendaftar?->wali?->alamat_walmur ? $pendaftar?->wali?->alamat_walmur : '-' }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Pilih Jurusan --}}
                    <div class="error mx-auto mt-5 card card-content">

                        <div class="container-fluid mt-4">
                            <div class="d-flex form-label-spmb">
                                <h5 class="fw-bold bg-success bg-gradient text-white px-3 py-2 rounded shadow-sm">
                                    Jurusan yang dipilih
                                </h5>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col">

                                    {{-- Tingkat --}}
                                    <div class="mb-4 mt-2">
                                        <label for="tingkat" class="form-label">
                                            Tingkat Keterima
                                        </label>
                                        <h5>
                                            {{ $keterangan?->tingkat }}
                                        </h5>
                                    </div>

                                    {{-- Jurusan --}}
                                    <div class="mb-4">
                                        <label for="jurusan" class="form-label">
                                            Jurusan
                                        </label>
                                        <h5>
                                            {{ $keterangan?->nama_jurusan }}
                                        </h5>
                                    </div>

                                </div>
                                <div class="col">
                                    {{-- Tanggal --}}
                                    <div class="mb-4 mt-2">
                                        <label for="tanggal_keterima" class="form-label">
                                            Tanggal daftar
                                        </label>
                                        <h5>
                                            {{ \Carbon\Carbon::parse($keterangan?->tanggal_keterima)->translatedFormat('d F Y') }}
                                        </h5>
                                    </div>

                                    {{-- Tahun Pelajaran --}}
                                    <div class="mb-4">
                                        <label for="tahun_ajar" class="form-label">
                                            Tahun Pelajaran
                                        </label>
                                        <h5>
                                            {{ $keterangan?->tahun_ajar }}
                                        </h5>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>

        <!-- Modal View File -->
        <div class="modal fade" id="tampilBerkas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="tampilBerkasLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="tampilBerkasLabel">Lihat Berkas</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="tampil-berkas">
                        {{-- Berkas akan ditampilkan disini! --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        function tampilBerkas(berkas) {
            const url = `{{ asset('storage') }}/` + berkas;
            const html = `<img class="img-fluid img-thumbnail" src="` + url + `">`;
            $('#tampilBerkas').modal('show');
            $('#tampil-berkas').html(html);
        }
    </script>
@endpush
