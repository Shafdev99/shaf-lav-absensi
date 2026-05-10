<!-- Content -->
@extends('layout.app')
@section('title', 'Rekap Biodata Siswa')
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
                                Biodata siswa
                            </span>

                        </div>

                        <div class="mt-2 mb-3">
                            @include('binduk.rekap.navtabs')
                        </div>
                        {{-- End --}}

                        {{-- Table Biodata Desktop View --}}
                        {{-- Form content disini ! --}}
                        <form action="{{ route('rekap.form.biodata.update', $siswa->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <input type="hidden" value="{{ $menu }}" name="menu">
                            <input type="hidden" value="{{ request()->input('kelas') }}" name="kelas">
                            <input type="hidden" value="{{ request()->input('nama_siswa') }}" name="nama_siswa">
                            <input type="hidden" value="{{ $siswa->id }}" name="siswa_id">

                            {{-- Biodata Siswa --}}
                            <div class="container-fluid mt-4">
                                <h5 class="fw-bold">Biodata</h5>
                                <hr>
                                <div class="row">
                                    <div class="col">

                                        {{-- Anak ke --}}
                                        <div class="mb-4 mt-2">
                                            <label for="anak_ke" class="form-label">Anak ke
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('anak_ke') is-invalid @enderror" id="anak_ke"
                                                placeholder="Contoh : 3" name="anak_ke"
                                                value="{{ old('anak_ke') ? old('anak_ke') : $biodata?->anak_ke }}">
                                            @error('anak_ke')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Kewarganegaraan --}}
                                        <div class="mb-4">
                                            <label for="kewarganegaraan" class="form-label">Kewarganegaraan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('kewarganegaraan') is-invalid @enderror"
                                                id="kewarganegaraan" placeholder="Masukan kewarganegaraan!"
                                                name="kewarganegaraan"
                                                value="{{ old('kewarganegaraan') ? old('kewarganegaraan') : $biodata?->kewarganegaraan }}">
                                            @error('kewarganegaraan')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Saudara kandung --}}
                                        <div class="mb-4">
                                            <label for="saudara_kandung" class="form-label">Jumlah saudara kandung
                                                {{-- <span class="text-danger">*</span> --}}
                                            </label>
                                            <input type="text"
                                                class="form-control @error('saudara_kandung') is-invalid @enderror"
                                                id="saudara_kandung" placeholder="Contoh : 2" name="saudara_kandung"
                                                value="{{ old('saudara_kandung') ? old('saudara_kandung') : $biodata?->saudara_kandung }}">
                                            @error('saudara_kandung')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Saudara_tiri --}}
                                        <div class="mb-4">
                                            <label for="saudara_tiri" class="form-label">Jumlah saudara tiri
                                                {{-- <span class="text-danger">*</span> --}}
                                            </label>
                                            <input type="number"
                                                class="form-control @error('saudara_tiri') is-invalid @enderror"
                                                id="saudara_tiri" placeholder="Contoh : 1" name="saudara_tiri"
                                                value="{{ old('saudara_tiri') ? old('saudara_tiri') : $biodata?->saudara_tiri }}">
                                            @error('saudara_tiri')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Jumlah saudara angkat --}}
                                        <div class="mb-4">
                                            <label for="saudara_angkat" class="form-label">Jumlah saudara angkat
                                                {{-- <span class="text-danger">*</span> --}}
                                            </label>
                                            <input type="number"
                                                class="form-control @error('saudara_angkat') is-invalid @enderror"
                                                id="saudara_angkat" placeholder="Contoh : 2" name="saudara_angkat"
                                                value="{{ old('saudara_angkat') ? old('saudara_angkat') : $biodata?->saudara_angkat }}">
                                            @error('saudara_ngkat')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Kelengkapan orang tua --}}
                                        <div class="mb-4">
                                            <label for="kelengkapan_ortu" class="form-label">Kelengkapan orang tua
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="kelengkapan_ortu" id="kelengkapan_ortu"
                                                class="form-select @error('kelengkapan_ortu') is-invalid @enderror"">
                                                @foreach ($kelor as $item)
                                                    <option
                                                        {{ old('kelengkapan_ortu') == $item || $biodata?->kelengkapan_otu == $item ? 'selected' : '' }}
                                                        value="{{ $item }}">
                                                        {{ $item }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('kelengkapan_ortu')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Bahasa harian --}}
                                        <div class="mb-4">
                                            <label for="bahasa_harian" class="form-label">Bahasa harian
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input name="bahasa_harian"
                                                class="form-control @error('bahasa_harian') is-invalid @enderror"
                                                id="bahasa_harian" placeholder="Masukan bahasa harian!"
                                                value="{{ old('bahasa_harian') ? old('bahasa_harian') : $biodata?->bahasa_harian }}">
                                            @error('bahasa_harian')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Tinggal dengan --}}
                                        <div class="mb-4">
                                            <label for="tinggal_dengan" class="form-label">Tinggal dengan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="tinggal_dengan"
                                                class="form-control @error('tinggal_dengan') is-invalid @enderror"
                                                placeholder="Contoh : Orang tua"
                                                value="{{ old('tinggal_dengan') ? old('tinggal_dengan') : $biodata?->tinggal_dengan }}">
                                            @error('tinggal_dengan')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Jarak ke sekolah --}}
                                        <div class="mb-4">
                                            <label for="jarak_sekolah" class="form-label">Jarak ke sekolah
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="jarak_sekolah"
                                                class="form-control @error('jarak_sekolah') is-invalid @enderror"
                                                placeholder="Contoh : 3 Km, 5 Km, 20 Km"
                                                value="{{ old('jarak_sekolah') ? old('jarak_sekolah') : $biodata?->jarak_sekolah }}">
                                            @error('jarak_sekolah')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Telepon --}}
                                        <div class="mb-4">
                                            <label for="telepon" class="form-label">Telepon
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="telepon"
                                                class="form-control @error('tinggal_dengan') is-invalid @enderror"
                                                placeholder="Contoh : 089xxxxxxxxx"
                                                value="{{ old('telepon') ? old('telepon') : $biodata?->telepon }}">
                                            @error('telepon')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                            <p class="text-secondary mt-1" style="font-size: 12px;">
                                                Panjang nomor telepon maksimal 13 Karakter
                                            </p>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- Tombol Ubah --}}
                            <div class="container-fluid mt-3">
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
        </script>
    @endpush
