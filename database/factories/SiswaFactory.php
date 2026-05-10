<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_lengkap' => fake()->name(),
            'tempat_lahir' => fake()->city(),
            'tanggal_lahir' => fake()->date(),
            'nisn' => fake()->numerify('##########'),
            'nis' => fake()->randomNumber(6, true),
            'nik' => fake()->nik(),
            'alamat' => fake()->address(),
            'jenis_kelamin' => fake()->randomElement(['Laki-laki', 'Perempuan']),
            'agama' => fake()->randomElement(['Islam', 'Kristen', 'Hindu', 'Budha', 'Konghucu']),
            'nama_ayah' => fake()->name('male'),
            'nama_ibu' => fake()->name('female'),
            'alamat_ortu' => fake()->address(),
            'nama_wali' => fake()->name(),
            'alamat_wali' => fake()->address(),
            'nama_sekolah' => fake()->randomElement(['SMP', 'MTS']) . ' ' . fake()->randomElement(['Negeri', 'Swasta']) . ' ' . fake()->city(),
            'alamat_sekolah' => fake()->city(),
            'tahun_lulus' => fake()->randomElement(['2021', '2022', '2023', '2024']),
            'nomer_ijazah' => fake()->randomElement(['SMP/2025/']) . fake()->numerify('########'),
            'tanggal_keterima' => date('Y-m-d'),
            'tahun_ajar' => fake()->randomElement(['2021/2022', '2022/2023', '2023/2024', '2024/2025']),
            'lulus' => fake()->randomElement(['Belum']),
        ];
    }
}
