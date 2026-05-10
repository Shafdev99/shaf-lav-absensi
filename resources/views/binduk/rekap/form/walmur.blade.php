<!-- Content -->
@extends('layout.app')
@section('title', 'Rekap Data Wali Murid')
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
                                Data wali murid
                            </span>

                        </div>

                        <div class="mt-2 mb-3">
                            @include('binduk.rekap.navtabs')
                        </div>
                        {{-- End --}}

                        {{-- Table walmur Desktop View --}}
                        {{-- Form content disini ! --}}
                        <form action="{{ route('rekap.form.walmur.update', $siswa->id) }}" method="post">
                            @csrf
                            @method('put')

                            <input type="hidden" value="{{ $menu }}" name="menu">
                            <input type="hidden" value="{{ request()->input('kelas') }}" name="kelas">
                            <input type="hidden" value="{{ request()->input('nama_siswa') }}" name="nama_siswa">
                            <input type="hidden" value="{{ $siswa->id }}" name="siswa_id">

                            {{-- Data Walmur --}}
                            <div class="container-fluid mt-4">
                                <h5 class="fw-bold">Data Wali Murid</h5>
                                <hr>
                                <div class="row">
                                    <div class="col">

                                        {{-- Nama lengkap walmur --}}
                                        <div class="mb-4 mt-2">
                                            <label for="nama-lengkap-walmur" class="form-label">Nama Lengkap
                                                {{-- <span class="text-danger">*</span> --}}
                                            </label>
                                            <input type="text"
                                                class="form-control @error('nama_walmur') is-invalid @enderror"
                                                id="nama-lengkap-walmur" placeholder="Masukan nama lengkap!"
                                                name="nama_walmur"
                                                value="{{ old('nama_walmur') ? old('nama_walmur') : $walmur?->nama_walmur }}">
                                            @error('nama_walmur')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- NIK walmur --}}
                                        <div class="mb-4 mt-2">
                                            <label for="nik-walmur" class="form-label">NIK
                                                {{-- <span class="text-danger">*</span> --}}
                                            </label>
                                            <input type="text"
                                                class="form-control @error('nik_walmur') is-invalid @enderror"
                                                id="nik-walmur" placeholder="Masukan NIK!" name="nik_walmur"
                                                value="{{ old('nik_walmur') ? old('nik_walmur') : $walmur?->nik_walmur }}">
                                            @error('nik_walmur')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Tanggal lahir walmur --}}
                                        <div class="mb-4">
                                            <label for="tanggal-lahir-walmur" class="form-label">Tanggal Lahir
                                                {{-- <span class="text-danger">*</span> --}}
                                            </label>
                                            <input type="date"
                                                class="form-control @error('tanggal_lahir_walmur') is-invalid @enderror"
                                                id="tanggal-lahir-walmur" placeholder="Masukan tanggal lahir!"
                                                name="tanggal_lahir_walmur"
                                                value="{{ old('tanggal_lahir_walmur') ? old('tanggal_lahir_walmur') : $walmur?->tanggal_lahir_walmur }}">
                                            @error('tanggal_lahir_walmur')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Tempat lahir walmur --}}
                                        <div class="mb-4">
                                            <label for="tempat-lahir-walmur" class="form-label">Tempat Lahir
                                                {{-- <span class="text-danger">*</span> --}}
                                            </label>
                                            <input type="text"
                                                class="form-control @error('tempat_lahir_walmur') is-invalid @enderror"
                                                id="tempat-lahir-walmur" placeholder="Masukan tempat lahir!"
                                                name="tempat_lahir_walmur"
                                                value="{{ old('tempat_lahir_walmur') ? old('tempat_lahir_walmur') : $walmur?->tempat_lahir_walmur }}">
                                            @error('tempat_lahir_walmur')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Alamat walmur --}}
                                        <div class="mb-4">
                                            <label for="alamat_walmur" class="form-label">Alamat
                                                {{-- <span class="text-danger">*</span> --}}
                                            </label>
                                            <textarea name="alamat_walmur" class="form-control @error('alamat_walmur') is-invalid @enderror" id="alamat_walmur"
                                                cols="30" rows="4" placeholder="Masukan alamat walmur!">{{ old('alamat_walmur') ? old('alamat_walmur') : $walmur?->alamat_walmur }}</textarea>
                                            @error('alamat_walmur')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Agama walmur --}}
                                        <div class="mb-4">
                                            <label for="agama_walmur" class="form-label">Agama
                                                {{-- <span class="text-danger">*</span> --}}
                                            </label>
                                            <select name="agama_walmur"
                                                class="form-control @error('agama_walmur') is-invalid @enderror"
                                                id="agama_walmur">
                                                <option value="">Pilih agama </option>
                                                @foreach ($agama as $agm)
                                                    <option {{ $agm->id == $walmur?->agama_walmur ? 'selected' : '' }}
                                                        value="{{ $agm->id }}">
                                                        {{ $agm->agama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('agama_walmur')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Kewarganegaraan walmur --}}
                                        <div class="mb-4">
                                            <label for="kewarganegaraan_walmur" class="form-label">Kewarganegaraan
                                                {{-- <span class="text-danger">*</span> --}}
                                            </label>
                                            <input type="text"
                                                class="form-control @error('kewarganegaraan_walmur') is-invalid @enderror"
                                                placeholder="Contoh : WNI" name="kewarganegaraan_walmur"
                                                value="{{ $walmur?->kewarganegaraan_walmur }}">
                                            @error('kewarganegaraan_walmur')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Pendidikan walmur --}}
                                        <div class="mb-4">
                                            <label for="pendidikan_walmur" class="form-label">Pendidikan
                                                {{-- <span class="text-danger">*</span> --}}
                                            </label>
                                            <select class="form-select @error('pendidikan_walmur') is-invalid @enderror"
                                                name="pendidikan_walmur" id="pendidikan_walmur">
                                                <option value="">Pilih pendidikan</option>
                                                @foreach ($pendidikan as $pdk)
                                                    <option {{ $pdk->id == $walmur?->pendidikan_walmur ? 'selected' : '' }}
                                                        value="{{ $pdk->id }}">
                                                        {{ $pdk->pendidikan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('pendidikan_walmur')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Pekerjaan walmur --}}
                                        <div class="mb-4">
                                            <label for="pekerjaan_walmur" class="form-label ">Pekerjaan
                                                {{-- <span class="text-danger">*</span> --}}
                                            </label>
                                            <input type="text"
                                                class="form-control @error('pekerjaan_walmur') is-invalid @enderror"
                                                placeholder="Contoh : Petani, PNS, Pengusaha" name="pekerjaan_walmur"
                                                value="{{ $walmur?->pekerjaan_walmur }}">
                                            @error('pekerjaan_walmur')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Penghasilan walmur --}}
                                        <div class="mb-4">
                                            <label for="penghasilan_walmur" class="form-label ">Penghasilan
                                                {{-- <span class="text-danger">*</span> --}}
                                            </label>
                                            <input type="text"
                                                class="form-control @error('penghasilan_walmur') is-invalid @enderror"
                                                placeholder="Contoh : 2.000.000" name="penghasilan_walmur"
                                                value="{{ $walmur?->penghasilan_walmur }}">
                                            @error('penghasilan_walmur')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Hubungan dengan siswa  --}}
                                        <div class="mb-4">
                                            <label for="hubungan_dengan_siswa_walmur" class="form-label ">Hubungan dengan
                                                siswa
                                                {{-- <span class="text-danger">*</span> --}}
                                            </label>
                                            <input type="text"
                                                class="form-control @error('hubungan_siswa_walmur') is-invalid @enderror"
                                                placeholder="Contoh : Paman, Kakak, Kakek, Nenek, Opung, Dll."
                                                name="hubungan_siswa_walmur"
                                                value="{{ $walmur?->hubungan_siswa_walmur }}">
                                            @error('hubungan_siswa_walmur')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Nomor telepon walmur --}}
                                        <div class="mb-4">
                                            <label for="telp_walmur" class="form-label">No telepon
                                                {{-- <span class="text-danger">*</span> --}}
                                            </label>
                                            <input type="text"
                                                class="form-control @error('telp_walmur') is-invalid @enderror"
                                                placeholder="Contoh : 089xxxxxxxxx" name="telp_walmur"
                                                value="{{ $walmur?->telp_walmur }}">
                                            @error('telp_walmur')
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
                            <div class="container-fluid mt-2">
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
