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

// Routes d'administration native (remplace Filament)
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EspaceController;
use App\Http\Controllers\Admin\PartnershipController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ExpertController;

Route::prefix('admin')->name('admin.')->middleware('admin.auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Routes Espaces
    Route::resource('espaces', EspaceController::class);
    Route::post('espaces/{espace}/publish', [EspaceController::class, 'publish'])->name('espaces.publish');
    Route::post('espaces/{espace}/unpublish', [EspaceController::class, 'unpublish'])->name('espaces.unpublish');
    
    // Routes Partenariats
    Route::resource('partnerships', PartnershipController::class);
    Route::post('partnerships/{partnership}/approve', [PartnershipController::class, 'approve'])->name('partnerships.approve');
    Route::post('partnerships/{partnership}/reject', [PartnershipController::class, 'reject'])->name('partnerships.reject');
    
    // Routes Articles
    Route::resource('articles', ArticleController::class);
    
    // Routes Événements
    Route::resource('events', EventController::class);
    
    // Routes Demandes de visite (Bookings)
    Route::resource('bookings', BookingController::class);
    Route::post('bookings/{booking}/approve', [BookingController::class, 'approve'])->name('bookings.approve');
    Route::post('bookings/{booking}/reject', [BookingController::class, 'reject'])->name('bookings.reject');
    
    // Routes Utilisateurs
    Route::resource('users', UserController::class);
    Route::post('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    
    // Routes Experts
    Route::resource('experts', ExpertController::class);
    Route::post('experts/{expert}/approve', [ExpertController::class, 'approve'])->name('experts.approve');
    Route::post('experts/{expert}/reject', [ExpertController::class, 'reject'])->name('experts.reject');
});
