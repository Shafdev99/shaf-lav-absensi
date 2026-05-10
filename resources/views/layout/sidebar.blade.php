{{-- Home menu --}}
<a href="{{ route('beranda') }}">
    <div class="list-item {{ Request::is('beranda') ? 'active' : ' ' }}">
        <i class="bi bi-house-fill"></i>
        <span class="list-title">Beranda</span>
    </div>
</a>
{{-- Akhir --}}


{{-- **Menu Untuk Admin** --}}
@can('admin')
    {{-- Menu Data Master Collapse --}}
    <a data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"
        class="collapse-btn collapsed {{ Request::is('jurusan*') || Request::is('kelas*') || Request::is('tahun-ajar*') || Request::is('agama*') || Request::is('pendidikan*') || Request::is('semester*') || Request::is('lampiran*') || Request::is('mapel*') || Request::is('kurikulum*') || Request::is('sesi-pelajaran*') || Request::is('pengampu*') ? 'data-master' : ' ' }}"
        id="collapse-btn" onclick="rotate(this)">
        <div class="list-item d-flex justify-content-between">
            <div>
                <i class="bi bi-menu-button-wide"></i>
                <span class="list-title">Data Master</span>
            </div>
            <div class="drop-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-chevron-right ms-auto me-3 drop-icon-item" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                </svg>
            </div>
        </div>
    </a>



    {{-- Menu Kelas --}}
    <div class="collapse collapse-master" id="collapseExample">
        <a href="{{ route('kelas') }}">
            <div class="list-item {{ Request::is('kelas*') ? 'active' : ' ' }}">
                <i class="bi bi-door-closed-fill"></i>
                <span class="list-title">Kelas</span>
            </div>
        </a>
    </div>
    {{-- Akhir --}}



    {{-- Menu Mapel --}}
    <div class="collapse collapse-master" id="collapseExample">
        <a href="{{ route('mapel') }}">
            <div class="list-item {{ Request::is('mapel*') ? 'active' : ' ' }}">
                <i class="bi bi-journal-text"></i>
                <span class="list-title">Mapel</span>
            </div>
        </a>
    </div>
    {{-- Akhir --}}

    {{-- Menu Guru Mapel --}}
    <div class="collapse collapse-master" id="collapseExample">
        <a href="{{ route('pengampu') }}">
            <div class="list-item {{ Request::is('pengampu*') ? 'active' : ' ' }}">
                <i class="bi bi-person-video3"></i>
                <span class="list-title">Guru Mapel</span>
            </div>
        </a>
    </div>
    {{-- Akhir --}}

    {{-- Menu Sesi Pelajaran --}}
    <div class="collapse collapse-master" id="collapseExample">
        <a href="{{ route('sesi.pelajaran') }}">
            <div class="list-item {{ Request::is('sesi-pelajaran*') ? 'active' : ' ' }}">
                <i class="bi bi-clock"></i>
                <span class="list-title">Sesi Pelajaran</span>
            </div>
        </a>
    </div>
    {{-- Akhir --}}



    {{-- Menu Tahun Ajar --}}
    <div class="collapse collapse-master" id="collapseExample">
        <a href="{{ route('tahun.ajar') }}">
            <div class="list-item {{ Request::is('tahun-ajar*') ? 'active' : ' ' }}">
                <i class="bi bi-calendar-week"></i>
                <span class="list-title">Tahun Ajar</span>
            </div>
        </a>
    </div>
    {{-- Akhir --}}



    {{-- Menu Semester --}}
    <div class="collapse collapse-master" id="collapseExample">
        <a href="{{ route('semester') }}">
            <div class="list-item {{ Request::is('semester*') ? 'active' : ' ' }}">
                <i class="bi bi-book"></i>
                <span class="list-title">Semester</span>
            </div>
        </a>
    </div>
    {{-- Akhir --}}



    {{-- Menu Kurikulum --}}
    <div class="collapse collapse-master" id="collapseExample">
        <a href="{{ route('kurikulum') }}">
            <div class="list-item {{ Request::is('kurikulum*') ? 'active' : ' ' }}">
                <i class="bi bi-building-fill-gear"></i>
                <span class="list-title">Kurikulum</span>
            </div>
        </a>
    </div>
    {{-- Akhir --}}



    {{-- Menu Agama --}}
    <div class="collapse collapse-master" id="collapseExample">
        <a href="{{ route('agama') }}">
            <div class="list-item {{ Request::is('agama*') ? 'active' : ' ' }}">
                <i class="bi bi-person-standing"></i>
                <span class="list-title">Agama</span>
            </div>
        </a>
    </div>
    {{-- Akhir --}}



    {{-- Menu Pendidikan --}}
    <div class="collapse collapse-master" id="collapseExample">
        <a href="{{ route('pendidikan') }}">
            <div class="list-item {{ Request::is('pendidikan*') ? 'active' : ' ' }}">
                <i class="bi bi-buildings-fill"></i>
                <span class="list-title">Pendidikan</span>
            </div>
        </a>
    </div>
    {{-- Akhir --}}



    {{-- Menu Lampiran --}}
    <div class="collapse collapse-master" id="collapseExample">
        <a href="{{ route('lampiran') }}">
            <div class="list-item {{ Request::is('lampiran*') ? 'active' : ' ' }}">
                <i class="bi bi-files"></i>
                <span class="list-title">Lampiran</span>
            </div>
        </a>
    </div>
    {{-- Akhir --}}

    {{-- Akhir Collapse --}}
@endcan

{{-- Akhir Collapse --}}


{{-- **Menu Untuk Admin** --}}
@can('admin')
    {{-- Menu Guru --}}
    <a href="{{ route('guru') }}">
        <div class="list-item {{ Request::is('guru*') ? 'active' : ' ' }}">
            <i class="bi bi-person-badge"></i>
            <span class="list-title">Guru & Staff</span>
        </div>
    </a>
    {{-- Akhir --}}
@endcan


{{-- **Menu Untuk Staff Dan Admin** --}}
@can('staff_dan_admin')
    {{-- Menu Siswa --}}
    <a href="{{ route('siswa') }}">
        <div class="list-item {{ Request::is('siswa*') ? 'active' : ' ' }}">
            <i class="bi bi-backpack-fill"></i>
            <span class="list-title">Siswa</span>
        </div>
    </a>
    {{-- Akhir --}}
@endcan


{{-- **Menu Untuk Admin** --}}
@can('admin')
    {{-- Menu Naik Kelas --}}
    @if (session('semester') == 'genap')
        <a href="{{ route('siswa.naik') }}">
            <div class="list-item {{ Request::is('naik-kelas*') ? 'active' : ' ' }}">
                <i class="bi bi-building-fill-up"></i>
                <span class="list-title">Naik Kelas</span>
            </div>
        </a>
    @endif
    {{-- Akhir --}}

    {{-- Menu Wali Kelas --}}
    <a href="{{ route('walkel') }}">
        <div class="list-item {{ Request::is('walkel*') ? 'active' : ' ' }}">
            <i class="bi bi-person-vcard-fill"></i>
            <span class="list-title">Wali Kelas</span>
        </div>
    </a>
    {{-- Akhir --}}

    {{-- Menu Susun Jadwal --}}
    <a href="{{ route('susun.jadwal') }}">
        <div class="list-item {{ Request::is('susun-jadwal*') ? 'active' : ' ' }}">
            <i class="bi bi-calendar-week-fill"></i>
            <span class="list-title">Susun Jadwal</span>
        </div>
    </a>
    {{-- Akhir --}}
@endcan


{{-- **Menu Untuk Staff Dan Admin** --}}
@can('staff_dan_admin')
    {{-- Menu Pindah Kelas --}}
    {{-- <a href="{{ route('siswa.pindah') }}">
        <div class="list-item {{ Request::is('pindah-kelas*') ? 'active' : ' ' }}">
            <i class="bi bi-arrow-left-right"></i>
            <span class="list-title">Pindah Kelas</span>
        </div>
    </a> --}}
    {{-- Akhir --}}

    {{-- Menu Buku Induk Collapse --}}
    {{-- <a data-bs-toggle="collapse" href="#collapseBinduk" role="button" aria-expanded="false"
        aria-controls="collapseBinduk"
        class="collapse-btn collapsed {{ Request::is('rekap*') || Request::is('form-data*') || Request::is('mutasi*') ? 'data-binduk' : ' ' }}"
        id="collapse-btn-binduk" onclick="rotate(this)">
        <div class="list-item d-flex justify-content-between">
            <div>
                <i class="bi bi-journal-richtext"></i>
                <span class="list-title">Buku induk</span>
            </div>
            <div class="drop-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-chevron-right ms-auto me-3 drop-icon-item" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                </svg>
            </div>
        </div>
    </a> --}}

    {{-- Menu Mutasi Siswa --}}
    <div class="collapse collapse-binduk" id="collapseBinduk">
        <a href="{{ route('mutasi') }}">
            <div class="list-item {{ Request::is('mutasi*') ? 'active' : ' ' }}">
                <i class="bi bi-file-person"></i>
                <span class="list-title">Mutasi</span>
            </div>
        </a>
    </div>
    {{-- Akhir --}}

    {{-- Menu Rekap Data Siswa --}}
    <div class="collapse collapse-binduk" id="collapseBinduk">
        <a href="{{ route('rekap') }}">
            <div class="list-item {{ Request::is('rekap*') || Request::is('form-data*') ? 'active' : ' ' }}">
                <i class="bi bi-files"></i>
                <span class="list-title">Rekap</span>
            </div>
        </a>
    </div>
    {{-- Akhir --}}

    {{-- Akhir Collapse --}}

    {{-- Menu Alumni Kelas --}}
    <a href="{{ route('alumni') }}">
        <div class="list-item {{ Request::is('alumni*') ? 'active' : ' ' }}">
            <i class="bi bi-mortarboard-fill"></i>
            <span class="list-title">Alumni</span>
        </div>
    </a>
    {{-- Akhir --}}
@endcan


{{-- **Menu Untuk Admin** --}}
@can('admin')
    {{-- Menu Activity log --}}
    <a href="{{ route('log') }}">
        <div class="list-item {{ Request::is('activity-log*') ? 'active' : ' ' }}">
            <i class="bi bi-clock-history"></i>
            <span class="list-title">Riwayat</span>
        </div>
    </a>
    {{-- Akhir --}}
@endcan


{{-- Menu Absensi --}}
<a href="{{ route('absensi') }}">
    <div class="list-item {{ Request::is('absensi*') ? 'active' : ' ' }}">
        <i class="bi bi-calendar-check"></i>
        <span class="list-title">Absensi</span>
    </div>
</a>
{{-- Akhir --}}

{{-- Menu Profil --}}
<a href="{{ route('profil') }}">
    <div class="list-item {{ Request::is('profil*') ? 'active' : ' ' }}">
        <i class="bi bi-person-circle"></i>
        <span class="list-title">Profil</span>
    </div>
</a>
{{-- Akhir --}}


{{-- **Menu Untuk Admin** --}}
@can('admin')
    {{-- Menu Admin/User --}}
    <a href="{{ route('user') }}">
        <div class="list-item {{ Request::is('user*') ? 'active' : ' ' }}">
            <i class="bi bi-people-fill"></i>
            <span class="list-title position-relative">
                Pengguna
                @php
                    $request = DB::table('users')->select('request')->where('request', 'true');
                @endphp
                @if ($request->count() > 0)
                    <span class="badge rounded-pill bg-danger float-end me-2">
                        {{ $request->count() }}
                    </span>
                @endif
            </span>
        </div>
    </a>

    <a href="{{ route('transisi.semester') }}">
        <div class="list-item {{ Request::is('transisi-semester*') ? 'active' : ' ' }}">
            <i class="bi bi-layers-half"></i>
            <span class="list-title">Transisi Semester</span>
        </div>
    </a>

    {{-- Menu Admin/Setting --}}
    <a href="{{ route('setting') }}">
        <div class="list-item {{ Request::is('setting*') ? 'active' : ' ' }}">
            <i class="bi bi-gear-fill"></i>
            <span class="list-title">Pengaturan</span>
        </div>
    </a>
@endcan
{{-- **End Menu** --}}


{{-- **Menu Untuk Wali Kelas** --}}
@can('wali_kelas')
    <h6 class="list-head mt-4">
        Menu Wali Kelas
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            class="bi bi-box-fill ms-2" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.004-.001.274-.11a.75.75 0 0 1 .558 0l.274.11.004.001zm-1.374.527L8 5.962 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339Z" />
        </svg>
    </h6>

    {{-- Menu Siswa --}}
    <a href="{{ route('siswa') }}">
        <div class="list-item {{ Request::is('siswa*') ? 'active' : ' ' }}">
            <i class="bi bi-backpack-fill"></i>
            <span class="list-title">Siswa</span>
        </div>
    </a>
    {{-- Akhir --}}

    {{-- Menu Naik Kelas --}}
    @if (session('semester') == 'genap')
        <a href="{{ route('siswa.naik') }}">
            <div class="list-item {{ Request::is('naik-kelas*') ? 'active' : ' ' }}">
                <i class="bi bi-building-fill-up"></i>
                <span class="list-title">Naik Kelas</span>
            </div>
        </a>
    @endif
    {{-- Akhir --}}


    {{-- Menu Buku Induk Collapse --}}
    <a data-bs-toggle="collapse" href="#collapseBinduk" role="button" aria-expanded="false"
        aria-controls="collapseBinduk"
        class="collapse-btn collapsed {{ Request::is('rekap*') || Request::is('form-data*') || Request::is('mutasi*') ? 'data-binduk' : ' ' }}"
        id="collapse-btn-binduk" onclick="rotate(this)">
        <div class="list-item d-flex justify-content-between">
            <div>
                <i class="bi bi-journal-richtext"></i>
                <span class="list-title">Buku induk</span>
            </div>
            <div class="drop-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-chevron-right ms-auto me-3 drop-icon-item" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                </svg>
            </div>
        </div>
    </a>

    {{-- Menu Mutasi Siswa --}}
    <div class="collapse collapse-binduk" id="collapseBinduk">
        <a href="{{ route('mutasi') }}">
            <div class="list-item {{ Request::is('mutasi*') || Request::is('form-data*') ? 'active' : ' ' }}">
                <i class="bi bi-file-person"></i>
                <span class="list-title">Mutasi</span>
            </div>
        </a>
    </div>
    {{-- Akhir --}}

    {{-- Menu Rekap Data Siswa --}}
    <div class="collapse collapse-binduk" id="collapseBinduk">
        <a href="{{ route('rekap') }}">
            <div class="list-item {{ Request::is('rekap*') || Request::is('form-data*') ? 'active' : ' ' }}">
                <i class="bi bi-files"></i>
                <span class="list-title">Rekap</span>
            </div>
        </a>
    </div>
    {{-- Akhir --}}

    {{-- Akhir Collapse --}}
@endcan
{{-- **End Menu** --}}


<a href="javascript:void(0);" onclick="slide()" data-bs-toggle="modal" data-bs-target="#modalLogout">
    <div class="list-item">
        <i class="bi bi-box-arrow-right"></i>
        <span class="list-title">Keluar</span>
    </div>
</a>
