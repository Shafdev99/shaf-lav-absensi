<!-- Content -->
@extends('layout.app')
@section('title', 'Mutasi Siswa')
@section('content')

    @php
        $parse = parse_url(url()->full());
        $url = isset($parse['query']) ? $parse['query'] : false;
    @endphp

    <div class="content content-sm">

        <div class="container">

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                Mutasi Siswa
            </div>
            {{-- End --}}

            {{-- <h5>Data Siswa</h5> --}}
            <div class="row mt-4">
                <div class="col-lg-9 mx-auto">
                    <div class="card p-lg-3 py-3 px-0 card-content">
                        {{-- Header Button --}}
                        <div class="d-flex mt-2 mb-3 px-2 justify-content-between">

                            <a href="{{ route('mutasi', $url) }}" class="btn btn-primary ms-2">
                                <i class="bi bi-arrow-left"></i>
                                Kembali
                            </a>

                            <span class="me-3 align-self-center">
                                Mutasi siswa
                            </span>

                        </div>

                        <div class="mt-2 mb-3">
                            {{-- Identitas Siswa --}}
                            <div class="alert alert-primary mx-3" role="alert">
                                <div class="d-flex justify-content-between mb-2">
                                    <h5 class="py-0">
                                        {{ $siswa->nama_lengkap }}
                                    </h5>

                                    <div class="fw-bold">
                                        @switch($siswa->status)
                                            @case('aktif')
                                                <i class="bi bi-person-fill-check"></i>
                                                {{ $siswa->status }}
                                            @break

                                            @case('alumni')
                                                <i class="bi bi-mortarboard-fill"></i>
                                                {{ $siswa->status }}
                                            @break

                                            @case('pindah')
                                                <i class="bi bi-building-fill-up"></i>
                                                {{ $siswa->status }}
                                            @break

                                            <i class="bi bi-person-fill-x"></i>
                                            {{ $siswa->status }}

                                            @default
                                        @endswitch
                                    </div>

                                </div>
                                <span>
                                    <b>
                                        NIS : {{ $siswa->nis }}
                                    </b>
                                    <br>
                                    {{ $siswa->tingkat . ' ' . $siswa->nama_jurusan . ' ' . $siswa->nama_kelas }}
                                    |
                                    {{ $siswa->tahun_ajar }}
                                </span>
                            </div>
                            {{-- End --}}
                        </div>
                        {{-- End --}}

                        {{-- Table Mutasi Desktop View --}}
                        {{-- Form content disini ! --}}
                        <form action="{{ route('mutasi.siswa.update', $siswa->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <input type="hidden" value="{{ request()->input('kelas') }}" name="kelas">
                            <input type="hidden" value="{{ request()->input('nama_siswa') }}" name="nama_siswa">

                            {{-- Mutasi Siswa --}}
                            <div class="container-fluid mt-4">
                                <h5 class="fw-bold">Mutasi Siswa</h5>
                                <hr>
                                <div class="row">
                                    <div class="col">

                                        {{-- Nama Sekolah --}}
                                        <div class="mb-4 mt-2">
                                            <label for="nama_sekolah" class="form-label">
                                                Nama Sekolah yang dituju
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('nama_sekolah') is-invalid @enderror"
                                                id="nama_sekolah" placeholder="Masukkan nama sekolah !" name="nama_sekolah"
                                                value="{{ old('nama_sekolah') ? old('nama_sekolah') : $mutasi?->nama_sekolah }}">
                                            @error('nama_sekolah')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Tingkat --}}
                                        <div class="mb-4 mt-2">
                                            <label for="tingkat_id" class="form-label">Tingkat Keterima
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="tingkat_id"
                                                class="form-select @error('tingakt_id') is-invalid @enderror"
                                                id="tingkat_id">
                                                @foreach ($tingkat as $Tingkat)
                                                    <option value="{{ $Tingkat->id }}"
                                                        {{ $mutasi?->tingkat_id == $Tingkat->id || $mutasi?->tingkat_id == old('tingkat_id') ? 'selected' : '' }}>
                                                        {{ $Tingkat->tingkat }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('tingkat_id')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Tahun --}}
                                        <div class="mb-4 mt-2">
                                            <label for="anak_ke" class="form-label">Tahun Keterima
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="tahun_ajar"
                                                class="form-select @error('tahun_ajar') is-invalid @enderror"
                                                id="tahun_ajar">
                                                @foreach ($tahunAjar as $TahunAjar)
                                                    <option value="{{ $TahunAjar->id }}"
                                                        {{ $mutasi?->tahun_ajar == $TahunAjar->id || $mutasi?->tahun_ajar == old('tahun_ajar') ? 'selected' : '' }}>
                                                        {{ $TahunAjar->tahun_ajar }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('tahun_ajar')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Lampiran --}}
                                        @if (!empty($mutasi->id))
                                            <div class="mb-4 mt-2">
                                                <label for="lampiran" class="form-label">Surat Balasan</label>
                                                <div class="alert alert-primary">
                                                    Siswa akan dinyatakan resmi pindah jika pihak sekolah sudah menerima
                                                    surat
                                                    balasan atau sejenisnya dan sudah diunggah pada aplikasi ini!
                                                </div>
                                                <div class="@error('lampiran') dropify-invalid @enderror">
                                                    <input type="file" name="lampiran" data-allowed-file-extensions="pdf"
                                                        class="dropify"
                                                        data-default-file="{{ $mutasi?->lampiran ? asset('storage/' . $mutasi?->lampiran) : '' }}" />
                                                </div>
                                                @error('lampiran')
                                                    <div id="validationServer03Feedback" class="text-danger mt-1">
                                                        {{ ucwords($message) }}
                                                    </div>
                                                @enderror
                                                <ul class="text-secondary mt-2" style="font-size: 12px;">
                                                    <li>Format file yang di dukung (PDF)</li>
                                                    <li>Maksimum kapasitas file ( 1024 Kb / 1 Mb)</li>
                                                </ul>

                                                @if ($mutasi?->lampiran)
                                                    <a href="javascript:void(0);" class="btn btn-primary"
                                                        onclick="viewFile('{{ $mutasi?->lampiran }}')">
                                                        <i class="bi bi-filetype-pdf fs-5"></i>
                                                        <span class="align-item-self">
                                                            Lihat Surat Balasan
                                                        </span>
                                                    </a>
                                                @endif
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>

                            {{-- Tombol Simpan --}}
                            <div class="container-fluid mt-3">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-5">
                                            @if (!empty($mutasi->id))
                                                <a href="{{ route('cetak.mutasi', $siswa->id) }}"
                                                    class="btn btn-success float-end" target="_blank">
                                                    <i class="bi bi-printer-fill me-1"></i>
                                                    Cetak Mutasi
                                                </a>
                                            @endif
                                            <button type="submit" class="btn btn-primary float-end">
                                                <i class="bi bi-send-fill me-1"></i>
                                                Simpan
                                            </button>
                                            <button type="Reset" class="btn btn-default-2 float-end me-2">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>

        {{-- Modal Lihat Surat Balasan --}}
        <div class="modal fade" id="viewFileLampiran" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="viewFileLampiranLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom">
                        <h6 class="modal-title fw-bold" id="viewFileLampiranLabel">Lihat Surat Balasan</h6>
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

    @endsection
    @push('scripts')
        <script type="text/javascript">
            // Notif untuk data yang berhasil diproses
            @if (session('sukses'))
                let pesan = "{{ session('sukses') }}"
                toastr.success(pesan)
            @endif

            // Konfigurasi Dropify preview Image
            $('.dropify').dropify({
                messages: {
                    default: 'Pilih file anda! <br> Format file yang diwajibkan <br> adalah .PDF!',
                    replace: 'Mau ganti file anda?',
                    remove: 'Hapus',
                    error: 'Ada kesalahan pada proses upload file!'
                }
            });

            function viewFile(file) {
                $('.loading-screen').removeClass('d-none');
                const asset = file ? `{{ asset('storage') }}/${file}` : '';
                const html = `<iframe src="${asset}" style="width:100%; height:500px;"></iframe>`;

                $('#file-view').html(html);

                $('.loading-screen').addClass('d-none');

                $('#viewFileLampiran').modal('show');
            }
        </script>
    @endpush
