<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\StatusPegawai;
use Illuminate\Support\Facades\DB;

class GuruController extends Controller
{
    /** 
     * Guru 
     */
    //======== Index Guru ========//
    public function guru()
    {
        return view('guru.guru', [
            'guru'    => Guru::select('guru.id', 'nama_guru', 'jabatan', 'nip', 'status_guru', 'status_pegawai.status_pegawai')->join('status_pegawai', 'status_pegawai.id', '=', 'guru.status_guru')->orderBy('nama_guru', 'asc')->paginate(10),
            'stapeg'    => DB::table('status_pegawai')->select('id', 'status_pegawai', 'ket_status_pegawai')->get(),
            'jabatan' => ['Staff', 'Guru', 'Kepala Sekolah']
        ]);
    }

    //======== Add Data guru ========//
    public function addGuru()
    {
        $data = request()->validate([
            'nama_guru'     => 'required',
            'nip'           => 'required|unique:guru|min:1|max:16',
            'jabatan'       => 'required',
            'status_guru'   => 'required',
        ], [
            'required'      => ':attribute wajib diisi!',
            'max'           => 'Data guru diisi maksimal :max karakter!',
            'min'           => 'Data guru diisi minimal :min karakter!',
            'nip.unique'    => 'NIP tersebut sudah digunakan!'
        ]);

        Guru::create($data);

        // Alihkan ke halaman guru
        return redirect()->route('guru')->with('sukses', 'Data guru berhasil ditambahkan!');
    }

    //======== Update Data guru ========//
    public function editGuru()
    {
        $data = request()->validate([
            'nama_guru'     => 'required',
            'nip'           => 'required|unique:guru,nip,' . request()->guru_id . '|min:1|max:16',
            'jabatan'       => 'required',
            'status_guru'   => 'required'
        ], [
            'required'       => ':attribute wajib diisi!',
            'max'            => 'Data guru diisi maksimal :max karakter!',
            'min'            => 'Data guru diisi minimal :min karakter!',
            'nip.unique'     => 'NIP guru tersebut sudah digunakan!'
        ]);

        Guru::where('id', request()->guru_id)->update($data);

        // Alihkan ke halaman guru
        return redirect()->route('guru')->with('sukses', 'Data guru berhasil diperbarui!');
    }

    //======== Delete Data guru ========//
    public function delGuru()
    {
        Guru::destroy(request()->guru_id);

        // Alihkan ke halaman guru
        return redirect()->route('guru')->with('sukses', 'Data guru berhasil dihapus!');
    }


    /** 
     * Status Kepegawaian
     */
    //======== Add Data Status Kepegawaian ========//
    public function addStaPeg()
    {
        $data = request()->validate([
            'status_pegawai'     => 'required|unique:status_pegawai',
            'ket_status_pegawai' => 'required|unique:status_pegawai',
        ], [
            'required'          => ':attribute wajib diisi!',
            'max'               => 'Data Status Kepegawaian diisi maksimal :max karakter!',
            'min'               => 'Data Status Kepegawaian diisi minimal :min karakter!',
            'status_pegawai.unique'       => 'Status tersebut sudah digunakan!',
            'ket_status_pegawai.unique'   => 'Keterangan tersebut sudah digunakan!'
        ]);

        StatusPegawai::create($data);

        // Alihkan ke halaman guru
        return redirect()->route('guru')->with('sukses', 'Data Status Kepegawaian berhasil ditambahkan!');
    }

    //======== Update Data Status Kepegawaian ========//
    public function editStaPeg()
    {
        $data = request()->validate([
            'status_pegawai'      => 'required|unique:status_pegawai,status_pegawai,' . request()->status_pegawai_id,
            'ket_status_pegawai'  => 'required|unique:status_pegawai,ket_status_pegawai,' . request()->status_pegawai_id,
        ], [
            'required'       => ':attribute wajib diisi!',
            'max'            => 'Data Status Kepegawaian diisi maksimal :max karakter!',
            'min'            => 'Data Status Kepegawaian diisi minimal :min karakter!',
            'status_pegawai.unique'       => 'Status tersebut sudah digunakan!',
            'ket_status_pegawai.unique'   => 'Keterangan tersebut sudah digunakan!'
        ]);

        StatusPegawai::where('id', request()->status_pegawai_id)->update($data);

        // Alihkan ke halaman guru
        return redirect()->route('guru')->with('sukses', 'Data Status Kepegawaian berhasil diperbarui!');
    }

    //======== Delete Data Status Kepegawaian ========//
    public function delStaPeg()
    {
        StatusPegawai::destroy(request()->status_pegawai_id);

        // Alihkan ke halaman guru
        return redirect()->route('guru')->with('sukses', 'Data Status Kepegawaian berhasil dihapus!');
    }

    //======== Send Data Status Kepegawain Dalam Guru To Json ========//
    public function getStatusPegawaiDalamGuru($status_pegawai_id)
    {
        // Ambil data Guru dari database
        $guru = Guru::select('status_guru')->where('status_guru', $status_pegawai_id)->count();

        // ubah data menjadi json
        return response()->json($guru);
    }
}
