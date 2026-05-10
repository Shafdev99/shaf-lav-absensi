<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Binduk extends Model
{
    use HasUuids;
    // Nama tabel adalah binduk
    protected $table = 'binduk';

    // Tabel yang tidak boleh terisi
    protected $guarded = ['binduk_id'];

    // Memiliki relasi ke tabel kelas
    public function ke_tingkat()
    {
        return $this->belongsTo(Kelas::class, 'ke_tingkat');
    }
}
