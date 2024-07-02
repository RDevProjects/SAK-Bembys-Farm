<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KodeRekeningController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/data-rekening', [KodeRekeningController::class, 'index'])->name('data-rekening');
Route::get('/data-rekening/get', [KodeRekeningController::class, 'GetDataRekening'])->name('data-rekening.get');
Route::post('/data-rekening/store', [KodeRekeningController::class, 'store'])->name('data-rekening.store');
