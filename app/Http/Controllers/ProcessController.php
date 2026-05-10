<?php

namespace App\Http\Controllers;

use App\Models\Aclog;
use App\Models\Kelas;
use App\Models\Alumni;
use App\Models\Tingkat;
use App\Models\RekapSpmb;
use App\Models\TahunAjar;
use App\Models\KelolaSiswa;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Services\ProcessService;
use Illuminate\Support\Facades\Auth;


class ProcessController extends Controller
{

    //======== Terhubung ke ProcessService ========//
    protected $processService;

    public function __construct(ProcessService $processService)
    {
        $this->processService = $processService;
    }


    /** 
     * Naik Kelas
     */
    //======== Index Naik Kelas ========//
    public function naikKelas()
    {
        $kelasId = Kelas::urutanKelas()->first()?->kelas_id;

        $tahun_ajarId = session('tahun_ajar_id');

        $tahunAjarNextId = TahunAjar::where('id', $tahun_ajarId)
            ->whereNot(
                'semester',
                session('semester')
            )->first()?->id;

        $siswa = KelolaSiswa::urutanSiswa()
            ->cariDetail(
                request(['kelas', 'nama_siswa']),
                $kelasId,
                $tahun_ajarId
            );

        $tingkatSaatIni = null;
        $jurusanSaatIni = null;

        foreach ($siswa->get() as $item) {
            $tingkatSaatIni = $item?->tingkat;
            $jurusanSaatIni = $item?->nama_jurusan;
        }

        $tingkatNaikKelas = Tingkat::pluck('tingkat')->after($tingkatSaatIni);

        return view('siswa.naik-kelas', [
            'naikKelas'     => ['Naik Kelas', 'Tinggal Kelas'],
            'lulusSekolah'  => ['Lulus Sekolah', 'Tidak Lulus'],
            'kelas'         => Kelas::urutanKelas()->get(),
            'alumni'        => Alumni::urutanSiswa()
                ->cariDetail(
                    request([
                        'kelas',
                        'nama_siswa'
                    ]),
                    $kelasId,
                    $tahunAjarNextId
                )
                ->get(),
            'siswaNaik'     => KelolaSiswa::urutanSiswa()
                ->cariDetail(
                    request([
                        'kelas',
                        'nama_siswa'
                    ]),
                    $kelasId,
                    $tahunAjarNextId
                )
                ->get(),
            'siswa'         => $siswa->paginate(10)->withQueryString(),
            'pilihKelas'    => Kelas::tampilKelas()
                ->where('nama_jurusan', $jurusanSaatIni)
                ->where('tingkat', $tingkatNaikKelas)
                ->orderBy('tingkat', 'asc')
                ->orderBy('nama_jurusan', 'asc')
                ->orderBy('nama_kelas', 'asc')
                ->get()
        ]);
    }

    //======== Proses Naik Kelas ========//
    public function prosesNaikKelas(Request $request)
    {
        $TahunAjarId = TahunAjar::select('id')->where('')->latest('tahun_ajar')->first()->id;

        if ($request->input('kelas_id') == null) {
            for ($i = 0; $i < count($request->input('siswa_id')); $i++) {
                if ($request->input('status_kenaikan_kelas')[$i] == 'Lulus Sekolah') {
                    Alumni::updateOrCreate(
                        [
                            'siswa_id'      => $request->input('siswa_id')[$i],
                            'tahun_ajar_id' => session('tahun_ajar_id'),
                        ],
                        [
                            'kelas_id'      => $request->input('kelas_saat_ini')[$i],
                        ]
                    );

                    Siswa::where('id', $request->input('siswa_id')[$i])->update([
                        'status' => 'alumni'
                    ]);
                } else {
                    KelolaSiswa::updateOrCreate([
                        'siswa_id'      => $request->input('siswa_id')[$i],
                        'tahun_ajar_id' => $TahunAjarId,
                    ], [
                        'kelas_id'      => $request->input('kelas_saat_ini')[$i],
                    ]);
                }
            }
        } else {
            for ($i = 0; $i < count($request->input('siswa_id')); $i++) {
                if ($request->input('status_kenaikan_kelas')[$i] == 'Naik Kelas') {
                    KelolaSiswa::updateOrCreate([
                        'siswa_id' => $request->input('siswa_id')[$i],
                        'tahun_ajar_id'     => $TahunAjarId,
                    ], [
                        'kelas_id'          => $request->input('kelas_id'),
                    ]);
                } else {
                    KelolaSiswa::updateOrCreate([
                        'siswa_id'          => $request->input('siswa_id')[$i],
                        'tahun_ajar_id'     => $TahunAjarId,
                    ], [
                        'kelas_id'          => $request->input('kelas_saat_ini')[$i],
                    ]);
                }
            }
        }

        $url = 'kelas=' . $request->input('kelas') . '&nama_siswa=' . $request->input('nama_siswa');

        // Alihkan ke halamam siswa //
        return redirect()->route('siswa.naik', $url)->with('sukses', 'Perubahan naik kelas atau lulus sekolah berhasil disimpan!');
    }


    /** 
     * Activity Log 
     */
    //======== View Aclog ========//
    public function activityLog()
    {
        if (Auth::user()->role == 'admin') {
            $aclog = Aclog::cari(request(['keyword']))->latest()->paginate(10);
        } else {
            $aclog = Aclog::whereRelation('user', 'role', 'user')->cari(request(['keyword']))->latest()->paginate(10);
        }

        return view('aclog.index', [
            'aclog' => $aclog
        ]);
    }
}
