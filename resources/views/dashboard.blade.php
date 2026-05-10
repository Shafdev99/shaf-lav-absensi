<!-- Content -->
@extends('layout.app')
@section('title', 'Dashboard')
@section('content')
    <div class="content" style="min-height: 82vh !important;">

        <div class="container ">

            <!-- Breadcrumb -->
            <div class="breadcrumb">
                {{-- <a href=""> Dashboard </a> / &nbsp; <a href=""> Halaman utama </a> / Sub halaman --}}
                Home
            </div>
            <h5>Beranda</h5>
            {{-- <div class="row">
                <div class="col-12 col-lg-6 mt-3">
                    <div class="card p-3 card-content">
                        <h6 class="fw-bold">Informasi Aplikasi</h6>
                        <p>
                            Selamat datang di dashboard <b>Shaf BISA</b>.
                            Shaf BISA adalah aplikasi Buku Induk Siswa berbasis website yang akan membantu memudahkan
                            proses pembuatan dan pencatatan buku induk siswa di sekolah.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-lg-6 mt-3">
                    <div class="card p-3 card-content">
                        <h6 class="fw-bold">Developer</h6>
                        <p>
                            Hai, Saya M. <b> Fila Shaufiq </b> selaku developer aplikasi ini. Terima kasih sudah menggunakan
                            aplikasi ini untuk mencatat Buku Induk Siswa di Sekolah anda. Semoga proses
                            pencatatan buku induk siswa bisa lebih efektif dan
                            efisien.
                        </p>
                    </div>
                </div>
            </div> --}}
            <div class="row">
                <div class="col-12 col-lg-3 mt-4">
                    <div class="card p-3 card-content">
                        <h6 class="text-secondary">Total Siswa</h6>
                        <div class="d-flex justify-content-between">
                            <div>
                                <span class=" d-block" style="font-size: 40px; font-weight: 600;">
                                    {{ $totalSiswa }}
                                </span>
                                <span class="text-primary fw-bold">Siswa & Siswi</span>
                            </div>
                            <div class="alert alert-primary py-2 px-3 me-2" style="margin-top: -10px; border-radius:10px;"
                                role="alert">
                                <i class="bi bi-person-check text-primary" style="font-size: 40px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3 mt-4">
                    <div class="card p-3 card-content">
                        <h6 class="text-secondary">{{ $ketPendaftar }}</h6>
                        <div class="d-flex justify-content-between">
                            <div>
                                <span class=" d-block" style="font-size: 40px; font-weight: 600;">
                                    {{ $totalPendaftar }}
                                </span>
                                <span class="text-success fw-bold">Siswa & Siswi</span>
                            </div>
                            <div class="alert alert-success py-2 px-3 me-2" style="margin-top: -10px; border-radius:10px;"
                                role="alert">
                                <i class="bi bi-person-down" style="font-size: 40px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3 mt-4">
                    <div class="card p-3 card-content">
                        <h6 class="text-secondary">Mutasi Siswa</h6>
                        <div class="d-flex justify-content-between">
                            <div>
                                <span class=" d-block" style="font-size: 40px; font-weight: 600;">
                                    {{ $totalMutasi }}
                                </span>
                                <span class="text-danger fw-bold">Siswa & Siswi</span>
                            </div>
                            <div class="alert alert-danger py-2 px-3 me-2" style="margin-top: -10px; border-radius:10px;"
                                role="alert">
                                <i class="bi bi-person-up" style="font-size: 40px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3 mt-4">
                    <div class="card p-3 card-content">
                        <h6 class="text-secondary">Total User</h6>
                        <div class="d-flex justify-content-between">
                            <div>
                                <span class=" d-block" style="font-size: 40px; font-weight: 600;">
                                    {{ $totalUser }}
                                </span>
                                <span class="text-secondary fw-bold">Pengguna</span>
                            </div>
                            <div class="alert alert-dark py-2 px-3 me-2" style="margin-top: -10px; border-radius:10px;"
                                role="alert">
                                <i class="bi bi-people" style="font-size: 40px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6 mt-4">
                    <div class="card p-3 card-content">
                        <h6 class="text-secondary">Mutasi Terbaru</h6>
                        <table class="table mt-3" width="100%">
                            <tbody>
                                <tr style="background-color: #cfe2ff; border-radius:20px;">
                                    <th width="5%">No</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th width="5%">Status</th>
                                </tr>
                                @forelse ($mutasi as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}).</td>
                                        <td>{{ $item->nama_lengkap }}</td>
                                        <td class="ps-2 fw-bold">
                                            {{ $item->tingkat . ' ' . $item->nama_kelas . ' ' . $item->nama_jurusan }}</td>
                                        <td class="align-middle">
                                            <div class="badge-keluar">
                                                <i class="bi bi-arrow-up-right me-1"></i>
                                                Keluar
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            <i class="bi bi-file-earmark-x d-block text-secondary"
                                                style="font-size: 7em;"></i>
                                            Data mutasi siswa belum ada!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-lg-6 mt-4">
                    <div class="card p-3 card-content">
                        <h6 class="text-secondary">Activity Log Terbaru</h6>
                        <table class="table d-table mt-3" width="100%">
                            <tbody>
                                <tr style="background-color: #cfe2ff; border-radius:20px;">
                                    <th width="5%">No</th>
                                    <th>Nama</th>
                                    <th class="d-none d-lg-table-cell d-md-table-cell">Role</th>
                                    <th width="25%">Log</th>
                                </tr>
                                @foreach ($aclog as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}).</td>
                                        <td>
                                            {{ $item->user->name }}
                                            <span
                                                class="badge d-inline d-lg-none d-md-none {{ $item->user->role ? 'badge-role-admin' : 'badge-role-user' }}">
                                                {{ ucwords($item->user->role) }}
                                            </span>
                                        </td>
                                        <td class="d-none d-lg-table-cell d-md-table-cell">{{ ucwords($item->user->role) }}
                                        </td>
                                        <td class="align-middle">
                                            @php
                                                $aktiv = explode(' ', $item->aktivitas);
                                            @endphp
                                            <span
                                                class="badge @if ($aktiv[0] == 'Tambah' || $aktiv[0] == 'Simpan') aclog-success @elseif($aktiv[0] == 'Ubah' || $aktiv[0] == 'Update') aclog-primary @else aclog-danger @endif ">
                                                {{ $item->aktivitas }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
