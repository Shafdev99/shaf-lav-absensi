<!-- Content -->
@extends('layout.app')
@section('title', 'Daftar Agama')
@section('content')
    <div class="content content-sm">

        <div class="container">

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                Data Agama
            </div>
            {{-- End --}}

            <div class="row mt-4">
                <div class="col-lg-6 col-md-6 col mx-auto">
                    <div class=" card p-lg-3 p-2 card-content">
                        {{-- Header Button --}}
                        <div class="d-flex mt-2 mb-3 mb-lg-0 ">
                            <a class="btn btn-primary d-none d-lg-block d-md-block" href="javascript:void(0);"
                                onclick="addAgama()" aria-expanded="false">
                                <i class="bi bi-plus-lg"></i>
                                Tambah
                            </a>

                            {{-- Tombol Refresh --}}
                            <a href="{{ route('agama') }}" class="btn btn-default-2 d-none d-lg-block d-md-block ms-auto">
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

                        {{-- Table Agama Desktop View --}}
                        @if ($agama)
                            <table class="table d-none d-lg-table d-md-table desktop-table mt-4">
                                <tr class="tr-table">
                                    <th>
                                        No
                                    </th>
                                    <th>Agama</th>
                                    <th></th>
                                </tr>
                                @foreach ($agama as $row)
                                    <tr style="color: rgb(26, 26, 26);">
                                        <td>
                                            {{ $loop->iteration }}).
                                        </td>
                                        <td>
                                            <div class="badge-globe px-3 my-auto">
                                                <span class="fs-6">
                                                    {{ $row->agama }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);"
                                                onclick="editAgama('{{ $row->agama }}','{{ $row->id }}')"
                                                class="text-decoration-none">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="javascript:void(0);" onclick="deleteAgama('{{ $row->id }}')"
                                                class="text-decoration-none text-danger ms-1">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <p class="text-center my-5 d-none d-md-inline d-lg-inline">Belum ada data agama!</p>
                        @endif
                        {{-- End --}}

                        {{-- Table Agama Mobile View --}}
                        @if ($agama)
                            @foreach ($agama as $item)
                                <div class="card mb-2 p-2 d-lg-none d-md-none">
                                    <div class="d-flex">
                                        <div class="d-inline">
                                            <div class="fs-nama">{{ $loop->iteration }}). &nbsp;{{ $item->agama }}
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
                                                    onclick="editAgama('{{ $item->agama }}','{{ $item->id }}')">
                                                    <i class="me-1 bi bi-pencil-square"></i>
                                                    Ubah
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" onclick="deleteAgama('{{ $item->id }}')"
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
                            <p class="text-center my-3 d-lg-none d-md-none">Belum ada data agama!</p>
                        @endif
                        {{-- End --}}
                    </div>
                </div>
            </div>
        </div>

        <a href="javascript:void(0);" onclick="addAgama()" class="btn btn-primary add-btn-siswa-mbl d-lg-none d-md-none">
            <i class="bi bi-plus-lg"></i>
        </a>
    </div>

    {{-- Modal Tambah Agama --}}
    <div class="modal fade" id="AddAgama" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="AddagamaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="AddagamaLabel">Tambah Agama</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('agama.add') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="text" class="form-control form-borderless mb-4" name="agama"
                            placeholder="Masukan Agama!" required>
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

    {{-- Modal Edit Agama --}}
    <div class="modal fade" id="editAgama" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editAgamaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="editAgamaLabel">Ubah Agama</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('agama.edit') }}" method="post">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <input type="hidden" class="form-control form-borderless" id="agama-id-edit" name="agama_id">
                        <input type="text" class="form-control form-borderless mb-4" id="agama" name="agama"
                            placeholder="Masukan Agama!" required>
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

    {{-- Modal Delete Agama --}}
    <div class="modal fade" id="deleteAgama" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteagamaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="deleteagamaLabel">Hapus Agama</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('agama.delete') }}" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <p id="keterangan-to-agama" class="text-center">
                            Apakah anda yakin ingin menghapus agama ini?
                        </p>
                        <input type="hidden" id="agama-id-delete" name="agama_id">
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-default-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger" id="delBtnagama">
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
        @error('agama')
            let pesan = "{{ ucwords($message) }}"
            toastr.warning(pesan);
        @enderror
        // End

        // Modal tambah Agama
        function addAgama() {
            $('#AddAgama').modal('show');
        }

        // Modal edit Agama
        function editAgama(agama, id) {
            $('#agama-id-edit').val(id);
            $('#agama').val(agama);
            $('#editAgama').modal('show');
        }

        // Modal hapus Agama
        function deleteAgama(id) {
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

            $('#agama-id-delete').val(id);
            $('#deleteAgama').modal('show');
        }
    </script>
@endpush
