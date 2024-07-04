<?php

use App\Http\Middleware\HasTahun;
use App\Livewire\Belanja\ImportData;
use App\Livewire\Referensi\Akun\AkunList;
use App\Livewire\Referensi\BidangUrusan\BidangUrusanList;
use App\Livewire\Referensi\ProgramKegiatan\ProgramList;
use App\Livewire\Skpd\SkpdList;
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

    require __DIR__ . '/groups/penganggaran.php';

    Route::prefix('belanja')->name('belanja.')->group(function () {
        Route::get('/upload', ImportData::class)->name('upload');
    });

    Route::prefix('ref')->name('ref.')->group(function () {

        require __DIR__ . '/groups/ref/sumber-dana.php';

        Route::prefix('skpd')->name('skpd.')->group(function () {
            Route::get('/list', SkpdList::class)->name('list');
        });

        Route::prefix('akun')->name('akun.')->group(function () {
            Route::get('/list', AkunList::class)->name('list');
        });

        Route::prefix('bidang-urusan')->name('bidang-urusan.')->group(function () {
            Route::get('/list', BidangUrusanList::class)->name('list');
        });

        Route::prefix('program')->name('program.')->group(function () {
            Route::get('/list', ProgramList::class)->name('list');
        });
    });
});
