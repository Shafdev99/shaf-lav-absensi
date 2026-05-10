<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\TahunAjar;
use App\Models\TahunAkademik;
use App\Services\PengaturanService;
use Illuminate\Support\Facades\Auth;

class PengaturanController extends Controller
{
    //======== Terhubung ke MasterService ========//
    protected $pengaturanService;

    public function __construct(PengaturanService $pengaturanService)
    {
        $this->pengaturanService = $pengaturanService;
    }

    /** 
     * Setting 
     */
    //======== View Setting ========//
    public function settingView()
    {
        return view('setting.index', [
            'setting'       => Setting::first(),
            // 'tahunAkademik' => TahunAkademik::with('tahunAjar')->latest()->paginate(5),
            // 'pilihanTahun'  => TahunAjar::orderBy('tahun_ajar', 'desc')->get(),
            'semester'      => ['genap', 'ganjil']
        ]);
    }

    //======== Update Setting ========//
    public function ubahSetting()
    {
        // Update setting
        $this->pengaturanService->updateSetting(request());

        // Function Aclog untuk merekam acitivtas setiap ada perubahan
        $this->record(Auth::user()->id, 'Ubah Setting', 'Sekolah', 'Mengubah data setting sekolah', date('Y-m-d'), date('H:i'));

        // Alihkan ke halaman setting
        return redirect()->route('setting')->with('sukses', 'Setting sudah diperbarui!');
    }

    public function buatTahunAkademik()
    {
        $tahunAkademik = TahunAkademik::with('tahunAjar')->latest()->first();

        $this->pengaturanService->buatTahunAkademik($tahunAkademik);

        return to_route('setting')->with('sukses', 'Tahun akademik baru berhasil dibuat!');
    }

    public function aktifasiTahunAkademik($id)
    {
        $status = TahunAkademik::select('status')->where('id', $id)->first()->status;

        $this->pengaturanService->aktifasiTahunAkademik($status, $id);

        return to_route('setting')->with('sukses', 'Aktivasi tahun akademik berhasil diubah!');
    }

    public function ubahTahunAkademik()
    {
        $check = TahunAkademik::where('tahun_ajar_id', request()->tahun_ajar_id)->where('semester', request()->semester)->first();

        $this->pengaturanService->ubahTahunAkademik($check);

        return to_route('setting')->with('sukses', 'Tahun akademik berhasil diperbarui!');
    }

    public function tambahTahunAkademik()
    {
        $check = TahunAkademik::where('tahun_ajar_id', request()->tahun_ajar_id)->where('semester', request()->semester)->first();

        $this->pengaturanService->tambahTahunAkademik($check);

        return to_route('setting')->with('sukses', 'Tahun akademik berhasil ditambahkan!');
    }

    public function hapusTahunAkademik()
    {
        TahunAkademik::destroy(request()->tahun_akademik_id);
        return to_route('setting')->with('sukses', 'Tahun akademik berhasil dihapus!');
    }
}
