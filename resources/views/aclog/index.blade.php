<!-- Content -->
@extends('layout.app')
@section('title', 'Riwayat Aktivitas')
@section('content')
    <div class="content content-sm">

        <div class="container">

            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                Riwayat Aktivitas
            </div>
            {{-- End --}}

            {{-- <h5>Riwayat Aktivitas</h5> --}}
            <div class="row mt-4">
                <div class="col">
                    <div class="card p-lg-3 p-2 card-content">
                        {{-- Header Button --}}
                        <div class="d-flex mt-2 mb-3 mb-lg-0">
                            <h5 class="d-none d-lg-block d-md-block">
                                <i class="bi bi-journal-text"></i>
                                Riwayat Aktivitas
                            </h5>

                            {{-- Search Button --}}
                            <form action="{{ route('log') }}" method="get" class="ms-lg-auto me-2 ">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm form-default"
                                        placeholder="Cari nama siswa" aria-describedby="button-addon2" name="keyword"
                                        value="{{ request('keyword') }}">
                                    <button type="submit" class="btn btn-default-2" type="button" id="button-addon2">
                                        Cari
                                    </button>
                                </div>
                            </form>
                            {{-- End --}}

                            <a href="{{ route('log') }}" class="btn btn-default-2 ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-arrow-clockwise ms-1" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z" />
                                    <path
                                        d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466" />
                                </svg>
                                <span class="d-none d-lg-inline d-md-inline ms-1">
                                    Refresh
                                </span>
                            </a>

                        </div>
                        {{-- End --}}

                        {{-- Table Aclog Desktop View --}}
                        @if (request('keyword') && !$aclog->items())
                            <p class="text-center my-5 d-none d-md-inline d-lg-inline">Data yang anda cari tidak ada!
                            @elseif(empty($aclog->items()))
                            <p class="text-center my-5 d-none d-md-inline d-lg-inline">Belum ada data aclog!</p>
                        @else
                            <table class="table desktop-table mt-4 table-responsive d-none d-lg-table d-md-table">
                                <tr class="tr-table">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Aktivitas</th>
                                    <th>Deskripsi</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                </tr>
                                @foreach ($aclog as $item)
                                    <tr style="color: rgb(26, 26, 26);">
                                        <td>{{ $loop->iteration }}).</td>
                                        <td class="d-flex">
                                            <img src="{{ $item->user?->foto_profil ? asset('storage/' . $item->user->foto_profil) : asset('storage/image/profil/profile.jpg') }}"
                                                class="d-none d-lg-block img-fluid rounded-pill img-user align-self-center me-3"
                                                alt="user-photo">
                                            <div class="d-inline">
                                                <div class="fs-nama">{{ $item->user->name }}</div><br>
                                                <span
                                                    class="badge {{ $item->user->role ? 'badge-role-admin' : 'badge-role-user' }}">
                                                    {{ ucwords($item->user->role) }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                                $aktiv = explode(' ', $item->aktivitas);
                                            @endphp
                                            <span
                                                class="badge  @if ($aktiv[0] == 'Tambah' || $aktiv[0] == 'Simpan') aclog-success @elseif($aktiv[0] == 'Update' || $aktiv[0] == 'Ubah') aclog-primary @else aclog-danger @endif ">
                                                {{ $item->aktivitas }}
                                            </span>
                                        </td>
                                        <td>{{ $item->deskripsi }} <b>"{{ $item->objek }}"</b></td>
                                        <td>
                                            <span>
                                                <i class="bi bi-calendar3 me-1"></i>

                                                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <i class="bi bi-stopwatch me-1"></i>
                                                {{ $item->waktu }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach

                            </table>
                        @endif
                        {{-- End --}}

                        {{-- Table aclog Mobile View --}}
                        @if (request('keyword') && !$aclog->items())
                            <p class="text-center my-3 d-lg-none d-md-none">Data yang anda cari tidak ada!</p>
                        @elseif(!$aclog->items())
                            <p class="text-center my-3 d-lg-none d-md-none">Belum ada data aclog!</p>
                        @else
                            @foreach ($aclog as $item)
                                <div class="card mb-2 p-2 d-lg-none d-md-none">
                                    <div class="d-flex">
                                        <img src="{{ $item->user?->foto_profil ? asset('storage/' . $item->user->foto_profil) : asset('img/logo/profile.jpg') }}"
                                            class="img-fluid rounded-pill img-user align-self-center me-3" alt="user-photo">
                                        <div class="d-inline">
                                            <div class="fs-nama">{{ $item->user->name }}</div><br>
                                            <span
                                                class="badge {{ $item->user->role ? 'badge-role-admin' : 'badge-role-user' }}">
                                                {{ ucwords($item->user->role) }}
                                            </span> |
                                            @php
                                                $aktiv = explode(' ', $item->aktivitas);
                                            @endphp
                                            <span
                                                class="badge  @if ($aktiv[0] == 'Tambah' || $aktiv[0] == 'Simpan') aclog-success @elseif($aktiv[0] == 'Update' || $aktiv[0] == 'Ubah') aclog-primary @else aclog-danger @endif ">
                                                {{ $item->aktivitas }}
                                            </span>
                                        </div>
                                        <a href="javascript:void(0);" id="dropdownMenuButtonMobile"
                                            data-bs-toggle="dropdown" aria-expanded="false"
                                            class="dropdown-toggle text-decoration-none text-dark ms-auto">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-tdesktop shadow"
                                            aria-labelledby="dropdownMenuButtonMobile">
                                            <li>
                                                <span class="dropdown-item fs-6 text-wrap">
                                                    <i class="bi bi-clipboard-check-fill me-1"></i>
                                                    {{ $item->deskripsi }} <b>"{{ $item->objek }}"</b>
                                                </span>
                                            </li>
                                            <li>
                                                <span class="dropdown-item">
                                                    <i class="bi bi-calendar3 me-1"></i>
                                                    {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                                                </span>
                                            </li>
                                            <li>
                                                <span class="dropdown-item">
                                                    <i class="bi bi-stopwatch me-1"></i>
                                                    {{ $item->waktu }}
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        {{-- End --}}

                        {{-- Pagination --}}
                        {{ $aclog->links() }}
                        {{-- End --}}
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
