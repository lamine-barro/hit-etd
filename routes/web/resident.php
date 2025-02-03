<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

/*
|--------------------------------------------------------------------------
| Resident Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('resident')->name('resident.')->group(function () {
    // Système de réservation
    Route::get('/reservations', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/reservations', [BookingController::class, 'store'])->name('bookings.store');
    Route::delete('/reservations/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
}); 