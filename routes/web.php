<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MetricsController;
use App\Http\Controllers\MetricRecordController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard-main.index');
    })->name('dashboard');

    Route::get('/metrics', [MetricsController::class, 'index'])->name('metrics');
    Route::get('/metrics/create', [MetricsController::class, 'create'])->name('metrics.create');
    Route::post('/metrics', [MetricsController::class, 'store'])->name('metrics.store');
    Route::post('/metrics/favorite/{index}', [MetricsController::class, 'toggleFavorite'])->name('metrics.toggleFavorite');
    Route::get('metrics/{index}/edit', [MetricsController::class, 'edit'])->name('metrics.edit');
    Route::put('metrics/{index}', [MetricsController::class, 'update'])->name('metrics.update');
    Route::delete('metrics/{id}', [MetricsController::class, 'destroy'])->name('metrics.destroy');

    Route::post('metrics/{metric}/records', [MetricRecordController::class, 'store'])->name('metric-records.store');
    Route::put('metric-records/{record}', [MetricRecordController::class, 'update'])->name('metric-records.update');
    Route::delete('metric-records/{record}', [MetricRecordController::class, 'destroy'])->name('metric-records.destroy');

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


    Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    });
});

require __DIR__.'/auth.php';
