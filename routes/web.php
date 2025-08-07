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

    // Dashboard-feeds routes
    Route::get('/dashboard-feeds', function () {
        return view('dashboard-feeds.index');
    })->name('dashboard.feeds');

    // Dashboard-users routes with CRUD operations
    Route::get('/dashboard-users', [UserController::class, 'index'])->name('dashboard.users');
    Route::get('/dashboard-users/create', [UserController::class, 'create'])->name('dashboard.users.create');
    Route::post('/dashboard-users', [UserController::class, 'store'])->name('dashboard.users.store');
    Route::get('/dashboard-users/{user}/edit', [UserController::class, 'edit'])->name('dashboard.users.edit');
    Route::put('/dashboard-users/{user}', [UserController::class, 'update'])->name('dashboard.users.update');
    Route::delete('/dashboard-users/{user}', [UserController::class, 'destroy'])->name('dashboard.users.destroy');

    // Legacy routes (keeping for backward compatibility)
    Route::get('/dashboard-user', [UserController::class, 'index'])->name('user.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users', [UserController::class, 'index'])->name('user.index');




    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');

    Route::get('/help', function () {
        return view('dashboard-helps.index');
    })->name('helpIndex');

    Route::get('/help/faq', function () {
        return view('dashboard-helps.faq');
    })->name('helpFaq');

    Route::get('/help/features', function () {
        return view('dashboard-helps.features');
    })->name('helpFeatures');

    Route::get('/help/collaboration', function () {
        return view('dashboard-helps.collabs');
    })->name('helpCollabs');



    Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    });
});

require __DIR__.'/auth.php';
