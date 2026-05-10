<?php

namespace App\Http\Controllers;

use App\Models\KelolaSiswa;
use App\Models\Semester;
use App\Models\TahunAjar;
use Illuminate\Http\Request;

class TransisiSemester extends Controller
{
    public function index()
    {
        if (session('semester') == 'ganjil') {
            $periode  = session('tahun_ajar');
            $semester = 'genap';
        } else {
            $pecah    = explode('/', session('tahun_ajar'));
            $periode  = $pecah[0] + 1 . '/' . $pecah[1] + 1;
            $semester = 'ganjil';
        }
        $tahunAjar = TahunAjar::select('id', 'tahun_ajar', 'semester')->where('tahun_ajar', $periode)->where('semester', $semester)->first();
        return view('transisi.index', [
            'periode' => $tahunAjar,
            'indikasi' => KelolaSiswa::select('siswa_id')->where('tahun_ajar_id', $tahunAjar->id)->count()
        ]);
    }

    public function prosesTransisi($tahunAjarBaruId)
    {
        $tahunAjarId       = session('tahun_ajar_id');
        $kelolaSiswa       = KelolaSiswa::select('siswa_id', 'kelas_id')->where('tahun_ajar_id', $tahunAjarId)->get();
        $tahunAjarTransisi = TahunAjar::select('tahun_ajar', 'semester')->where('id', $tahunAjarBaruId)->first();
        // dump($id);
        // dd($kelolaSiswa);
        foreach ($kelolaSiswa as $item) {
            KelolaSiswa::create([
                'siswa_id'      => $item->siswa_id,
                'kelas_id'      => $item->kelas_id,
                'tahun_ajar_id' => $tahunAjarBaruId,
            ]);
        }
        request()->session()->put('tahun_ajar_transisi', $tahunAjarTransisi?->tahun_ajar);
        request()->session()->put('semester_transisi', $tahunAjarTransisi?->semester);
        return to_route('transisi.semester')->with('sukses', 'Proses Transisi Semester berhasil!');
    }
}
