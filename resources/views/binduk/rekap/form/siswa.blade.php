<!-- Content -->
@extends('layout.app')
@section('title', 'Rekap Data Siswa')
@section('content')

    @php
        $parse = parse_url(url()->full());
        $url = isset($parse['query']) ? $parse['query'] : false;
        $menu = request()->segment(1);
    @endphp

    <div class="content content-sm">

        <div class="container">

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                Kelengkapan Data
            </div>
            {{-- End --}}

            {{-- <h5>Data Siswa</h5> --}}
            <div class="row mt-4">
                <div class="col-lg-9 mx-auto">
                    <div class="card p-lg-3 py-3 px-0 card-content">
                        {{-- Header Button --}}
                        <div class="d-flex mt-2 mb-3 px-2 justify-content-between">

                            <a href="{{ $menu == 'alumni' ? route('alumni', $url) : route('rekap', $url) }}"
                                class="btn btn-primary ms-2">
                                <i class="bi bi-arrow-left"></i>
                                Kembali
                            </a>

                            <span class="me-3 align-self-center">
                                Data siswa
                            </span>

                        </div>

                        <div class="mt-2 mb-3">
                            @include('binduk.rekap.navtabs')
                        </div>
                        {{-- End --}}

                        {{-- Table Siswa Desktop View --}}
                        {{-- Form content disini ! --}}
                        <form action="{{ route('rekap.form.siswa.update', $siswa->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <input type="hidden" value="{{ $menu }}" name="menu">
                            <input type="hidden" value="{{ request()->input('kelas') }}" name="kelas">
                            <input type="hidden" value="{{ request()->input('nama_siswa') }}" name="nama_siswa">

                            {{-- Data Siswa --}}
                            <div class="container-fluid mt-4">
                                <h5 class="fw-bold">Data Siswa</h5>
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
                                                value="{{ old('nama_lengkap') ? old('nama_lengkap') : $siswa->nama_lengkap }}">
                                            @error('nama_lengkap')
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
                                                value="{{ old('tanggal_lahir') ? old('tanggal_lahir') : $siswa->tanggal_lahir }}">
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
                                                value="{{ old('tempat_lahir') ? old('tempat_lahir') : $siswa->tempat_lahir }}">
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
                                                value="{{ old('nik') ? old('nik') : $siswa->nik }}">
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
                                                value="{{ old('nisn') ? old('nisn') : $siswa->nisn }}">
                                            @error('nisn')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                            <p class="text-secondary mt-1" style="font-size: 12px;">
                                                Panjang NISN Minimal 10 Karakter
                                            </p>
                                        </div>

                                        {{-- NIS --}}
                                        <div class="mb-4">
                                            <label for="nis" class="form-label">NIS
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="number" class="form-control @error('nis') is-invalid @enderror"
                                                id="nis" placeholder="Masukan nis!" name="nis"
                                                value="{{ old('nis') ? old('nis') : $siswa->nis }}">
                                            @error('nis')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                            <p class="text-secondary mt-1" style="font-size: 12px;">
                                                Panjang NIS Minimal 6 Karakter dan Maksimal 10 Karakter
                                            </p>
                                        </div>

                                        {{-- Alamat --}}
                                        <div class="mb-4">
                                            <label for="alamat" class="form-label">Alamat
                                                <span class="text-danger">*</span>
                                            </label>
                                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" cols="30"
                                                rows="4" placeholder="Masukan alamat!">{{ old('alamat') ? old('alamat') : $siswa->alamat }}</textarea>
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
                                                    {{ $siswa->jenis_kelamin == 'Laki-laki' || old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                                    Laki-laki</option>
                                                <option value="Perempuan"
                                                    {{ $siswa->jenis_kelamin == 'Perempuan' || old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                                    Perempuan</option>
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
                                                        {{ ucwords($siswa->agama) == $item->id || old('agama') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->agama }} </option>
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
                                            <label for="foto" class="form-label">Foto Siswa
                                                {{-- <span class="text-danger">*</span> --}}
                                            </label>
                                            <div class="@error('foto') dropify-invalid @enderror">
                                                <input type="file" name="foto" class="dropify"
                                                    data-allowed-file-extensions="jpg png jpeg"
                                                    data-default-file="{{ $siswa?->foto ? asset('storage/' . $siswa->foto) : '' }}" />
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

                            {{-- Tombol Ubah --}}
                            <div class="container-fluid mt-5">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-5">
                                            <button type="submit" class="btn btn-primary float-end">
                                                <i class="bi bi-send-fill me-1"></i>
                                                Ubah
                                            </button>
                                            <button type="Reset" class="btn btn-default-2 float-end me-2">Reset</button>
                                        </div>
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
            // Notif untuk data yang berhasil diproses
            @if (session('sukses'))
                let pesan = "{{ session('sukses') }}"
                toastr.success(pesan)
            @endif

            // Konfigurasi Dropify preview Image
            $('.dropify').dropify({
                messages: {
                    default: 'Pilih gambar anda! <br> Format gambar yang diwajibkan <br> adalah .JPG, .JPEG, .PNG!',
                    replace: 'Mau ganti gambar anda?',
                    remove: 'Hapus',
                    error: 'Ada kesalahan pada proses upload gambar!'
                }
            });
        </script>
    @endpush
