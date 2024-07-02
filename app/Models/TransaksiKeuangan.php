<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KodeRekening;

class TransaksiKeuangan extends Model
{
    use HasFactory;

    protected $table = 'transaksi_keuangan';

    protected $fillable = [
        'id_jurnal',
        'no_trx',
        'account_number',
        'index_kas',
        'nama_unit',
        'index_unit',
        'debet',
        'kredit',
    ];

    public function kodeRekening()
    {
        return $this->belongsTo(KodeRekening::class, 'account_number', 'kode_rek');
    }

    public function buktiTransaksi()
    {
        return $this->belongsTo(KeteranganTransaksi::class, 'no_trx', 'bukti_transaksi');
    }
}
