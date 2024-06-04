<?php

use App\Http\Middleware\HasTahun;
use Illuminate\Support\Facades\Route;

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
