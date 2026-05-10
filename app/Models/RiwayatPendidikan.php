<?php

namespace App\Models;

use App\Models\Pendidikan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RiwayatPendidikan extends Model
{
    /// tabel akan terisi secara otomatis dengan data acak
    use HasFactory;

    // ID akan secara otomatis berisi kode acak
    use HasUuids;

    //Nama tabel adalah riwayat pendidikan
    protected $table = 'riwayat_pendidikan';

    // Kolom yang tidak boleh di isi
    protected $guarded = ['id'];

    public function scopePendidikan()
    {
        return $this->belongsTo(Pendidikan::class, 'pendidikan_id');
    }
}
