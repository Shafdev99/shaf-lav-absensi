<!-- Content -->
@extends('layout.app')
@section('title', 'Rekap Minat Siswa')
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
                                Minat siswa
                            </span>

                        </div>

                        <div class="mt-2 mb-3">
                            @include('binduk.rekap.navtabs')
                        </div>
                        {{-- End --}}

                        {{-- Table Minat Desktop View --}}
                        {{-- Form content disini ! --}}
                        <form action="{{ route('rekap.form.minat.update', $siswa->id) }}" method="post">
                            @csrf
                            @method('put')

                            <input type="hidden" value="{{ $menu }}" name="menu">
                            <input type="hidden" value="{{ request()->input('kelas') }}" name="kelas">
                            <input type="hidden" value="{{ request()->input('nama_siswa') }}" name="nama_siswa">
                            <input type="hidden" value="{{ $siswa->id }}" name="siswa_id">

                            {{-- Minat Siswa --}}
                            <div class="container-fluid mt-4">
                                <h5 class="fw-bold">Minat</h5>
                                <hr>
                                <div class="row">
                                    <div class="col">

                                        {{-- Kesenian --}}
                                        <div class="mb-4">
                                            <label for="kesenian" class="form-label">Kesenian
                                            </label>
                                            <input type="text"
                                                class="form-control @error('kesenian') is-invalid @enderror" id="kesenian"
                                                placeholder="Contoh : Seni tari, Melukis, Drama, dll." name="kesenian"
                                                value="{{ old('kesenian') ? old('kesenian') : $minat?->kesenian }}">
                                        </div>

                                        {{-- Olahraga --}}
                                        <div class="mb-4">
                                            <label for="olahraga" class="form-label">Olahraga
                                                {{-- <span class="text-danger">*</span> --}}
                                            </label>
                                            <input type="text"
                                                class="form-control @error('olahraga') is-invalid @enderror" id="olahraga"
                                                placeholder="Contoh : sepak bola, voli, basket, dll." name="olahraga"
                                                value="{{ old('olahraga') ? old('olahraga') : $minat?->olahraga }}">
                                            @error('olahraga')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- kemasyarakatan / Organisasi --}}
                                        <div class="mb-4">
                                            <label for="organisasi" class="form-label">kemasyarakatan /
                                                Organisasi
                                                {{-- <span class="text-danger">*</span> --}}
                                            </label>
                                            <input type="text"
                                                class="form-control @error('organisasi') is-invalid @enderror"
                                                id="organisasi" placeholder="Contoh : Osis, Karang taruna, Pramuka, dll."
                                                name="organisasi"
                                                value="{{ old('organisasi') ? old('organisasi') : $minat?->organisasi }}">
                                            @error('organisasi')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Lain - lain --}}
                                        <div class="mb-4">
                                            <label for="lain-lain" class="form-label">Lain - lain
                                            </label>
                                            <input type="text"
                                                class="form-control @error('lain_lain') is-invalid @enderror" id="lain_lain"
                                                placeholder="Contoh : Hadroh, Paduan suara, MC, dll." name="lain_lain"
                                                value="{{ old('lain_lain') ? old('lain_lain') : $minat?->lain_lain }}">
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

                        {{-- Add Button --}}
                        {{-- <div class="d-flex mt-4 mb-3 px-2 justify-content-between">

                            <span class="align-self-center">
                                Daftar Minat Siswa
                            </span>

                            <a href="javascript:void(0);" onclick="addMinat()" class="btn btn-primary ms-2">
                                <i class="bi bi-plus"></i>
                                Tambah
                            </a>

                        </div> --}}
                        {{-- End --}}

                        {{-- Table Minat Desktop View --}}
                        {{-- <table class="table d-none d-lg-table d-md-table desktop-table mt-4">

                            <tr class="tr-table">
                                <th>No</th>
                                <th>Nama Bidang</th>
                                <th>Minat</th>
                                <th>Keterangan Minat</th>
                                <th></th>
                            </tr>
                            @forelse ($minat? as $item)
                                <tr style="color: rgb(26, 26, 26);">
                                    <td>
                                        {{ $loop->iteration }}).
                                    </td>
                                    <td>
                                        <div class="fw-bold">
                                            {{ $item->bidang }}
                                        </div>
                                    </td>
                                    <td>
                                        {{ $item->minat }}
                                    </td>
                                    <td>
                                        {{ $item->ket_minat }}
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" id="dropdownMenuButtonMobile"
                                            data-bs-toggle="dropdown" aria-expanded="false"
                                            class="dropdown-toggle text-decoration-none text-dark">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-tdesktop shadow"
                                            aria-labelledby="dropdownMenuButtonMobile">
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    onclick="editMinat('{{ $item->id }}')">
                                                    <i class="me-1 bi bi-pencil-square"></i>
                                                    Ubah
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    onclick="deleteMinat('{{ $item->id }}')">
                                                    <i class="me-1 bi bi-trash3-fill"></i>
                                                    Hapus
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-3">
                                        Belum ada riwayat minat!
                                    </td>
                                </tr>
                            @endforelse
                        </table> --}}
                        {{-- End --}}

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
