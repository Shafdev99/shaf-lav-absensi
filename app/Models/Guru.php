<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guru extends Model
{
    /// tabel akan terisi secara otomatis dengan data acak
    use HasFactory;

    // ID akan secara otomatis berisi kode acak
    use HasUuids;

    //Nama tabel adalah guru
    protected $table = 'guru';

    // Kolom yang tidak boleh di isi
    protected $guarded = ['id'];


    public function ScopeUserGuru(Builder $query)
    {
        return $query->join('user_guru', 'user_guru.guru_id', '=', 'guru.id')
            ->join('users', 'users.id', '=', 'user_guru.user_id')
            ->where('role', 'guru')
            ->orderByDesc('users.created_at');
    }

    public function ScopeUserStaff(Builder $query)
    {
        return $query->join('user_staff', 'user_staff.staff_id', '=', 'guru.id')
            ->join('users', 'users.id', '=', 'user_staff.user_id')
            ->where('jabatan', 'Staff')
            ->orderByDesc('users.created_at');
    }

    public function ScopeUserKepsek(Builder $query)
    {
        return $query->join('user_kepsek', 'user_kepsek.kepsek_id', '=', 'guru.id')
            ->join('users', 'users.id', '=', 'user_kepsek.user_id')
            ->where('jabatan', 'Kepala Sekolah')
            ->orderByDesc('users.created_at');
    }

    public function scopeCari(Builder $query, $filter = [])
    {
        $query->when($filter['keyword'] ?? false, function ($query, $search) {
            return $query->where('nama_guru', 'like', '%' . $search . '%');
        });
    }
}
