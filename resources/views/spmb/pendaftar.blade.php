<!-- Content -->
@extends('layout.app')
@section('title', 'Daftar Pendaftar')
@section('content')

    @php
        $parse = parse_url(url()->full());
        $url = isset($parse['query']) ? $parse['query'] : false;
    @endphp

    <div class="content content-sm">

        <div class="container">

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                Data Pendaftar
            </div>
            {{-- End --}}

            {{-- <h5>Data Siswa</h5> --}}
            <div class="row mt-4">
                <div class="col">
                    <div class="card p-lg-3 p-2 card-content">
                        {{-- Header Button --}}
                        <div class="d-lg-flex mt-2 mb-3 mb-lg-0">

                            <a href="{{ route('spmb.tambah.pendaftar', $url) }}"
                                class="shadow-lg btn btn-primary d-none d-lg-block d-md-block">
                                <i class="bi bi-plus-lg"></i>
                                Tambah
                            </a>

                            {{-- Search Button --}}
                            <form action="{{ route('pendaftar') }}" method="get" class="ms-lg-auto me-2 mb-3 mb-lg-0">
                                <div class="d-block d-lg-flex justify-content-center">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm form-default"
                                            placeholder="Cari dengan No Pendaftaran / Nama Pendaftar / NISN"
                                            aria-describedby="button-addon2" name="kata_kunci"
                                            value="{{ request('kata_kunci') }}" id="kata-kunci">
                                        <button type="submit" class="btn btn-default-2" type="button" id="button-addon2">
                                            Cari
                                        </button>
                                    </div>
                                </div>
                            </form>
                            {{-- End --}}

                            {{-- Tombol Terima --}}
                            <a href="javascript:void(0);" id="tmb-terima"
                                class="btn btn-success disabled me-2 ms-4 ms-lg-0 d-lg-block d-md-block  py-1 px-2 pe-2 pe-lg-2">
                                <i class="bi bi-check-circle-fill me-1" style="font-size: 16px;"></i>
                                Terima
                            </a>

                            {{-- Tombol Hapus --}}
                            {{-- <a href="javascript:void(0);" id="tmb-hapus"
                                class="btn btn-danger disabled me-2 ms-auto ms-lg-0 d-none d-lg-block d-md-block  py-1 px-2 pe-1 pe-lg-2">
                                <i class="bi bi-trash-fill me-1" style="font-size: 16px;"></i>
                                <span class="d-none d-lg-inline d-md-inline">
                                    Hapus
                                </span>
                            </a> --}}

                            {{-- Tombol Refresh --}}
                            <a href="{{ route('pendaftar') }}" class="btn btn-default-2 d-lg-block d-md-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-arrow-clockwise " viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z" />
                                    <path
                                        d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466" />
                                </svg>
                                Refresh
                            </a>

                            {{-- Tombol Migrasi --}}
                            <a href="javascript:void(0);" class="btn btn-default-2 ms-2 d-lg-block d-md-block"
                                data-bs-toggle="modal" data-bs-target="#migrasi">
                                <i class="bi bi-database-up me-1"></i>
                                <span class="d-none d-lg-inline d-md-inline">
                                    Migrasi
                                </span>
                            </a>

                            {{-- Tombol Export --}}
                            <a href="{{ route('export.pendaftar') }}" class="btn btn-default-2 ms-2 d-lg-block d-md-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-file-earmark-arrow-down me-1" viewBox="0 0 16 16">
                                    <path
                                        d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293z" />
                                    <path
                                        d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                                </svg>
                                <span class="d-none d-lg-inline d-md-inline">
                                    Export
                                </span>
                            </a>

                        </div>
                        {{-- End --}}

                        {{-- Table Siswa Desktop View --}}
                        <table class="table d-none d-lg-table d-md-table desktop-table mt-4">
                            <tr class="tr-table">
                                <th>
                                    <input type="checkbox" id="check-all">
                                </th>
                                <th>No Pendaftaran</th>
                                <th>Nama Pendaftar</th>
                                <th>Asal Sekolah</th>
                                <th>Jurusan</th>
                                <th>Status</th>
                                <th>Kondisi Berkas</th>
                                <th>Penginput</th>
                                <th colspan="2"></th>
                            </tr>

                            @forelse ($pendaftar as $item)
                                <tr style="color: rgb(26, 26, 26);">
                                    <td width="2%">
                                        <input type="checkbox" value="{{ $item?->id }}" class="check-item"
                                            name="id_siswa[]">
                                    </td>
                                    <td width="13%">
                                        <span class="ps-1">
                                            <i class="bi bi-ticket-detailed-fill me-1"></i>
                                            {{ $item->no_pendaftaran }}
                                        </span>
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
                                    <td class="ps-2">
                                        {{ $item->berkas?->asal_sekolah }}
                                    </td>
                                    <td>
                                        <b>
                                            <i class="bi bi-collection-fill me-1"></i>
                                            {{ $item->jurusan?->nama_jurusan }}
                                        </b>
                                    </td>
                                    <td>
                                        <a href="javascript::void(0);" id="dropdownMenuButtonMobile"
                                            data-bs-toggle="dropdown" aria-expanded="false"
                                            class="badge dropdown-toggle text-decoration-none {{ $item->status == 'terdaftar' ? 'badge-status-terdaftar' : ($item->status == 'diterima' ? 'badge-status-diterima' : ($item->status == 'ditolak' ? 'badge-status-ditolak' : 'badge-status-dicabut')) }} ">
                                            {{ ucwords($item->status) }}
                                        </a>
                                        @if ($item->kondisi_berkas !== 'dicabut')
                                            <ul class="dropdown-menu dropdown-menu-tdesktop shadow"
                                                aria-labelledby="dropdownMenuButtonMobile">
                                                <li>
                                                    <a class="dropdown-item {{ $item->status === 'terdaftar' ? 'd-none' : '' }}"
                                                        href="javascript:void(0);"
                                                        onclick="ubahStatus('{{ $item->id }}', 'terdaftar')">
                                                        <i class="bi bi-clipboard-fill me-1"></i>
                                                        Terdaftar
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item {{ $item->status === 'diterima' ? 'd-none' : '' }}"
                                                        href="javascript:void(0);"
                                                        onclick="ubahStatus('{{ $item->id }}', 'diterima')">
                                                        <i class="bi bi-check-circle-fill me-1"></i>
                                                        Diterima
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item {{ $item->status === 'ditolak' ? 'd-none' : '' }}"
                                                        href="javascript:void(0);"
                                                        onclick="ubahStatus('{{ $item->id }}', 'ditolak')">
                                                        <i class="bi bi-x-circle-fill me-1"></i>
                                                        Ditolak
                                                    </a>
                                                </li>
                                            </ul>
                                        @endif
                                    </td>
                                    <td class="ps-4">
                                        @if ($item->kondisi_berkas === 'diarsip')
                                            <i class="bi bi-archive-fill me-1"></i>
                                            Diarsip
                                        @else
                                            <i class="bi bi-clipboard-x-fill me-1"></i>
                                            Dicabut
                                        @endif
                                    </td>
                                    <td>{{ Str::ucfirst($item->penanggung_jawab) }}</td>
                                    <td>
                                        <a href="javascript:void(0);" id="dropdownMenuButtonMobile"
                                            data-bs-toggle="dropdown" aria-expanded="false"
                                            class="dropdown-toggle text-decoration-none text-dark">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-tdesktop shadow"
                                            aria-labelledby="dropdownMenuButtonMobile">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('spmb.detail.pendaftar', ['id' => $item->id, 'menu' => 'pendaftar']) }}">
                                                    <i class="me-1 bi bi-file-earmark-fill"></i>
                                                    Detail Pendaftar
                                                </a>
                                            </li>
                                            <li>
                                                @if ($item->kondisi_berkas === 'dicabut')
                                                    <a onclick="riwayatCabutBerkas('{{ $item->id }}')"
                                                        class="dropdown-item" href="javascript:void(0);">
                                                        <i class="bi bi-clock-history me-1"></i>
                                                        Riwayat Berkas
                                                    </a>
                                                @else
                                                    <a onclick="cabutBerkas('{{ $item->id }}')" class="dropdown-item"
                                                        href="javascript:void(0);">
                                                        <i class="bi bi-clipboard-x-fill me-1"></i>
                                                        Cabut Berkas
                                                    </a>
                                                @endif
                                            </li>
                                            @if ($item->kondisi_berkas !== 'dicabut')
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('spmb.ubah.pendaftar', $item->id . '?' . $url) }}">
                                                        <i class="me-1 bi bi-pencil-square"></i>
                                                        Ubah Data
                                                    </a>
                                                </li>
                                                <li>
                                                    <a onclick="hapusData('{{ $item->id }}')" class="dropdown-item"
                                                        href="javascript:void(0);">
                                                        <i class="bi bi-trash-fill me-1"></i>
                                                        Hapus Data
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </td>
                                    <td>
                                        <a href="{{ route('bukti.pendaftaran', $item->id) }}" target="_blank"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Cetak Bukti Pendaftaran" id="dropdownMenuButtonMobile"
                                            class="text-decoration-none text-dark">
                                            <i class="bi bi-printer-fill"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" align="center">Data tidak ada!</td>
                                </tr>
                            @endforelse
                        </table>
                        {{-- End --}}

                        {{-- Table Siswa Mobile View --}}
                        @if (request('keyword') && !$pendaftar->items())
                            <p class="text-center my-3 d-lg-none d-md-none">Data yang anda cari tidak ada!</p>
                        @elseif(!$pendaftar->items())
                            <p class="text-center my-3 d-lg-none d-md-none">Belum ada data siswa!</p>
                        @else
                            <div class="d-flex mb-2 mt-3 d-lg-none d-md-none">
                                <input type="checkbox" id="check-all-mobile" class="me-1 ms-2">
                                <span>
                                    Pilih semua
                                </span>
                            </div>
                            @foreach ($pendaftar as $item)
                                <div class="card mb-2 p-2 d-lg-none d-md-none">
                                    <div class="d-flex">
                                        <input type="checkbox" id="mobile-pilih-siswa" value="{{ $item->id }}"
                                            class="check-item me-2" name="id_siswa[]">
                                        <img src="{{ $item?->foto ? asset('storage/' . $item->foto) : asset('img/logo/profile.jpg') }}"
                                            class="img-fluid rounded-pill img-user align-self-center me-3"
                                            alt="user-photo">
                                        <div class="d-inline">
                                            <div class="fs-nama">
                                                {{ $item->nama_lengkap }}
                                            </div>
                                            <br>
                                            <div class="mb-3">
                                                {{ $item->no_pendaftaran }}
                                            </div>
                                            {{ $item->jurusan?->nama_jurusan }} |
                                            <a href="javascript::void(0);" id="dropdownMenuButtonMobile"
                                                data-bs-toggle="dropdown" aria-expanded="false"
                                                class="ms-2 badge dropdown-toggle text-decoration-none {{ $item->status == 'terdaftar' ? 'badge-status-terdaftar' : ($item->status == 'diterima' ? 'badge-status-diterima' : ($item->status == 'ditolak' ? 'badge-status-ditolak' : 'badge-status-dicabut')) }} ">
                                                {{ ucwords($item->status) }}
                                            </a>
                                            @if ($item->kondisi_berkas !== 'dicabut')
                                                <ul class="dropdown-menu dropdown-menu-tdesktop shadow"
                                                    aria-labelledby="dropdownMenuButtonMobile">
                                                    <li>
                                                        <a class="dropdown-item {{ $item->status === 'terdaftar' ? 'd-none' : '' }}"
                                                            href="javascript:void(0);"
                                                            onclick="ubahStatus('{{ $item->id }}', 'terdaftar')">
                                                            <i class="bi bi-clipboard-fill me-1"></i>
                                                            Terdaftar
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item {{ $item->status === 'diterima' ? 'd-none' : '' }}"
                                                            href="javascript:void(0);"
                                                            onclick="ubahStatus('{{ $item->id }}', 'diterima')">
                                                            <i class="bi bi-check-circle-fill me-1"></i>
                                                            Diterima
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item {{ $item->status === 'ditolak' ? 'd-none' : '' }}"
                                                            href="javascript:void(0);"
                                                            onclick="ubahStatus('{{ $item->id }}', 'ditolak')">
                                                            <i class="bi bi-x-circle-fill me-1"></i>
                                                            Ditolak
                                                        </a>
                                                    </li>
                                                </ul>
                                            @endif
                                        </div>
                                        <a href="javascript:void(0);" id="dropdownMenuButtonMobile"
                                            data-bs-toggle="dropdown" aria-expanded="false"
                                            class="dropdown-toggle text-decoration-none text-dark ms-auto">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <ul class="me-2 dropdown-menu dropdown-menu-tdesktop shadow"
                                            aria-labelledby="dropdownMenuButtonMobile">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('spmb.detail.pendaftar', ['id' => $item->id, 'menu' => 'pendaftar']) }}">
                                                    <i class="me-1 bi bi-file-earmark-fill"></i>
                                                    Detail Pendaftar
                                                </a>
                                            </li>
                                            <li>
                                                @if ($item->kondisi_berkas === 'dicabut')
                                                    <a onclick="riwayatCabutBerkas('{{ $item->id }}')"
                                                        class="dropdown-item" href="javascript:void(0);">
                                                        <i class="bi bi-clock-history me-1"></i>
                                                        Riwayat Berkas
                                                    </a>
                                                @else
                                                    <a onclick="cabutBerkas('{{ $item->id }}')" class="dropdown-item"
                                                        href="javascript:void(0);">
                                                        <i class="bi bi-clipboard-x-fill me-1"></i>
                                                        Cabut Berkas
                                                    </a>
                                                @endif
                                            </li>
                                            @if ($item->kondisi_berkas !== 'dicabut')
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('spmb.ubah.pendaftar', $item->id . '?' . $url) }}">
                                                        <i class="me-1 bi bi-pencil-square"></i>
                                                        Ubah Data
                                                    </a>
                                                </li>
                                                <li>
                                                    <a onclick="hapusData('{{ $item->id }}')" class="dropdown-item"
                                                        href="javascript:void(0);">
                                                        <i class="bi bi-trash-fill me-1"></i>
                                                        Hapus Data
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                        <a href="{{ route('bukti.pendaftaran', $item->id) }}" target="_blank"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Cetak Bukti Pendaftaran" id="dropdownMenuButtonMobile"
                                            class="text-decoration-none text-dark mx-2">
                                            <i class="bi bi-printer-fill"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        {{-- End --}}

                        {{-- Pagination --}}
                        {{ $pendaftar->links() }}
                        {{-- End --}}
                    </div>
                </div>
            </div>

        </div>
        <a href="{{ route('spmb.tambah.pendaftar', $url) }}"
            class="btn btn-primary add-btn-siswa-mbl d-lg-none d-md-none">
            <i class="bi bi-plus-lg"></i>
        </a>
    </div>

    {{-- Modal Cabut Berkas --}}
    <div class="modal fade" id="cabutBerkas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="cabutBerkasLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="cabutBerkasLabel">Cabut Berkas</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('spmb.cabut.berkas', $url) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        {{-- Bukti Cabut Berkas --}}
                        <input type="hidden" id="pendaftar-id-cabut-berkas" name="pendaftar_id">
                        <label for="bukti" class="form-label">Bukti Cabut Berkas</label>
                        <div class="@error('foto') dropify-invalid @enderror">
                            <input type="file" name="bukti_pencabutan" data-allowed-file-extensions="jpg png jpeg"
                                class="dropify" />
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
                        <label for="keterangan" class="form-label mt-3">Keterngan Cabut Berkas</label>
                        <textarea name="keterangan_pencabutan" class="form-control @error('keterangan_pencabutan') is-invalid @enderror"
                            cols="10" rows="5" placeholder="Masukan keterangan pencabutan berkas!" required></textarea>
                        @error('keterangan_pencabutan')
                            <div id="validationServer03Feedback" class="text-danger mt-1">
                                {{ ucwords($message) }}
                            </div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <div class="button-modal d-flex justify-content-center">
                            <button type="button" class="btn btn-default-2 me-2" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send-fill me-1"></i>
                                Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End --}}

    {{-- Modal Riwayat Cabut Berkas --}}
    <div class="modal fade" id="riwayatCabutBerkas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="riwayatCabutBerkasLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="riwayatCabutBerkasLabel">Riwayat Cabut Berkas</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('spmb.cabut.berkas', $url) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        {{-- Bukti Cabut Berkas --}}
                        <label for="bukti" class="form-label">Bukti Cabut Berkas</label>
                        <img width="300" class="img-thumbnail mx-auto d-block img-fluid" id="bukti-pencabutan"
                            alt="bukti_pencabutan_berkas">
                        <label for="keterangan" class="form-label mt-5">Keterangan Cabut Berkas</label>
                        <h6 id="keterangan-pencabutan"></h6>
                    </div>
                    <div class="modal-footer">
                        <div class="button-modal d-flex justify-content-center">
                            <button type="button" class="btn btn-danger me-2" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End --}}

    {{-- Modal Hapus Pendaftar --}}
    <div class="modal fade" id="hapusPendaftar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="hapusPendaftarLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="hapusPendaftarLabel">Hapus Pendaftar</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('spmb.hapus.pendaftar', $url) }}" method="post">
                        @csrf
                        @method('delete')
                        <p class="text-center peringatan-modal">Anda yakin ingin menghapus data ini?</p>
                        <div class="button-modal d-flex justify-content-center">
                            <input type="hidden" name="pendaftar_id" id="pendaftar-id-hapus">
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

    {{-- Modal Migrasi --}}
    <div class="modal fade" id="migrasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="migrasiLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="migrasiLabel">Migrasi Data</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center peringatan-modal">Pastikan lakukan export data terlebih dahulu sebelum anda
                        melakukan migrasi data!</p>
                    <div class="button-modal d-flex justify-content-center">
                        <button type="button" class="btn btn-default-2 me-2" data-bs-dismiss="modal">Batal</button>
                        <a href="{{ route('spmb.migrasi') }}" class="btn btn-primary">
                            <i class="bi bi-database-up me-1"></i>
                            Proses
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End --}}

    {{-- Modal Ubah Status Pendaftar --}}
    <div class="modal fade" id="UbahStatus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="UbahStatusLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="UbahStatusLabel">Ubah Status</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('spmb.ubah.status') }}" method="post">
                        @csrf
                        <p class="text-center peringatan-modal">Anda yakin ingin mengubah status pendaftar?</p>
                        <input type="hidden" name="pendaftar_id" id="pendaftar-id">
                        <input type="hidden" name="status_pendaftar" id="status-pendaftar">
                        <div class="button-modal d-flex justify-content-center">
                            <button type="button" class="btn btn-default-2 me-2" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-arrow-repeat"></i>
                                Ubah!
                            </button>
                        </div>
                    </form>
                </div>
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

        // Konfigurasi Dropify preview import excel
        $('.dropify').dropify({
            messages: {
                default: 'Pilih file anda! <br> Format file yang diwajibkan <br> adalah .XLS, .XLSX!',
                replace: 'Mau ganti file anda?',
                remove: 'Hapus',
                error: 'Ada kesalahan pada proses upload file!'
            }
        });

        function riwayatCabutBerkas(id) {
            const url = `{{ url('/getDataCabutBerkas') }}/` + id;
            const asset = `{{ asset('storage') }}/`;
            $.getJSON(url, function(json) {
                $('#bukti-pencabutan').attr('src', asset + json.bukti_pencabutan);
                $('#keterangan-pencabutan').text(json.keterangan_pencabutan);
                $('#riwayatCabutBerkas').modal('show');
            });
        }

        function cabutBerkas(id) {
            $('#cabutBerkas').modal('show');
            $('#pendaftar-id-cabut-berkas').val(id);
        }

        // Hapus data pendaftar
        function hapusData(id) {
            $('#hapusPendaftar').modal('show');
            $('#pendaftar-id-hapus').val(id);
        }

        function ubahStatus(id, status) {
            $('#pendaftar-id').val(id);
            $('#status-pendaftar').val(status);
            $('#UbahStatus').modal('show');
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
                // $('#tmb-hapus').removeClass('disabled');
                $('#tmb-terima').removeClass('disabled');
            } else {
                $(".check-item").prop("checked", false);
                // $('#tmb-hapus').addClass('disabled');
                $('#tmb-terima').addClass('disabled');
            }
        });

        $("#check-all-mobile").click(function() {
            if ($(this).is(":checked")) {
                // $(".check-item").prop("checked", true);
                // $('#tmb-hapus-mobile').removeClass('disabled');
                $(".check-item").prop("checked", true);
                // $('#tmb-hapus').removeClass('disabled');
                $('#tmb-terima').removeClass('disabled');
            } else {
                // $(".check-item").prop("checked", false);
                // $('#tmb-hapus-mobile').addClass('disabled');
                $(".check-item").prop("checked", false);
                // $('#tmb-hapus').addClass('disabled');
                $('#tmb-terima').addClass('disabled');
            }
        });

        // Checklist atau centang beberapa siswa
        $('.check-item').click(function() {
            if ($(".check-item").is(":checked")) {
                $('#tmb-terima').removeClass('disabled');
                // $('#tmb-hapus').removeClass('disabled');
                // $('#tmb-hapus-mobile').removeClass('disabled');
            } else {
                $('#tmb-terima').addClass('disabled');
                // $('#tmb-hapus').addClass('disabled');
                // $('#tmb-hapus-mobile').addClass('disabled');
            }
        });

        $('.check-item-mobile').click(function() {
            if ($(".check-item").is(":checked")) {
                $('#tmb-terima').removeClass('disabled');
                // $('#tmb-hapus').removeClass('disabled');
                // $('#tmb-hapus-mobile').removeClass('disabled');
            } else {
                $('#tmb-terima').addClass('disabled');
                // $('#tmb-hapus').addClass('disabled');
                // $('#tmb-hapus-mobile').addClass('disabled');
            }
        });

        // Tombol hapus Siswa
        // $('#tmb-hapus').click(function() {

        //     $('#hapusSomeSiswa').modal('show');

        //     let siswa_id = [];
        //     if ($(".check-item").is(":checked")) {
        //         $("input[name^='id_siswa']:checked").each(function() {
        //             siswa_id.push($(this).val());
        //         });
        //         $('#siswa_id').val(siswa_id);
        //     } else {
        //         $('#siswa_id').val(siswa_id);
        //     }
        // });

        $('#tmb-terima').click(function() {
            let siswa_id = [];
            if ($(".check-item").is(":checked")) {
                $("input[name^='id_siswa']:checked").each(function() {
                    siswa_id.push($(this).val());
                });
                getData(siswa_id);
            } else {
                getData(siswa_id);
            }
        });

        async function getData(siswaId) {
            try {
                const response = await fetch(`{{ url('terima-beberapa') }}/${siswaId}`);

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                toastr.options = {
                    "timeOut": "10000", // Berapa lama toast muncul (3 detik)
                    "extendedTimeOut": "1000", // Tambahan waktu jika user mengarahkan mouse ke toast (1 detik)
                    "positionClass": "toast-bottom-right",
                    "progressBar": true, // Menampilkan bar waktu yang berjalan
                    "closeButton": true // Memberikan tombol tutup manual
                };
                toastr.success('Pendaftar yang dipilih berhasil diterima!')

            } catch (error) {
                console.error('Fetch error:', error);
            }
            window.location.reload();
        }
    </script>
@endpush
