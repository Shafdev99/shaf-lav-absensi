<?php

namespace App\Services;

use App\Models\Mutasi;
use App\Repository\BukuIndukRepository;

class MutasiService
{
    //======== Terhubung ke BukuIndukRepository ========//
    protected $bindukRepository;

    public function __construct(BukuIndukRepository $bindukRepository)
    {
        $this->bindukRepository = $bindukRepository;
    }

    public function mutasiSiswaUpdate($siswaId, $data)
    {
        // Upload lampiran
        if (request()->file('lampiran')) {

            $lampiranMutasi = Mutasi::select('lampiran')->where('siswa_id', $siswaId)->first()->lampiran;

            $this->bindukRepository->prosesUploadFile($siswaId, $lampiranMutasi, $data);
        }

        return Mutasi::updateOrCreate(['siswa_id' => $siswaId], $data);
    }

    public function cetakMutasiSiswa($siswa, $sekolah, $mpdf)
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

        $this->bindukRepository->prosesCetakMutasiSiswa($mpdf, $siswa, $sekolah);

        return $mpdf->Output();
    }
}
