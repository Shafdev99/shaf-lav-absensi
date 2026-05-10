<!-- Content -->
@extends('layout.app')
@section('title', 'Daftar Tahun Ajar')
@section('content')
    <div class="content content-sm">

        <div class="container">

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                Tahun Ajar
            </div>
            {{-- End --}}

            <div class="row mt-4">
                <div class="col-lg-9 col-md-9 col mx-auto">
                    <div class=" card p-lg-3 p-2 card-content">
                        {{-- Header Button --}}
                        <div class="d-flex mt-2 mb-3 mb-lg-0 ">
                            <a class="btn btn-primary d-none d-lg-block d-md-block" href="javascript:void(0);"
                                onclick="addTahunAjar()" aria-expanded="false">
                                <i class="bi bi-plus-lg"></i>
                                Tambah
                            </a>

                            {{-- Tombol Refresh --}}
                            <a href="{{ route('tahun.ajar') }}"
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

                        {{-- Alert --}}
                        @if ($errors->any())
                            <div class="alert alert-danger mt-3 mb-0 pb-0">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {{-- End --}}

                        {{-- Table Tahun Ajar Desktop View --}}
                        @if ($tahunAjar)
                            <table class="table d-none d-lg-table d-md-table desktop-table mt-4">
                                <tr class="tr-table">
                                    <th></th>
                                    <th>
                                        No
                                    </th>
                                    <th width="15%">Semester</th>
                                    <th>Kurikulum</th>
                                    <th>Status</th>
                                    {{-- <th width="25%">Keterangan</th> --}}
                                    <th></th>
                                </tr>
                                @foreach ($periode as $Periode)
                                    <tr style="background-color: #004bada9">
                                        <td colspan="5">
                                            <h6 class="pt-2 ps-3 text-white">
                                                Tahun Ajar Periode {{ $Periode->tahun_ajar }}
                                            </h6>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);"
                                                onclick="editTahunAjar('{{ $Periode->tahun_ajar }}')"
                                                class="text-decoration-none text-white">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="javascript:void(0);"
                                                onclick="deleteTahunAjar('{{ $Periode->tahun_ajar }}')"
                                                class="text-decoration-none text-white ms-1">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @foreach ($tahunAjar as $row)
                                        @if ($row->tahun_ajar === $Periode->tahun_ajar)
                                            <tr>
                                                <td></td>
                                                <td>
                                                    {{ $loop->iteration }}).
                                                </td>
                                                <td>
                                                    {{ $row->semester }}
                                                </td>
                                                <td>
                                                    <select name="ubah-kurikulum" data-id-tahun-ajar='{{ $row->id }}'
                                                        class="form-select form-select-sm" style="width: 250px;" required>
                                                        @foreach ($kurikulum as $Kurikulum)
                                                            <option
                                                                {{ $Kurikulum->nama_kurikulum == $row->kurikulum->nama_kurikulum ? 'selected' : '' }}
                                                                value="{{ $Kurikulum->id }}">
                                                                {{ $Kurikulum->nama_kurikulum }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <div
                                                        class="badge {{ $row->status == 1 ? 'badge-status-aktif' : 'badge-status-nonaktif' }}">
                                                        {{ $row->status == 1 ? 'Aktif' : 'Non Aktif' }}
                                                    </div>
                                                </td>
                                                {{-- <td>
                                                    <select name="semester" class="form-select form-select-sm" required>
                                                        <option value="">Belum dimulai</option>
                                                        <option value="">Sedang berlangsung</option>
                                                        <option value="">Sudah terlewati</option>
                                                    </select>
                                                </td> --}}
                                                <td>
                                                    <a href="{{ route('aktifasi.tahun.ajar', $row->id) }}"
                                                        class="{{ $row->status === 1 ? 'text-success' : 'text-danger' }} text-decoration-none">
                                                        <i
                                                            class="bi {{ $row->status === 1 ? 'bi-toggle-on' : 'bi-toggle-off' }} fs-6"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </table>
                        @else
                            <p class="text-center my-5 d-none d-md-inline d-lg-inline">Belum ada data tahun ajar!</p>
                        @endif
                        {{-- End --}}

                        {{-- Table Tahun Ajar Mobile View --}}
                        @if ($tahunAjar)
                            @foreach ($tahunAjar as $item)
                                <div class="card mb-2 p-2 d-lg-none d-md-none">
                                    <div class="d-flex">
                                        <div class="d-inline">
                                            <div class="fs-nama">{{ $loop->iteration }}). &nbsp;{{ $item->tahun_ajar }}
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
                                                    onclick="editTahunAjar('{{ $item->tahun_ajar }}','{{ $item->id }}')">
                                                    <i class="me-1 bi bi-pencil-square"></i>
                                                    Ubah
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    onclick="deleteTahunAjar('{{ $item->tahun_ajar }}','{{ $item->id }}')"
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
                            <p class="text-center my-3 d-lg-none d-md-none">Belum ada data tahun ajar!</p>
                        @endif
                        {{-- End --}}
                    </div>
                </div>
            </div>
        </div>


        <a href="javascript:void(0);" onclick="addTahunAjar()"
            class="btn btn-primary add-btn-siswa-mbl d-lg-none d-md-none">
            <i class="bi bi-plus-lg"></i>
        </a>
    </div>

    {{-- Modal Tambah Tahun Ajar --}}
    <div class="modal fade" id="AddTahunAjar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="AddTahunAjarLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="AddTahunAjarLabel">Tambah Tahun Ajar</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('tahun.ajar.add') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <label class="mb-2" for="tahun_ajar">Tahun Ajar</label>
                        <div class="d-flex">
                            <input type="hidden" class="form-control mb-4" name="tahun_ajar"
                                placeholder="contoh : {{ date('Y') }}" id="tahun-ajar-tambah" required>
                            <select name="tahun_1" class="form-control mb-4">
                                @php
                                    $tahunSekarang = date('Y');
                                    $tahunAwal = $tahunSekarang - 5; // 5 tahun lalu
                                    $tahunAkhir = $tahunSekarang + 5; // 5 tahun depan
                                @endphp
                                @foreach (range($tahunAkhir, $tahunAwal) as $thn)
                                    <option value="{{ $thn }}" {{ $thn == $tahunSekarang ? 'selected' : '' }}>
                                        {{ $thn }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="mt-2 mx-3">
                                /
                            </span>
                            <select name="tahun_2" class="form-control mb-4">
                                @php
                                    $tahunSekarang = date('Y') + 1;
                                    $tahunAwal = $tahunSekarang - 5; // 5 tahun lalu
                                    $tahunAkhir = $tahunSekarang + 5; // 5 tahun depan
                                @endphp
                                @foreach (range($tahunAkhir, $tahunAwal) as $thn)
                                    <option value="{{ $thn }}" {{ $thn == $tahunSekarang ? 'selected' : '' }}>
                                        {{ $thn }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <label class="mb-2" for="kurikulum">Kurikulum</label>
                        <select name="kurikulum_id" class="mb-4 form-select" required>
                            @foreach ($kurikulum as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_kurikulum }}</option>
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

    {{-- Modal Edit Tahun Ajar --}}
    <div class="modal fade" id="editTahuAjar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editTahuAjarLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="editTahuAjarLabel">Ubah Tahun Ajar</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('tahun.ajar.edit') }}" method="post">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <input type="hidden" class="form-control form-borderless" id="tahun-ajar-id-edit"
                            name="tahun_ajar_id">
                        <input type="text" class="form-control form-borderless" id="tahun-ajar-edit"
                            name="tahun_ajar">
                        <label class="mb-2" for="tahun_ajar">Tahun Ajar</label>
                        <div class="d-flex">
                            {{-- <input type="number" class="form-control mb-4" name="tahun_1"
                                placeholder="contoh : {{ date('Y') }}" id="tahun-1-edit" required> --}}
                            <select name="tahun_1" class="form-control mb-4" id="tahun-1-edit">
                                @php
                                    $tahunSekarang = date('Y');
                                    $tahunAwal = $tahunSekarang - 5; // 5 tahun lalu
                                    $tahunAkhir = $tahunSekarang + 5; // 5 tahun depan
                                @endphp
                                @foreach (range($tahunAkhir, $tahunAwal) as $thn)
                                    <option value="{{ $thn }}" {{ $thn }}>
                                        {{ $thn }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="mt-2 mx-3">
                                /
                            </span>
                            <select name="tahun_2" class="form-control mb-4" id="tahun-2-edit">
                                @php
                                    $tahunSekarang = date('Y');
                                    $tahunAwal = $tahunSekarang - 5; // 5 tahun lalu
                                    $tahunAkhir = $tahunSekarang + 5; // 5 tahun depan
                                @endphp
                                @foreach (range($tahunAkhir, $tahunAwal) as $thn)
                                    <option value="{{ $thn + 1 }}" {{ $thn++ }}>
                                        {{ $thn }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <label class="mb-2" for="kurikulum">Kurikulum</label>
                        <select name="kurikulum_id" class="mb-4 form-select" id="kurikulum-id-edit" required>
                            @foreach ($kurikulum as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_kurikulum }}</option>
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

    {{-- Modal Delete Tahun Ajar --}}
    <div class="modal fade" id="deleteTahunAjar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteTahunAjarLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h6 class="modal-title fw-bold" id="deleteTahunAjarLabel">Hapus Tahun AJar</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('tahun.ajar.delete') }}" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <p id="keterangan-to-tahun-ajar" class="text-center">
                            Apakah anda yakin ingin menghapus tahun ajar ini?
                        </p>
                        <input type="hidden" id="tahun-ajar-id-delete" name="tahun_ajar_id">
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

        @if (session('gagal'))
            let pesan = "{{ session('gagal') }}"
            toastr.warning(pesan)
        @endif

        // @if ($errors->any())
        //     let pesan = "{{ $errors->any() }}"
        //     toastr.warning(pesan)
        // @endif

        // Modal tambah tahun ajar
        function addTahunAjar() {
            $('#AddTahunAjar').modal('show');
        }

        $('select[name="tahun_1"]').change(function() {
            const thnAjr2 = $('select[name="tahun_2"]').val();
            buatTahunAjar(this.value, thnAjr2);
        });

        $('select[name="tahun_2"]').change(function() {
            const thnAjr1 = $('select[name="tahun_1"]').val();
            buatTahunAjar(thnAjr1, this.value);
        });

        function buatTahunAjar(thnAjr1, thnAjr2) {
            $('#tahun-ajar-tambah').val(thnAjr1 +
                '/' + thnAjr2);
        }

        // Modal edit tahun ajar
        async function editTahunAjar(tahunAjar) {
            const array = tahunAjar.split('/');
            const tahun_ajar = array[0] + '-' + array[1];
            const data = await fetch("{{ url('/get-tahun-ajar') }}/" + tahun_ajar)
                .then((response) => {
                    return response.json();
                });
            const arrTahunAjar = data.tahun_ajar.split("/");
            $('#tahun-ajar-edit').val(data.tahun_ajar);
            $('#tahun-1-edit').val(arrTahunAjar[0]);
            $('#tahun-2-edit').val(arrTahunAjar[1]);
            $('#kurikulum-id-edit').val(data.kurikulum_id);
            $('#tahun-ajar-id-edit').val(data.id);
            $('#editTahuAjar').modal('show');
        }

        // Modal hapus tahun ajar
        function deleteTahunAjar(tahunAjar) {
            const array = tahunAjar.split('/');
            const tahun_ajar = array[0] + '-' + array[1];

            // url
            const url = "{{ url('/getDataTahunAjar') }}/";

            $.getJSON(url + tahun_ajar,
                function(json) {
                    if (json.count != 0) {
                        $('#keterangan-to-tahun-ajar').text('Tahun ajar ini sudah digunakan!');
                        $('#delBtnTahunAjar').addClass('d-none');
                    } else {
                        $('#keterangan-to-tahun-ajar').text('Apakah anda yakin ingin menghapus tahun ajar ini?');
                        $('#delBtnTahunAjar').removeClass('d-none');
                    }
                    $('#deleteTahunAjar').modal('show');
                    $('#tahun-ajar-id-delete').val(json.id);
                }
            );
        }

        $('select[name="ubah-kurikulum"]').change(function(e) {
            e.preventDefault();
            const kurikulum_id = this.value;
            const tahun_ajar_id = this.getAttribute('data-id-tahun-ajar');
            window.location.href = `{{ url('/ubahKurikulumTajar') }}/` + kurikulum_id + '/' + tahun_ajar_id;
        });
    </script>
@endpush
