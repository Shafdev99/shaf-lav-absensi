<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SesiPelajaran extends Model
{
    protected $table = 'sesi_pelajaran';
    protected $fillable = ['hari_id', 'sesi_pelajaran', 'jam_mulai', 'jam_selesai', 'zona_waktu'];
    /// tabel akan terisi secara otomatis dengan data acak
    use HasFactory;

    // ID akan secara otomatis berisi kode acak
    use HasUuids;

    /**
     * Relasi ke model Hari
     */
    public function hari(): BelongsTo
    {
        return $this->belongsTo(Hari::class, 'hari_id', 'id');
    }
}

