<!-- Content -->
@extends('layout.app')
@section('title', 'Daftar Mata Pelajaran')
@section('content')
    <div class="content content-sm">

        <div class="container">

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                Data Mapel
            </div>
            {{-- End --}}

            <div class="row mt-4">
                <div class="col-lg-6 col-md-6 col-12 ms-auto">
                    <div class=" card p-lg-3 p-2 card-content">
                        {{-- Header Button --}}
                        <div class="d-flex mt-lg-2 mb-3 mb-lg-0 ">
                            <div class="dropdown">
                                <a class="btn btn-primary dropdown-toggle d-none d-lg-block d-md-block"
                                    href="javascript:void(0);" onclick="addKelma()" aria-expanded="false">
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
                                Kelompok Mapel
                            </div>
                        </div>
                        {{-- End --}}

                        {{-- Table Kelompok Mapel Desktop View --}}
                        <table class="table d-none d-lg-table d-md-table desktop-table mt-4">
                            <tr class="tr-table">
                                <th>Kelompok Mapel</th>
                                <th></th>
                            </tr>
                            @forelse ($kelma as $row)
                                <tr style="color: rgb(26, 26, 26);">
                                    <td>
                                        <div class="badge-globe px-3 my-auto">
                                            <span class="fs-6">
                                                {{ $row->kelompok_mapel }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);"
                                            onclick="editKelma('{{ $row->kelompok_mapel }}','{{ $row->id }}')"
                                            class="text-decoration-none">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="javascript:void(0);" onclick="deleteKelma('{{ $row->id }}')"
                                            class="text-decoration-none text-danger ms-1">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <p class="text-center my-5 d-none d-md-inline d-lg-inline">Belum ada data Kelompok
                                    Mapel!</p>
                            @endforelse
                        </table>
                        {{-- End --}}

                        {{-- Table Kelompok Mapel Mobile View --}}
                        @forelse ($kelma as $item)
                            <div class="card mb-2 p-2 d-lg-none d-md-none">
                                <div class="d-flex">
                                    <div class="d-inline">
                                        <div>{{ $item->kelompok_mapel }}
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
                                                onclick="editKelma('{{ $item->kelompok_mapel }}','{{ $item->id }}')">
                                                <i class="me-1 bi bi-pencil-square"></i>
                                                Ubah
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" onclick="deleteKelma('{{ $item->id }}')"
                                                class="dropdown-item">
                                                <i class="me-1 bi bi-trash3-fill"></i>
                                                Hapus
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @empty
                            <p class="text-center my-3 d-lg-none d-md-none">Belum ada data Kelompok Mapel!</p>
                        @endforelse
                        {{-- End --}}
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-12 me-auto mt-3 mt-lg-0 mt-md-0">
                    <div class="card p-lg-3 p-2 card-content">
                        {{-- Header Button --}}
                        <div class="d-flex mt-lg-2 mb-3 mb-lg-0 ">
                            <div class="dropdown">
                                <a class="btn btn-primary dropdown-toggle d-none d-lg-block d-md-block"
                                    href="javascript:void(0);" onclick="addMapel()" aria-expanded="false">
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
                                    <th>Nilai KKM</th>
                                    <th></th>
                                </tr>
                                @forelse ($mapel as $item)
                                    <tr style="color: rgb(26, 26, 26);">
                                        <td>
                                            <div class="badge-blobe px-3 my-auto">
                                                <span class="fs-6">
                                                    {{ $item->mapel }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="ps-3">
                                            <input type="hidden" name="mapel_id[]" value="{{ $item->id }}">
                                            <input type="text" class="form-control" style="width: 50px;"
                                                value="{{ $item->kkm }}" name="kkm[]">
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);"
                                                onclick="editMapel('{{ $item->id }}', '{{ $item->mapel }}', {{ $item->kkm }})"
                                                class="text-decoration-none">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="javascript:void(0);" onclick="deleteMapel('{{ $item->id }}')"
                                                class="text-decoration-none text-danger ms-1">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <p class="text-center my-5 d-none d-md-inline d-lg-inline">Belum ada data
                                        Mapel!</p>
                                @endforelse
                            </table>
                            {{-- End --}}
                            <button type="submit" class="btn btn-primary float-end">
                                <i class="bi bi-send-fill me-1"></i>
                                Simpan
                            </button>
                        </form>

                        {{-- Table Mapel Mobile View --}}
                        @forelse ($mapel as $row)
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
                        @endforelse
                        {{-- End --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="dropdown">
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
        </div>
    </div>


    {{-- 
    // Modal Untuk Bagian Kelompok Mapel
    --}}

    {{-- Modal Tambah Kelompok Mapel --}}
    <div class="modal fade" id="AddKelma" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="AddKelmaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="AddKelmaLabel">Tambah Kelompok Mapel</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('kelma.add') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="text" class="form-control form-borderless mb-4" name="kelompok_mapel"
                            placeholder="Masukan Kelompok Mapel!" required>
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

    {{-- Modal Edit Kelompok Mapel --}}
    <div class="modal fade" id="EditKelma" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="EditKelmaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="EditKelmaLabel">Ubah Kelompok Mapel</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('kelma.edit') }}" method="post">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <input type="hidden" class="form-control form-borderless" id="kelma-id-edit"
                            name="kelompok_mapel_id">
                        <input type="text" class="form-control form-borderless mb-4" id="kelma"
                            name="kelompok_mapel" placeholder="Masukan Kelompok Mapel!" required>
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

    {{-- Modal Delete Kelompok Mapel --}}
    <div class="modal fade" id="DeleteKelma" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="DeleteKelmaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="DeleteKelmaLabel">Hapus Kelompok Mapel</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('kelma.delete') }}" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <p id="keterangan-to-kelma" class="text-center"></p>
                        <input type="hidden" id="kelma-id-delete" name="kelompok_mapel_id">
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-default-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger d-none" id="delBtnkelma">
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
    // Modal Untuk Bagian Mapel
    --}}

    {{-- Modal Tambah Mapel --}}
    <div class="modal fade" id="AddMapel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="AddMapelLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="AddMapelLabel">Tambah Mapel</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('mapel.add') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <label for="" class="my-2">Nama Mapel</label>
                        <input type="text" class="form-control mb-4" name="mapel" placeholder="Masukan Nama Mapel!"
                            required>
                        <label for="" class="my-2">Nilai KKM</label>
                        <input type="text" class="form-control mb-4" name="kkm" placeholder="Masukan Nilai KKM!"
                            required>
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

    {{-- Modal Edit Mapel --}}
    <div class="modal fade" id="editMapel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editMapelLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="editMapelLabel">Ubah Mapel</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('mapel.edit') }}" method="post">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <input type="hidden" class="form-control form-borderless" id="mapel-id-edit" name="mapel_id">
                        <label for="" class="my-2">Nama Mapel</label>
                        <input type="text" class="form-control mb-4" id="nama-mapel" name="mapel"
                            placeholder="Masukan Nama Mapel!" required>
                        <label for="" class="my-2">Nilai KKM</label>
                        <input type="text" class="form-control mb-4" id="kkm-mapel" name="kkm"
                            placeholder="Masukan Nilai KKM!" required>
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

    {{-- Modal Delete Mapel --}}
    <div class="modal fade" id="deleteMapel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteMapelLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="deleteMapelLabel">Hapus Mapel</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('mapel.delete') }}" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <p class="text-center">
                            Apakah anda yakin ingin menghapus mapel ini?
                        </p>
                        <input type="hidden" id="mapel-id-delete" name="mapel_id">
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-default-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger" id="delBtnMapel">
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
        @error('kelma')
            let pesan = "{{ ucwords($message) }}"
            toastr.warning(pesan);
        @enderror
        // End

        // Modal tambah Kelompok Mapel
        function addKelma() {
            $('#AddKelma').modal('show');
        }

        // Modal edit Kelompok Mapel
        function editKelma(kelma, id) {
            $('#kelma-id-edit').val(id);
            $('#kelma').val(kelma);
            $('#EditKelma').modal('show');
        }

        // Modal hapus Kelompok Mapel
        function deleteKelma(id) {
            // url
            const url = "{{ url('/getKelmaDalamKurlumMapel') }}/";

            $.getJSON(url + id,
                function(json) {

                    if (json != 0) {
                        $('#keterangan-to-kelma').text('Kelompok mapel ini sudah digunakan!');
                        $('#delBtnkelma').addClass('d-none');
                    } else {
                        $('#keterangan-to-kelma').text(
                            'Apakah anda yakin ingin menghapus kelompok mapel ini?');
                        $('#delBtnkelma').removeClass('d-none');
                        $('#kelma-id-delete').val(id);
                    }
                    $('#DeleteKelma').modal('show');
                }
            );

        }

        // Modal tambah mapel
        function addMapel() {
            $('#AddMapel').modal('show');
        }

        // Modal edit mapel
        function editMapel(id, mapel, kkm) {
            $('#mapel-id-edit').val(id);
            $('#nama-mapel').val(mapel);
            $('#kkm-mapel').val(kkm);
            $('#editMapel').modal('show');
        }

        // Modal hapus mapel
        function deleteMapel(id) {
            // url
            // const url = "{{ url('/getSiswaDalamMapel') }}/";

            // $.getJSON(url + id,
            //     function(json) {
            //         if (json != 0) {
            //             $('#keterangan-to-mapel').text('mapel ini sudah digunakan!');
            //             $('#delBtnmapel').addClass('d-none');
            //         } else {
            //             $('#keterangan-to-mapel').text('Apakah anda yakin ingin menghapus mapel ini?');
            //             $('#delBtnmapel').removeClass('d-none');
            //         }
            //     }
            // );
            $('#mapel-id-delete').val(id);
            $('#deleteMapel').modal('show');
        }
    </script>
@endpush
