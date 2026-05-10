<!-- Content -->
@extends('layout.app')
@section('title', 'Riwayat Pendidikan')
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
                <div class="col-lg-10 mx-auto">
                    <div class="card p-lg-3 py-3 px-0 card-content">

                        {{-- Header Button --}}
                        <div class="d-flex mt-2 mb-3 px-2 justify-content-between">

                            <a href="{{ $menu == 'alumni' ? route('alumni', $url) : route('rekap', $url) }}"
                                class="btn btn-primary ms-2">
                                <i class="bi bi-arrow-left"></i>
                                Kembali
                            </a>

                            <span class="me-3 align-self-center">
                                Riwayat pendidikan
                            </span>

                        </div>

                        <div class="mt-2 mb-3">
                            @include('binduk.rekap.navtabs')
                        </div>
                        {{-- End --}}

                        {{-- Table Riwayat Pendidikan Desktop View --}}
                        {{-- Form content disini ! --}}
                        <form action="{{ route('rekap.form.pendidikan.update', $siswa->id) }}" method="post">
                            @csrf
                            @method('put')

                            <input type="hidden" value="{{ $menu }}" name="menu">
                            <input type="hidden" value="{{ request()->input('kelas') }}" name="kelas">
                            <input type="hidden" value="{{ request()->input('nama_siswa') }}" name="nama_siswa">
                            <input type="hidden" value="{{ $siswa->id }}" name="siswa_id">

                            {{-- Data Riwayat Pendidikan --}}
                            <div class="container-fluid mt-4">
                                <h5 class="fw-bold">Riwayat Pendidikan</h5>
                                <hr>
                                <div class="row">
                                    <div class="col">

                                        {{-- Jenjang Pendidikan --}}
                                        <div class="mb-4 mt-2">
                                            <label class="form-label" for="pendidikan_id">
                                                Jenjang Pendidikan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="pendidikan_id" id="pendidikan_id"
                                                class="form-control @error('pendidikan_id') is-invalid @enderror" required>
                                                @foreach ($pendidikan as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('pendidikan_id') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->pendidikan . ' ' . '( ' . $item->ket_pendidikan . ' )' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('pendidikan_id')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Nama Sekolah --}}
                                        <div class="mb-4 mt-2">
                                            <label class="form-label" for="nama_sekolah">
                                                Nama Sekolah
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('nama_sekolah') is-invalid @enderror"
                                                name="nama_sekolah" id="nama_sekolah" placeholder="Masukan nama sekolah!"
                                                required
                                                value="{{ old('nama_sekolah') ? old('nama_sekolah') : $ripen?->nama_sekolah }}">
                                            @error('nama_sekolah')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Alamat Sekolah --}}
                                        <div class="mb-4 mt-2">
                                            <label class="form-label" for="alamat_sekolah">
                                                Alamat Sekolah
                                                <span class="text-danger">*</span>
                                            </label>
                                            <textarea name="alamat_sekolah" class="form-control @error('alamat_sekolah') is-invalid @enderror" id="alamat_sekolah"
                                                cols="30" rows="3" placeholder="Masukan alamat sekolah" required>{{ old('alamat_sekolah') ? old('alamat_sekolah') : $ripen?->alamat_sekolah }}</textarea>
                                            @error('alamat_sekolah')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Tahun Lulus --}}
                                        <div class="mb-4 mt-2">
                                            <label class="form-label" for="tahun_lulus">
                                                Tahun Lulus
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="number" id="tahun_lulus"
                                                class="form-control @error('tahun_lulus') is-invalid @enderror"
                                                name="tahun_lulus" placeholder="Masukan tahun lulus!" required
                                                maxlength="4" oninput="maxLengthCheck(this)"
                                                value="{{ old('tahun_lulus') ? old('tahun_lulus') : $ripen?->tahun_lulus }}">
                                            @error('tahun_lulus')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Nomor Ijazah --}}
                                        <div class="mb-4 mt-2">
                                            <label class="form-label" for="no_ijazah">
                                                Nomor Ijazah
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" id="no_ijazah"
                                                class="form-control @error('no_ijazah') is-invalid @enderror"name="no_ijazah"
                                                placeholder="Masukan no ijazah!" required
                                                value="{{ old('no_ijazah') ? old('no_ijazah') : $ripen?->no_ijazah }}">
                                            @error('no_ijazah')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Tanggal Ijazah --}}
                                        <div class="mb-4 mt-2">
                                            <label class="form-label" for="tanggal_ijazah">
                                                Tanggal Ijazah
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="date" id="tanggal_ijazah"
                                                class="form-control @error('tanggal_ijazah') is-invalid @enderror"
                                                name="tanggal_ijazah" placeholder="Masukan tanggal ijazah!" required
                                                value="{{ old('tanggal_ijazah') ? old('tanggal_ijazah') : $ripen?->tanggal_ijazah }}">
                                            @error('tanggal_ijazah')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ ucwords($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Lama Belajar --}}
                                        <div class="mb-4 mt-2">
                                            <label class="form-label" for="lama_belajar">
                                                Lama Belajar
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="number" id="lama_belajar" oninput="maxLengthCheck(this)"
                                                required maxlength="3"
                                                class="form-control @error('lama_belajar') is-invalid @enderror"
                                                name="lama_belajar" placeholder="Masukan lama belajar!" required
                                                value="{{ old('lama_belajar') ? old('lama_belajar') : $ripen?->lama_belajar }}">
                                            @error('lama_belajar')
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
                        {{-- End --}}

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

        // Notif untuk data yang tidak lolos validasi
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.warning('{{ ucwords($error) }}');
            @endforeach
        @endif

        function maxLengthCheck(object) {
            if (object.value.length > object.maxLength) {
                object.value = object.value.slice(0, object.maxLength);
            }
        }
    </script>
@endpush
