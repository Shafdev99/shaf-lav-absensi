<?php

namespace App\Http\Controllers;

use App\Models\Hari;
use App\Models\SesiPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SesiPelajaranController extends Controller
{
    public function index($hari_id = null)
    {
        $query = SesiPelajaran::select('id', 'sesi_pelajaran', 'jam_mulai', 'jam_selesai', 'zona_waktu');

        if ($hari_id) {
            $query->where('hari_id', $hari_id);
        } else {
            $query->whereNull('hari_id');
        }

        return view('sesi-pelajaran.index', [
            'sesi_pelajaran' => $query->get(),
            'hari' => Hari::select('id', 'nama_hari')->orderByRaw("CASE nama_hari WHEN 'Senin' THEN 1 WHEN 'Selasa' THEN 2 WHEN 'Rabu' THEN 3 WHEN 'Kamis' THEN 4 WHEN 'Jumat' THEN 5 WHEN 'Sabtu' THEN 6 WHEN 'Minggu' THEN 7 ELSE 8 END, nama_hari ASC")->get(),
        ]);
    }

    public function addSesiPelajaran(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hari_id' => 'required|array|min:1',
            'hari_id.*' => 'required|exists:hari,id',
            'entries' => 'required|array|min:1',
            'entries.*.sesi_pelajaran' => 'required|string|min:1|max:150',
            'entries.*.jam_mulai' => 'required|date_format:H:i',
            'entries.*.jam_selesai' => 'required|date_format:H:i',
            'entries.*.zona_waktu' => 'required|in:WIB,WITA,WIT',
        ], [
            'required' => ':attribute wajib diisi!',
            'entries.*.sesi_pelajaran.max' => 'Data sesi pelajaran diisi maksimal :max karakter!',
            'entries.*.sesi_pelajaran.min' => 'Data sesi pelajaran diisi minimal :min karakter!',
            'entries.*.zona_waktu.in' => 'Zona waktu tidak valid!',
            'entries.*.jam_mulai.date_format' => 'Format jam mulai tidak valid!',
            'entries.*.jam_selesai.date_format' => 'Format jam selesai tidak valid!',
        ]);

        $validator->after(function ($validator) use ($request) {
            $hariIds = $request->input('hari_id', []);
            $entries = $request->input('entries', []);
            $duplicates = [];

            foreach ($hariIds as $hariId) {
                foreach ($entries as $index => $entry) {
                    $sesiPelajaran = data_get($entry, 'sesi_pelajaran');
                    if (!$sesiPelajaran) {
                        continue;
                    }

                    if (SesiPelajaran::where('hari_id', $hariId)
                        ->where('sesi_pelajaran', $sesiPelajaran)
                        ->exists()
                    ) {
                        $validator->errors()->add(
                            "entries.$index.sesi_pelajaran",
                            "Sesi pelajaran \"{$sesiPelajaran}\" untuk hari ID {$hariId} sudah ada!"
                        );
                    }

                    $key = $hariId . '||' . strtolower(trim($sesiPelajaran));
                    if (isset($duplicates[$key])) {
                        $validator->errors()->add(
                            "entries.$index.sesi_pelajaran",
                            "Duplikat sesi pelajaran \"{$sesiPelajaran}\" untuk hari ID {$hariId} dalam request."
                        );
                    }
                    $duplicates[$key] = true;
                }
            }
        });

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $createdSessions = [];

        foreach ($data['entries'] as $entry) {
            foreach ($data['hari_id'] as $hariId) {
                $createdSessions[] = SesiPelajaran::create([
                    'hari_id' => $hariId,
                    'sesi_pelajaran' => $entry['sesi_pelajaran'],
                    'jam_mulai' => $entry['jam_mulai'],
                    'jam_selesai' => $entry['jam_selesai'],
                    'zona_waktu' => $entry['zona_waktu'],
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Data sesi pelajaran berhasil ditambahkan!',
            'sessions' => collect($createdSessions)->map(function ($session) {
                return [
                    'sesi_pelajaran' => $session->sesi_pelajaran,
                    'jam_mulai' => $session->jam_mulai,
                    'jam_selesai' => $session->jam_selesai,
                    'zona_waktu' => $session->zona_waktu,
                ];
            })->all(),
        ]);
    }

    public function editSesiPelajaran(Request $request)
    {
        $data = $request->validate([
            'sesi_pelajaran' => 'required|unique:sesi_pelajaran,sesi_pelajaran,' . $request->sesi_pelajaran_id . '|min:1|max:150',
            'jam_mulai'      => 'required',
            'jam_selesai'    => 'required',
            'zona_waktu'     => 'required'
        ], [
            'required'           => ':attribute wajib diisi!',
            'sesi_pelajaran.max' => 'Data sesi pelajaran diisi maksimal :max karakter!',
            'sesi_pelajaran.min' => 'Data sesi pelajaran diisi minimal :min karakter!',
            'sesi_pelajaran.unique' => 'Nama sesi pelajaran tersebut sudah digunakan!'
        ]);

        SesiPelajaran::where('id', $request->sesi_pelajaran_id)->update($data);

        return redirect()->route('sesi.pelajaran')->with('sukses', 'Data sesi pelajaran berhasil diperbarui!');
    }

    public function deleteSesiPelajaran(Request $request)
    {
        SesiPelajaran::destroy($request->input('sesi_pelajaran_id'));

        return redirect()->route('sesi.pelajaran')->with('sukses', 'Data sesi pelajaran berhasil dihapus!');
    }


    public function addHari(Request $request)
    {
        $data = $request->validate([
            'nama_hari' => 'required|unique:hari|min:1|max:150',
        ], [
            'required'           => ':attribute wajib diisi!',
            'nama_hari.max' => 'Data nama hari diisi maksimal :max karakter!',
            'nama_hari.min' => 'Data nama hari diisi minimal :min karakter!',
            'nama_hari.unique' => 'Nama hari tersebut sudah digunakan!'
        ]);

        Hari::create($data);

        return redirect()->route('sesi.pelajaran')->with('sukses', 'Data hari berhasil ditambahkan!');
    }

    public function editHari(Request $request)
    {
        $data = $request->validate([
            'nama_hari' => 'required|unique:hari,nama_hari,' . $request->hari_id . '|min:1|max:150',
        ], [
            'required'           => ':attribute wajib diisi!',
            'nama_hari.max' => 'Data nama hari diisi maksimal :max karakter!',
            'nama_hari.min' => 'Data nama hari diisi minimal :min karakter!',
            'nama_hari.unique' => 'Nama hari tersebut sudah digunakan!'
        ]);

        Hari::where('id', $request->hari_id)->update($data);

        return redirect()->route('sesi.pelajaran')->with('sukses', 'Data hari berhasil diperbarui!');
    }

    public function deleteHari(Request $request)
    {
        Hari::destroy($request->input('hari_id'));
        SesiPelajaran::where('hari_id', $request->input('hari_id'))->delete();

        return redirect()->route('sesi.pelajaran')->with('sukses', 'Data hari berhasil dihapus!');
    }

    public function generateHari()
    {
        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        foreach ($hari as $h) {
            Hari::firstOrCreate([
                'nama_hari' => $h
            ]);
        }

        return redirect()->route('sesi.pelajaran')->with('sukses', 'Data hari berhasil digenerate!');
    }
}
