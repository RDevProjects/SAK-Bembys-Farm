<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeRekening extends Model
{
    use HasFactory;

    protected $table = 'kode_rekening';
    protected $fillable = [
        'kode_rek',
        'nama_rek',
        'kelompok_rek',
        'tipe_rek',
        'saldo_awal',
    ];
}
