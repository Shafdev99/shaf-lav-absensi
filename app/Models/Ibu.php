<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ibu extends Model
{
    //// tabel akan terisi secara otomatis dengan data acak
    use HasFactory;

    // ID akan secara otomatis berisi kode acak
    use HasUuids;

    //Nama tabel adalah ibu
    protected $table = 'ibu';

    // Kolom yang tidak boleh di isi
    protected $guarded = ['id'];

    public function agama()
    {
        return $this->belongsTo(Agama::class, 'agama_ibu')->select('id', 'agama');
    }

    public function pendidikan()
    {
        return $this->belongsTo(Pendidikan::class, 'pendidikan_ibu')->select('id', 'pendidikan');
    }
}
