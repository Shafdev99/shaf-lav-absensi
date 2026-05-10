<!-- Content -->
@extends('layout.app')
@section('title', 'Rekap Data Orang Tua')
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
                                Data orang tua
                            </span>

                        </div>

                        <div class="mt-2 mb-3">
                            @include('binduk.rekap.navtabs')
                        </div>
                        {{-- End --}}

                        {{-- Table Orang Tua Desktop View --}}
                        {{-- Form content disini ! --}}
                        <form action="{{ route('rekap.form.ortu.update', $siswa->id) }}" method="post">
                            @csrf
                            @method('put')

                            <input type="hidden" value="{{ $menu }}" name="menu">
                            <input type="hidden" value="{{ request()->input('kelas') }}" name="kelas">
                            <input type="hidden" value="{{ request()->input('nama_siswa') }}" name="nama_siswa">
                            <input type="hidden" value="{{ $siswa->id }}" name="siswa_id">

                            {{-- Data Ayah --}}
                            <div class="container-fluid mt-4">
                                <h5 class="fw-bold">Data Ayah</h5>
                                <hr>
                                <div class="row">
                                    <div class="col">

                                        {{-- Nama lengkap ayah --}}
                                        <div class="mb-4 mt-2">
                                            <label for="nama-lengkap-ayah" class="form-label">Nama Lengkap
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('nama_ayah') is-invalid @enderror"
                                                id="nama-lengkap-ayah" placeholder="Masukan nama lengkap!" name="nama_ayah"
                                                value="{{ old('nama_ayah') ? old('nama_ayah') : $ayah?->nama_ayah }}">
                                            @error('nama_ayah')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- NIK ayah --}}
                                        <div class="mb-4 mt-2">
                                            <label for="nik-ayah" class="form-label">NIK
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('nik_ayah') is-invalid @enderror" id="nik-ayah"
                                                placeholder="Masukan nik ayah!" name="nik_ayah"
                                                value="{{ old('nik_ayah') ? old('nik_ayah') : $ayah?->nik_ayah }}">
                                            @error('nik_ayah')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Tanggal lahir ayah --}}
                                        <div class="mb-4">
                                            <label for="tanggal-lahir-ayah" class="form-label">Tanggal Lahir
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="date"
                                                class="form-control @error('tanggal_lahir_ayah') is-invalid @enderror"
                                                id="tanggal-lahir-ayah" placeholder="Masukan tanggal lahir!"
                                                name="tanggal_lahir_ayah"
                                                value="{{ old('tanggal_lahir_ayah') ? old('tanggal_lahir_ayah') : $ayah?->tanggal_lahir_ayah }}">
                                            @error('tanggal_lahir_ayah')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Tempat lahir ayah --}}
                                        <div class="mb-4">
                                            <label for="tempat-lahir-ayah" class="form-label">Tempat Lahir
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('tempat_lahir_ayah') is-invalid @enderror"
                                                id="tempat-lahir-ayah" placeholder="Masukan tempat lahir!"
                                                name="tempat_lahir_ayah"
                                                value="{{ old('tempat_lahir_ayah') ? old('tempat_lahir_ayah') : $ayah?->tempat_lahir_ayah }}">
                                            @error('tempat_lahir_ayah')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Alamat ayah --}}
                                        <div class="mb-4">
                                            <label for="alamat_ayah" class="form-label">Alamat
                                                <span class="text-danger">*</span>
                                            </label>
                                            <textarea name="alamat_ayah" class="form-control @error('alamat_ayah') is-invalid @enderror" id="alamat_ayah"
                                                cols="30" rows="4" placeholder="Masukan alamat ayah!">{{ old('alamat_ayah') ? old('alamat_ayah') : $ayah?->alamat_ayah }}</textarea>
                                            @error('alamat_ayah')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Agama ayah --}}
                                        <div class="mb-4">
                                            <label for="agama_ayah" class="form-label">Agama
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="agama_ayah"
                                                class="form-control @error('agama_ayah') is-invalid @enderror"
                                                id="agama_ayah">
                                                <option value="">Pilih agama </option>
                                                @foreach ($agama as $agm)
                                                    <option {{ $agm->id == $ayah?->agama_ayah ? 'selected' : '' }}
                                                        value="{{ $agm->id }}">
                                                        {{ $agm->agama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('agama_ayah')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Kewarganegaraan ayah --}}
                                        <div class="mb-4">
                                            <label for="kewarganegaraan_ayah" class="form-label">Kewarganegaraan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('kewarganegaraan_ayah') is-invalid @enderror"
                                                placeholder="Contoh : WNI" name="kewarganegaraan_ayah"
                                                value="{{ $ayah?->kewarganegaraan_ayah }}">
                                            @error('kewarganegaraan_ayah')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Pendidikan ayah --}}
                                        <div class="mb-4">
                                            <label for="pendidikan_ayah" class="form-label">Pendidikan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-select @error('pendidikan_ayah') is-invalid @enderror"
                                                name="pendidikan_ayah" id="pendidikan_ayah">
                                                <option value="">Pilih pendidikan</option>
                                                @foreach ($pendidikan as $pdk)
                                                    <option {{ $pdk->id == $ayah?->pendidikan_ayah ? 'selected' : '' }}
                                                        value="{{ $pdk->id }}">
                                                        {{ $pdk->pendidikan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('pendidikan_ayah')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Pekerjaan ayah --}}
                                        <div class="mb-4">
                                            <label for="pekerjaan_ayah"
                                                class="form-label @error('pekerjaan_ayah') is-invalid @enderror">Pekerjaan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control"
                                                placeholder="Contoh : Petani, PNS, Pengusaha" name="pekerjaan_ayah"
                                                value="{{ $ayah?->pekerjaan_ayah }}">
                                            @error('pekerjaan_ayah')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Penghasilan ayah --}}
                                        <div class="mb-4">
                                            <label for="penghasilan_ayah"
                                                class="form-label @error('penghasilan_ayah') is-invalid @enderror">Penghasilan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" placeholder="Contoh : 2.000.000"
                                                name="penghasilan_ayah" value="{{ $ayah?->penghasilan_ayah }}">
                                            @error('penghasilan_ayah')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Nomor telepon ayah --}}
                                        <div class="mb-4">
                                            <label for="telp_ayah" class="form-label">No telepon
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('telp_ayah') is-invalid @enderror"
                                                placeholder="Contoh : 089xxxxxxxxx" name="telp_ayah"
                                                value="{{ $ayah?->telp_ayah }}">
                                            @error('telp_ayah')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                            <p class="text-secondary mt-1" style="font-size: 12px;">
                                                Panjang nomor telepon maksimal 13 Karakter
                                            </p>
                                        </div>

                                        {{-- Status kematian ayah --}}
                                        <div class="mb-4">
                                            <label for="status_kematian_ayah" class="form-label">Status kematian
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="status_kematian_ayah"
                                                class="form-select @error('status_kematian_ayah') is-invalid @enderror"
                                                id="">
                                                @foreach ($kematian as $item)
                                                    <option
                                                        {{ $ayah?->status_kematian_ayah == $item || old('status_kematian_ayah') == $item ? 'selected' : '' }}
                                                        value="{{ $item }}">{{ $item }}</option>
                                                @endforeach
                                            </select>
                                            @error('status_kematian_ayah')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- Data Ibu --}}
                            <div class="container-fluid mt-4">
                                <h5 class="fw-bold">Data Ibu</h5>
                                <hr>
                                <div class="row">
                                    <div class="col">

                                        {{-- Nama lengkap ibu --}}
                                        <div class="mb-4 mt-2">
                                            <label for="nama-lengkap-ibu" class="form-label">Nama Lengkap
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('nama_ibu') is-invalid @enderror"
                                                id="nama-lengkap-ibu" placeholder="Masukan nama lengkap!" name="nama_ibu"
                                                value="{{ old('nama_ibu') ? old('nama_ibu') : $ibu?->nama_ibu }}">
                                            @error('nama_ibu')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- NIK ibu --}}
                                        <div class="mb-4 mt-2">
                                            <label for="nik-ibu" class="form-label">NIK
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('nik_ibu') is-invalid @enderror"
                                                id="nik-ibu" placeholder="Masukan nik lengkap!" name="nik_ibu"
                                                value="{{ old('nik_ibu') ? old('nik_ibu') : $ibu?->nik_ibu }}">
                                            @error('nik_ibu')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Tanggal lahir ibu --}}
                                        <div class="mb-4">
                                            <label for="tanggal-lahir-ibu" class="form-label">Tanggal Lahir
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="date"
                                                class="form-control @error('tanggal_lahir_ibu') is-invalid @enderror"
                                                id="tanggal-lahir-ibu" placeholder="Masukan tanggal lahir!"
                                                name="tanggal_lahir_ibu"
                                                value="{{ old('tanggal_lahir_ibu') ? old('tanggal_lahir_ibu') : $ibu?->tanggal_lahir_ibu }}">
                                            @error('tanggal_lahir_ibu')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Tempat lahir ibu --}}
                                        <div class="mb-4">
                                            <label for="tempat-lahir-ibu" class="form-label">Tempat Lahir
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('tempat_lahir_ibu') is-invalid @enderror"
                                                id="tempat-lahir-ibu" placeholder="Masukan tempat lahir!"
                                                name="tempat_lahir_ibu"
                                                value="{{ old('tempat_lahir_ibu') ? old('tempat_lahir_ibu') : $ibu?->tempat_lahir_ibu }}">
                                            @error('tempat_lahir_ibu')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Alamat ibu --}}
                                        <div class="mb-4">
                                            <label for="alamat_ibu" class="form-label">Alamat
                                                <span class="text-danger">*</span>
                                            </label>
                                            <textarea name="alamat_ibu" class="form-control @error('alamat_ibu') is-invalid @enderror" id="alamat_ibu"
                                                cols="30" rows="4" placeholder="Masukan alamat ibu!">{{ old('alamat_ibu') ? old('alamat_ibu') : $ibu?->alamat_ibu }}</textarea>
                                            @error('alamat_ibu')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Agama ibu --}}
                                        <div class="mb-4">
                                            <label for="agama_ibu" class="form-label">Agama
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="agama_ibu"
                                                class="form-control @error('agama_ibu') is-invalid @enderror"
                                                id="agama_ibu">
                                                <option value="">Pilih agama </option>
                                                @foreach ($agama as $agm)
                                                    <option {{ $agm->id == $ibu?->agama_ibu ? 'selected' : '' }}
                                                        value="{{ $agm->id }}">
                                                        {{ $agm->agama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('agama_ibu')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Kewarganegaraan ibu --}}
                                        <div class="mb-4">
                                            <label for="kewarganegaraan_ibu" class="form-label">Kewarganegaraan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('kewarganegaraan_ibu') is-invalid @enderror"
                                                placeholder="Contoh : WNI" name="kewarganegaraan_ibu"
                                                value="{{ $ibu?->kewarganegaraan_ibu }}">
                                            @error('kewarganegaraan_ibu')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Pendidikan ibu --}}
                                        <div class="mb-4">
                                            <label for="pendidikan_ibu" class="form-label">Pendidikan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-select @error('pendidikan_ibu') is-invalid @enderror"
                                                name="pendidikan_ibu" id="pendidikan_ibu">
                                                <option value="">Pilih pendidikan</option>
                                                @foreach ($pendidikan as $pdk)
                                                    <option {{ $pdk->id == $ibu?->pendidikan_ibu ? 'selected' : '' }}
                                                        value="{{ $pdk->id }}">
                                                        {{ $pdk->pendidikan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('pendidikan_ibu')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Pekerjaan ibu --}}
                                        <div class="mb-4">
                                            <label for="pekerjaan_ibu" class="form-label">Pekerjaan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('pekerjaan_ibu') is-invalid @enderror"
                                                placeholder="Contoh : Petani, PNS, Pengusaha" name="pekerjaan_ibu"
                                                value="{{ $ibu?->pekerjaan_ibu }}">
                                            @error('pekerjaan_ibu')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Penghasilan ibu --}}
                                        <div class="mb-4">
                                            <label for="penghasilan_ibu" class="form-label">Penghasilan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('penghasilan_ibu') is-invalid @enderror"
                                                placeholder="Contoh : 2.000.000" name="penghasilan_ibu"
                                                value="{{ $ibu?->penghasilan_ibu }}">
                                            @error('penghasilan_ibu')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Nomor telepon ibu --}}
                                        <div class="mb-4">
                                            <label for="telp_ibu" class="form-label">No telepon
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('telp_ibu') is-invalid @enderror"
                                                placeholder="Contoh : 089xxxxxxxxx" name="telp_ibu"
                                                value="{{ $ibu?->telp_ibu }}">
                                            @error('telp_ibu')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                            <p class="text-secondary mt-1" style="font-size: 12px;">
                                                Panjang nomor telepon maksimal 13 Karakter
                                            </p>
                                        </div>

                                        {{-- Status kematian ibu --}}
                                        <div class="mb-4">
                                            <label for="status_kematian_ibu" class="form-label">Status kematian
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="status_kematian_ibu"
                                                class="form-select @error('status_kematian_ibu') is-invalid @enderror"
                                                id="">
                                                @foreach ($kematian as $item)
                                                    <option
                                                        {{ $ibu?->status_kematian_ibu == $item || old('status_kematian_ibu') == $item ? 'selected' : '' }}
                                                        value="{{ $item }}">{{ $item }}</option>
                                                @endforeach
                                            </select>
                                            @error('status_kematian_ibu')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- Tombol Ubah --}}
                            <div class="container-fluid mt-2">
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
        // Notif untuk data yang berhasil diproses
        @if (session('sukses'))
            let pesan = "{{ session('sukses') }}"
            toastr.success(pesan)
        @endif
    </script>
@endpush
