<?php

namespace App\Services;

use App\Models\Setting;
use App\Models\TahunAjar;
use App\Models\TahunAkademik;
use Illuminate\Support\Facades\Storage;

class PengaturanService
{
    // Method Ubah Settingan Aplikasi
    public function updateSetting($request)
    {
        // Id Setting
        $id = $request->id;

        // Ambil data setting dari database
        $setting = Setting::select('ttd_kepsek', 'kop_binduk')->where('id', $id)->first();

        //Validasi data dari form 
        $data = $request->validate([
            'nama_sekolah'      => 'required',
            'npsn'              => 'required',
            'nip'               => 'required',
            'kota'              => 'required',
            'alamat_sekolah'    => 'required',
            'nama_kepsek'       => 'required',
            'kop_binduk'        => 'image|file|max:1024|mimes:jpg,jpeg,png',
            'ttd_kepsek'        => 'image|file|max:1024|mimes:jpg,jpeg,png',
            'password_user'     => 'required',
        ], [
            'required'           => ':attribute wajib diisi!',
            'kop_binduk.max'     => 'size :attribute maksimal :max Kb!',
            'kop_binduk.mimes'   => 'format :attribute harus :values!',
            'ttd_kepsek.max'     => 'size :attribute maksimal :max Kb!',
            'ttd_kepsek.mimes'   => 'format :attribute harus :values!'
        ]);


        // Jika tanda tangan kepsek dimasukkan
        if ($request->file('ttd_kepsek')) {

            // Maka lakukan proses dibawah ini
            // .
            // .
            // Jika tanda tangan kepsek terdapat di database
            if ($setting->ttd_kepsek) {

                // Maka hapus tanda tangan kepsek yang lama
                Storage::delete($setting->ttd_kepsek);
            }

            // Dan upload tanda tangan yang baru
            $data['ttd_kepsek'] = $request->file('ttd_kepsek')->store('image/ttd_kepsek');
        } else {
            // Dan jika tanda tangan kepsek tidak dimasukkan
            // Jika tanda tangan kepsek terdapat di database
            if ($setting->ttd_kepsek) {

                // Maka hapus tanda tangan kepsek yang lama
                Storage::delete($setting->ttd_kepsek);
            }
            // Maka catat sebagai NULL
            $data['ttd_kepsek'] = NULL;
        }

        // Jika kop buku induk kepsek dimasukkan
        if ($request->file('kop_binduk')) {

            // Maka lakukan proses dibawah ini
            // .
            // .
            // Jika kop buku induk kepsek terdapat di database
            if ($setting->kop_binduk) {

                // Maka hapus kop buku induk kepsek yang lama
                Storage::delete($setting->kop_binduk);
            }

            // Dan upload kop buku induk yang baru
            $data['kop_binduk'] = $request->file('kop_binduk')->store('image/kop_binduk');
        } else {
            // Dan jika kop buku induk kepsek tidak dimasukkan
            // Jika kop buku induk kepsek terdapat di database
            if ($setting->kop_binduk) {

                // Maka hapus kop buku induk kepsek yang lama
                Storage::delete($setting->kop_binduk);
            }
            // Maka catat sebagai NULL
            $data['kop_binduk'] = NULL;
        }

        // Ubah data setting pada database
        return Setting::where('id', $id)->update($data);
    }

    public function buatTahunAkademik($tahunAkademik)
    {
        if (empty($tahunAkademik->semester) || $tahunAkademik->semester == 'genap') {
            $semester = 'ganjil';
        } else {
            $semester = 'genap';
        }

        if ($tahunAkademik) {
            if ($tahunAkademik->semester == 'genap') {

                $data = TahunAjar::where('tahun_ajar', '>', $tahunAkademik->tahunAjar->tahun_ajar)->first();

                if (empty($data?->id)) {
                    $tahunAjar = explode('/', $tahunAkademik->tahunAjar->tahun_ajar);
                    $tahun_ajar = TahunAjar::create([
                        'tahun_ajar' => intval($tahunAjar[0]) + 1 . '/' . intval($tahunAjar[1]) + 1
                    ]);

                    TahunAkademik::create([
                        'tahun_ajar_id' => $tahun_ajar->id,
                        'semester' => $semester,
                        'status'   => 'true'
                    ]);
                } else {
                    TahunAkademik::create([
                        'tahun_ajar_id' => $data->id,
                        'semester' => $semester,
                        'status'   => 'true'
                    ]);
                }
            } else {
                TahunAkademik::create([
                    'tahun_ajar_id' => $tahunAkademik->tahunAjar->id,
                    'semester' => $semester,
                    'status'   => 'true'
                ]);
            }
        } else {
            $tahunAjarId = TahunAjar::select('id')->where('tahun_ajar', 'like', date('Y') . '%')->first()?->id;

            if (empty($tahunAjarId)) {
                $tahun_ajar = TahunAjar::create([
                    'tahun_ajar' => date('Y') . '/' . date('Y') + 1
                ]);

                TahunAkademik::create([
                    'tahun_ajar_id' => $tahun_ajar->id,
                    'semester' => $semester,
                    'status'   => 'true'
                ]);
            } else {
                TahunAkademik::create([
                    'tahun_ajar_id' => $tahunAjarId,
                    'semester' => $semester,
                    'status'   => 'true'
                ]);
            }
        }
    }

    public function aktifasiTahunAkademik($status, $id)
    {
        if ($status == 'true') {
            return TahunAkademik::where('id', $id)->update(['status' => 'false']);
        } else {
            return TahunAkademik::where('id', $id)->update(['status' => 'true']);
        }
    }

    public function ubahTahunAkademik($check)
    {
        if (!empty($check->id)) {
            request()->validate([
                'tahun_ajar_id' => 'unique:tahun_akademik,tahun_ajar_id,' . request()->tahun_akademik_id
            ], [
                'tahun_ajar_id.unique' => 'Tahun akademik tidak boleh sama!'
            ]);
        } else {
            return TahunAkademik::where('id', request()->tahun_akademik_id)->update([
                'tahun_ajar_id' => request()->tahun_ajar_id,
                'semester' => request()->semester
            ]);
        }
    }

    public function tambahTahunAkademik($check)
    {
        if (!empty($check->id)) {
            request()->validate([
                'tahun_ajar_id' => 'unique:tahun_akademik,tahun_ajar_id,' . request()->tahun_akademik_id
            ], [
                'tahun_ajar_id.unique' => 'Tahun akademik tidak boleh sama!'
            ]);
        } else {
            return TahunAkademik::create([
                'tahun_ajar_id' => request()->tahun_ajar_id,
                'semester' => request()->semester,
                'status' => 'true'
            ]);
        }
    }
}
