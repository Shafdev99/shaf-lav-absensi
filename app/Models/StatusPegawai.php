<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatusPegawai extends Model
{
    /// tabel akan terisi secara otomatis dengan data acak
    use HasFactory;

    // ID akan secara otomatis berisi kode acak
    use HasUuids;

    //Nama tabel adalah Status Kepegawaian  
    protected $table = 'status_pegawai';

    // Kolom yang tidak boleh di isi
    protected $guarded = ['id'];
}
