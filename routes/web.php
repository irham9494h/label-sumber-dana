<?php

use App\Http\Middleware\HasTahun;
use App\Livewire\Skpd\TabelSkpd;
use App\Livewire\SumberDana\ImportData;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return to_route('dashboard');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified', HasTahun::class])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';

Volt::route('tahun/pilih-tahun', 'tahun.pilih-tahun')->middleware(['auth', 'verified'])->name('tahun.pilih-tahun');

Route::middleware(['auth', 'verified', HasTahun::class])->group(function () {

    Route::prefix('jadwal/penganggaran')->name('jadwal-penganggaran.')->group(function () {
        Volt::route('/list', 'jadwal/penganggaran/tabel-jadwal-penganggaran')->name('list');
        Volt::route('/form', 'jadwal/penganggaran/form-jadwal-penganggaran')->name('form');
    });

    Route::prefix('sumber-dana')->name('sumber-dana.')->group(function () {
        Route::get('/upload', ImportData::class)->name('upload');
    });

    Route::prefix('skpd')->name('skpd.')->group(function () {
        Route::get('/list', TabelSkpd::class)->name('list');
    });
});
