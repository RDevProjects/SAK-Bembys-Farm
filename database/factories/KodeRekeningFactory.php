<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KodeRekening>
 */
class KodeRekeningFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode_rek' => $this->faker->unique()->numberBetween(1, 8000),
            'nama_rek' => $this->faker->text(50),
            'kelompok_rek' => $this->faker->text(30),
            'tipe_rek' => $this->faker->text(5),
            'saldo_awal' => $this->faker->numberBetween(1, 20000),
        ];
    }
}
