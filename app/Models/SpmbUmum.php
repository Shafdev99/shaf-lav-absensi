<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SpmbUmum extends Model
{
    /// tabel akan terisi secara otomatis dengan data acak
    use HasFactory;

    // ID akan secara otomatis berisi kode acak
    use HasUuids;

    //Nama tabel adalah spmb_umum  
    protected $table = 'spmb_umum';

    // Kolom yang tidak boleh di isi
    protected $guarded = ['id'];
}
