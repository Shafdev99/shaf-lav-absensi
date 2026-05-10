<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RekapSpmb extends Model
{

    /// tabel akan terisi secara otomatis dengan data acak
    use HasFactory;

    // ID akan secara otomatis berisi kode acak
    // use HasUuids;

    // 1. Beritahu Laravel bahwa ID bukan Auto Increment
    public $incrementing = false;

    // 2. Beritahu Laravel bahwa tipe datanya adalah String
    protected $keyType = 'string';

    //Nama tabel adalah rekap_spmb  
    protected $table = 'rekap_spmb';

    // Kolom yang tidak boleh di isi
    protected $guarded = ['created_at', 'updated_at'];

    public function scopeCariRekap(Builder $query, $kataKunci = null, $tahunAjarId = null)
    {
        $tahunAjarId = $tahunAjarId ?? session('tahun_ajar_id');
        return $query->select(
            'rekap_spmb.id',
            'rekap_spmb.no_pendaftaran',
            'rekap_spmb.nama_lengkap',
            'rekap_spmb.foto',
            'rekap_spmb.nisn',
            'rekap_spmb.status',
            'rekap_spmb.kondisi_berkas',
            'rekap_spmb.penanggung_jawab',
            'rekap_spmb.created_at',
            'berkas_pendaftaran.asal_sekolah',
            'jurusan.nama_jurusan',
            'keterangan_keterima.tahun_ajar_id'
        )
            ->join(
                'keterangan_keterima',
                'keterangan_keterima.siswa_id',
                '=',
                'rekap_spmb.id'
            )
            ->join(
                'jurusan',
                'jurusan.id',
                '=',
                'keterangan_keterima.jurusan_id'
            )
            ->join(
                'berkas_pendaftaran',
                'berkas_pendaftaran.pendaftar_id',
                '=',
                'rekap_spmb.id'
            )
            ->where(
                function ($query) use ($kataKunci) {
                    $query->where('rekap_spmb.nama_lengkap', 'like', '%' . $kataKunci . '%')
                        ->orWhere('rekap_spmb.nisn', 'like', '%' . $kataKunci . '%');
                }
            )
            ->where('keterangan_keterima.tahun_ajar_id', $tahunAjarId)
            ->where('rekap_spmb.status', 'arsip');
    }

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

    public function scopeTotal(Builder $query, $tahunAjarId)
    {
        return $query->select('tahun_ajar_id')
            ->join(
                'keterangan_keterima',
                'keterangan_keterima.siswa_id',
                '=',
                'rekap_spmb.id'
            )
            ->where('tahun_ajar_id', $tahunAjarId);
    }
}
