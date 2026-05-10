<?php

namespace App\Http\Controllers;

use App\Models\Ibu;
use App\Models\Alur;
use App\Models\Ayah;
use App\Models\Agama;
use App\Models\Brosur;
use App\Models\Sosmed;
use App\Models\Syarat;
use App\Models\Walmur;
use App\Models\Jurusan;
use App\Models\Setting;
use App\Models\Tingkat;
use App\Models\SpmbUmum;
use App\Models\Pendaftar;
use App\Models\RekapSpmb;
use App\Models\TahunAjar;
use Illuminate\View\View;
use App\Models\Pendidikan;
use App\Models\CabutBerkas;
use Illuminate\Http\Request;
use App\Services\SpmbService;
use App\Exports\PendaftarExport;
use App\Models\BerkasPendaftaran;
use Illuminate\Http\JsonResponse;
use App\Models\KeteranganKeterima;
use App\Http\Controllers\Controller;
use App\Mail\EmailBuktiPendaftaran;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SpmbController extends Controller
{
    protected $SpmbService;

    public function __construct(SpmbService $SpmbService)
    {
        $this->SpmbService = $SpmbService;
    }

    public function halamanDaftar(): View
    {
        return view('spmb.halaman-daftar', [
            'sosmed'     => Sosmed::get(),
            'background' => SpmbUmum::select('gambar_background')->first()?->gambar_background,
            'logo'       => SpmbUmum::select('logo_pendaftaran')->first()?->logo_pendaftaran,
            'setting'    => Setting::first()
        ]);
    }

    public function formDaftar(): View
    {
        $tahunAjarId = SpmbUmum::select('tahun_ajar_id')->first()->tahun_ajar_id;
        return view('spmb.form-daftar', [
            'tingkat'   => Tingkat::select('id', 'tingkat')->orderBy('tingkat', 'asc')->first(),
            'jurusan'   => Jurusan::tersedia()->get(),
            'tahunAjar' => TahunAjar::select('id', 'tahun_ajar')->where('id', $tahunAjarId)->first(),
            'agama'     => Agama::select('id', 'agama')->get()
        ]);
    }

    public function prosesDaftarCmb(Request $request): RedirectResponse
    {
        $pendaftar = $this->storePendaftar($request);
        return to_route('halaman.konfirmasi', $pendaftar->id);
    }

    private function storePendaftar($request): Pendaftar
    {
        return $this->SpmbService->storePendaftar($request);
    }

    public function buktiPendaftaran($pendaftarId): void
    {

        // Mengolah HTML dan PHP menjadi pdf
        $mpdf = new \Mpdf\Mpdf();

        $pendaftar = Pendaftar::with('religion')->find($pendaftarId);

        $sekolah = Setting::first();
        $umum = SpmbUmum::select('link_grup', 'logo_pendaftaran')->first();

        // Membuat footer untuk halaman cetak buku induk
        $footer = '<table width="100%">
            <tr>
                <td style="font-size:8px; height:20px;">' . $sekolah->nama_sekolah . ' - NPSN.' . $sekolah->npsn . '</td>
                <td style="text-align: right; font-size:8px;">Hal {PAGENO} dari {nbpg}</td>
            </tr> 
        </table>';

        // Memasang footer ke dalam pdf 
        $mpdf->SetFooter($footer);

        // Proses ubah data buku induk ke dalam pdf
        $mpdf->WriteHTML(view('spmb.bukti-pendaftaran', [
            'sekolah'   => $sekolah,
            'pendaftar' => $pendaftar,
            'berkas'    => BerkasPendaftaran::where('pendaftar_id', $pendaftarId)->first(),
            'jurusan'   => KeteranganKeterima::with('jurusan')->where('siswa_id', $pendaftarId)->first(),
            'QRCode'    => QrCode::format('svg')->size(80)->generate((string)$umum->link_grup),
            'logo'      => $umum->logo_pendaftaran,
        ]));

        // $mpdf->Output();
        $namaFile = 'Bukti_Pendaftaran_' . $pendaftar->nama_lengkap . '_' . $pendaftar->no_pendaftaran . '.pdf';
        $pdfRaw = $mpdf->Output('', 'S');

        Mail::to($pendaftar->email)->send(new EmailBuktiPendaftaran($pdfRaw, $namaFile));

        $mpdf->Output();
    }

    public function halamanKonfirmasi($pendaftarId): View
    {
        return view('spmb.halaman-konfirmasi', [
            'pendaftarId' => $pendaftarId,
            'link_grup'   => SpmbUmum::select('link_grup')->first()->link_grup
        ]);
    }

    public function alurPendaftaran(): View
    {
        return view('spmb.alur-dan-syarat', [
            'alur' => Alur::first()
        ]);
    }

    public function syaratPendaftaran(): View
    {
        return view('spmb.alur-dan-syarat', [
            'syarat' => Syarat::first()
        ]);
    }

    public function cekStatus(Request $request): View
    {
        $Identitas = $request->input('identitas');
        $pendaftar = null;
        if ($Identitas) {
            $pendaftar = Pendaftar::cekStatus($Identitas)->first();
        }
        return view('spmb.cek-status', [
            'pendaftar' => $pendaftar,
            'berkas'    => BerkasPendaftaran::where('pendaftar_id', $pendaftar?->id)->first(),
            'jurusan'   => KeteranganKeterima::jurusanTerpilih($pendaftar?->id)->first()?->nama_jurusan,
            'ayah'      => Ayah::select('nama_ayah', 'pekerjaan_ayah', 'alamat_ayah')->where('siswa_id', $pendaftar?->id)->first(),
            'ibu'       => Ibu::select('nama_ibu', 'pekerjaan_ibu')->where('siswa_id', $pendaftar?->id)->first(),
            'wali'      => Walmur::select('nama_walmur', 'pekerjaan_walmur')->where('siswa_id', $pendaftar?->id)->first(),
            'agama'     => Agama::select('agama')->where('id', $pendaftar?->agama)->first()?->agama,
            'link_grup' => SpmbUmum::select('link_grup')->first()->link_grup
        ]);
    }

    public function pengaturanSpmb($side = null): View
    {
        return view('spmb.pengaturan-spmb', [
            'side'    => $side,
            'syarat'  => Syarat::first(),
            'alur'    => Alur::first(),
            'brosur'  => Brosur::first(),
            'sosmed'  => Sosmed::get(),
            'umum'    => SpmbUmum::first(),
            'antrian' => Pendaftar::select('no_pendaftaran')->where('no_pendaftaran', 'like',  '%' . request('label_antrian') . '%')->first()?->no_pendaftaran,
            'tahun_ajar' => TahunAjar::with('kurikulum')->select('id', 'tahun_ajar', 'semester', 'kurikulum_id')->get()
        ]);
    }

    public function addSyarat(Request $request): RedirectResponse
    {
        $this->SpmbService->addSyarat($request);
        return to_route('spmb.pengaturan')->with('sukses', 'Syarat pendaftaran berhasil disimpan!');
    }

    public function addAlur(Request $request): RedirectResponse
    {
        $this->SpmbService->addAlur($request);
        return to_route('spmb.pengaturan', 'alur')->with('sukses', 'Alur pendaftaran berhasil disimpan!');
    }

    public function addSosmed(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama_sosmed' => 'required',
            'link_sosmed' => 'required'
        ]);

        Sosmed::create($data);

        return to_route('spmb.pengaturan', 'sosmed')->with('sukses', 'Data sosial media berhasil ditambahkan!');
    }

    public function editSosmed(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama_sosmed' => 'required',
            'link_sosmed' => 'required'
        ]);

        Sosmed::where('id', $request->input('sosmed_id'))->update($data);

        return to_route('spmb.pengaturan', 'sosmed')->with('sukses', 'Data sosial media berhasil diubah!');
    }

    public function deleteSosmed(Request $request): RedirectResponse
    {
        Sosmed::destroy($request->input('sosmed_id'));
        return to_route('spmb.pengaturan', 'sosmed')->with('sukses', 'Data sosial media berhasil dihapus!');
    }

    public function unduhBrosur(): StreamedResponse|RedirectResponse
    {
        $brosur = Brosur::first()?->brosur;
        if ($brosur) {
            return Storage::download($brosur);
        } else {
            return back();
        }
    }

    public function updateUmum(Request $request): RedirectResponse
    {
        $this->SpmbService->updateUmum($request);
        return to_route('spmb.pengaturan')->with('sukses', 'Pengaturan berhasil diperbarui!');
    }

    public function hapusGambarSpmb(Request $request): RedirectResponse
    {
        $this->SpmbService->hapusGambarSpmb($request);
        return to_route('spmb.pengaturan')->with('sukses', 'Pengaturan berhasil diperbarui!');
    }

    public function pendaftar(): View
    {
        return view('spmb.pendaftar', [
            'pendaftar' => Pendaftar::with('berkas', 'jurusan')
                ->cariPendaftar(request('kata_kunci'))
                ->latest()
                ->paginate(10)
                ->withQueryString()
        ]);
    }

    public function detailPendaftar($pendaftarId, $menu = null): View
    {
        if ($menu === 'pendaftar') {
            $table = Pendaftar::with(
                'religion',
                'jurusan',
                'berkas',
                'ayah',
                'ibu',
                'wali'
            );
        } else {
            $table = RekapSpmb::with(
                'religion',
                'jurusan',
                'berkas',
                'ayah',
                'ibu',
                'wali'
            );
        }
        return view('spmb.detail-pendaftar', [
            'menu' => $menu,
            'pendaftar'  => $table
                ->where('id', $pendaftarId)
                ->first(),
            'keterangan' => KeteranganKeterima::KeteranganPendaftaran($pendaftarId)->where('siswa_id', $pendaftarId)->first(),
        ]);
    }

    public function ubahStatusPendaftar(Request $request): RedirectResponse
    {
        $this->SpmbService->ubahStatusPendaftar($request);
        return to_route('pendaftar')->with('sukses', 'Status pendaftaran berhasil diubah!');
    }

    public function tambahPendaftar(): View
    {
        return view('spmb.tambah-pendaftar', [
            'tingkat'   => Tingkat::select('id', 'tingkat')->orderBy('tingkat', 'asc')->first(),
            'jurusan'   => Jurusan::tersedia()->get(),
            'tahunAjar' => TahunAjar::select('id', 'tahun_ajar', 'semester')->orderBy('tahun_ajar', 'desc')->first(),
            'agama'     => Agama::select('id', 'agama')->get()
        ]);
    }

    public function simpanPendaftar(Request $request): RedirectResponse
    {
        $this->storePendaftar($request);
        return to_route('pendaftar')->with('sukses', 'Data pendaftar berhasil ditambahkan!');
    }

    public function hapusPendaftar(Request $request): RedirectResponse
    {
        $this->SpmbService->hapusPendaftar($request);
        return to_route('pendaftar')->with('sukses', 'Data pendatar berhasil dihapus!');
    }

    public function ubahPendaftar($pendaftarId): View
    {
        return view('spmb.ubah-pendaftar', [
            'pendaftar' => Pendaftar::with('religion', 'jurusan', 'berkas', 'ayah', 'ibu', 'wali')->where('id', $pendaftarId)->first(),
            'tingkat'   => Tingkat::select('id', 'tingkat')->orderBy('tingkat', 'asc')->first(),
            'jurusan'   => Jurusan::tersedia()->get(),
            'tahunAjar' => TahunAjar::select('id', 'tahun_ajar')->orderBy('tahun_ajar', 'desc')->first(),
            'agama'     => Agama::select('id', 'agama')->get()
        ]);
    }

    public function perbaruiPendaftar(Request $request, $pendaftarId): RedirectResponse
    {
        $this->SpmbService->perbaruiPendaftar($request, $pendaftarId);
        $kata_kunci = $request->input('kata_kunci');
        $query = null;
        if ($kata_kunci) {
            $query = '?kata_kunci=' . $kata_kunci;
        }
        return to_route('pendaftar' . $query)->with('sukses', 'Data pendaftar berhasil diperbarui!');
    }

    public function cabutBerkas(Request $request): RedirectResponse
    {
        $this->SpmbService->cabutBerkas($request);
        $kata_kunci = $request->input('kata_kunci');
        $query = null;
        if ($kata_kunci) {
            $query = '?kata_kunci=' . $kata_kunci;
        }
        return to_route('pendaftar' . $query)->with('sukses', 'Bukti pencabutan berkas pendaftar berhasil disimpan!');
    }

    public function getCabutBerkas($pendaftarId): JsonResponse
    {
        return response()->json(
            CabutBerkas::select('bukti_pencabutan', 'keterangan_pencabutan')
                ->where('pendaftar_id', $pendaftarId)
                ->first()
        );
    }

    //======== Export Excel Data Pendaftar ========//
    public function exportPendaftar()
    {
        // Function Aclog untuk merekam acitivtas setiap ada perubahan
        // $this->record(Auth::user()->id, 'Export data pendaftar', 'Data pendaftar', 'Mengexport data pendaftar', date('Y-m-d'), date('H:i'));

        // Proses export file excel => XLS, XLSX
        return Excel::download(new PendaftarExport, 'Data_pendaftar_' . date("d-m-Y") . '_' . date("H:i") . '.xlsx');
    }

    public function spmbMigrasi()
    {
        $Pendaftar = Pendaftar::get();
        $pendidikan = Pendidikan::select('id')->latest()->first();

        foreach ($Pendaftar as $pendaftar) {
            if ($pendaftar->status === 'diterima') {
                $this->SpmbService->spmbMigrasi($pendaftar, $pendidikan);
            } else {
                $this->SpmbService->insertRekap($pendaftar);
            }
            Pendaftar::destroy($pendaftar->id);
        }

        return to_route('pendaftar')->with('sukses', 'Proses migrasi data berhasil! Semua data pendaftar sudah masuk kedalam Master data aplikasi!');
    }

    public function rekapSpmb()
    {
        return view('spmb.rekap-spmb', [
            'tahun_ajar' => TahunAjar::select('id', 'tahun_ajar')->where('semester', 'ganjil')->latest('tahun_ajar')->get(),
            'pendaftar' => RekapSpmb::cariRekap(request('kata_kunci'), request('tahun_ajar'))
                ->latest('no_pendaftaran')
                ->paginate(10)
                ->withQueryString()
        ]);
    }

    public function terimaBeberapa($siswaId)
    {
        $this->SpmbService->terimaBeberapa($siswaId);
        return response()->json('200! Ok');
    }
}
