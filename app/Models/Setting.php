<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasUuids, HasFactory;
    // Nama tabel adalah setting
    protected $table = 'setting';

    // Kolom yang tidak boleh diisi
    protected $guarded = ['id'];
}
