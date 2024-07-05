<?php

namespace Database\Seeders;

use App\Models\KeteranganTransaksi;
use App\Models\KodeRekening;
use App\Models\TransaksiKeuangan;
use App\Models\Unit;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        KeteranganTransaksi::factory(10)->create();
        KodeRekening::factory(10)->create();
        Unit::factory(10)->create();
        // TransaksiKeuangan::factory(10)->create();
        $this->call(SeederStatic::class);
    }
}
