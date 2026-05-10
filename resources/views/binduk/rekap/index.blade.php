<!-- Content -->
@extends('layout.app')
@section('title', 'Daftar Buku Induk')
@section('content')

    @php
        $parse = parse_url(url()->full());
        $url = isset($parse['query']) ? $parse['query'] : false;
    @endphp

    <div class="content content-sm">

        <div class="container">

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                Rekap Data
            </div>
            {{-- End --}}

            {{-- <h5>Data Siswa</h5> --}}
            <div class="row mt-4">
                <div class="col">
                    <div class="card p-lg-3 p-2 card-content">
                        {{-- Header Button --}}
                        <div class="d-flex mt-2 mb-3 mb-lg-0">

                            <h6 class="align-self-center">Data Siswa</h6>

                            {{-- Search Button --}}
                            {{-- <form action="{{ route('siswa') }}" method="get" class="ms-lg-auto me-2 ">
                                <div class="row mx-auto d-lg-none">
                                    <div class="col-6">
                                        <select class="form-select form-select-sm form-default me-2 form-mobile"
                                            name="tahun_ajar">
                                            <option value="">Tahun Ajar</option>
                                            @foreach ($tahun_ajar as $item)
                                                <option value="{{ $item->tahun_ajar }}"
                                                    {{ request('tahun_ajar') == $item->tahun_ajar ? 'selected' : '' }}>
                                                    {{ $item->tahun_ajar }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <select
                                            class="form-select form-select-sm form-default me-2 form-mobile form-mobile-kelas"
                                            name="kelas">
                                            <option value="">Kelas</option>
                                            @foreach ($kelas as $item)
                                                <option value="{{ $item->kelas->id }}"
                                                    {{ request('kelas') == $item->kelas->id ? 'selected' : '' }}>
                                                    {{ $item->kelas->nama_kelas }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col d-flex">
                                        <div class="input-group mt-2">
                                            <input type="text"
                                                class="form-control form-control-sm form-default form-mobile"
                                                placeholder="Cari data.." aria-describedby="button-addon2" name="nama_siswa"
                                                value="{{ request('nama_siswa') }}">
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
                                                <a class="dropdown-item disabled" href="javascript:void(0);"
                                                    id="tmb-hapus-mobile">
                                                    <i class="bi bi-trash-fill me-1" style="font-size: 16px;"></i>
                                                    Hapus
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('siswa') }}">
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
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                                    data-bs-target="#importExcel">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-file-earmark-arrow-up ms-1"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.5 11.5a.5.5 0 0 1-1 0V7.707L6.354 8.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 7.707z" />
                                                        <path
                                                            d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                                                    </svg>
                                                    Import
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('export.siswa') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-file-earmark-arrow-down ms-1"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293z" />
                                                        <path
                                                            d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                                                    </svg>
                                                    Export
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="d-none d-lg-flex justify-content-center">
                                    <select class="form-select form-select-sm form-default me-2" style="width: 150px;"
                                        name="tahun_ajar">
                                        <option value="">Tahun Ajar</option>
                                        @foreach ($tahun_ajar as $item)
                                            <option value="{{ $item->tahun_ajar }}"
                                                {{ request('tahun_ajar') == $item->tahun_ajar ? 'selected' : '' }}>
                                                {{ $item->tahun_ajar }}</option>
                                        @endforeach
                                    </select>
                                    <select class="form-select form-select-sm form-control-sm form-default me-2"
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
                                    </select>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm form-default"
                                            placeholder="Cari data.." aria-describedby="button-addon2" name="nama_siswa"
                                            value="{{ request('nama_siswa') }}" style="width: 80px;">
                                        <button type="submit" class="btn btn-default-2" type="button"
                                            id="button-addon2">
                                            Cari
                                        </button>
                                    </div>
                                </div>
                            </form> --}}

                            <form action="{{ route('rekap') }}" method="get" class="ms-lg-auto me-2 ">
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

                            {{-- Tombol Refresh --}}
                            <a href="{{ route('rekap') }}" class="btn btn-default-2 d-none d-lg-block d-md-block">
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

                        </div>
                        {{-- End --}}

                        {{-- Table Siswa Desktop View --}}
                        <table class="table d-none d-lg-table d-md-table desktop-table mt-4">
                            <tr class="tr-table">
                                <th>No</th>
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
                                        {{ $loop->iteration }}).
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
                                    <td align="right">
                                        <a href="{{ route('rekap.form.siswa', $item->id . '?' . $url) }}"
                                            class="btn btn-primary">
                                            <i class="bi bi-file-earmark-richtext-fill"></i>
                                            Data
                                        </a>
                                        <a href="javascript:void(0);" onclick="detailData('{{ $item->id }}')"
                                            class="btn btn-default-2" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Detail Data Siswa">
                                            <i class="bi bi-file-earmark-fill"></i>
                                        </a>
                                        <a href="{{ route('rekap.cetak.data.siswa', $item->id) }}"
                                            class="btn btn-default-2" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Cetak Buku Induk" target="_blank">
                                            <i class="bi bi-printer-fill"></i>
                                        </a>
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
                        @if (request('keyword') && !$siswa->items())
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
                                            class="img-fluid rounded-pill img-user align-self-center me-3" alt="user-photo">
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
                        @endif
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

    {{-- Loading screen --}}
    <div class="loading-screen d-none">
        <span class="loader"></span>
    </div>
    {{-- End --}}

@endsection
@push('scripts')
    <script type="text/javascript">
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

        $('#pilih-kelas-id').change(function(e) {
            e.preventDefault();
            const namaSiswa = $('#nama-siswa').val();

            // Diarahkan ke URL di bawah ini
            window.location.href = `rekap?kelas=${this.value}&nama_siswa=${namaSiswa}`;
        });
    </script>
@endpush
