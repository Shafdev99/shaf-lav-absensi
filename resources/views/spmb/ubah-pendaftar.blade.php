<!-- Content -->
@extends('layout.app')
@section('title', 'Ubah Data Pendaftar')
@section('content')
    <div class="content">

        <div class="container ">

            <!-- Breadcrumb -->
            <div class="breadcrumb">
                <a href="{{ route('pendaftar') }}">Data
                    Pendaftar </a> /
                Ubah Pendaftar
            </div>

            <div class="row mt-4">
                <div class="col col-lg-9 mx-auto">
                    {{-- Head Button --}}
                    <div class="d-flex mt-2 mb-4 px-2 justify-content-between">
                        @php
                            $url = parse_url(url()->full());
                        @endphp
                        <a href="{{ route('pendaftar', $url['query'] ?? false) }}" class="btn btn-primary ms-2">
                            <i class="bi bi-arrow-left"></i>
                            Kembali
                        </a>
                        <h6 class="fw-bold align-self-center me-2">Ubah Data</h6>
                    </div>
                    {{-- End --}}
                    <form action="{{ route('spmb.perbarui.pendaftar', $pendaftar?->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        {{-- Data Pendaftar --}}
                        <div class="error mx-auto mt-2 card card-content">

                            <div class="container-fluid mt-4">
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
                                            <label for="nama-lengkap" class="form-label">Nama Lengkap
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('nama_lengkap') is-invalid @enderror"
                                                id="nama-lengkap" placeholder="Masukan nama lengkap!" name="nama_lengkap"
                                                value="{{ old('nama_lengkap') ? old('nama_lengkap') : $pendaftar?->nama_lengkap }}">
                                            @error('nama_lengkap')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Email --}}
                                        <div class="mb-4 mt-2">
                                            <label for="nama-lengkap" class="form-label">Email
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                                id="nama-lengkap" placeholder="Masukan email!" name="email"
                                                value="{{ old('email') ? old('email') : $pendaftar?->email }}">
                                            @error('email')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Tanggal Lahir --}}
                                        <div class="mb-4">
                                            <label for="tanggal-lahir" class="form-label">Tanggal Lahir
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="date"
                                                class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                id="tanggal-lahir" placeholder="Masukan tanggal lahir!" name="tanggal_lahir"
                                                value="{{ old('tanggal_lahir') ? old('tanggal_lahir') : $pendaftar?->tanggal_lahir }}">
                                            @error('tanggal_lahir')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Tempat Lahir --}}
                                        <div class="mb-4">
                                            <label for="tempat-lahir" class="form-label">Tempat Lahir
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('tempat_lahir') is-invalid @enderror"
                                                id="tempat-lahir" placeholder="Masukan tempat lahir!" name="tempat_lahir"
                                                value="{{ old('tempat_lahir') ? old('tempat_lahir') : $pendaftar?->tempat_lahir }}">
                                            @error('tempat_lahir')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- NIK --}}
                                        <div class="mb-4">
                                            <label for="nik" class="form-label">NIK
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="number" class="form-control @error('nik') is-invalid @enderror"
                                                id="nik" placeholder="Masukan nik!" name="nik"
                                                value="{{ old('nik') ? old('nik') : $pendaftar?->nik }}">
                                            @error('nik')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- NISN --}}
                                        <div class="mb-4">
                                            <label for="nisn" class="form-label">NISN
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="number" class="form-control @error('nisn') is-invalid @enderror"
                                                id="nisn" placeholder="Masukan nisn!" name="nisn"
                                                value="{{ old('nisn') ? old('nisn') : $pendaftar?->nisn }}">
                                            @error('nisn')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                            <p class="text-secondary mt-1" style="font-size: 12px;">
                                                Panjang NISN Minimal 10 Karakter
                                            </p>
                                        </div>

                                        {{-- Alamat --}}
                                        <div class="mb-4">
                                            <label for="alamat" class="form-label">Alamat
                                                <span class="text-danger">*</span>
                                            </label>
                                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" cols="30"
                                                rows="4" placeholder="Masukan alamat!">{{ old('alamat') ? old('alamat') : $pendaftar?->alamat }}</textarea>
                                            @error('alamat')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Jenis Kelamin --}}
                                        <div class="mb-4">
                                            <label for="jenis-kelamin" class="form-label">Jenis Kelamin
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="jenis_kelamin"
                                                class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                                id="jenis-kelamin">
                                                <option value="">Pilih jenis kelamin</option>
                                                <option value="Laki-laki"
                                                    {{ old('jenis_kelamin') == 'Laki-laki' || $pendaftar->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                                                    Laki-laki
                                                </option>
                                                <option value="Perempuan"
                                                    {{ old('jenis_kelamin') == 'Perempuan' || $pendaftar->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                                    Perempuan
                                                </option>
                                            </select>
                                            @error('jenis_kelamin')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Agama --}}
                                        <div class="mb-4">
                                            <label for="agama" class="form-label">Agama
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="agama"
                                                class="form-control @error('agama') is-invalid @enderror" id="agama">
                                                <option value="">Pilih agama</option>
                                                @foreach ($agama as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('agama') === $item->id || $pendaftar?->agama === $item->id ? 'selected' : '' }}>
                                                        {{ $item->agama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('agama')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Foto --}}
                                        <div class="">
                                            <label for="foto" class="form-label">Foto Siswa</label>
                                            <div class="@error('foto') dropify-invalid @enderror">
                                                <input type="file" name="foto"
                                                    data-allowed-file-extensions="jpg png jpeg" class="dropify"
                                                    data-default-file="{{ $pendaftar?->foto ? asset('storage/' . $pendaftar?->foto) : '' }}"
                                                    value="{{ $pendaftar?->foto }}" />
                                            </div>
                                            @error('foto')
                                                <div id="validationServer03Feedback" class="text-danger mt-1">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                            <ul class="text-secondary mt-2" style="font-size: 12px;">
                                                <li>Format file yang di dukung (JPEG, JPG, PNG)</li>
                                                <li>Maksimum kapasitas file ( 1024 Kb / 1 Mb)</li>
                                                <li>Dimensi yang disarankan ( 479 x 709 Pixel)</li>
                                            </ul>
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
                                            <label for="asal_sekolah" class="form-label">Nama Sekolah
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('asal_sekolah') is-invalid @enderror"
                                                placeholder="Nama asal sekolah!" name="asal_sekolah" required
                                                value="{{ old('asal_sekolah') ? old('asal_sekolah') : $pendaftar?->berkas->asal_sekolah }}">
                                            @error('asal_sekolah')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Alamat Sekolah --}}
                                        <div class="mb-4">
                                            <label for="alamat_sekolah" class="form-label">Alamat Sekolah
                                                <span class="text-danger">*</span>
                                            </label>
                                            <textarea name="alamat_sekolah" class="form-control @error('alamat_sekolah') is-invalid @enderror"
                                                id="alamat_sekolah" cols="30" rows="4" placeholder="Masukan alamat asal sekolah!">{{ old('alamat_sekolah') ? old('alamat_sekolah') : $pendaftar?->berkas->alamat_sekolah }}</textarea>
                                            @error('alamat_sekolah')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
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
                                            <label for="no_ijazah" class="form-label">Nomor Ijazah / STTB / Tahun
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('no_ijazah') is-invalid @enderror"
                                                placeholder="Masukan nomor Ijazah / STTB / Tahun" name="no_ijazah"
                                                required
                                                value="{{ old('no_ijazah') ? old('no_ijazah') : $pendaftar?->berkas->no_ijazah }}">
                                            @error('no_ijazah')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Rata-rata Nilai --}}
                                        <div class="mb-4 mt-2">
                                            <label for="rata_nilai" class="form-label">Rata-rata Nilai
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('rata_nilai') is-invalid @enderror"
                                                placeholder="Masukan rata-rata Nilai!" name="rata_nilai" required
                                                value="{{ old('rata_nilai') ? old('rata_nilai') : $pendaftar?->berkas->rata_nilai }}">
                                            @error('rata_nilai')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- File Ijazah/SKHU --}}
                                        <div class="">
                                            <label for="ijazah" class="form-label">File Ijazah/SKHU
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="@error('ijazah') dropify-invalid @enderror">
                                                <input type="file" name="ijazah"
                                                    data-allowed-file-extensions="jpg png jpeg" class="dropify"
                                                    data-default-file="{{ $pendaftar?->berkas?->ijazah ? asset('storage/' . $pendaftar?->berkas->ijazah) : '' }}"
                                                    value="{{ $pendaftar?->berkas->ijazah }}" />
                                            </div>
                                            @error('ijazah')
                                                <div id="validationServer03Feedback" class="text-danger mt-1">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                            <ul class="text-secondary mt-2" style="font-size: 12px;">
                                                <li>Format file yang di dukung (JPEG, JPG, PNG)</li>
                                                <li>Maksimum kapasitas file ( 1024 Kb / 1 Mb)</li>
                                            </ul>
                                        </div>

                                        {{-- Kartu Keluarga --}}
                                        <div class="">
                                            <label for="kartu_keluarga" class="form-label">Kartu Keluarga
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="@error('kartu_keluarga') dropify-invalid @enderror">
                                                <input type="file" name="kartu_keluarga"
                                                    data-allowed-file-extensions="jpg png jpeg" class="dropify"
                                                    data-default-file="{{ $pendaftar?->berkas?->kartu_keluarga ? asset('storage/' . $pendaftar?->berkas->kartu_keluarga) : '' }}"
                                                    value="{{ $pendaftar?->berkas->kartu_keluarga }}" />
                                            </div>
                                            @error('kartu_keluarga')
                                                <div id="validationServer03Feedback" class="text-danger mt-1">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                            <ul class="text-secondary mt-2" style="font-size: 12px;">
                                                <li>Format file yang di dukung (JPEG, JPG, PNG)</li>
                                                <li>Maksimum kapasitas file ( 1024 Kb / 1 Mb)</li>
                                            </ul>
                                        </div>

                                        {{-- Akta Kelahiran --}}
                                        <div class="">
                                            <label for="akta_kelahiran" class="form-label">Akta Kelahiran
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="@error('akta_kelahiran') dropify-invalid @enderror">
                                                <input type="file" name="akta_kelahiran"
                                                    data-allowed-file-extensions="jpg png jpeg" class="dropify"
                                                    data-default-file="{{ $pendaftar?->berkas?->akta_kelahiran ? asset('storage/' . $pendaftar?->berkas->akta_kelahiran) : '' }}"
                                                    value="{{ $pendaftar?->berkas->akta_kelahiran }}" />
                                            </div>
                                            @error('akta_kelahiran')
                                                <div id="validationServer03Feedback" class="text-danger mt-1">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                            <ul class="text-secondary mt-2" style="font-size: 12px;">
                                                <li>Format file yang di dukung (JPEG, JPG, PNG)</li>
                                                <li>Maksimum kapasitas file ( 1024 Kb / 1 Mb)</li>
                                            </ul>
                                        </div>

                                        {{-- Piagam Prestasi --}}
                                        <div class="">
                                            <label for="piagam_prestasi" class="form-label">Piagam Prestasi</label>
                                            <div class="@error('piagam_prestasi') dropify-invalid @enderror">
                                                <input type="file" name="piagam_prestasi"
                                                    data-allowed-file-extensions="jpg png jpeg" class="dropify"
                                                    data-default-file="{{ $pendaftar?->berkas?->piagam_prestasi ? asset('storage/' . $pendaftar?->berkas->piagam_prestasi) : '' }}"
                                                    value="{{ $pendaftar?->berkas->piagam_prestasi }}" />
                                            </div>
                                            @error('piagam_prestasi')
                                                <div id="validationServer03Feedback" class="text-danger mt-1">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                            <ul class="text-secondary mt-2" style="font-size: 12px;">
                                                <li>Format file yang di dukung (JPEG, JPG, PNG)</li>
                                                <li>Maksimum kapasitas file ( 1024 Kb / 1 Mb)</li>
                                            </ul>
                                        </div>

                                        {{-- Kartu Penerima Bantuan --}}
                                        <div class="">
                                            <label for="penerima_bantuan" class="form-label">Kartu Penerima
                                                Bantuan</label>
                                            <div class="@error('penerima_bantuan') dropify-invalid @enderror">
                                                <input type="file" name="penerima_bantuan"
                                                    data-allowed-file-extensions="jpg png jpeg" class="dropify"
                                                    data-default-file="{{ $pendaftar?->berkas?->kartu_bantuan ? asset('storage/' . $pendaftar?->berkas->kartu_bantuan) : '' }}"
                                                    value="{{ $pendaftar?->berkas->kartu_bantuan }}" />
                                            </div>
                                            @error('penerima_bantuan')
                                                <div id="validationServer03Feedback" class="text-danger mt-1">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                            <ul class="text-secondary mt-2" style="font-size: 12px;">
                                                <li>Format file yang di dukung (JPEG, JPG, PNG)</li>
                                                <li>Maksimum kapasitas file ( 1024 Kb / 1 Mb)</li>
                                            </ul>
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
                                            <label for="nama_ayah" class="form-label">Nama Ayah
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('nama_ayah') is-invalid @enderror"
                                                placeholder="Masukan nama ayah!" name="nama_ayah" required
                                                value="{{ old('nama_ayah') ? old('nama_ayah') : $pendaftar->ayah?->nama_ayah }}">
                                            @error('nama_ayah')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Pekerjaan Ayah --}}
                                        <div class="mb-4 mt-2">
                                            <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('pekerjaan_ayah') is-invalid @enderror"
                                                placeholder="Masukan pekerjaan ayah!" name="pekerjaan_ayah" required
                                                value="{{ old('pekerjaan_ayah') ? old('pekerjaan_ayah') : $pendaftar->ayah?->pekerjaan_ayah }}">
                                            @error('pekerjaan_ayah')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Nama Ibu --}}
                                        <div class="mb-4 mt-2">
                                            <label for="nama_ibu" class="form-label">Nama Ibu
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('nama_ibu') is-invalid @enderror"
                                                placeholder="Masukan nama ibu!" name="nama_ibu" required
                                                value="{{ old('nama_ibu') ? old('nama_ibu') : $pendaftar->ibu?->nama_ibu }}">
                                            @error('nama_ibu')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Pekerjaan Ibu --}}
                                        <div class="mb-4 mt-2">
                                            <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('pekerjaan_ibu') is-invalid @enderror"
                                                placeholder="Masukan pekerjaan ibu!" name="pekerjaan_ibu" required
                                                value="{{ old('pekerjaan_ibu') ? old('pekerjaan_ibu') : $pendaftar->ibu?->pekerjaan_ibu }}">
                                            @error('pekerjaan_ibu')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Alamat Orang Tua --}}
                                        <div class="mb-4">
                                            <label for="alamat_ortu" class="form-label">Alamat Orang Tua
                                                <span class="text-danger">*</span>
                                            </label>
                                            <textarea name="alamat_ortu" class="form-control @error('alamat_ortu') is-invalid @enderror" id="alamat_ortu"
                                                cols="30" rows="4" placeholder="Masukan alamat!">{{ old('alamat_ortu') ? old('alamat_ortu') : $pendaftar->ayah?->alamat_ayah }}</textarea>
                                            @error('alamat_ortu')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
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
                                                {{-- <span class="text-danger">*</span> --}}
                                            </label>
                                            <input type="text" class="form-control" placeholder="Masukan nama wali!"
                                                name="nama_wali"
                                                value="{{ old('nama_wali') ? old('nama_wali') : $pendaftar->wali?->nama_walmur }}">
                                            @error('nama_wali')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Pekerjaan Wali --}}
                                        <div class="mb-4 mt-2">
                                            <label for="pekerjaan_wali" class="form-label">Pekerjaan Wali
                                                {{-- <span class="text-danger">*</span> --}}
                                            </label>
                                            <input type="text" class="form-control"
                                                placeholder="Masukan pekerjaan wali!" name="pekerjaan_wali"
                                                value="{{ old('pekerjaan_wali') ? old('pekerjaan_wali') : $pendaftar->wali?->pekerjaan_walmur }}">
                                            @error('pekerjaan_wali')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Alamat Wali --}}
                                        <div class="mb-4">
                                            <label for="alamat_wali" class="form-label">Alamat Wali
                                                {{-- <span class="text-danger">*</span> --}}
                                            </label>
                                            <textarea name="alamat_wali" class="form-control @error('alamat_wali') is-invalid @enderror" id="alamat_wali"
                                                cols="30" rows="4" placeholder="Masukan alamat wali!">{{ old('alamat_wali') ? old('alamat_wali') : $pendaftar->wali?->alamat_wali }}</textarea>
                                            @error('alamat_wali')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
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
                                        Pilih Jurusan
                                    </h5>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">

                                        {{-- Tingkat --}}
                                        <div class="mb-4 mt-2">
                                            <label for="tingkat" class="form-label">Tingkat Keterima
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="hidden" name="tingkat_id" class="form-control"
                                                value="{{ $tingkat->id }}" id="tingkat_id">
                                            <input type="text" disabled class="form-control"
                                                value="{{ $tingkat->tingkat }}">
                                            @error('tingkat_id')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Jurusan --}}
                                        <div class="mb-4 mt-2">
                                            <label for="jurusan" class="form-label">Jurusan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="jurusan_id"
                                                class="form-control @error('jurusan_id') is-invalid @enderror"
                                                id="jurusan_id">
                                                <option value="">Pilih Jurusan</option>
                                                @foreach ($jurusan as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('jurusan_id') == $item->id || $pendaftar?->jurusan->id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->nama_jurusan . ' ( ' . $item->keterangan . ' )' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('jurusan_id')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                            <ul class="text-secondary mt-3" style="font-size: 12px;">
                                                @foreach ($jurusan as $item)
                                                    <li>
                                                        {{ $item->nama_jurusan . ' ( ' . $item->keterangan . ' )' }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>

                                        {{-- Kelas --}}
                                        <div class="mb-4 mt-2">
                                            {{-- <label for="kelas" class="form-label">Kelas
                                        <span class="text-danger">*</span>
                                    </label> --}}
                                            <input type="hidden" name="kelas_id" class="form-control" id="kelas-id">
                                            <input type="hidden" disabled class="form-control" id="display-kelas">
                                            @error('kelas_id')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Tanggal --}}
                                        <div class="mb-4">
                                            <label for="tanggal_keterima" class="form-label">Tanggal daftar
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="hidden" name="tanggal_keterima"
                                                class="form-control @error('tanggal_keterima') is-invalid @enderror"
                                                id="tanggal_keterima" placeholder="Masukan Tanggal!"
                                                value="{{ old('tanggal_keterima') ? old('tanggal_keterima') : date('Y-m-d') }}">
                                            <input type="text" disabled class="form-control"
                                                value="{{ \Carbon\Carbon::parse(date('d M Y'))->translatedFormat('d F Y') }}">
                                            @error('tanggal_keterima')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Tahun Pelajaran --}}
                                        <div class="mb-4">
                                            <label for="tahun_ajar" class="form-label">Tahun Pelajaran
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="hidden" name="tahun_ajar" class="form-control"
                                                value="{{ $tahunAjar->id }}">
                                            <input type="text" disabled class="form-control"
                                                value="{{ $tahunAjar->tahun_ajar }}">
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- Tombol Simpan --}}
                        <div class="container-fluid mt-5">
                            <div class="row col">
                                <div class="mb-3">
                                    <button type="submit" class=" btn btn-primary bg-gradient float-end">
                                        <i class="bi bi-send-fill me-1"></i>
                                        Simpan
                                    </button>
                                    <button type="Reset"
                                        class="btn btn-secondary bg-gradient float-end me-2">Reset</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

            </div>

        </div>

    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $('.dropify').dropify({
            messages: {
                default: 'Pilih gambar anda! <br> Format gambar yang diwajibkan <br> adalah .JPG, .JPEG, .PNG!',
                replace: 'Mau ganti gambar anda?',
                remove: 'Hapus',
                error: 'Ada kesalahan pada proses upload gambar!'
            }
        });

        function getKelas(jurusanId, tingkatId) {
            const url = "{{ url('/getOneKelasByJurusan') }}/";
            $.getJSON(url + jurusanId + '/' + tingkatId,
                function(data) {
                    let kelas_id = '';
                    let display = '';
                    if (data.length === 0) {
                        display += `Tidak memiliki kelas`;
                    } else {
                        kelas_id += data.id;
                        display +=
                            `${data.tingkat} ${data.nama_jurusan} ${data.nama_kelas} ( ${data.nama_kurikulum} )`;
                    }
                    $('#display-kelas').val(display);
                    $('#kelas-id').val(kelas_id);
                }
            );
        }

        $('#jurusan_id').change(function(e) {
            e.preventDefault();
            const tingkatId = $('#tingkat_id').val();
            getKelas(this.value, tingkatId);
        });

        $(document).ready(function() {
            const jurusanId = $('#jurusan_id').val();
            const tingkatId = $('#tingkat_id').val();
            getKelas(jurusanId, tingkatId);
        });
    </script>
@endpush
