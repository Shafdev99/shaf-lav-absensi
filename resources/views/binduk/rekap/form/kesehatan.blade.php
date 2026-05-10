<!-- Content -->
@extends('layout.app')
@section('title', 'Rekap Kesehatan Siswa')
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
                                Kesehatan siswa
                            </span>

                        </div>

                        <div class="mt-2 mb-3">
                            @include('binduk.rekap.navtabs')
                        </div>
                        {{-- End --}}

                        {{-- TableKesehatan Desktop View --}}
                        {{-- Form content disini ! --}}
                        <form action="{{ route('rekap.form.kesehatan.update', $siswa->id) }}" method="post">
                            @csrf
                            @method('put')

                            <input type="hidden" value="{{ $menu }}" name="menu">
                            <input type="hidden" value="{{ request()->input('kelas') }}" name="kelas">
                            <input type="hidden" value="{{ request()->input('nama_siswa') }}" name="nama_siswa">
                            <input type="hidden" value="{{ $siswa->id }}" name="siswa_id">

                            {{-- Kesehatan Siswa --}}
                            <div class="container-fluid mt-4">
                                <h5 class="fw-bold">Kesehatan</h5>
                                <hr>
                                <div class="row">
                                    <div class="col">

                                        {{-- Golongan darah --}}
                                        <div class="mb-4 mt-2">
                                            <label for="golongan_darah" class="form-label">Golongan Darah
                                            </label>
                                            <select name="golongan_darah" class="form-select" id="">
                                                @foreach ($goldar as $item)
                                                    <option value="{{ $item }}">{{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- Kelainan jasmani --}}
                                        <div class="mb-4">
                                            <label for="kelainan_jasmani" class="form-label">Kelainan jasmani
                                            </label>
                                            <input type="text"
                                                class="form-control @error('kelainan_jasmani') is-invalid @enderror"
                                                id="kelainan_jasmani" placeholder="Masukan kelainan jasmani!"
                                                name="kelainan_jasmani"
                                                value="{{ old('kelainan_jasmani') ? old('kelainan_jasmani') : $kesehatan?->kelainan_jasmani }}">
                                        </div>

                                        {{-- Tinggi badan --}}
                                        <div class="mb-4">
                                            <label for="tinggi_badan" class="form-label">Jumlah tinggi badan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('tinggi_badan') is-invalid @enderror"
                                                id="tinggi_badan" placeholder="Contoh : 170" name="tinggi_badan"
                                                value="{{ old('tinggi_badan') ? old('tinggi_badan') : $kesehatan?->tinggi_badan }}">
                                            @error('tinggi_badan')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Berat badan --}}
                                        <div class="mb-4">
                                            <label for="berat_badan" class="form-label">Berat badan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="number"
                                                class="form-control @error('berat_badan') is-invalid @enderror"
                                                id="berat_badan" placeholder="Contoh : 65" name="berat_badan"
                                                value="{{ old('berat_badan') ? old('berat_badan') : $kesehatan?->berat_badan }}">
                                            @error('berat_badan')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Riwayat penyakit --}}
                                        <div class="mb-4">
                                            <label for="riwayat_penyakit" class="form-label">Riwayat penyakit
                                            </label>
                                            <textarea class="form-control" name="riwayat_penyakit" id="" cols="30" rows="5"
                                                placeholder="Misal : Asma, TBC, Demam berdarah">{{ old('riwayat_penyakit') ? old('riwayat_penyakit') : $kesehatan?->riwayat_penyakit }}</textarea>
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
