<!-- Content -->
@extends('layout.app')
@section('title', 'Rekap Lampiran Dan Berkas Pendukung')
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
                                lampiran siswa
                            </span>

                        </div>

                        <div class="mt-2 mb-3">
                            @include('binduk.rekap.navtabs')
                        </div>
                        {{-- End --}}

                        {{-- Table lampiran Desktop View --}}
                        <table class="table d-none d-lg-table d-md-table desktop-table mt-4">

                            <tr class="tr-table">
                                <th>No</th>
                                <th>Nama Lampiran</th>
                                <th>Status</th>
                                <th>Detail</th>
                                <th></th>
                            </tr>
                            @foreach ($lampiran as $item)
                                @if ($item->status == 'Wajib')
                                    <tr style="color: rgb(26, 26, 26);">
                                        <td>
                                            {{ $loop->iteration }}).
                                        </td>
                                        <td>
                                            <div class="fw-bold">
                                                {{ $item->lampiran }}
                                            </div>
                                        </td>
                                        <td>
                                            @if ($item->lampiranSiswa?->status == 'sudah')
                                                <span class="badge bg-success">
                                                    {{ $item->lampiranSiswa?->status }} diunggah
                                                </span>
                                            @else
                                                <span class="badge bg-warning">
                                                    Belum diunggah
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);"
                                                onclick="viewFile('{{ $item->lampiranSiswa?->file }}')">
                                                @if ($item->lampiranSiswa?->file)
                                                    <i class="bi bi-filetype-pdf fs-5"></i>
                                                @endif
                                            </a>
                                        </td>
                                        <td>
                                            @if ($item->lampiranSiswa?->file)
                                                <a href="javascript:void(0);"
                                                    onclick="ubahFile('{{ $item->lampiranSiswa->id }}', '{{ $item->lampiranSiswa->file }}')"
                                                    class="py-1 px-2 btn btn-secondary" style="font-size: 10px;">
                                                    <i class="bi bi-cloud-arrow-up me-1"></i>
                                                    Perbarui
                                                </a>
                                                <a href="javascript:void(0);"
                                                    onclick="hapusFile('{{ $item->lampiranSiswa->id }}')"
                                                    class="py-1 px-2 btn btn-danger" style="font-size: 10px;">
                                                    <i class="bi bi-x-lg"></i>
                                                </a>
                                            @else
                                                <a href="javascript:void(0);"
                                                    onclick="unggahFile('{{ $item->id }}', '{{ $siswa->id }}')"
                                                    class="py-1 px-2 btn btn-primary" style="font-size: 10px;">
                                                    <i class="bi bi-cloud-arrow-up me-1"></i>
                                                    Unggah
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                        {{-- End --}}

                    </div>
                </div>

            </div>
        </div>

        {{-- Modal View File lampiran --}}
        <div class="modal fade" id="viewFileLampiran" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="viewFileLampiranLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom">
                        <h6 class="modal-title fw-bold" id="viewFileLampiranLabel">View File Lampiran</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="file-view"></div>
                    </div>
                    <div class="modal-footer border-top">
                        <button type="reset" class="btn btn-default-2" data-bs-dismiss="modal">Keluar</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- End --}}

        {{-- Modal Unggah File --}}
        <div class="modal fade" id="unggahFile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="unggahFileLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom">
                        <h6 class="modal-title fw-bold" id="unggahFileLabel">Unggah File</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('rekap.form.lampiran.create', $siswa->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">

                            <input type="hidden" value="{{ $menu }}" name="menu">
                            <input type="hidden" value="{{ request()->input('kelas') }}" name="kelas">
                            <input type="hidden" value="{{ request()->input('nama_siswa') }}" name="nama_siswa">
                            <input type="hidden" value="{{ $siswa->id }}" name="siswa_id">

                            <input type="hidden" id="lampiran-id" name="lampiran_id"></i>
                            <input type="hidden" id="siswa-id" name="siswa_id"></i>

                            {{-- File Lampiran --}}
                            <label for="file" class="form-label mb-2">
                                File Lampiran
                                <span class="text-danger">*</span>
                            </label>
                            <div class="@error('file') dropify-invalid @enderror">
                                <input type="file" name="file" data-allowed-file-extensions="pdf"
                                    class="dropify" />
                            </div>
                            @error('file')
                                <div id="validationServer03Feedback" class="text-danger mt-1">
                                    {{ ucwords($message) }}
                                </div>
                            @enderror
                            <ul class="text-secondary mt-2" style="font-size: 12px;">
                                <li>Format file yang di dukung (PDF)</li>
                                <li>Maksimum kapasitas file ( 1024 Kb / 1 Mb)</li>
                                {{-- <li>Dimensi yang disarankan ( 479 x 709 Pixel)</li> --}}
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

        {{-- Modal Ubah File --}}
        <div class="modal fade" id="ubahFile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="ubahFileLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom">
                        <h6 class="modal-title fw-bold" id="ubahFileLabel">Ubah File</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('rekap.form.lampiran.update', $siswa->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="modal-body">

                            <input type="hidden" value="{{ $menu }}" name="menu">
                            <input type="hidden" value="{{ request()->input('kelas') }}" name="kelas">
                            <input type="hidden" value="{{ request()->input('nama_siswa') }}" name="nama_siswa">
                            <input type="hidden" value="{{ $siswa->id }}" name="siswa_id">

                            <input type="hidden" id="lasis-id-edit" name="lampiran_siswa_id"></i>

                            {{-- File Lampiran --}}
                            <label for="file" class="form-label mb-2">
                                File Lampiran
                                <span class="text-danger">*</span>
                            </label>
                            <div id="file-set"></div>
                            @error('file')
                                <div id="validationServer03Feedback" class="text-danger mt-1">
                                    {{ ucwords($message) }}
                                </div>
                            @enderror
                            <ul class="text-secondary mt-2" style="font-size: 12px;">
                                <li>Format file yang di dukung (PDF)</li>
                                <li>Maksimum kapasitas file ( 1024 Kb / 1 Mb)</li>
                                {{-- <li>Dimensi yang disarankan ( 479 x 709 Pixel)</li> --}}
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


        {{-- Modal Delete Lampiran --}}
        <div class="modal fade" id="hapusFile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="hapusFileLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom">
                        <h6 class="modal-title fw-bold" id="hapusFileLabel">Hapus File</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('rekap.form.lampiran.delete', $siswa->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <div class="modal-body">

                            <input type="hidden" value="{{ $menu }}" name="menu">
                            <input type="hidden" value="{{ request()->input('kelas') }}" name="kelas">
                            <input type="hidden" value="{{ request()->input('nama_siswa') }}" name="nama_siswa">

                            <p id="keterangan-to-lampiran" class="text-center">
                                Apakah anda yakin ingin menghapus file ini?
                            </p>
                            <input type="hidden" id="lasis-id-delete" name="lampiran_siswa_id">
                        </div>
                        <div class="modal-footer border-top">
                            <button type="button" class="btn btn-default-2" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger" id="delBtnlampiran">
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
                    default: 'Pilih gambar anda! <br> Format gambar yang diwajibkan <br> adalah .PDF!',
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

            function viewFile(file) {
                $('.loading-screen').removeClass('d-none');
                const asset = file ? `{{ asset('storage') }}/${file}` : '';
                const html = `<iframe src="${asset}" style="width:100%; height:500px;"></iframe>`;

                $('#file-view').html(html);

                $('.loading-screen').addClass('d-none');

                $('#viewFileLampiran').modal('show');
            }

            function unggahFile(lampiranId, siswaId) {
                $('#lampiran-id').val(lampiranId);
                $('#siswa-id').val(siswaId);
                $('#unggahFile').modal('show');
            }

            function ubahFile(id, file) {

                $('.loading-screen').removeClass('d-none');

                $('#lasis-id-edit').val(id);

                const asset = file ? `{{ asset('storage/') }}/${file}` : '';
                const html =
                    `<div class="@error('file') dropify-invalid @enderror">
                <input type="file" name="file" id="file-edit" data-allowed-file-extensions="pdf" class="dropify" data-default-file="${asset}"/> 
                </div>`;

                $('#file-set').html(html);

                $('.dropify').dropify({
                    messages: {
                        default: 'Pilih gambar anda! <br> Format gambar yang diwajibkan <br> adalah .JPG, .JPEG, .PNG!',
                        replace: 'Mau ganti gambar anda?',
                        remove: 'Hapus',
                        error: 'Ada kesalahan pada proses upload gambar!'
                    }
                });

                $('.loading-screen').addClass('d-none');

                $('#ubahFile').modal('show');

            }

            function hapusFile(id) {
                $('#lasis-id-delete').val(id);
                $('#hapusFile').modal('show');
            }
        </script>
    @endpush
