<?php

use App\Livewire\Referensi\SumberDana\SumberDanaList;
use Illuminate\Support\Facades\Route;

Route::get('sumber-danas', SumberDanaList::class)->name('sumber-dana.list');

Route::prefix('sumber-dana')->name('sumber-dana.')->group(function () {
});
