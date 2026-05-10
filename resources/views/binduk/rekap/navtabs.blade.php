{{-- Identitas Siswa --}}
<div class="alert alert-primary mx-3" role="alert">
    <div class="d-flex justify-content-between mb-2">
        <h5 class="py-0">
            {{ $siswa->nama_lengkap }}
        </h5>
        <div class="fw-bold">
            @switch($siswa->status)
                @case('aktif')
                    <i class="bi bi-person-fill-check"></i>
                    {{ $siswa->status }}
                @break

                @case('alumni')
                    <i class="bi bi-mortarboard-fill"></i>
                    {{ $siswa->status }}
                @break

                @case('pindah')
                    <i class="bi bi-building-fill-up"></i>
                    {{ $siswa->status }}
                @break

                <i class="bi bi-person-fill-x"></i>
                {{ $siswa->status }}

                @default
            @endswitch
        </div>

    </div>
    <span>
        <b>
            NIS : {{ $siswa->nis }}
        </b>
        <br>
        {{ $siswa->tingkat . ' ' . $siswa->nama_jurusan . ' ' . $siswa->nama_kelas }}
        |
        {{ $siswa->tahun_ajar }}
    </span>
</div>
{{-- End --}}

{{-- Navtabs data pelengkap siswa --}}
<ul class="nav nav-tabs ms-3" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a href="{{ $menu == 'alumni' ? route('alumni.form.siswa', $siswa->id . '?' . $url) : route('rekap.form.siswa', $siswa->id . '?' . $url) }}"
            class="nav-link {{ Request::is('form-data/siswa/*') || Request::is('alumni/form-data/siswa/*') ? 'active' : '' }}"
            id="siswa-tab">
            Siswa
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="{{ $menu == 'alumni' ? route('alumni.form.biodata', $siswa->id . '?' . $url) : route('rekap.form.biodata', $siswa->id . '?' . $url) }}"
            class="nav-link {{ Request::is('form-data/biodata/*') || Request::is('alumni/form-data/biodata/*') ? 'active' : '' }}"
            id="biodata-tab">
            Biodata
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="{{ $menu == 'alumni' ? route('alumni.form.ortu', $siswa->id . '?' . $url) : route('rekap.form.ortu', $siswa->id . '?' . $url) }}"
            class="nav-link {{ Request::is('form-data/ortu/*') || Request::is('alumni/form-data/ortu/*') ? 'active' : '' }}"
            id="orang-tua-tab">
            Orang Tua
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="{{ $menu == 'alumni' ? route('alumni.form.walmur', $siswa->id . '?' . $url) : route('rekap.form.walmur', $siswa->id . '?' . $url) }}"
            class="nav-link {{ Request::is('form-data/walmur/*') || Request::is('alumni/form-data/walmur/*') ? 'active' : '' }}"
            id="wali-murid-tab">
            Wali Murid
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="{{ $menu == 'alumni' ? route('alumni.form.pendidikan', $siswa->id . '?' . $url) : route('rekap.form.pendidikan', $siswa->id . '?' . $url) }}"
            class="nav-link {{ Request::is('form-data/pendidikan/*') || Request::is('alumni/form-data/pendidikan/*') ? 'active' : '' }}"
            id="pendidikan-tab">
            Pendidikan
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="{{ $menu == 'alumni' ? route('alumni.form.kesehatan', $siswa->id . '?' . $url) : route('rekap.form.kesehatan', $siswa->id . '?' . $url) }}"
            class="nav-link {{ Request::is('form-data/kesehatan/*') || Request::is('alumni/form-data/kesehatan/*') ? 'active' : '' }}"
            id="kesehatan-tab">
            Kesehatan
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="{{ $menu == 'alumni' ? route('alumni.form.minat', $siswa->id . '?' . $url) : route('rekap.form.minat', $siswa->id . '?' . $url) }}"
            class="nav-link {{ Request::is('form-data/minat/*') || Request::is('alumni/form-data/minat/*') ? 'active' : '' }}"
            id="minat-tab">
            Minat
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="{{ $menu == 'alumni' ? route('alumni.form.beasiswa', $siswa->id . '?' . $url) : route('rekap.form.beasiswa', $siswa->id . '?' . $url) }}"
            class="nav-link {{ Request::is('form-data/beasiswa/*') || Request::is('alumni/form-data/beasiswa/*') ? 'active' : '' }}"
            id="beasiswa-tab">
            Beasiswa
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="{{ $menu == 'alumni' ? route('alumni.form.prestasi', $siswa->id . '?' . $url) : route('rekap.form.prestasi', $siswa->id . '?' . $url) }}"
            class="nav-link {{ Request::is('form-data/prestasi/*') || Request::is('alumni/form-data/prestasi/*') ? 'active' : '' }}"
            id="prestasti-tab">
            Prestasi
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="{{ $menu == 'alumni' ? route('alumni.form.lampiran', $siswa->id . '?' . $url) : route('rekap.form.lampiran', $siswa->id . '?' . $url) }}"
            class="nav-link {{ Request::is('form-data/lampiran/*') || Request::is('alumni/form-data/lampiran/*') ? 'active' : '' }}"
            id="lampiran-tab">
            Lampiran
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="{{ $menu == 'alumni' ? route('alumni.form.nilai', $siswa->id . '?' . $url) : route('rekap.form.nilai', $siswa->id . '?' . $url) }}"
            class="nav-link {{ Request::is('form-data/nilai/*') || Request::is('alumni/form-data/nilai/*') ? 'active' : '' }}"
            id="nilai-tab">
            Nilai Rapor
        </a>
    </li>
</ul>
{{-- End --}}
