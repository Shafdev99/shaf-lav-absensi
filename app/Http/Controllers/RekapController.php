<?php

namespace App\Http\Controllers;

use App\Models\Ibu;
use App\Models\Ayah;
use App\Models\Agama;
use App\Models\Kelas;
use App\Models\Minat;
use App\Models\Siswa;
use App\Models\Walmur;
use App\Models\Biodata;
use App\Models\Jurusan;
use App\Models\Setting;
use App\Models\Tingkat;
use App\Models\Beasiswa;
use App\Models\Lampiran;
use App\Models\Prestasi;
use App\Models\Semester;
use App\Models\Kesehatan;
use App\Models\TahunAjar;
use App\Models\Pendidikan;
use App\Models\KelolaSiswa;
use App\Models\LampiranSiswa;
use App\Models\KelompokMapel;
use App\Models\KurikulumMapel;
use App\Models\RiwayatPendidikan;
use App\Services\RekapService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RekapController extends Controller
{
    //======== Terhubung ke RekapService ========//
    protected $rekapService;

    public function __construct(RekapService $rekapService)
    {
        $this->rekapService = $rekapService;
    }

    /** 
     * Rekap
     */
    //======== Index Rekap ========//
    public function rekap()
    {
        $kelas = Kelas::urutanKelas();

        $tahunAjarId = session('tahun_ajar_id');

        return view('binduk.rekap.index', [
            'kelas' => $kelas->get(),
            'siswa' => KelolaSiswa::urutanSiswa()
                ->cariDetail(request(['kelas', 'nama_siswa']), $kelas->first()?->kelas_id, $tahunAjarId)
                ->paginate(10)
                ->withQueryString()
        ]);
    }

    //======== Rekap Form Siswa ========//
    public function formSiswa($siswaId)
    {
        return view('binduk.rekap.form.siswa', [
            'siswa'     => Siswa::where('siswa.id', $siswaId)->getSiswaJoin()->first(),
            'tingkat'   => Tingkat::select('id', 'tingkat')->get(),
            'jurusan'   => Jurusan::select('id', 'nama_jurusan', 'keterangan')->orderBy('nama_jurusan', 'asc')->get(),
            'tahunAjar' => TahunAjar::select('id', 'tahun_ajar')->get(),
            'agama'     => Agama::select('id', 'agama')->get()
        ]);
    }

    //======== Rekap Update Siswa  ========//
    public function formSiswaUpdate(Request $request, Siswa $siswa)
    {
        $this->rekapService->formSiswaUpdate($siswa);

        // 1. Ambil URL sebelumnya lengkap dengan query string
        $previousUrl = url()->previous();

        // 2. Ekstrak bagian query string saja (string setelah '?')
        $queryString = parse_url($previousUrl, PHP_URL_QUERY);

        if ($request->input('menu') == 'alumni') {
            return redirect()->route('alumni.form.siswa', $siswa->id . '?' . $queryString)->with('sukses', 'Data siswa berhasil diubah!');
        } else {
            return redirect()->route('rekap.form.siswa', $siswa->id . '?' . $queryString)->with('sukses', 'Data siswa berhasil diubah!');
        }
    }

    //======== Rekap Form Ortu ========//
    public function formOrtu($siswaId)
    {
        return view('binduk.rekap.form.ortu', [
            'siswa'      => Siswa::where('siswa.id', $siswaId)->getSiswaJoin()->first(),
            'ayah'       => Ayah::where('siswa_id', $siswaId)->first(),
            'ibu'        => Ibu::where('siswa_id', $siswaId)->first(),
            'agama'      => Agama::select('id', 'agama')->get(),
            'pendidikan' => Pendidikan::select('id', 'pendidikan')->get(),
            'kematian'   => ['Masih hidup', 'Sudah wafat'],
        ]);
    }

    //======== Rekap Update Ortu ========//
    public function formOrtuUpdate(Request $request, $siswaId)
    {
        $this->rekapService->formOrtuUpdate($siswaId);

        // 1. Ambil URL sebelumnya lengkap dengan query string
        $previousUrl = url()->previous();

        // 2. Ekstrak bagian query string saja (string setelah '?')
        $queryString = parse_url($previousUrl, PHP_URL_QUERY);


        if ($request->input('menu') == 'alumni') {
            return redirect()->route('alumni.form.ortu', $siswaId . '?' . $queryString)->with('sukses', 'Data ortu siswa berhasil diubah!');
        } else {
            return redirect()->route('rekap.form.ortu', $siswaId . '?' . $queryString)->with('sukses', 'Data ortu siswa berhasil diubah!');
        }

        // $url = '?kelas=' . request()->input('kelas') . '&nama_siswa=' . request()->input('nama_siswa');

        // return redirect()->route('rekap.form.ortu', $siswaId . $url)->with('sukses', 'Data orang tua berhasil diubah!');
    }

    //======== Rekap Form Biodata ========//
    public function formBiodata($siswaId)
    {
        return view('binduk.rekap.form.biodata', [
            'siswa'     => Siswa::where('siswa.id', $siswaId)->getSiswaJoin()->first(),
            'biodata'   => Biodata::where('siswa_id', $siswaId)->first(),
            'kelor'     => ['Lengkap', 'Yatim', 'Piatu', 'Yatim Piatu', 'Cerai']
        ]);
    }

    //======== Rekap Update Biodata ========//
    public function formBiodataUpdate(Request $request, $siswaId)
    {
        $this->rekapService->formBiodataUpdate($siswaId);

        // 1. Ambil URL sebelumnya lengkap dengan query string
        $previousUrl = url()->previous();

        // 2. Ekstrak bagian query string saja (string setelah '?')
        $queryString = parse_url($previousUrl, PHP_URL_QUERY);

        // $url = '?kelas=' . request()->input('kelas') . '&nama_siswa=' . request()->input('nama_siswa');

        if ($request->input('menu') == 'alumni') {
            return redirect()->route('alumni.form.biodata', $siswaId . '?' . $queryString)->with('sukses', 'Biodata siswa berhasil diubah!');
        } else {
            return redirect()->route('rekap.form.biodata', $siswaId . '?' . $queryString)->with('sukses', 'Biodata siswa berhasil diubah!');
        }
        // return redirect()->route('rekap.form.biodata', $siswaId . $url)->with('sukses', 'Biodata siswa berhasil diubah!');
    }

    //======== Rekap Form Walmur ========//
    public function formWalmur($siswaId)
    {
        return view('binduk.rekap.form.walmur', [
            'siswa'      => Siswa::where('siswa.id', $siswaId)->getSiswaJoin()->first(),
            'walmur'     => Walmur::where('siswa_id', $siswaId)->first(),
            'agama'      => Agama::select('id', 'agama')->get(),
            'pendidikan' => Pendidikan::select('id', 'pendidikan')->get(),
        ]);
    }

    //======== Rekap Update Walmur ========//
    public function formWalmurUpdate(Request $request, $siswaId)
    {
        $this->rekapService->formWalmurUpdate($siswaId);

        // 1. Ambil URL sebelumnya lengkap dengan query string
        $previousUrl = url()->previous();

        // 2. Ekstrak bagian query string saja (string setelah '?')
        $queryString = parse_url($previousUrl, PHP_URL_QUERY);


        if ($request->input('menu') == 'alumni') {
            return redirect()->route('alumni.form.walmur', $siswaId . '?' . $queryString)->with('sukses', 'Data walmur siswa berhasil diubah!');
        } else {
            return redirect()->route('rekap.form.walmur', $siswaId . '?' . $queryString)->with('sukses', 'Data walmur siswa berhasil diubah!');
        }
        // $url = '?kelas=' . request()->input('kelas') . '&nama_siswa=' . request()->input('nama_siswa');
        // return redirect()->route('rekap.form.walmur', $siswaId . $url)->with('sukses', 'Data wali murid berhasil diubah!');
    }

    //======== Rekap Index Riwayat Pendidikan ========//
    public function formPendidikan($siswaId)
    {
        return view('binduk.rekap.form.pendidikan', [
            'siswa'      => Siswa::where('siswa.id', $siswaId)->getSiswaJoin()->first(),
            'ripen'      => RiwayatPendidikan::with('pendidikan')->where('siswa_id', $siswaId)->first(),
            'pendidikan' => Pendidikan::select('id', 'pendidikan', 'ket_pendidikan')->get()
        ]);
    }

    //======== Rekap Updata Data Riwayat Pendidikan ========//
    public function formPendidikanUpdate(Request $request, $siswaId)
    {
        $this->rekapService->formPendidikanUpdate($siswaId);

        // 1. Ambil URL sebelumnya lengkap dengan query string
        $previousUrl = url()->previous();

        // 2. Ekstrak bagian query string saja (string setelah '?')
        $queryString = parse_url($previousUrl, PHP_URL_QUERY);


        if ($request->input('menu') == 'alumni') {
            return redirect()->route('alumni.form.pendidikan', $siswaId . '?' . $queryString)->with('sukses', 'Data riwayat pendidikan siswa berhasil diubah!');
        } else {
            return redirect()->route('rekap.form.pendidikan', $siswaId . '?' . $queryString)->with('sukses', 'Data riwayat pendidikan siswa berhasil diubah!');
        }

        // $url = '?kelas=' . request()->input('kelas') . '&nama_siswa=' . request()->input('nama_siswa');

        // return redirect()->route('rekap.form.pendidikan', $siswaId . $url)->with('sukses', 'Data riwayat pendidikan berhasil diubah!');
    }

    //======== Rekap Index Kesehatan ========//
    public function formKesehatan($siswaId)
    {
        return view('binduk.rekap.form.kesehatan', [
            'siswa'      => Siswa::where('siswa.id', $siswaId)->getSiswaJoin()->first(),
            'kesehatan'   => Kesehatan::where('siswa_id', $siswaId)->first(),
            'goldar'     => ['-', 'A', 'B', 'AB', 'O']
        ]);
    }

    //======== Rekap Update Data Kesehatan ========//
    public function formKesehatanUpdate(Request $request, $siswaId)
    {
        $this->rekapService->formKesehatanUpdate($siswaId);

        // 1. Ambil URL sebelumnya lengkap dengan query string
        $previousUrl = url()->previous();

        // 2. Ekstrak bagian query string saja (string setelah '?')
        $queryString = parse_url($previousUrl, PHP_URL_QUERY);


        if ($request->input('menu') == 'alumni') {
            return redirect()->route('alumni.form.kesehatan', $siswaId . '?' . $queryString)->with('sukses', 'Data kesehatan siswa berhasil diubah!');
        } else {
            return redirect()->route('rekap.form.kesehatan', $siswaId . '?' . $queryString)->with('sukses', 'Data kesehatan siswa berhasil diubah!');
        }

        // $url = '?kelas=' . request()->input('kelas') . '&nama_siswa=' . request()->input('nama_siswa');

        // return redirect()->route('rekap.form.kesehatan', $siswaId . $url)->with('sukses', 'Kesehatan siswa berhasil diubah!');
    }

    //======== Rekap Index Minat ========//
    public function formMinat($siswaId)
    {
        return view('binduk.rekap.form.minat', [
            'siswa'      => Siswa::where('siswa.id', $siswaId)->getSiswaJoin()->first(),
            'minat'      => Minat::where('siswa_id', $siswaId)->first()
        ]);
    }

    //======== Rekap Tambah Data Minat ========//
    public function formMinatUpdate(Request $request, $siswaId)
    {
        $this->rekapService->formMinatUpdate($siswaId);

        // 1. Ambil URL sebelumnya lengkap dengan query string
        $previousUrl = url()->previous();

        // 2. Ekstrak bagian query string saja (string setelah '?')
        $queryString = parse_url($previousUrl, PHP_URL_QUERY);


        if ($request->input('menu') == 'alumni') {
            return redirect()->route('alumni.form.minat', $siswaId . '?' . $queryString)->with('sukses', 'Data minat siswa berhasil diubah!');
        } else {
            return redirect()->route('rekap.form.minat', $siswaId . '?' . $queryString)->with('sukses', 'Data minat siswa berhasil diubah!');
        }

        // $url = '?kelas=' . request()->input('kelas') . '&nama_siswa=' . request()->input('nama_siswa');

        // return redirect()->route('rekap.form.minat', $siswaId . $url)->with('sukses', 'Data minat siswa berhasil diubah!');
    }

    //======== Rekap Index Beasiswa ========//
    public function formBeasiswa($siswaId)
    {
        return view('binduk.rekap.form.beasiswa', [
            'siswa'      => Siswa::where('siswa.id', $siswaId)->getSiswaJoin()->first(),
            'beasiswa'   => Beasiswa::get()
        ]);
    }

    //======== Rekap Tambah Data Beasiswa ========//
    public function formBeasiswaCreate(Request $request, $siswaId)
    {
        $this->rekapService->formBeasiswaCreate();

        // 1. Ambil URL sebelumnya lengkap dengan query string
        $previousUrl = url()->previous();

        // 2. Ekstrak bagian query string saja (string setelah '?')
        $queryString = parse_url($previousUrl, PHP_URL_QUERY);


        if ($request->input('menu') == 'alumni') {
            return redirect()->route('alumni.form.beasiswa', $siswaId . '?' . $queryString)->with('sukses', 'Data beasiswa siswa berhasil ditambahkan!');
        } else {
            return redirect()->route('rekap.form.beasiswa', $siswaId . '?' . $queryString)->with('sukses', 'Data beasiswa siswa berhasil ditambahkan!');
        }

        // $url = '?kelas=' . request()->input('kelas') . '&nama_siswa=' . request()->input('nama_siswa');

        // return redirect()->route('rekap.form.beasiswa', $siswaId . $url)->with('sukses', 'Data beasiswa siswa berhasil ditambahkan!');
    }

    //======== Rekap Get Data Beasiswa ========//
    public function getBeasiswa($id)
    {
        return response()->json(Beasiswa::where('id', $id)->first());
    }

    //======== Rekap Ubah Data Beasiswa ========//
    public function formBeasiswaUpdate(Request $request, $siswaId)
    {
        $this->rekapService->formBeasiswaUpdate();

        // 1. Ambil URL sebelumnya lengkap dengan query string
        $previousUrl = url()->previous();

        // 2. Ekstrak bagian query string saja (string setelah '?')
        $queryString = parse_url($previousUrl, PHP_URL_QUERY);


        if ($request->input('menu') == 'alumni') {
            return redirect()->route('alumni.form.beasiwa', $siswaId . '?' . $queryString)->with('sukses', 'Data beasiwa siswa berhasil diubah!');
        } else {
            return redirect()->route('rekap.form.beasiwa', $siswaId . '?' . $queryString)->with('sukses', 'Data beasiwa siswa berhasil diubah!');
        }

        // $url = '?kelas=' . request()->input('kelas') . '&nama_siswa=' . request()->input('nama_siswa');

        // return redirect()->route('rekap.form.beasiswa', $siswaId . $url)->with('sukses', 'Data beasiswa siswa berhasil diubah!');
    }

    //======== Rekap Delete Data Beasiswa ========//
    public function formBeasiswaDelete(Request $request, $siswaId)
    {
        $this->rekapService->formBeasiswaDelete();

        // 1. Ambil URL sebelumnya lengkap dengan query string
        $previousUrl = url()->previous();

        // 2. Ekstrak bagian query string saja (string setelah '?')
        $queryString = parse_url($previousUrl, PHP_URL_QUERY);


        if ($request->input('menu') == 'alumni') {
            return redirect()->route('alumni.form.beasiswa', $siswaId . '?' . $queryString)->with('sukses', 'Data beasiswa siswa berhasil dihapus!');
        } else {
            return redirect()->route('rekap.form.beasiswa', $siswaId . '?' . $queryString)->with('sukses', 'Data beasiswa siswa berhasil dihapus!');
        }

        // $url = '?kelas=' . request()->input('kelas') . '&nama_siswa=' . request()->input('nama_siswa');

        // return redirect()->route('rekap.form.beasiswa', $siswaId . $url)->with('sukses', 'Data beasiswa berhasil dihapus!');
    }

    //======== Rekap Index Prestasi ========//
    public function formPrestasi($siswaId)
    {
        return view('binduk.rekap.form.prestasi', [
            'siswa'      => Siswa::where('siswa.id', $siswaId)->getSiswaJoin()->first(),
            'prestasi'   => Prestasi::get()
        ]);
    }

    //======== Rekap Tambah Data prestasi ========//
    public function formPrestasiCreate(Request $request, $siswaId)
    {
        $this->rekapService->formPrestasiCreate();

        // 1. Ambil URL sebelumnya lengkap dengan query string
        $previousUrl = url()->previous();

        // 2. Ekstrak bagian query string saja (string setelah '?')
        $queryString = parse_url($previousUrl, PHP_URL_QUERY);


        if ($request->input('menu') == 'alumni') {
            return redirect()->route('alumni.form.prestasi', $siswaId . '?' . $queryString)->with('sukses', 'Data prestasi siswa berhasil ditambahkan!');
        } else {
            return redirect()->route('rekap.form.prestasi', $siswaId . '?' . $queryString)->with('sukses', 'Data prestasi siswa berhasil ditambahkan!');
        }

        // $url = '?kelas=' . request()->input('kelas') . '&nama_siswa=' . request()->input('nama_siswa');

        // return redirect()->route('rekap.form.prestasi', $siswaId . $url)->with('sukses', 'Data prestasi siswa berhasil ditambahkan!');
    }

    //======== Rekap Get Data prestasi ========//
    public function getPrestasi($id)
    {
        return response()->json(Prestasi::where('id', $id)->first());
    }

    //======== Rekap Ubah Data prestasi ========//
    public function formPrestasiUpdate(Request $request, $siswaId)
    {
        $this->rekapService->formPrestasiUpdate();

        // 1. Ambil URL sebelumnya lengkap dengan query string
        $previousUrl = url()->previous();

        // 2. Ekstrak bagian query string saja (string setelah '?')
        $queryString = parse_url($previousUrl, PHP_URL_QUERY);


        if ($request->input('menu') == 'alumni') {
            return redirect()->route('alumni.form.prestasi', $siswaId . '?' . $queryString)->with('sukses', 'Data prestasi siswa berhasil diubah!');
        } else {
            return redirect()->route('rekap.form.prestasi', $siswaId . '?' . $queryString)->with('sukses', 'Data prestasi siswa berhasil diubah!');
        }

        // $url = '?kelas=' . request()->input('kelas') . '&nama_siswa=' . request()->input('nama_siswa');

        // return redirect()->route('rekap.form.prestasi', $siswaId . $url)->with('sukses', 'Data prestasi siswa berhasil diubah!');
    }

    //======== Rekap Delete Data Prestasi ========//
    public function formPrestasiDelete(Request $request, $siswaId)
    {
        $this->rekapService->formPrestasiUpdate();

        // 1. Ambil URL sebelumnya lengkap dengan query string
        $previousUrl = url()->previous();

        // 2. Ekstrak bagian query string saja (string setelah '?')
        $queryString = parse_url($previousUrl, PHP_URL_QUERY);


        if ($request->input('menu') == 'alumni') {
            return redirect()->route('alumni.form.prestasi', $siswaId . '?' . $queryString)->with('sukses', 'Data prestasi siswa berhasil dihapus!');
        } else {
            return redirect()->route('rekap.form.prestasi', $siswaId . '?' . $queryString)->with('sukses', 'Data prestasi siswa berhasil dihapus!');
        }

        // $url = '?kelas=' . request()->input('kelas') . '&nama_siswa=' . request()->input('nama_siswa');

        // return redirect()->route('rekap.form.prestasi', $siswaId . $url)->with('sukses', 'Data prestasi berhasil dihapus!');
    }

    //======== Rekap Index Data Lampiran ========//
    public function formLampiran($siswaId)
    {
        return view('binduk.rekap.form.lampiran', [
            'siswa'      => Siswa::where('siswa.id', $siswaId)->getSiswaJoin()->first(),
            'lampiran'   => Lampiran::with(['lampiranSiswa' => function ($query) use ($siswaId) {
                $query->where('siswa_id', $siswaId);
            }])->get()
        ]);
    }

    //======== Rekap Tambah Data Lampiran ========//
    public function formLampiranCreate(Request $request, $siswaId)
    {
        $this->rekapService->formLampiranCreate();

        // 1. Ambil URL sebelumnya lengkap dengan query string
        $previousUrl = url()->previous();

        // 2. Ekstrak bagian query string saja (string setelah '?')
        $queryString = parse_url($previousUrl, PHP_URL_QUERY);


        if ($request->input('menu') == 'alumni') {
            return redirect()->route('alumni.form.lampiran', $siswaId . '?' . $queryString)->with('sukses', 'Data lampiran siswa berhasil ditambahkan!');
        } else {
            return redirect()->route('rekap.form.lampiran', $siswaId . '?' . $queryString)->with('sukses', 'Data lampiran siswa berhasil ditambahkan!');
        }

        // $url = '?kelas=' . request()->input('kelas') . '&nama_siswa=' . request()->input('nama_siswa');

        // return redirect()->route('rekap.form.lampiran', $siswaId . $url)->with('sukses', 'Data lampiran siswa berhasil ditambahkan!');
    }

    //======== Rekap Get Data Lampiran ========//
    public function getLampiran($id)
    {
        $lampiran   = LampiranSiswa::where('id', $id)->first();
        return response()->json($lampiran);
    }

    //======== Rekap Update Data Lampiran ========//
    public function formLampiranUpdate(Request $request, $siswaId)
    {
        $this->rekapService->formLampiranUpdate();

        // 1. Ambil URL sebelumnya lengkap dengan query string
        $previousUrl = url()->previous();

        // 2. Ekstrak bagian query string saja (string setelah '?')
        $queryString = parse_url($previousUrl, PHP_URL_QUERY);


        if ($request->input('menu') == 'alumni') {
            return redirect()->route('alumni.form.lampiran', $siswaId . '?' . $queryString)->with('sukses', 'Data lampiran siswa berhasil diubah!');
        } else {
            return redirect()->route('rekap.form.lampiran', $siswaId . '?' . $queryString)->with('sukses', 'Data lampiran siswa berhasil diubah!');
        }

        // $url = '?kelas=' . request()->input('kelas') . '&nama_siswa=' . request()->input('nama_siswa');

        // return redirect()->route('rekap.form.lampiran', $siswaId . $url)->with('sukses', 'Data lampiran siswa berhasil diubah!');
    }

    //======== Rekap Delete Data Lampiran ========//
    public function formLampiranDelete(Request $request, $siswaId)
    {
        $this->rekapService->formLampiranDelete();

        // 1. Ambil URL sebelumnya lengkap dengan query string
        $previousUrl = url()->previous();

        // 2. Ekstrak bagian query string saja (string setelah '?')
        $queryString = parse_url($previousUrl, PHP_URL_QUERY);


        if ($request->input('menu') == 'alumni') {
            return redirect()->route('alumni.form.lampiran', $siswaId . '?' . $queryString)->with('sukses', 'Data lampiran siswa berhasil dihapus!');
        } else {
            return redirect()->route('rekap.form.lampiran', $siswaId . '?' . $queryString)->with('sukses', 'Data lampiran siswa berhasil dihapus!');
        }

        // $url = '?kelas=' . request()->input('kelas') . '&nama_siswa=' . request()->input('nama_siswa');

        // return redirect()->route('rekap.form.lampiran', $siswaId . $url)->with('sukses', 'Data lampiran berhasil dihapus!');
    }

    //======== Rekap Index Data Nilai Rapor ========//
    public function formNilai($siswaId)
    {
        $siswa = Siswa::where('siswa.id', $siswaId)->getSiswaJoin()->first();
        $tingkat = Tingkat::get();
        $limitSemester = $tingkat->count() * 2;
        return view('binduk.rekap.form.nilai', [
            'siswa'    => $siswa,
            'kurMapel' => KurikulumMapel::kurMapel($siswa->kurikulum_id)
                ->orderBy('urutan_mapel', 'asc')
                ->get(),
            'kelma'    => KelompokMapel::get(),
            'tingkat'  => $tingkat,
            'semester' => Semester::with(['nilai' => function ($query) use ($siswaId) {
                $query->where('siswa_id', $siswaId);
            }])->limit($limitSemester)->get()
        ]);
    }

    public function formNilaiUpdate(Request $request, $siswaId)
    {
        $this->rekapService->formNilaiUpdate($siswaId);

        // 1. Ambil URL sebelumnya lengkap dengan query string
        $previousUrl = url()->previous();

        // 2. Ekstrak bagian query string saja (string setelah '?')
        $queryString = parse_url($previousUrl, PHP_URL_QUERY);


        if ($request->input('menu') == 'alumni') {
            return redirect()->route('alumni.form.nilai', $siswaId . '?' . $queryString)->with('sukses', 'Data nilai siswa berhasil diperbarui!');
        } else {
            return redirect()->route('rekap.form.nilai', $siswaId . '?' . $queryString)->with('sukses', 'Data nilai siswa berhasil diperbarui!');
        }

        // $url = '?kelas=' . request()->input('kelas') . '&nama_siswa=' . request()->input('nama_siswa');

        // return redirect()->route('rekap.form.nilai', $siswaId . $url)->with('sukses', 'Nilai rapor berhasil diperbarui!');
    }

    public function cetakDataSiswa(Siswa $siswa)
    {
        // Mengolah HTML dan PHP menjadi pdf
        $mpdf = new \Mpdf\Mpdf();

        // Ambil data setting dari database
        $sekolah = Setting::first();

        $tingkat = Tingkat::get();

        $limitSemester = $tingkat->count() * 2;

        $this->rekapService->cetakDataSiswa($siswa, $sekolah, $mpdf, $limitSemester, $tingkat);

        $mpdf->Output();
    }
}
