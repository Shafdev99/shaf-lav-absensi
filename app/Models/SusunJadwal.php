<?php

namespace App\Models;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SusunJadwal extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'susun_jadwal';


    protected $fillable = [
        'hari_id',
        'sesi_id',
        'kelas_id',
        'guru_pengampu_id',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function sesiPelajaran()
    {
        return $this->belongsTo(SesiPelajaran::class, 'sesi_id');
    }

    // public function mapel()
    // {
    //     return $this->belongsTo(Mapel::class, 'mapel_id');
    // }

    // public function guru()
    // {
    //     return $this->belongsTo(Guru::class, 'guru_id');
    // }
}
