<?php

namespace Database\Seeders;

use App\Models\KeteranganTransaksi;
use App\Models\KodeRekening;
use Illuminate\Database\Seeder;
use App\Models\TransaksiKeuangan;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SeederStatic extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KodeRekening::create([
            'kode_rek' => 1000,
            'nama_rek' => 'Test',
            'kelompok_rek' => 'Test',
            'tipe_rek' => 'Ut.',
            'saldo_awal' => '15000',
        ]);

        KeteranganTransaksi::create([
            'bukti_transaksi' => 1000,
            'tanggal_transaksi' => DateTime::createFromFormat('Y-m-d H:i:s', '2024-06-29 19:41:40'),
            'keterangan' => 'Test',
        ]);

        TransaksiKeuangan::create([
            'id_jurnal' => 1,
            'no_akun' => 1000,
            'account_number' => 1000,
            'index_kas' => 1,
            'nama_unit' => 'Test',
            'index_unit' => 1,
            'debet' => 1,
            'kredit' => 1,
        ]);
    }
}
