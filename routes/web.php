<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KodeRekeningController;
use App\Http\Controllers\TransaksiKeuanganController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/data-rekening', [KodeRekeningController::class, 'index'])->name('data-rekening');
Route::get('/data-rekening/get', [KodeRekeningController::class, 'GetDataRekening'])->name('data-rekening.get');
Route::post('/data-rekening/store', [KodeRekeningController::class, 'store'])->name('data-rekening.store');

Route::get('/entry-jurnal', [TransaksiKeuanganController::class, 'index'])->name('entry-jurnal');
Route::get('/entry-jurnal/get', [TransaksiKeuanganController::class, 'getTransaksiKeuangan'])->name('entry-jurnal.get');
Route::post('/entry-jurnal/store', [TransaksiKeuanganController::class, 'store'])->name('entry-jurnal.store');

Route::get('/entry-jurnal/showNamaUnit', [TransaksiKeuanganController::class, 'showNamaUnit'])->name('entry-jurnal.showNamaUnit');
Route::get('/entry-jurnal/getNamaUnit', [TransaksiKeuanganController::class, 'getNamaUnit'])->name('entry-jurnal.getNamaUnit');
Route::post('/entry-jurnal/storeNamaUnit', [TransaksiKeuanganController::class, 'storeNamaUnit'])->name('entry-jurnal.storeNamaUnit');

Route::get('/tampil-jurnal', [TransaksiKeuanganController::class, 'tampilJurnal'])->name('tampil-jurnal');
