<!-- Content -->
@extends('layout.app')
@section('title', 'Rekap Beasiswa Siswa')
@section('content')

    @php
        $parse = parse_url(url()->full());
        $url = isset($parse['query']) ? $parse['query'] : false;
        $menu = request()->segment(1);
    @endphp

    <div class="content content-sm">

        <div class="container">

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                Kelengkapan Data
            </div>
            {{-- End --}}

            {{-- <h5>Data Siswa</h5> --}}
            <div class="row mt-4">
                <div class="col-lg-9 mx-auto">
                    <div class="card p-lg-3 py-3 px-0 card-content">
                        {{-- Header Button --}}
                        <div class="d-flex mt-2 mb-3 px-2 justify-content-between">

                            <a href="{{ $menu == 'alumni' ? route('alumni', $url) : route('rekap', $url) }}"
                                class="btn btn-primary ms-2">
                                <i class="bi bi-arrow-left"></i>
                                Kembali
                            </a>

                            <span class="me-3 align-self-center">
                                Beasiswa siswa
                            </span>

                        </div>

                        <div class="mt-2 mb-3">
                            @include('binduk.rekap.navtabs')
                        </div>
                        {{-- End --}}

                        {{-- Add Button --}}
                        <div class="d-flex mt-4 mb-3 px-2 justify-content-between">

                            <span class="align-self-center">
                                Daftar Beasiswa Siswa
                            </span>

                            <a href="javascript:void(0);" onclick="addBeasiswa()" class="btn btn-primary ms-2">
                                <i class="bi bi-plus"></i>
                                Tambah
                            </a>

                        </div>
                        {{-- End --}}

                        {{-- Table beasiswa Desktop View --}}
                        <table class="table d-none d-lg-table d-md-table desktop-table mt-4">

                            <tr class="tr-table">
                                <th>No</th>
                                <th>Nama beasiswa</th>
                                <th>Tahun beasiswa</th>
                                <th>Pemberi beasiswa</th>
                                <th>Nominal beasiswa</th>
                                <th>Lampiran beasiswa</th>
                                <th></th>
                            </tr>
                            @forelse ($beasiswa as $item)
                                <tr style="color: rgb(26, 26, 26);">
                                    <td>
                                        {{ $loop->iteration }}).
                                    </td>
                                    <td>
                                        <div class="fw-bold">
                                            {{ $item->nama_beasiswa }}
                                        </div>
                                    </td>
                                    <td>
                                        {{ $item->tahun_beasiswa }}
                                    </td>
                                    <td>
                                        {{ $item->pemberi_beasiswa }}
                                    </td>
                                    <td>
                                        {{ $item->nominal_beasiswa }}
                                    </td>
                                    <td align="center">
                                        <a href="javascript:void(0);"
                                            onclick="viewLampiran('{{ $item->lampiran_beasiswa }}')">
                                            <img width="30" class="rounded img"
                                                src="{{ $item?->lampiran_beasiswa ? asset('storage/' . $item->lampiran_beasiswa) : '' }}">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" id="dropdownMenuButtonMobile"
                                            data-bs-toggle="dropdown" aria-expanded="false"
                                            class="dropdown-toggle text-decoration-none text-dark">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-tdesktop shadow"
                                            aria-labelledby="dropdownMenuButtonMobile">
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    onclick="editBeasiswa('{{ $item->id }}')">
                                                    <i class="me-1 bi bi-pencil-square"></i>
                                                    Ubah
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    onclick="deleteBeasiswa('{{ $item->id }}')">
                                                    <i class="me-1 bi bi-trash3-fill"></i>
                                                    Hapus
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-3">
                                        Belum ada riwayat beasiswa!
                                    </td>
                                </tr>
                            @endforelse
                        </table>
                        {{-- End --}}

                    </div>
                </div>

            </div>
        </div>

        {{-- Modal View Lampiran beasiswa --}}
        <div class="modal fade" id="viewLampiranBeasiswa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="viewLampiranBeasiswaLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom">
                        <h6 class="modal-title fw-bold" id="viewLampiranBeasiswaLabel">View Lampiran Beasiswa</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="lampiran-view"></div>
                    </div>
                    <div class="modal-footer border-top">
                        <button type="reset" class="btn btn-default-2" data-bs-dismiss="modal">Keluar</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- End --}}

        {{-- Modal Tambah beasiswa --}}
        <div class="modal fade" id="addBeasiswa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="addBeasiswaLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom">
                        <h6 class="modal-title fw-bold" id="addBeasiswaLabel">Tambah Beasiswa</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('rekap.form.beasiswa.create', $siswa->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">

                            <input type="hidden" value="{{ $menu }}" name="menu">
                            <input type="hidden" value="{{ request()->input('kelas') }}" name="kelas">
                            <input type="hidden" value="{{ request()->input('nama_siswa') }}" name="nama_siswa">
                            <input type="hidden" value="{{ $siswa->id }}" name="siswa_id">

                            {{-- Nama beasiswa --}}
                            <label for="nama_beasiswa" class="mb-2">
                                Nama Beasiswa
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('nama_beasiswa') is-invalid @enderror"
                                name="nama_beasiswa" id="nama_beasiswa" placeholder="Masukan nama beasiswa!" required>
                            @error('nama_beasiswa')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ ucwords($message) }}
                                </div>
                            @enderror

                            {{-- Tahun beasiswa --}}
                            <label for="tahun_beasiswa" class="mb-2 mt-4">
                                Tahun beasiswa
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('tahun_beasiswa') is-invalid @enderror"
                                name="tahun_beasiswa" id="tahun_beasiswa" placeholder="Masukan tahun beasiswa" required>
                            @error('tahun_beasiswa')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ ucwords($message) }}
                                </div>
                            @enderror

                            {{-- Pemberi beasiswa --}}
                            <label for="pemberi_beasiswa" class="mb-2 mt-4">
                                Pemberi beasiswa
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="pemberi_beasiswa"
                                class="form-control @error('pemberi_beasiswa') is-invalid @enderror" id="pemberi_beasiswa"
                                placeholder="Masukan pemberi beasiswa!"></input>
                            @error('pemberi_beasiswa')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ ucwords($message) }}
                                </div>
                            @enderror

                            {{-- Nominal beasiswa --}}
                            <label for="nominal_beasiswa" class="mb-2 mt-4">
                                Nominal beasiswa
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="nominal_beasiswa"
                                class="form-control @error('nominal_beasiswa') is-invalid @enderror" id="nominal_beasiswa"
                                placeholder="Masukan nominal beasiswa!"></input>
                            @error('nominal_beasiswa')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ ucwords($message) }}
                                </div>
                            @enderror

                            {{-- Lampiran beasiswa --}}
                            <label for="lampiran_beasiswa" class="form-label mb-2 mt-4">
                                Lampiran beasiswa
                                <span class="text-danger">*</span>
                            </label>
                            <div class="@error('lampiran_beasiswa') dropify-invalid @enderror">
                                <input type="file" name="lampiran_beasiswa"
                                    data-allowed-file-extensions="jpg png jpeg" class="dropify" />
                            </div>
                            @error('lampiran_beasiswa')
                                <div id="validationServer03Feedback" class="text-danger mt-1">
                                    {{ ucwords($message) }}
                                </div>
                            @enderror
                            <ul class="text-secondary mt-2" style="font-size: 12px;">
                                <li>Format file yang di dukung (JPEG, JPG, PNG)</li>
                                <li>Maksimum kapasitas file ( 1024 Kb / 1 Mb)</li>
                                <li>Dimensi yang disarankan ( 479 x 709 Pixel)</li>
                            </ul>

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

        {{-- Modal Ubah beasiswa --}}
        <div class="modal fade" id="editBeasiswa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="editBeasiswaLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom">
                        <h6 class="modal-title fw-bold" id="editBeasiswaLabel">Ubah Beasiswa</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('rekap.form.beasiswa.update', $siswa->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="modal-body">

                            <input type="hidden" value="{{ $menu }}" name="menu">
                            <input type="hidden" value="{{ request()->input('kelas') }}" name="kelas">
                            <input type="hidden" value="{{ request()->input('nama_siswa') }}" name="nama_siswa">
                            <input type="hidden" value="{{ $siswa->id }}" name="siswa_id">
                            <input type="hidden" id="beasiswa-id-edit" name="beasiswa_id">

                            {{-- Nama beasiswa --}}
                            <label for="nama_beasiswa" class="mb-2">
                                Nama Beasiswa
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('nama_beasiswa') is-invalid @enderror"
                                name="nama_beasiswa" id="nama-beasiswa-edit" placeholder="Masukan nama beasiswa!"
                                required>
                            @error('nama_beasiswa')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ ucwords($message) }}
                                </div>
                            @enderror

                            {{-- Tahun beasiswa --}}
                            <label for="tahun_beasiswa" class="mb-2 mt-4">
                                Tahun beasiswa
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('tahun_beasiswa') is-invalid @enderror"
                                name="tahun_beasiswa" id="tahun-beasiswa-edit" placeholder="Masukan tahun beasiswa"
                                required>
                            @error('tahun_beasiswa')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ ucwords($message) }}
                                </div>
                            @enderror

                            {{-- Pemberi beasiswa --}}
                            <label for="pemberi_beasiswa" class="mb-2 mt-4">
                                Pemberi beasiswa
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="pemberi_beasiswa"
                                class="form-control @error('pemberi_beasiswa') is-invalid @enderror"
                                id="pemberi-beasiswa-edit" placeholder="Masukan pemberi beasiswa!"></input>
                            @error('pemberi_beasiswa')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ ucwords($message) }}
                                </div>
                            @enderror

                            {{-- Nominal beasiswa --}}
                            <label for="nominal_beasiswa" class="mb-2 mt-4">
                                Nominal beasiswa
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="nominal_beasiswa"
                                class="form-control @error('nominal_beasiswa') is-invalid @enderror"
                                id="nominal-beasiswa-edit" placeholder="Masukan nominal beasiswa!"></input>
                            @error('nominal_beasiswa')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ ucwords($message) }}
                                </div>
                            @enderror

                            {{-- Lampiran beasiswa --}}
                            <label for="lampiran_beasiswa" class="form-label mb-2 mt-4">
                                Lampiran beasiswa
                                <span class="text-danger">*</span>
                            </label>
                            <div id="lampiran-set">
                            </div>
                            @error('lampiran_beasiswa')
                                <div id="validationServer03Feedback" class="text-danger mt-1">
                                    {{ ucwords($message) }}
                                </div>
                            @enderror
                            <ul class="text-secondary mt-2" style="font-size: 12px;">
                                <li>Format file yang di dukung (JPEG, JPG, PNG)</li>
                                <li>Maksimum kapasitas file ( 1024 Kb / 1 Mb)</li>
                                <li>Dimensi yang disarankan ( 479 x 709 Pixel)</li>
                            </ul>

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

        {{-- Modal Delete beasiswa --}}
        <div class="modal fade" id="deleteBeasiswa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="deleteBeasiswaLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom">
                        <h6 class="modal-title fw-bold" id="deleteBeasiswaLabel">Hapus Beasiswa</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('rekap.form.beasiswa.delete', $siswa->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <div class="modal-body">

                            <input type="hidden" value="{{ $menu }}" name="menu">
                            <input type="hidden" value="{{ request()->input('kelas') }}" name="kelas">
                            <input type="hidden" value="{{ request()->input('nama_siswa') }}" name="nama_siswa">

                            <p id="keterangan-to-beasiswa" class="text-center">
                                Apakah anda yakin ingin menghapus beasiswa ini?
                            </p>
                            <input type="hidden" id="beasiswa-id-delete" name="beasiswa_id">
                        </div>
                        <div class="modal-footer border-top">
                            <button type="button" class="btn btn-default-2" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger" id="delBtnbeasiswa">
                                <i class="me-1 bi bi-trash3-fill"></i>
                                Hapus
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- End --}}

        {{-- Loading screen --}}
        <div class="loading-screen d-none">
            <span class="loader"></span>
        </div>
        {{-- End --}}


    @endsection
    @push('scripts')
        <script type="text/javascript">
            // Konfigurasi Dropify preview Image
            $('.dropify').dropify({
                messages: {
                    default: 'Pilih gambar anda! <br> Format gambar yang diwajibkan <br> adalah .JPG, .JPEG, .PNG!',
                    replace: 'Mau ganti gambar anda?',
                    remove: 'Hapus',
                    error: 'Ada kesalahan pada proses upload gambar!'
                }
            });

            // Notif untuk data yang berhasil diproses
            @if (session('sukses'))
                let pesan = "{{ session('sukses') }}"
                toastr.success(pesan)
            @endif

            function viewLampiran(file) {
                $('.loading-screen').removeClass('d-none');
                const asset = file ? `{{ asset('storage/') }}/${file}` : '';
                const html = `<img src="${asset}" class="img-thumbnail rounded" alt="">`;

                $('#lampiran-view').html(html);

                $('.loading-screen').addClass('d-none');

                $('#viewLampiranBeasiswa').modal('show');
            }

            function addBeasiswa() {
                $('#addBeasiswa').modal('show');
            }

            function editBeasiswa(id) {
                $('.loading-screen').removeClass('d-none');
                fetch("{{ url('/getBeasiswa') }}/" + id)
                    .then((response) => {
                        return response.json();
                    })
                    .then((data) => {
                        $('#beasiswa-id-edit').val(data.id);
                        $('#nama-beasiswa-edit').val(data.nama_beasiswa);
                        $('#tahun-beasiswa-edit').val(data.tahun_beasiswa);
                        $('#pemberi-beasiswa-edit').val(data.pemberi_beasiswa);
                        $('#nominal-beasiswa-edit').val(data.nominal_beasiswa);

                        // Upload image
                        const asset = data.lampiran_beasiswa ? `{{ asset('storage/') }}/${data.lampiran_beasiswa}` : '';
                        const html = `<div class="@error('lampiran_beasiswa') dropify-invalid @enderror">
                                <input type="file" name="lampiran_beasiswa" id="lampiran-beasiswa-edit"
                                    data-allowed-file-extensions="jpg png jpeg" class="dropify" data-default-file="${asset}"/>
                            </div>`;

                        $('#lampiran-set').html(html);

                        $('.dropify').dropify({
                            messages: {
                                default: 'Pilih gambar anda! <br> Format gambar yang diwajibkan <br> adalah .JPG, .JPEG, .PNG!',
                                replace: 'Mau ganti gambar anda?',
                                remove: 'Hapus',
                                error: 'Ada kesalahan pada proses upload gambar!'
                            }
                        });

                        $('.loading-screen').addClass('d-none');

                        $('#editBeasiswa').modal('show');
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            }

            function deleteBeasiswa(id) {
                $('#beasiswa-id-delete').val(id);
                $('#deleteBeasiswa').modal('show');
            }
        </script>
    @endpush
