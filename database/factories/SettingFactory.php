<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_sekolah' => fake()->randomElement(['SMKN Konohagakure']),
            'npsn' => fake()->randomNumber(8, true),
            'nip' => fake()->randomNumber(8, true),
            'alamat_sekolah' => fake()->city(),
            'nama_kepsek' => fake()->name(),
            'password_user' => fake()->randomNumber(8, true)
        ];
    }
}
