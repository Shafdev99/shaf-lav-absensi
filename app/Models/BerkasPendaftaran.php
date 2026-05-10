<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BerkasPendaftaran extends Model
{
    /// tabel akan terisi secara otomatis dengan data acak
    use HasFactory;

    // ID akan secara otomatis berisi kode acak
    use HasUuids;

    //Nama tabel adalah berkas_pendaftaran
    protected $table = 'berkas_pendaftaran';

    // Kolom yang tidak boleh di isi
    protected $guarded = ['id'];
}
