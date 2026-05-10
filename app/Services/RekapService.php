<?php

namespace App\Services;

use App\Models\Ibu;
use App\Models\Ayah;
use App\Models\Minat;
use App\Models\Siswa;
use App\Models\Walmur;
use App\Models\Biodata;
use App\Models\Beasiswa;
use App\Models\Prestasi;
use App\Models\Kesehatan;
use App\Models\LampiranSiswa;
use App\Models\RiwayatPendidikan;
use App\Repository\BukuIndukRepository;
use Illuminate\Support\Facades\Storage;

class RekapService
{
    //======== Terhubung ke BukuIndukRepository ========//
    protected $bindukRepository;

    public function __construct(BukuIndukRepository $bindukRepository)
    {
        $this->bindukRepository = $bindukRepository;
    }

    public function formSiswaUpdate($siswa)
    {
        // Validasi data dari form //
        $data = request()->validate([
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
            'foto'              => 'image|file|max:1024|mimes:jpg,jpeg,png'
        ], [
            'required'              => ':attribute wajib diisi!',
            'max'                   => ':attribute diisi maksimal :max karakter!',
            'min'                   => ':attribute diisi minimal :min karakter!',
            'unique'                => ':attribute sudah digunakan!',
            'foto.max'              => 'size :attribute maksimal :max Kb!',
            'foto.mimes'            => 'format :attribute harus :values!'
        ]);

        // Upload foto
        if (request()->file('foto')) {

            $this->bindukRepository->prosesUploadFotoSiswa($siswa);
        }

        // Include Keterangan Lulus
        $data['status'] = 'aktif';

        // Update Data ke database //
        return Siswa::where('id', $siswa->id)->update($data);
    }

    public function formOrtuUpdate($siswaId)
    {
        // Validasi data dari form //
        $data = request()->validate([
            'siswa_id'              => 'required',
            'nama_ayah'             => 'required',
            'nik_ayah'              => 'required|unique:ayah|max:16',
            'tempat_lahir_ayah'     => 'required',
            'tanggal_lahir_ayah'    => 'required',
            'alamat_ayah'           => 'required',
            'agama_ayah'            => 'required',
            'pendidikan_ayah'       => 'required',
            'pekerjaan_ayah'        => 'required',
            'penghasilan_ayah'      => 'required',
            'telp_ayah'             => 'required|max:13',
            'kewarganegaraan_ayah'  => 'required',
            'status_kematian_ayah'  => 'required',
            'nama_ibu'              => 'required',
            'nik_ibu'               => 'required|unique:ibu|max:16',
            'tempat_lahir_ibu'      => 'required',
            'tanggal_lahir_ibu'     => 'required',
            'alamat_ibu'            => 'required',
            'agama_ibu'             => 'required',
            'pendidikan_ibu'        => 'required',
            'pekerjaan_ibu'         => 'required',
            'penghasilan_ibu'       => 'required',
            'telp_ibu'              => 'required|max:13',
            'kewarganegaraan_ibu'   => 'required',
            'status_kematian_ibu'   => 'required'
        ], [
            'required'              => ':attribute wajib diisi!',
            'max'                   => ':attribute diisi maksimal :max karakter!',
            'min'                   => ':attribute diisi minimal :min karakter!'
        ]);

        // Update atau Tambah Data ke database //
        Ayah::updateOrCreate(['siswa_id' => $siswaId], $data);

        return Ibu::updateOrCreate(['siswa_id' => $siswaId], $data);
    }

    public function formBiodataUpdate($siswaId)
    {
        // Validasi data dari form //
        $data = request()->validate([
            'siswa_id'         => 'required',
            'anak_ke'          => 'required',
            'kewarganegaraan'  => 'required',
            'saudara_kandung'  => 'nullable',
            'saudara_tiri'     => 'nullable',
            'saudara_angkat'   => 'nullable',
            'kelengkapan_ortu' => 'required',
            'bahasa_harian'    => 'required',
            'tinggal_dengan'   => 'required',
            'jarak_sekolah'   => 'required',
            'telepon'          => 'required|max:13',
        ], [
            'required'         => ':attribute wajib diisi!',
            'max'              => ':attribute diisi maksimal :max karakter!'
        ]);

        // Tambah atau Update Data ke database //
        return Biodata::updateOrCreate(['siswa_id' => $siswaId], $data);
    }

    public function formWalmurUpdate($siswaId)
    {
        // Validasi data dari form //
        $data = request()->validate([
            'siswa_id'                => 'required',
            'nik_walmur'              => 'required|unique:walmur|max:16',
            'nama_walmur'             => 'required',
            'tempat_lahir_walmur'     => 'required',
            'tanggal_lahir_walmur'    => 'required',
            'alamat_walmur'           => 'required',
            'agama_walmur'            => 'required',
            'pendidikan_walmur'       => 'required',
            'pekerjaan_walmur'        => 'required',
            'penghasilan_walmur'      => 'required',
            'hubungan_siswa_walmur'    => 'required',
            'telp_walmur'             => 'required|max:13',
            'kewarganegaraan_walmur'  => 'required',
        ], [
            'required'              => ':attribute wajib diisi!',
            'max'                   => ':attribute diisi maksimal :max karakter!',
            'min'                   => ':attribute diisi minimal :min karakter!'
        ]);

        // Update atau Tambah Data ke database //
        return Walmur::updateOrCreate(['siswa_id' => $siswaId], $data);
    }

    public function formPendidikanUpdate($siswaId)
    {
        // Validasi data dari form //
        $data = request()->validate([
            'siswa_id'       => 'required',
            'pendidikan_id'  => 'required',
            'nama_sekolah'   => 'required',
            'alamat_sekolah' => 'required',
            'tahun_lulus'    => 'required',
            'no_ijazah'      => 'required|unique:riwayat_pendidikan,no_ijazah,' . request()->ripen_id,
            'tanggal_ijazah' => 'required',
            'lama_belajar'   => 'required',
        ], [
            'reqiured' => ':attr wajib diisi!'
        ]);

        // Update Data ke database //
        return RiwayatPendidikan::updateOrCreate(['siswa_id' => $siswaId], $data);
    }

    public function formKesehatanUpdate($siswaId)
    {
        // Validasi data dari form //
        $data = request()->validate([
            'siswa_id'         => 'required',
            'golongan_darah'   => 'nullable',
            'kelainan_jasmani' => 'nullable',
            'tinggi_badan'     => 'required',
            'berat_badan'      => 'required',
            'riwayat_penyakit' => 'nullable',
        ], [
            'required'         => ':attribute wajib diisi!',
        ]);

        // Tambah atau Update Data ke database //
        return Kesehatan::updateOrCreate(['siswa_id' => $siswaId], $data);
    }

    public function formMinatUpdate($siswaId)
    {

        // Validasi data dari form //
        $data = request()->validate([
            'siswa_id'   => 'required',
            'kesenian'   => 'nullable',
            'olahraga'   => 'nullable',
            'organisasi' => 'nullable',
            'lain_lain'  => 'nullable',
        ], [
            'reqiured' => ':attribute wajib diisi!'
        ]);

        // Tambah Data ke database //
        return Minat::updateOrCreate(['siswa_id' => $siswaId], $data);
    }

    public function formBeasiswaCreate()
    {
        // Validasi data dari form //
        $data = request()->validate([
            'siswa_id'          => 'required',
            'nama_beasiswa'     => 'required',
            'tahun_beasiswa'    => 'required',
            'pemberi_beasiswa'  => 'required',
            'nominal_beasiswa'  => 'required',
            'lampiran_beasiswa' => 'image|file|max:1024|mimes:jpg,jpeg,png',
        ], [
            'reqiured'                => ':attribute wajib diisi!',
            'lampiran_beasiswa.max'   => 'size :attribute maksimal :max Kb!',
            'lampiran_beasiswa.mimes' => 'format :attribute harus :values!'
        ]);

        // Upload lampiran beasiswa
        if (request()->file('lampiran_beasiswa')) {
            $data['lampiran_beasiswa'] = request()->file('lampiran_beasiswa')->store('image/siswa/beasiswa');
        }

        // Tambah Data ke database //
        return Beasiswa::create($data);
    }

    public function formBeasiswaUpdate()
    {
        // Validasi data dari form //
        $data = request()->validate([
            'siswa_id'          => 'required',
            'nama_beasiswa'     => 'required',
            'tahun_beasiswa'    => 'required',
            'pemberi_beasiswa'  => 'required',
            'nominal_beasiswa'  => 'required',
            'lampiran_beasiswa' => 'image|file|max:1024|mimes:jpg,jpeg,png',
        ], [
            'reqiured'                => ':attribute wajib diisi!',
            'lampiran_beasiswa.max'   => 'size :attribute maksimal :max Kb!',
            'lampiran_beasiswa.mimes' => 'format :attribute harus :values!'
        ]);

        // Upload lampiran beasiswa
        if (request()->file('lampiran_beasiswa')) {

            // Ambil data untuk pengecekan
            $beasiswa = Beasiswa::select('lampiran_beasiswa')->where('id', request()->beasiswa_id)->first();

            $this->bindukRepository->uploadLampiranBeasiswa($beasiswa);
        }

        // Ubah Data dari database //
        return Beasiswa::where('id', request()->beasiswa_id)->update($data);
    }

    public function formBeasiswaDelete()
    {
        // Ambil data untuk pengecekan
        $beasiswa = Beasiswa::select('lampiran_beasiswa')->where('id', request()->beasiswa_id)->first();

        // Maka hapus file yang lama
        Storage::delete($beasiswa->lampiran_beasiswa);

        // Hapus Data dari database //
        return Beasiswa::destroy(request()->beasiswa_id);
    }

    public function formPrestasiCreate()
    {
        // Validasi data dari form //
        $data = request()->validate([
            'siswa_id'               => 'required',
            'nama_prestasi'          => 'required',
            'tahun_prestasi'         => 'required',
            'penyelenggara_prestasi' => 'required',
            'tempat_prestasi'        => 'required',
            'piagam_prestasi'        => 'image|file|max:1024|mimes:jpg,jpeg,png',
        ], [
            'reqiured'                => ':attribute wajib diisi!',
            'piagam_prestasi.max'   => 'size :attribute maksimal :max Kb!',
            'piagam_prestasi.mimes' => 'format :attribute harus :values!'
        ]);

        // Upload piagam prestasi
        if (request()->file('piagam_prestasi')) {
            $data['piagam_prestasi'] = request()->file('piagam_prestasi')->store('image/siswa/prestasi');
        }

        // Tambah Data ke database //
        return Prestasi::create($data);
    }

    public function formPrestasiUpdate()
    {
        // Validasi data dari form //
        $data = request()->validate([
            'siswa_id'          => 'required',
            'nama_prestasi'          => 'required',
            'tahun_prestasi'         => 'required',
            'penyelenggara_prestasi' => 'required',
            'tempat_prestasi'        => 'required',
            'piagam_prestasi'        => 'image|file|max:1024|mimes:jpg,jpeg,png',
        ], [
            'reqiured'                => ':attribute wajib diisi!',
            'piagam_prestasi.max'   => 'size :attribute maksimal :max Kb!',
            'piagam_prestasi.mimes' => 'format :attribute harus :values!'
        ]);

        // Upload piagam prestasi
        if (request()->file('piagam_prestasi')) {

            // Ambil data untuk pengecekan
            $prestasi = Prestasi::select('piagam_prestasi')->where('id', request()->prestasi_id)->first();

            $this->bindukRepository->uploadFilePiagam($prestasi);
        }

        // Ubah Data dari database //
        return Prestasi::where('id', request()->prestasi_id)->update($data);
    }

    public function formPrestasiDelete()
    {
        // Ambil data untuk pengecekan
        $prestasi = Prestasi::select('piagam_prestasi')->where('id', request()->prestasi_id)->first();

        // Maka hapus file yang lama
        Storage::delete($prestasi->piagam_prestasi);

        // Hapus Data dari database //
        return Prestasi::destroy(request()->prestasi_id);
    }

    public function formLampiranCreate()
    {
        $data = request()->validate([
            'siswa_id'    => 'required',
            'lampiran_id' => 'required',
            'file'        => 'file|max:1024|mimes:pdf',
        ], [
            'reqiured'   => ':attribute wajib diisi!',
            'file.max'   => 'size :attribute maksimal :max Kb!',
            'file.mimes' => 'format :attribute harus :values!'
        ]);

        // Upload file lampiran
        if (request()->file('file')) {
            $data['file'] = request()->file('file')->store('lampiran');
        }

        // Set status
        $data['status'] = 'sudah';

        // Tambah Data ke database
        return LampiranSiswa::create($data);
    }

    public function formLampiranUpdate()
    {
        $data = request()->validate([
            'file'        => 'file|max:1024|mimes:pdf',
        ], [
            'reqiured'   => ':attribute wajib diisi!',
            'file.max'   => 'size :attribute maksimal :max Kb!',
            'file.mimes' => 'format :attribute harus :values!'
        ]);

        // Upload file lampiran
        if (request()->file('file')) {
            $lampiran = LampiranSiswa::select('file')->where('id', request()->lampiran_siswa_id)->first();

            if ($lampiran->file) {
                Storage::delete($lampiran->file);
                $data['file'] = request()->file('file')->store('lampiran');
            }
        }

        // Tambah Data ke database
        return LampiranSiswa::where('id', request()->lampiran_siswa_id)->update($data);
    }

    public function formLampiranDelete()
    {
        // Ambil data untuk pengecekan
        $lampiranSiswa = LampiranSiswa::select('file')->where('id', request()->lampiran_siswa_id)->first();

        // Maka hapus file yang lama
        Storage::delete($lampiranSiswa->file);

        // Hapus Data dari database //
        return LampiranSiswa::destroy(request()->lampiran_siswa_id);
    }

    public function formNilaiUpdate($siswaId)
    {
        $this->bindukRepository->tambahNilai($siswaId);

        $this->bindukRepository->ubahNilai();

        return true;
    }

    public function cetakDataSiswa($siswa, $sekolah, $mpdf, $limitSemester, $tingkat)
    {
        // Membuat footer untuk halaman cetak buku induk
        $footer = '<table width="100%">
            <tr>
                <td style="font-size:8px; height:20px;">' . $sekolah->nama_sekolah . ' - NPSN.' . $sekolah->npsn . '</td>
                <td style="text-align: right; font-size:8px;">Hal {PAGENO} dari {nbpg}</td>
            </tr> 
        </table>';

        // Memasang footer ke dalam pdf 
        $mpdf->SetFooter($footer);

        $this->bindukRepository->pdfBukuInduk($mpdf, $siswa, $sekolah);

        return $this->bindukRepository->pdfNilaiSiswa($mpdf, $siswa, $sekolah, $tingkat, $limitSemester);
    }
}
