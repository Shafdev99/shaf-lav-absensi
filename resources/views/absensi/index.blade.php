<!-- Content -->
@extends('layout.app')
@section('title', 'Absensi')
@section('content')
    <div class="content content-sm">

        <div class="container">

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                Absensi
            </div>
            {{-- End --}}

            <h5>
                {{ Auth::user()->id }}
            </h5>

            <div class="row mt-4">
                <div class="col-lg-12 col-md-6 col-12 mx-auto mt-3 mt-lg-0 mt-md-0">
                    <div class="card p-lg-3 p-2 card-content">
                        {{-- Header Button --}}
                        <div class="d-flex mt-lg-2 mb-3 mb-lg-0 ">
                            {{-- Tombol Buat Jadwal --}}
                            <a class="btn btn-primary d-none d-lg-block d-md-block me-2"
                                href="{{ route('proses.susun.jadwal') }}">
                                <i class="bi bi-arrow-repeat"></i>
                                Buat Jadwal
                            </a>

                            {{-- Tombol Reset Jadwal --}}
                            <a href="{{ route('reset.jadwal') }}" class="btn btn-default-2 d-none d-lg-block d-md-block">
                                <i class="bi bi-x-circle"></i>
                                <span class=" ms-1">
                                    Reset Jadwal
                                </span>
                            </a>

                            <div class="d-inline d-lg-none ms-lg-auto align-self-center fw-bold">
                                <i class="bi bi-person-vcard-fill mx-2 d-lg-none" style="font-size: 16px;"></i>
                                Susun Jadwal
                            </div>
                        </div>
                        {{-- End --}}

                        {{-- Table Susun Jadwal Desktop View --}}
                        {{-- Navtabs data Susun Jadwal --}}
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @foreach ($hari as $Hari)
                                <li class="nav-item mt-4 d-flex" role="presentation">
                                    <a href="{{ route('absensi', $Hari->id) }}"
                                        class="nav-link {{ request()->routeIs('absensi') && (request()->route('hari_id') == $Hari->id || (!request()->route('hari_id') && $loop->first)) ? 'active' : '' }}"
                                        id="hari-tab">
                                        {{ $Hari->nama_hari }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        {{-- End --}}
                        <div class="table-responsive mt-3 desktop-table">
                            <table class="table align-middle">
                                <thead>
                                    <tr class=" tr-table">
                                        {{-- <th>Sesi Pelajaran</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Selesai</th>
                                        <th>Zona Waktu</th>
                                        <th class="text-end">Aksi</th> --}}
                                        <th colspan="2" class="text-center">
                                            Jadwal Pelajaran
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $kelasId = null;
                                    @endphp
                                    @foreach ($susun_jadwal as $sd)
                                        @if ($sd->hari_id === $hari_id)
                                            @if ($sd->kelas->id !== $kelasId)
                                                <tr>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <div class="card bg-blobe p-3 mb-2">
                                                                    <div
                                                                        class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                                        {{ $sd->kelas->tingkat . '  ' . $sd->kelas->nama_jurusan . '  ' . $sd->kelas->nama_kelas }}
                                                                    </div>
                                                                    <div>
                                                                        Ini nanti muncul mapel yang diampu guru tersebut
                                                                        sesuai
                                                                        dengan jadwalnya, jika tidak ada mapel yang
                                                                        diampu
                                                                        maka
                                                                        tampilannya kosong seperti ini.
                                                                        {{-- @dump($sd->sesi_id) --}}
                                                                        @foreach ($susun_jadwal as $detail)
                                                                            @if ($detail->hari_id === $hari_id && $detail->kelas->id === $sd->kelas->id && $sd->kelas->id !== $kelasId)
                                                                                @foreach ($sesi_pelajaran as $sesi)
                                                                                    @if ($sesi->id === $detail->sesi_id)
                                                                                        <div class="card bg-blobe p-2 mb-2">
                                                                                            <div
                                                                                                class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                                                                {{ $sesi->sesi_pelajaran }}
                                                                                            </div>
                                                                                            <div>
                                                                                                {{ $sesi->jam_mulai . ' - ' . $sesi->jam_selesai }}
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endforeach
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </td>
                                                </tr>
                                                @php
                                                    $kelasId = $sd->kelas->id;
                                                @endphp
                                            @endif
                                        @endif
                                    @endforeach
                            </table>
                        </div>
                        {{-- End --}}
                        {{-- End --}}

                        {{-- Table Mapel Mobile View --}}
                        {{-- @forelse ($mapel as $row)
                            <div class="card mb-2 p-2 d-lg-none d-md-none">
                                <div class="d-flex">
                                    <div class="d-inline">
                                        <div>
                                            &nbsp;{{ $row->mapel }}
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" id="dropdownMenuButtonMobile" data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                        class="dropdown-toggle text-decoration-none text-dark ms-auto">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-tdesktop shadow"
                                        aria-labelledby="dropdownMenuButtonMobile">
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);"
                                                onclick="editMapel('{{ $row->id }}','{{ $row->mapel }}')">
                                                <i class="me-1 bi bi-pencil-square"></i>
                                                Ubah
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" onclick="deleteMapel('{{ $row->id }}')"
                                                class="dropdown-item">
                                                <i class="me-1 bi bi-trash3-fill"></i>
                                                Hapus
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @empty
                            <p class="text-center my-3 d-lg-none d-md-none">Belum ada data Mapel!</p>
                        @endforelse --}}
                        {{-- End --}}
                    </div>
                </div>
            </div>

            <div class="row mt-4">

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
        // End
    </script>
@endpush
