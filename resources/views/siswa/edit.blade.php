<!-- Content -->
@extends('layout.app')
@section('title', 'Ubah Data Siswa')
@section('content')
    <div class="content">

        <div class="container ">

            <!-- Breadcrumb -->
            <div class="breadcrumb">
                <a href="{{ route('siswa') }}">Data
                    Siswa </a> /
                Ubah Data
            </div>
            {{-- <h5>Ubah Data</h5> --}}
            <div class="row mt-4">
                <div class="col col-lg-9 mx-auto">
                    <div class="card p-lg-3 py-3 card-content">
                        {{-- Head Button --}}
                        <div class="d-flex mt-2 mb-4 px-2 justify-content-between">
                            {{-- <a href="{{ url('siswa/kelas?' . request()->input('kelas') . '&nama_siswa' . request()->input('nama_siswa')) }}"
                                class="btn btn-primary ms-2">
                                <i class="bi bi-arrow-left"></i>
                                Kembali
                            </a> --}}
                            {{-- <form action="{{ route('siswa') }}" action="get">
                                 
                                <input type="hidden" value="{{ request()->input('kelas') }}" name="kelas">
                                <input type="hidden" value="{{ request()->input('nama_siswa') }}" name="nama_siswa">
                                <button type="submit" class="btn btn-primary ms-2">
                                    <i class="bi bi-arrow-left"></i>
                                    Kembali
                                </button>
                            </form> --}}
                            @php
                                $url = parse_url(url()->full());
                            @endphp
                            <a href="{{ route('siswa', $url['query'] ?? false) }}" class="btn btn-primary ms-2">
                                <i class="bi bi-arrow-left"></i>
                                Kembali
                            </a>
                            <h6 class="fw-bold align-self-center me-2">Ubah Data</h6>
                        </div>
                        {{-- End --}}

                        <form action="{{ route('siswa.update', $siswa->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')


                            <input type="hidden" value="{{ request()->input('kelas') }}" name="kelas">
                            <input type="hidden" value="{{ request()->input('nama_siswa') }}" name="nama_siswa">

                            {{-- Data Siswa --}}
                            <div class="container-fluid mt-4">
                                <h5 class="fw-bold">Data Siswa</h5>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        {{-- Nama Lengkap --}}
                                        <div class="mb-4 mt-2">
                                            <label for="nama-lengkap" class="form-label">Nama Lengkap
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('nama_lengkap') is-invalid @enderror"
                                                id="nama-lengkap" placeholder="Masukan nama lengkap!" name="nama_lengkap"
                                                value="{{ old('nama_lengkap') ? old('nama_lengkap') : $siswa->nama_lengkap }}">
                                            @error('nama_lengkap')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>
                                        {{-- Tanggal Lahir --}}
                                        <div class="mb-4">
                                            <label for="tanggal-lahir" class="form-label">Tanggal Lahir
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="date"
                                                class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                id="tanggal-lahir" placeholder="Masukan tanggal lahir!" name="tanggal_lahir"
                                                value="{{ old('tanggal_lahir') ? old('tanggal_lahir') : $siswa->tanggal_lahir }}">
                                            @error('tanggal_lahir')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>
                                        {{-- Tempat Lahir --}}
                                        <div class="mb-4">
                                            <label for="tempat-lahir" class="form-label">Tempat Lahir
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('tempat_lahir') is-invalid @enderror"
                                                id="tempat-lahir" placeholder="Masukan tempat lahir!" name="tempat_lahir"
                                                value="{{ old('tempat_lahir') ? old('tempat_lahir') : $siswa->tempat_lahir }}">
                                            @error('tempat_lahir')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>
                                        {{-- NIK --}}
                                        <div class="mb-4">
                                            <label for="nik" class="form-label">NIK
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="number" class="form-control @error('nik') is-invalid @enderror"
                                                id="nik" placeholder="Masukan nik!" name="nik"
                                                value="{{ old('nik') ? old('nik') : $siswa->nik }}">
                                            @error('nik')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>
                                        {{-- NISN --}}
                                        <div class="mb-4">
                                            <label for="nisn" class="form-label">NISN
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="number" class="form-control @error('nisn') is-invalid @enderror"
                                                id="nisn" placeholder="Masukan nisn!" name="nisn"
                                                value="{{ old('nisn') ? old('nisn') : $siswa->nisn }}">
                                            @error('nisn')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                            <p class="text-secondary mt-1" style="font-size: 12px;">
                                                Panjang NISN Minimal 10 Karakter
                                            </p>
                                        </div>
                                        {{-- NIS --}}
                                        <div class="mb-4">
                                            <label for="nis" class="form-label">NIS
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="number" class="form-control @error('nis') is-invalid @enderror"
                                                id="nis" placeholder="Masukan nis!" name="nis"
                                                value="{{ old('nis') ? old('nis') : $siswa->nis }}">
                                            @error('nis')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                            <p class="text-secondary mt-1" style="font-size: 12px;">
                                                Panjang NIS Minimal 6 Karakter dan Maksimal 10 Karakter
                                            </p>
                                        </div>
                                        {{-- Alamat --}}
                                        <div class="mb-4">
                                            <label for="alamat" class="form-label">Alamat
                                                <span class="text-danger">*</span>
                                            </label>
                                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" cols="30"
                                                rows="4" placeholder="Masukan alamat!">{{ old('alamat') ? old('alamat') : $siswa->alamat }}</textarea>
                                            @error('alamat')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>
                                        {{-- Jenis Kelamin --}}
                                        <div class="mb-4">
                                            <label for="jenis-kelamin" class="form-label">Jenis Kelamin
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="jenis_kelamin"
                                                class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                                id="jenis-kelamin">
                                                <option value="">Pilih jenis kelamin</option>
                                                <option value="Laki-laki"
                                                    {{ $siswa->jenis_kelamin == 'Laki-laki' || old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                                    Laki-laki</option>
                                                <option value="Perempuan"
                                                    {{ $siswa->jenis_kelamin == 'Perempuan' || old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                                    Perempuan</option>
                                            </select>
                                            @error('jenis_kelamin')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>
                                        {{-- Agama --}}
                                        <div class="mb-4">
                                            <label for="agama" class="form-label">Agama
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="agama"
                                                class="form-control @error('agama') is-invalid @enderror" id="agama">
                                                <option value="">Pilih agama</option>
                                                @foreach ($agama as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ ucwords($siswa->agama) == $item->id || old('agama') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->agama }} </option>
                                                @endforeach
                                            </select>
                                            @error('agama')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>
                                        {{-- Foto --}}
                                        <div class="">
                                            <label for="foto" class="form-label">Foto Siswa
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="@error('foto') dropify-invalid @enderror">
                                                <input type="file" name="foto" class="dropify"
                                                    data-allowed-file-extensions="jpg png jpeg"
                                                    data-default-file="{{ $siswa?->foto ? asset('storage/' . $siswa->foto) : '' }}" />
                                            </div>
                                            @error('foto')
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
                                    </div>
                                </div>
                            </div>

                            {{-- Keterangan Keterima --}}
                            <div class="container-fluid mt-5">
                                <h5 class="fw-bold">Keterangan Keterima</h5>
                                <hr>
                                <div class="row">
                                    <div class="col">

                                        {{-- Tingkat --}}
                                        <div class="mb-4 mt-2">
                                            <label for="tingkat" class="form-label">Tingkat
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="tingkat_id"
                                                class="form-control mb-4 @error('tingkat_id') is-invalid @enderror"
                                                id="tingkat_id">
                                                <option value="">Pilih Tingkat</option>
                                                @foreach ($tingkat as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $siswa->keteranganKeterima->tingkat_id == $item->id || old('tingkat_id') == $item ? 'selected' : '' }}>
                                                        {{ $item->tingkat }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('tingkat_id')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Jurusan --}}
                                        <div class="mb-4 mt-2">
                                            <label for="jurusan" class="form-label">Jurusan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="jurusan_id"
                                                class="form-control @error('jurusan_id') is-invalid @enderror"
                                                id="jurusan_id">
                                                <option value="">Pilih Jurusan</option>
                                                @foreach ($jurusan as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $siswa->keteranganKeterima->jurusan_id == $item->id || old('jurusan_id') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->nama_jurusan . ' ( ' . $item->keterangan . ' )' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('jurusan_id')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Kelas --}}
                                        <div class="mb-4 mt-2">
                                            <label for="kelas" class="form-label">Kelas
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="kelas_id"
                                                class="form-control @error('kelas_id') is-invalid @enderror"
                                                id="kelas-id">
                                                <option value="">Pilih kelas</option>
                                            </select>
                                            @error('kelas_id')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Tanggal --}}
                                        <div class="mb-4">
                                            <label for="tanggal_keterima" class="form-label">Tanggal
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="date" name="tanggal_keterima"
                                                class="form-control @error('tanggal_keterima') is-invalid @enderror"
                                                id="tanggal_keterima" placeholder="Masukan Tanggal!"
                                                value="{{ old('tanggal_keterima') ? old('tanggal_keterima') : $siswa->keteranganKeterima->tanggal_keterima }}">
                                            @error('tanggal_keterima')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Tahun Pelajaran --}}
                                        <div class="">
                                            <label for="tahun_ajar" class="form-label">Tahun Pelajaran
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="tahun_ajar_id" class="form-control" disabled
                                                value="{{ session('tahun_ajar') . ' ' . session('semester') }}">
                                            {{-- <select name="tahun_ajar" class="form-select">
                                                @foreach ($tahunAjar as $item)
                                                    <option
                                                        {{ $siswa->keteranganKeterima->tahun_ajar == $item->id || old('tahun_ajar_id') == $item->id ? 'selected' : '' }}
                                                        value="{{ $item->id }}">{{ $item->tahun_ajar }}
                                                    </option>
                                                @endforeach --}}
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- Tombol Ubah --}}
                            <div class="container-fluid mt-5">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-5">
                                            <button type="submit" class="btn btn-primary float-end">
                                                <i class="bi bi-send-fill me-1"></i>
                                                Ubah
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

    </div>
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

        function getKelas(jurusanId, tingkatId, kelasId) {
            const url = "{{ url('/getKelasByJurusan') }}/";
            const oldKelasId = "{{ old('kelas_id') }}";

            $.getJSON(url + jurusanId + '/' + tingkatId,
                function(data) {
                    let html = '';
                    if (data.length === 0) {
                        html += `<option value="">Tidak memiliki kelas</option>`;
                    } else {
                        $.each(data, function(index, value) {
                            html +=
                                `<option value = "${value.id}" >${value.tingkat} ${value.nama_jurusan} ${value.nama_kelas} ( ${value.nama_kurikulum} )</option>`;
                        });
                    }
                    $('#kelas-id').html(html);

                    $("#kelas-id option").map(function() {
                        if ($(this).val() == kelasId || $(this).val() == oldKelasId) {
                            $(this).attr("selected", "selected");
                        }
                    });
                }
            );
        }

        $('#jurusan_id').change(function(e) {
            e.preventDefault();
            const tingkatId = $('#tingkat_id').val();
            getKelas(this.value, tingkatId);
        });

        $('#tingkat_id').change(function(e) {
            e.preventDefault();
            const jurusanId = $('#jurusan_id').val();
            getKelas(jurusanId, this.value);
        });

        $(document).ready(function() {
            const kelasId = '{{ $siswa->keteranganKeterima->kelas_id }}';
            if (!kelasId) {
                kelasId = null;
            }
            const jurusanId = $('#jurusan_id').val();
            const tingkatId = $('#tingkat_id').val();
            getKelas(jurusanId, tingkatId, kelasId);
        });
    </script>
@endpush
