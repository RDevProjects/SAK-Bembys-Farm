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
        Schema::create('transaksi_keuangan', function (Blueprint $table) {
            $table->integer('id_jurnal', 10)->autoIncrement()->unique()->primary();
            $table->string('no_akun', 10);
            $table->string('account_number', 20);
            $table->string('index_kas', 5);
            $table->string('nama_unit', 50);
            $table->string('index_unit', 5);
            $table->string('debet', 20);
            $table->string('kredit', 20);
            $table->timestamps();

            $table->foreign('no_akun')->references('bukti_transaksi')->on('keterangan_transaksi');
            $table->foreign('account_number')->references('kode_rek')->on('kode_rekening');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_keuangan');
    }
};
