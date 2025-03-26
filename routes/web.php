<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MetricsController;
use App\Http\Controllers\MetricRecordController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard-main.index');
    })->name('dashboard');

    Route::get('/dashboard/edit', function () {
        return view('dashboard-main.edit');
    })->name('dashboard.edit');

    Route::get('/metrics', [MetricsController::class, 'index'])->name('metrics');
    Route::get('/metrics/create', [MetricsController::class, 'create'])->name('metrics.create');
    Route::post('/metrics', [MetricsController::class, 'store'])->name('metrics.store');
    Route::post('/metrics/favorite/{index}', [MetricsController::class, 'toggleFavorite'])->name('metrics.toggleFavorite');
    Route::get('metrics/{index}/edit', [MetricsController::class, 'edit'])->name('metrics.edit');
    Route::put('metrics/{index}', [MetricsController::class, 'update'])->name('metrics.update');
    Route::delete('metrics/{id}', [MetricsController::class, 'destroy'])->name('metrics.destroy');

    Route::get('metrics/{metric}/records', [MetricRecordController::class, 'getRecords'])->name('metric-records.getRecords');
    Route::get('/metrics/{metricId}/total-value', [MetricRecordController::class, 'getTotalValue']);
    Route::get('/metrics/{metricId}/change', [MetricRecordController::class, 'getChange']);
    Route::post('metrics/{metric}/records', [MetricRecordController::class, 'store'])->name('metric-records.store');
    Route::put('metric-records/{record}', [MetricRecordController::class, 'update'])->name('metric-records.update');
    Route::delete('metric-records/{record}', [MetricRecordController::class, 'destroy'])->name('metric-records.destroy');

    Route::get('/dashboard-user', [UserController::class, 'index'])->name('user.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');

    Route::get('/dashboard-user', [UserController::class, 'index'])->name('user.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users', [UserController::class, 'index'])->name('user.index');



    Route::get('/user', function () {
        return view('dashboard-user.index');
    })->name('user');

    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');

    Route::get('/help', function () {
        return view('dashboard-helps.index');
    })->name('helpCenter');

    Route::get('/help/FAQ', function () {
        return view('dashboard-helps.faq');
    })->name('helpFaq');

    Route::get('/help/Features', function () {
        return view('dashboard-helps.features');
    })->name('helpFeatures');

    Route::get('/help/Collaboration', function () {
        return view('dashboard-helps.collabs');
    })->name('helpCollabs');

    Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    });
});

require __DIR__.'/auth.php';
