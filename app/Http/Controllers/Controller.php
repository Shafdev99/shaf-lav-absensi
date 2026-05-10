<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Aclog;
use App\Models\Siswa;
use App\Models\Walkel;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    //======== Record All Activity ========//
    public function record($userId, $aktivitas, $objek, $deskripsi, $tanggal, $waktu)
    {
        // Proses simpan semua aktivitas dari setiap menu ke dalam database
        Aclog::create([
            'user_id'   => $userId,
            'aktivitas' => $aktivitas,
            'objek'     => $objek,
            'deskripsi' => $deskripsi,
            'tanggal'   => $tanggal,
            'waktu'     => $waktu,
        ]);

        return true;
    }
}
