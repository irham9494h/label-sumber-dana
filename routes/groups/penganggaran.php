<?php

use App\Livewire\Penganggaran\JadwalPenganggaranForm;
use App\Livewire\Penganggaran\JadwalPenganggaranList;
use Illuminate\Support\Facades\Route;

Route::prefix('penganggaran')->name('penganggaran.')->group(function () {
    Route::get('jadwals', JadwalPenganggaranList::class)->name('jadwal.list');
    Route::get('jadwal/form/{id?}', JadwalPenganggaranForm::class)->name('jadwal.form');
});
