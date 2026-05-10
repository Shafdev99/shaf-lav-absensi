<!-- Content -->
@extends('layout.app')
@section('title', 'Daftar Wali Kelas')
@section('content')
    <div class="content content-sm">

        <div class="container">

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                Wali Kelas
            </div>
            {{-- End --}}

            <div class="row mt-4">
                <div class="col-lg-10 col-md-6 col-12 mb-3 mx-auto">

                    <div class=" card p-lg-3 p-2 card-content">
                        {{-- Header Button --}}
                        <div class="d-flex mt-lg-2 mb-3 mb-lg-0 ">
                            {{-- <a class="btn btn-primary d-none d-lg-block d-md-block" href="javascript:void(0);"
                                onclick="addKelas()" aria-expanded="false">
                                <i class="bi bi-plus-lg"></i>
                                Tambah
                            </a> --}}
                            <h6>Daftar Wali Kelas</h6>
                        </div>
                        {{-- End --}}

                        {{-- Table wali kelas Desktop View --}}
                        <form action="{{ route('walkel.update') }}" method="POST">
                            @csrf

                            <table class="table d-none d-lg-table d-md-table desktop-table mt-4">
                                <tr class="tr-table">
                                    <th>No</th>
                                    <th>Kelas</th>
                                    <th>Jurusan</th>
                                    <th>Total Siswa</th>
                                    <th>Wali Kelas</th>
                                </tr>
                                @forelse ($kelas as $Kelas)

                                    <tr style="color: rgb(26, 26, 26);">
                                        <td>
                                            {{ $loop->iteration }}).
                                        </td>
                                        <td>
                                            <div class="badge badge-blobe px-3 pt-2">
                                                <h6>
                                                    {{ $Kelas->tingkat . ' ' . $Kelas->nama_jurusan . ' ' . $Kelas->nama_kelas }}
                                                </h6>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $Kelas->keterangan }}
                                        </td>
                                        <td style="padding-left: 20px;">
                                            {{ $Kelas->totalSiswa }} anak
                                        </td>
                                        <td>
                                            @php
                                                $walkelId = null;
                                                $guruId = null;
                                                foreach ($walkel as $Walkel) {
                                                    if ($Walkel->kelas_id == $Kelas->kelas_id) {
                                                        $walkelId = $Walkel->id;
                                                        $guruId = $Walkel->guru_id;
                                                    }
                                                }
                                            @endphp
                                            <input type="hidden" value="{{ $walkelId }}" name="walkel_id[]">
                                            <input type="hidden" value="{{ $Kelas->kelas_id }}" name="kelas_id[]">
                                            <select name="guru_id[]" class="form-select form-select-sm">
                                                <option value="">-- Pilih Wali Kelas --</option>
                                                @foreach ($guru as $Guru)
                                                    <option value="{{ $Guru->id }}"
                                                        {{ $guruId == $Guru->id ? 'selected' : '' }}>
                                                        {{ $Guru->nama_guru }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center border-0">
                                            <p class="text-center my-5 d-none d-md-inline d-lg-inline">Belum ada data wali
                                                kelas!
                                            </p>
                                        </td>
                                    </tr>
                                @endforelse
                            </table>
                            <button class="btn btn-primary float-end d-none d-lg-block" type="submit">
                                <i class="bi bi-send-fill me-1"></i>
                                Simpan
                            </button>
                        </form>

                        {{-- End --}}

                        {{-- Filter Button Mobile --}}
                        {{-- <form action="{{ route('walkel') }}" method="get" class="mb-3 d-lg-none">
                            <div class="input-group">
                                <select class="form-select form-select-sm me-2" style="width:auto;" name="tahun_ajar">

                                </select>

                                <button type="submit" class="btn btn-outline-secondary btn-default-2" type="button"
                                    id="button-addon2">
                                    <i class="bi bi-funnel me-1"></i>
                                    Filter
                                </button>
                            </div> --}}
                        </form>
                        {{-- End --}}

                        {{-- Table wali kelas Mobile View --}}
                        {{-- <form action="{{ route('walkel.update') }}" method="POST">
                            @csrf

                            @forelse ($kelas as $kls)
                                <div class="card mb-2 p-2 d-lg-none d-md-none">
                                    <div class="d-flex">
                                        <div class="d-inline">
                                        </div>
                                        <a href="javascript:void(0);" onclick="deleteKelas()"
                                            class="text-decoration-none text-danger ms-auto">
                                            <i class="me-1 bi bi-trash3-fill"></i>
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center mb-4 mt-3 d-lg-none d-md-none">Belum ada data wali kelas!</p>
                            @endforelse

                            <button class="btn btn-primary d-lg-none float-end my-2 me-2" type="submit">
                                <i class="bi bi-send-fill me-1"></i>
                                Simpan
                            </button>
                        </form> --}}
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

        @if (session('gagal'))
            let pesan = "{{ session('gagal') }}"
            toastr.warning(pesan)
        @endif

        // Notif untuk data yang tidak lolos validasi
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.warning('{{ ucwords($error) }}');
            @endforeach
        @endif
        // End
    </script>
@endpush
