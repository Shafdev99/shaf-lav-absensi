<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\KelolaSiswa;
use App\Models\KeteranganKeterima;
use Illuminate\Http\Request;

class PindahKelasController extends Controller
{
    public function prosesPindahKelas(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|array',
            'kelas_id' => 'required',
        ]);

        $siswaIds = $request->input('siswa_id');
        $kelasId = $request->input('kelas_id');

        $kelas = Kelas::select('jurusan_id', 'tingkat_id')
            ->where('id', $kelasId)
            ->firstOrFail();

        KelolaSiswa::whereIn('siswa_id', $siswaIds)
            ->update([
                'kelas_id' => $kelasId
            ]);

        KeteranganKeterima::whereIn('siswa_id', $siswaIds)
            ->update([
                'kelas_id' => $kelasId,
                'jurusan_id' => $kelas?->jurusan_id,
                'tingkat_id' => $kelas?->tingkat_id,
            ]);

        return to_route('siswa')->with('success', 'Siswa berhasil dipindahkan ke kelas baru.');
    }
}
