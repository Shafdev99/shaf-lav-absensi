<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mapel extends Model
{
    /// tabel akan terisi secara otomatis dengan data acak
    use HasFactory;

    // ID akan secara otomatis berisi kode acak
    use HasUuids;

    //Nama tabel adalah mapel / Kelompok Mapel  
    protected $table = 'mapel';

    // Kolom yang tidak boleh di isi
    protected $guarded = ['id'];

    // public function guruPengampu()
    // {
    //     return $this->hasOne(Guru::class, 'id', 'guru_id');
    // }
}
