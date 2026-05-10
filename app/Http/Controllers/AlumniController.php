<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Alumni;
use App\Models\TahunAjar;

class AlumniController extends Controller
{
    public function index()
    {
        $kelas = Alumni::kelas();
        $kelasId = request('kelas_id') ? request('kelas_id') : $kelas->first()?->id;
        $tahunAjar = TahunAjar::select('id', 'tahun_ajar')->where('semester', 'genap');
        $tahunAjarRaw = $tahunAjar->latest('tahun_ajar')->get();
        $tahunAjarId = request('tahun_ajar_id') ? request('tahun_ajar_id') : $tahunAjar->first()->id;

        // dump($kelasId);

        return view('alumni.index', [
            'kelas'     => $kelas->get(),
            'tahunAjar' => $tahunAjarRaw,
            'alumni'    => Alumni::urutanSiswa()
                ->paginate(10)
                ->withQueryString()
        ]);
    }
}
