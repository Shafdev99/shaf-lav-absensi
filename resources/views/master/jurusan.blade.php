<!-- Content -->
@extends('layout.app')
@section('title', ucwords(Auth::user()->role))
@section('content')
    <div class="content content-sm">

        <div class="container">

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                Data Jurusan
            </div>
            {{-- End --}}

            {{-- <h5>Data Jurusan</h5> --}}
            <div class="row mt-4">
                <div class="mx-auto col-12 col-lg-7 col-md-7">
                    <div class=" card p-lg-3 p-2 card-content">
                        {{-- Header Button --}}
                        <div class="d-flex mt-2 mb-3 mb-lg-0">
                            <a href="javascript:void(0);" onclick="addJurusan()"
                                class="btn btn-primary d-none d-lg-block d-md-block">
                                <i class="bi bi-plus-lg"></i>
                                Tambah
                            </a>

                            {{-- Search Button Desktop --}}
                            <form action="{{ route('jurusan') }}" method="get" class="ms-auto me-2">
                                <div class="d-none d-lg-flex justify-content-center">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm form-default"
                                            placeholder="Cari data.." aria-describedby="button-addon2" name="nama_jurusan"
                                            value="{{ request('nama_jurusan') }}">
                                        <button type="submit" class="btn btn-default-2" type="button" id="button-addon2">
                                            Cari
                                        </button>
                                    </div>
                                </div>
                            </form>
                            {{-- End --}}

                            {{-- Tombol Refresh --}}
                            <a href="{{ route('jurusan') }}" class="btn btn-default-2 d-none d-lg-block d-md-block">
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
                            {{-- End --}}

                            {{-- Search Button Mobile --}}
                            <form action="{{ route('jurusan') }}" method="get" class="ms-auto d-lg-none">
                                <div class="row mx-auto ">
                                    <div class="col d-flex">
                                        <div class="input-group mt-2 ">
                                            <input type="text"
                                                class="form-control form-control-sm form-default form-mobile"
                                                placeholder="Cari data.." aria-describedby="button-addon2"
                                                name="nama_jurusan" value="{{ request('nama_jurusan') }}"
                                                style="width: fit-content">
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
                                                <a class="dropdown-item" href="{{ route('jurusan') }}">
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
                                        </ul>
                                    </div>
                                </div>
                            </form>
                            {{-- End --}}

                        </div>
                        {{-- End --}}

                        {{-- Table jurusan Desktop View --}}
                        @if (request(['nama_jurusan']) && !$jurusan->items())
                            <p class="text-center my-5 d-none d-md-inline d-lg-inline">Data yang anda cari tidak ada!
                            @elseif (empty($jurusan->items()))
                            <p class="text-center my-5 d-none d-md-inline d-lg-inline">Belum ada data Jurusan!</p>
                        @else
                            <table class="table d-none d-lg-table d-md-table desktop-table mt-4">
                                <tr class="tr-table">
                                    <th>
                                        No
                                    </th>
                                    <th>Jurusan</th>
                                    <th>Keterangan</th>
                                    <th></th>
                                </tr>
                                @foreach ($jurusan as $item)
                                    <tr style="color: rgb(26, 26, 26);">
                                        <td>
                                            {{ $loop->iteration }}).
                                        </td>
                                        <td>
                                            <div class="jenkel-l my-auto">
                                                <span class="fs-6">
                                                    {{ $item->nama_jurusan }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $item->keterangan }}
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);"
                                                onclick="editJurusan('{{ $item->nama_jurusan }}', '{{ $item->keterangan }}', '{{ $item->id }}')"
                                                class="text-decoration-none">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="javascript:void(0);" onclick="deleteJurusan('{{ $item->id }}')"
                                                class="text-decoration-none text-danger ms-1">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif
                        {{-- End --}}

                        {{-- Table jurusan Mobile View --}}
                        @if (request(['nama_jurusan']) && !$jurusan->items())
                            <p class="text-center my-5 d-none d-md-inline d-lg-inline">Data yang anda cari tidak ada!
                            @elseif (!$jurusan->items())
                            <p class="text-center my-3 d-lg-none d-md-none">Belum ada data Jurusan!</p>
                        @else
                            @foreach ($jurusan as $item)
                                <div class="card mb-2 p-2 d-lg-none d-md-none">
                                    <div class="d-flex">
                                        <div class="d-inline">
                                            <div class="fs-nama">{{ $item->nama_jurusan }}</div><br>
                                            {{ $item->keterangan }}
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
                                                    onclick="editJurusan('{{ $item->nama_jurusan }}', '{{ $item->keterangan }}', '{{ $item->id }}')">
                                                    <i class="me-1 bi bi-pencil-square"></i>
                                                    Ubah
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    onclick="deleteJurusan('{{ $item->id }}')" class="dropdown-item">
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
                        {{ $jurusan->links() }}
                        {{-- End --}}
                    </div>
                </div>
            </div>

        </div>
        <a href="javascript:void(0);" onclick="addJurusan()"
            class="btn btn-primary add-btn-siswa-mbl d-lg-none d-md-none">
            <i class="bi bi-plus-lg"></i>
        </a>
    </div>

    {{-- Modal Tambah Jurusan --}}
    <div class="modal fade" id="AddJurusan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="AddJurusanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="AddJurusanLabel">Tambah Jurusan</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('jurusan.add') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="text" class="form-control form-borderless mb-4" name="nama_jurusan"
                            placeholder="Masukan Nama Jurusan!" required>
                        <input type="text" class="form-control form-borderless" name="keterangan"
                            placeholder="Masukan Keterangan Jurusan!" required>
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

    {{-- Modal Edit Jurusan --}}
    <div class="modal fade" id="editJurusan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editJurusanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="editJurusanLabel">Ubah Jurusan</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('jurusan.edit') }}" method="post">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <input type="hidden" class="form-control form-borderless" id="jurusan-id" name="jurusan_id">
                        <input type="text" class="form-control form-borderless mb-4" id="nama-jurusan"
                            name="nama_jurusan" placeholder="Masukan Nama Jurusan!" required>
                        <input type="text" class="form-control form-borderless" id="keterangan-jurusan"
                            name="keterangan_jurusan" placeholder="Masukan Keterangan Jurusan!" required>
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

    {{-- Modal Delete Jurusan --}}
    <div class="modal fade" id="deleteJurusan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteJurusanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="deleteJurusanLabel">Hapus Jurusan</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('jurusan.delete') }}" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <p id="keterangan-to-jurusan" class="text-center"></p>
                        <input type="hidden" id="jurusan-id-delete" name="jurusan_id">
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-default-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger d-none" id="delBtnJurusan">
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

        // Notif untuk data yang gagal dalam validasi
        @error('nama_jurusan')
            let pesan = "{{ ucwords($message) }}";
            toastr.warning(pesan);
        @enderror

        @error('keterangan')
            let pesan = "{{ ucwords($message) }}";
            toastr.warning(pesan);
        @enderror
        // End

        // Modal tambah jurusan
        function addJurusan() {
            $('#AddJurusan').modal('show');
        }

        // Modal edit jurusan
        function editJurusan(nama, keterangan, id) {
            $('#jurusan-id').val(id);
            $('#nama-jurusan').val(nama);
            $('#keterangan-jurusan').val(keterangan);
            $('#editJurusan').modal('show');
        }

        // Modal hapus jurusan
        function deleteJurusan(id) {
            // url
            const url = "{{ url('/getSiswaDalamJurusan') }}/";

            $.getJSON(url + id,
                function(json) {
                    if (json != 0) {
                        $('#keterangan-to-jurusan').text('Jurusan ini sudah digunakan!');
                        $('#delBtnJurusan').addClass('d-none');
                    } else {
                        $('#keterangan-to-jurusan').text('Apakah anda yakin ingin menghapus jurusan ini?');
                        $('#delBtnJurusan').removeClass('d-none');
                        $('#jurusan-id-delete').val(id);
                    }
                    $('#deleteJurusan').modal('show');
                }
            );
        }
    </script>
@endpush
