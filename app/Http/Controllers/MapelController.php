<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\GuruPengampu;
use App\Models\Kelas;
use App\Models\KelompokMapel;
use App\Models\Mapel;
use App\Models\PenugasanKelas;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;



class MapelController extends Controller
{
    /** 
     * Mapel 
     */
    //======== Index Mapel ========//
    public function mapel()
    {
        return view('mapel.index', [
            'mapel' => Mapel::select('id', 'mapel', 'kkm')->get(),
            'kelma' => KelompokMapel::select('id', 'kelompok_mapel')->get()
        ]);
    }

    //======== Add Data Mapel ========//
    public function addMapel()
    {
        $data = request()->validate([
            'mapel'  => 'required|unique:mapel|min:1|max:150',
            'kkm'    => 'required|min:2|max:3'
        ], [
            'required'       => ':attribute wajib diisi!',
            'mapel.max'      => 'Data mapel diisi maksimal :max karakter!',
            'mapel.min'      => 'Data mapel diisi minimal :min karakter!',
            'kkm.min'        => ':attribute disini minimal :min karakter!',
            'kkm.max'        => ':attribute disini maksimal :max karakter!',
            'mapel.unique'   => 'Nama mapel tersebut sudah digunakan!'
        ]);

        Mapel::create($data);

        // Alihkan ke halaman mapel
        return redirect()->route('mapel')->with('sukses', 'Data Mapel berhasil ditambahkan!');
    }

    //======== Update Data mapel ========//
    public function editMapel()
    {
        $data = request()->validate([
            'mapel'  => 'required|unique:mapel,mapel,' . request()->mapel_id . '|min:1|max:150',
            'kkm'    => 'required|min:2|max:3'
        ], [
            'required'       => ':attribute wajib diisi!',
            '.mapel.max'     => 'Data mapel diisi maksimal :max karakter!',
            'mapel.min'      => 'Data mapel diisi minimal :min karakter!',
            'kkm.min'        => ':attribute disini minimal :min karakter!',
            'kkm.max'        => ':attribute disini maksimal :max karakter!',
            'mapel.unique'   => 'Nama mapel tersebut sudah digunakan!'
        ]);

        mapel::where('id', request()->mapel_id)->update($data);

        // Alihkan ke halaman mapel
        return redirect()->route('mapel')->with('sukses', 'Data mapel berhasil diperbarui!');
    }

    public function editMapelKkm()
    {
        for ($i = 0; $i < count(request()->mapel_id); $i++) {
            Mapel::where('id', request()->mapel_id[$i])->update([
                'kkm' => request()->kkm[$i]
            ]);
        }

        // Alihkan ke halaman mapel
        return redirect()->route('mapel')->with('sukses', 'Data kkm mapel berhasil diperbarui!');
    }

    //======== Delete Data mapel ========//
    public function delMapel()
    {
        mapel::destroy(request()->mapel_id);

        // Alihkan ke halaman mapel
        return redirect()->route('mapel')->with('sukses', 'Data mapel berhasil dihapus!');
    }


    /** 
     * KelompokMapel 
     */
    //======== Add Data KelompokMapel ========//
    public function addKelompokMapel()
    {
        $data = request()->validate([
            'kelompok_mapel'  => 'required|unique:kelompok_mapel|min:1|max:150'
        ], [
            'required'          => ':attribute wajib diisi!',
            'max'               => 'Data kelompok mapel diisi maksimal :max karakter!',
            'min'               => 'Data kelompok mapel diisi minimal :min karakter!',
            'kelompok_mapel.unique' => 'Nama kelompok mapel tersebut sudah digunakan!'
        ]);

        KelompokMapel::create($data);

        // Alihkan ke halaman KelompokMapel
        return redirect()->route('mapel')->with('sukses', 'Data kelompok mapel berhasil ditambahkan!');
    }

    //======== Update Data KelompokMapel ========//
    public function editKelompokMapel()
    {
        $data = request()->validate([
            'kelompok_mapel'  => 'required|unique:kelompok_mapel,kelompok_mapel,' . request()->kelompok_mapel_id . '|min:1|max:150'
        ], [
            'required'          => ':attribute wajib diisi!',
            'max'               => 'Data kelompok mapel diisi maksimal :max karakter!',
            'min'               => 'Data kelompok mapel diisi minimal :min karakter!',
            'kelompok_mapel.unique' => 'Nama KelompokMapel tersebut sudah digunakan!'
        ]);

        KelompokMapel::where('id', request()->kelompok_mapel_id)->update($data);

        // Alihkan ke halaman KelompokMapel
        return redirect()->route('mapel')->with('sukses', 'Data kelompok mapel berhasil diperbarui!');
    }

    //======== Delete Data KelompokMapel ========//
    public function delKelompokMapel()
    {
        KelompokMapel::destroy(request()->kelompok_mapel_id);

        // Alihkan ke halaman KelompokMapel
        return redirect()->route('mapel')->with('sukses', 'Data kelompok mapel berhasil dihapus!');
    }


    /** 
     * Guru Pengampu
     */
    //======== View Data Guru Pengampu ========//
    public function pengampu()
    {
        return view('mapel.pengampu', [
            'mapel' => Mapel::select('id', 'mapel', 'kkm')->get(),
            'guru' => Guru::select('id', 'nama_guru', 'jabatan')->where('jabatan', 'Guru')->get(),
            'guru_pengampu' => GuruPengampu::with('guru')->select('id', 'mapel_id', 'guru_id', 'jam_pelajaran')->get(),
            'kelas' => Kelas::tampilKelas()->get()
        ]);
    }

    //======== Add Data Guru Pengampu ========//
    public function tambahGuruPengampu(Request $request)
    {
        $data = $request->validate([
            'mapel_id' => [
                'required',
                'exists:mapel,id',
                Rule::unique('guru_pengampu')->where('guru_id', $request->guru_id)
            ],
            'guru_id' => 'required|exists:guru,id',
            'jam_pelajaran' => 'required|integer|min:1'
        ], [
            'required' => ':attribute wajib diisi!',
            'exists' => ':attribute tidak valid!',
            'mapel_id.unique' => 'Kombinasi mapel dan guru ini sudah ada!',
            'jam_pelajaran.integer' => 'Jam pelajaran harus berupa angka!',
            'jam_pelajaran.min' => 'Jam pelajaran minimal 1!'
        ]);

        GuruPengampu::create($data);

        return redirect()->route('pengampu')->with('sukses', 'Guru pengampu berhasil ditambahkan!');
    }

    //======== Edit Data Guru Pengampu ========//
    public function editGuruPengampu(Request $request)
    {
        $data = $request->validate([
            'mapel_id' => [
                'required',
                'exists:mapel,id',
                Rule::unique('guru_pengampu')->where('guru_id', $request->guru_id)->ignore($request->input('guru_pengampu_id'))
            ],
            'guru_id' => 'required|exists:guru,id',
            'jam_pelajaran' => 'required|integer|min:1'
        ], [
            'required' => ':attribute wajib diisi!',
            'exists' => ':attribute tidak valid!',
            'mapel_id.unique' => 'Kombinasi mapel dan guru ini sudah ada!',
            'jam_pelajaran.integer' => 'Jam pelajaran harus berupa angka!',
            'jam_pelajaran.min' => 'Jam pelajaran minimal 1!'
        ]);

        GuruPengampu::where('id', $request->input('guru_pengampu_id'))->update($data);

        return redirect()->route('pengampu')->with('sukses', 'Guru pengampu berhasil diperbarui!');
    }

    //======== Delete Data Guru Pengampu ========//
    public function hapusGuruPengampu(Request $request)
    {
        GuruPengampu::destroy($request->input('guru_pengampu_id'));

        return redirect()->route('pengampu')->with('sukses', 'Guru pengampu berhasil dihapus!');
    }

    //======== Kelola Kelas Guru Pengampu ========//
    public function kelolaKelasGuruPengampu(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'guru_pengampu_id' => 'required|exists:guru_pengampu,id',
            'kelas_id' => 'required|array',
            'kelas_id.*' => 'exists:kelas,id'
        ], [
            'required' => ':attribute wajib diisi!',
            'exists' => ':attribute tidak valid!',
        ]);
        PenugasanKelas::where('guru_pengampu_id', $data['guru_pengampu_id'])->delete();
        foreach ($data['kelas_id'] as $kelas_id) {
            PenugasanKelas::create([
                'guru_pengampu_id' => $data['guru_pengampu_id'],
                'kelas_id' => $kelas_id
            ]);
        }
        return redirect()->route('pengampu')->with('sukses', 'Kelas untuk guru pengampu berhasil diperbarui!');
    }

    //======== Get Kelas Guru Pengampu ========//
    public function getKelasGuruPengampu(string $id)
    {
        $daftarKelas = PenugasanKelas::where('guru_pengampu_id', $id)->pluck('kelas_id');
        return response()->json($daftarKelas);
    }
}
