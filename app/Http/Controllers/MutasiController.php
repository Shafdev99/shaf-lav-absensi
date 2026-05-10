<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Mutasi;
use App\Models\Setting;
use App\Models\Tingkat;
use App\Models\TahunAjar;
use App\Models\KelolaSiswa;
use App\Services\MutasiService;

class MutasiController extends Controller
{
    //======== Terhubung ke MutasiService ========//
    protected $mutasiService;

    public function __construct(MutasiService $mutasiService)
    {
        $this->mutasiService = $mutasiService;
    }

    /** 
     * Mutasi Siswa
     */
    //======== Index Mutasi Siswa ========//
    public function mutasi()
    {
        $kelas = Kelas::urutanKelas();

        return view('binduk.mutasi.index', [
            'kelas' => $kelas->get(),
            'siswa' => KelolaSiswa::urutanSiswa()
                ->cariDetail(request(['kelas', 'nama_siswa']), $kelas->first()?->kelas_id, session('tahun_ajar_id'))
                ->paginate(10)
                ->withQueryString()
        ]);
    }

    public function mutasiSiswa($siswaId)
    {
        return view('binduk.mutasi.mutasi', [
            'siswa'         => Siswa::where('siswa.id', $siswaId)->getSiswaJoin()->first(),
            'tingkat'       => Tingkat::select('id', 'tingkat')->latest()->get(),
            'tahunAjar'     => TahunAjar::latest()->get(),
            'mutasi'        => Mutasi::where('siswa_id', $siswaId)->first()
        ]);
    }

    public function mutasiSiswaUpdate($siswaId)
    {
        $data = request()->validate([
            'nama_sekolah' => 'required',
            'tingkat_id'   => 'required',
            'tahun_ajar'   => 'required',
            'lampiran'     => 'file|max:1024|mimes:pdf'
        ], [
            'lampiran.max'     => 'size :attribute maksimal :max Kb!',
            'lampiran.mimes'   => 'format :attribute harus :values!'
        ]);

        $this->mutasiService->mutasiSiswaUpdate($siswaId, $data);


        $url = '?kelas=' . request()->input('kelas') . '&nama_siswa=' . request()->input('nama_siswa');

        return redirect()->route('mutasi.siswa', $siswaId . $url)->with('sukses', 'Data siswa berhasil diubah!');
    }

    public function cetakMutasiSiswa(Siswa $siswa)
    {
        // Mengolah HTML dan PHP menjadi pdf
        $mpdf = new \Mpdf\Mpdf();

        // Ambil data setting dari database
        $sekolah = Setting::first();

        return $this->mutasiService->cetakMutasiSiswa($siswa, $sekolah, $mpdf);
    }
}
