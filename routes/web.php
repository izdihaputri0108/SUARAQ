<?php

use App\Http\Controllers\Admin\MenfessController as AdminMenfessController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenfessController;
use App\Http\Controllers\MenfessLikeController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::get('/home', [HomeController::class, 'index'])
        ->name('community.home');

    Route::view('/menfess/create', 'menfesses.create')
        ->name('menfesses.create');

    Route::post('/menfess', [MenfessController::class, 'store'])
        ->name('menfesses.store');

    // LIKE MENFESS
    Route::post('/menfess/{menfess}/like', [MenfessLikeController::class, 'toggle'])
        ->name('menfesses.like');

    // ADMIN SUARAQ
    Route::prefix('admin')
        ->name('admin.')
        ->middleware('admin')
        ->group(function () {

            // Moderasi Menfess
            Route::get('/menfesses', [AdminMenfessController::class, 'index'])
                ->name('menfesses.index');

            Route::patch('/menfesses/{menfess}/approve', [AdminMenfessController::class, 'approve'])
                ->name('menfesses.approve');

            Route::patch('/menfesses/{menfess}/reject', [AdminMenfessController::class, 'reject'])
                ->name('menfesses.reject');

            Route::delete('/menfesses/{menfess}', [AdminMenfessController::class, 'destroy'])
                ->name('menfesses.destroy');

            // Manajemen Pengguna
            Route::get('/users', [UserController::class, 'index'])
                ->name('users.index');

            Route::delete('/users/{user}', [UserController::class, 'destroy'])
                ->name('users.destroy');
        });
});

require __DIR__.'/settings.php';
