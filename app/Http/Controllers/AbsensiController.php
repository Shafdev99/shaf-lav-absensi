<?php

namespace App\Http\Controllers;


use App\Models\GuruPengampu;
use App\Models\Hari;
use App\Models\Kelas;
use App\Models\SesiPelajaran;
use App\Models\SusunJadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function index($hari_id = null)
    {
        $query = SesiPelajaran::select('id', 'sesi_pelajaran', 'jam_mulai', 'jam_selesai', 'zona_waktu');
        $hari_id_default = Hari::select('id')->orderByRaw("CASE nama_hari WHEN 'Senin' THEN 1 WHEN 'Selasa' THEN 2 WHEN 'Rabu' THEN 3 WHEN 'Kamis' THEN 4 WHEN 'Jumat' THEN 5 WHEN 'Sabtu' THEN 6 WHEN 'Minggu' THEN 7 ELSE 8 END, nama_hari ASC")->first();

        if ($hari_id) {
            $query->where('hari_id', $hari_id);
        } else {
            $query->where('hari_id', $hari_id_default ? $hari_id_default->id : null);
        }

        $guruPengampuId = GuruPengampu::join('guru', 'guru_pengampu.guru_id', '=', 'guru.id')
            ->join('user_guru', 'guru.id', '=', 'user_guru.guru_id')
            ->where('user_guru.user_id', Auth::user()->id)
            ->value('guru_pengampu.id');
        // dd($guruPengampuId);

        return view('absensi.index', [
            'susun_jadwal' => SusunJadwal::with(['kelas'])
                ->where('guru_pengampu_id', $guruPengampuId)
                ->where('hari_id', $hari_id ? $hari_id : ($hari_id_default ? $hari_id_default->id : null))
                // ->groupBy('kelas_id')
                ->get(),
            'hari' => Hari::select('id', 'nama_hari')->orderByRaw("CASE nama_hari WHEN 'Senin' THEN 1 WHEN 'Selasa' THEN 2 WHEN 'Rabu' THEN 3 WHEN 'Kamis' THEN 4 WHEN 'Jumat' THEN 5 WHEN 'Sabtu' THEN 6 WHEN 'Minggu' THEN 7 ELSE 8 END, nama_hari ASC")->get(),
            'sesi_pelajaran' => $query->get(),
            // 'kelas' => Kelas::tampilKelas()->get(),
            'guru_pengampu' => GuruPengampu::with(['guru', 'mapel'])->get()->makeHidden(['created_at', 'updated_at']),
            'hari_id' => $hari_id ? $hari_id : ($hari_id_default ? $hari_id_default->id : null),
        ]);
    }
}
