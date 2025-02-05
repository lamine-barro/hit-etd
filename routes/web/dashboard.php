<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AudienceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NewsletterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('dashboard')->group(function () {
    // Dashboard Home
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Événements
    Route::resource('evenements', EventController::class);

    // Articles
    Route::resource('articles', ArticleController::class);

    // Réservations
    Route::get('bookings', [DashboardController::class, 'bookings'])->name('bookings.index');
    Route::delete('bookings/{booking}', [DashboardController::class, 'destroyBooking'])->name('bookings.destroy');

    // Audiences et Newsletter
    Route::prefix('audiences')->name('audiences.')->group(function () {
        Route::get('/', [AudienceController::class, 'index'])->name('index');
        Route::post('/', [AudienceController::class, 'store'])->name('store');
        Route::put('/{audience}', [AudienceController::class, 'update'])->name('update');
        Route::delete('/{audience}', [AudienceController::class, 'destroy'])->name('destroy');

        // Newsletter subscribers
        Route::get('/subscribers', [NewsletterController::class, 'index'])->name('subscribers.index');
        Route::put('/subscribers/{subscriber}', [NewsletterController::class, 'update'])->name('subscribers.update');
        Route::delete('/subscribers/{subscriber}', [NewsletterController::class, 'destroy'])->name('subscribers.destroy');
        Route::post('/subscribers/export', [NewsletterController::class, 'export'])->name('subscribers.export');
    });

    // Configuration
    Route::get('config', [DashboardController::class, 'config'])->name('config.index');
    Route::post('config', [DashboardController::class, 'updateConfig'])->name('config.update');
});
