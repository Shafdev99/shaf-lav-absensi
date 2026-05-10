<!-- Content -->
@extends('layout.app')
@section('title', 'Daftar Kelas Dan Jurusan')
@section('content')
    <div class="content content-sm">

        <div class="container">

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                Data Kelas
            </div>
            {{-- End --}}

            {{-- <h5>Data Kelas</h5> --}}
            {{-- Data Jurusan --}}
            <div class="row mt-5">
                <div class="col-8 mx-auto">

                    <div class=" card p-lg-3 p-2 card-content">
                        {{-- Header Button --}}
                        <div class="d-flex mt-2 mb-3 mb-lg-0">
                            <a href="javascript:void(0);" onclick="addJurusan()"
                                class="btn btn-primary d-none d-lg-block d-md-block">
                                <i class="bi bi-plus-lg"></i>
                                Tambah
                            </a>

                            {{-- Search Button Desktop --}}
                            <form action="{{ route('jurusan') }}" method="get" class="ms-auto me-2">
                                <div class="d-none d-lg-flex justify-content-center">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm form-default"
                                            placeholder="Cari data.." aria-describedby="button-addon2" name="nama_jurusan"
                                            value="{{ request('nama_jurusan') }}">
                                        <button type="submit" class="btn btn-default-2" type="button" id="button-addon2">
                                            Cari
                                        </button>
                                    </div>
                                </div>
                            </form>
                            {{-- End --}}

                            {{-- Tombol Refresh --}}
                            <a href="{{ route('jurusan') }}" class="btn btn-default-2 d-none d-lg-block d-md-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-arrow-clockwise " viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z" />
                                    <path
                                        d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466" />
                                </svg>
                                <span class=" ms-1">
                                    Refresh
                                </span>
                            </a>
                            {{-- End --}}

                            {{-- Search Button Mobile --}}
                            <form action="{{ route('jurusan') }}" method="get" class="ms-auto d-lg-none">
                                <div class="row mx-auto ">
                                    <div class="col d-flex">
                                        <div class="input-group mt-2 ">
                                            <input type="text"
                                                class="form-control form-control-sm form-default form-mobile"
                                                placeholder="Cari data.." aria-describedby="button-addon2"
                                                name="nama_jurusan" value="{{ request('nama_jurusan') }}"
                                                style="width: fit-content">
                                            <button type="submit" class="btn btn-default-2" type="button"
                                                id="button-addon2">
                                                Cari
                                            </button>
                                        </div>
                                        <a href="javascript:void(0);" id="dropdownMenuButtonMobile"
                                            data-bs-toggle="dropdown" aria-expanded="false"
                                            class="mt-2 ms-2 dropdown-toggle text-decoration-none text-dark align-self-center d-lg-none d-md-none">
                                            <i class="bi bi-three-dots-vertical" style="font-size: 20px;"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-tdesktop shadow"
                                            aria-labelledby="dropdownMenuButtonMobile">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('jurusan') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-arrow-clockwise ms-1"
                                                        viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd"
                                                            d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z" />
                                                        <path
                                                            d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466" />
                                                    </svg>
                                                    Refresh
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                            {{-- End --}}

                        </div>
                        {{-- End --}}

                        {{-- Table jurusan Desktop View --}}
                        @if (request(['nama_jurusan']) && !$jurusan->items())
                            <p class="text-center my-5 d-none d-md-inline d-lg-inline">Data yang anda cari tidak ada!
                            @elseif (empty($jurusan->items()))
                            <p class="text-center my-5 d-none d-md-inline d-lg-inline">Belum ada data Jurusan!</p>
                        @else
                            <table class="table d-none d-lg-table d-md-table desktop-table mt-4">
                                <tr class="tr-table">
                                    <th>
                                        No
                                    </th>
                                    <th>Jurusan</th>
                                    <th>Keterangan</th>
                                    <th></th>
                                </tr>
                                @foreach ($jurusan as $item)
                                    <tr style="color: rgb(26, 26, 26);">
                                        <td>
                                            {{ $loop->iteration }}).
                                        </td>
                                        <td>
                                            <div class="jenkel-l my-auto">
                                                <span class="fs-6">
                                                    {{ $item->nama_jurusan }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $item->keterangan }}
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);"
                                                onclick="editJurusan('{{ $item->nama_jurusan }}', '{{ $item->keterangan }}', '{{ $item->id }}')"
                                                class="text-decoration-none">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="javascript:void(0);" onclick="deleteJurusan('{{ $item->id }}')"
                                                class="text-decoration-none text-danger ms-1">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif
                        {{-- End --}}

                        {{-- Table jurusan Mobile View --}}
                        @if (request(['nama_jurusan']) && !$jurusan->items())
                            <p class="text-center my-5 d-none d-md-inline d-lg-inline">Data yang anda cari tidak ada!
                            @elseif (!$jurusan->items())
                            <p class="text-center my-3 d-lg-none d-md-none">Belum ada data Jurusan!</p>
                        @else
                            @foreach ($jurusan as $item)
                                <div class="card mb-2 p-2 d-lg-none d-md-none">
                                    <div class="d-flex">
                                        <div class="d-inline">
                                            <div class="fs-nama">{{ $item->nama_jurusan }}</div><br>
                                            {{ $item->keterangan }}
                                        </div>
                                        <a href="javascript:void(0);" id="dropdownMenuButtonMobile"
                                            data-bs-toggle="dropdown" aria-expanded="false"
                                            class="dropdown-toggle text-decoration-none text-dark ms-auto">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-tdesktop shadow"
                                            aria-labelledby="dropdownMenuButtonMobile">
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    onclick="editJurusan('{{ $item->nama_jurusan }}', '{{ $item->keterangan }}', '{{ $item->id }}')">
                                                    <i class="me-1 bi bi-pencil-square"></i>
                                                    Ubah
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    onclick="deleteJurusan('{{ $item->id }}')" class="dropdown-item">
                                                    <i class="me-1 bi bi-trash3-fill"></i>
                                                    Hapus
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        {{-- End --}}

                        {{-- Pagination --}}
                        {{ $jurusan->links() }}
                        {{-- End --}}
                    </div>
                </div>
            </div>

            {{-- Data Kelas --}}
            <div class="row mt-4">
                <div class="col-lg-8 mx-auto col-md-5 col mb-4 mb-lg-0 mb-md-0">
                    <div class="card p-lg-3 p-2 card-content">
                        {{-- Header Button --}}
                        <div class="d-flex mt-2 mb-3 mb-lg-0 ">
                            <div class="dropdown">
                                <a class="btn btn-primary dropdown-toggle d-none d-lg-block d-md-block" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-plus-lg"></i>
                                    Tambah
                                </a>
                                <ul id="pilihKelas" class="dropdown-menu pilihan-kelas">
                                    <li>
                                        <a href="javascript:void(0);" onclick="addTingkat()" class="dropdown-item fs-6"
                                            style="font-size: 12px !important;">
                                            Tingkat
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" onclick="addKelas()" class="dropdown-item fs-6"
                                            style="font-size: 12px !important;">
                                            Kelas
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            {{-- Tombol Refresh --}}
                            <a href="{{ route('kelas') }}"
                                class="btn btn-default-2 d-none d-lg-block d-md-block ms-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-arrow-clockwise " viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z" />
                                    <path
                                        d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466" />
                                </svg>
                                <span class=" ms-1">
                                    Refresh
                                </span>
                            </a>

                        </div>
                        {{-- End --}}

                        {{-- Table Kelas Desktop View --}}
                        @if ($tingkat || $kelas)
                            <div style="height: 350px; overflow-y: scroll;" class="d-none d-lg-block d-md-block">
                                <table class="table d-none d-lg-table d-md-table desktop-table mt-4">
                                    <tr class="tr-table">
                                        <th>No</th>
                                        <th>Tingkat</th>
                                        <th class="ps-5">Kelas</th>
                                        <th class="ps-5">Kurikulum</th>
                                        <th class="ps-5">Jumlah Jam Pelajaran</th>
                                        <th style="width: 15%"></th>
                                    </tr>
                                    @foreach ($tingkat as $row)
                                        <tr style="color: rgb(26, 26, 26);">
                                            <td>
                                                {{ $loop->iteration }}).
                                            </td>
                                            <td colspan="4">
                                                <div class="badge-globe px-3 my-auto">
                                                    <span class="fs-6">
                                                        Tingkat {{ $row->tingkat }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0);"
                                                    onclick="editTingkat(
                                                    '{{ $row->tingkat }}',
                                                    '{{ $row->id }}'
                                                    )"
                                                    class="text-decoration-none">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="javascript:void(0);"
                                                    onclick="deleteTingkat('{{ $row->id }}')"
                                                    class="text-decoration-none text-danger ms-1">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @foreach ($kelas as $item)
                                            @if ($row->id == $item->tingkat_id)
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <div class="badge-blobe px-3 my-auto ms-4">
                                                            <span class="fs-6">
                                                                {{ $item->tingkat }}
                                                                {{ $item->nama_jurusan }}
                                                                {{ $item->nama_kelas }}
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{ $item->nama_kurikulum }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $item->jumlah_jam ? $item->jumlah_jam . ' JP' : '-' }}
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);"
                                                            onclick="editKelas(
                                                            '{{ $item->id }}', 
                                                            '{{ $item->jurusan_id }}', 
                                                            '{{ $item->tingkat_id }}', 
                                                            '{{ $item->kurlum_id }}',
                                                            '{{ $item->nama_kelas }}',
                                                            '{{ $item->jumlah_jam }}'
                                                            )"
                                                            class="text-decoration-none">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>
                                                        <a href="javascript:void(0);"
                                                            onclick="deleteKelas('{{ $item->id }}')"
                                                            class="text-decoration-none text-danger ms-1">
                                                            <i class="bi bi-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach

                                </table>
                            </div>
                        @else
                            <p class="text-center my-5 d-none d-md-inline d-lg-inline">Belum ada data kelas dan tingkat!
                            </p>
                        @endif
                        {{-- End --}}

                        {{-- Table Kelas Mobile View --}}
                        @if ($tingkat || $kelas)
                            @foreach ($tingkat as $row)
                                <div class="card mb-2 p-2 d-lg-none d-md-none">
                                    <div class="d-flex">
                                        <div class="d-inline">
                                            <div class="fs-nama">{{ $loop->iteration }}). &nbsp; Tingkat
                                                {{ $row->tingkat }}
                                            </div>
                                        </div>
                                        <a href="javascript:void(0);" id="dropdownMenuButtonMobile"
                                            data-bs-toggle="dropdown" aria-expanded="false"
                                            class="dropdown-toggle text-decoration-none text-dark ms-auto">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-tdesktop shadow"
                                            aria-labelledby="dropdownMenuButtonMobile">
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    onclick="editTingkat('{{ $row->tingkat }}','{{ $row->id }}')">
                                                    <i class="me-1 bi bi-pencil-square"></i>
                                                    Ubah
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    onclick="deleteTingkat('{{ $row->id }}')" class="dropdown-item">
                                                    <i class="me-1 bi bi-trash3-fill"></i>
                                                    Hapus
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                @foreach ($kelas as $item)
                                    @if ($row->id == $item->tingkat_id)
                                        <div class="card ms-4 mb-2 p-2 d-lg-none d-md-none">
                                            <div class="d-flex">
                                                <div class="d-inline">
                                                    <div class="fs-nama">
                                                        {{ $item->tingkat . ' ' . $item->nama_jurusan . ' ' . $item->nama_kelas }}
                                                    </div>
                                                </div>
                                                <a href="javascript:void(0);" id="dropdownMenuButtonMobile"
                                                    data-bs-toggle="dropdown" aria-expanded="false"
                                                    class="dropdown-toggle text-decoration-none text-dark ms-auto">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-tdesktop shadow"
                                                    aria-labelledby="dropdownMenuButtonMobile">
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0);"
                                                            onclick="editKelas('{{ $item->id }}', '{{ $item->jurusan_id }}', '{{ $item->tingkat_id }}', '{{ $item->nama_kelas }}')">
                                                            <i class="me-1 bi bi-pencil-square"></i>
                                                            Ubah
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);"
                                                            onclick="deleteKelas('{{ $item->id }}')"
                                                            class="dropdown-item">
                                                            <i class="me-1 bi bi-trash3-fill"></i>
                                                            Hapus
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endforeach
                        @else
                            <p class="text-center my-3 d-lg-none d-md-none">Belum ada data Kelas!</p>
                        @endif
                        {{-- End --}}
                    </div>
                </div>

            </div>

        </div>

        <div class="dropdown">
            <a href="" class="btn btn-primary add-btn-siswa-mbl d-lg-none d-md-none dropdown-toggle"
                data-bs-toggle="dropdown">
                <i class="bi bi-plus-lg"></i>
            </a>
            <ul id="pilihKelas" class="dropdown-menu pilihan-kelas">
                <li>
                    <a href="javascript:void(0);" onclick="addTingkat()" class="dropdown-item fs-6"
                        style="font-size: 12px !important;">
                        Tingkat
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);" onclick="addKelas()" class="dropdown-item fs-6"
                        style="font-size: 12px !important;">
                        Kelas
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);" onclick="addJurusan()" class="dropdown-item fs-6"
                        style="font-size: 12px !important;">
                        Jurusan
                    </a>
                </li>
            </ul>
        </div>
    </div>

    {{-- 
    // Modal Untuk Bagian Kelas
    --}}

    {{-- Modal Tambah Kelas --}}
    <div class="modal fade" id="AddKelas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="AddKelasLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="AddKelasLabel">Tambah Kelas</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('kelas.add') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <label for="" class="mb-2">Tingkat</label>
                        <select name="tingkat_id" class="form-control @error('tingkat_id') is-invalid @enderror"
                            id="tingkat_id" required>
                            <option value="">Pilih tingkat</option>
                            @foreach ($tingkat as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('tingkat_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->tingkat }}
                                </option>
                            @endforeach
                        </select>
                        <label for="" class="mt-3 mb-2">Jurusan</label>
                        <select name="jurusan_id" class="form-control @error('jurusan_id') is-invalid @enderror"
                            id="jurusan_id" required>
                            <option value="">Pilih Jurusan</option>
                            @foreach ($jrsn as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('jurusan_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_jurusan . ' ( ' . $item->keterangan . ' )' }}
                                </option>
                            @endforeach
                        </select>
                        <label for="" class="mt-3 mb-2">Kurikulum</label>
                        <select name="kurlum_id" class="form-control @error('kurlum_id') is-invalid @enderror"
                            id="kurlum_id" required>
                            <option value="">Pilih Kurikulum</option>
                            @foreach ($kurlum as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('kurlum_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_kurikulum }}
                                </option>
                            @endforeach
                        </select>
                        <label for="" class="mt-3 mb-2">Nama Kelas</label>
                        <input type="text" class="form-control mb-4" name="nama_kelas"
                            placeholder="Masukan Nama Kelas!" required>
                        <label for="">Jumlah Jam Pelajaran</label>
                        <input type="number" class="form-control mb-4" name="jumlah_jam"
                            placeholder="Masukan Jumlah Jam Pelajaran!" required>
                    </div>
                    <div class="modal-footer border-top">
                        <button type="reset" class="btn btn-default-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send-fill me-1"></i>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End --}}

    {{-- Modal Edit Kelas --}}
    <div class="modal fade" id="editKelas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editKelasLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="editKelasLabel">Ubah Kelas</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('kelas.edit') }}" method="post">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <input type="hidden" class="form-control form-borderless" id="kelas-id-edit" name="kelas_id">
                        <label for="" class="mb-2">Tingkat</label>
                        <select name="tingkat_id" class="form-control @error('tingkat_id') is-invalid @enderror"
                            id="tingkat-id" required>
                            @foreach ($tingkat as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('tingkat_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->tingkat }}
                                </option>
                            @endforeach
                        </select>
                        <label for="" class="mt-3 mb-2">Jurusan</label>
                        <select name="jurusan_id" class="form-control @error('jurusan_id') is-invalid @enderror"
                            id="jurusan-id" required>
                            @foreach ($jrsn as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('jurusan_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_jurusan . ' ( ' . $item->keterangan . ' )' }}
                                </option>
                            @endforeach
                        </select>
                        <label for="" class="mt-3 mb-2">Kurikulum</label>
                        <select name="kurlum_id" class="form-control @error('kurlum_id') is-invalid @enderror"
                            id="kurlum-id" required>
                            <option value="">Pilih Kurikulum</option>
                            @foreach ($kurlum as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('kurlum_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_kurikulum }}
                                </option>
                            @endforeach
                        </select>
                        <label for="" class="mt-3 mb-2">Nama Kelas</label>
                        <input type="text" class="form-control mb-4" id="nama-kelas" name="nama_kelas"
                            placeholder="Masukan Nama Kelas!" required>
                        <label for="">Jumlah Jam Pelajaran</label>
                        <input type="number" class="form-control mb-4" id="jumlah-jam" name="jumlah_jam"
                            placeholder="Masukan Jumlah Jam Pelajaran!" required>
                    </div>
                    <div class="modal-footer border-top">
                        <button type="reset" class="btn btn-default-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send-fill me-1"></i>
                            Ubah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End --}}

    {{-- Modal Delete Kelas --}}
    <div class="modal fade" id="deleteKelas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteKelasLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="deleteKelasLabel">Hapus Kelas</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('kelas.delete') }}" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <p id="keterangan-to-Kelas" class="text-center"></p>
                        <input type="hidden" id="Kelas-id-delete" name="kelas_id">
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-default-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger d-none" id="delBtnKelas">
                            <i class="me-1 bi bi-trash3-fill"></i>
                            Hapus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End --}}



    {{-- 
    // Modal Untuk Bagian Tingkat
    --}}

    {{-- Modal Tambah Tingkat --}}
    <div class="modal fade" id="AddTingkat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="AddTingkatLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="AddTingkatLabel">Tambah Tingkat</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('tingkat.add') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="text" class="form-control form-borderless mb-4" name="tingkat"
                            placeholder="Masukan tingkat!" required>
                    </div>
                    <div class="modal-footer border-top">
                        <button type="reset" class="btn btn-default-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send-fill me-1"></i>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End --}}

    {{-- Modal Edit Tingkat --}}
    <div class="modal fade" id="editTingkat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editTingkatLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="editTingkatLabel">Ubah Tingkat</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('tingkat.edit') }}" method="post">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <input type="hidden" class="form-control form-borderless" id="tingkat-id-edit"
                            name="tingkat_id">
                        <input type="text" class="form-control form-borderless mb-4" id="tingkat" name="tingkat"
                            placeholder="Masukan tingkat!" required>
                    </div>
                    <div class="modal-footer border-top">
                        <button type="reset" class="btn btn-default-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send-fill me-1"></i>
                            Ubah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End --}}

    {{-- Modal Delete Tingkat --}}
    <div class="modal fade" id="deleteTingkat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteTingkatLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="deleteTingkatLabel">Hapus Tingkat</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('tingkat.delete') }}" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <p id="keterangan-to-Tingkat" class="text-center"></p>
                        <input type="hidden" id="Tingkat-id-delete" name="tingkat_id">
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-default-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger d-none" id="delBtnTingkat">
                            <i class="me-1 bi bi-trash3-fill"></i>
                            Hapus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End --}}


    {{-- 
    // Modal Untuk Bagian Jurusan 
    --}}

    {{-- Modal Tambah Jurusan --}}
    <div class="modal fade" id="AddJurusan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="AddJurusanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="AddJurusanLabel">Tambah Jurusan</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('jurusan.add') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <label for="" class="mb-2">Nama Jurusan</label>
                        <input type="text" class="form-control mb-4" name="nama_jurusan"
                            placeholder="Masukan Nama Jurusan!" required>
                        <label for="" class="mb-2">Keterangan Jurusan</label>
                        <input type="text" class="form-control" name="keterangan"
                            placeholder="Masukan Keterangan Jurusan!" required>
                    </div>
                    <div class="modal-footer border-top">
                        <button type="reset" class="btn btn-default-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send-fill me-1"></i>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End --}}

    {{-- Modal Edit Jurusan --}}
    <div class="modal fade" id="editJurusan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editJurusanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="editJurusanLabel">Ubah Jurusan</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('jurusan.edit') }}" method="post">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="jurusan-id-edit" name="jurusan_id">
                        <label for="" class="mb-2">Nama Jurusan</label>
                        <input type="text" class="form-control mb-4" id="nama-jurusan" name="nama_jurusan"
                            placeholder="Masukan Nama Jurusan!" required>
                        <label for="" class="mb-2">Keterangan Jurusan</label>
                        <input type="text" class="form-control" id="keterangan-jurusan" name="keterangan_jurusan"
                            placeholder="Masukan Keterangan Jurusan!" required>
                    </div>
                    <div class="modal-footer border-top">
                        <button type="reset" class="btn btn-default-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send-fill me-1"></i>
                            Ubah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End --}}

    {{-- Modal Delete Jurusan --}}
    <div class="modal fade" id="deleteJurusan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteJurusanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="deleteJurusanLabel">Hapus Jurusan</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('jurusan.delete') }}" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <p id="keterangan-to-jurusan" class="text-center"></p>
                        <input type="hidden" id="jurusan-id-delete" name="jurusan_id">
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-default-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger d-none" id="delBtnJurusan">
                            <i class="me-1 bi bi-trash3-fill"></i>
                            Hapus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End --}}

@endsection
@push('scripts')
    <script type="text/javascript">
        // Notif untuk data yang berhasil diproses
        @if (session('sukses'))
            let pesan = "{{ session('sukses') }}"
            toastr.success(pesan)
        @endif

        // Notif untuk data yang tidak lolos validasi
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.warning('{{ ucwords($error) }}');
            @endforeach
        @endif
        // End

        // Modal tambah Kelas
        function addKelas() {
            $('#AddKelas').modal('show');
        }

        // Modal edit Kelas
        function editKelas(id, jurusan_id, tingkat_id, kurlum_id, nama, jumlah_jam) {
            $('#kelas-id-edit').val(id);
            $('#nama-kelas').val(nama);
            $('#jurusan-id').val(jurusan_id);
            $('#tingkat-id').val(tingkat_id);
            $('#kurlum-id').val(kurlum_id);
            $('#jumlah-jam').val(jumlah_jam);
            $('#editKelas').modal('show');
        }

        // Modal hapus Kelas
        function deleteKelas(id) {
            // url
            const url = "{{ url('/getSiswaDalamKelas') }}/";

            $.getJSON(url + id,
                function(json) {
                    if (json != 0) {
                        $('#keterangan-to-Kelas').text('Kelas ini sudah digunakan!');
                        $('#delBtnKelas').addClass('d-none');
                    } else {
                        $('#keterangan-to-Kelas').text('Apakah anda yakin ingin menghapus Kelas ini?');
                        $('#delBtnKelas').removeClass('d-none');
                        $('#Kelas-id-delete').val(id);
                    }
                    $('#deleteKelas').modal('show');
                }
            );
        }


        // Modal tambah tingkat
        function addTingkat() {
            $('#AddTingkat').modal('show');
        }

        // Modal edit tingkat
        function editTingkat(tingkat, id) {
            $('#tingkat-id-edit').val(id);
            $('#tingkat').val(tingkat);
            $('#editTingkat').modal('show');
        }

        // Modal hapus Tingkat
        function deleteTingkat(id) {
            // url
            const url = "{{ url('/getKelasDalamTingkat') }}/";

            $.getJSON(url + id,
                function(json) {
                    if (json != 0) {
                        $('#keterangan-to-Tingkat').text('Tingkat ini sudah digunakan!');
                        $('#delBtnTingkat').addClass('d-none');
                    } else {
                        $('#keterangan-to-Tingkat').text('Apakah anda yakin ingin menghapus tingkat ini?');
                        $('#delBtnTingkat').removeClass('d-none');
                        $('#Tingkat-id-delete').val(id);
                    }
                    $('#deleteTingkat').modal('show');
                }
            );

        }


        // Modal tambah jurusan
        function addJurusan() {
            $('#AddJurusan').modal('show');
        }

        // Modal edit jurusan
        function editJurusan(nama, keterangan, id) {
            $('#jurusan-id-edit').val(id);
            $('#nama-jurusan').val(nama);
            $('#keterangan-jurusan').val(keterangan);
            $('#editJurusan').modal('show');
        }

        // Modal hapus jurusan
        function deleteJurusan(id) {
            // url
            const url = "{{ url('/getSiswaDalamJurusan') }}/";

            $.getJSON(url + id,
                function(json) {
                    if (json != 0) {
                        $('#keterangan-to-jurusan').text('Jurusan ini sudah digunakan!');
                        $('#delBtnJurusan').addClass('d-none');
                    } else {
                        $('#keterangan-to-jurusan').text('Apakah anda yakin ingin menghapus jurusan ini?');
                        $('#delBtnJurusan').removeClass('d-none');
                        $('#jurusan-id-delete').val(id);
                    }
                    $('#deleteJurusan').modal('show');
                }
            );
        }
    </script>
@endpush
