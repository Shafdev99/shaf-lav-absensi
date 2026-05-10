<?php

namespace App\Exports;

use App\Models\Kelas;
use App\Models\KelolaSiswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class templateImport implements FromView, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $kelas = Kelas::urutanKelas();
        $kelasId = request('kelas') ?? $kelas->first()?->kelas_id;
        $tahunAjarId = session('tahun_ajar_id');
        return view('siswa.template-import', [
            'siswa'      => KelolaSiswa::exportSiswa()
                ->where('kelas.id', $kelasId)
                ->where('kelola_siswa.tahun_ajar_id', $tahunAjarId)
                ->limit('2')
                ->get(),
        ]);
    }
}
