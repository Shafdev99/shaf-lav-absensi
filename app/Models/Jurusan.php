<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jurusan extends Model
{
    // tabel akan terisi secara otomatis dengan data acak
    use HasFactory;

    // ID akan secara otomatis berisi kode acak
    use HasUuids;

    // Kolom yang tidak boleh terisi
    protected $guarded = ['id'];

    protected $table = 'jurusan';

    public function scopeCari(Builder $query, $filter = [])
    {
        $query->when($filter['nama_jurusan'] ?? false, function ($query, $search) {
            return $query->where('nama_jurusan', 'like', '%' . $search . '%');
        });
    }

    public function scopeTersedia(Builder $query)
    {
        return $query
            ->join('kelas', 'kelas.jurusan_id', '=', 'jurusan.id')
            ->select('jurusan.id', 'jurusan.nama_jurusan', 'jurusan.keterangan')
            ->groupBy('jurusan.id', 'jurusan.nama_jurusan', 'jurusan.keterangan') // Add all selected columns here
            ->orderBy('nama_jurusan', 'asc');
    }
}
