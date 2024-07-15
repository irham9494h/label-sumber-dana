<?php

use App\Livewire\Penganggaran\JadwalPenganggaranForm;
use App\Livewire\Penganggaran\JadwalPenganggaranList;
use App\Livewire\Penganggaran\SubKegiatanBelanja\SubKegiatanBelanjaOverview;
use App\Livewire\Penganggaran\SubKegiatanBelanja\SubKegiatanBelanjaSkpd;
use Illuminate\Support\Facades\Route;

Route::prefix('penganggaran')->name('penganggaran.')->group(function () {
    Route::get('jadwals', JadwalPenganggaranList::class)->name('jadwal.list');
    Route::get('jadwal/form/{id?}', JadwalPenganggaranForm::class)->name('jadwal.form');

    Route::get('sub-kegiatan-belanja/overview', SubKegiatanBelanjaOverview::class)->name('sub-kegiatan-belanja.overview');
    Route::get('sub-kegiatan-belanja/{skpdId}/skpd', SubKegiatanBelanjaSkpd::class)->name('sub-kegiatan-belanja.skpd');
});
