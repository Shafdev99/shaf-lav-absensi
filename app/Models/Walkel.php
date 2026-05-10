<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Walkel extends Model
{
    /// tabel akan terisi secara otomatis dengan data acak
    use HasFactory;

    // ID akan secara otomatis berisi kode acak
    use HasUuids;

    //Nama tabel adalah wali kelas
    protected $table = 'walkel';

    // Kolom yang tidak boleh di isi
    protected $guarded = ['id'];

    public function scopeMerge(Builder $query, $tahun_ajar_id)
    {
        return $query->select(
            'walkel.id',
            'walkel.guru_id',
            'walkel.kelas_id',
            'walkel.tahun_ajar_id'
        )
            ->join('tahun_ajar', 'tahun_ajar.id', '=', 'walkel.tahun_ajar_id')
            ->where('tahun_ajar_id', $tahun_ajar_id)
            ->get();
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    public function ScopeCekWalkel(Builder $query)
    {
        return $query->join('user_guru', 'user_guru.guru_id', '=', 'walkel.guru_id')
            ->join('users', 'users.id', '=', 'user_guru.user_id');
    }
}
