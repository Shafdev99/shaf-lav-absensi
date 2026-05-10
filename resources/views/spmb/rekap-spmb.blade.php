<!-- Content -->
@extends('layout.app')
@section('title', 'Rekap SPMB')
@section('content')

    @php
        $parse = parse_url(url()->full());
        $url = isset($parse['query']) ? $parse['query'] : false;
    @endphp

    <div class="content content-sm">

        <div class="container">

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                Data Rekap SPMB
            </div>
            {{-- End --}}

            {{-- <h5>Data Siswa</h5> --}}
            <div class="row mt-4">
                <div class="col">
                    <div class="card p-lg-3 p-2 card-content">
                        {{-- Header Button --}}
                        <div class="d-flex mt-2 mb-3 mb-lg-0">

                            <h6 class="align-self-center">
                                Daftar Data
                            </h6>



                            {{-- Search Button --}}
                            <form action="{{ route('spmb.rekap') }}" method="get" class="ms-lg-auto me-2 ">
                                <div class="d-none d-lg-flex justify-content-center">
                                    <select class="form-select form-select-sm me-2" style="width: 150px;"
                                        name="tahun_ajar_id" id="pilih-tahun-ajar-id">
                                        @foreach ($tahun_ajar as $item)
                                            <option value="{{ $item->id }}"
                                                {{ request('tahun_ajar') === $item->id ? 'selected' : '' }}>
                                                {{ $item->tahun_ajar }}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm form-default"
                                            placeholder="Cari dengan Nama Pendaftar / NISN" aria-describedby="button-addon2"
                                            name="kata_kunci" value="{{ request('kata_kunci') }}" id="kata-kunci"
                                            style="width: 450px;">
                                        <button type="submit" class="btn btn-default-2" type="button" id="button-addon2">
                                            Cari
                                        </button>
                                    </div>
                                </div>
                            </form>
                            {{-- End --}}

                            {{-- Tombol Refresh --}}
                            <a href="{{ route('spmb.rekap') }}" class="btn btn-default-2 d-none d-lg-block d-md-block">
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

                            {{-- Tombol Export --}}
                            {{-- <a href="{{ route('export.pendaftar') }}"
                                class="btn btn-default-2 ms-2 d-none d-lg-block d-md-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-file-earmark-arrow-down me-1" viewBox="0 0 16 16">
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
                                {{-- <th>
                                    <input type="checkbox" id="check-all">
                                </th> --}}
                                <th>No Pendaftaran</th>
                                <th>Nama Pendaftar</th>
                                <th>Asal Sekolah</th>
                                <th>Jurusan</th>
                                <th>Status</th>
                                <th>Kondisi Berkas</th>
                                <th>Penginput</th>
                                <th></th>
                            </tr>
                            @forelse ($pendaftar as $rekap)
                                <tr style="color: rgb(26, 26, 26);">
                                    {{-- <td width="2%">
                                        <input type="checkbox" value="{{ $rekap?->id }}" class="check-item"
                                            name="id_siswa[]">
                                    </td> --}}
                                    <td>
                                        <span class="ps-1">
                                            <i class="bi bi-ticket-detailed-fill me-1"></i>
                                            {{ $rekap->no_pendaftaran }}
                                        </span>
                                    </td>
                                    <td class="d-flex">
                                        <img src="{{ $rekap->foto ? asset('storage/' . $rekap->foto) : asset('img/logo/profile.jpg') }}"
                                            class="d-none d-lg-block img-fluid rounded-pill img-user align-self-center me-3"
                                            alt="user-photo">
                                        <div class="d-inline">
                                            <div class="fs-nama">{{ $rekap->nama_lengkap }}</div><br>
                                            {{ $rekap->nisn }}
                                        </div>
                                    </td>
                                    <td class="ps-2">
                                        {{ $rekap->asal_sekolah }}
                                    </td>
                                    <td>
                                        <b>
                                            <i class="bi bi-collection-fill me-1"></i>
                                            {{ $rekap->nama_jurusan }}
                                        </b>
                                    </td>
                                    <td>
                                        <div
                                            class="badge dropdown-toggle text-decoration-none {{ $rekap->status == 'terdaftar' ? 'badge-status-terdaftar' : ($rekap->status == 'diterima' ? 'badge-status-diterima' : ($rekap->status == 'ditolak' ? 'badge-status-ditolak' : 'badge-status-dicabut')) }} ">
                                            {{ ucwords($rekap->status) }}
                                        </div>
                                    </td>
                                    <td class="ps-4">
                                        @if ($rekap->kondisi_berkas === 'diarsip')
                                            <i class="bi bi-archive-fill me-1"></i>
                                            Diarsip
                                        @else
                                            <i class="bi bi-clipboard-x-fill me-1"></i>
                                            Dicabut
                                        @endif
                                    </td>
                                    <td>{{ Str::ucfirst($rekap->penanggung_jawab) }}</td>
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
                                                    href="{{ route('spmb.detail.pendaftar', ['id' => $rekap->id, 'menu' => 'rekap']) }}">
                                                    <i class="me-1 bi bi-file-earmark-fill"></i>
                                                    Detail Pendaftar
                                                </a>
                                            </li>
                                            @if ($rekap->kondisi_berkas === 'dicabut')
                                                <li>
                                                    <a onclick="riwayatCabutBerkas('{{ $rekap->id }}')"
                                                        class="dropdown-item" href="javascript:void(0);">
                                                        <i class="bi bi-clock-history me-1"></i>
                                                        Riwayat Berkas
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
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
                        {{ $pendaftar->links() }}
                        {{-- End --}}
                    </div>
                </div>
            </div>

        </div>
        <a href="{{ route('siswa.add') }}" class="btn btn-primary add-btn-siswa-mbl d-lg-none d-md-none">
            <i class="bi bi-plus-lg"></i>
        </a>
    </div>


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
                        <img class="img-thumbnail img-fluid" id="bukti-pencabutan" alt="bukti_pencabutan_berkas"><br><br>
                        <label for="keterangan" class="form-label mt-1">Keterangan Cabut Berkas</label>
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

        $('#pilih-tahun-ajar-id').change(function(e) {
            e.preventDefault();
            const kataKunci = $('#kata-kunci').val();

            // Diarahkan ke URL di bawah ini
            window.location.href = `spmb-rekap?tahun_ajar=${this.value}&kata_kunci=${kataKunci}`;
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
