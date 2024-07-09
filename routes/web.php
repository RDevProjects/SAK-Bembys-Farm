<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KodeRekeningController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\TransaksiKeuanganController;
use App\Http\Controllers\UnitController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/test', [LaporanController::class, 'getDataJurnalUmumJson'])->name('test');

Route::get('/data-rekening', [KodeRekeningController::class, 'index'])->name('data-rekening');
Route::get('/data-rekening/get', [KodeRekeningController::class, 'GetDataRekening'])->name('data-rekening.get');
Route::post('/data-rekening/store', [KodeRekeningController::class, 'store'])->name('data-rekening.store');

Route::get('/entry-jurnal', [TransaksiKeuanganController::class, 'index'])->name('entry-jurnal');
Route::get('/entry-jurnal/get', [TransaksiKeuanganController::class, 'getTransaksiKeuangan'])->name('entry-jurnal.get');
Route::post('/entry-jurnal/store', [TransaksiKeuanganController::class, 'store'])->name('entry-jurnal.store');

Route::get('/entry-jurnal/showNamaUnit', [UnitController::class, 'index'])->name('entry-jurnal.showNamaUnit');
Route::get('/entry-jurnal/getNamaUnit', [UnitController::class, 'getNamaUnit'])->name('entry-jurnal.getNamaUnit');
Route::post('/entry-jurnal/storeNamaUnit', [UnitController::class, 'store'])->name('entry-jurnal.storeNamaUnit');

Route::get('/tampil-jurnal', [TransaksiKeuanganController::class, 'tampilJurnal'])->name('tampil-jurnal');

// Laporan
Route::get('/laporan-jurnal-umum', [LaporanController::class, 'indexJurnalUmum'])->name('laporan-jurnal-umum');
Route::get('/laporan-jurnal-umum/get', [LaporanController::class, 'getDataJurnalUmum'])->name('laporan-jurnal-umum.get');

Route::get('/laporan-buku-besar', [LaporanController::class, 'getDataBukuBesar'])->name('laporan-buku-besar');

Route::get('/laporan-neraca-saldo', [LaporanController::class, 'indexNeracaSaldo'])->name('laporan-neraca-saldo');

Route::get('/laporan-laba-rugi', [LaporanController::class, 'indexLabaRugi'])->name('laporan-laba-rugi');
