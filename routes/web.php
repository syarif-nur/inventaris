<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\MutasiKeluarController;
use App\Http\Controllers\MutasiMasukController;
use App\Http\Controllers\PerpindahanInventarisController;
use App\Livewire\Barang;
use App\Livewire\MutasiMasukCrud;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('global', [GlobalController::class, "index"]);


Route::get('/barangs', Barang::class)->name('barangs');
Route::get('/mutasi-masuk', MutasiMasukCrud::class)->name('mutasi-masuk');
