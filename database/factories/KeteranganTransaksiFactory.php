<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KeteranganTransaksi>
 */
class KeteranganTransaksiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bukti_transaksi' => $this->faker->unique()->numberBetween(1, 8000),
            'tanggal_transaksi' => $this->faker->dateTime(),
            'keterangan' => $this->faker->text(100),
        ];
    }
}
