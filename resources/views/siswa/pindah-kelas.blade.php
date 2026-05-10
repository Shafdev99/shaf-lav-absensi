<!-- Content -->
@extends('layout.app')
@section('title', 'Pindah Kelas')
@section('content')

    @php
        $parse = parse_url(url()->full());
        $url = isset($parse['query']) ? $parse['query'] : false;
    @endphp

    <div class="content content-sm">

        <div class="container">

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                Pindah Kelas
            </div>
            {{-- End --}}

            {{-- <h5>Data Siswa</h5> --}}
            <div class="row mt-4">
                <div class="col">
                    <div class="card p-lg-3 p-2 card-content">
                        {{-- Header Button --}}
                        <div class="d-flex mt-2 mb-3 mb-lg-0">

                            <h6>
                                Data Siswa
                            </h6>

                            {{-- Search Button --}}
                            <form action="{{ route('siswa') }}" method="get" class="ms-lg-auto me-2 ">
                                <div class="d-none d-lg-flex justify-content-center">
                                    <select class="form-select form-select-sm me-2" style="width: 350px;" name="kelas"
                                        id="pilih-kelas-id">
                                        @forelse ($kelas as $item)
                                            <option value="{{ $item->kelas_id }}"
                                                {{ request('kelas') == $item->kelas_id ? 'selected' : '' }}>
                                                {{ $item->tingkat . ' ' . $item->nama_jurusan . ' ' . $item->nama_kelas }}
                                            </option>
                                        @empty
                                            <option value="">Belum ada kelas!</option>
                                        @endforelse
                                    </select>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm form-default"
                                            placeholder="Cari data.." aria-describedby="button-addon2" name="nama_siswa"
                                            value="{{ request('nama_siswa') }}" style="width: 50px;" id="nama-siswa">
                                        <button type="submit" class="btn btn-default-2" type="button" id="button-addon2">
                                            Cari
                                        </button>
                                    </div>
                                </div>
                            </form>
                            {{-- End --}}

                            {{-- Tombol Hapus --}}
                            {{-- <a href="javascript:void(0);" id="tmb-hapus"
                                class="btn btn-danger disabled me-2 ms-auto ms-lg-0 d-none d-lg-block d-md-block  py-1 px-2 pe-1 pe-lg-2">
                                <i class="bi bi-trash-fill me-1" style="font-size: 16px;"></i>
                                <span class="d-none d-lg-inline d-md-inline">
                                    Hapus
                                </span>
                            </a> --}}
                            <a href="javascript:void(0);" id="tmb-hapus"
                                class="btn btn-danger disabled me-2 ms-auto ms-lg-0 d-none d-lg-block d-md-block  py-1 px-2 pe-1 pe-lg-2">
                                <i class="bi bi-trash-fill me-1" style="font-size: 16px;"></i>
                                <span class="d-none d-lg-inline d-md-inline">
                                    Pindah Kelas
                                </span>
                            </a>

                            {{-- Tombol Refresh --}}
                            <a href="{{ route('siswa') }}" class="btn btn-default-2 d-none d-lg-block d-md-block">
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

                            {{-- Tombol Import --}}
                            {{-- <a href="javascript:void(0);" class="btn btn-default-2 ms-2 d-none d-lg-block d-md-block"
                                data-bs-toggle="modal" data-bs-target="#importExcel">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-file-earmark-arrow-up me-1" viewBox="0 0 16 16">
                                    <path
                                        d="M8.5 11.5a.5.5 0 0 1-1 0V7.707L6.354 8.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 7.707z" />
                                    <path
                                        d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                                </svg>
                                Import
                            </a> --}}

                            {{-- Tombol Export --}}
                            {{-- <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#exportExcel"
                                class="btn btn-default-2 ms-2 d-none d-lg-block d-md-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-file-earmark-arrow-down me-1" viewBox="0 0 16 16">
                                    <path
                                        d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293z" />
                                    <path
                                        d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                                </svg>
                                Export
                            </a> --}}

                        </div>
                        {{-- End --}}

                        {{-- Table Siswa Desktop View --}}
                        <table class="table d-none d-lg-table d-md-table desktop-table mt-4">
                            <tr class="tr-table">
                                <th>
                                    <input type="checkbox" id="check-all">
                                </th>
                                <th>Nama</th>
                                <th>NIS</th>
                                <th>Jenis Kelamin</th>
                                <th>Kelas</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            @forelse ($siswa as $item)
                                <tr style="color: rgb(26, 26, 26);">
                                    <td>
                                        @if ($item->status != 'alumni')
                                            <input type="checkbox" value="{{ $item?->id }}" class="check-item"
                                                name="id_siswa[]">
                                        @endif
                                    </td>
                                    <td class="d-flex">
                                        <img src="{{ $item->foto ? asset('storage/' . $item->foto) : asset('img/logo/profile.jpg') }}"
                                            class="d-none d-lg-block img-fluid rounded-pill img-user align-self-center me-3"
                                            alt="user-photo">
                                        <div class="d-inline">
                                            <div class="fs-nama">{{ $item->nama_lengkap }}</div><br>
                                            {{ $item->nisn }}
                                        </div>
                                    </td>
                                    <td>{{ $item->nis }}</td>
                                    <td class="ps-2">
                                        <div class="{{ $item->jenis_kelamin == 'Laki-laki' ? 'jenkel-l' : 'jenkel-p' }}">
                                            {{ $item->jenis_kelamin }}
                                        </div>
                                    </td>
                                    <td>
                                        <b>
                                            <i class="bi bi-door-closed-fill"></i>
                                            {{ $item->tingkat . ' ' . $item->nama_jurusan . ' ' . $item->nama_kelas }}
                                        </b>
                                    </td>
                                    <td>
                                        <span
                                            class="badge {{ $item->status == 'aktif' || $item->status == 'alumni' ? 'badge-status-aktif' : 'badge-status-nonaktif' }} ">
                                            {{ ucwords($item->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($item->status != 'alumni')
                                            <a href="javascript:void(0);" id="dropdownMenuButtonMobile"
                                                data-bs-toggle="dropdown" aria-expanded="false"
                                                class="dropdown-toggle text-decoration-none text-dark">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-tdesktop shadow"
                                                aria-labelledby="dropdownMenuButtonMobile">
                                                <li>
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        onclick="detailData('{{ $item->id }}')">
                                                        <i class="me-1 bi bi-file-earmark-fill"></i>
                                                        Detail
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('siswa.edit', $item->id . '?' . $url) }}">
                                                        <i class="me-1 bi bi-pencil-square"></i>
                                                        Ubah
                                                    </a>
                                                </li>
                                                <li>
                                                    <a onclick="hapusData('{{ $item->id }}')" class="dropdown-item"
                                                        href="javascript:void(0);">
                                                        <i class="me-1 bi bi-trash3-fill"></i>
                                                        Hapus
                                                    </a>
                                                </li>
                                            </ul>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" align="center">Data tidak ada!</td>
                                </tr>
                            @endforelse
                        </table>
                        {{-- End --}}

                        {{-- Table Siswa Mobile View --}}
                        {{-- @if (request('keyword') && !$siswa->items())
                            <p class="text-center my-3 d-lg-none d-md-none">Data yang anda cari tidak ada!</p>
                        @elseif(!$siswa->items())
                            <p class="text-center my-3 d-lg-none d-md-none">Belum ada data siswa!</p>
                        @else
                            <div class="d-flex mb-2 mt-3 d-lg-none d-md-none">
                                <input type="checkbox" id="check-all-mobile" class="me-1 ms-2">
                                <span>
                                    Pilih semua
                                </span>
                            </div>
                            @foreach ($siswa as $item)
                                <div class="card mb-2 p-2 d-lg-none d-md-none">
                                    <div class="d-flex">
                                        <input type="checkbox" id="mobile-pilih-siswa" value="{{ $item->id }}"
                                            class="check-item me-2" name="id_siswa[]">
                                        <img src="{{ $item?->foto ? asset('storage/' . $item->foto) : asset('img/logo/profile.jpg') }}"
                                            class="img-fluid rounded-pill img-user align-self-center me-3"
                                            alt="user-photo">
                                        <div class="d-inline">
                                            <div class="fs-nama">{{ $item->nama_lengkap }}</div><br>
                                            {{ $item->nik }}
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
                                                    onclick="detailData('{{ $item->id }}')">
                                                    <i class="me-1 bi bi-file-earmark-fill"></i>
                                                    Detail
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('siswa.edit', $item->id) }}">
                                                    <i class="me-1 bi bi-pencil-square"></i>
                                                    Ubah
                                                </a>
                                            </li>
                                            <li>
                                                <a onclick="hapusData('{{ $item->id }}')" class="dropdown-item"
                                                    href="javascript:void(0);">
                                                    <i class="me-1 bi bi-trash3-fill"></i>
                                                    Hapus
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        @endif --}}
                        {{-- End --}}

                        {{-- Pagination --}}
                        {{ $siswa->links() }}
                        {{-- End --}}
                    </div>
                </div>
            </div>

        </div>
        <a href="{{ route('siswa.add') }}" class="btn btn-primary add-btn-siswa-mbl d-lg-none d-md-none">
            <i class="bi bi-plus-lg"></i>
        </a>
    </div>

    {{-- Modal Detail Siswa --}}
    <div class="modal fade" id="detailSiswa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="detailSiswaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="detailSiswaLabel">Detail Data</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Data Siswa --}}
                    <div class="container">
                        <h6>Data Siswa</h6>
                        <hr>
                        <div class="row bg-layer data-detail-siswa rounded pt-2 text-wrap">
                            <div class="col-6">
                                <span class="text-secondary">Nama Lengkap</span>
                                <h6 class="mb-3" id="nama"></h6>
                                <span>Tempat Lahir</span>
                                <h6 class="mb-3" id="tempat_lahir"></h6>
                                <span>Tanggal Lahir</span>
                                <h6 class="mb-3" id="tanggal_lahir"></h6>
                                <span>Jenis Kelamin</span>
                                <h6 class="mb-3" id="jenis_kelamin"></h6>
                                <span>Agama</span>
                                <h6 class="mb-3" id="agama"></h6>
                            </div>
                            <div class="col-6">
                                <span>NIK</span>
                                <h6 class="mb-3" id="nik"></h6>
                                <span>NISN</span>
                                <h6 class="mb-3" id="nisn"></h6>
                                <span>NIS</span>
                                <h6 class="mb-3" id="nis"></h6>
                                <span>Alamat</span>
                                <h6 class="mb-3" id="alamat"></h6>
                            </div>
                        </div>
                    </div>
                    {{-- Data Orang Tua --}}
                    <div class="container mt-5">
                        <h6>Data Orang Tua</h6>
                        <hr>
                        <div class="row bg-layer data-detail-siswa rounded pt-2">
                            <div class="col-6">
                                <span>Nama Ayah</span>
                                <h6 class="mb-3" id="nama_ayah"></h6>
                                <span>Nama Ibu</span>
                                <h6 class="mb-3" id="nama_ibu"></h6>
                            </div>
                            <div class="col-6">
                                <span>Alamat Orang Tua</span>
                                <h6 class="mb-3" id="alamat_ortu"></h6>
                            </div>
                        </div>
                    </div>
                    {{-- Data Wali --}}
                    <div class="container mt-5">
                        <h6>Data Wali</h6>
                        <hr>
                        <div class="row bg-layer data-detail-siswa rounded pt-2">
                            <div class="col-6">
                                <span>Nama Wali</span>
                                <h6 class="mb-3" id="nama_wali"></h6>
                            </div>
                            <div class="col-6">
                                <span>Alamat Wali</span>
                                <h6 class="mb-3" id="alamat_wali"></h6>
                            </div>
                        </div>
                    </div>
                    {{-- Data Asal Sekolah --}}
                    <div class="container mt-5">
                        <h6>Data Asal Sekolah</h6>
                        <hr>
                        <div class="row bg-layer data-detail-siswa rounded pt-2">
                            <div class="col-6">
                                <span>Nama Sekolah</span>
                                <h6 class="mb-3" id="nama_sekolah"></h6>
                                <span>Alamat Sekolah</span>
                                <h6 class="mb-3" id="alamat_sekolah"></h6>
                            </div>
                            <div class="col-6">
                                <span>Tahun Lulus</span>
                                <h6 class="mb-3" id="tahun_lulus"></h6>
                                <span>Nomer Ijazah</span>
                                <h6 class="mb-3" id="nomer_ijazah"></h6>
                            </div>
                        </div>
                    </div>
                    {{-- Data Keterangan Keterima --}}
                    <div class="container mt-5">
                        <h6>Keterangan Keterima</h6>
                        <hr>
                        <div class="row bg-layer data-detail-siswa rounded pt-2">
                            <div class="col-6">
                                <span>Di Tingkat</span>
                                <h6 class="mb-3" id="tingkat_keterima"></h6>
                                <span>Tanggal Keterima</span>
                                <h6 class="mb-3" id="tanggal_keterima"></h6>

                            </div>
                            <div class="col-6">
                                <span>Tahun Pelajaran</span>
                                <h6 class="mb-3" id="tahun_ajar"></h6>
                                <span>Status Kelulusan</span>
                                <h6 class="mb-3" id="lulus"></h6>
                            </div>
                        </div>
                    </div>
                    {{-- Foto Siswa --}}
                    <div class="container-fluid mt-3">
                        <div class="row">
                            <div class="col">
                                <span class="fw-bold">Foto Siswa</span>
                                <img src="" class="img-fluid d-block img-thumbnail shadow mt-2" width="150"
                                    alt="" id="foto">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End --}}

    {{-- Modal Hapus Siswa --}}
    <div class="modal fade" id="hapusSiswa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="hapusSiswaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="hapusSiswaLabel">Hapus Siswa</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('siswa.delete', $url) }}" method="post">
                        @csrf
                        @method('delete')
                        <p class="text-center peringatan-modal">Anda yakin ingin menghapus data ini?</p>
                        <div class="button-modal d-flex justify-content-center">
                            <input type="hidden" name="id" id="id-siswa">
                            <button type="button" class="btn btn-default-2 me-2" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash-fill me-1"></i>
                                Hapus
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End --}}

    <!-- Modal Import Excel -->
    <div class="modal fade" id="importExcel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="importExcelLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="importExcelLabel">Import Excel</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('import.siswa') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        {{-- Import Excel Data Siswa --}}
                        <div class="@error('importFile') dropify-invalid @enderror">
                            <input type="file" name="importFile" class="dropify"
                                data-allowed-file-extensions="xls xlsx" />
                        </div>
                        @error('importFile')
                            <div id="validationServer03Feedback" class="text-danger mt-1">{{ ucwords($message) }}
                            </div>
                        @enderror

                        {{-- Download Sample Data Siswa --}}
                        <div class="alert alert-primary p-2 ps-3 mt-3" role="alert">
                            <span style="font-size: 12px;">Jika belum pernah upload file, silakan download sample file
                                <a href="{{ route('import.sample') }}">disini</a> !
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-file-earmark-arrow-up ms-1" viewBox="0 0 16 16">
                                <path
                                    d="M8.5 11.5a.5.5 0 0 1-1 0V7.707L6.354 8.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 7.707z" />
                                <path
                                    d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                            </svg>
                            Import
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Export Excel -->
    <div class="modal fade" id="exportExcel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="exportExcelLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="ExportExcelLabel">Export Excel</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('export.siswa') }}" method="GET" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        {{-- Export Excel Data Siswa --}}
                        <div class="d-none d-lg-flex justify-content-center">
                            <select class="form-select form-select-sm form-default me-2" style="width: 150px;"
                                name="tahun_ajar">
                                <option value="">Tahun Ajar</option>
                                {{-- @foreach ($tahun_ajar as $item)
                                    <option value="{{ $item->tahun_ajar }}"
                                        {{ request('tahun_ajar') == $item->tahun_ajar ? 'selected' : '' }}>
                                        {{ $item->tahun_ajar }}</option>
                                @endforeach --}}
                            </select>
                            {{-- <select class="form-select form-select-sm form-control-sm form-default me-2"
                                style="width: 150px;" name="kelas">
                                <option value="">Kelas</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->kelas->id }}"
                                        {{ request('kelas') == $item->kelas->id ? 'selected' : '' }}>
                                        {{ $item->kelas->nama_kelas }}</option>
                                @endforeach
                            </select>
                            <select class="form-select form-select-sm form-control-sm form-default me-2"
                                style="width: 150px;" name="jurusan">
                                <option value="">Jurusan</option>
                                @foreach ($jurusan as $item)
                                    <option value="{{ $item->jurusan->id }}"
                                        {{ request('jurusan') == $item->jurusan->id ? 'selected' : '' }}>
                                        {{ $item->jurusan->nama_jurusan }}</option>
                                @endforeach
                            </select> --}}
                        </div>
                        {{-- End --}}

                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-file-earmark-arrow-down me-1" viewBox="0 0 16 16">
                                <path
                                    d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293z" />
                                <path
                                    d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                            </svg>
                            Export
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Hapus Beberapa Siswa Dari Kelas --}}
    <div class="modal fade" id="hapusSomeSiswa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="hapusSomeSiswaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="hapusSomeSiswaLabel">Hapus Siswa</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('siswa.someDelete', $url) }}" method="post">
                        @csrf
                        @method('delete')
                        <p class="text-center peringatan-modal">Anda yakin ingin menghapus siswa yang terpilih?</p>
                        <input type="hidden" name="siswa_id[]" id="siswa_id">
                        <div class="button-modal d-flex justify-content-center">
                            <button type="button" class="btn btn-default-2 me-2" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash-fill me-1"></i>
                                Yakin!
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End --}}

    {{-- Loading screen --}}
    <div class="loading-screen d-none">
        <span class="loader"></span>
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

        // Konfigurasi Dropify preview import excel
        $('.dropify').dropify({
            messages: {
                default: 'Pilih file anda! <br> Format file yang diwajibkan <br> adalah .XLS, .XLSX!',
                replace: 'Mau ganti file anda?',
                remove: 'Hapus',
                error: 'Ada kesalahan pada proses upload file!'
            }
        });

        // Ambil data siswa berupa json
        function detailData(id) {
            $('.loading-screen').removeClass('d-none');
            // url
            const url = "{{ url('/getSiswa') }}/";

            // asset
            const asset = "{{ asset('storage') }}/";
            $.getJSON(url + id, function(json) {
                $('.loading-screen').addClass('d-none');

                $('#detailSiswa').modal('show');
                $('#nama').html(json.nama_lengkap);
                $('#tempat_lahir').html(json.tempat_lahir);
                $('#tanggal_lahir').html(tgl_indo(json.tanggal_lahir));
                $('#nik').html(json.nik);
                $('#nisn').html(json.nisn);
                $('#nis').html(json.nis);
                $('#alamat').html(json.alamat);
                $('#agama').html(json.agama.agama);
                $('#jenis_kelamin').html(json.jenis_kelamin);
                $('#nama_ayah').html(json?.ayah?.nama_ayah ?? 'Data Belum Ada!');
                $('#nama_ibu').html(json?.ibu?.nama_ibu ?? 'Data Belum Ada!');
                $('#alamat_ortu').html(json?.ayah?.alamat_ayah ?? 'Data Belum Ada!');
                $('#nama_wali').html(json?.wali?.nama_walmur ?? 'Data Belum Ada!');
                $('#alamat_wali').html(json?.wali?.alamat_walmur ?? 'Data Belum Ada!');
                $('#nama_sekolah').html(json?.pendidikan?.nama_sekolah ?? 'Data Belum Ada!');
                $('#alamat_sekolah').html(json?.pendidikan?.alamat_sekolah ?? 'Data Belum Ada!');
                $('#tahun_lulus').html(json?.pendidikan?.tahun_lulus ?? 'Data Belum Ada!');
                $('#nomer_ijazah').html(json?.pendidikan?.no_ijazah ?? 'Data Belum Ada!');
                $('#tingkat_keterima').html(json.tingkat + ' ' + json.jurusan.nama_jurusan + ' ' + json.nama_kelas
                    .nama_kelas);
                $('#tanggal_keterima').html(tgl_indo(json.tanggal_keterima));
                $('#tahun_ajar').html(json.tahun_ajar);
                if (json.status == 'aktif') {
                    $('#lulus').html('Belum Lulus');
                } else {
                    $('#lulus').html('Sudah Lulus');
                }
                if (json.foto) {
                    $('#foto').attr("src", asset + json.foto);
                } else {
                    $('#foto').attr("src", "{{ asset('img/logo/profile.jpg') }}");
                }
            });
        }

        // Hapus data siswa
        function hapusData(id) {
            $('#hapusSiswa').modal('show');
            $('#id-siswa').val(id);
        }

        $('#pilih-kelas-id').change(function(e) {
            e.preventDefault();
            const namaSiswa = $('#nama-siswa').val();

            // Diarahkan ke URL di bawah ini
            window.location.href = `siswa?kelas=${this.value}&nama_siswa=${namaSiswa}`;
        });

        // Checklist atau centang semua siswa
        $("#check-all").click(function() {
            if ($(this).is(":checked")) {
                $(".check-item").prop("checked", true);
                $('#tmb-hapus').removeClass('disabled');
            } else {
                $(".check-item").prop("checked", false);
                $('#tmb-hapus').addClass('disabled');
            }
        });

        $("#check-all-mobile").click(function() {
            if ($(this).is(":checked")) {
                $(".check-item").prop("checked", true);
                $('#tmb-hapus-mobile').removeClass('disabled');
            } else {
                $(".check-item").prop("checked", false);
                $('#tmb-hapus-mobile').addClass('disabled');
            }
        });

        // Checklist atau centang beberapa siswa
        $('.check-item').click(function() {
            if ($(".check-item").is(":checked")) {
                $('#tmb-hapus').removeClass('disabled');
                $('#tmb-hapus-mobile').removeClass('disabled');
            } else {
                $('#tmb-hapus').addClass('disabled');
                $('#tmb-hapus-mobile').addClass('disabled');
            }
        });

        // Tombol hapus Siswa
        $('#tmb-hapus').click(function() {

            $('#hapusSomeSiswa').modal('show');

            let siswa_id = [];
            if ($(".check-item").is(":checked")) {
                $("input[name^='id_siswa']:checked").each(function() {
                    siswa_id.push($(this).val());
                });
                $('#siswa_id').val(siswa_id);
            } else {
                $('#siswa_id').val(siswa_id);
            }
        });

        // Tombol hapus Siswa Mobile View
        $('#tmb-hapus-mobile').click(function() {

            $('#hapusSomeSiswa').modal('show');

            let siswa_id = [];
            if ($(".check-item").is(":checked")) {
                $("input[name^='id_siswa']:checked").each(function() {
                    siswa_id.push($(this).val());
                });
                $('#siswa_id').val(siswa_id);
            } else {
                $('#siswa_id').val(siswa_id);
            }
        });
    </script>
@endpush
