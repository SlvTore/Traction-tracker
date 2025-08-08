<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MetricsController;
use App\Http\Controllers\MetricRecordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SetupWizardController;
use App\Http\Controllers\BusinessController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Setup wizard routes
Route::get('/wizard', [SetupWizardController::class, 'show'])->name('wizard.show');
Route::post('/wizard', [SetupWizardController::class, 'store'])->name('wizard.store');
Route::post('/wizard/validate-business', [SetupWizardController::class, 'validateBusinessAccess'])->name('wizard.validate-business');

Route::middleware(['auth'])->group(function () {
    
    // Dashboard routes with role-based access
    Route::middleware(['check.role:business-owner,administrator,staff'])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard-main.index');
        })->name('dashboard');

        Route::get('/dashboard/edit', function () {
            return view('dashboard-main.edit');
        })->name('dashboard.edit');
    });

    // Metrics routes - Business Owner, Administrator, and Staff can access
    Route::middleware(['check.role:business-owner,administrator,staff'])->group(function () {
        Route::get('/metrics', [MetricsController::class, 'index'])->name('metrics');
        Route::get('/metrics/create', [MetricsController::class, 'create'])->name('metrics.create');
        Route::post('/metrics', [MetricsController::class, 'store'])->name('metrics.store');
        Route::post('/metrics/favorite/{index}', [MetricsController::class, 'toggleFavorite'])->name('metrics.toggleFavorite');
        Route::get('metrics/{index}/edit', [MetricsController::class, 'edit'])->name('metrics.edit');
        Route::put('metrics/{index}', [MetricsController::class, 'update'])->name('metrics.update');
        
        // Import and delete - only Business Owner and Administrator
        Route::middleware(['check.role:business-owner,administrator'])->group(function () {
            Route::delete('metrics/{id}', [MetricsController::class, 'destroy'])->name('metrics.destroy');
        });

        Route::get('metrics/{metric}/records', [MetricRecordController::class, 'getRecords'])->name('metric-records.getRecords');
        Route::get('/metrics/{metricId}/total-value', [MetricRecordController::class, 'getTotalValue']);
        Route::get('/metrics/{metricId}/change', [MetricRecordController::class, 'getChange']);
        Route::post('metrics/{metric}/records', [MetricRecordController::class, 'store'])->name('metric-records.store');
        Route::put('metric-records/{record}', [MetricRecordController::class, 'update'])->name('metric-records.update');
        Route::delete('metric-records/{record}', [MetricRecordController::class, 'destroy'])->name('metric-records.destroy');
    });

    // User management routes - only Business Owner and Administrator
    Route::middleware(['check.role:business-owner,administrator'])->group(function () {
        Route::get('/dashboard-user', [UserController::class, 'index'])->name('user.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::post('/users/{user}/promote', [UserController::class, 'promote'])->name('users.promote');
    });

    // Business management routes - only Business Owner
    Route::middleware(['check.role:business-owner'])->group(function () {
        Route::post('/business/regenerate-code', [BusinessController::class, 'regenerateCode'])->name('business.regenerate-code');
    });

    // Business Investigator routes - view-only access to dashboard and metrics
    Route::middleware(['check.role:business-investigator'])->group(function () {
        Route::get('/dashboard/summary', function () {
            return view('dashboard-main.summary');
        })->name('dashboard.summary');
        
        Route::get('/metrics/view', [MetricsController::class, 'viewOnly'])->name('metrics.view');
    });

    // Profile and general routes - all authenticated users
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

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
});

require __DIR__.'/auth.php';
