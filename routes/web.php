<?php

use App\Http\Controllers\Admin\MenfessController as AdminMenfessController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenfessController;
use App\Http\Controllers\MenfessLikeController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // COMMUNITY FEED
    Route::get('/home', [HomeController::class, 'index'])
        ->name('community.home');

    // CREATE MENFESS
    Route::view('/menfess/create', 'menfesses.create')
        ->name('menfesses.create');

    Route::post('/menfess', [MenfessController::class, 'store'])
        ->name('menfesses.store');

    // MY MENFESS
    Route::get('/my-menfesses', [MenfessController::class, 'myMenfesses'])
        ->name('menfesses.my');

    // LIKE MENFESS
    Route::post('/menfess/{menfess}/like', [MenfessLikeController::class, 'toggle'])
        ->name('menfesses.like');

    // NOTIFICATIONS
    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');

    Route::patch('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])
        ->name('notifications.read');

    Route::patch('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])
        ->name('notifications.read-all');

    // ADMIN SUARAQ
    Route::prefix('admin')
        ->name('admin.')
        ->middleware('admin')
        ->group(function () {

            // MODERASI MENFESS
            Route::get('/menfesses', [AdminMenfessController::class, 'index'])
                ->name('menfesses.index');

            Route::patch('/menfesses/{menfess}/approve', [AdminMenfessController::class, 'approve'])
                ->name('menfesses.approve');

            Route::patch('/menfesses/{menfess}/reject', [AdminMenfessController::class, 'reject'])
                ->name('menfesses.reject');

            Route::delete('/menfesses/{menfess}', [AdminMenfessController::class, 'destroy'])
                ->name('menfesses.destroy');

            // MANAJEMEN PENGGUNA
            Route::get('/users', [UserController::class, 'index'])
                ->name('users.index');

            Route::delete('/users/{user}', [UserController::class, 'destroy'])
                ->name('users.destroy');
        });
});
