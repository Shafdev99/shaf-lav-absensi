<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alumni extends Model
{
    /// tabel akan terisi secara otomatis dengan data acak
    use HasFactory;

    // ID akan secara otomatis berisi kode acak
    use HasUuids;

    //Nama tabel adalah alumni
    protected $table = 'alumni';

    // Kolom yang tidak boleh di isi
    protected $guarded = ['id'];

    public function scopeUrutanSiswa(Builder $query)
    {
        $query->select(
            'siswa.id',
            'siswa.foto',
            'siswa.nama_lengkap',
            'siswa.nisn',
            'siswa.nis',
            'siswa.jenis_kelamin',
            'siswa.status',
            'kelas.nama_kelas',
            'jurusan.nama_jurusan',
            'tingkat.tingkat',
            'alumni.kelas_id',
        )
            ->join('siswa', 'siswa.id', '=', 'alumni.siswa_id')
            ->join('kelas', 'kelas.id', '=', 'alumni.kelas_id')
            ->join('jurusan', 'jurusan.id', '=', 'kelas.jurusan_id')
            ->join('tingkat', 'tingkat.id', '=', 'kelas.tingkat_id');
    }

    public function scopeKelas(Builder $query)
    {
        return $query->join('kelas', 'kelas.id', '=', 'alumni.kelas_id')
            ->join('jurusan', 'jurusan.id', '=', 'kelas.jurusan_id')
            ->join('tingkat', 'tingkat.id', '=', 'kelas.tingkat_id')
            ->select(
                'kelas.id',
                'kelas.nama_kelas',
                'jurusan.nama_jurusan',
                'tingkat.tingkat',
            )
            ->groupBy('kelas.id', 'kelas.nama_kelas', 'jurusan.nama_jurusan', 'tingkat.tingkat');
    }

    public function scopeCariDetail(Builder $query, $filter = [], $kelasId = null, $tahunAjar = null)
    {
        $kelas      = $filter['kelas'] ?? $kelasId;
        $siswa      = $filter['nama_siswa'] ?? false;

        if ($kelas && $siswa) {
            return $query
                ->where('kelas.id', $kelas)
                ->where('siswa.nama_lengkap', 'like', '%' . $siswa . '%')
                ->where('tahun_ajar_id', $tahunAjar);
        } else {
            return $query
                ->where('kelas.id', $kelas)
                ->where('tahun_ajar_id', $tahunAjar);
        }
    }

    // public function scopeCariAlumni(Builder $query, $tahunAjarId, $kelasId, $namaAlumni)
    // {
    //     if ($tahunAjarId && $kelasId && $namaAlumni) {
    //         return $query
    //             ->where('tahun_ajar_id', $tahunAjarId)
    //             ->where('kelas.id', $kelasId)
    //             ->where('siswa.nama_lengkap', 'like', $namaAlumni . '%');
    //     } elseif($tahunAjarId && $kelasId) {
    //         return $query
    //             ->where('tahun_ajar_id', $tahunAjarId)
    //             ->where('kelas.id', $kelasId);
    //     } elseif () {

    //     }
    // }
}
