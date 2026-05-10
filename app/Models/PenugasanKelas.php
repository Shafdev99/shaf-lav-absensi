<?php

namespace App\Models;

use App\Models\GuruPengampu;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenugasanKelas extends Model
{
    use HasFactory, HasUuids;
    // Nama tabel yang digunakan
    protected $table = 'penugasan_kelas';

    // Kolom yang dapat diisi secara massal
    protected $fillable = ['guru_pengampu_id', 'kelas_id'];

    // Relasi dengan model GuruPengampu
    public function guruPengampu()
    {
        return $this->belongsTo(GuruPengampu::class, 'guru_pengampu_id');
    }
}
