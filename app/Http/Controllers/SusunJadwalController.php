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
        // 1. Ambil Data Master
        $hariList = Hari::orderByRaw("CASE nama_hari WHEN 'Senin' THEN 1 WHEN 'Selasa' THEN 2 WHEN 'Rabu' THEN 3 WHEN 'Kamis' THEN 4 WHEN 'Jumat' THEN 5 WHEN 'Sabtu' THEN 6 WHEN 'Minggu' THEN 7 ELSE 8 END, nama_hari ASC")->get();
        $kelasList = Kelas::tampilKelas()->get();
        $sesiList = SesiPelajaran::all();
        $guruPengampuList = GuruPengampu::with(['penugasan'])->get();

        // 2. Parameter Algoritma Genetika
        $jumlahPopulasi = 20;
        $maxGenerasi = 100;
        $populasi = [];

        // 3. Inisialisasi Populasi Awal
        for ($i = 0; $i < $jumlahPopulasi; $i++) {
            $individu = $this->generateIndividu($hariList, $sesiList, $kelasList, $guruPengampuList);
            $populasi[] = [
                'genes' => $individu,
                'fitness' => $this->hitungFitness($individu)
            ];
        }

        // 4. Proses Evolusi
        $solusiTerbaik = null;
        for ($g = 0; $g < $maxGenerasi; $g++) {
            // Urutkan populasi berdasarkan fitness tertinggi (bentrok paling sedikit)
            usort($populasi, fn($a, $b) => $b['fitness'] <=> $a['fitness']);

            // Jika ditemukan fitness = 1 (Zero Conflict), ambil dan stop
            if ($populasi[0]['fitness'] >= 1) {
                $solusiTerbaik = $populasi[0]['genes'];
                break;
            }

            // Regenerasi: Ganti 50% populasi terburuk dengan individu baru (Mutasi/Crossover sederhana)
            for ($p = (int)($jumlahPopulasi / 2); $p < $jumlahPopulasi; $p++) {
                $populasi[$p]['genes'] = $this->generateIndividu($hariList, $sesiList, $kelasList, $guruPengampuList);
                $populasi[$p]['fitness'] = $this->hitungFitness($populasi[$p]['genes']);
            }
        }

        // Jika sampai akhir tidak ketemu fitness 1, ambil yang terbaik yang ada
        $solusiTerbaik = $solusiTerbaik ?? $populasi[0]['genes'];

        // 5. Simpan Hasil Terbaik ke Database
        SusunJadwal::truncate(); // Hapus jadwal lama sebelum simpan yang baru
        DB::transaction(function () use ($solusiTerbaik) {
            foreach ($solusiTerbaik as $data) {
                SusunJadwal::create($data);
            }
        });

        return redirect()->route('susun.jadwal')->with('sukses', 'Jadwal berhasil digenerate dengan tingkat bentrok minimum.');
    }

    private function generateIndividu($hariList, $sesiList, $kelasList, $guruPengampuList)
    {
        $genes = [];
        foreach ($kelasList as $kelas) {
            // Ambil guru yang mengajar di kelas ini
            $pengampuKelas = $guruPengampuList->filter(function ($guru) use ($kelas) {
                return $guru->penugasan->where('kelas_id', $kelas->id)->isNotEmpty();
            });

            // Buat pool jam mengajar sesuai kuota
            $jamPool = [];
            foreach ($pengampuKelas as $guru) {
                $penugasan = $guru->penugasan->where('kelas_id', $kelas->id)->first();
                $kuota = $penugasan->kuota_jam_per_kelas ?? 2;
                for ($i = 0; $i < $kuota; $i++) {
                    $jamPool[] = $guru->id;
                }
            }
            shuffle($jamPool);

            $index = 0;
            foreach ($hariList as $hari) {
                $sesiHari = $sesiList->where('hari_id', $hari->id);
                foreach ($sesiHari as $sesi) {
                    if (isset($jamPool[$index])) {
                        $genes[] = [
                            'hari_id' => $hari->id,
                            'sesi_id' => $sesi->id,
                            'kelas_id' => $kelas->id,
                            'guru_pengampu_id' => $jamPool[$index],
                        ];
                        $index++;
                    }
                }
            }
        }
        return $genes;
    }

    private function hitungFitness($genes)
    {
        $bentrok = 0;
        $map = [];

        foreach ($genes as $gene) {
            // Kunci unik: Hari + Sesi + Guru
            // Jika guru yang sama mengajar di jam yang sama di kelas berbeda, ini bentrok
            $key = "h{$gene['hari_id']}s{$gene['sesi_id']}g{$gene['guru_pengampu_id']}";

            if (isset($map[$key])) {
                $bentrok++;
            } else {
                $map[$key] = true;
            }
        }

        return 1 / (1 + $bentrok); // 1 = Sempurna, < 1 = Ada bentrok
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
