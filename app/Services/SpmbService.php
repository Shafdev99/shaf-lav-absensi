<?php

namespace App\Services;

use App\Models\Ibu;
use App\Models\Alur;
use App\Models\Ayah;
use App\Models\Siswa;
use App\Models\Syarat;
use App\Models\Walmur;
use App\Models\Lampiran;
use App\Models\Prestasi;
use App\Models\SpmbUmum;
use App\Models\Pendaftar;
use App\Models\RekapSpmb;
use App\Models\CabutBerkas;
use App\Models\KelolaSiswa;
use App\Models\LampiranSiswa;
use App\Models\BerkasPendaftaran;
use App\Models\RiwayatPendidikan;
use App\Models\KeteranganKeterima;
use App\Repository\SpmbRepository;
use Illuminate\Support\Facades\Storage;

class SpmbService
{
    protected $SpmbRepository;
    /**
     * Create a new class instance.
     */
    public function __construct(SpmbRepository $SpmbRepository)
    {
        $this->SpmbRepository = $SpmbRepository;
    }

    public function storePendaftar($request)
    {
        // Validasi data dari form //
        $data = $request->validate([
            'nama_lengkap'      => 'required',
            'email'             => 'required',
            'tempat_lahir'      => 'required',
            'tanggal_lahir'     => 'required',
            'alamat'            => 'required',
            'agama'             => 'required',
            'nik'               => 'required|unique:pendaftar,nik|unique:siswa,nik|min:16|max:16',
            'nisn'              => 'required|unique:pendaftar,nisn|unique:siswa,nisn|min:10',
            'alamat'            => 'required',
            'jenis_kelamin'     => 'required',
            'agama'             => 'required',
            'foto'              => 'image|file|max:1024|mimes:jpg,jpeg,png',
            'kelas_id'          => 'required',
            'tingkat_id'        => 'required',
            'jurusan_id'        => 'required',
            'tanggal_keterima'  => 'required',
            'tahun_ajar_id'     => 'required',
            'nama_ayah'         => 'required',
            'pekerjaan_ayah'    => 'required',
            'nama_ibu'          => 'required',
            'pekerjaan_ibu'     => 'required',
            'alamat_ortu'       => 'required',
            'nama_wali'         => 'nullable',
            'pekerjaan_wali'    => 'nullable',
            'alamat_wali'       => 'nullable',
            'asal_sekolah'      => 'required',
            'alamat_sekolah'    => 'required',
            'no_ijazah'         => 'required|unique:berkas_pendaftaran',
            'rata_nilai'        => 'required',
            'ijazah'            => 'required|image|file|max:1024|mimes:jpg,jpeg,png',
            'kartu_keluarga'    => 'required|image|file|max:1024|mimes:jpg,jpeg,png',
            'akta_kelahiran'    => 'required|image|file|max:1024|mimes:jpg,jpeg,png',
            'piagam_prestasi'   => 'image|file|max:1024|mimes:jpg,jpeg,png',
            'kartu_bantuan'     => 'image|file|max:1024|mimes:jpg,jpeg,png',
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

        // Upload foto
        if ($request->file('foto')) {
            $data['foto'] = $this->uploadFile($request->file('foto'), 'foto', null, 'berkas/foto');
        }

        // Upload ijazah
        if ($request->file('ijazah')) {
            $ijazah = $this->uploadFile($request->file('ijazah'), 'ijazah', null, 'berkas/ijazah');
        }

        // Upload kartu_keluarga
        if ($request->file('kartu_keluarga')) {
            $kartu_keluarga = $this->uploadFile($request->file('kartu_keluarga'), 'kartu_keluarga', null, 'berkas/kartu_keluarga');
        }

        // Upload akta_kelahiran
        if ($request->file('akta_kelahiran')) {
            $akta_kelahiran = $this->uploadFile($request->file('akta_kelahiran'), 'akta_kelahiran', null, 'berkas/akta_kelahiran');
        }

        $piagam_prestasi = null;
        // Upload piagam_prestasi
        if ($request->file('piagam_prestasi')) {
            $piagam_prestasi = $this->uploadFile($request->file('piagam_prestasi'), 'piagam_prestasi', null, 'berkas/piagam_prestasi');
        }

        $kartu_bantuan = null;
        // Upload kartu_bantuan
        if ($request->file('kartu_bantuan')) {
            $kartu_bantuan = $this->uploadFile($request->file('kartu_bantuan'), 'kartu_bantuan', null, 'berkas/kartu_bantuan');
        }

        $pendaftar = $this->SpmbRepository->savePendaftar($data, $request, $kartu_bantuan, $piagam_prestasi, $kartu_keluarga, $ijazah, $akta_kelahiran);

        return $pendaftar;
    }

    private function uploadFile($inputFile, $namaFile, $file, $folder)
    {
        if ($file) {
            Storage::delete($file);
        }

        // Membuat custom nama untuk gambar yang akan diupload
        $customName = $namaFile . '_' . time() . '.' . $inputFile->getClientOriginalExtension();

        return $inputFile->storeAs('spmb/' . $folder, $customName, 'public');
    }

    public function addSyarat($request)
    {
        $request->validate([
            'syarat' => 'required'
        ]);

        Syarat::updateOrCreate([
            'id' => $request->input('syarat_id')
        ], [
            'syarat' => $request->input('syarat')
        ]);
    }

    public function addAlur($request)
    {
        $request->validate([
            'alur' => 'required'
        ]);

        Alur::updateOrCreate([
            'id' => $request->input('alur_id')
        ], [
            'alur' => $request->input('alur')
        ]);
    }

    public function updateUmum($request)
    {
        $data = $request->validate([
            'tahun_ajar_id'     => 'required',
            'link_grup'         => 'nullable',
            'label_antrian'     => 'required|max:6',
            'gambar_background' => 'image|max:1024|mimes:jpg,jpeg,png',
            'brosur_depan'      => 'image|file|max:1024|mimes:jpg,jpeg,png',
            'brosur_belakang'   => 'image|file|max:1024|mimes:jpg,jpeg,png',
            'logo_pendaftaran'  => 'image|file|max:1024|mimes:jpg,jpeg,png'
        ], [
            'label_antrian.max' => ':attribute maksimal :max!',
            'required'          => ':attribute harus diisi!',
            'max'               => 'size :attribute maksimal :max Kb!',
            'gambar_background.mimes' => 'format :attribute harus :values!',
            'brosur_depan.mimes'      => 'format :attribute harus :values!',
            'brosur_belakang.mimes'   => 'format :attribute harus :values!',
            'logo_pendaftaran.mimes'  => 'format :attribute harus :values!'
        ]);

        $umum = SpmbUmum::select(
            'gambar_background',
            'brosur_depan',
            'brosur_belakang',
            'logo_pendaftaran'
        )->first();
        $imageBg = $umum->gambar_background;
        $brosurDepan = $umum->brosur_depan;
        $brosurBelakang = $umum->brosur_belakang;
        $logoPendaftaran = $umum->logo_pendaftaran;

        // Upload Background
        if ($request->file('gambar_background')) {
            $data['gambar_background'] = $this->uploadFile($request->file('gambar_background'), 'gambar_background', $imageBg, 'background');
        }

        // Upload Brosur Depan
        if ($request->file('brosur_depan')) {
            $data['brosur_depan'] = $this->uploadFile($request->file('brosur_depan'), 'brosur_depan', $brosurDepan, 'brosur');
        }

        // Upload Brosur Belakang
        if ($request->file('brosur_belakang')) {
            $data['brosur_belakang'] = $this->uploadFile($request->file('brosur_belakang'), 'brosur_belakang', $brosurBelakang, 'brosur');
        }

        // Upload Logo Pendaftaran
        if ($request->file('logo_pendaftaran')) {
            $data['logo_pendaftaran'] = $this->uploadFile($request->file('logo_pendaftaran'), 'logo_pendaftaran', $logoPendaftaran, 'brosur');
        }

        SpmbUmum::updateOrCreate(
            ['id' => $request->input('umum_id')],
            $data
        );
    }


    public function ubahStatusPendaftar($request)
    {
        $statusPendaftar = null;
        if ($request->input('status_pendaftar') == 'diterima') {
            $statusPendaftar = 'diterima';
        } elseif ($request->input('status_pendaftar') == 'dicabut') {
            $statusPendaftar = 'dicabut';
        } elseif ($request->input('status_pendaftar') == 'ditolak') {
            $statusPendaftar = 'ditolak';
        } else {
            $statusPendaftar = 'terdaftar';
        }

        Pendaftar::where('id', $request->input('pendaftar_id'))->update([
            'status' => $statusPendaftar
        ]);
    }


    public function hapusPendaftar($request)
    {
        $id = $request->input('pendaftar_id');
        $berkas = BerkasPendaftaran::select('ijazah', 'akta_kelahiran', 'kartu_keluarga', 'piagam_prestasi', 'kartu_bantuan')->where('pendaftar_id', $id)->first();
        $foto = Pendaftar::select('foto')->where('id', $id)->first();
        $this->SpmbRepository->hapusPendaftar($id, $berkas, $foto);
        Pendaftar::destroy($id);
    }

    public function perbaruiPendaftar($request, $pendaftarId)
    {
        $berkas = BerkasPendaftaran::select(
            'id',
            'ijazah',
            'akta_kelahiran',
            'kartu_keluarga',
            'kartu_bantuan',
            'piagam_prestasi'
        )
            ->where('pendaftar_id', $pendaftarId)
            ->first();

        // Validasi data dari form //
        $request->validate([
            'nama_lengkap'      => 'required',
            'email'             => 'required',
            'tempat_lahir'      => 'required',
            'tanggal_lahir'     => 'required',
            'agama'             => 'required',
            'nik'               => 'required|unique:pendaftar,nik,' . $pendaftarId . '|min:16',
            'nisn'              => 'required|unique:pendaftar,nisn,' . $pendaftarId . '|min:10',
            'alamat'            => 'required',
            'jenis_kelamin'     => 'required',
            'agama'             => 'required',
            'foto'              => 'image|file|max:1024|mimes:jpg,jpeg,png',
            'kelas_id'          => 'required',
            'tingkat_id'        => 'required',
            'jurusan_id'        => 'required',
            'tanggal_keterima'  => 'required',
            'tahun_ajar'        => 'required',
            'nama_ayah'         => 'required',
            'pekerjaan_ayah'    => 'required',
            'nama_ibu'          => 'required',
            'pekerjaan_ibu'     => 'required',
            'alamat_ortu'       => 'required',
            'nama_wali'         => 'nullable',
            'pekerjaan_wali'    => 'nullable',
            'alamat_wali'       => 'nullable',
            'asal_sekolah'      => 'required',
            'alamat_sekolah'    => 'required',
            'no_ijazah'         => 'required|unique:berkas_pendaftaran,no_ijazah,' . $berkas->id,
            'rata_nilai'        => 'required',
            'ijazah'            => 'image|file|max:1024|mimes:jpg,jpeg,png',
            'kartu_keluarga'    => 'image|file|max:1024|mimes:jpg,jpeg,png',
            'akta_kelahiran'    => 'image|file|max:1024|mimes:jpg,jpeg,png',
            'piagam_prestasi'   => 'image|file|max:1024|mimes:jpg,jpeg,png',
            'kartu_bantuan'     => 'image|file|max:1024|mimes:jpg,jpeg,png',
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

        $file = Pendaftar::select('foto')
            ->where('id', $pendaftarId)
            ->first();

        // Upload foto
        $foto = $file?->foto;
        if ($request->file('foto')) {
            $foto = $this->uploadFile($request->file('foto'), 'foto', $file?->foto, 'berkas/foto');
        }

        // Upload ijazah
        $ijazah = $berkas?->ijazah;
        if ($request->file('ijazah')) {
            $ijazah = $this->uploadFile($request->file('ijazah'), 'ijazah', $file?->ijazah, 'berkas/ijazah');
        }

        // Upload kartu_keluarga
        $kartu_keluarga = $berkas?->kartu_keluarga;
        if ($request->file('kartu_keluarga')) {
            $kartu_keluarga = $this->uploadFile($request->file('kartu_keluarga'), 'kartu_keluarga', $file?->kartu_keluarga, 'berkas/kartu_keluarga');
        }

        // Upload akta_kelahiran
        $akta_kelahiran = $berkas?->akta_kelahiran;
        if ($request->file('akta_kelahiran')) {
            $akta_kelahiran = $this->uploadFile($request->file('akta_kelahiran'), 'akta_kelahiran', $file?->akta_kelahiran, 'berkas/akta_kelahiran');
        }

        // Upload piagam_prestasi
        $piagam_prestasi = $berkas?->piagam_prestasi;
        if ($request->file('piagam_prestasi')) {
            $piagam_prestasi = $this->uploadFile($request->file('piagam_prestasi'), 'piagam_prestasi', $file?->piagam_prestasi, 'piagam_prestasi');
        }

        // Upload kartu_bantuan
        $kartu_bantuan = $berkas?->kartu_bantuan;
        if ($request->file('kartu_bantuan')) {
            $kartu_bantuan = $this->uploadFile($request->file('kartu_bantuan'), 'kartu_bantuan', $file?->kartu_bantuan, 'berkas/kartu_bantuan');
        }

        $this->SpmbRepository->perbaruiPendaftar($request, $pendaftarId, $foto, $ijazah, $kartu_keluarga, $akta_kelahiran, $piagam_prestasi, $kartu_bantuan);
    }

    public function cabutBerkas($request)
    {
        $data = $request->validate([
            'bukti_pencabutan'      => 'required|image|file|max:1024|mimes:jpg,jpeg,png',
            'keterangan_pencabutan' => 'required'
        ], [
            'required'               => ':attribute wajib diisi!',
            'bukti_pencabutan.max'   => 'size :attribute maksimal :max Kb!',
            'bukti_pencabutan.mimes' => 'format :attribute harus :values!'
        ]);

        if ($request->file('bukti_pencabutan')) {
            $data['bukti_pencabutan'] = $this->uploadFile($request->file('bukti_pencabutan'), 'cabut_berkas', null, 'berkas/cabut_berkas');
        }

        $data['pendaftar_id'] = $request->input('pendaftar_id');

        Pendaftar::where('id', $request->input('pendaftar_id'))->update([
            'status' => 'ditolak',
            'kondisi_berkas' => 'dicabut'
        ]);
        CabutBerkas::create($data);
    }

    public function spmbMigrasi($pendaftar, $pendidikan)
    {
        $berkas = BerkasPendaftaran::where('pendaftar_id', $pendaftar->id)->first();
        $siswa = $this->insertSiswa($pendaftar);
        $this->updateDataTerkait($pendaftar->id, $siswa->id, $berkas, $pendidikan->id);
        $this->migrasiBerkas('Ijazah', $siswa->id, $berkas->ijazah);
        $this->migrasiBerkas('Akta', $siswa->id, $berkas->akta_kelahiran);
        $this->migrasiBerkas('Kartu Keluarga', $siswa->id, $berkas->kartu_keluarga);

        if ($berkas?->kartu_bantuan != null) {
            $this->migrasiBerkas('Kartu Bantuan', $siswa->id, $berkas->kartu_bantuan);
        }

        if ($berkas?->prestasi != null) {
            $this->migrasiPrestasi('Lomba', $siswa->id, $berkas?->prestasi);
        }

        $this->insertRekap($pendaftar);
    }

    private function insertSiswa($pendaftar)
    {
        return Siswa::create([
            'kurikulum_id'  => $pendaftar->kurikulum_id,
            'nama_lengkap'  => $pendaftar->nama_lengkap,
            'tanggal_lahir' => $pendaftar->tanggal_lahir,
            'tempat_lahir'  => $pendaftar->tempat_lahir,
            'nisn'          => $pendaftar->nisn,
            'nik'           => $pendaftar->nik,
            'nis'           => '000000',
            'alamat'        => $pendaftar->alamat,
            'jenis_kelamin' => $pendaftar->jenis_kelamin,
            'agama'         => $pendaftar->agama,
            'foto'          => $pendaftar->foto,
            'status'        => 'aktif'
        ]);
    }

    public function insertRekap($pendaftar)
    {
        return RekapSpmb::create([
            'id'               => $pendaftar->id,
            'no_pendaftaran'   => $pendaftar->no_pendaftaran,
            'kurikulum_id'     => $pendaftar->kurikulum_id,
            'nama_lengkap'     => $pendaftar->nama_lengkap,
            'tanggal_lahir'    => $pendaftar->tanggal_lahir,
            'tempat_lahir'     => $pendaftar->tempat_lahir,
            'nisn'             => $pendaftar->nisn,
            'nik'              => $pendaftar->nik,
            'alamat'           => $pendaftar->alamat,
            'jenis_kelamin'    => $pendaftar->jenis_kelamin,
            'agama'            => $pendaftar->agama,
            'foto'             => $pendaftar->foto,
            'status'           => 'arsip',
            'kondisi_berkas'   => $pendaftar->kondisi_berkas,
            'penanggung_jawab' => $pendaftar->penanggung_jawab,
        ]);
    }

    private function updateDataTerkait($pendaftarId, $siswaId, $berkas, $pendidikanId)
    {
        Ayah::where('siswa_id', $pendaftarId)->update([
            'siswa_id' => $siswaId
        ]);

        Ibu::where('siswa_id', $pendaftarId)->update([
            'siswa_id' => $siswaId
        ]);

        Walmur::where('siswa_id', $pendaftarId)->update([
            'siswa_id' => $siswaId
        ]);

        $keteranganKeterima = KeteranganKeterima::select('jurusan_id', 'tingkat_id', 'tanggal_keterima', 'kelas_id', 'tahun_ajar_id')->where('siswa_id', $pendaftarId)->first();

        KelolaSiswa::create([
            'siswa_id'      => $siswaId,
            'kelas_id'      => $keteranganKeterima->kelas_id,
            'tahun_ajar_id' => $keteranganKeterima->tahun_ajar_id
        ]);

        KeteranganKeterima::where('siswa_id', $pendaftarId)->update([
            'siswa_id' => $siswaId
        ]);

        KeteranganKeterima::create([
            'siswa_id'         => $pendaftarId,
            'tingkat_id'       => $keteranganKeterima->tingkat_id,
            'jurusan_id'       => $keteranganKeterima->jurusan_id,
            'kelas_id'         => $keteranganKeterima->kelas_id,
            'tanggal_keterima' => $keteranganKeterima->tanggal_keterima,
            'tahun_ajar_id'    => $keteranganKeterima->tahun_ajar_id,
        ]);

        RiwayatPendidikan::create([
            'siswa_id' => $siswaId,
            'pendidikan_id' => $pendidikanId,
            'nama_sekolah' => $berkas->asal_sekolah,
            'alamat_sekolah' => $berkas->alamat_sekolah,
            'no_ijazah' => $berkas->no_ijazah,
            'tahun_lulus' => 0000,
            'tanggal_ijazah' => 0000,
            'lama_belajar' => 0000,
        ]);

        return true;
    }

    private function migrasiBerkas($namaBerkas, $siswaId, $berkas)
    {
        $lampiranId = Lampiran::select('id')
            ->where(
                'lampiran',
                'like',
                '%' . $namaBerkas . '%'
            )->first()?->id;

        if ($lampiranId == null) {
            $lampiran = Lampiran::create([
                'lampiran' => $namaBerkas,
                'status' => 'wajib'
            ]);

            // $berkasBaru = $this->uploadBerkasMigrasi($namaBerkas, 'lampiran', $berkas);

            LampiranSiswa::create([
                'lampiran_id' => $lampiran?->id,
                'siswa_id' => $siswaId,
                'status' => 'sudah',
                'file' => $berkas,
            ]);
        } else {
            // $berkasBaru = $this->uploadBerkasMigrasi($namaBerkas, 'lampiran', $berkas);

            LampiranSiswa::create([
                'lampiran_id' => $lampiranId,
                'siswa_id' => $siswaId,
                'status' => 'sudah',
                'file' => $berkas,
            ]);
        }

        return true;
    }

    private function migrasiPrestasi($namaPrestasi, $siswaId, $berkas)
    {
        // $berkasBaru = $this->uploadBerkasMigrasi($namaPrestasi, 'siswa/prestasi', $berkas);
        Prestasi::create([
            'siswa_id' => $siswaId,
            'nama_prestasi' => $namaPrestasi,
            'tahun_prestasi' => date('d-m-y'),
            'penyelenggara_prestasi' => date('d-m-y'),
            'tempat_prestasi' => 'Belum ada data!',
            'piagam_prestasi' => $berkas,
        ]);

        return true;
    }

    public function terimaBeberapa($siswaId)
    {
        $item = explode(',', $siswaId);
        for ($i = 0; $i < count($item); $i++) {
            Pendaftar::where('id', $item[$i])->update([
                'status' => 'diterima'
            ]);
        }
    }

    public function hapusGambarSpmb($request)
    {
        $kolom = $request->input('kolom');
        Storage::delete($request->input('gambar'));
        SpmbUmum::where('id', $request->input('umum_id'))->update([
            $kolom => NULL
        ]);
    }
}
