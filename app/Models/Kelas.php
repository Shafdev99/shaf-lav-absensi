<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{

    // tabel akan terisi secara otomatis dengan data acak
    use HasFactory;

    // ID akan secara otomatis berisi kode acak
    use HasUuids;

    // Kolom yang tidak boleh terisi
    protected $guarded = ['id'];

    public function scopeTampilKelas(Builder $query)
    {
        return $query->select(
            'kelas.id',
            'kelas.nama_kelas',
            'kelas.tingkat_id',
            'kelas.jurusan_id',
            'kelas.kurlum_id',
            'kelas.jumlah_jam',
            'tingkat.tingkat',
            'jurusan.nama_jurusan',
            'jurusan.keterangan',
            'kurikulum.nama_kurikulum'
        )
            ->join('kurikulum', 'kelas.kurlum_id', '=', 'kurikulum.id')
            ->join('jurusan', 'kelas.jurusan_id', '=', 'jurusan.id')
            ->join('tingkat', 'kelas.tingkat_id', '=', 'tingkat.id');
    }

    public function scopeUrutanKelas(Builder $query)
    {
        return $query->select(
            'kelola_siswa.kelas_id',
            'kelas.nama_kelas',
            'tingkat.tingkat',
            'jurusan.nama_jurusan',
            'jurusan.keterangan',
            DB::raw('COUNT(siswa.id) as totalSiswa')
        )
            ->join('kelola_siswa', 'kelola_siswa.kelas_id', '=', 'kelas.id')
            ->join('siswa', 'siswa.id', '=', 'kelola_siswa.siswa_id')
            ->join('kurikulum', 'kelas.kurlum_id', '=', 'kurikulum.id')
            ->join('jurusan', 'kelas.jurusan_id', '=', 'jurusan.id')
            ->join('tingkat', 'kelas.tingkat_id', '=', 'tingkat.id')
            ->where('kelola_siswa.tahun_ajar_id', session('tahun_ajar_id'))
            ->orderBy('tingkat', 'asc')
            ->orderBy('nama_jurusan', 'asc')
            ->orderBy('nama_kelas', 'asc')
            ->groupBy('kelola_siswa.kelas_id');
    }

    public function scopeWalkel(Builder $query, $tahun_ajar_id)
    {
        return $query->select(
            'kelas.id',
            'kelas.nama_kelas',
            'kelas.tingkat_id',
            'kelas.jurusan_id',
            'tingkat.tingkat',
            'jurusan.nama_jurusan',
            'jurusan.keterangan'
        )
            ->join('walkel', 'walkel.kelas_id', '=', 'kelas.id')
            ->join('jurusan', 'kelas.jurusan_id', '=', 'jurusan.id')
            ->join('tingkat', 'kelas.tingkat_id', '=', 'tingkat.id')
            ->where('tahun_ajar_id', $tahun_ajar_id)->get();
    }

    public function scopePilihKelas(Builder $query, $kelasIds)
    {
        return $query->select(
            'kelas.id',
            'kelas.nama_kelas',
            'kelas.tingkat_id',
            'kelas.jurusan_id',
            'tingkat.tingkat',
            'jurusan.nama_jurusan',
            'jurusan.keterangan'
        )
            ->join('jurusan', 'kelas.jurusan_id', '=', 'jurusan.id')
            ->join('tingkat', 'kelas.tingkat_id', '=', 'tingkat.id')
            ->whereNotIn('kelas.id', $kelasIds)->get();
    }

    public function scopeDaftarKelas(Builder $query)
    {
        return $query->select(
            'kelas.id',
            'kelas.nama_kelas',
            'kelas.tingkat_id',
            'kelas.jurusan_id',
            'tingkat.tingkat',
            'jurusan.nama_jurusan',
            'jurusan.keterangan'
        )
            ->join('jurusan', 'kelas.jurusan_id', '=', 'jurusan.id')
            ->join('tingkat', 'kelas.tingkat_id', '=', 'tingkat.id')
            ->get();
    }
}
