<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group.
|
*/

// Routes publiques/visiteurs
require __DIR__.'/web/guest.php';

// Routes d'authentification
require __DIR__.'/web/auth.php';

// Routes pour l'authentification OTP des administrateurs
use App\Http\Controllers\Auth\AdminOtpAuthController;

// Routes avec des noms différents pour éviter les conflits avec Filament
Route::name('admin.otp.')->group(function () {
    Route::get('admin/otp-login', [AdminOtpAuthController::class, 'showRequestForm'])->name('login');
    Route::post('admin/otp-login/send', [AdminOtpAuthController::class, 'sendOtp'])->name('send');
    Route::get('admin/otp-login/verify', [AdminOtpAuthController::class, 'showVerifyForm'])->name('verify');
    Route::post('admin/otp-login/verify', [AdminOtpAuthController::class, 'verifyOtp'])->name('verify.submit');
});

Route::middleware('auth:admin')->group(function () {
    Route::post('admin/otp-logout', [AdminOtpAuthController::class, 'logout'])->name('admin.otp.logout');
});

// Routes pour l'authentification OTP des résidents
use App\Http\Controllers\Auth\ResidentOtpAuthController;

Route::name('resident.otp.')->group(function () {
    Route::get('resident/otp-login', [ResidentOtpAuthController::class, 'showRequestForm'])->name('login');
    Route::post('resident/otp-login/send', [ResidentOtpAuthController::class, 'sendOtp'])->name('send');
    Route::get('resident/otp-login/verify', [ResidentOtpAuthController::class, 'showVerifyForm'])->name('verify');
    Route::post('resident/otp-login/verify', [ResidentOtpAuthController::class, 'verifyOtp'])->name('verify.submit');
});

Route::middleware('auth')->group(function () {
    Route::post('resident/otp-logout', [ResidentOtpAuthController::class, 'logout'])->name('resident.otp.logout');
});

// Routes des résidents
require __DIR__.'/web/resident.php';
