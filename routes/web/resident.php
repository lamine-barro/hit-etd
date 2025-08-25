<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\Resident\DashboardController;
use App\Http\Controllers\Resident\EspaceOrderController;
use App\Http\Controllers\Resident\EventController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Resident Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('resident')->name('resident.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Gestion du profil
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::put('/profile', [DashboardController::class, 'updateProfile'])->name('profile.update');
    
    // Réservations d'espaces
    Route::prefix('espaces')->name('espaces.')->group(function () {
        Route::get('/', [EspaceOrderController::class, 'index'])->name('index');
        Route::get('/create', [EspaceOrderController::class, 'create'])->name('create');
        Route::post('/', [EspaceOrderController::class, 'store'])->name('store');
        Route::get('/{order}', [EspaceOrderController::class, 'show'])->name('show');
        Route::delete('/{order}', [EspaceOrderController::class, 'destroy'])->name('destroy');
    });
    
    // Événements
    Route::prefix('events')->name('events.')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('index');
        Route::get('/{event}', [EventController::class, 'show'])->name('show');
        Route::post('/{event}/register', [EventController::class, 'register'])->name('register');
        Route::delete('/registration/{registration}', [EventController::class, 'cancelRegistration'])->name('cancel');
    });
    
    // Système de réservation (legacy)
    Route::get('/reservations', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/reservations', [BookingController::class, 'store'])->name('bookings.store');
    Route::delete('/reservations/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
});
