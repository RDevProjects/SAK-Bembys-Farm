<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeteranganTransaksi extends Model
{
    use HasFactory;

    protected $table = 'keterangan_transaksi';
    protected $primaryKey = 'bukti_transaksi';

    protected $fillable = [
        'bukti_transaksi',
        'tanggal_transaksi',
        'keterangan'
    ];
}
