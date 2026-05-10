<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Siswa extends Model
{
    // tabel akan terisi secara otomatis dengan data acak
    use HasFactory;

    // ID akan secara otomatis berisi kode acak
    use HasUuids;

    //Nama tabel adalah siswa  
    protected $table = 'siswa';

    // Kolom yang tidak boleh di isi
    protected $guarded = ['id'];


    // Function untuk mencari data didalam tabel siswa
    public function scopeCariDetail(Builder $query, $filter = [], $kelasId, $tahun_ajarId)
    {
        $kelas      = $filter['kelas'] ?? $kelasId;
        $tahun_ajar = $filter['tahun_ajar'] ?? $tahun_ajarId;
        $siswa      = $filter['nama_siswa'] ?? false;

        if ($tahun_ajar && $kelas && $siswa) {
            return $query
                ->where('tahun_ajar.id', $tahun_ajar)
                ->where('kelas.id', $kelas)
                ->where('nama_lengkap', 'like', '%' . $siswa . '%');
        } else {
            return $query
                ->where('tahun_ajar.id', $tahun_ajar)
                ->where('kelas.id', $kelas);
        }
    }

    // Function untuk mencari data didalam tabel kelas
    public function scopeKelas(Builder $query, $filter = [])
    {
        // Ketika variabel kelas terisi, maka lakukan proses selanjutnya
        $query->when($filter['kelas'] ?? false, function ($query, $search) {

            // Ketika variabel search berisi sama dengan kelas_id
            return $query->where('kelas_id', 'like', '%' . $search . '%');
        });
    }


    // Memiliki relasi ke tabel binduk
    public function binduk()
    {
        return $this->hasOne(Binduk::class);
    }

    // Memiliki relasi ke tabel binduk
    public function countBinduk()
    {
        return $this->hasOne(Binduk::class)->select('ke_tingkat');
    }

    // Memiliki relasi ke tabel kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function namaKelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id')->select('id', 'nama_kelas');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id')->select('id', 'nama_jurusan');
    }

    public function scopeUrutanSiswa(Builder $query)
    {
        return $query->select(
            'siswa.id',
            'siswa.nama_lengkap',
            'siswa.nisn',
            'siswa.nis',
            'siswa.jenis_kelamin',
            'siswa.status',
            'kelas.nama_kelas',
            'jurusan.nama_jurusan',
            'tingkat.tingkat',
        )
            ->join('keterangan_keterima', 'keterangan_keterima.siswa_id', '=', 'siswa.id')
            ->join('kelas', 'kelas.id', '=', 'keterangan_keterima.kelas_id')
            ->join('jurusan', 'jurusan.id', '=', 'kelas.jurusan_id')
            ->join('tingkat', 'tingkat.id', '=', 'kelas.tingkat_id')
            ->paginate(10)
            ->withQueryString();
    }

    public function scopeGetSiswaJoin(Builder $query)
    {
        return $query->select(
            'siswa.id',
            'siswa.nama_lengkap',
            'siswa.tanggal_lahir',
            'siswa.tempat_lahir',
            'siswa.nik',
            'siswa.nisn',
            'siswa.nis',
            'siswa.alamat',
            'siswa.agama',
            'siswa.foto',
            'siswa.jenis_kelamin',
            'siswa.status',
            'siswa.kurikulum_id',
            'kelas.nama_kelas',
            'keterangan_keterima.kelas_id',
            'keterangan_keterima.jurusan_id',
            'keterangan_keterima.tingkat_id',
            'keterangan_keterima.tanggal_keterima',
            'keterangan_keterima.tahun_ajar_id',
            'jurusan.nama_jurusan',
            'tingkat.tingkat',
            'tahun_ajar.tahun_ajar',
        )
            ->join('keterangan_keterima', 'keterangan_keterima.siswa_id', '=', 'siswa.id')
            ->join('tahun_ajar', 'tahun_ajar.id', '=', 'keterangan_keterima.tahun_ajar_id')
            ->join('kelas', 'kelas.id', '=', 'keterangan_keterima.kelas_id')
            ->join('jurusan', 'jurusan.id', '=', 'kelas.jurusan_id')
            ->join('tingkat', 'tingkat.id', '=', 'kelas.tingkat_id');
    }

    public function scopeExport(Builder $query)
    {
        return $query->select('siswa.*', 'kelas.nama_kelas', 'jurusan.nama_jurusan')
            ->join('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->join('jurusan', 'siswa.jurusan_id', '=', 'jurusan.id')
            ->orderByDesc('tahun_ajar')
            ->orderBy('nama_kelas', 'asc')
            ->orderBy('nama_jurusan', 'asc')
            ->orderBy('nama_lengkap', 'asc')
            ->get();
    }

    public function agama()
    {
        return $this->belongsTo(Agama::class, 'agama');
    }

    public function religion()
    {
        return $this->belongsTo(Agama::class, 'agama');
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

    public function pendidikan()
    {
        return $this->hasOne(RiwayatPendidikan::class, 'siswa_id')->latest();
    }

    public function keteranganKeterima()
    {
        return $this->hasOne(KeteranganKeterima::class, 'siswa_id');
    }
}
