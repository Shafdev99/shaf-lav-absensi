<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Jurusan;
use App\Models\Tingkat;
use App\Models\Kurikulum;
use App\Http\Controllers\Controller;

class KelasController extends Controller
{

    /** 
     * Tingkat 
     */
    //======== Add Data Tingkat ========//
    public function addTingkat()
    {
        // Validasi data dari form
        $data = request()->validate([
            'tingkat'  => 'required|unique:tingkat|min:1|max:16'
        ], [
            'required'   => ':attribute wajib diisi!',
            'max'        => ':attribute diisi maksimal :max karakter!',
            'min'        => ':attribute diisi minimal :min karakter!',
            'unique'     => ':attribute sudah digunakan!'
        ]);

        // Masukan data tingkat baru ke database
        Tingkat::create($data);

        // Alihkan ke halaman kelas
        return redirect()->route('kelas')->with('sukses', 'Tingkat berhasil ditambahkan!');
    }

    //======== Update Data tingkat ========//
    public function updateTingkat()
    {
        // Validasi data dari form
        $data = request()->validate([
            'tingkat'  => 'required|unique:tingkat,tingkat,' . request()->tingkat_id . '|min:1|max:10'
        ], [
            'required'   => ':attribute wajib diisi!',
            'max'        => ':attribute diisi maksimal :max karakter!',
            'min'        => ':attribute diisi minimal :min karakter!',
            'unique'     => ':attribute sudah digunakan!'
        ]);

        // Ubah tingkat baru dari database
        Tingkat::where('id', request()->tingkat_id)->update($data);

        // Alihkan ke halaman kelas
        return redirect()->route('kelas')->with('sukses', 'Tingkat sudah diperbarui!');
    }

    //======== Send Data Kelas Dalam Tingkat To Json ========//
    public function getKelasDalamTingkat($tingkat_id)
    {
        // Ambil data kelas dari database
        $kelas = Kelas::select('tingkat_id')->where('tingkat_id', $tingkat_id)->count();

        // ubah data menjadi json
        return response()->json($kelas);
    }

    //======== Delete Tingkat ========//
    public function deleteTingkat()
    {
        // Hapus data kelas berdasarkan ID
        Tingkat::destroy(request()->tingkat_id);

        // Alihkan ke halaman kelas
        return redirect()->route('kelas')->with('sukses', 'Tingkat berhasil dihapus!');
    }

    /** 
     * Kelas 
     */
    //======== Index kelas ========//
    public function kelas()
    {
        return view('master.kelas', [
            'tingkat' => Tingkat::select('id', 'tingkat')->get(),
            'jurusan' => Jurusan::paginate(5),
            'jrsn'    => Jurusan::select('id', 'nama_jurusan', 'keterangan')->get(),
            'kurlum'  => Kurikulum::select('id', 'nama_kurikulum')->get(),
            'kelas'   => Kelas::tampilKelas()->orderBy('nama_jurusan', 'asc')->get()
        ]);
    }

    //======== Add Data Kelas ========//
    public function addKelas()
    {
        // Validasi data dari form
        $data = request()->validate([
            'nama_kelas'  => 'required|min:1|max:16',
            'tingkat_id'  => 'required',
            'jurusan_id'  => 'required',
            'kurlum_id'   => 'required',
            'jumlah_jam' => 'required|numeric|min:1|max:55'
        ], [
            'required'   => ':attribute wajib diisi!',
            'max'        => ':attribute diisi maksimal :max karakter!',
            'min'        => ':attribute diisi minimal :min karakter!',
            'numeric'    => ':attribute harus berupa angka!'
        ]);

        // Masukan data kelas baru ke database
        Kelas::create($data);

        // Alihkan ke halaman kelas
        return redirect()->route('kelas')->with('sukses', 'Kelas berhasil ditambahkan!');
    }

    //======== Update Data Kelas ========//
    public function updateKelas()
    {

        // Validasi data dari form
        $data = request()->validate([
            'nama_kelas'  => 'required|min:1|max:10',
            'jurusan_id'  => 'required',
            'tingkat_id'  => 'required',
            'kurlum_id'   => 'required',
            'jumlah_jam' => 'required|numeric|min:1|max:55'
        ], [
            'required'   => ':attribute wajib diisi!',
            'max'        => ':attribute diisi maksimal :max karakter!',
            'min'        => ':attribute diisi minimal :min karakter!',
            'numeric'    => ':attribute harus berupa angka!'
        ]);

        // Ubah kelas baru dari database
        Kelas::where('id', request()->kelas_id)->update($data);

        // Alihkan ke halaman kelas
        return redirect()->route('kelas')->with('sukses', 'Kelas sudah diperbarui!');
    }

    //======== Send Data Siswa Dalam Kelas To Json ========//
    public function getSiswaDalamKelas($kelas_id)
    {
        // Ambil data siswa dari database
        $siswa = Siswa::select('kelas_id')->where('kelas_id', $kelas_id)->count();

        // ubah data menjadi json
        return response()->json($siswa);
    }

    //======== Delete Kelas ========//
    public function deleteKelas()
    {
        // Hapus data kelas berdasarkan ID
        Kelas::destroy(request()->kelas_id);

        // Alihkan ke halaman kelas
        return redirect()->route('kelas')->with('sukses', 'Kelas berhasil dihapus!');
    }



    /** 
     * Jurusan 
     */
    //======== Add Data Jurusan ========//
    public function addJurusan()
    {
        // Validasi data dari form
        $data = request()->validate([
            'nama_jurusan'  => 'required|unique:jurusan|min:1|max:16',
            'keterangan'    => 'required|unique:jurusan|min:1|max:150'
        ], [
            'required'   => ':attribute wajib diisi!',
            'max'        => ':attribute diisi maksimal :max karakter!',
            'min'        => ':attribute diisi minimal :min karakter!',
            'nama_jurusan.unique' => 'Nama jurusan sudah digunakan!',
            'keterangan.unique'   => 'Keterangan jurusan sudah digunakan!'
        ]);

        // Masukan data jurusan baru ke database
        Jurusan::create($data);

        // Alihkan ke halaman kelas
        return redirect()->route('kelas')->with('sukses', 'Jurusan berhasil ditambahkan!');
    }

    //======== Update Data Jurusan ========//
    public function updateJurusan()
    {
        // Validasi data dari form
        request()->validate([
            'nama_jurusan'        => 'required|unique:jurusan,nama_jurusan,' . request()->jurusan_id . '|min:1|max:16',
            'keterangan_jurusan'  => 'required|min:1|max:150'
        ], [
            'required'   => ':attribute wajib diisi!',
            'max'        => ':attribute diisi maksimal :max karakter!',
            'min'        => ':attribute diisi minimal :min karakter!',
            'nama_jurusan.unique' => 'Nama jurusan sudah digunakan!',
            'keterangan.unique'   => 'Keterangan jurusan sudah digunakan!'
        ]);

        // Ubah jurusan baru dari database
        Jurusan::where('id', request()->jurusan_id)->update([
            'nama_jurusan' => request()->nama_jurusan,
            'keterangan'   => request()->keterangan_jurusan,
        ]);

        // Alihkan ke halaman kelas
        return redirect()->route('kelas')->with('sukses', 'Jurusan sudah diperbarui!');
    }

    //======== Send Data Siswa Dalam Jurusan To Json ========//
    public function getSiswaDalamJurusan($jurusan_id)
    {
        // Ambil data siswa dari database
        $siswa = Siswa::select('jurusan_id')->where('jurusan_id', $jurusan_id)->count();

        // ubah data menjadi json
        return response()->json($siswa);
    }

    //======== Delete Jurusan ========//
    public function deleteJurusan()
    {
        // Hapus data jurusan berdasarkan ID
        Jurusan::destroy(request()->jurusan_id);

        // Alihkan ke halaman kelas
        return redirect()->route('kelas')->with('sukses', 'Jurusan berhasil dihapus!');
    }
}
