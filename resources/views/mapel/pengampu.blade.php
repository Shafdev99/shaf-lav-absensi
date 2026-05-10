<!-- Content -->
@extends('layout.app')
@section('title', 'Daftar Guru Pengampu Mata Pelajaran')
@section('content')
    <div class="content content-sm">

        <div class="container">

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                Guru & Mata Pelajaran
            </div>
            {{-- End --}}

            <div class="row mt-4">


                <div class="col-lg-8 col-md-6 col-12 mx-auto mt-3 mt-lg-0 mt-md-0">
                    <div class="card p-lg-3 p-2 card-content">
                        {{-- Header Button --}}
                        <div class="d-flex mt-lg-2 mb-3 mb-lg-0 ">
                            <div class="dropdown">
                                <a class="btn btn-primary d-none d-lg-block d-md-block" onclick="addGuruPengampu()"
                                    href="#">
                                    <i class="bi bi-plus-lg"></i>
                                    Tambah
                                </a>
                            </div>

                            {{-- Tombol Refresh --}}
                            <a href="{{ route('mapel') }}" class="btn btn-default-2 d-none d-lg-block d-md-block ms-auto">
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
                                Data Mapel
                            </div>
                        </div>
                        {{-- End --}}

                        <form action="{{ route('mapel.edit.kkm') }}" method="post">

                            @csrf
                            @method('put')
                            {{-- Table Mapel Desktop View --}}
                            <table class="table d-none d-lg-table d-md-table desktop-table mt-4">
                                <tr class="tr-table">
                                    <th>Mapel</th>
                                    <th>Guru pengampu</th>
                                    <th>Jam Pelajaran</th>
                                    <th>Daftar Kelas</th>
                                    <th></th>
                                </tr>
                                @forelse ($mapel as $item)
                                    {{-- Data Mapel --}}
                                    <tr style="color: rgb(26, 26, 26);">
                                        <td colspan="4">
                                            <div class="badge-blobe px-3 my-auto">
                                                <span class="fs-6">
                                                    {{ $item->mapel }}
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    {{-- End --}}

                                    {{-- Data Guru Pengampu --}}
                                    @foreach ($guru_pengampu as $gupe)
                                        @if ($gupe->mapel_id == $item->id)
                                            <tr class="bg-light">
                                                <td width="30%"></td>
                                                <td class="ps-4">
                                                    <span>{{ $gupe->guru->nama_guru }}</span>
                                                </td>
                                                <td class="ps-4">
                                                    <span>{{ $gupe->jam_pelajaran }} JP</span>
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0);"
                                                        onclick="kelolaKelas('{{ $gupe->id }}')"
                                                        class="text-decoration-none text-white p-2 badge bg-primary">
                                                        Lihat Kelas
                                                        <i class="bi bi-card-list ms-1"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0);"
                                                        onclick="editGuruPengampu('{{ $gupe->id }}', '{{ $gupe->mapel_id }}', '{{ $gupe->guru_id }}', {{ $gupe->jam_pelajaran }})"
                                                        class="text-decoration-none">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="javascript:void(0);"
                                                        onclick="deleteGuruPengampu('{{ $gupe->id }}')"
                                                        class="text-decoration-none text-danger ms-1">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    {{-- End --}}

                                @empty
                                    <p class="text-center my-5 d-none d-md-inline d-lg-inline">Belum ada data
                                        Mapel!</p>
                                @endforelse
                            </table>
                            {{-- End --}}
                        </form>

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
    // Modal Untuk Bagian Guru Pengampu 
    --}}

    {{-- Modal Tambah Guru Pengampu --}}
    <div class="modal fade" id="AddGuruPengampu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="AddGuruPengampuLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="AddGuruPengampuLabel">Tambah Guru Pengampu</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('guru.pengampu.add') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <label for="" class="my-2">Mata Pelajaran</label>
                        <select name="mapel_id" class="form-select mb-4" id="">
                            <option value="">Pilih Mata Pelajaran</option>
                            @foreach ($mapel as $Mapel)
                                <option value="{{ $Mapel->id }}">{{ $Mapel->mapel }}</option>
                            @endforeach
                        </select>
                        <label for="" class="my-2">Nama Guru Pengampu</label>
                        <select name="guru_id" class="form-select mb-4" id="">
                            <option value="">Pilih Guru</option>
                            @foreach ($guru as $Guru)
                                <option value="{{ $Guru->id }}">{{ $Guru->nama_guru . ' - ' . $Guru->jabatan }}
                                </option>
                            @endforeach
                        </select>
                        <label for="" class="my-2">Jam Pelajaran</label>
                        <input type="number" class="form-control mb-4" name="jam_pelajaran"
                            placeholder="Masukan Jam pelajaran!" required>
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

    {{-- Modal Edit Guru Pengampu --}}
    <div class="modal fade" id="EditGuruPengampu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="EditGuruPengampuLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="EditGuruPengampuLabel">Edit Guru Pengampu</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('guru.pengampu.edit') }}" method="post">
                    @csrf
                    @method('put')
                    <input type="text" id="guru-pengampu-id-edit" name="guru_pengampu_id" hidden>
                    <div class="modal-body">
                        <label for="" class="my-2">Mata Pelajaran</label>
                        <select name="mapel_id" class="form-select mb-4" id="mapel-id-edit">
                            <option value="">Pilih Mata Pelajaran</option>
                            @foreach ($mapel as $Mapel)
                                <option value="{{ $Mapel->id }}">{{ $Mapel->mapel }}</option>
                            @endforeach
                        </select>
                        <label for="" class="my-2">Nama Guru Pengampu</label>
                        <select name="guru_id" class="form-select mb-4" id="guru-id-edit">
                            <option value="">Pilih Guru</option>
                            @foreach ($guru as $Guru)
                                <option value="{{ $Guru->id }}">{{ $Guru->nama_guru . ' - ' . $Guru->jabatan }}
                                </option>
                            @endforeach
                        </select>
                        <label for="" class="my-2">Jam Pelajaran</label>
                        <input type="number" class="form-control mb-4" name="jam_pelajaran"
                            placeholder="Masukan Jam pelajaran!" id="jam-pelajaran" required>
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

    {{-- Modal Hapus Guru Pengampu  --}}
    <div class="modal fade" id="deleteGuruPengampu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteGuruPengampuLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="deleteGuruPengampuLabel">Hapus Guru Pengampu</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('guru.pengampu.delete') }}" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <p class="text-center px-3" id="keterangan-to-guru-pengampu">
                            Apakah anda yakin ingin menghapus guru pengampu ini?
                        </p>
                        <input type="hidden" id="guru-pengampu-id-delete" name="guru_pengampu_id">
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-default-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger" id="delBtnGuruPengampu">
                            <i class="me-1 bi bi-trash3-fill"></i>
                            Hapus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End --}}

    {{-- Modal Kelola Kelas --}}
    <div class="modal fade" id="KelolaKelas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="KelolaKelasLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="KelolaKelasLabel">Kelola Kelas</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('guru.pengampu.kelola.kelas') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <label for="" class="my-2">Daftar Kelas yang diampu oleh guru</label>
                        <input type="text" name="guru_pengampu_id" id="guru-pengampu-id-kelola" class="form-control"
                            hidden>
                        @foreach ($kelas as $Kelas)
                            <ul class="list-group">
                                <li class="list-group-item list-group-item-action mb-2">
                                    <input type="checkbox" name="kelas_id[]" class="form-checkbox"
                                        value="{{ $Kelas->id }}" id="kelas-{{ $Kelas->id }}">
                                    <label
                                        for="kelas-{{ $Kelas->id }}">{{ $Kelas->tingkat . ' ' . $Kelas->nama_jurusan . ' ' . $Kelas->nama_kelas }}</label>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                    <div class="modal-footer border-top">
                        <button type="reset" class="btn btn-default-2" id="btn-reset-kelola-kelas" data-bs-dismiss="modal">Batal</button>
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

        function addGuruPengampu() {
            $('#AddGuruPengampu').modal('show');
        }

        // Modal edit mapel
        function editGuruPengampu(guruPengampuId, mapelId, guruId, jamPelajaran) {
            $('#guru-pengampu-id-edit').val(guruPengampuId);
            $('#mapel-id-edit').val(mapelId);
            $('#guru-id-edit').val(guruId);
            $('#jam-pelajaran').val(jamPelajaran);
            $('#EditGuruPengampu').modal('show');
        }

        // Modal hapus guru pengampu
        function deleteGuruPengampu(id) {
            // url
            // const url = "{{ url('/getSiswaDalamMapel') }}/";

            // $.getJSON(url + id,
            //     function(json) {
            //         if (json != 0) {
            //             $('#keterangan-to-guru-pengampu').text('guru pengampu ini sudah digunakan!');
            //             $('#delBtnguru-pengampu').addClass('d-none');
            //         } else {
            //             $('#keterangan-to-mapel').text('Apakah anda yakin ingin menghapus mapel ini?');
            //             $('#delBtnmapel').removeClass('d-none');
            //         }
            //     }
            // );
            $('#guru-pengampu-id-delete').val(id);
            $('#deleteGuruPengampu').modal('show');
        }

        function kelolaKelas(guruPengampuId) {
            // url
            const url = "{{ url('/get-kelas-guru-pengampu') }}/";
            $('#guru-pengampu-id-kelola').val(guruPengampuId);
            $.getJSON(url + guruPengampuId,
                function(json) {
                    json.forEach(function(kelasId) {
                        if (kelasId) {
                            $('#kelas-' + kelasId).prop('checked', true);
                        } else {
                            $('#kelas-' + kelasId).prop('checked', false);
                        }
                    });
                    $('#KelolaKelas').modal('show');
                }
            );
        }

        $('#btn-reset-kelola-kelas').click(function (e) { 
            e.preventDefault();
            $('input[name="kelas_id[]"]').prop('checked', false);
        });
    </script>
@endpush
