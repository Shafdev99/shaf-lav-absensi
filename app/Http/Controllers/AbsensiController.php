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

        return view('absensi.index', [
            'susun_jadwal' => SusunJadwal::join(
                'kelas',
                'susun_jadwal.kelas_id',
                '=',
                'kelas.id'
            )
                ->join(
                    'tingkat',
                    'kelas.tingkat_id',
                    '=',
                    'tingkat.id'
                )
                ->join(
                    'jurusan',
                    'kelas.jurusan_id',
                    '=',
                    'jurusan.id'
                )
                ->join(
                    'sesi_pelajaran',
                    'susun_jadwal.sesi_id',
                    '=',
                    'sesi_pelajaran.id'
                )

                ->where(
                    'guru_pengampu_id',
                    $guruPengampuId
                )

                ->where(
                    'susun_jadwal.hari_id',
                    $hari_id
                        ? $hari_id
                        : ($hari_id_default
                            ? $hari_id_default->id
                            : null)
                )

                ->select(
                    'susun_jadwal.*',
                    'kelas.nama_kelas',
                    'tingkat.tingkat',
                    'jurusan.nama_jurusan',
                    'sesi_pelajaran.sesi_pelajaran',
                    'sesi_pelajaran.jam_mulai',
                    'sesi_pelajaran.jam_selesai'
                )

                // URUTKAN BERDASARKAN NOMOR SESI
                ->orderByRaw(
                    'CAST(sesi_pelajaran.sesi_pelajaran AS UNSIGNED) ASC'
                )

                ->get(),
            'hari' => Hari::select('id', 'nama_hari')
                ->orderByRaw("CASE nama_hari 
                WHEN 'Senin' THEN 1 
                WHEN 'Selasa' THEN 2 
                WHEN 'Rabu' THEN 3 
                WHEN 'Kamis' THEN 4 
                WHEN 'Jumat' THEN 5 
                WHEN 'Sabtu' THEN 6 
                WHEN 'Minggu' THEN 7 
                ELSE 8 END, 
                nama_hari ASC")
                ->whereNotIn('nama_hari', ['minggu'])
                ->get(),
            'sesi_pelajaran' => $query->orderBy('sesi_pelajaran', 'asc')->get(),
            'kelas' => Kelas::tampilKelas()->get(),
            'guruPengampuId' => $guruPengampuId,
            'hari_id' => $hari_id ? $hari_id : ($hari_id_default ? $hari_id_default->id : null),
        ]);
    }

    public function absensiSiswa($guruPengampuId, $hari_id, $kelas_id)
    {
        return view('absensi.absensi-siswa', [
            'susun_jadwal' => SusunJadwal::join(
                'kelas',
                'susun_jadwal.kelas_id',
                '=',
                'kelas.id'
            )
                ->join(
                    'tingkat',
                    'kelas.tingkat_id',
                    '=',
                    'tingkat.id'
                )
                ->join(
                    'jurusan',
                    'kelas.jurusan_id',
                    '=',
                    'jurusan.id'
                )
                ->join(
                    'sesi_pelajaran',
                    'susun_jadwal.sesi_id',
                    '=',
                    'sesi_pelajaran.id'
                )

                ->where(
                    'guru_pengampu_id',
                    $guruPengampuId
                )

                ->where(
                    'susun_jadwal.hari_id',
                    $hari_id
                )

                ->where(
                    'susun_jadwal.kelas_id',
                    $kelas_id
                )

                ->select(
                    'susun_jadwal.*',
                    'kelas.nama_kelas',
                    'tingkat.tingkat',
                    'jurusan.nama_jurusan',
                    'sesi_pelajaran.sesi_pelajaran',
                    'sesi_pelajaran.jam_mulai',
                    'sesi_pelajaran.jam_selesai'
                )

                // URUTKAN BERDASARKAN NOMOR SESI
                ->orderByRaw(
                    'CAST(sesi_pelajaran.sesi_pelajaran AS UNSIGNED) ASC'
                )

                ->first(),
        ]);
    }
}
