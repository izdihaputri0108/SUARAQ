<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenfessController;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    // Halaman Create Menfess
    Route::view('/menfess/create', 'menfesses.create')
        ->name('menfesses.create');

    // Proses menyimpan Menfess
    Route::post('/menfess', [MenfessController::class, 'store'])
        ->name('menfesses.store');

});

require __DIR__.'/settings.php';
