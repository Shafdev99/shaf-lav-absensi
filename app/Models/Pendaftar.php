<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendaftar extends Model
{
    /// tabel akan terisi secara otomatis dengan data acak
    use HasFactory;

    // ID akan secara otomatis berisi kode acak
    use HasUuids;

    //Nama tabel adalah pendaftar  
    protected $table = 'pendaftar';

    // Kolom yang tidak boleh di isi
    protected $guarded = ['id'];

    public function religion()
    {
        return $this->belongsTo(Agama::class, 'agama');
    }

    public function berkas()
    {
        return $this->hasOne(BerkasPendaftaran::class, 'pendaftar_id');
    }

    public function ayah()
    {
        return $this->hasOne(Ayah::class, 'siswa_id');
    }

    public function ibu()
    {
        return $this->hasOne(Ibu::class, 'siswa_id');
    }

    public function wali()
    {
        return $this->hasOne(Walmur::class, 'siswa_id');
    }

    public function jurusan()
    {
        return $this->hasOneThrough(
            Jurusan::class,              // 1. Model Target Akhir
            KeteranganKeterima::class,   // 2. Model Perantara
            'siswa_id',                  // 3. Foreign key di KeteranganKeterima (merujuk ke Pendaftar)
            'id',                        // 4. Foreign key di Jurusan (merujuk ke KeteranganKeterima)
            'id',                        // 5. Local key di Pendaftar
            'jurusan_id'                 // 6. Local key di KeteranganKeterima (yang menunjuk ke Jurusan)
        );
    }

    public function keterangan()
    {
        return $this->hasOne(KeteranganKeterima::class, 'siswa_id');
    }

    public function scopeCariPendaftar(Builder $query, $kataKunci = null)
    {
        return $query->where('nama_lengkap', 'like', '%' . $kataKunci . '%')
            ->orWhere('no_pendaftaran', $kataKunci)
            ->orWhere('nisn', $kataKunci);
    }

    public function scopeCekStatus(Builder $query, $Identitas)
    {
        return $query->where('nik', $Identitas)
            ->orWhere('nisn', $Identitas)
            ->orWhere('no_pendaftaran', $Identitas);
    }

    public function scopeTotal(Builder $query, $tahunAjarId)
    {
        return $query->select('tahun_ajar_id')
            ->join(
                'keterangan_keterima',
                'keterangan_keterima.siswa_id',
                '=',
                'pendaftar.id'
            )
            ->where('tahun_ajar_id', $tahunAjarId);
    }
}
