<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KurikulumMapel extends Model
{
    /// tabel akan terisi secara otomatis dengan data acak
    use HasFactory;

    // ID akan secara otomatis berisi kode acak
    use HasUuids;

    //Nama tabel adalah Kurikulum Mapel  
    protected $table = 'kurikulum_mapel';

    // Kolom yang tidak boleh di isi
    protected $guarded = ['id'];

    public function scopeKurMapel(Builder $query, $kurlumId)
    {
        return $query->select('kurikulum_mapel.id', 'kurikulum_mapel.kurlum_id', 'kurikulum_mapel.kelompok_mapel_id', 'kurikulum_mapel.mapel_id', 'kurikulum_mapel.urutan_mapel', 'mapel.mapel', 'mapel.kkm')
            ->join('kurikulum', 'kurikulum.id', '=', 'kurikulum_mapel.kurlum_id')
            ->join('mapel', 'mapel.id', '=', 'kurikulum_mapel.mapel_id')
            ->join('kelompok_mapel', 'kelompok_mapel.id', '=', 'kurikulum_mapel.kelompok_mapel_id')
            ->where('kurlum_id', $kurlumId);
    }
}
