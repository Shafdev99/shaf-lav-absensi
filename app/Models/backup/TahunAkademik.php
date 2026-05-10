<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TahunAkademik extends Model
{
    /// tabel akan terisi secara otomatis dengan data acak
    use HasFactory;

    // ID akan secara otomatis berisi kode acak
    use HasUuids;

    //Nama tabel adalah tahun_akademik / Status Kepegawaian  
    protected $table = 'tahun_akademik';

    // Kolom yang tidak boleh di isi
    protected $guarded = ['id'];

    public function tahunAjar()
    {
        return $this->belongsTo(TahunAjar::class, 'tahun_ajar_id');
    }

    public function scopeJoinTahunAjar(Builder $query, $tahunIni)
    {
        return $query->join('tahun_ajar', 'tahun_ajar.id', '=', 'tahun_akademik.tahun_ajar_id')
            ->where('tahun_ajar', 'like', '%' . $tahunIni);
    }

    public function scopeTahunAjarDesc(Builder $query)
    {
        return $query->select(
            'tahun_akademik.id',
            'tahun_akademik.status',
            'tahun_akademik.semester',
            'tahun_ajar.tahun_ajar',
        )
            ->join('tahun_ajar', 'tahun_ajar.id', '=', 'tahun_akademik.tahun_ajar_id')
            ->orderBy('tahun_ajar.tahun_ajar', 'desc')
            ->where('status', 'true')
            ->get();
    }

    public function scopeTahunAkademik(Builder $query)
    {
        return $query->select(
            'tahun_akademik.id',
            'tahun_akademik.status',
            'tahun_akademik.semester',
            'tahun_ajar.tahun_ajar',
            'kurikulum.nama_kurikulum',
        )
            ->join('tahun_ajar', 'tahun_ajar.id', '=', 'tahun_akademik.tahun_ajar_id')
            ->join('kurikulum', 'kurikulum.tahun_ajar_id', '=', 'tahun_ajar.id')
            ->orderBy('tahun_ajar.tahun_ajar', 'desc')
            // ->where('tahun_akademik.status', 'true')
            ->get();
    }
}
