<!-- Content -->
@extends('layout.app')
@section('title', 'Rekap Prestasi Siswa')
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
                                Prestasi siswa
                            </span>

                        </div>

                        <div class="mt-2 mb-3">
                            @include('binduk.rekap.navtabs')
                        </div>
                        {{-- End --}}

                        {{-- Add Button --}}
                        <div class="d-flex mt-4 mb-3 px-2 justify-content-between">

                            <span class="align-self-center">
                                Daftar Prestasi Siswa
                            </span>

                            <a href="javascript:void(0);" onclick="addPrestasi()" class="btn btn-primary ms-2">
                                <i class="bi bi-plus"></i>
                                Tambah
                            </a>

                        </div>
                        {{-- End --}}

                        {{-- Table prestasi Desktop View --}}
                        <table class="table d-none d-lg-table d-md-table desktop-table mt-4">

                            <tr class="tr-table">
                                <th>No</th>
                                <th>Nama prestasi</th>
                                <th>Tahun</th>
                                <th>Penyelenggara</th>
                                <th>Tempat</th>
                                <th>Piagam</th>
                                <th></th>
                            </tr>
                            @forelse ($prestasi as $item)
                                <tr style="color: rgb(26, 26, 26);">
                                    <td>
                                        {{ $loop->iteration }}).
                                    </td>
                                    <td>
                                        <div class="fw-bold">
                                            {{ $item->nama_prestasi }}
                                        </div>
                                    </td>
                                    <td>
                                        {{ $item->tahun_prestasi }}
                                    </td>
                                    <td>
                                        {{ $item->penyelenggara_prestasi }}
                                    </td>
                                    <td>
                                        {{ $item->tempat_prestasi }}
                                    </td>
                                    <td align="center">
                                        <a href="javascript:void(0);" onclick="viewPiagam('{{ $item->piagam_prestasi }}')">
                                            <img width="30" class="rounded img"
                                                src="{{ $item?->piagam_prestasi ? asset('storage/' . $item->piagam_prestasi) : '' }}">
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
                                                    onclick="editPrestasi('{{ $item->id }}')">
                                                    <i class="me-1 bi bi-pencil-square"></i>
                                                    Ubah
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    onclick="deletePrestasi('{{ $item->id }}')">
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
                                        Belum ada riwayat prestasi!
                                    </td>
                                </tr>
                            @endforelse
                        </table>
                        {{-- End --}}

                    </div>
                </div>

            </div>
        </div>

        {{-- Modal View piagam prestasi --}}
        <div class="modal fade" id="viewPiagamPrestasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="viewPiagamPrestasiLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom">
                        <h6 class="modal-title fw-bold" id="viewPiagamPrestasiLabel">View Piagam Prestasi</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="piagam-view"></div>
                    </div>
                    <div class="modal-footer border-top">
                        <button type="reset" class="btn btn-default-2" data-bs-dismiss="modal">Keluar</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- End --}}

        {{-- Modal Tambah prestasi --}}
        <div class="modal fade" id="addPrestasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="addPrestasiLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom">
                        <h6 class="modal-title fw-bold" id="addPrestasiLabel">Tambah Prestasi</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('rekap.form.prestasi.create', $siswa->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">

                            <input type="hidden" value="{{ $menu }}" name="menu">
                            <input type="hidden" value="{{ request()->input('kelas') }}" name="kelas">
                            <input type="hidden" value="{{ request()->input('nama_siswa') }}" name="nama_siswa">
                            <input type="hidden" value="{{ $siswa->id }}" name="siswa_id">

                            {{-- Nama prestasi --}}
                            <label for="nama_prestasi" class="mb-2">
                                Nama prestasi
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('nama_prestasi') is-invalid @enderror"
                                name="nama_prestasi" id="nama_prestasi" placeholder="Masukan nama prestasi!" required>
                            @error('nama_prestasi')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ ucwords($message) }}
                                </div>
                            @enderror

                            {{-- Tahun Diselenggarakan --}}
                            <label for="tahun_prestasi" class="mb-2 mt-4">
                                Tahun diselanggarakan
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('tahun_prestasi') is-invalid @enderror"
                                name="tahun_prestasi" id="tahun_prestasi" placeholder="Masukan tahun diselenggarakan!"
                                required>
                            @error('tahun_prestasi')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ ucwords($message) }}
                                </div>
                            @enderror

                            {{-- Penyelenggar --}}
                            <label for="penyelenggara_prestasi" class="mb-2 mt-4">
                                Penyelenggara
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="penyelenggara_prestasi"
                                class="form-control @error('penyelenggara_prestasi') is-invalid @enderror"
                                id="penyelenggara_prestasi" placeholder="Masukan penyelenggara!"></input>
                            @error('penyelenggara_prestasi')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ ucwords($message) }}
                                </div>
                            @enderror

                            {{-- Tempat Diselanggarakan --}}
                            <label for="tempat_prestasi" class="mb-2 mt-4">
                                Tempat diselanggarakan
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="tempat_prestasi"
                                class="form-control @error('tempat_prestasi') is-invalid @enderror" id="tempat_prestasi"
                                placeholder="Masukan tempat diselenggarakan!"></input>
                            @error('tempat_prestasi')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ ucwords($message) }}
                                </div>
                            @enderror

                            {{-- Piagam prestasi --}}
                            <label for="piagam_prestasi" class="form-label mb-2 mt-4">
                                Piagam prestasi
                                <span class="text-danger">*</span>
                            </label>
                            <div class="@error('piagam_prestasi') dropify-invalid @enderror">
                                <input type="file" name="piagam_prestasi" data-allowed-file-extensions="jpg png jpeg"
                                    class="dropify" />
                            </div>
                            @error('piagam_prestasi')
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

        {{-- Modal Ubah prestasi --}}
        <div class="modal fade" id="editPrestasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="editPrestasiLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom">
                        <h6 class="modal-title fw-bold" id="editPrestasiLabel">Ubah Prestasi</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('rekap.form.prestasi.update', $siswa->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="modal-body">

                            <input type="hidden" value="{{ $menu }}" name="menu">
                            <input type="hidden" value="{{ request()->input('kelas') }}" name="kelas">
                            <input type="hidden" value="{{ request()->input('nama_siswa') }}" name="nama_siswa">
                            <input type="hidden" value="{{ $siswa->id }}" name="siswa_id">
                            <input type="hidden" id="prestasi-id-edit" name="prestasi_id">

                            {{-- Nama prestasi --}}
                            <label for="nama_prestasi" class="mb-2">
                                Nama prestasi
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('nama_prestasi') is-invalid @enderror"
                                name="nama_prestasi" id="nama-prestasi-edit" placeholder="Masukan nama prestasi!"
                                required>
                            @error('nama_prestasi')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ ucwords($message) }}
                                </div>
                            @enderror

                            {{-- Tahun diselenggarakan --}}
                            <label for="tahun_diselenggarakan" class="mb-2 mt-4">
                                Tahun diselenggarakan
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('tahun_prestasi') is-invalid @enderror"
                                name="tahun_prestasi" id="tahun-prestasi-edit" placeholder="Masukan tahun prestasi"
                                required>
                            @error('tahun_prestasi')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ ucwords($message) }}
                                </div>
                            @enderror

                            {{-- Penyelenggara prestasi --}}
                            <label for="penyelenggara_prestasi" class="mb-2 mt-4">
                                Penyelenggara prestasi
                            </label>
                            <input type="text" name="penyelenggara_prestasi"
                                class="form-control @error('penyelenggara_prestasi') is-invalid @enderror"
                                id="penyelenggara-prestasi-edit" placeholder="Masukan penyelenggara prestasi!"></input>
                            @error('penyelenggara_prestasi')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ ucwords($message) }}
                                </div>
                            @enderror

                            {{-- Tempat prestasi --}}
                            <label for="tempat_prestasi" class="mb-2 mt-4">
                                Tempat prestasi
                            </label>
                            <input type="text" name="tempat_prestasi"
                                class="form-control @error('tempat_prestasi') is-invalid @enderror"
                                id="tempat-prestasi-edit" placeholder="Masukan tempat prestasi!"></input>
                            @error('tempat_prestasi')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ ucwords($message) }}
                                </div>
                            @enderror

                            {{-- Piagam prestasi --}}
                            <label for="piagam_prestasi" class="form-label mb-2 mt-4">
                                Piagam prestasi
                            </label>
                            <div id="piagam-set">
                            </div>
                            @error('piagam_prestasi')
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

        {{-- Modal Delete prestasi --}}
        <div class="modal fade" id="deletePrestasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="deletePrestasiLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom">
                        <h6 class="modal-title fw-bold" id="deletePrestasiLabel">Hapus Prestasi</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('rekap.form.prestasi.delete', $siswa->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <div class="modal-body">

                            <input type="hidden" value="{{ $menu }}" name="menu">
                            <input type="hidden" value="{{ request()->input('kelas') }}" name="kelas">
                            <input type="hidden" value="{{ request()->input('nama_siswa') }}" name="nama_siswa">

                            <p id="keterangan-to-prestasi" class="text-center">
                                Apakah anda yakin ingin menghapus prestasi ini?
                            </p>
                            <input type="hidden" id="prestasi-id-delete" name="prestasi_id">
                        </div>
                        <div class="modal-footer border-top">
                            <button type="button" class="btn btn-default-2" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger" id="delBtnprestasi">
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

            function viewPiagam(file) {
                $('.loading-screen').removeClass('d-none');
                const asset = file ? `{{ asset('storage/') }}/${file}` : '';
                const html = `<img src="${asset}" class="img-thumbnail rounded" alt="">`;

                $('#piagam-view').html(html);

                $('.loading-screen').addClass('d-none');

                $('#viewPiagamPrestasi').modal('show');
            }

            function addPrestasi() {
                $('#addPrestasi').modal('show');
            }

            function editPrestasi(id) {
                $('.loading-screen').removeClass('d-none');

                fetch("{{ url('/getPrestasi') }}/" + id)
                    .then((response) => {
                        return response.json();
                    })
                    .then((data) => {
                        $('#prestasi-id-edit').val(data.id);
                        $('#nama-prestasi-edit').val(data.nama_prestasi);
                        $('#tahun-prestasi-edit').val(data.tahun_prestasi);
                        $('#penyelenggara-prestasi-edit').val(data.penyelenggara_prestasi);
                        $('#tempat-prestasi-edit').val(data.tempat_prestasi);

                        // Upload image
                        const asset = data.piagam_prestasi ? `{{ asset('storage/') }}/${data.piagam_prestasi}` : '';
                        const html = `<div class="@error('piagam_prestasi') dropify-invalid @enderror">
                                <input type="file" name="piagam_prestasi" id="piagam-prestasi-edit"
                                    data-allowed-file-extensions="jpg png jpeg" class="dropify" data-default-file="${asset}"/>
                            </div>`;

                        $('#piagam-set').html(html);

                        $('.dropify').dropify({
                            messages: {
                                default: 'Pilih gambar anda! <br> Format gambar yang diwajibkan <br> adalah .JPG, .JPEG, .PNG!',
                                replace: 'Mau ganti gambar anda?',
                                remove: 'Hapus',
                                error: 'Ada kesalahan pada proses upload gambar!'
                            }
                        });

                        $('.loading-screen').addClass('d-none');

                        $('#editPrestasi').modal('show');
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            }

            function deletePrestasi(id) {
                $('#prestasi-id-delete').val(id);
                $('#deletePrestasi').modal('show');
            }
        </script>
    @endpush
