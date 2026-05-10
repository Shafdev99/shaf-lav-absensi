<!-- Content -->
@extends('layout.app')
@section('title', 'Daftar Kurikulum')
@section('content')
    <div class="content content-sm">

        <div class="container">

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                Kurikulum
            </div>
            {{-- End --}}

            <div class="row mt-4">
                <div class="col-lg-8 col-md-6 col mx-auto">
                    <div class=" card p-lg-3 p-2 card-content">
                        {{-- Header Button --}}
                        <div class="d-flex mt-2 mb-3 mb-lg-0 ">
                            <a class="btn btn-primary d-none d-lg-block d-md-block" href="javascript:void(0);"
                                onclick="addKurlum()" aria-expanded="false">
                                <i class="bi bi-plus-lg"></i>
                                Tambah
                            </a>

                            {{-- Tombol Refresh --}}
                            <a href="" class="btn btn-default-2 d-none d-lg-block d-md-block ms-auto">
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

                        {{-- Table Kurikulum Desktop View --}}
                        <table class="table d-none d-lg-table d-md-table desktop-table mt-4">
                            <tr class="tr-table">
                                <th width="5%">
                                    No
                                </th>
                                <th>Kurikulum</th>
                                {{-- <th>Tahun Ajar</th> --}}
                                <th width="25%"></th>
                            </tr>
                            @forelse ($kurikulum as $row)
                                <tr style="color: rgb(26, 26, 26);">
                                    <td>
                                        {{ $loop->iteration }}).
                                    </td>
                                    <td>
                                        <span class="fs-6">
                                            {{ $row->nama_kurikulum }}
                                        </span>
                                    </td>
                                    {{-- <td>
                                        <div class="badge-globe px-3 my-auto">
                                            <span class="fs-6">
                                                {{ $row->tahunAjar->tahun_ajar }}
                                            </span>
                                        </div>
                                    </td> --}}
                                    <td class="text-end">
                                        <a href="{{ route('kurikulum.mapel', $row->id) }}"
                                            class="btn btn-primary ps-3 pe-2 my-auto">
                                            Atur Mapel
                                            <i class="bi bi-chevron-right"></i>
                                        </a>
                                        <a href="javascript:void(0);" id="dropdownMenuButtonMobile"
                                            data-bs-toggle="dropdown" aria-expanded="false"
                                            class="dropdown-toggle text-decoration-none text-dark btn btn-default-2">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-tdesktop shadow"
                                            aria-labelledby="dropdownMenuButtonMobile">
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    onclick="editKurlum('{{ $row->id }}', '{{ $row->nama_kurikulum }}')">
                                                    <i class="me-1 bi bi-pencil-square"></i>
                                                    Ubah
                                                </a>
                                            </li>
                                            <li>
                                                <a onclick="delKurlum('{{ $row->id }}')" class="dropdown-item"
                                                    href="javascript:void(0);">
                                                    <i class="me-1 bi bi-trash3-fill"></i>
                                                    Hapus
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @empty
                                <p class="text-center my-5 d-none d-md-inline d-lg-inline">Belum ada data Kurikulum!</p>
                            @endforelse
                        </table>
                        {{-- End --}}

                        {{-- Table Kurikulum Mobile View --}}
                        @foreach ($kurikulum as $item)
                            <div class="card mb-2 p-2 d-lg-none d-md-none">
                                <div class="d-flex">
                                    <div class="d-inline">
                                        <div class="fs-nama">
                                            {{ $loop->iteration }}). &nbsp;{{ $item->nama_kurikulum }}
                                            <div class="badge-globe d-inline px-2 ms-2">
                                                {{-- {{ $item->tahunAjar->tahun_ajar }} --}}
                                            </div>
                                        </div> <br>
                                        <a href="{{ route('kurikulum.mapel', $row->id) }}"
                                            class="badge bg-primary ms-4 mt-2 my-auto text-decoration-none p-2"
                                            style="font-size: 12px;">
                                            Atur Mapel
                                            <i class="bi bi-chevron-right"></i>
                                        </a>
                                    </div>

                                    <a href="javascript:void(0);" id="dropdownMenuButtonMobile" data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                        class="dropdown-toggle text-decoration-none text-dark ms-auto">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-tdesktop kurlum shadow"
                                        aria-labelledby="dropdownMenuButtonMobile">
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);"
                                                onclick="editKurlum('{{ $row->id }}', '{{ $row->nama_kurikulum }}')">
                                                <i class="me-1 bi bi-pencil-square"></i>
                                                Ubah
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" onclick="delKurlum('{{ $row->id }}')"
                                                class="dropdown-item">
                                                <i class="me-1 bi bi-trash3-fill"></i>
                                                Hapus
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                        {{-- End --}}

                        {{-- Pagination --}}
                        {{ $kurikulum->links() }}
                        {{-- End --}}
                    </div>
                </div>
            </div>
        </div>


        <a href="javascript:void(0);" onclick="addKurlum()" class="btn btn-primary add-btn-siswa-mbl d-lg-none d-md-none">
            <i class="bi bi-plus-lg"></i>
        </a>
    </div>

    {{-- Modal Tambah Kurikulum --}}
    <div class="modal fade" id="AddKurlum" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="AddKurlumLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="AddKurlumLabel">Tambah Kurikulum</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('kurikulum.add') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <label class="mb-2" for="">Nama Kurikulum</label>
                        <input type="text" class="form-control mb-3" name="nama_kurikulum"
                            placeholder="Masukan Nama Kurikulum!" required>
                        {{-- <label class="mb-2" for="">Tahun Ajar</label>
                        <select name="tahun_ajar_id" class="form-select mb-3">
                            <option value="">-- Pilih tahun ajar --</option>
                            @foreach ($tahunAjar as $item)
                                <option value="{{ $item->id }}">{{ $item->tahun_ajar }}</option>
                            @endforeach
                        </select> --}}
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

    {{-- Modal Edit Kurikulum --}}
    <div class="modal fade" id="editKurlum" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editKurlumLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="editKurlumLabel">Ubah Kurikulum</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('kurikulum.edit') }}" method="post">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <input type="hidden" class="form-control form-borderless" id="kurlum-id-edit" name="kurlum_id">
                        <label class="mb-2" for="">Nama Kurikulum</label>
                        <input type="text" class="form-control mb-3" id="nama-kurlum" name="nama_kurikulum"
                            placeholder="Masukan Nama Kurikulum!" required>
                        {{-- <label class="mb-2" for="">Tahun Ajar</label>
                        <select name="tahun_ajar_id" class="form-select mb-3" id="tahun-ajar-id">
                            <option value="">-- Pilih tahun ajar --</option>
                            @foreach ($tahunAjar as $item)
                                <option value="{{ $item->id }}">{{ $item->tahun_ajar }}</option>
                            @endforeach
                        </select> --}}
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

    {{-- Modal Delete Kurikulum --}}
    <div class="modal fade" id="delKurlum" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="delKurlumLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="delKurlumLabel">Hapus Kurikulum</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('kurikulum.delete') }}" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <p id="keterangan-to-tahun_ajar" class="text-center">
                            Apakah anda yakin ingin menghapus Kurikulum ini?
                        </p>
                        <input type="hidden" id="kurlum-id-delete" name="kurlum_id">
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-default-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger" id="delBtnTahun_ajar">
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
        @error('tahun_ajar')
            let pesan = "{{ ucwords($message) }}"
            toastr.warning(pesan);
        @enderror
        // End

        // Modal tambah Kurikulum
        function addKurlum() {
            $('#AddKurlum').modal('show');
        }

        // Modal edit Kurikulum
        function editKurlum(id, namaKurlum) {
            $('#kurlum-id-edit').val(id);
            $('#nama-kurlum').val(namaKurlum);
            // $('#tahun-ajar-id').val(tahun_ajarId);
            $('#editKurlum').modal('show');
        }

        // Modal hapus Kurikulum
        function delKurlum(id) {
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

            $('#kurlum-id-delete').val(id);
            $('#delKurlum').modal('show');
        }
    </script>
@endpush
