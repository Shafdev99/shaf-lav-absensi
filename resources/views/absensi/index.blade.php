{{-- Content --}}
@extends('layout.app')

@section('title', 'Absensi')

@section('content')
    <div class="content content-sm">

        <div class="container">

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                Absensi
            </div>
            {{-- End Breadcrumb --}}

            <div class="row mt-4">
                <div class="col-lg-7 col-md-12 col-12 mx-auto mt-3 mt-lg-0 mt-md-0">

                    <div class="card p-lg-3 p-2 card-content">

                        {{-- Header Button --}}
                        <div class="d-flex mt-lg-2 mb-3 mb-lg-0">

                            {{-- Tombol Buat Jadwal --}}
                            {{-- <a class="btn btn-primary d-none d-lg-block d-md-block me-2"
                                href="{{ route('proses.susun.jadwal') }}">
                                <i class="bi bi-arrow-repeat"></i>
                                Buat Jadwal
                            </a> --}}

                            {{-- Tombol Reset Jadwal --}}
                            {{-- <a href="{{ route('reset.jadwal') }}" class="btn btn-default-2 d-none d-lg-block d-md-block">
                                <i class="bi bi-x-circle"></i>
                                <span class="ms-1">
                                    Reset Jadwal
                                </span>
                            </a> --}}

                            <div class="d-inline d-lg-none ms-lg-auto align-self-center fw-bold">
                                <i class="bi bi-person-vcard-fill mx-2 d-lg-none" style="font-size: 16px;"></i>
                                Susun Jadwal
                            </div>

                        </div>
                        {{-- End Header Button --}}

                        {{-- Nav Tabs Hari --}}
                        <ul class="nav nav-tabs" id="myTab" role="tablist">

                            @foreach ($hari as $Hari)
                                <li class="nav-item mt-4 d-flex" role="presentation">

                                    <a href="{{ route('absensi', $Hari->id) }}"
                                        class="nav-link
                                        {{ request()->routeIs('absensi') &&
                                        (request()->route('hari_id') == $Hari->id || (!request()->route('hari_id') && $loop->first))
                                            ? 'active'
                                            : '' }}"
                                        id="hari-tab">

                                        {{ $Hari->nama_hari }}

                                    </a>

                                </li>
                            @endforeach

                        </ul>
                        {{-- End Nav Tabs --}}

                        {{-- Table --}}
                        <div class="table-responsive mt-3 desktop-table">

                            <table class="table align-middle">

                                <thead>
                                    <tr class="tr-table">
                                        <th colspan="2" class="text-center">
                                            Jadwal Pelajaran
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @php
                                        /*
                                        |--------------------------------------------------------------------------
                                        | FILTER HARI AKTIF
                                        |--------------------------------------------------------------------------
                                        */

                                        $jadwalHari = $susun_jadwal->where('hari_id', $hari_id);

                                        /*
                                        |--------------------------------------------------------------------------
                                        | GROUP BERDASARKAN KELAS
                                        |--------------------------------------------------------------------------
                                        */

                                        $groupedKelas = $jadwalHari->groupBy('kelas_id');
                                    @endphp

                                    @forelse ($groupedKelas as $kelasId => $jadwalKelas)

                                        @php
                                            /*
                                            |--------------------------------------------------------------------------
                                            | URUTKAN BERDASARKAN SESI
                                            |--------------------------------------------------------------------------
                                            */

                                            $jadwalKelas = $jadwalKelas->sortBy(function ($item) {
                                                return (int) $item->sesiPelajaran->sesi_pelajaran;
                                            });

                                            $kelas = $jadwalKelas->first();
                                        @endphp

                                        <tr>
                                            <td>

                                                <div class="row">

                                                    <a href="{{ route('absensi.siswa', ['guruPengampuId' => $guruPengampuId, 'hari_id' => $hari_id, 'kelas_id' => $kelasId]) }}"
                                                        class="text-decoration-none text-dark">
                                                        <div class="col-lg-12 col-md-6 col-12">

                                                            <div class="card bg-blobe p-3 my-3">

                                                                {{-- Nama Kelas --}}
                                                                <div class="d-flex align-items-center fs-6 fw-bold mb-2">

                                                                    {{ $kelas->tingkat }}
                                                                    {{ $kelas->nama_jurusan }}
                                                                    {{ $kelas->nama_kelas }}

                                                                </div>

                                                                {{-- Deskripsi --}}
                                                                <div class="mb-3">

                                                                    Silakan klik mapel ini untuk melakukan absensi!

                                                                </div>

                                                                {{-- List Jadwal --}}
                                                                @foreach ($jadwalKelas as $detail)
                                                                    <div class="card bg-blobe p-2 mb-2">

                                                                        {{-- Nomor Sesi --}}
                                                                        <div
                                                                            class="d-flex align-items-center fs-6 fw-bold mb-2">

                                                                            {{ $detail->sesiPelajaran->sesi_pelajaran }}

                                                                        </div>

                                                                        {{-- Jam --}}
                                                                        <div>

                                                                            {{ $detail->sesiPelajaran->jam_mulai }}

                                                                            -

                                                                            {{ $detail->sesiPelajaran->jam_selesai }}

                                                                        </div>

                                                                    </div>
                                                                @endforeach
                                                                {{-- End List Jadwal --}}

                                                            </div>

                                                        </div>
                                                    </a>

                                                </div>

                                            </td>
                                        </tr>

                                    @empty

                                        <tr>
                                            <td class="text-center py-4">

                                                Belum ada jadwal tersedia.

                                            </td>
                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>
                        {{-- End Table --}}

                    </div>

                </div>
            </div>

        </div>

    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        /*
                                                                                        |--------------------------------------------------------------------------
                                                                                        | NOTIF SUKSES
                                                                                        |--------------------------------------------------------------------------
                                                                                        */

        @if (session('sukses'))

            toastr.success(
                "{{ session('sukses') }}"
            );
        @endif

        /*
        |--------------------------------------------------------------------------
        | NOTIF VALIDASI
        |--------------------------------------------------------------------------
        */

        @if ($errors->any())

            @foreach ($errors->all() as $error)

                toastr.warning(
                    '{{ ucwords($error) }}'
                );
            @endforeach
        @endif
    </script>
@endpush
