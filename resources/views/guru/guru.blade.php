<!-- Content -->
@extends('layout.app')
@section('title', 'Daftar Guru')
@section('content')
    <div class="content content-sm">

        <div class="container">

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                Data Guru & Staff
            </div>
            {{-- End --}}

            <div class="row mt-4">
                <div class="col-lg-8 col-md-6 col-12 mb-3">

                    <div class=" card p-lg-3 p-2 card-content">
                        {{-- Header Button --}}
                        <div class="d-flex mt-2 mb-3 mb-lg-0 ">
                            <a class="btn btn-primary d-none d-lg-block d-md-block" href="javascript:void(0);"
                                onclick="addGuru()" aria-expanded="false">
                                <i class="bi bi-plus-lg"></i>
                                Tambah
                            </a>

                            {{-- Tombol Refresh --}}
                            <a href="{{ route('guru') }}" class="btn btn-default-2 d-none d-lg-block d-md-block ms-auto">
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

                            <div class="d-inline d-lg-none ms-lg-auto align-self-center fw-bold">
                                <i class="bi bi-person-vcard-fill mx-2 d-lg-none" style="font-size: 16px;"></i>
                                Data Guru
                            </div>
                        </div>
                        {{-- End --}}

                        {{-- Table guru Desktop View --}}
                        <table class="table d-none d-lg-table d-md-table desktop-table mt-4">
                            <tr class="tr-table">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>NIP/NIPY</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            @forelse ($guru as $row)
                                <tr style="color: rgb(26, 26, 26);">
                                    <td>
                                        {{ $loop->iteration }}).
                                    </td>
                                    <td>
                                        {{ $row->nama_guru }}
                                    </td>
                                    <td>
                                        {{ $row->jabatan }}
                                    </td>
                                    <td>
                                        {{ $row->nip }}
                                    </td>
                                    <td>
                                        <div class="badge-globe px-3 my-auto">
                                            <span style="font-size: 12px;">
                                                {{ $row->status_pegawai }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);"
                                            onclick="editGuru('{{ $row->nama_guru }}','{{ $row->nip }}','{{ $row->jabatan }}','{{ $row->status_guru }}','{{ $row->id }}')"
                                            class="text-decoration-none">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="javascript:void(0);" onclick="deleteGuru('{{ $row->id }}')"
                                            class="text-decoration-none text-danger ms-1">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center border-0">
                                        <p class="text-center my-5 d-none d-md-inline d-lg-inline">Belum ada data guru!</p>
                                    </td>
                                </tr>
                            @endforelse
                        </table>

                        {{-- End --}}

                        {{-- Table guru Mobile View --}}
                        @forelse ($guru as $item)
                            <div class="card mb-2 p-2 d-lg-none d-md-none">
                                <div class="d-flex">
                                    <div class="d-inline">
                                        <div class="fs-nama">
                                            {{ $loop->iteration }}). &nbsp;{{ $item->nama_guru }}
                                            <span class="badge-globe px-2 ms-2">
                                                {{ $item->status_pegawai }}
                                            </span>
                                        </div>
                                        <br>
                                        <span class="ps-4">
                                            {{ $item->nip }}
                                        </span>
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
                                                onclick="editGuru('{{ $item->nama_guru }}','{{ $item->nip }}','{{ $item->jabatan }}','{{ $item->status_guru }}','{{ $item->id }}')">
                                                <i class="me-1 bi bi-pencil-square"></i>
                                                Ubah
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" onclick="deleteGuru('{{ $item->id }}')"
                                                class="dropdown-item">
                                                <i class="me-1 bi bi-trash3-fill"></i>
                                                Hapus
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @empty
                            <p class="text-center mb-4 mt-3 d-lg-none d-md-none">Belum ada data guru!</p>
                        @endforelse
                        {{-- End --}}
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">

                    <div class=" card p-lg-3 p-2 card-content">
                        {{-- Header Button --}}
                        <div class="d-flex mt-2 mb-3 mb-lg-0 ">
                            <a class="btn btn-primary d-none d-lg-block d-md-block" href="javascript:void(0);"
                                onclick="addStaPeg()" aria-expanded="false">
                                <i class="bi bi-plus-lg"></i>
                                Tambah
                            </a>

                            <div class="d-inline ms-lg-auto align-self-center fw-bold">
                                <i class="bi bi-person-vcard-fill mx-2 d-lg-none" style="font-size: 16px;"></i>
                                Status Kepegawaian
                            </div>
                        </div>
                        {{-- End --}}

                        {{-- Table Status Kepegawaian Desktop View --}}
                        <table class="table d-none d-lg-table d-md-table desktop-table mt-4">
                            <tr class="tr-table">
                                <th style="width: 10%;">No</th>
                                <th>Status</th>
                                <th style="width: 20%;"></th>
                            </tr>
                            @forelse ($stapeg as $row)
                                <tr style="color: rgb(26, 26, 26);">
                                    <td>
                                        {{ $loop->iteration }}).
                                    </td>
                                    <td>
                                        <div class="badge-globe py-0 px-3 mb-1 my-auto">
                                            <span style="font-size: 12px;">
                                                {{ $row->status_pegawai }}
                                            </span>
                                        </div>
                                        {{ $row->ket_status_pegawai }}
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);"
                                            onclick="editStaPeg('{{ $row->status_pegawai }}','{{ $row->ket_status_pegawai }}','{{ $row->id }}')"
                                            class="text-decoration-none">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="javascript:void(0);" onclick="deleteStaPeg('{{ $row->id }}')"
                                            class="text-decoration-none text-danger ms-1">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center border-0">
                                        <p class="text-center my-5 d-none d-md-inline d-lg-inline">
                                            Belum ada data status kepegawaian!
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                        </table>
                        {{-- End --}}

                        {{-- Table Status Kepegawaian Mobile View --}}
                        @forelse ($stapeg as $item)
                            <div class="card mb-2 p-2 d-lg-none d-md-none">
                                <div class="d-flex">
                                    <div class="d-inline">
                                        <div class="fs-nama">
                                            {{ $loop->iteration }}). &nbsp;
                                            {{ $item->status_pegawai }}
                                        </div>
                                        <br>
                                        <span class="ps-4">
                                            {{ $item->ket_status_pegawai }}
                                        </span>
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
                                                onclick="editStaPeg('{{ $item->status_pegawai }}','{{ $item->ket_status_pegawai }}','{{ $item->id }}')">
                                                <i class="me-1 bi bi-pencil-square"></i>
                                                Ubah
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" onclick="deleteStaPeg('{{ $item->id }}')"
                                                class="dropdown-item">
                                                <i class="me-1 bi bi-trash3-fill"></i>
                                                Hapus
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @empty
                            <p class="text-center mb-4 mt-3 d-lg-none d-md-none">Belum ada data!</p>
                        @endforelse
                        {{-- End --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="dropdown">
            <a href="javascript:void(0);" class="btn btn-primary add-btn-siswa-mbl d-lg-none d-md-none dropdown-toggle"
                data-bs-toggle="dropdown">
                <i class="bi bi-plus-lg"></i>
            </a>
            <ul id="pilihKelas" class="dropdown-menu pilihan-kelas">
                <li>
                    <a href="javascript:void(0);" onclick="addGuru()" class="dropdown-item fs-6"
                        style="font-size: 12px !important;">
                        Guru
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);" onclick="addStaPeg()" class="dropdown-item fs-6"
                        style="font-size: 12px !important;">
                        Status Kepegawaian
                    </a>
                </li>
            </ul>
        </div>
    </div>

    {{-- Modal Tambah Guru --}}
    <div class="modal fade" id="AddGuru" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="AddGuruLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="AddGuruLabel">Tambah Data Guru</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('guru.add') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <label for="" class="mb-2">Nama Lengkap</label>
                        <input type="text" class="form-control mb-4" name="nama_guru"
                            placeholder="Masukan nama guru!" required>
                        <label for="" class="mb-2">Jabatan</label>
                        <select name="jabatan" class="form-control mb-3 @error('jabatan') is-invalid @enderror" required>
                            <option value="">Pilih Jabatan</option>
                            @foreach ($jabatan as $item)
                                <option value="{{ $item }}" {{ old('jabatan') == $item ? 'selected' : '' }}>
                                    {{ $item }}
                                </option>
                            @endforeach
                        </select>
                        <label for="" class="mb-2">NIP</label>
                        <input type="text" class="form-control mb-4" name="nip" placeholder="Masukan NIP!"
                            required>
                        <label for="" class="mb-2">Status</label>
                        <select name="status_guru" class="form-control mb-3 @error('status_guru') is-invalid @enderror"
                            required>
                            <option value="">Pilih Status</option>
                            @foreach ($stapeg as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('status_guru') == $item->id ? 'selected' : '' }}>
                                    {{ $item->status_pegawai . ' ( ' . $item->ket_status_pegawai . ' )' }}
                                </option>
                            @endforeach
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

    {{-- Modal Edit guru --}}
    <div class="modal fade" id="editGuru" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editGuruLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="editGuruLabel">Ubah Data Guru</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('guru.edit') }}" method="post">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="guru-id-edit" name="guru_id">
                        <label for="" class="mb-2">Nama Lengkap</label>
                        <input type="text" class="form-control mb-4" id="nama-guru" name="nama_guru"
                            placeholder="Masukan guru!" required>
                        <label for="" class="mb-2">Jabatan</label>
                        <select name="jabatan" id="jabatan"
                            class="form-control mb-3 @error('jabatan') is-invalid @enderror" required>
                            <option value="">Pilih Jabatan</option>
                            @foreach ($jabatan as $item)
                                <option value="{{ $item }}" {{ old('jabatan') == $item ? 'selected' : '' }}>
                                    {{ $item }}
                                </option>
                            @endforeach
                        </select>
                        <label for="" class="mb-2">NIP</label>
                        <input type="text" class="form-control mb-4" id="nip" name="nip"
                            placeholder="Masukan NIP!" required>
                        <label for="" class="mb-2">Status</label>
                        <select name="status_guru" class="form-control mb-3 @error('status_guru') is-invalid @enderror"
                            id="status-guru" required>
                            <option value="">Pilih Status</option>
                            @foreach ($stapeg as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('status_guru') == $item->id ? 'selected' : '' }}>
                                    {{ $item->status_pegawai . ' ( ' . $item->ket_status_pegawai . ' )' }}
                                </option>
                            @endforeach
                        </select>
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

    {{-- Modal Delete guru --}}
    <div class="modal fade" id="deleteGuru" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteGuruLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="deleteGuruLabel">Hapus Data Guru</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('guru.delete') }}" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <p id="keterangan-to-guru" class="text-center">
                            Apakah anda yakin ingin menghapus guru ini?
                        </p>
                        <input type="hidden" id="guru-id-delete" name="guru_id">
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-default-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger" id="delBtnguru">
                            <i class="me-1 bi bi-trash3-fill"></i>
                            Hapus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End --}}



    {{-- Modal Tambah Status Kepegawaian --}}
    <div class="modal fade" id="AddStaPeg" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="AddStaPegLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="AddStaPegLabel">Tambah Status Kepegawaian</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('stapeg.add') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <label for="" class="mb-2">Nama Status</label>
                        <input type="text" class="form-control mb-4" name="status_pegawai"
                            placeholder="Contoh : PNS, P3K, GTT, GTY !" required>
                        <label for="" class="mb-2">Keterangan Status</label>
                        <input type="text" class="form-control mb-4" name="ket_status_pegawai"
                            placeholder="Contoh: Pegawai Negeri Sipil !" required>
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

    {{-- Modal Edit Status Kepegawaian --}}
    <div class="modal fade" id="editStaPeg" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editStaPegLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="editStaPegLabel">Ubah Status Kepegawaian</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('stapeg.edit') }}" method="post">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="stapeg-id-edit" name="status_pegawai_id">
                        <label for="" class="mb-2">Nama Status</label>
                        <input type="text" class="form-control mb-4" id="stapeg" name="status_pegawai"
                            placeholder="Masukan status kepegawaian!" required>
                        <label for="" class="mb-2">Keterangan Status</label>
                        <input type="text" class="form-control mb-4" id="ket_status_pegawai"
                            name="ket_status_pegawai" placeholder="Masukan Keterangan!" required>
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

    {{-- Modal Delete Status Kepegawaian --}}
    <div class="modal fade" id="deleteStaPeg" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteStaPegLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="deleteStaPegLabel">Hapus Status Kepegawaian</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('stapeg.delete') }}" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <p id="keterangan-to-stapeg" class="text-center"></p>
                        <input type="hidden" id="stapeg-id-delete" name="status_pegawai_id">
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-default-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger" id="delBtnStapeg">
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

        // Modal tambah guru
        function addGuru() {
            $('#AddGuru').modal('show');
        }

        // Modal edit guru
        function editGuru(nama, nip, jabatan, sts_guru, id) {
            $('#guru-id-edit').val(id);
            $('#nama-guru').val(nama);
            $('#nip').val(nip);
            $('#jabatan').val(jabatan);
            $('#status-guru').val(sts_guru);
            $('#editGuru').modal('show');
        }

        // Modal hapus guru
        function deleteGuru(id) {
            // url
            // const url = "{{ url('/getKelasDalamTingkat') }}/";

            // $.getJSON(url + id,
            //     function(json) {
            //         if (json != 0) {
            //             $('#keterangan-to-Tingkat').text('Tingkat ini sudah digunakan!');
            //             $('#delBtnTingkat').addClass('d-none');
            //         } else {
            //             $('#keterangan-to-Tingkat').text('Apakah anda yakin ingin menghapus tingkat ini?');
            //             $('#delBtnTingkat').removeClass('d-none');
            //             $('#Tingkat-id-delete').val(id);
            //         }
            //     }
            // );

            $('#guru-id-delete').val(id);
            $('#deleteGuru').modal('show');
        }


        // Modal tambah status kepegawaian
        function addStaPeg() {
            $('#AddStaPeg').modal('show');
        }

        // Modal edit Stapeg
        function editStaPeg(stapeg, ket_status_pegawai, id) {
            $('#stapeg-id-edit').val(id);
            $('#stapeg').val(stapeg);
            $('#ket_status_pegawai').val(ket_status_pegawai);
            $('#editStaPeg').modal('show');
        }

        // Modal hapus stapeg
        function deleteStaPeg(id) {
            // url
            const url = "{{ url('/getStatusPegawaiDalamGuru') }}/";

            $.getJSON(url + id,
                function(json) {
                    if (json != 0) {
                        $('#keterangan-to-stapeg').text('Status kepegawaian ini sudah digunakan!');
                        $('#delBtnStapeg').addClass('d-none');
                    } else {
                        $('#keterangan-to-stapeg').text('Apakah anda yakin ingin menghapus status kepegawaian ini?');
                        $('#delBtnStapeg').removeClass('d-none');
                        $('#stapeg-id-delete').val(id);
                    }
                    $('#deleteStaPeg').modal('show');
                }
            );

        }
    </script>
@endpush
