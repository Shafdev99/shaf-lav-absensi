<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Aclog extends Model
{
    // Nama tabel adalah aclog
    protected $table = 'aclog';

    // Kolom yang tidak boleh di isi
    protected $guarded = ['id'];

    // ID akan secara otomatis berisi kode acak
    use HasUuids;

    // Memiliki relasi ke tabel user
    public function user()
    {
        return $this->belongsTo(User::class)->select('id', 'name', 'role');
    }

    // Function untuk mencari data didalam tabel aclog
    public function scopeCari(Builder $query, $filter = [])
    {
        // Ketika variabel keyword terisi, maka lakukan proses selanjutnya
        $query->when($filter['keyword'] ?? false, function ($query, $search) {

            // Ketika variabel search berisi sama dengan objek
            return $query->where('objek', 'like', '%' . $search . '%')
                // Atau sama dengan tanggal
                ->orWhere('tanggal', 'like', '%' . $search . '%')

                // Bahkan dalam tabel user  
                ->whereHas('user', function ($query) use ($search) {

                    // ketika variabel search berisi sama dengan name
                    $query->where('name', 'like', '%' . $search . '%')
                        // Atau sama dengan role
                        ->orWhere('role', 'like', '%' . $search . '%');


                    // Maka tampilkan data berdasarkan data yang didapat
                });
        });
    }
}
