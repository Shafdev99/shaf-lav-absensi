<!-- Content -->
@extends('layout.app')
@section('title', 'Pengaturan SPMB')
@section('content')
    <div class="content content-sm">

        <div class="container">

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                Pengaturan SPMB
            </div>
            {{-- End --}}

            <div class="row mt-4">
                <div class="{{ $side == 'sosmed' ? 'col-lg-8 col-md-8' : 'col-lg col-md' }}  col mx-auto">

                    {{-- Navtabs data pengaturan-spmb --}}
                    <ul class="nav nav-tabs mt-2" id="myTab" role="tablist" style="margin-bottom: -4px;">
                        <li class="nav-item" role="presentation">
                            <a href="{{ route('spmb.pengaturan') }}"
                                class="nav-link {{ Request::is('pengaturan-spmb') ? 'active' : '' }}">
                                Umum
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="{{ route('spmb.pengaturan', 'syarat') }}"
                                class="nav-link {{ Request::is('pengaturan-spmb/syarat') ? 'active' : '' }}">
                                Syarat Pendaftaran
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="{{ route('spmb.pengaturan', 'alur') }}"
                                class="nav-link {{ Request::is('pengaturan-spmb/alur') ? 'active' : '' }}">
                                Alur Pendaftaran
                            </a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a href="{{ route('spmb.pengaturan', 'sosmed') }}"
                                class="nav-link {{ Request::is('pengaturan-spmb/sosmed') ? 'active' : '' }}">
                                Sosial Media
                            </a>
                        </li>
                    </ul>
                    {{-- End --}}

                    {{-- Content --}}
                    <div class="card p-lg-3 p-3 card-content shadow-sm">
                        @if ($side == 'alur')
                            <h5 class="fw-bold mt-3">
                                Tulis alur!
                            </h5>
                            <span class="mb-4 text-muted">
                                Silakan tulis alur pendaftaran spmb yang akan dilaksanakan!
                            </span>
                            <form action="{{ route('spmb.add.alur') }}" method="POST">
                                @csrf
                                <input type="hidden" name="alur_id" value="{{ $alur?->id }}">
                                <textarea id="summernote" name="alur">{!! $alur?->alur !!}</textarea>
                                <button class="btn btn-primary mt-3 float-end">
                                    <i class="bi bi-send-fill me-1"></i>
                                    Simpan
                                </button>
                                <button class="btn btn-default-2 float-end me-2 mt-3">Reset</button>
                            </form>
                        @elseif($side == 'sosmed')
                            <h5 class="fw-bold mt-3">
                                Sosial Media!
                            </h5>
                            <span class="mb-lg-4 mb-md-4 mb-1 text-muted">
                                Silakan atur link sosial media spmb yang akan dilaksanakan!
                            </span>

                            {{-- Header Button --}}
                            <div class="d-flex mt-2 mb-3 mb-lg-0 ">
                                {{-- Tambah Sosmed --}}
                                <a class="btn btn-primary d-none d-lg-block d-md-block" href="javascript:void(0);"
                                    onclick="addSosmed()" aria-expanded="false">
                                    <i class="bi bi-plus-lg"></i>
                                    Tambah
                                </a>

                                {{-- Tombol Refresh --}}
                                <a href="{{ route('pendidikan') }}"
                                    class="btn btn-default-2 d-none d-lg-block d-md-block ms-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-arrow-clockwise " viewBox="0 0 16 16">
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

                            {{-- Table Sosial Media Desktop View --}}
                            <table class="table d-none d-lg-table d-md-table desktop-table mt-4">
                                <tr class="tr-table">
                                    <th>
                                        No
                                    </th>
                                    <th>Nama Sosmed</th>
                                    <th>Link</th>
                                    <th></th>
                                </tr>
                                @forelse ($sosmed as $row)
                                    <tr style="color: rgb(26, 26, 26);">
                                        <td>
                                            {{ $loop->iteration }}).
                                        </td>
                                        <td>
                                            <div class="badge-globe px-3 my-auto">
                                                <span>
                                                    {{ $row->nama_sosmed }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $row->link_sosmed }}
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);"
                                                onclick="editSosmed('{{ $row->id }}','{{ $row->nama_sosmed }}','{{ $row->link_sosmed }}')"
                                                class="text-decoration-none">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="javascript:void(0);" onclick="deleteSosmed('{{ $row->id }}')"
                                                class="text-decoration-none text-danger ms-1">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            <p class="my-5 d-none d-md-inline d-lg-inline">
                                                Belum ada data sosial media!
                                            </p>
                                        </td>
                                    </tr>
                                @endforelse
                            </table>
                            {{-- End --}}

                            {{-- Table Sosial Media Mobile View --}}
                            @forelse ($sosmed as $item)
                                <div class="card mb-2 p-2 d-lg-none d-md-none">
                                    <div class="d-flex">
                                        <div class="d-inline">
                                            <div class="fs-nama">{{ $loop->iteration }}).
                                                &nbsp;{{ $item->nama_sosmed }}
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
                                                    onclick="editSosmed('{{ $row->id }}','{{ $row->nama_sosmed }}','{{ $row->link_sosmed }}')">
                                                    <i class="me-1 bi bi-pencil-square"></i>
                                                    Ubah
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" onclick="deleteSosmed('{{ $row->id }}')"
                                                    class="dropdown-item">
                                                    <i class="me-1 bi bi-trash3-fill"></i>
                                                    Hapus
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center my-3 d-lg-none d-md-none">Belum ada data pendidikan!</p>
                            @endforelse
                            {{-- End --}}
                        @elseif($side == 'syarat')
                            <h5 class="fw-bold mt-3">
                                Tulis syarat!
                            </h5>
                            <span class="mb-4 text-muted">
                                Silakan tulis syarat pendaftaran spmb yang akan dilaksanakan!
                            </span>
                            <form action="{{ route('spmb.add.syarat') }}" method="POST">
                                @csrf
                                <input type="hidden" name="syarat_id" value="{{ $syarat?->id }}">
                                <textarea id="summernote" name="syarat">{!! $syarat?->syarat !!}</textarea>
                                <button class="btn btn-primary mt-3 float-end">
                                    <i class="bi bi-send-fill me-1"></i>
                                    Simpan
                                </button>
                                <button class="btn btn-default-2 float-end me-2 mt-3">Reset</button>
                            </form>
                        @else
                            <h5 class="fw-bold mt-3">
                                Pengaturan Umum
                            </h5>
                            <span class="mb-4 text-muted">
                                Beberapa pengaturan untuk SPMB ada disini!
                            </span>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 col-lg-8 mx-auto">
                                        <form class="m-lg-4" action="{{ route('spmb.update.umum') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" name="umum_id" value="{{ $umum?->id }}">

                                            {{-- Tahun Ajar --}}
                                            <label class="fw-bold mb-2" for="">Tahun Ajar</label>
                                            <select name="tahun_ajar_id" id="tahun-ajar-id" class="form-select">
                                                @foreach ($tahun_ajar as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $umum?->tahun_ajar_id === $item->id ? 'selected' : '' }}>
                                                        {{ $item->tahun_ajar . ' ' . $item->semester . ' ' . $item->kurikulum->nama_kurikulum }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            {{-- Grup whatsapp --}}
                                            <label class="fw-bold mb-2 mt-4" for="">Grup Whatsapp</label>
                                            <textarea class="form-control" name="link_grup" required placeholder="Masukan link grup whatsapp disini!">{!! $umum?->link_grup !!}</textarea>

                                            {{-- Label Nomor Pendaftaran --}}
                                            <label class="fw-bold mb-2 mt-4" for="">
                                                Label Nomor Pendaftaran
                                            </label>
                                            <input class="form-control " name="label_antrian" required
                                                placeholder="Masukan label antrian disini!"
                                                value="{{ $umum?->label_antrian }}" {{ $antrian ? 'disabled' : '' }}>
                                            @if ($antrian)
                                                <input type="hidden" name="label_antrian"
                                                    value="{{ $umum?->label_antrian }}">
                                                <ul class="text-secondary mt-2" style="font-size: 12px;">
                                                    <li>Label ini sudah digunakan dalam pendaftaran!</li>
                                                    <li>Jika ingin diganti maka data pendftaran harus dimulai dari awal!
                                                    </li>
                                                </ul>
                                            @else
                                                <div class="text-secondary mt-2 ms-2" style="font-size: 12px;">
                                                    Label maksimal
                                                    6 karakter!
                                                </div>
                                            @endif

                                            {{-- Gambar Backgruond --}}
                                            <label class="fw-bold mb-2 mt-4" for="">
                                                Gambar Background
                                            </label>
                                            <div class="@error('gambar_background') dropify-invalid @enderror">
                                                <input type="file" name="gambar_background"
                                                    data-allowed-file-extensions="jpg png jpeg"
                                                    data-default-file="{{ $umum?->gambar_background ? asset('storage/' . $umum->gambar_background) : '' }}"
                                                    class="dropify" />
                                            </div>
                                            @error('gambar_background')
                                                <div id="validationServer03Feedback" class="text-danger mt-1">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                            <ul class="text-secondary mt-2" style="font-size: 12px;">
                                                <li>Format file yang di dukung (JPEG, JPG, PNG)</li>
                                                <li>Maksimum kapasitas file ( 1024 Kb / 1 Mb)</li>
                                                <li>Dimensi yang disarankan ( 479 x 709 Pixel)</li>
                                            </ul>

                                            <label for="brosur" class="form-label fw-bold mb-2 mt-4">
                                                Brosur Depan
                                            </label>
                                            <div class="@error('brosur_depan') dropify-invalid @enderror">
                                                <input type="file" name="brosur_depan"
                                                    data-allowed-file-extensions="jpg png jpeg"
                                                    data-default-file="{{ $umum?->brosur_depan ? asset('storage/' . $umum->brosur_depan) : '' }}"
                                                    class="dropify" />
                                            </div>
                                            @error('brosur_depan')
                                                <div id="validationServer03Feedback" class="text-danger mt-1">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                            <ul class="text-secondary mt-2" style="font-size: 12px;">
                                                <li>Format file yang di dukung (JPEG, JPG, PNG)</li>
                                                <li>Maksimum kapasitas file ( 1024 Kb / 1 Mb)</li>
                                                <li>Dimensi yang disarankan ( 479 x 709 Pixel)</li>
                                            </ul>

                                            <label for="brosur_belakang" class="form-label fw-bold mb-2 mt-4">
                                                Brosur Belakang
                                            </label>
                                            <div class="@error('brosur_belakang') dropify-invalid @enderror">
                                                <input type="file" id="brosur-belakang" name="brosur_belakang"
                                                    data-allowed-file-extensions="jpg png jpeg"
                                                    data-default-file="{{ $umum?->brosur_belakang ? asset('storage/' . $umum->brosur_belakang) : '' }}"
                                                    class="dropify" />
                                            </div>
                                            @error('brosur_belakang')
                                                <div id="validationServer03Feedback" class="text-danger mt-1">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                            <ul class="text-secondary mt-2" style="font-size: 12px;">
                                                <li>Format file yang di dukung (JPEG, JPG, PNG)</li>
                                                <li>Maksimum kapasitas file ( 1024 Kb / 1 Mb)</li>
                                                <li>Dimensi yang disarankan ( 479 x 709 Pixel)</li>
                                            </ul>

                                            <label for="logo_pendaftaran" class="form-label fw-bold mb-2 mt-4">
                                                Logo Bukti Pendaftaran
                                            </label>
                                            <div class="@error('logo_pendaftaran') dropify-invalid @enderror">
                                                <input type="file" id="logo-pendaftaran" name="logo_pendaftaran"
                                                    data-allowed-file-extensions="jpg png jpeg"
                                                    data-default-file="{{ $umum?->logo_pendaftaran ? asset('storage/' . $umum->logo_pendaftaran) : '' }}"
                                                    class="dropify" />
                                            </div>
                                            @error('logo_pendaftaran')
                                                <div id="validationServer03Feedback" class="text-danger mt-1">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                            <ul class="text-secondary mt-2" style="font-size: 12px;">
                                                <li>Format file yang di dukung (JPEG, JPG, PNG)</li>
                                                <li>Maksimum kapasitas file ( 1024 Kb / 1 Mb)</li>
                                                <li>Dimensi yang disarankan ( 479 x 709 Pixel)</li>
                                            </ul>

                                            <button class="btn btn-primary mt-5 float-end">
                                                <i class="bi bi-send-fill me-1"></i>
                                                Simpan
                                            </button>
                                            <button class="btn btn-default-2 float-end me-2 mt-5">Reset</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    {{-- End --}}

                </div>
            </div>

            <a href="javascript:void(0);" onclick="addSosmed()"
                class="btn btn-primary add-btn-siswa-mbl d-lg-none d-md-none">
                <i class="bi bi-plus-lg"></i>
            </a>

        </div>

        {{-- Modal Tambah Sosial Media --}}
        <div class="modal fade" id="AddSosialMedia" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="AddSosialMediaLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom">
                        <h6 class="modal-title fw-bold" id="AddSosialMediaLabel">Tambah Sosial Media</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('spmb.add.sosmed') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <label for="" class="mb-2">Nama Sosmed</label>
                            <input type="text" class="form-control mb-4" name="nama_sosmed"
                                placeholder="Masukan Nama Sosmed!" required>
                            <label for="" class="mb-2">Link Sosmed</label>
                            <input type="text" class="form-control mb-4" name="link_sosmed"
                                placeholder="Masukan Link Sosmed!" required>
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

        {{-- Modal Edit Sosial Media --}}
        <div class="modal fade" id="editSosialMedia" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="editSosialMediaLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom">
                        <h6 class="modal-title fw-bold" id="editSosialMediaLabel">Ubah Sosial Media</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('spmb.edit.sosmed') }}" method="post">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <input type="hidden" class="form-control" id="sosmed-id-edit" name="sosmed_id">
                            <label for="" class="mb-2">Nama Sosmed</label>
                            <input type="text" class="form-control mb-4" id="nama-sosmed" name="nama_sosmed"
                                placeholder="Masukan Nama Sosmed!" required>
                            <label for="" class="mb-2">Link Sosmed</label>
                            <input type="text" class="form-control mb-4" id="link-sosmed" name="link_sosmed"
                                placeholder="Masukan Link Sosmed!" required>
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

        {{-- Modal Delete Sosial Media --}}
        <div class="modal fade" id="deleteSosialMedia" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="deleteSosialMediaLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom">
                        <h6 class="modal-title fw-bold" id="deleteSosialMediaLabel">Hapus Sosial Media</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('spmb.delete.sosmed') }}" method="post">
                        @csrf
                        @method('delete')
                        <div class="modal-body">
                            <p id="keterangan-to-sosmed" class="text-center">
                                Apakah anda yakin ingin menghapus sosial media ini?
                            </p>
                            <input type="hidden" id="sosmed-id-delete" name="sosmed_id">
                        </div>
                        <div class="modal-footer border-top">
                            <button type="button" class="btn btn-default-2" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger" id="delBtnSosmed">
                                <i class="me-1 bi bi-trash3-fill"></i>
                                Hapus
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- End --}}

        {{-- Modal Delete Gambar --}}
        <div class="modal fade" id="deleteGambar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="deleteGambarLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom">
                        <h6 class="modal-title fw-bold" id="deleteGambarLabel">Hapus Gambar</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('spmb.hapus.gambar') }}" method="post">
                        @csrf
                        @method('delete')
                        <div class="modal-body">
                            <p id="keterangan-to-umum" class="text-center">
                                Apakah anda yakin ingin menghapus gambar ini?
                            </p>
                            <input type="hidden" value="{{ $umum?->id }}" name="umum_id">
                            <input type="hidden" id="file-gambar" name="gambar">
                            <input type="hidden" id="kolom" name="kolom">
                        </div>
                        <div class="modal-footer border-top">
                            <button type="button" class="btn btn-default-2" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger" id="delBtnUmum">
                                <i class="me-1 bi bi-trash3-fill"></i>
                                Hapus
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- End --}}
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

@endsection
@push('scripts')
    <script type="text/javascript">
        // Konfigurasi Dropify preview Image
        var drEvent = $('.dropify').dropify({
            messages: {
                default: 'Pilih gambar anda! <br> Format gambar yang diwajibkan <br> adalah .JPG, .JPEG, .PNG!',
                replace: 'Mau ganti gambar anda?',
                remove: 'Hapus',
                error: 'Ada kesalahan pada proses upload gambar!'
            }
        });

        // Hapus gambar
        drEvent.on('dropify.beforeClear', function(event, element) {
            const file = new URL(this.dataset.defaultFile);
            const gambar = file.pathname.substring(9);
            $('#file-gambar').val(gambar);
            $('#kolom').val(this.name);
            $('#deleteGambar').modal('show');
            return false;
        });

        // Notif untuk data yang berhasil diproses
        @if (session('sukses'))
            let pesan = "{{ session('sukses') }}"
            toastr.success(pesan)
        @endif

        // Notif untuk data yang tidak lolos validasi
        @error('brosur')
            let pesan = "{{ ucwords($message) }}"
            toastr.warning(pesan);
        @enderror
        // End

        // Modal tambah Sosial Media
        function addSosmed() {
            $('#AddSosialMedia').modal('show');
        }

        // Modal edit Sosial Media
        function editSosmed(id, namaSosmed, linkSosmed) {
            $('#sosmed-id-edit').val(id);
            $('#nama-sosmed').val(namaSosmed);
            $('#link-sosmed').val(linkSosmed);
            $('#editSosialMedia').modal('show');
        }

        // Modal hapus Sosial Media
        function deleteSosmed(id) {
            $('#sosmed-id-delete').val(id);
            $('#deleteSosialMedia').modal('show');
        }

        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'Silakan tulis disini!',
                tabsize: 2,
                height: 300,
                toolbar: [
                    ['font', ['bold', 'underline', 'italic', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                ]
            });
        });
    </script>
@endpush
