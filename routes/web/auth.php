<?php

use App\Http\Controllers\Auth\AdminOtpAuthController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

// Routes pour l'authentification des administrateurs (OTP)
Route::prefix('admin')->name('admin.')->middleware('guest:admin')->group(function () {
    Route::get('login', [AdminOtpAuthController::class, 'showRequestForm'])->name('login');
    Route::post('login/send-otp', [AdminOtpAuthController::class, 'sendOtp'])->name('login.send-otp');
    Route::get('login/verify', [AdminOtpAuthController::class, 'showVerifyForm'])->name('login.verify');
    Route::post('login/verify-otp', [AdminOtpAuthController::class, 'verifyOtp'])->name('login.verify-otp');
});

Route::middleware('auth:admin')->group(function () {
    Route::post('admin/logout', [AdminOtpAuthController::class, 'logout'])->name('admin.logout');
    
    // Route pour Filament
    Route::post('admin/auth/logout', [AdminOtpAuthController::class, 'logout'])->name('filament.admin.auth.logout');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
