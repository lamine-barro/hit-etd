<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\OtpAuthController;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [OtpAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login/send-otp', [OtpAuthController::class, 'sendOtp'])->name('login.send-otp');
    Route::post('/login/verify-otp', [OtpAuthController::class, 'verifyOtp'])->name('login.verify-otp');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [OtpAuthController::class, 'logout'])->name('logout');
}); 