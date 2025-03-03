<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MetricsController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard-main.index');
    })->name('dashboard');

    Route::get('/metrics', [MetricsController::class, 'index'])->name('metrics');

    Route::get('/data', function () {
        return view('data');
    })->name('data');

    Route::get('/user', function () {
        return view('user');
    })->name('user');

    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');

    Route::get('/help', function () {
        return view('help');
    })->name('help');

    Route::get('/notifications', function () {
        return view('notifications');
    })->name('notifications');

    Route::get('/metrics/create', [MetricsController::class, 'create'])->name('metrics.create');

    Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    });
});

require __DIR__.'/auth.php';
