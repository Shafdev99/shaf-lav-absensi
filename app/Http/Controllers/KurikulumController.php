<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\TahunAjar;
use App\Models\Kurikulum;
use App\Models\KelompokMapel;
use App\Models\KurikulumMapel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KurikulumController extends Controller
{
    /** 
     * Kurikulum
     */
    //======== Index Kurikulum========//
    public function kurikulum()
    {
        return view('master.kurikulum', [
            'kurikulum' => Kurikulum::select('id', 'nama_kurikulum')->paginate(10),
            'tahunAjar' => TahunAjar::select('id', 'tahun_ajar')->orderByDesc('tahun_ajar')->get()
        ]);
    }

    //======== Tambah Data Kurikulum ========//
    public function addKurlum(Request $request)
    {
        $data = $request->validate([
            'nama_kurikulum' => 'required',
            // 'tahun_ajar_id'  => 'required'
        ], [
            'required' => ':attribute tidak boleh kosong !',
        ]);

        Kurikulum::create($data);
        return to_route('kurikulum')->with('sukses', 'Data kurikulum berhasil ditambahkan !');
    }

    //======== Edit Data Kurikulum ========//
    public function editKurlum(Request $request)
    {
        $data = $request->validate([
            'nama_kurikulum' => 'required',
            // 'tahun_ajar_id'  => 'required'
        ], [
            'required' => ':attribute tidak boleh kosong !',
        ]);

        Kurikulum::where('id', $request->input('kurlum_id'))->update($data);
        return to_route('kurikulum')->with('sukses', 'Data kurikulum berhasil diperbarui !');
    }

    //======== Hapus Data Kurikulum ========//
    public function delKurlum(Request $request)
    {
        Kurikulum::destroy($request->input('kurlum_id'));
        return to_route('kurikulum')->with('sukses', 'Data kurikulum berhasil dihapus !');
    }

    //======== View Kurikulum Mapel ========//
    public function kurikulumMapel($id)
    {
        $mapelId = KurikulumMapel::where('kurlum_id', $id)->pluck('mapel_id')->all();
        return view('master.kurikulum-mapel', [
            'kurikulum'   => Kurikulum::where('id', $id)->first(),
            'kurMapel'    => KurikulumMapel::kurMapel($id)->orderBy('urutan_mapel', 'asc')->get(),
            'mapel'       => Mapel::select('id', 'mapel')->whereNotIn('id', $mapelId)->get(),
            'mapelEdit'   => Mapel::select('id', 'mapel')->get(),
            'kelma'       => KelompokMapel::select('id', 'kelompok_mapel')->get()
        ]);
    }

    //======== Tambah Data Kurikulum Mapel ========//
    public function addKurMapel()
    {
        $data = request()->validate([
            'kelompok_mapel_id' => 'required',
            'mapel_id'          => 'required',
            'kurlum_id'         => 'required',
            'urutan_mapel'      => 'required',
        ], [
            'required' => ':attribute tidak boleh kosong !'
        ]);

        KurikulumMapel::create($data);

        return to_route('kurikulum.mapel', request()->kurlum_id)->with('sukses', 'Mapel berhasil ditambahkan !');
    }

    //======== Hapus Data Kurikulum Mapel ========//
    public function delKurMapel()
    {
        KurikulumMapel::destroy(request()->kurikulum_mapel_id);

        return to_route('kurikulum.mapel', request()->kurlum_id)->with('sukses', 'Mapel berhasil dihapus !');
    }

    //======== Ubah Urutan Mapel ========//
    public function ubahUrutanMapel()
    {
        $kurMapelId  = request()->kurikulum_mapel_id;
        $urutanMapel = request()->urutan_mapel;

        for ($i = 0; $i < count($urutanMapel); $i++) {
            KurikulumMapel::where('id', $kurMapelId[$i])->update([
                'urutan_mapel' => $urutanMapel[$i]
            ]);
        }

        return to_route('kurikulum.mapel', request()->kurlum_id)->with('sukses', 'Urutan mapel berhasil diubah !');
    }
}
