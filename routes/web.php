<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\FormationsController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Auth\OtpAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventPaymentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AudienceController;
use App\Http\Controllers\ConfigController;

// Pages principales
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/visitez-le-campus', [CampusController::class, 'index'])->name('visitez-le-campus');
Route::get('/evenements', [EventController::class, 'index'])->name('evenements');
Route::get('/actualites', [NewsController::class, 'index'])->name('actualites');
Route::post('/language', [LanguageController::class, 'switchLang'])->name('language.switch');


// Footer Routes
Route::get('/mentions-legales', function () {
    return view('pages.legal');
})->name('mentions-legales');

Route::get('/politique-de-confidentialite', function () {
    return view('pages.privacy');
})->name('privacy');

Route::get('/faq', function () {
    return view('pages.faq');
})->name('faq');

Route::get('/conditions-utilisation', function () {
    return view('pages.terms');
})->name('terms');

// Newsletter Subscription
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Campus Visit Booking
Route::post('/campus/book-visit', [CampusController::class, 'bookVisit'])->name('campus.book-visit');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [OtpAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login/send-otp', [OtpAuthController::class, 'sendOtp'])->name('login.send-otp');
    Route::post('/login/verify-otp', [OtpAuthController::class, 'verifyOtp'])->name('login.verify-otp');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [OtpAuthController::class, 'logout'])->name('logout');
});

// Dashboard Routes
Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Événements
    Route::resource('events', EventController::class);
    Route::post('events/{registration}/payment', [EventPaymentController::class, 'initiate'])->name('events.payment.initiate');
    
    // Articles
    Route::resource('articles', ArticleController::class);
    
    // Réservations
    Route::get('bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::delete('bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    
    // Audiences
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
});

// Event Payment Routes
Route::get('/events/payment/callback', [EventPaymentController::class, 'callback'])->name('events.payment.callback');
Route::post('/events/payment/webhook', [EventPaymentController::class, 'webhook'])->name('events.payment.webhook');
