<?php

namespace App\Repository;

use App\Models\Siswa;
use App\Models\Binduk;
use App\Models\Kurikulum;
use App\Models\KeteranganKeterima;
use App\Http\Controllers\Controller;
use App\Models\KelolaSiswa;
use App\Models\TahunAjar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MasterRepository extends Controller
{
    public function insertSiswa($request)
    {
        // Validasi data dari form //
        $data = $request->validate([
            'nama_lengkap'      => 'required',
            'tempat_lahir'      => 'required',
            'tanggal_lahir'     => 'required',
            'alamat'            => 'required',
            'agama'             => 'required',
            'nik'               => 'required|unique:siswa|min:16|max:16',
            'nisn'              => 'required|unique:siswa|min:10',
            'nis'               => 'required|unique:siswa|min:6|max:10',
            'alamat'            => 'required',
            'jenis_kelamin'     => 'required',
            'agama'             => 'required',
            'foto'              => 'image|file|max:1024|mimes:jpg,jpeg,png',
            'kelas_id'          => 'required',
            'tingkat_id'        => 'required',
            'jurusan_id'        => 'required',
            'tanggal_keterima'  => 'required',
        ], [
            'required'              => ':attribute wajib diisi!',
            'kelas_id.required'     => 'Kelas wajib diisi!',
            'jurusan_id.required'   => 'Jurusan wajib diisi!',
            'tingkat_id.required'   => 'Tingkat wajib diisi!',
            'max'                   => ':attribute diisi maksimal :max karakter!',
            'min'                   => ':attribute diisi minimal :min karakter!',
            'unique'                => ':attribute sudah digunakan!',
            'foto.max'              => 'size :attribute maksimal :max Kb!',
            'foto.mimes'            => 'format :attribute harus :values!'
        ]);


        // $data = $request->all();


        // Upload foto
        if ($request->file('foto')) {
            $data['foto'] = $request->file('foto')->store('image/siswa/awal');
        }

        $data['kurikulum_id'] = TahunAjar::select('kurikulum_id')->where('id', session('tahun_ajar_id'))->first()->kurikulum_id;

        // Include Keterangan Lulus
        $data['status'] = 'aktif';

        return Siswa::create($data);
    }

    public function updateSiswa($request, $siswa)
    {
        // Validasi data dari form //
        request()->validate([
            'nama_lengkap'      => 'required',
            'tempat_lahir'      => 'required',
            'tanggal_lahir'     => 'required',
            'alamat'            => 'required',
            'agama'             => 'required',
            'nik'               => 'required|min:16|max:16|unique:siswa,nik,' . $siswa->id,
            'nisn'              => 'required|min:10|max:10|unique:siswa,nisn,' . $siswa->id,
            'nis'               => 'required|min:6|max:10|unique:siswa,nis,' . $siswa->id,
            'alamat'            => 'required',
            'jenis_kelamin'     => 'required',
            'agama'             => 'required',
            'foto'              => 'image|file|max:1024|mimes:jpg,jpeg,png',
            'kelas_id'          => 'required',
            'jurusan_id'        => 'required',
            'tingkat_id'        => 'required',
            'tanggal_keterima'  => 'required',
        ], [
            'required'              => ':attribute wajib diisi!',
            'kelas_id.required'     => 'Kelas wajib diisi!',
            'jurusan_id.required'   => 'Jurusan wajib diisi!',
            'tingkat_id.required'   => 'Tingkat wajib diisi!',
            'max'                   => ':attribute diisi maksimal :max karakter!',
            'min'                   => ':attribute diisi minimal :min karakter!',
            'unique'                => ':attribute sudah digunakan!',
            'foto.max'              => 'size :attribute maksimal :max Kb!',
            'foto.mimes'            => 'format :attribute harus :values!'
        ]);

        $data = $request->except(['_token', '_method', 'tingkat_id', 'jurusan_id', 'kelas_id', 'tanggal_keterima', 'tahun_ajar', 'kelas', 'nama_siswa', 'tahun_ajar']);;

        // Upload foto
        if ($request->file('foto')) {

            $this->updateFotoSiswa($request, $siswa);
        }

        // Include Keterangan Lulus
        $data['status'] = 'aktif';

        // Update Data ke database //
        return Siswa::where('id', $siswa->id)->update($data);
    }

    private function updateFotoSiswa($request, $siswa)
    {
        // Jika terdapat foto siswa tersimpan di database
        if ($siswa->foto) {

            // Maka hapus foto yang lama
            Storage::delete($siswa->foto);
        }
        return $data['foto'] = $request->file('foto')->store('image/siswa/awal');
    }

    public function updateFotoProfil($foto_profil, $request)
    {
        // Maka lakukan proses dibawah ini
        // .
        // .
        // Jika foto_profil dari database sama dengan profile.jpg
        if ($foto_profil == 'image/profil/profile.jpg') {

            // Maka masukan data foto_profil baru
            return $data['foto_profil'] = $request->file('foto_profil')->store('image/profil');

            // Jika tidak
        } else {

            // Maka hapus data foto_profil lama
            Storage::delete($foto_profil);

            // Dan masukan data foto_profil baru 
            return $data['foto_profil'] = $request->file('foto_profil')->store('image/profil');
        }
    }
}
