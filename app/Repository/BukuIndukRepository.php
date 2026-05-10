<?php

namespace App\Repository;

use App\Models\Ibu;
use App\Models\Ayah;
use App\Models\Minat;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Mutasi;
use App\Models\Walmur;
use App\Models\Biodata;
use App\Models\Beasiswa;
use App\Models\Prestasi;
use App\Models\Semester;
use App\Models\Kesehatan;
use App\Models\KelompokMapel;
use App\Models\KurikulumMapel;
use App\Models\RiwayatPendidikan;
use Illuminate\Support\Facades\Storage;

class BukuIndukRepository
{
    public function prosesUploadFile($siswaId, $lampiranMutasi, $data)
    {
        // Jika terdapat lampiran siswa tersimpan di database
        if ($lampiranMutasi) {

            // Maka hapus lampiran yang lama
            Storage::delete($lampiranMutasi);

            // Simpan lampiran baru
            $data['lampiran'] = request()->file('lampiran')->store('mutasi/surat_balasan');

            // Jika tidak ada
        } else {

            // Simpan lampiran
            $data['lampiran'] = request()->file('lampiran')->store('mutasi/surat_balasan');

            Siswa::where('id', $siswaId)->update([
                'status' => 'pindah'
            ]);
        }

        return true;
    }

    public function prosesCetakMutasiSiswa($mpdf, $siswa, $sekolah)
    {
        // Proses ubah data buku induk ke dalam pdf
        $mpdf->WriteHTML(view('binduk.mutasi.cetakMutasi', [
            'siswa'     => $siswa->with('religion')->getSiswaJoin()->first(),
            'biodata'   => Biodata::where('siswa_id', $siswa->id)->first(),
            'ripen'     => RiwayatPendidikan::with('pendidikan')->where('siswa_id', $siswa->id)->first(),
            'ayah'      => Ayah::with('agama', 'pendidikan')->where('siswa_id', $siswa->id)->first(),
            'ibu'       => Ibu::with('agama', 'pendidikan')->where('siswa_id', $siswa->id)->first(),
            'walmur'    => Walmur::with('agama', 'pendidikan')->where('siswa_id', $siswa->id)->first(),
            'sekolah'   => $sekolah,
            'mutasi'    => Mutasi::with('tingkat', 'tahunAjar')->where('siswa_id', $siswa->id)->first()
        ]));
    }

    public function prosesUploadFotoSiswa($siswa)
    {
        // Jika terdapat foto siswa tersimpan di database
        if ($siswa->foto) {

            // Maka hapus foto yang lama
            Storage::delete($siswa->foto);

            // Simpan foto baru
            $data['foto'] = request()->file('foto')->store('image/siswa/awal');

            // Jika tidak ada
        } else {

            // Simpan foto
            $data['foto'] = request()->file('foto')->store('image/siswa/awal');
        }

        return true;
    }

    public function uploadLampiranBeasiswa($beasiswa)
    {
        // Melakukan pengecekan file
        if ($beasiswa->lampiran_beasiswa) {

            // Maka hapus file yang lama
            Storage::delete($beasiswa->lampiran_beasiswa);

            // Upload file yang baru
            $data['lampiran_beasiswa'] = request()->file('lampiran_beasiswa')->store('image/siswa/beasiswa');
        } else {

            // Upload file
            $data['lampiran_beasiswa'] = request()->file('lampiran_beasiswa')->store('image/siswa/beasiswa');
        }

        return true;
    }

    public function uploadFilepiagam($prestasi)
    {
        // Melakukan pengecekan file
        if ($prestasi->piagam_prestasi) {

            // Maka hapus file yang lama
            Storage::delete($prestasi->piagam_prestasi);

            // Upload file yang baru
            $data['piagam_prestasi'] = request()->file('piagam_prestasi')->store('image/siswa/prestasi');
        } else {

            // Upload file
            $data['piagam_prestasi'] = request()->file('piagam_prestasi')->store('image/siswa/prestasi');
        }

        return true;
    }

    public function tambahNilai($siswaId)
    {
        // Tambah Nilai
        for ($i = 0; $i < count(request()->nilai); $i++) {
            if (!empty(request()->nilai[$i])) {
                if (empty(request()->nilai_id[$i])) {
                    $data = [
                        'semester_id' => request()->semester_id[$i],
                        'mapel_id'    => request()->mapel_id[$i],
                        'nilai'       => request()->nilai[$i],
                        'siswa_id'    => $siswaId,
                    ];

                    Nilai::create($data);
                }
            }
        }

        return true;
    }

    public function ubahNilai()
    {
        // Ubah Nilai
        for ($i = 0; $i < count(request()->nilai); $i++) {
            if (!empty(request()->nilai_id[$i])) {
                if (!empty(request()->nilai[$i])) {
                    $data = [
                        'nilai' => request()->nilai[$i]
                    ];

                    Nilai::where('id', request()->nilai_id[$i])->update($data);
                }
            }
        }

        return true;
    }

    public function pdfBukuInduk($mpdf, $siswa, $sekolah)
    {
        // Proses ubah data buku induk ke dalam pdf
        return $mpdf->WriteHTML(view('binduk.rekap.cetak-buku-induk', [
            'siswa'     => $siswa->with('religion')->getSiswaJoin()->first(),
            'biodata'   => Biodata::where('siswa_id', $siswa->id)->first(),
            'kesehatan' => Kesehatan::where('siswa_id', $siswa->id)->first(),
            'ripen'     => RiwayatPendidikan::with('pendidikan')->where('siswa_id', $siswa->id)->first(),
            'ayah'      => Ayah::with('agama', 'pendidikan')->where('siswa_id', $siswa->id)->first(),
            'ibu'       => Ibu::with('agama', 'pendidikan')->where('siswa_id', $siswa->id)->first(),
            'walmur'    => Walmur::with('agama', 'pendidikan')->where('siswa_id', $siswa->id)->first(),
            'minat'     => Minat::where('siswa_id', $siswa->id)->first(),
            'beasiswa'  => Beasiswa::where('siswa_id', $siswa->id)->get(),
            'prestasi'  => Prestasi::where('siswa_id', $siswa->id)->get(),
            'sekolah'   => $sekolah,
        ]));
    }

    public function pdfNilaiSiswa($mpdf, $siswa, $sekolah, $tingkat, $limitSemester)
    {
        // Proses ubah data nilai ke dalam pdf
        $mpdf->AddPage('L');
        return $mpdf->WriteHTML(view('binduk.rekap.cetak-nilai-siswa', [
            'kurMapel' => KurikulumMapel::kurMapel($siswa->kurikulum_id)
                ->orderBy('urutan_mapel', 'asc')
                ->get(),
            'kelma'    => KelompokMapel::get(),
            'tingkat'  => $tingkat,
            'semester' => Semester::with(['nilai' => function ($query) use ($siswa) {
                $query->where('siswa_id', $siswa->id);
            }])->limit($limitSemester)->get(),
            'sekolah'   => $sekolah,
        ]));
    }
}
