<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Jurusan;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Muhammad Fila Shaufiq',
            'username' => 'admin',
            'email' => 'shaufiq@email.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'status' => 'aktif',
            'request' => 'kosong',
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'Rohmad Zainal Arifin',
            'username' => 'zainal',
            'email' => 'rohmadzainal@email.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'status' => 'aktif',
            'request' => 'kosong',
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'Ashaf Saputra',
            'username' => 'user',
            'email' => 'ashaf@email.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'role' => 'user',
            'status' => 'aktif',
            'request' => 'kosong',
            'remember_token' => Str::random(10)
        ]);

        // Kelas::factory(5)->create();
        // User::factory()->create();
        $kelas = Kelas::factory()->create();
        $jurusan = Jurusan::factory()->create();
        // Siswa::factory()->count(50)->for(Kelas::factory())->has(Jurusan::factory())->create();
        Siswa::factory()->count(50)->create([
            'kelas_id' => $kelas->id,
            'jurusan_id' => $jurusan->id,
        ]);
        Setting::factory(1)->create();
    }
}
