<!-- Content -->
@extends('layout.app')
@section('title', 'Kelola Mapel Kurikulum')
@section('content')
    <div class="content content-sm">

        <div class="container">

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                Daftar Mapel Kurikulum
            </div>
            {{-- End --}}

            <div class="row mt-4">
                <div class="col-lg-8 col-md-6 col mx-auto">
                    <div class=" card p-lg-3 p-2 card-content">
                        {{-- Header Button --}}
                        <div class="d-flex mt-2 mb-3 mb-lg-0 ">
                            <a class="btn btn-default-2" href="{{ route('kurikulum') }}" aria-expanded="false">
                                <i class="bi bi-chevron-left"></i>
                                Kembali
                            </a>

                            {{-- Tombol Refresh --}}
                            <a href="javascript:void(0);" onclick="addMapel()"
                                class="btn btn-primary d-none d-lg-block d-md-block ms-auto">
                                <i class="bi bi-plus-lg"></i>
                                <span class=" ms-1">
                                    Tambah Mapel
                                </span>
                            </a>
                        </div>
                        {{-- End --}}

                        <div class="alert alert-primary mt-0 mb-4 mt-lg-4 fs-6 fw-bold" role="alert">
                            Nama Kurikulum : &nbsp;
                            " {{ $kurikulum->nama_kurikulum }} "
                        </div>

                        {{-- Table Kelompok Mapel Desktop View --}}
                        <form action="{{ route('ubahUrutanMapel') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $kurikulum->id }}" name="kurlum_id">

                            <table class="table d-none d-lg-table d-md-table desktop-table mt-3">
                                <tr class="tr-table">
                                    <th>Kelompok Mapel</th>
                                    <th>Nama Mapel</th>
                                    <th></th>
                                </tr>
                                @forelse ($kelma as $row)
                                    <tr style="color: rgb(26, 26, 26);">
                                        <td colspan="2">
                                            <div class="badge-globe px-3 my-auto">
                                                <span class="fs-6">
                                                    {{ $row->kelompok_mapel }}
                                                </span>
                                            </div>
                                        </td>
                                        <td></td>
                                    </tr>
                                    @foreach ($kurMapel as $kra)
                                        @if ($row->id == $kra->kelompok_mapel_id)
                                            <tr>
                                                <td align="right">
                                                    <input type="hidden" value="{{ $kra->id }}"
                                                        name="kurikulum_mapel_id[]">
                                                    <input type="text" name="urutan_mapel[]"
                                                        class="form-control form-borderless" style="width: 45px;"
                                                        value="{{ $kra->urutan_mapel }}">
                                                </td>
                                                <td>
                                                    <h6>
                                                        {{ $kra->mapel }}
                                                    </h6>
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0);" onclick="delMapel('{{ $kra->id }}')"
                                                        class="text-decoration-none text-danger ms-1">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @empty
                                    <p class="text-center my-5 d-none d-md-inline d-lg-inline">Belum ada data Kelompok
                                        Mapel!</p>
                                @endforelse
                            </table>

                            <button class="btn btn-primary d-none d-lg-block float-end">
                                <i class="bi bi-send-fill me-1"></i>
                                Simpan
                            </button>
                        </form>
                        {{-- End --}}

                        {{-- Table Kurikulum Mobile View --}}
                        <form action="{{ route('ubahUrutanMapel') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $kurikulum->id }}" name="kurlum_id">

                            @forelse ($kelma as $row)
                                <div class="card mb-2 p-2 d-lg-none d-md-none">
                                    <div class="d-flex">
                                        <div class="d-inline">
                                            <div class="fw-bold">
                                                {{ $row->kelompok_mapel }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach ($kurMapel as $kra)
                                    @if ($row->id == $kra->kelompok_mapel_id)
                                        <div class="card mb-2 ms-5 p-2 d-lg-none d-md-none">
                                            <div class="d-flex">
                                                <div class="d-inline">
                                                    <div class="d-flex">
                                                        <input type="hidden" value="{{ $kra->id }}"
                                                            name="kurikulum_mapel_id[]">
                                                        <input type="text" class="form-control form-borderless me-3"
                                                            value="{{ $kra->urutan_mapel }}" name="urutan_mapel[]"
                                                            style="width: 20%;">
                                                        <span class="align-self-center">
                                                            {{ $kra->mapel }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <a href="javascript:void(0);" onclick="delMapel('{{ $kra->id }}')"
                                                    class="dropdown-toggle text-decoration-none text-danger ms-auto">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @empty
                                <p class="text-center my-3 d-lg-none d-md-none">Belum ada data Kelompok Mapel!</p>
                            @endforelse

                            <button class="btn btn-primary d-lg-none my-2 float-end">
                                <i class="bi bi-send-fill me-1"></i>
                                Simpan
                            </button>
                        </form>
                        {{-- End --}}

                        {{-- Pagination --}}
                        {{-- {{ $kurikulum->links() }} --}}
                        {{-- End --}}
                    </div>
                </div>
            </div>
        </div>

        <a href="javascript:void(0);" onclick="addMapel()" class="btn btn-primary add-btn-siswa-mbl d-lg-none d-md-none">
            <i class="bi bi-plus-lg"></i>
        </a>
    </div>

    {{-- Modal Tambah Mapel --}}
    <div class="modal fade" id="addMapel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addMapelLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="addMapelLabel">Tambah Mapel</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('kurikulum.mapel.add') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" value="{{ $kurikulum->id }}" name="kurlum_id">
                        <label class="mb-2" for="">Kelompok Mapel</label>
                        <select name="kelompok_mapel_id" class="form-select mb-3">
                            <option value="">-- Pilih Kelompok Mapel --</option>
                            @foreach ($kelma as $item)
                                <option value="{{ $item->id }}">{{ $item->kelompok_mapel }}</option>
                            @endforeach
                        </select>
                        <label class="mb-2" for="">Pilih Mapel</label>
                        <select name="mapel_id" class="form-select mb-3">
                            <option value="">-- Pilih Mapel --</option>
                            @foreach ($mapel as $item)
                                <option value="{{ $item->id }}">{{ $item->mapel }}</option>
                            @endforeach
                        </select>
                        <label class="mb-2" for="">Urutan Mapel</label>
                        <input type="text" class="form-control mb-3" name="urutan_mapel" placeholder="Contoh : 3"
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


    {{-- Modal Delete Mapel --}}
    <div class="modal fade" id="delMapel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="delMapelLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="delMapelLabel">Hapus Mapel</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('kurikulum.mapel.delete') }}" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <p id="keterangan-to-tahun-ajar" class="text-center">
                            Apakah anda yakin ingin menghapus mapel ini?
                        </p>
                        <input type="hidden" id="kurma-id-delete" name="kurikulum_mapel_id">
                        <input type="hidden" value="{{ $kurikulum->id }}" name="kurlum_id">

                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-default-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger" id="delBtnTahunAjar">
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

        // Modal tambah mapel
        function addMapel() {
            $('#addMapel').modal('show');
        }

        // Modal hapus mapel
        function delMapel(id) {
            $('#kurma-id-delete').val(id);
            $('#delMapel').modal('show');
        }
    </script>
@endpush
