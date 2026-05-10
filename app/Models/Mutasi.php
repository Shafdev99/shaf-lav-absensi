<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mutasi extends Model
{
    //// tabel akan terisi secara otomatis dengan data acak
    use HasFactory;

    // ID akan secara otomatis berisi kode acak
    use HasUuids;

    //Nama tabel adalah mutasi  
    protected $table = 'mutasi';

    // Kolom yang tidak boleh di isi
    protected $guarded = ['id'];

    public function tingkat()
    {
        return $this->belongsTo(Tingkat::class, 'tingkat_id');
    }

    public function tahunAjar()
    {
        return $this->belongsTo(TahunAjar::class, 'tahun_ajar');
    }

    public function scopeSiswa(Builder $query, $tahunAjarId)
    {
        return $query->select(
            'siswa.nama_lengkap',
            'tingkat.tingkat',
            'kelas.nama_kelas',
            'jurusan.nama_jurusan',
            'mutasi.created_at',
        )
            ->join(
                'siswa',
                'siswa.id',
                '=',
                'mutasi.siswa_id'
            )
            ->join(
                'keterangan_keterima',
                'keterangan_keterima.siswa_id',
                '=',
                'siswa.id',
            )
            ->join(
                'kelas',
                'kelas.id',
                '=',
                'keterangan_keterima.kelas_id',
            )
            ->join(
                'jurusan',
                'jurusan.id',
                '=',
                'keterangan_keterima.jurusan_id',
            )
            ->join(
                'tingkat',
                'tingkat.id',
                '=',
                'keterangan_keterima.tingkat_id',
            )
            ->where('mutasi.tahun_ajar_id', $tahunAjarId);
    }
}
