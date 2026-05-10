<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use App\Models\Nilai;
use App\Models\Lampiran;
use App\Models\Semester;
use App\Models\Kurikulum;
use App\Models\TahunAjar;
use App\Models\Pendidikan;
use Illuminate\Http\Request;
use App\Models\KurikulumMapel;
use App\Services\AdminService;
use Illuminate\Validation\Rule;
use App\Models\KeteranganKeterima;

class AdminController extends Controller
{

    //======== Terhubung ke MasterService ========//
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }


    /** 
     * Tahun Ajar 
     */
    //======== Index tahun ajar ========//
    public function tahunAjar()
    {
        return view('master.tahun-ajar', [
            'periode'   => TahunAjar::select('tahun_ajar')->distinct()->orderBy('tahun_ajar', 'desc')->get(),
            'tahunAjar' => TahunAjar::with('kurikulum')->select('id', 'tahun_ajar', 'semester', 'kurikulum_id', 'status')->latest('tahun_ajar')->get(),
            'semester' => ['ganjil', 'genap'],
            'kurikulum' => Kurikulum::select('id', 'nama_kurikulum')->get()
        ]);
    }

    //======== Add Data Tahun Ajar ========//
    public function addTahunAjar(Request $request)
    {
        $semester  = ['ganjil', 'genap'];
        $periode   = $request->input('tahun_1') . '/' . $request->input('tahun_2');
        $data      = $request->all();

        $request->validate([
            'tahun_ajar'   => 'required|unique:tahun_ajar',
            'kurikulum_id' => 'required',
        ], [
            'tahun_ajar.unique' => 'Tahun ajar tersebut sudah ada!',
        ]);

        for ($i = 0; $i < count($semester); $i++) {
            $data['tahun_ajar'] = $periode;
            $data['status']     = 0;
            $data['semester']   = $semester[$i];
            TahunAjar::create($data);
        }

        // Alihkan ke halaman tahun ajar
        return redirect()->route('tahun.ajar')->with('sukses', 'Tahun ajar berhasil ditambahkan!');
    }

    public function getTahunAjar($tahunAjar)
    {
        $imd = explode('-', $tahunAjar);
        $tahun_ajar = $imd[0] . '/' . $imd[1];
        return response()->json(
            TahunAjar::select('id', 'tahun_ajar', 'kurikulum_id')->where('tahun_ajar', $tahun_ajar)->first()
        );
    }

    public function getDataTahunAjar($periode)
    {
        $imd        = explode('-', $periode);
        $raw        = $imd[0] . '/' . $imd[1];
        $tahunAjar  = TahunAjar::select('id', 'tahun_ajar')->where('tahun_ajar', $raw)->get();
        $ids        = $tahunAjar->pluck('id')->toArray();
        $count      = KeteranganKeterima::whereIn('tahun_ajar_id', $ids)->count();

        return response()->json([
            'count' => $count,
            'id'    => $ids
        ], 200);
    }

    //======== Update Data Tahun Ajar ========//
    public function editTahunAjar(Request $request)
    {
        $periode   = $request->input('tahun_1') . '/' . $request->input('tahun_2');
        $tahunAjar = TahunAjar::select('id', 'tahun_ajar')->where('tahun_ajar', $request->input('tahun_ajar'))->get();
        $ids       = $tahunAjar->pluck('id')->toArray();

        if ($periode == $request->input('tahun_ajar')) {
            TahunAjar::whereIn('id', $ids)->update([
                'tahun_ajar'   => $periode,
                'kurikulum_id' => $request->input('kurikulum_id')
            ]);

            // Alihkan ke halaman tahun ajar
            return redirect()->route('tahun.ajar')->with('sukses', 'Tahun ajar berhasil diperbarui!');
        } else {
            $validasi = TahunAjar::select('tahun_ajar')->where('tahun_ajar', $periode)->get();
            if (isset($validasi)) {
                return back()->with('gagal', 'Tahun ajar sudah ada!');
            }
        }
    }

    //======== Delete Data Tahun Ajar ========//
    public function delTahunAjar(Request $request)
    {
        $ids   = explode(',', $request->tahun_ajar_id);
        $items = TahunAjar::whereIn('id', $ids)->get();
        foreach ($items as $item) {
            $item->delete(); // Ini akan memicu Model Events
        }

        // Alihkan ke halaman tahun ajar
        return redirect()->route('tahun.ajar')->with('sukses', 'Tahun ajar berhasil dihapus!');
    }

    public function aktifasiTahunAjar($id)
    {
        $sts = TahunAjar::select('status')->where('id', $id)->first()->status;

        $status = $sts == 1 ? 0 : 1;

        TahunAjar::where('id', $id)->update([
            'status' => $status
        ]);

        return redirect()->route('tahun.ajar')->with('sukses', 'Statuts tahun ajar berhasil diperbarui!');
    }

    public function ubahKurikulumTajar($kurikulumId, $tahunAjarId)
    {
        TahunAjar::where('id', $tahunAjarId)->update([
            'kurikulum_id' => $kurikulumId
        ]);

        return to_route('tahun.ajar')->with('sukses', 'Kurikulum berhasil diubah!');
    }



    /** 
     * Agama 
     */
    //======== Index Agama ========//
    public function agama()
    {
        return view('master.agama', [
            'agama' => Agama::select('id', 'agama')->get()
        ]);
    }

    //======== Add Data Agama ========//
    public function addAgama()
    {
        $data = request()->validate([
            'agama'      => 'required|unique:agama|min:1|max:16',
        ], [
            'required'   => 'Data agama wajib diisi!',
            'max'        => 'Data agama diisi maksimal :max karakter!',
            'min'        => 'Data agama diisi minimal :min karakter!',
            'unique'     => 'Data agama tersebut sudah digunakan!'
        ]);

        Agama::create($data);

        // Alihkan ke halaman agama
        return redirect()->route('agama')->with('sukses', 'Data agama berhasil ditambahkan!');
    }

    //======== Update Data Agama ========//
    public function editAgama()
    {
        $data = request()->validate([
            'agama'      => 'required|unique:agama,agama,' . request()->agama_id . '|min:1|max:16',
        ], [
            'required'   => 'Data agama wajib diisi!',
            'max'        => 'Data agama diisi maksimal :max karakter!',
            'min'        => 'Data agama diisi minimal :min karakter!',
            'unique'     => 'Data agama tersebut sudah digunakan!'
        ]);

        Agama::where('id', request()->agama_id)->update($data);

        // Alihkan ke halaman agama
        return redirect()->route('agama')->with('sukses', 'Data agama berhasil diperbarui!');
    }

    //======== Delete Data Agama ========//
    public function deleteAgama()
    {
        Agama::destroy(request()->agama_id);

        // Alihkan ke halaman agama
        return redirect()->route('agama')->with('sukses', 'Data agama berhasil dihapus!');
    }



    /** 
     * Pendidikan 
     */
    //======== Index Pendidik ========//
    public function pendidikan()
    {
        return view('master.pendidikan', [
            'pendidikan' => pendidikan::select('id', 'pendidikan', 'ket_pendidikan')->get()
        ]);
    }

    //======== Add Data pendidikan ========//
    public function addPendidikan()
    {
        $data = request()->validate([
            'pendidikan'      => 'required|unique:pendidikan|min:1|max:16',
            'ket_pendidikan'  => 'required|unique:pendidikan',
        ], [
            'required'              => ':attribute wajib diisi!',
            'max'                   => 'Data pendidikan diisi maksimal :max karakter!',
            'min'                   => 'Data pendidikan diisi minimal :min karakter!',
            'pendidikan.unique'     => 'Nama pendidikan tersebut sudah digunakan!',
            'ket_pendidikan.unique' => 'Keterangan pendidikan tersebut sudah digunakan!'
        ]);

        Pendidikan::create($data);

        // Alihkan ke halaman pendidikan
        return redirect()->route('pendidikan')->with('sukses', 'Data pendidikan berhasil ditambahkan!');
    }

    //======== Update Data pendidikan ========//
    public function editPendidikan()
    {
        $data = request()->validate([
            'pendidikan'      => 'required|unique:pendidikan,pendidikan,' . request()->pendidikan_id . '|min:1|max:16',
            'ket_pendidikan'  => 'required|unique:pendidikan,ket_pendidikan,' . request()->pendidikan_id . '',
        ], [
            'required'              => ':attribute wajib diisi!',
            'max'                   => 'Data pendidikan diisi maksimal :max karakter!',
            'min'                   => 'Data pendidikan diisi minimal :min karakter!',
            'pendidikan.unique'     => 'Nama pendidikan tersebut sudah digunakan!',
            'ket_pendidikan.unique' => 'Keterangan pendidikan tersebut sudah digunakan!'
        ]);

        Pendidikan::where('id', request()->pendidikan_id)->update($data);

        // Alihkan ke halaman pendidikan
        return redirect()->route('pendidikan')->with('sukses', 'Data pendidikan berhasil diperbarui!');
    }

    //======== Delete Data pendidikan ========//
    public function delPendidikan()
    {
        Pendidikan::destroy(request()->pendidikan_id);

        // Alihkan ke halaman pendidikan
        return redirect()->route('pendidikan')->with('sukses', 'Data pendidikan berhasil dihapus!');
    }



    /** 
     * semester 
     */
    //======== Index Semester ========//
    public function semester()
    {
        return view('master.semester', [
            'semester' => Semester::with('nilai')->select('id', 'semester')->get(),
            'nilai' => Nilai::with('semester')->first()
        ]);
    }

    //======== Add Data semester ========//
    public function updateSemester()
    {
        $this->adminService->updateSemester();

        // Alihkan ke halaman semester
        return redirect()->route('semester')->with('sukses', 'Data semester berhasil ditambahkan!');
    }


    /** 
     * Lampiran 
     */
    //======== Index Lampiran ========//
    public function lampiran()
    {
        return view('master.lampiran', [
            'lampiran' => Lampiran::select('id', 'lampiran', 'status')->get()
        ]);
    }

    //======== Add Data lampiran ========//
    public function addLampiran()
    {
        $data = request()->validate([
            'lampiran'  => 'required|unique:lampiran|min:1|max:16',
            'status'    => 'required',
        ], [
            'required'          => ':attribute wajib diisi!',
            'max'               => 'Data lampiran diisi maksimal :max karakter!',
            'min'               => 'Data lampiran diisi minimal :min karakter!',
            'lampiran.unique'   => 'Nama lampiran tersebut sudah digunakan!'
        ]);

        Lampiran::create($data);

        // Alihkan ke halaman lampiran
        return redirect()->route('lampiran')->with('sukses', 'Data lampiran berhasil ditambahkan!');
    }

    //======== Update Data lampiran ========//
    public function editLampiran()
    {
        $data = request()->validate([
            'lampiran'  => 'required|unique:lampiran,lampiran,' . request()->lampiran_id . '|min:1|max:16',
            'status'    => 'required',
        ], [
            'required'          => ':attribute wajib diisi!',
            'max'               => 'Data lampiran diisi maksimal :max karakter!',
            'min'               => 'Data lampiran diisi minimal :min karakter!',
            'lampiran.unique'   => 'Nama lampiran tersebut sudah digunakan!'
        ]);

        Lampiran::where('id', request()->lampiran_id)->update($data);

        // Alihkan ke halaman lampiran
        return redirect()->route('lampiran')->with('sukses', 'Data lampiran berhasil diperbarui!');
    }

    //======== Send Data Kelompok Mapel Dalam Kurikulum Mapel To Json ========//
    public function getKelmaDalamKurlumMapel($kelompok_mapel_id)
    {
        // Ambil data kurikulum mapel dari database
        $KurikulumMapel = KurikulumMapel::select('kelompok_mapel_id')->where('kelompok_mapel_id', $kelompok_mapel_id)->count();

        // ubah data menjadi json
        return response()->json($KurikulumMapel);
    }

    //======== Delete Data lampiran ========//
    public function delLampiran()
    {
        lampiran::destroy(request()->lampiran_id);

        // Alihkan ke halaman lampiran
        return redirect()->route('lampiran')->with('sukses', 'Data lampiran berhasil dihapus!');
    }
}
