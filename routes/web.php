<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard-main.index');
    })->name('dashboard');

    Route::get('/metrics', function () {
        return view('dashboard-metrics.index');
    })->name('metrics');

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
