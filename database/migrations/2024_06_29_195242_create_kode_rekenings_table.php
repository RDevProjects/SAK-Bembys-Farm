<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kode_rekening', function (Blueprint $table) {
            $table->string('kode_rek', 20)->unique()->primary();
            $table->string('nama_rek', 50);
            $table->string('kelompok_rek', 30);
            $table->string('tipe_rek', 5);
            $table->string('saldo_awal', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kode_rekening');
    }
};
