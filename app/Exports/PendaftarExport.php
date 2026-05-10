<?php

namespace App\Exports;

use App\Models\Pendaftar;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class PendaftarExport implements FromView, ShouldAutoSize
{

    // protected $condition;

    // function __construct($condition)
    // {
    //     $this->condition = $condition;
    // }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('spmb.excel', [
            // 'pendaftar' => Pendaftar::cariDetail($this->condition)->export()
            'pendaftar' => Pendaftar::with('religion', 'jurusan', 'berkas', 'ayah', 'ibu', 'wali', 'keterangan')
                ->cariPendaftar()->get()
        ]);
    }
}
