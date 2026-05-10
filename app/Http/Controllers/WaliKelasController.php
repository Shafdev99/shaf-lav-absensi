<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Walkel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WaliKelasController extends Controller
{
    /** 
     * Wali Kelas
     */
    //======== Index Wali Kelas ========//
    public function walkel()
    {
        return view('walkel.index', [
            'guru'   => Guru::get(),
            'walkel' => Walkel::where('tahun_ajar_id', session('tahun_ajar_id'))->get(),
            'kelas'  => Kelas::urutanKelas()->get(),
        ]);
    }

    //======== Ubah Banyak Wali Kelas ========//
    public function updateWalkel(Request $request)
    {
        $kelas_id  = $request->input('kelas_id');
        $guru_id   = $request->input('guru_id');
        $walkel_id = $request->input('walkel_id');

        $walkelArray = array_filter($walkel_id, function ($value) {
            return !is_null($value);
        });

        $guruArray = array_filter($guru_id, function ($value) {
            return !is_null($value);
        });

        $guru_id_ganda = array_unique($guruArray);

        // Ubah data wali kelas yang sudah ada
        if (count($walkelArray) !== 0) {

            if (count($guruArray) !== count($guru_id_ganda)) {
                return redirect()->back()->with('gagal', 'Satu kelas cukup satu guru!');
            }

            for ($i = 0; $i < count($kelas_id); $i++) {
                Walkel::where('id', $walkel_id[$i])->update([
                    'guru_id' => $guru_id[$i] ?? FALSE,
                ]);
            }

            return to_route('walkel')->with('sukses', 'Data wali kelas berhasil diubah!');
        }

        // Tambah data wali kelas yang belum ada
        if (count($guruArray) !== 0) {
            if (count($guruArray) !== count($guru_id_ganda)) {
                return redirect()->back()->with('gagal', 'Satu kelas cukup satu guru!');
            }

            $records = [];
            for ($i = 0; $i < count($kelas_id); $i++) {
                $records[] = [
                    'id' => Str::uuid()->toString(),
                    'guru_id' => $guru_id[$i] ?? FALSE,
                    'kelas_id' => $kelas_id[$i] ?? FALSE,
                    'tahun_ajar_id' => session('tahun_ajar_id'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            Walkel::insert($records);
            return to_route('walkel')->with('sukses', 'Data wali kelas berhasil diubah!');
        } else {
            return redirect()->back()->with('gagal', 'Data guru tidak boleh kosong!');
        }
    }
}
