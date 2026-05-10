<?php

namespace App\Exports;

use App\Models\Kelas;
use App\Models\KelolaSiswa;
use App\Models\Siswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class SiswaExport implements FromView, ShouldAutoSize
{

    protected $condition;

    function __construct($condition)
    {
        $this->condition = $condition;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $kelas = Kelas::urutanKelas();
        $kelasId = request('kelas') ?? $kelas->first()?->kelas_id;
        $tahunAjarId = session('tahun_ajar_id');
        return view('siswa.excel', [
            // 'siswa' => KelolaSiswa::cariDetail($this->condition, $kelas->first()?->kelas_id, $tahunAjarId)
            'siswa' => KelolaSiswa::exportSiswa()->where('kelas.id', $kelasId)
                ->where('kelola_siswa.tahun_ajar_id', $tahunAjarId)
                ->get()
        ]);
    }
}
