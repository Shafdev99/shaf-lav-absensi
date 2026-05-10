<?php

namespace App\Repository;

use App\Models\Ibu;
use App\Models\Ayah;
use App\Models\Walmur;
use App\Models\SpmbUmum;
use App\Models\Pendaftar;
use App\Models\TahunAjar;
use Illuminate\Support\Str;
use App\Models\BerkasPendaftaran;
use App\Models\KeteranganKeterima;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SpmbRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function savePendaftar($data, $request, $kartu_bantuan, $piagam_prestasi, $kartu_keluarga, $ijazah, $akta_kelahiran)
    {
        // Include Detail Pendaftaran
        $label = SpmbUmum::select('label_antrian')->first()->label_antrian;
        $lastQueue = Pendaftar::latest()->first();
        $first = Str::substr($lastQueue?->no_pendaftaran, -4);
        $antrian = intval($first) + 1;
        $noPendaftaran = $label . str_pad($lastQueue ? $antrian : 1, 4, '0', STR_PAD_LEFT);
        $tahunAjarId = SpmbUmum::select('tahun_ajar_id')->first()->tahun_ajar_id;
        $kurikulumId = TahunAjar::select('kurikulum_id')->where('id', $tahunAjarId)->first()->kurikulum_id;

        $data['no_pendaftaran']   = $noPendaftaran;
        $data['status']           = 'terdaftar';
        $data['kondisi_berkas']   = 'diarsip';
        $data['penanggung_jawab'] = Auth::user()->name;
        $data['kurikulum_id']     = $kurikulumId;

        $pendaftar = Pendaftar::create($data);

        Ayah::create([
            'siswa_id'       => $pendaftar->id,
            'nama_ayah'      => $request->input('nama_ayah'),
            'pekerjaan_ayah' => $request->input('pekerjaan_ayah'),
            'alamat_ayah'    => $request->input('alamat_ortu'),
        ]);

        Ibu::create([
            'siswa_id'      => $pendaftar->id,
            'nama_ibu'      => $request->input('nama_ibu'),
            'pekerjaan_ibu' => $request->input('pekerjaan_ibu'),
        ]);

        if ($request->input('nama_wali') || $request->input('pekerjaan_wali') || $request->input('alamat_wali')) {
            Walmur::create([
                'siswa_id'         => $pendaftar->id,
                'nama_walmur'      => $request->input('nama_wali'),
                'pekerjaan_walmur' => $request->input('pekerjaan_wali'),
                'alamat_walmur'    => $request->input('alamat_wali'),
            ]);
        }

        BerkasPendaftaran::create([
            'pendaftar_id'    => $pendaftar->id,
            'no_ijazah'       => $request->input('no_ijazah'),
            'asal_sekolah'    => $request->input('asal_sekolah'),
            'alamat_sekolah'  => $request->input('alamat_sekolah'),
            'rata_nilai'      => $request->input('rata_nilai'),
            'ijazah'          => $ijazah,
            'kartu_keluarga'  => $kartu_keluarga,
            'akta_kelahiran'  => $akta_kelahiran,
            'piagam_prestasi' => $piagam_prestasi,
            'kartu_bantuan'   => $kartu_bantuan,
        ]);

        KeteranganKeterima::create([
            'siswa_id'         => $pendaftar->id,
            'tingkat_id'       => $request->input('tingkat_id'),
            'jurusan_id'       => $request->input('jurusan_id'),
            'kelas_id'         => $request->input('kelas_id'),
            'tanggal_keterima' => $request->input('tanggal_keterima'),
            'tahun_ajar_id'    => $request->input('tahun_ajar_id'),
        ]);

        return $pendaftar;
    }

    public function hapusPendaftar($id, $berkas, $foto)
    {
        Storage::delete($foto?->foto);
        Storage::delete($berkas?->ijazah);
        Storage::delete($berkas?->akta_kelahiran);
        Storage::delete($berkas?->kartu_keluarga);

        if ($berkas?->piagam_prestasi) {
            Storage::delete($berkas?->piagam_prestasi);
        }
        if ($berkas?->kartu_bantuan) {
            Storage::delete($berkas?->kartu_bantuan);
        }

        Ayah::where('siswa_id', $id)->delete();
        Ibu::where('siswa_id', $id)->delete();
        Walmur::where('siswa_id', $id)->delete();
        KeteranganKeterima::where('siswa_id', $id)->delete();
        BerkasPendaftaran::where('pendaftar_id', $id)->delete();
    }

    public function perbaruiPendaftar($request, $pendaftarId, $foto, $ijazah, $kartu_keluarga, $akta_kelahiran, $piagam_prestasi, $kartu_bantuan)
    {
        Pendaftar::where('id', $pendaftarId)->update([
            'nama_lengkap'      => $request->input('nama_lengkap'),
            'email'             => $request->input('email'),
            'tempat_lahir'      => $request->input('tempat_lahir'),
            'tanggal_lahir'     => $request->input('tanggal_lahir'),
            'agama'             => $request->input('agama'),
            'nik'               => $request->input('nik'),
            'nisn'              => $request->input('nisn'),
            'alamat'            => $request->input('alamat'),
            'jenis_kelamin'     => $request->input('jenis_kelamin'),
            'agama'             => $request->input('agama'),
            'foto'              => $foto,
        ]);

        Ayah::where('siswa_id', $pendaftarId)->update([
            'siswa_id'       => $pendaftarId,
            'nama_ayah'      => $request->input('nama_ayah'),
            'pekerjaan_ayah' => $request->input('pekerjaan_ayah'),
            'alamat_ayah'    => $request->input('alamat_ortu'),
        ]);

        Ibu::where('siswa_id', $pendaftarId)->update([
            'siswa_id'      => $pendaftarId,
            'nama_ibu'      => $request->input('nama_ibu'),
            'pekerjaan_ibu' => $request->input('pekerjaan_ibu'),
        ]);

        if ($request->input('nama_wali') || $request->input('pekerjaan_wali') || $request->input('alamat_wali')) {
            Walmur::where('siswa_id', $pendaftarId)->update([
                'siswa_id'         => $pendaftarId,
                'nama_walmur'      => $request->input('nama_wali'),
                'pekerjaan_walmur' => $request->input('pekerjaan_wali'),
                'alamat_walmur'    => $request->input('alamat_wali'),
            ]);
        }

        BerkasPendaftaran::where('pendaftar_id', $pendaftarId)->update([
            'pendaftar_id'    => $pendaftarId,
            'no_ijazah'       => $request->input('no_ijazah'),
            'asal_sekolah'    => $request->input('asal_sekolah'),
            'alamat_sekolah'  => $request->input('alamat_sekolah'),
            'rata_nilai'      => $request->input('rata_nilai'),
            'ijazah'          => $ijazah,
            'kartu_keluarga'  => $kartu_keluarga,
            'akta_kelahiran'  => $akta_kelahiran,
            'piagam_prestasi' => $piagam_prestasi,
            'kartu_bantuan'   => $kartu_bantuan,
        ]);

        KeteranganKeterima::where('siswa_id', $pendaftarId)->update([
            'siswa_id'         => $pendaftarId,
            'tingkat_id'       => $request->input('tingkat_id'),
            'jurusan_id'       => $request->input('jurusan_id'),
            'kelas_id'         => $request->input('kelas_id'),
            'tanggal_keterima' => $request->input('tanggal_keterima'),
            'tahun_ajar'       => $request->input('tahun_ajar'),
        ]);
    }
}
