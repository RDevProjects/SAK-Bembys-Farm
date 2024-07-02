<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransaksiKeuangan>
 */
class TransaksiKeuanganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_jurnal' => $this->faker->randomNumber(5),
            'no_trx' => $this->faker->unique()->numberBetween(1, 8000),
            'account_number' => $this->faker->randomNumber(5),
            'index_kas' => $this->faker->randomNumber(5),
            'nama_unit' => $this->faker->word,
            'index_unit' => $this->faker->randomNumber(5),
            'debet' => $this->faker->randomNumber(5),
            'kredit' => $this->faker->randomNumber(5),
        ];
    }
}
