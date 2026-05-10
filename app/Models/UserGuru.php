<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserGuru extends Model
{
    /// tabel akan terisi secara otomatis dengan data acak
    use HasFactory;

    // ID akan secara otomatis berisi kode acak
    use HasUuids;

    //Nama tabel adalah user_guru  
    protected $table = 'user_guru';

    // Kolom yang tidak boleh di isi
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
