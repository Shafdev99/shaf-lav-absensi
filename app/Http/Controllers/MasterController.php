<?php

namespace App\Http\Controllers;

use App\Exports\SiswaExport;
use App\Exports\TemplateImport;
use App\Imports\SiswaImport;
use App\Models\Aclog;
use App\Models\Agama;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\KelolaSiswa;
use App\Models\KeteranganKeterima;
use App\Models\Mutasi;
use App\Models\Pendaftar;
use App\Models\Pendidikan;
use App\Models\RekapSpmb;
use App\Models\Siswa;
use App\Models\Tingkat;
use App\Models\User;
use App\Services\MasterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class MasterController extends Controller
{

    //======== Terhubung ke MasterService ========//
    protected $masterService;

    public function __construct(MasterService $masterService)
    {
        $this->masterService = $masterService;
    }

    //======== Beranda ========//
    public function index()
    {
        if (Pendaftar::count() !== 0) {
            $keterangan = 'Pendaftar';
            $pendaftar = Pendaftar::total(session('tahun_ajar_id'))->count();
        } else {
            $keterangan = 'Rekap Pendaftar';
            $pendaftar = RekapSpmb::total(session('tahun_ajar_id'))->count();
        }
        return view('dashboard', [
            'mutasi'         => Mutasi::siswa(session('tahun_ajar_id'))->latest()->limit(5)->get(),
            'totalSiswa'     => Siswa::count(),
            'totalUser'      => User::count(),
            'ketPendaftar'   => $keterangan,
            'totalPendaftar' => $pendaftar,
            'totalMutasi'    => Mutasi::where('tahun_ajar_id', session('tahun_ajar_id'))->count(),
            'aclog'          => Aclog::latest()->limit(5)->get()
        ]);
    }

    /** 
     * Siswa 
     */
    //======== Index Siswa ========//
    public function siswa()
    {
        $kelas = Kelas::urutanKelas();

        if (request('kelas') == NULL) {
            $tingkatDefault = Kelas::urutanKelas()->get()->first()->tingkat;
        } else {
            $tingkatDefault = Kelas::urutanKelas()->where('kelas_id', request('kelas'))->first()->tingkat;
        }

        $tahunAjarId = session('tahun_ajar_id');

        return view('siswa.index', [
            'pindah' => $tingkatDefault,
            'kelas' => $kelas->get(),
            'siswa' => KelolaSiswa::urutanSiswa()
                ->cariDetail(request(['kelas', 'nama_siswa']), $kelas->first()?->kelas_id, $tahunAjarId)
                ->paginate(10)
                ->withQueryString(),
            'kelas'      => Kelas::daftarKelas(),
            'pendidikan' => Pendidikan::select('pendidikan', 'ket_pendidikan')->get(),
        ]);
    }

    //======== Send Data Siswa To Json ========//
    public function getSiswa($siswaId)
    {
        return response()->json(
            Siswa::with('namaKelas', 'jurusan', 'agama', 'ayah', 'ibu', 'wali', 'pendidikan')
                ->where('siswa.id', $siswaId)
                ->getSiswaJoin()
                ->first()
        );
    }

    //======== View Add Siswa ========//
    public function createSiswa()
    {
        return view('siswa.add', [
            'tingkat' => Tingkat::select('id', 'tingkat')->get(),
            'jurusan' => Jurusan::select('id', 'nama_jurusan', 'keterangan')->orderBy('nama_jurusan', 'asc')->get(),
            'agama'   => Agama::select('id', 'agama')->get()
        ]);
    }

    public function getKelasByJurusan($jurusanId, $tingkatId)
    {
        return response()->json(
            Kelas::tampilKelas()
                ->orderBy('tingkat', 'asc')
                ->orderBy('nama_jurusan', 'asc')
                ->orderBy('nama_kelas', 'asc')
                ->where('jurusan_id', $jurusanId)
                ->where('tingkat_id', $tingkatId)
                ->get()
        );
    }

    public function getOneKelasByJurusan($jurusanId, $tingkatId)
    {
        return response()->json(
            Kelas::tampilKelas()
                ->orderBy('tingkat', 'asc')
                ->orderBy('nama_jurusan', 'asc')
                ->orderBy('nama_kelas', 'asc')
                ->where('jurusan_id', $jurusanId)
                ->where('tingkat_id', $tingkatId)
                ->first()
        );
    }

    public function getKelasByTahunAjar($tahunAjarId)
    {
        return response()->json(
            Kelas::tampilKelas()
                ->where('kurikulum.tahun_ajar_id', $tahunAjarId)
                ->orderBy('tingkat', 'asc')
                ->orderBy('nama_jurusan', 'asc')
                ->orderBy('nama_kelas', 'asc')
                ->get()
        );
    }

    //======== Add Data Siswa ========//
    public function storeSiswa(Request $request)
    {
        // Proses create data siswa
        $this->masterService->createSiswa($request);

        // Function Aclog untuk merekam acitivtas setiap ada perubahan
        $this->record(Auth::user()->id, 'Tambah data siswa', request()->nama_lengkap, 'Menambahkan data siswa', date('Y-m-d'), date('H:i'));

        // Alihkan ke halamam siswa //
        return redirect()->to(url('siswa?tahun_ajar=' . request()->input('tahun_ajar') . '&kelas=' . request()->input('kelas') . '&nama_siswa=' . request()->input('nama_siswa')))->with('sukses', 'Data siswa berhasil ditambahkan!');
    }

    //======== View Edit Siswa ========//
    public function editSiswa($siswaId)
    {
        return view('siswa.edit', [
            'tingkat'   => Tingkat::select('id', 'tingkat')->get(),
            'jurusan'   => Jurusan::select('id', 'nama_jurusan', 'keterangan')->orderBy('nama_jurusan', 'asc')->get(),
            'siswa'     => Siswa::with('keteranganKeterima')->where('id', $siswaId)->first(),
            // 'tahunAjar' => TahunAjar::select('id', 'tahunAjar')->get(),
            'agama'     => Agama::select('id', 'agama')->get()
        ]);
    }

    //======== Update Data Siswa ========//
    public function updateSiswa(Request $request, Siswa $siswa)
    {

        // Proses update data siswa
        $this->masterService->updateSiswa($request, $siswa);

        // Function Aclog untuk merekam acitivtas setiap ada perubahan
        $this->record(Auth::user()->id, 'Update data siswa', $siswa->nama_lengkap, 'Menambahkan data siswa', date('Y-m-d'), date('H:i'));

        // Alihkan ke halamam siswa //
        return redirect()->to(url('siswa?tahun_ajar=' . request()->input('tahun_ajar') . '&kelas=' . request()->input('kelas') . '&nama_siswa=' . request()->input('nama_siswa')))->with('sukses', 'Data siswa berhasil diubah!');
    }

    //======== Delete Data Siswa ========//
    public function deleteSiswa(Request $request)
    {
        $id = $request->input('id');
        // Proses delete siswa
        $this->masterService->deleteSiswa($id);

        // Hapus data siswa terpilih berdasarkan ID
        KeteranganKeterima::where('siswa_id', $id)->delete();
        KelolaSiswa::where('siswa_id', $id)->delete();
        Siswa::destroy($id);

        // Alihkan ke halamam siswa //
        return redirect()->to(url('siswa?tahun_ajar=' . $request->input('tahun_ajar') . '&kelas=' . $request->input('kelas') . '&nama_siswa=' . $request->input('nama_siswa')))->with('sukses', 'Data siswa berhasil dihapus!');
    }

    //======== Hapus Siswa Terpilih ========//
    public function hapusSiswaTerpilih(Request $request)
    {
        // Proses delete beberapa siswa
        $this->masterService->deleteSomeSiswa($request);

        // Alihkan ke halamam siswa //
        return redirect()->to(url('siswa?tahun_ajar=' . request()->input('tahun_ajar') . '&kelas=' . request()->input('kelas') . '&nama_siswa=' . request()->input('nama_siswa')))->with('sukses', 'Beberapa siswa terpilih berhasil dihapus!');
    }

    //======== Download Template Import Excel Data Siswa ========//
    public function templateImport()
    {
        // Proses download file template import data siswa
        return Excel::download(new templateImport, 'Template_Import_Data_Siswa.xlsx');
    }

    //======== Export Excel Data Siswa ========//
    public function exportSiswa()
    {
        // Function Aclog untuk merekam acitivtas setiap ada perubahan
        // $this->record(Auth::user()->id, 'Export data siswa', 'Data Siswa', 'Mengexport data siswa', date('Y-m-d'), date('H:i'));
        $tampilKelas  = Kelas::tampilKelas()->where('kelas.id', request('kelas'))->first();

        // Proses export file excel => XLS, XLSX
        return Excel::download(new SiswaExport(request(['kelas'])), 'Data_Kelas_' . $tampilKelas->tingkat . '_' . $tampilKelas->nama_jurusan . '_' . $tampilKelas->nama_kelas . '_' . date("d-m-Y") . '_' . date("H:i") . '.xlsx');
    }

    //======== Import Excel Data Siswa ========//
    public function importSiswa()
    {
        // Function Aclog untuk merekam acitivtas setiap ada perubahan
        // $this->record(Auth::user()->id, 'Import data siswa', 'Data Siswa', 'Mengimport data siswa', date('Y-m-d'), date('H:i'));

        // Mengambil data file dari form
        $file = request()->file('importFile');

        // Memberikan nama baru pada file yang diambil
        $namaFile = $file->getClientOriginalName();

        // Proses upload file 
        $file->move('import', $namaFile);

        // Memasukan data ke database
        Excel::import(new SiswaImport, public_path('/import/' . $namaFile));
        return redirect()->route('siswa')->with('sukses', 'Data berhasil di Import!');
    }


    /** 
     * Profil 
     */
    //======== View Profil ========//
    public function profilView()
    {
        // Ambil data user dari database
        return view('profil.index', [
            'user' =>  User::select('name', 'username', 'email', 'foto_profil', 'role')->where('id', Auth::user()->id)->first()
        ]);
    }

    //======== Update data profil ========//
    public function updateProfil()
    {
        $this->masterService->updateProfil();

        // Function Aclog untuk merekam acitivtas setiap ada perubahan
        $this->record(Auth::user()->id, 'Update data', 'Profil', 'Mengubah data', date('Y-m-d'), date('H:i'));

        // Alihkan ke halaman profil
        return redirect()->route('profil')->with('sukses', 'Berhasil memperbaruhi profil anda!');
    }

    public function ubahFotoProfil()
    {
        // Proses update foto profil
        $this->masterService->updateFotoProfil(request());

        // Function Aclog untuk merekam acitivtas setiap ada perubahan
        $this->record(Auth::user()->id, 'Update data', 'Profil', 'Mengubah data', date('Y-m-d'), date('H:i'));

        // Alihkan ke halaman profil
        return redirect()->route('profil')->with('sukses', 'Berhasil memperbaruhi profil anda!');
    }

    //======== Reset Password Profil ========//
    public function resetPassProf()
    {
        $this->masterService->resetPassProfil();

        // Alihkan ke halaman profil
        return redirect()->route('profil')->with('sukses', 'Password berhasil diubah!');
    }
}
