<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ArticleListController;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\EventListController;
use App\Http\Controllers\EventPaymentController;
use App\Http\Controllers\EventRegistrationController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PartnershipController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Guest/Public Routes
|--------------------------------------------------------------------------
*/

// Pages principales
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/visitez-le-campus', [CampusController::class, 'index'])->name('visitez-le-campus');



// Événements
Route::prefix('evenements')->group(function () {
    Route::get('/', [EventListController::class, 'index'])->name('events');
    Route::get('{slug}', [EventListController::class, 'show'])
        ->name('events.show')->where('slug', '[a-z0-9\-]+');
    Route::post('{slug}/register', [EventRegistrationController::class, 'store'])
        ->name('events.register')->where('slug', '[a-z0-9\-]+');
    Route::post('{registration}/payment', [EventPaymentController::class, 'initiate'])
        ->name('events.payment.initiate');
    Route::post('registration/{registration}/cancel', [EventRegistrationController::class, 'cancel'])
        ->name('events.registration.cancel');
});

// Actualités
Route::prefix('actualites')->group(function () {
    Route::get('/', [ArticleListController::class, 'index'])->name('actualites');
    Route::get('/{slug}', [ArticleListController::class, 'show'])
        ->name('actualites.show')
        ->where('slug', '[a-z0-9\-]+');
});

// Paiements
Route::prefix('payment')->group(function () {
    Route::get('/callback', [EventPaymentController::class, 'callback'])->name('events.payment.callback');
});

// Newsletter
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])
    ->name('newsletter.subscribe');

// Campus Visit Booking
Route::post('/campus/book-visit', [CampusController::class, 'bookVisit'])->name('campus.book-visit');

// Language Switch
Route::get('language/{lang}', [LanguageController::class, 'switchLang'])->name('language.switch');

// Applications (Unified System)
Route::prefix('candidatures')->group(function () {
    Route::get('/', [ApplicationController::class, 'index'])->name('applications');
    Route::post('/resident', [ApplicationController::class, 'storeResident'])->name('applications.resident');
    Route::post('/partenaire', [ApplicationController::class, 'storePartnership'])->name('applications.partnership');
    Route::post('/expert', [ApplicationController::class, 'storeExpert'])->name('applications.expert');
});

// Partenariat (Legacy - keep for backward compatibility)
Route::prefix('partenariat')->group(function () {
    Route::get('/', [PartnershipController::class, 'index'])->name('partnership');
    Route::post('/soumettre', [PartnershipController::class, 'store'])->name('partnership.store');
    Route::get('/merci', [PartnershipController::class, 'thankYou'])->name('partnership.thank-you');
});

// Pages statiques
Route::view('/devenir-donateur', 'pages.static.become-donor')->name('devenir-donateur');
Route::view('/mentions-legales', 'pages.static.legal')->name('mentions-legales');
Route::view('/politique-de-confidentialite', 'pages.static.privacy')->name('privacy');
Route::view('/faq', 'pages.static.faq')->name('faq');
Route::view('/conditions-utilisation', 'pages.static.terms')->name('terms');
Route::view('/espace-membre', 'pages.members.dashboard')->name('member-space');

Route::get('/payment/{registration}', [EventPaymentController::class, 'show'])->name('payment.show');
Route::post('/payment/{registration}/initiate', [EventPaymentController::class, 'initiate'])
    ->name('payment.initiate');

// Paystack Webhook
Route::post('/webhooks/paystack', [EventPaymentController::class, 'webhook'])
    ->name('paystack.webhook')
    ->middleware('paystack.webhook');
