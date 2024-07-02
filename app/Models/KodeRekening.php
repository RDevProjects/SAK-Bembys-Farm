<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeRekening extends Model
{
    use HasFactory;

    protected $table = 'kode_rekening';
    protected $fillable = [
        'kode_rekening',
        'nama_rekening',
        'kelompok_rekening',
        'tipe_rekening',
        'saldo_awal',
    ];
}
