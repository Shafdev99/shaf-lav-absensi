<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruPengampu extends Model
{
    /// tabel akan terisi secara otomatis dengan data acak
    use HasFactory;

    // ID akan secara otomatis berisi kode acak
    use HasUuids;

    //Nama tabel adalah mapel / Kelompok Mapel  
    protected $table = 'guru_pengampu';

    // Kolom yang tidak boleh di isi
    protected $guarded = ['id'];

    public function guru()
    {
        return $this->hasOne(Guru::class, 'id', 'guru_id');
    }

    public function mapel()
    {
        return $this->hasOne(Mapel::class, 'id', 'mapel_id');
    }

    public function penugasan()
    {
        return $this->hasMany(PenugasanKelas::class, 'guru_pengampu_id', 'id');
    }
}
