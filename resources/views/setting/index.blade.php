<!-- Content -->
@extends('layout.app')
@section('title', 'Pengaturan Aplikasi')
@section('content')
    <div class="content">

        <div class="container ">

            <!-- Breadcrumb -->
            <div class="breadcrumb">
                Setting
            </div>

            <div class="row">
                <div class="col col-lg-9 mx-auto">
                    {{-- Head Button --}}
                    {{-- <div class="d-flex mt-2 justify-content-between">
                    <h5 class="fw-bold">
                        <i class="bi bi-gear me-1"></i>
                        Setting
                    </h5>
                    <span style="font-size: 12px;" class="fw-bold align-self-center me-2">Atur disini!</span>
                </div> --}}
                    {{-- End --}}

                    {{-- Form Data Setting --}}
                    <form action="{{ route('setting.update') }}" method="post" enctype="multipart/form-data" class="mt-1">
                        @csrf
                        {{-- Id Setting --}}
                        <input type="hidden" value="{{ $setting->id }}" name="id">

                        <div class="row">
                            <div class="col col-lg-11 mx-auto">

                                {{-- Setting data tahun akademik --}}
                                {{-- <h6 class="">
                                    <i class="bi bi-buildings"></i>
                                    Tahun Akademik
                                </h6>
                                <div class="card px-3 ps-1 card-content mt-3">
                                    <div class="mb-2 mt-3 ms-3">
                                        <span>
                                            Daftar Tahun Akademik
                                        </span>
                                        <a href="javascript:void(0);" onclick="tambahTahunAkademik()"
                                            class="btn btn-primary float-end">
                                            <i class="bi bi-plus-lg"></i>
                                            Tambah
                                        </a>
                                        <a href="{{ route('buat.tahun.akademik') }}"
                                            class="btn btn-default-2 float-end me-2">
                                            <i class="bi bi-arrow-counterclockwise"></i> Buat
                                        </a>
                                    </div>
                                    <div class="mb-4 mt-3 ms-3">
                                        <table class="table">
                                            <tr>
                                                <th>No</th>
                                                <th>Tahun Ajar</th>
                                                <th>Semester</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                            @foreach ($tahunAkademik as $baris)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $baris->tahunAjar->tahun_ajar }}</td>
                                                    <td>{{ $baris->semester }}</td>
                                                    <td>
                                                        <div
                                                            class="badge {{ $baris->status == 'true' ? 'badge-status-aktif' : 'badge-status-nonaktif' }}">
                                                            {{ $baris->status == 'true' ? 'Aktif' : 'Non Aktif' }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);"
                                                            onclick="ubahTahunAkademik('{{ $baris->id }}', '{{ $baris->tahunAjar->id }}', '{{ $baris->semester }}')"
                                                            class="text-primary text-decoration-none me-2">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>
                                                        <a href="javascript:void(0);"
                                                            onclick="hapusTahunAkademik('{{ $baris->id }}')"
                                                            class="text-secondary text-decoration-none me-2">
                                                            <i class="bi bi-trash"></i>
                                                        </a>
                                                        <a href="{{ route('aktifasi.tahun.akademik', $baris->id) }}"
                                                            class="{{ $baris->status == 'true' ? 'text-success' : 'text-danger' }} text-decoration-none">
                                                            <i
                                                                class="bi {{ $baris->status == 'true' ? 'bi-toggle-on' : 'bi-toggle-off' }} fs-6"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>

                                    {{ $tahunAkademik->links() }}
                                </div> --}}

                                {{-- Setting data sekolah --}}
                                <h6 class="mt-2 mt-lg-5">
                                    <i class="bi bi-buildings"></i>
                                    Idenitas Sekolah
                                </h6>
                                <div class="card px-3 ps-1 card-content mt-3">
                                    {{-- Nama Sekolah --}}
                                    <div class="mb-4 mt-3 ms-3">
                                        <label for="nama_sekolah" class="form-label fw-bold">Nama Sekolah</label>
                                        <input type="text"
                                            class="form-control form-borderless @error('nama_sekolah') is-invalid @enderror"
                                            id="nama_sekolah" placeholder="Masukan nama sekolah!" name="nama_sekolah"
                                            value="{{ old('nama_sekolah') ? old('nama_sekolah') : $setting->nama_sekolah }}">
                                        @error('nama_sekolah')
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ ucwords($message) }}
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- NPSN Sekolah --}}
                                    <div class="mb-4 mt-3 ms-3">
                                        <label for="npsn" class="form-label fw-bold">NPSN Sekolah</label>
                                        <input type="number"
                                            class="form-control form-borderless @error('npsn') is-invalid @enderror"
                                            id="npsn" placeholder="Masukan npsn!" name="npsn"
                                            value="{{ old('npsn') ? old('npsn') : $setting->npsn }}">
                                        @error('npsn')
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ ucwords($message) }}
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- Kota/Kabupaten --}}
                                    <div class="mb-4 mt-4 ms-3">
                                        <label for="kota" class="form-label fw-bold">Kota/Kabupaten</label>
                                        <input type="text"
                                            class="form-control form-borderless @error('kota') is-invalid @enderror"
                                            id="kota" placeholder="Masukan Kota/Kabupaten!" name="kota"
                                            value="{{ old('kota') ? old('kota') : $setting->kota }}">
                                        @error('kota')
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ ucwords($message) }}
                                            </div>
                                        @enderror
                                    </div>
                                    {{-- End --}}

                                    {{-- Alamat Sekolah --}}
                                    <div class="mb-4 mt-4 ms-3">
                                        <label for="alamat_sekolah" class="form-label fw-bold">Alamat Sekolah</label>
                                        <input type="text"
                                            class="form-control form-borderless @error('alamat_sekolah') is-invalid @enderror"
                                            id="alamat_sekolah" placeholder="Masukan alamat sekolah!" name="alamat_sekolah"
                                            value="{{ old('alamat_sekolah') ? old('alamat_sekolah') : $setting->alamat_sekolah }}">
                                        @error('alamat_sekolah')
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ ucwords($message) }}
                                            </div>
                                        @enderror
                                    </div>
                                    {{-- End --}}

                                    {{-- KOP Buku Induk --}}
                                    <div class="mb-4 mt-4 ms-3">
                                        <label for="foto" class="form-label fw-bold">KOP Buku Induk</label>
                                        <div class="@error('kop_binduk') dropify-invalid @enderror">
                                            <input type="file" name="kop_binduk" class="kop_binduk"
                                                data-allowed-file-extensions="jpg png jpeg"
                                                data-default-file="{{ $setting?->kop_binduk ? asset('storage/' . $setting->kop_binduk) : '' }}" />
                                        </div>
                                        @error('kop_binduk')
                                            <div id="validationServer03Feedback" class="text-danger mt-1">
                                                {{ ucwords($message) }}
                                            </div>
                                        @enderror
                                        <ul class="text-secondary mt-2" style="font-size: 12px;">
                                            <li>Format file yang di dukung (JPEG, JPG, PNG)</li>
                                            <li>Maksimum kapasitas file ( 1024 Kb / 1 Mb)</li>
                                            {{-- <li>Dimensi yang disarankan ( 479 x 709 Pixel)</li> --}}
                                        </ul>
                                    </div>
                                    <br>
                                    {{-- End --}}
                                </div>


                                {{-- Setting data kepsek --}}
                                <h6 class="mt-5">
                                    <i class="bi bi-person-badge"></i>
                                    Kepala Sekolah
                                </h6>
                                <div class="card px-3 ps-1 card-content mt-3">
                                    {{-- nama_kepsek --}}
                                    <div class="mb-4 mt-3 ms-3">
                                        <label for="nama_kepsek" class="form-label fw-bold">Nama Kepala Sekolah</label>
                                        <input type="text"
                                            class="form-control form-borderless @error('nama_kepsek') is-invalid @enderror"
                                            id="nama_kepsek" placeholder="Masukan nama_kepsek!" name="nama_kepsek"
                                            value="{{ old('nama_kepsek') ? old('nama_kepsek') : $setting->nama_kepsek }}">
                                        @error('nama_kepsek')
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ ucwords($message) }}
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- NIP Kepala Sekolah --}}
                                    <div class="mb-4 mt-3 ms-3">
                                        <label for="nip" class="form-label fw-bold">NIP Kepla Sekolah</label>
                                        <input type="text"
                                            class="form-control form-borderless @error('nip') is-invalid @enderror"
                                            id="nip" placeholder="Masukan nip!" name="nip"
                                            value="{{ old('nip') ? old('nip') : $setting->nip }}">
                                        @error('nip')
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ ucwords($message) }}
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- Tanda Tangan Kepsek --}}
                                    <div class="mb-4 mt-4 ms-3">
                                        <label for="foto" class="form-label fw-bold">Tanda Tangan Kepsek</label>
                                        <div class="@error('ttd_kepsek') dropify-invalid @enderror">
                                            <input type="file" name="ttd_kepsek" class="ttd_kepsek"
                                                data-allowed-file-extensions="jpg png jpeg"
                                                data-default-file="{{ $setting?->ttd_kepsek ? asset('storage/' . $setting->ttd_kepsek) : '' }}" />
                                        </div>
                                        @error('ttd_kepsek')
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
                                    <br>
                                    {{-- End --}}
                                </div>


                                {{-- Setting user --}}
                                <h6 class="mt-5">
                                    <i class="bi bi-people"></i>
                                    For Users
                                </h6>
                                <div class="card px-3 ps-1 card-content mt-3">
                                    {{-- password --}}
                                    <div class="mb-4 mt-3 ms-3">
                                        <label for="password" class="form-label fw-bold">Default Password For
                                            Users</label>
                                        <input type="password"
                                            class="form-control form-borderless @error('password_user') is-invalid @enderror"
                                            id="password_user" placeholder="Masukan password user!" name="password_user"
                                            value="{{ old('password_user') ? old('password_user') : $setting->password_user }}">
                                        @error('password_user')
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ ucwords($message) }}
                                            </div>
                                        @enderror
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" id="show-password">
                                            <label class="form-check-label" for="flexCheckChecked">
                                                Tampilkan Password
                                            </label>
                                        </div>
                                    </div>
                                    {{-- End --}}
                                </div>

                            </div>
                        </div>

                        {{-- Tombol Update --}}
                        <div class="row mt-4">
                            <div class="col col-lg-11 mx-auto mb-4">
                                <button type="submit" class="btn btn-primary float-end">
                                    <i class="bi bi-send-fill me-1"></i>
                                    Update
                                </button>
                                <button type="Reset" class="btn btn-default-2 float-end me-2">Reset</button>
                            </div>
                        </div>
                    </form>
                    {{-- End --}}

                </div>
            </div>

        </div>

    </div>

@endsection
@push('scripts')
    <script type="text/javascript">
        // Notif untuk data yang berhasil diproses
        @if (session('sukses'))
            let pesan = "{{ session('sukses') }}"
            toastr.success(pesan)
        @endif

        // Notif untuk data yang tidak lolos validasi
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.warning('{{ ucwords($error) }}');
            @endforeach
        @endif

        // Konfigurasi Dropify preview Image ttd_kepsek
        $('.ttd_kepsek').dropify({
            messages: {
                default: 'Pilih gambar anda! <br> Format gambar yang diwajibkan <br> adalah .JPG, .JPEG, .PNG!',
                replace: 'Mau ganti gambar anda?',
                remove: 'Hapus',
                error: 'Ada kesalahan pada proses upload gambar!'
            }
        });

        // Konfigurasi Dropify preview Image kop_binduk
        $('.kop_binduk').dropify({
            messages: {
                default: 'Pilih gambar anda! <br> Format gambar yang diwajibkan <br> adalah .JPG, .JPEG, .PNG!',
                replace: 'Mau ganti gambar anda?',
                remove: 'Hapus',
                error: 'Ada kesalahan pada proses upload gambar!'
            }
        });

        // Lihat dan sembunyikan password 
        $('#show-password').click(function() {
            const pass = $('#password_user').attr('type');
            if (pass === "password") {
                $('#password_user').attr('type', 'text');
            } else {
                $('#password_user').attr('type', 'password');
            }
        });
    </script>
@endpush
