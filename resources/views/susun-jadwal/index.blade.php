<!-- Content -->
@extends('layout.app')
@section('title', 'Susun Jadwal')
@section('content')
    <div class="content content-sm">

        <div class="container">

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                Susun Jadwal
            </div>
            {{-- End --}}

            <div class="row mt-4">
                <div class="col-lg-12 col-md-6 col-12 mx-auto mt-3 mt-lg-0 mt-md-0">
                    <div class="card p-lg-3 p-2 card-content">
                        {{-- Header Button --}}
                        <div class="d-flex mt-lg-2 mb-3 mb-lg-0 ">
                            {{-- Tombol Buat Jadwal --}}
                            <a class="btn btn-primary d-none d-lg-block d-md-block me-2"
                                href="{{ route('proses.susun.jadwal') }}">
                                <i class="bi bi-arrow-repeat"></i>
                                Buat Jadwal
                            </a>

                            {{-- Tombol Reset Jadwal --}}
                            <a href="{{ route('reset.jadwal') }}" class="btn btn-default-2 d-none d-lg-block d-md-block">
                                <i class="bi bi-x-circle"></i>
                                <span class=" ms-1">
                                    Reset Jadwal
                                </span>
                            </a>

                            <div class="d-inline d-lg-none ms-lg-auto align-self-center fw-bold">
                                <i class="bi bi-person-vcard-fill mx-2 d-lg-none" style="font-size: 16px;"></i>
                                Susun Jadwal
                            </div>
                        </div>
                        {{-- End --}}

                        {{-- Table Susun Jadwal Desktop View --}}
                        {{-- Navtabs data Susun Jadwal --}}
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @foreach ($hari as $Hari)
                                <li class="nav-item mt-4 d-flex" role="presentation">
                                    <a href="{{ route('susun.jadwal', $Hari->id) }}"
                                        class="nav-link {{ request()->routeIs('susun.jadwal') && (request()->route('hari_id') == $Hari->id || (!request()->route('hari_id') && $loop->first)) ? 'active' : '' }}"
                                        id="hari-tab">
                                        {{ $Hari->nama_hari }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        {{-- End --}}

                        {{-- <table>
                            @forelse ($sesi_pelajaran as $item)
                                <tr>
                                    <td>{{ $item->sesi_pelajaran }}</td>
                                    <td></td>
                                    <td>{{ $item->jam_selesai }}</td>
                                    <td>{{ $item->zona_waktu }}</td>
                                    <td class="text-end">
                                        <a href="javascript:void(0);"
                                            onclick="editSesiPelajaran('{{ $item->id }}','{{ $item->sesi_pelajaran }}','{{ $item->jam_mulai }}','{{ $item->jam_selesai }}','{{ $item->zona_waktu }}')"
                                            class="text-decoration-none text-primary">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="javascript:void(0);" onclick="deleteSesiPelajaran('{{ $item->id }}')"
                                            class="text-decoration-none text-danger">
                                            <i class="bi bi-trash3-fill"></i>
                                        </a>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada data Sesi Pelajaran!</td>
                                </tr>
                            @endforelse
                        </table> --}}
                        <div class="table-responsive mt-3 desktop-table">
                            <table class="table align-middle">
                                <thead>
                                    <tr class=" tr-table">
                                        {{-- <th>Sesi Pelajaran</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Selesai</th>
                                        <th>Zona Waktu</th>
                                        <th class="text-end">Aksi</th> --}}
                                        <th colspan="2" class="text-center">
                                            Jadwal Pelajaran
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($sesi_pelajaran as $sesi)
                                        <tr>
                                            <td class="bg-light text-center" style="width: 150px;">
                                                <span class="fs-6">
                                                    {{ $sesi->sesi_pelajaran }}
                                                </span><br>
                                                {{ $sesi->jam_mulai . '-' . $sesi->jam_selesai . ' ' . $sesi->zona_waktu }}
                                            </td>
                                            <td>
                                                <div class="row">
                                                    @foreach ($kelas as $Kelas)
                                                        <div class="col-4">
                                                            <div class="card bg-blobe p-3 mb-2">
                                                                <div class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                                    {{ $Kelas->tingkat . '  ' . $Kelas->nama_jurusan . '  ' . $Kelas->nama_kelas }}
                                                                </div>
                                                                <div>
                                                                    <select
                                                                        class="form-select form-select-sm rounded bg-blobe pilih-mapel-dan-guru-pengampu"
                                                                        name="guru_pengampu_id[{{ $hari_id }}][{{ $sesi->id }}][{{ $Kelas->id }}]"
                                                                        data-hari="{{ $hari_id }}"
                                                                        data-sesi="{{ $sesi->id }}"
                                                                        data-kelas="{{ $Kelas->id }}">
                                                                        <option value="">
                                                                            Pilih Mapel ( Guru pengampu )
                                                                        </option>
                                                                        @php
                                                                            $guruPngampuId = null;
                                                                        @endphp
                                                                        @foreach ($susun_jadwal as $sd)
                                                                            @if ($sd->hari_id === $hari_id && $sd->sesi_id === $sesi->id && $sd->kelas_id === $Kelas->id)
                                                                                @php
                                                                                    $guruPngampuId =
                                                                                        $sd->guru_pengampu_id;
                                                                                @endphp
                                                                            @endif
                                                                        @endforeach
                                                                        @foreach ($guru_pengampu as $gp)
                                                                            <option value="{{ $gp->id }}"
                                                                                {{ $guruPngampuId === $gp->id ? 'selected' : '' }}>
                                                                                {{ $gp->mapel->mapel . ' ( ' . $gp->guru->nama_guru . ' )' }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Belum ada data Sesi Pelajaran!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{-- End --}}

                        {{-- Table Mapel Mobile View --}}
                        {{-- @forelse ($mapel as $row)
                            <div class="card mb-2 p-2 d-lg-none d-md-none">
                                <div class="d-flex">
                                    <div class="d-inline">
                                        <div>
                                            &nbsp;{{ $row->mapel }}
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" id="dropdownMenuButtonMobile" data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                        class="dropdown-toggle text-decoration-none text-dark ms-auto">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-tdesktop shadow"
                                        aria-labelledby="dropdownMenuButtonMobile">
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);"
                                                onclick="editMapel('{{ $row->id }}','{{ $row->mapel }}')">
                                                <i class="me-1 bi bi-pencil-square"></i>
                                                Ubah
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" onclick="deleteMapel('{{ $row->id }}')"
                                                class="dropdown-item">
                                                <i class="me-1 bi bi-trash3-fill"></i>
                                                Hapus
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @empty
                            <p class="text-center my-3 d-lg-none d-md-none">Belum ada data Mapel!</p>
                        @endforelse --}}
                        {{-- End --}}
                    </div>
                </div>
            </div>

            <div class="row mt-4">

            </div>
        </div>

        {{-- <div class="dropdown">
            <a href="javascript:void(0);" class="btn btn-primary dropdown-toggle add-btn-siswa-mbl d-lg-none d-md-none"
                role="button" data-bs-toggle="dropdown">
                <i class="bi bi-plus-lg"></i>
            </a>
            <ul id="pilihMapel" class="dropdown-menu pilihan-mapel">
                <li>
                    <a href="javascript:void(0);" onclick="addKelma()" class="dropdown-item fs-6"
                        style="font-size: 12px !important;">
                        Kelompok Mapel
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);" onclick="addMapel()" class="dropdown-item fs-6"
                        style="font-size: 12px !important;">
                        Mapel
                    </a>
                </li>
            </ul>
        </div> --}}
    </div>


    {{-- 
    // Modal Untuk Bagian Sesi Pelajaran 
    --}}

    {{-- Modal Tambah Sesi Pelajaran --}}
    <div class="modal fade" id="AddSesiPelajaran" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="AddSesiPelajaranLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="AddSesiPelajaranLabel">Tambah Sesi Pelajaran</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('sesi.pelajaran.add') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <label for="" class="mb-2">Sesuaikan Hari</label>
                        <div class="bg-blobe p-2 mb-5 rounded border shadow-sm">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="hariCheckboxAll">
                                <label class="form-check-label" for="hariCheckboxAll">
                                    Semua Hari
                                </label>
                            </div>
                            <hr>
                            <div class="mb-2">

                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0">Data Sesi Pelajaran</h6>
                            <button type="button" id="addSesiRowBtn" class="btn btn-sm btn-default-2 shadow">
                                <i class="bi bi-plus-lg"></i> Tambah Baris
                            </button>
                        </div>

                        <div id="sesiPelajaranRows"></div>

                        <template id="sesiRowTemplate">
                            <div class="row align-items-end mb-3 sesi-row">
                                <div class="col-md-4 mb-2">
                                    <label class="form-label" style="font-size: 14px;">Sesi Pelajaran</label>
                                    <input type="text" class="form-control form-control-sm" data-name="sesi_pelajaran"
                                        placeholder="Contoh : jam ke 1, Sesi 1, Pertemuan 1, dll." required>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label class="form-label" style="font-size: 14px;">Jam Mulai</label>
                                    <input type="time" class="form-control form-control-sm" data-name="jam_mulai"
                                        required>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label class="form-label" style="font-size: 14px;">Jam Selesai</label>
                                    <input type="time" class="form-control form-control-sm" data-name="jam_selesai"
                                        required>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label class="form-label" style="font-size: 14px;">Zona Waktu</label>
                                    <select class="form-select form-select-sm" data-name="zona_waktu" required>
                                        <option value="">Pilih Zona Waktu</option>
                                        <option value="WIB">WIB</option>
                                        <option value="WITA">WITA</option>
                                        <option value="WIT">WIT</option>
                                    </select>
                                </div>
                                <div class="col-md-1 mb-2">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger"
                                        onclick="removeSesiRow(this)">
                                        <i class="bi bi-x-lg"></i>
                                    </a>
                                </div>
                            </div>
                        </template>
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

    {{-- Modal Edit Sesi Pelajaran --}}
    <div class="modal fade" id="EditSesiPelajaran" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="EditSesiPelajaranLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="EditSesiPelajaranLabel">Edit Sesi Pelajaran</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('sesi.pelajaran.edit') }}" method="post">
                    @csrf
                    @method('put')
                    <input type="text" id="sesi-pelajaran-id-edit" name="sesi_pelajaran_id" hidden>
                    <div class="modal-body">
                        <label for="" class="my-2">Sesi Pelajaran</label>
                        <input type="text" class="form-control mb-4" name="sesi_pelajaran" id="sesi-pelajaran-edit"
                            required>
                        <label for="" class="my-2">Jam Mulai</label>
                        <input type="time" class="form-control mb-4" name="jam_mulai" id="jam-mulai-edit" required>
                        <label for="" class="my-2">Jam Selesai</label>
                        <input type="time" class="form-control mb-4" name="jam_selesai" id="jam-selesai-edit"
                            required>
                        <label for="" class="my-2">Zona Waktu</label>
                        <select class="form-control mb-4" name="zona_waktu" id="zona-waktu-edit" required>
                            <option value="">Pilih Zona Waktu</option>
                            <option value="WIB">WIB (Waktu Indonesia Barat)</option>
                            <option value="WITA">WITA (Waktu Indonesia Tengah)</option>
                            <option value="WIT">WIT (Waktu Indonesia Timur)</option>
                        </select>
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

    {{-- Modal Hapus Sesi Pelajaran --}}
    <div class="modal fade" id="deleteSesiPelajaran" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteSesiPelajaranLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="deleteSesiPelajaranLabel">Hapus Sesi Pelajaran</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('sesi.pelajaran.delete') }}" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <p class="text-center px-3" id="keterangan-to-sesi-pelajaran">
                            Apakah anda yakin ingin menghapus sesi pelajaran ini?
                        </p>
                        <input type="hidden" id="sesi-pelajaran-id-delete" name="sesi_pelajaran_id">
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-default-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger" id="delBtnSesiPelajaran">
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
    // Modal Untuk Bagian Hari 
    --}}

    {{-- Modal Tambah Hari --}}
    <div class="modal fade" id="AddHari" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="AddHariLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="AddHariLabel">Tambah Hari</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('hari.add') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <label for="" class="my-2">Nama Hari</label>
                        <input type="text" class="form-control mb-4" name="nama_hari"
                            placeholder="Contoh: Senin, Selasa, Rabu" required>
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

    {{-- Modal Edit Hari --}}
    <div class="modal fade" id="EditHari" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="EditHariLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="EditHariLabel">Edit Hari</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('hari.edit') }}" method="post">
                    @csrf
                    @method('put')
                    <input type="text" id="hari-id-edit" name="hari_id" hidden>
                    <div class="modal-body">
                        <label for="" class="my-2">Nama Hari</label>
                        <input type="text" class="form-control mb-4" name="nama_hari" id="nama-hari-edit" required>
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

    {{-- Modal Hapus Hari --}}
    <div class="modal fade" id="deleteHari" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteHariLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="deleteHariLabel">Hapus Hari</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('hari.delete') }}" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <p class="text-center px-3" id="keterangan-to-hari">
                            Apakah anda yakin ingin menghapus hari ini?
                        </p>
                        <input type="hidden" id="hari-id-delete" name="hari_id">
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-default-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger" id="delBtnHari">
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

        // Modal add sesi pelajaran
        function addSesiPelajaran() {
            $('#AddSesiPelajaran').modal('show');
        }

        // Modal edit sesi pelajaran
        function editSesiPelajaran(sesiPelajaranId, sesiPelajaran, jamMulai, jamSelesai, zonaWaktu) {
            $('#sesi-pelajaran-id-edit').val(sesiPelajaranId);
            $('#sesi-pelajaran-edit').val(sesiPelajaran);
            $('#jam-mulai-edit').val(jamMulai);
            $('#jam-selesai-edit').val(jamSelesai);
            $('#zona-waktu-edit').val(zonaWaktu);
            $('#EditSesiPelajaran').modal('show');
        }

        // Modal hapus sesi pelajaran
        function deleteSesiPelajaran(id) {
            $('#sesi-pelajaran-id-delete').val(id);
            $('#deleteSesiPelajaran').modal('show');

        }

        // Modal tambah hari
        function addHari() {
            $('#AddHari').modal('show');
        }

        // Modal edit hari
        function editHari(hariId, namaHari) {
            $('#hari-id-edit').val(hariId);
            $('#nama-hari-edit').val(namaHari);
            $('#EditHari').modal('show');
        }

        // Modal hapus hari
        function deleteHari(id) {
            $('#hari-id-delete').val(id);
            $('#deleteHari').modal('show');
        }

        const sesiRowsWrapper = document.getElementById('sesiPelajaranRows');
        const sesiTemplate = document.getElementById('sesiRowTemplate');
        let sesiIndex = 0;

        function createSesiRow(data = {}) {
            const clone = sesiTemplate.content.cloneNode(true);
            clone.querySelectorAll('[data-name]').forEach(element => {
                const field = element.getAttribute('data-name');
                element.name = `entries[${sesiIndex}][${field}]`;
                if (data[field]) {
                    element.value = data[field];
                }
            });
            sesiRowsWrapper.appendChild(clone);
            sesiIndex++;
        }

        function removeSesiRow(button) {
            const row = button.closest('.sesi-row');
            if (row) {
                row.remove();
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (sesiRowsWrapper.children.length === 0) {
                createSesiRow();
            }

            document.getElementById('addSesiRowBtn').addEventListener('click', () => {
                createSesiRow();
            });

            const addSesiForm = document.querySelector('form[action="{{ route('sesi.pelajaran.add') }}"]');
            if (!addSesiForm) {
                return;
            }

            addSesiForm.addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(this);

                fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            $('#AddSesiPelajaran').modal('hide');
                            toastr.success(data.message || 'Sesi pelajaran berhasil disimpan.');
                            this.reset();
                            sesiRowsWrapper.innerHTML = '';
                            sesiIndex = 0;
                            createSesiRow();
                        } else if (data.errors) {
                            Object.values(data.errors).flat().forEach(msg => toastr.warning(msg));
                        } else {
                            toastr.warning('Terjadi kesalahan saat menyimpan data.');
                        }
                        setTimeout(() => location.reload(), 5000);
                    })
                    .catch(() => {
                        toastr.error('Gagal mengirim data ke server.');
                    });
            });

            $('#AddSesiPelajaran').on('show.bs.modal', () => {
                if (sesiRowsWrapper.children.length === 0) {
                    createSesiRow();
                }
            });
        });

        function appendSesiRowsToTable(rows) {
            const table = document.querySelector('.desktop-table');
            if (!table || !rows.length) {
                return;
            }

            const emptyRow = table.querySelector('tr td[colspan="4"]');
            if (emptyRow) {
                emptyRow.closest('tr').remove();
            }

            rows.forEach(row => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                                    <td>${row.sesi_pelajaran}</td>
                                    <td>${row.jam_mulai}</td>
                                    <td>${row.jam_selesai}</td>
                                    <td>${row.zona_waktu}</td>
                                `;
                table.appendChild(tr);
            });
        }

        // buat fungsi untuk mengelola checkbox "Semua Hari"
        document.getElementById('hariCheckboxAll').addEventListener('change', function() {
            const isChecked = this.checked;
            document.querySelectorAll('.hari-checkbox').forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });

        document.querySelectorAll('select[name^="guru_pengampu_id"]').forEach(select => {
            select.addEventListener('change', function() {
                const selectedValue = this.value;
                const hariId = this.dataset.hari;
                const sesiId = this.dataset.sesi;
                const kelasId = this.dataset.kelas;
                const csrfToken = $("meta[name='csrf-token']").attr("content");

                if (!selectedValue) {
                    return;
                }

                const data = {
                    _token: csrfToken,
                    guru_pengampu_id: selectedValue,
                    hari_id: hariId,
                    sesi_id: sesiId,
                    kelas_id: kelasId
                };

                $.ajax({
                    url: '/guru-pengampu/update', // Ganti dengan URL endpoint yang sesuai
                    type: 'post',
                    data: data,
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message ||
                                'Pilihan guru pengampu berhasil disimpan.');
                        } else if (response.errors) {
                            Object.values(response.errors).flat().forEach(msg => toastr.warning(
                                msg));
                        } else {
                            toastr.warning('Terjadi kesalahan saat menyimpan pilihan.');
                        }
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON.error);
                    }
                });
            });
        });
    </script>
@endpush
