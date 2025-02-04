<?php

use App\Http\Controllers\ArticleListController;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\EventListController;
use App\Http\Controllers\EventPaymentController;
use App\Http\Controllers\EventRegistrationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\NewsletterController;
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
    Route::get('/', [EventListController::class, 'index'])->name('evenements');
    Route::get('/{event:slug}', [EventListController::class, 'show'])->name('evenements.show');
    Route::post('/{event}/register', [EventRegistrationController::class, 'store'])->name('event.register');
    Route::post('/registrations/{registration}/cancel', [EventRegistrationController::class, 'cancel'])->name('event.registration.cancel');
});

// Actualités
Route::prefix('actualites')->group(function () {
    Route::get('/', [ArticleListController::class, 'index'])->name('actualites');
    Route::get('/{article:slug}', [ArticleListController::class, 'show'])->name('actualites.show');
});

// Paiements
Route::prefix('payment')->group(function () {
    Route::get('/callback', [EventPaymentController::class, 'callback'])->name('events.payment.callback');
});

// Newsletter
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Campus Visit Booking
Route::post('/campus/book-visit', [CampusController::class, 'bookVisit'])->name('campus.book-visit');

// Language Switch
Route::get('language/{lang}', [LanguageController::class, 'switchLang'])->name('language.switch');

// Pages statiques
Route::view('/devenir-donateur', 'pages.become-donor')->name('devenir-donateur');
Route::view('/mentions-legales', 'pages.legal')->name('mentions-legales');
Route::view('/politique-de-confidentialite', 'pages.privacy')->name('privacy');
Route::view('/faq', 'pages.faq')->name('faq');
Route::view('/conditions-utilisation', 'pages.terms')->name('terms');
Route::view('/espace-membre', 'pages.member-space')->name('member-space');
