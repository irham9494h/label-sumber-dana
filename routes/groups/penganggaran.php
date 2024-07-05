<?php

use App\Livewire\Penganggaran\JadwalPenganggaranForm;
use App\Livewire\Penganggaran\JadwalPenganggaranList;
use App\Livewire\Penganggaran\SubKegiatanBelanja\SubKegiatanBelanjaList;
use Illuminate\Support\Facades\Route;

Route::prefix('penganggaran')->name('penganggaran.')->group(function () {
    Route::get('jadwals', JadwalPenganggaranList::class)->name('jadwal.list');
    Route::get('jadwal/form/{id?}', JadwalPenganggaranForm::class)->name('jadwal.form');

    Route::get('sub-kegiatan-belanja', SubKegiatanBelanjaList::class)->name('sub-kegiatan-belanja.list');
    Route::get('sub-kegiatan-belanja/{skpdId]/skpd', SubKegiatanBelanjaList::class)->name('sub-kegiatan-belanja.list');
});
