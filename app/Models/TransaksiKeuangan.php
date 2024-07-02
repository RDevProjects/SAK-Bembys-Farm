<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
