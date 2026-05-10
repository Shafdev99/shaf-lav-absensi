<?php

namespace App\Services;

use App\Models\Ibu;
use App\Models\Ayah;
use App\Models\User;
use App\Models\Minat;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Mutasi;
use App\Models\Walmur;
use App\Models\Biodata;
use App\Models\Beasiswa;
use App\Models\Prestasi;
use App\Models\Kesehatan;
use App\Models\KelolaSiswa;
use App\Models\LampiranSiswa;
use App\Models\RiwayatPendidikan;
use App\Models\KeteranganKeterima;
use App\Http\Controllers\Controller;
use App\Repository\MasterRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class MasterService extends Controller
{
    protected $masterRepository;

    public function __construct(MasterRepository $masterRepository)
    {
        $this->masterRepository = $masterRepository;
    }

    // Method tambah data siswa
    public function createSiswa($request)
    {
        // Input Data ke database //
        $siswa = $this->masterRepository->insertSiswa($request);

        KelolaSiswa::create([
            'siswa_id'          => $siswa->id,
            'kelas_id'          => $request->input('kelas_id'),
            'tahun_ajar_id'     => session('tahun_ajar_id'),
        ]);

        $KeteranganKeterima = [
            'siswa_id'          => $siswa->id,
            'tingkat_id'        => $request->input('tingkat_id'),
            'jurusan_id'        => $request->input('jurusan_id'),
            'kelas_id'          => $request->input('kelas_id'),
            'tanggal_keterima'  => $request->input('tanggal_keterima'),
            'tahun_ajar_id'     => session('tahun_ajar_id'),
        ];

        return KeteranganKeterima::create($KeteranganKeterima);
    }

    // Method ubah data siswa
    public function updateSiswa($request, $siswa)
    {
        $this->masterRepository->updateSiswa($request, $siswa);

        KelolaSiswa::where('siswa_id', $siswa->id,)->update([
            'kelas_id' => $request->input('kelas_id')
        ]);

        $KeteranganKeterima = [
            'tingkat_id'       => $request->input('tingkat_id'),
            'jurusan_id'       => $request->input('jurusan_id'),
            'kelas_id'         => $request->input('kelas_id'),
            'tanggal_keterima' => $request->input('tanggal_keterima')
        ];

        return KeteranganKeterima::where('siswa_id', $siswa->id)->update($KeteranganKeterima);
    }

    // Method hapus data siswa
    public function deleteSiswa($id)
    {

        // Ambil data siswa dari database
        $siswa = Siswa::select('foto', 'nama_lengkap')->where('id', $id)->first();

        // Function Aclog untuk merekam acitivtas setiap ada perubahan
        // $this->record(Auth::user()->id, 'Hapus data siswa', $siswa->nama_lengkap, 'Menghapus data siswa', date('Y-m-d'), date('H:i'));

        // Jika terdapat foto siswa tersimpan di database
        if ($siswa->foto) {

            // Maka hapus foto
            Storage::delete($siswa->foto);
        }

        // Hapus data siswa terpilih pada tabel binduk berdasarkan ID siswa
        return $this->hapusFileTableTerhubung($id);
    }

    private function hapusFileTableTerhubung($id)
    {
        $this->hapusDataTerhubung($id);

        //Hapus Beserta File
        $beasiswa = Beasiswa::where('siswa_id', $id);
        $this->deleteFileTerhubung($beasiswa, 'lampiran_beasiswa');

        $prestasi = Prestasi::where('siswa_id', $id);
        $this->deleteFileTerhubung($prestasi, 'piagam_prestasi');

        $lampiran_siswa = LampiranSiswa::where('siswa_id', $id);
        $this->deleteFileTerhubung($lampiran_siswa, 'file');

        $mutasi = Mutasi::where('siswa_id', $id);
        return $this->deleteFileTerhubung($mutasi, 'lampiran');
    }

    private function deleteFileTerhubung($table, $namaFile)
    {
        $lampiran = $table->select($namaFile)->first()?->namaFile;
        if ($lampiran) {
            Storage::delete($lampiran);
        }
        return $table->delete();
    }

    private function hapusDataTerhubung($id)
    {
        Biodata::where('siswa_id', $id)->delete();
        Ayah::where('siswa_id', $id)->delete();
        Ibu::where('siswa_id', $id)->delete();
        Walmur::where('siswa_id', $id)->delete();
        RiwayatPendidikan::where('siswa_id', $id)->delete();
        Kesehatan::where('siswa_id', $id)->delete();
        Minat::where('siswa_id', $id)->delete();
        return Nilai::where('siswa_id', $id)->delete();
    }

    // Method hapus beberapa data siswa
    public function deleteSomeSiswa($request)
    {
        // Ambil ID Siswa berupa string array dari form
        $siswa = $request->siswa_id;

        // Gabungkan string array
        $id = implode(",", $siswa);

        // Dan pecah jadi array murni
        $siswa_id = explode(",", $id);

        // Proses menghapus berulang berdasarkan ID
        foreach ($siswa_id as $id) {

            $this->deleteSiswa($id);
        }

        // Hapus data siswa
        KeteranganKeterima::where('siswa_id', $id)->delete();
        KelolaSiswa::where('siswa_id', $id)->delete();
        return Siswa::destroy($id);
        // return true;
    }


    // Method ubah foto profil
    public function updateFotoProfil($request)
    {
        // Ambil data user dari database
        $foto_profil = User::select('foto_profil')->where('id', Auth::user()->id)->first();

        // Validasi data dari form
        $data = $request->validate([
            'foto_profil'   => 'image|file|max:1024|mimes:jpg,jpeg,png'
        ], [
            'foto_profil.max'   => 'size :attribute maksimal :max Kb!',
            'foto_profil.mimes' => 'format :attribute harus :values!',
        ]);

        // Jika foto_profil dimasukkan
        if ($request->file('foto_profil')) {

            $this->masterRepository->updateFotoProfil($foto_profil, $request);
        }

        // Ubah data user dari database
        return User::where('id', Auth::user()->id)->update($data);
    }

    public function updateProfil()
    {
        // Validasi data dari form
        $data = request()->validate([
            'name'          => 'required',
            'username'      => 'required',
            'email'         => 'required|email:rfc,dns|unique:users,email,' . Auth::user()->id,
            'foto_profil'   => 'image|file|max:1024|mimes:jpg,jpeg,png'
        ], [
            'required'          => ':attribute wajib diisi!',
            'foto_profil.max'   => 'size :attribute maksimal :max Kb!',
            'foto_profil.mimes' => 'format :attribute harus :values!',
        ]);

        // Ubah data user dari database
        return User::where('id', Auth::user()->id)->update($data);
    }

    public function resetPassProfil()
    {
        // Validasi data dari form
        request()->validate([
            'password' => 'required|min:3|max:8'
        ], [
            'required'  => ':attribute wajib diisi!',
            'max'       => ':attribute diisi maksimal :max karakter!',
            'min'       => ':attribute diisi minimal :min karakter!',
        ]);

        // Ubah data user dari database
        return User::where('id', Auth::user()->id)->update([
            'password' => Hash::make(request()->password),
            'request'  => NULL
        ]);
    }
}
