<?php

namespace App\Http\Controllers;

use App\Models\GuruPengampu;
use App\Models\Hari;
use App\Models\Kelas;
use App\Models\PenugasanKelas;
use App\Models\SesiPelajaran;
use App\Models\SusunJadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SusunJadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($hari_id = NULL)
    {
        $query = SesiPelajaran::select('id', 'sesi_pelajaran', 'jam_mulai', 'jam_selesai', 'zona_waktu');
        $hari_id_default = Hari::select('id')->orderByRaw("CASE nama_hari WHEN 'Senin' THEN 1 WHEN 'Selasa' THEN 2 WHEN 'Rabu' THEN 3 WHEN 'Kamis' THEN 4 WHEN 'Jumat' THEN 5 WHEN 'Sabtu' THEN 6 WHEN 'Minggu' THEN 7 ELSE 8 END, nama_hari ASC")->first();

        if ($hari_id) {
            $query->where('hari_id', $hari_id);
        } else {
            $query->where('hari_id', $hari_id_default ? $hari_id_default->id : null);
        }

        return view('susun-jadwal.index', [
            'susun_jadwal' => SusunJadwal::with(['kelas'])->get(),
            'hari' => Hari::select('id', 'nama_hari')->orderByRaw("CASE nama_hari WHEN 'Senin' THEN 1 WHEN 'Selasa' THEN 2 WHEN 'Rabu' THEN 3 WHEN 'Kamis' THEN 4 WHEN 'Jumat' THEN 5 WHEN 'Sabtu' THEN 6 WHEN 'Minggu' THEN 7 ELSE 8 END, nama_hari ASC")->get(),
            'sesi_pelajaran' => $query->get(),
            'kelas' => Kelas::tampilKelas()->get(),
            'guru_pengampu' => GuruPengampu::with(['guru', 'mapel'])->get()->makeHidden(['created_at', 'updated_at']),
            'hari_id' => $hari_id ? $hari_id : ($hari_id_default ? $hari_id_default->id : null),
        ]);
    }

    // proses susun jadwal

    public function prosesSusunJadwal()
    {
        /*
    |--------------------------------------------------------------------------
    | MASTER DATA
    |--------------------------------------------------------------------------
    */

        $hariList = Hari::whereNot('nama_hari', 'Minggu')
            ->orderByRaw("
            CASE nama_hari
                WHEN 'Senin' THEN 1
                WHEN 'Selasa' THEN 2
                WHEN 'Rabu' THEN 3
                WHEN 'Kamis' THEN 4
                WHEN 'Jumat' THEN 5
                WHEN 'Sabtu' THEN 6
                ELSE 7
            END
        ")
            ->get()
            ->shuffle();

        $kelasList = Kelas::tampilKelas()
            ->get()
            ->shuffle();

        $sesiList = SesiPelajaran::all();

        $guruPengampuList = GuruPengampu::with([
            'guru',
            'mapel',
            'penugasan'
        ])->get();

        /*
    |--------------------------------------------------------------------------
    | RESET JADWAL
    |--------------------------------------------------------------------------
    */

        SusunJadwal::query()->delete();

        /*
    |--------------------------------------------------------------------------
    | CACHE
    |--------------------------------------------------------------------------
    */

        $cacheGuru = [];
        $cacheKelas = [];
        $cacheGuruPerHari = [];
        $cacheGuruKelas = [];
        $cacheKelasTotal = [];
        $cacheGuruTotal = [];

        /*
    |--------------------------------------------------------------------------
    | GENERATE JADWAL
    |--------------------------------------------------------------------------
    */

        foreach ($kelasList as $kelas) {

            /*
        |--------------------------------------------------------------------------
        | Ambil Guru yang Mengajar di Kelas Ini
        |--------------------------------------------------------------------------
        */

            $pengampuKelas = $guruPengampuList
                ->filter(function ($guruPengampu) use ($kelas) {

                    return $guruPengampu
                        ->penugasan
                        ->where('kelas_id', $kelas->id)
                        ->isNotEmpty();
                })
                ->shuffle();

            foreach ($pengampuKelas as $guruPengampu) {

                /*
            |--------------------------------------------------------------------------
            | Ambil Penugasan
            |--------------------------------------------------------------------------
            */

                $penugasan = $guruPengampu
                    ->penugasan
                    ->where('kelas_id', $kelas->id)
                    ->first();

                if (!$penugasan) {
                    continue;
                }

                /*
            |--------------------------------------------------------------------------
            | Kuota Jam Guru Per Kelas
            |--------------------------------------------------------------------------
            */

                $targetJam =
                    $penugasan->kuota_jam_per_kelas ?? 2;

                $jamTerpasang = 0;

                /*
            |--------------------------------------------------------------------------
            | Generate Slot
            |--------------------------------------------------------------------------
            */

                foreach ($hariList as $hari) {

                    /*
                |--------------------------------------------------------------------------
                | Maksimal 2 sesi per hari untuk kelas yang sama
                |--------------------------------------------------------------------------
                */

                    $guruKelasHariCount = SusunJadwal::where(
                        'guru_pengampu_id',
                        $guruPengampu->id
                    )
                        ->where('kelas_id', $kelas->id)
                        ->where('hari_id', $hari->id)
                        ->count();

                    if ($guruKelasHariCount >= 2) {
                        continue;
                    }

                    /*
                |--------------------------------------------------------------------------
                | Ambil sesi per hari
                |--------------------------------------------------------------------------
                */

                    $sesiHari = $sesiList
                        ->where('hari_id', $hari->id)
                        ->sortBy('sesi_pelajaran');

                    foreach ($sesiHari as $sesi) {

                        /*
                    |--------------------------------------------------------------------------
                    | Jika target jam terpenuhi
                    |--------------------------------------------------------------------------
                    */

                        if ($jamTerpasang >= $targetJam) {
                            break 2;
                        }

                        /*
                    |--------------------------------------------------------------------------
                    | Cek sesi berikutnya
                    |--------------------------------------------------------------------------
                    */

                        $sesiBerikutnya = $sesiHari
                            ->where(
                                'sesi_pelajaran',
                                (int)$sesi->sesi_pelajaran + 1
                            )
                            ->first();

                        /*
                    |--------------------------------------------------------------------------
                    | Tentukan blok jam
                    |--------------------------------------------------------------------------
                    */

                        $sisaJam =
                            $targetJam - $jamTerpasang;

                        $blokJam =
                            $sisaJam >= 2 ? 2 : 1;

                        /*
                    |--------------------------------------------------------------------------
                    | Jika butuh 2 sesi tapi sesi berikutnya tidak ada
                    |--------------------------------------------------------------------------
                    */

                        if (
                            $blokJam == 2 &&
                            !$sesiBerikutnya
                        ) {
                            continue;
                        }

                        /*
                    |--------------------------------------------------------------------------
                    | CEK BENTROK SESI PERTAMA
                    |--------------------------------------------------------------------------
                    */

                        $guruKey1 =
                            $hari->id . '-' .
                            $sesi->id . '-' .
                            $guruPengampu->id;

                        $kelasKey1 =
                            $hari->id . '-' .
                            $sesi->id . '-' .
                            $kelas->id;

                        if (
                            isset($cacheGuru[$guruKey1]) ||
                            isset($cacheKelas[$kelasKey1])
                        ) {
                            continue;
                        }

                        /*
                    |--------------------------------------------------------------------------
                    | CEK SESI KEDUA
                    |--------------------------------------------------------------------------
                    */

                        if ($blokJam == 2) {

                            $guruKey2 =
                                $hari->id . '-' .
                                $sesiBerikutnya->id . '-' .
                                $guruPengampu->id;

                            $kelasKey2 =
                                $hari->id . '-' .
                                $sesiBerikutnya->id . '-' .
                                $kelas->id;

                            if (
                                isset($cacheGuru[$guruKey2]) ||
                                isset($cacheKelas[$kelasKey2])
                            ) {
                                continue;
                            }
                        }

                        /*
                    |--------------------------------------------------------------------------
                    | INSERT SESI PERTAMA
                    |--------------------------------------------------------------------------
                    */

                        SusunJadwal::create([
                            'hari_id' => $hari->id,
                            'sesi_id' => $sesi->id,
                            'kelas_id' => $kelas->id,
                            'guru_pengampu_id' => $guruPengampu->id,
                        ]);

                        $cacheGuru[$guruKey1] = true;
                        $cacheKelas[$kelasKey1] = true;

                        $jamTerpasang++;

                        /*
                    |--------------------------------------------------------------------------
                    | INSERT SESI KEDUA
                    |--------------------------------------------------------------------------
                    */

                        if ($blokJam == 2) {

                            SusunJadwal::create([
                                'hari_id' => $hari->id,
                                'sesi_id' => $sesiBerikutnya->id,
                                'kelas_id' => $kelas->id,
                                'guru_pengampu_id' => $guruPengampu->id,
                            ]);

                            $cacheGuru[$guruKey2] = true;
                            $cacheKelas[$kelasKey2] = true;

                            $jamTerpasang++;
                        }

                        /*
                    |--------------------------------------------------------------------------
                    | Maksimal 2 sesi per hari
                    |--------------------------------------------------------------------------
                    */

                        break;
                    }
                }
            }
        }

        return redirect()
            ->route('susun.jadwal')
            ->with(
                'sukses',
                'Jadwal berhasil digenerate dengan blok sesi berurutan.'
            );
    }




    public function simpanGuruPengampu(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'guru_pengampu_id' => 'required|exists:guru_pengampu,id',
            'kelas_id' => 'required|exists:kelas,id',
            'hari_id' => 'required|exists:hari,id',
            'sesi_id' => 'required|exists:sesi_pelajaran,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();
        $guruPengampuId = $validated['guru_pengampu_id'];
        $kelasId = $validated['kelas_id'];
        $hariId = $validated['hari_id'];
        $sesiId = $validated['sesi_id'];

        // Cek apakah guru pengampu sudah ditugaskan mengajar di kelas ini
        // PenugasanKelas menyimpan relasi guru pengampu dan kelas tugasnya
        $cekPenugasan = PenugasanKelas::where('guru_pengampu_id', $guruPengampuId)
            ->where('kelas_id', $kelasId)
            ->first();

        if (!$cekPenugasan) {
            return response()->json(['success' => false, 'error' => 'Guru pengampu tidak ditugaskan untuk kelas ini.'], 400);
        }

        // Cek jadwal tersedia untuk kelas, hari, dan sesi
        $jadwalTersedia = SusunJadwal::where('hari_id', $hariId)
            ->where('sesi_id', $sesiId)
            ->where('kelas_id', $kelasId)
            ->doesntExist();

        if (!$jadwalTersedia) {
            return response()->json(['success' => false, 'error' => 'Jadwal sudah tersedia untuk kelas, hari, dan sesi ini.'], 400);
        }

        // Validasi: cek apakah guru sudah mengajar di jam yang sama
        $bentrok = SusunJadwal::where('hari_id', $hariId)
            ->where('sesi_id', $sesiId)
            ->where('guru_pengampu_id', $guruPengampuId)
            ->first();

        if ($bentrok) {
            return response()->json(['success' => false, 'error' => 'Guru pengampu sudah mengajar di jam yang sama.'], 400);
        }

        // Cek kuota jam pelajaran kelas
        $guruPengampu = GuruPengampu::find($guruPengampuId);
        $kelas = Kelas::find($kelasId);

        $kelasLessonCount = SusunJadwal::where('kelas_id', $kelasId)->count();
        $kelasMaxJam = $kelas->jumlah_jam ?? null;

        if ($kelasMaxJam !== null && $kelasLessonCount >= $kelasMaxJam) {
            return response()->json(['success' => false, 'error' => 'Kuota jam pelajaran kelas sudah terpenuhi.'], 400);
        }

        // Cek kuota jam mengajar guru
        $guruLessonCount = SusunJadwal::where('guru_pengampu_id', $guruPengampuId)->count();
        $guruMaxJam = $guruPengampu->kuota_jam ?? $guruPengampu->mapel->kuota_jam ?? $guruPengampu->mapel->jumlah_jam_pelajaran ?? null;

        if ($guruMaxJam !== null && $guruLessonCount >= $guruMaxJam) {
            return response()->json(['success' => false, 'error' => 'Kuota jam mengajar guru sudah tercapai.'], 400);
        }

        // Cek kuota jam mengajar guru per kelas
        $guruKelasLessonCount = SusunJadwal::where('guru_pengampu_id', $guruPengampuId)
            ->where('kelas_id', $kelasId)
            ->count();
        $guruKelasMaxJam = $cekPenugasan->kuota_jam_per_kelas ?? null;

        if ($guruKelasMaxJam !== null && $guruKelasLessonCount >= $guruKelasMaxJam) {
            return response()->json(['success' => false, 'error' => 'Kuota jam mengajar guru per kelas sudah tercapai.'], 400);
        }

        // Simpan penugasan baru
        $penugasan = SusunJadwal::create([
            'guru_pengampu_id' => $guruPengampuId,
            'kelas_id' => $kelasId,
            'hari_id' => $hariId,
            'sesi_id' => $sesiId,
        ]);

        return response()->json(['success' => true, 'result' => $penugasan]);
    }

    public function resetJadwal()
    {
        SusunJadwal::truncate();
        return redirect()->route('susun.jadwal')->with('sukses', 'Jadwal berhasil direset.');
    }
}
