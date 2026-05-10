<!-- Content -->
@extends('layout.app')
@section('title', 'Daftar Pendidikan')
@section('content')
    <div class="content content-sm">

        <div class="container">

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                Data Pendidikan
            </div>
            {{-- End --}}

            <div class="row mt-4">
                <div class="col-lg-6 col-md-6 col mx-auto">

                    <div class=" card p-lg-3 p-2 card-content">
                        {{-- Header Button --}}
                        <div class="d-flex mt-2 mb-3 mb-lg-0 ">
                            <a class="btn btn-primary d-none d-lg-block d-md-block" href="javascript:void(0);"
                                onclick="addPendidikan()" aria-expanded="false">
                                <i class="bi bi-plus-lg"></i>
                                Tambah
                            </a>

                            {{-- Tombol Refresh --}}
                            <a href="{{ route('pendidikan') }}"
                                class="btn btn-default-2 d-none d-lg-block d-md-block ms-auto">
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

                        {{-- Table pendidikan Desktop View --}}
                        @if ($pendidikan)
                            <table class="table d-none d-lg-table d-md-table desktop-table mt-4">
                                <tr class="tr-table">
                                    <th>
                                        No
                                    </th>
                                    <th>Pendidikan</th>
                                    <th>Keterangan</th>
                                    <th></th>
                                </tr>
                                @foreach ($pendidikan as $row)
                                    <tr style="color: rgb(26, 26, 26);">
                                        <td>
                                            {{ $loop->iteration }}).
                                        </td>
                                        <td>
                                            <div class="badge-globe px-3 my-auto">
                                                <span class="fs-6">
                                                    {{ $row->pendidikan }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $row->ket_pendidikan }}
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);"
                                                onclick="editPendidikan('{{ $row->pendidikan }}','{{ $row->ket_pendidikan }}','{{ $row->id }}')"
                                                class="text-decoration-none">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="javascript:void(0);" onclick="deletePendidikan('{{ $row->id }}')"
                                                class="text-decoration-none text-danger ms-1">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <p class="text-center my-5 d-none d-md-inline d-lg-inline">Belum ada data pendidikan!</p>
                        @endif
                        {{-- End --}}

                        {{-- Table pendidikan Mobile View --}}
                        @if ($pendidikan)
                            @foreach ($pendidikan as $item)
                                <div class="card mb-2 p-2 d-lg-none d-md-none">
                                    <div class="d-flex">
                                        <div class="d-inline">
                                            <div class="fs-nama">{{ $loop->iteration }}). &nbsp;{{ $item->pendidikan }}
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
                                                    onclick="editPendidikan('{{ $item->pendidikan }}','{{ $row->ket_pendidikan }}','{{ $item->id }}')">
                                                    <i class="me-1 bi bi-pencil-square"></i>
                                                    Ubah
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    onclick="deletePendidikan('{{ $item->id }}')"
                                                    class="dropdown-item">
                                                    <i class="me-1 bi bi-trash3-fill"></i>
                                                    Hapus
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center my-3 d-lg-none d-md-none">Belum ada data pendidikan!</p>
                        @endif
                        {{-- End --}}
                    </div>
                </div>
            </div>
        </div>

        <a href="javascript:void(0);" onclick="addPendidikan()"
            class="btn btn-primary add-btn-siswa-mbl d-lg-none d-md-none">
            <i class="bi bi-plus-lg"></i>
        </a>
    </div>

    {{-- Modal Tambah pendidikan --}}
    <div class="modal fade" id="AddPendidikan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="AddPendidikanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="AddPendidikanLabel">Tambah pendidikan</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('pendidikan.add') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <label for="" class="mb-2">Nama Jenjang</label>
                        <input type="text" class="form-control mb-4" name="pendidikan" placeholder="Masukan pendidikan!"
                            required>
                        <label for="" class="mb-2">Keterangan Jenjang</label>
                        <input type="text" class="form-control mb-4" name="ket_pendidikan"
                            placeholder="Masukan keterangan pendidikan!" required>
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

    {{-- Modal Edit pendidikan --}}
    <div class="modal fade" id="editPendidikan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editPendidikanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="editPendidikanLabel">Ubah pendidikan</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('pendidikan.edit') }}" method="post">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="pendidikan-id-edit" name="pendidikan_id">
                        <label for="" class="mb-2">Nama Jenjang</label>
                        <input type="text" class="form-control mb-4" id="pendidikan" name="pendidikan"
                            placeholder="Masukan pendidikan!" required>
                        <label for="" class="mb-2">Keterangan Jenjang</label>
                        <input type="text" class="form-control mb-4" id="ket-pendidikan" name="ket_pendidikan"
                            placeholder="Masukan keterangan pendidikan!" required>
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

    {{-- Modal Delete pendidikan --}}
    <div class="modal fade" id="deletePendidikan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deletePendidikanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="deletePendidikanLabel">Hapus pendidikan</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('pendidikan.delete') }}" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <p id="keterangan-to-pendidikan" class="text-center">
                            Apakah anda yakin ingin menghapus pendidikan ini?
                        </p>
                        <input type="hidden" id="pendidikan-id-delete" name="pendidikan_id">
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-default-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger" id="delBtnpendidikan">
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

        // Modal tambah pendidikan
        function addPendidikan() {
            $('#AddPendidikan').modal('show');
        }

        // Modal edit pendidikan
        function editPendidikan(pendidikan, ketPendidikan, id) {
            $('#pendidikan-id-edit').val(id);
            $('#pendidikan').val(pendidikan);
            $('#ket-pendidikan').val(ketPendidikan);
            $('#editPendidikan').modal('show');
        }

        // Modal hapus pendidikan
        function deletePendidikan(id) {
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

            $('#pendidikan-id-delete').val(id);
            $('#deletePendidikan').modal('show');
        }
    </script>
@endpush
