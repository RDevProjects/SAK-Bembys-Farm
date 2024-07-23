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
Route::get('/data-rekening/edit/{id}', [KodeRekeningController::class, 'edit'])->name('data-rekening.edit');
Route::put('/data-rekening/update/{id}', [KodeRekeningController::class, 'update'])->name('data-rekening.update');

Route::get('/entry-jurnal', [TransaksiKeuanganController::class, 'index'])->name('entry-jurnal');
Route::get('/entry-jurnal/get', [TransaksiKeuanganController::class, 'getTransaksiKeuangan'])->name('entry-jurnal.get');
Route::post('/entry-jurnal/store', [TransaksiKeuanganController::class, 'store'])->name('entry-jurnal.store');
Route::get('/entry-jurnal/edit/{id}', [TransaksiKeuanganController::class, 'edit'])->name('entry-jurnal.edit');
Route::put('/entry-jurnal/update/{id}', [TransaksiKeuanganController::class, 'update'])->name('entry-jurnal.update');
Route::get('/entry-jurnal/delete/{id_jurnal}/{no_akun}', [TransaksiKeuanganController::class, 'destroy'])->name('entry-jurnal.delete');

Route::get('/entry-unit', [UnitController::class, 'index'])->name('entry-jurnal.showNamaUnit');
Route::get('/entry-unit/getNamaUnit', [UnitController::class, 'getNamaUnit'])->name('entry-jurnal.getNamaUnit');
Route::post('/entry-unit/storeNamaUnit', [UnitController::class, 'store'])->name('entry-jurnal.storeNamaUnit');
Route::get('/entry-unit/edit/{id}', [UnitController::class, 'edit'])->name('entry-jurnal.editNamaUnit');
Route::put('/entry-unit/update/{id}', [UnitController::class, 'update'])->name('entry-jurnal.updateNamaUnit');

Route::get('/tutup-buku', [LaporanController::class, 'penutupanAkuntansi'])->name('tutup-buku');
Route::post('/penutupan-akuntansi', [LaporanController::class, 'prosesPenutupanAkuntansi'])->name('penutupan-akuntansi');

Route::get('/tampil-jurnal', [TransaksiKeuanganController::class, 'tampilJurnal'])->name('tampil-jurnal');

// Laporan
Route::get('/laporan-jurnal-umum', [LaporanController::class, 'indexJurnalUmum'])->name('laporan-jurnal-umum');
Route::get('/laporan-jurnal-umum/get', [LaporanController::class, 'getDataJurnalUmum'])->name('laporan-jurnal-umum.get');

Route::get('/buku-besar', [LaporanController::class, 'indexBukuBesar'])->name('buku-besar');
Route::post('/laporan-buku-besar', [LaporanController::class, 'getDataBukuBesar'])->name('laporan-buku-besar');

Route::get('/laporan-neraca-saldo', [LaporanController::class, 'indexNeracaSaldo'])->name('laporan-neraca-saldo');

Route::get('/laporan-laba-rugi', [LaporanController::class, 'indexLabaRugi'])->name('laporan-laba-rugi');

Route::get('/laporan-perubahan-modal', [LaporanController::class, 'indexPerubahanModal'])->name('laporan-perubahan-modal');

Route::get('/laporan-neraca', [LaporanController::class, 'indexNeraca'])->name('laporan-neraca');

Route::get('/laporan-arus-kas', [LaporanController::class, 'indexArusKas'])->name('laporan-arus-kas');

Route::get('/laporan-jurnal-penutup', [LaporanController::class, 'indexJurnalPenutup'])->name('laporan-jurnal-penutup');

Route::get('/laporan-neraca-saldo-penutup', [LaporanController::class, 'indexNeracaSaldoPenutup'])->name('laporan-neraca-saldo-penutup');
