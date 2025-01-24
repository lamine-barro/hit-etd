<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\CampusController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/presentation', [AboutController::class, 'index'])->name('about');
Route::get('/actualites', [NewsController::class, 'index'])->name('news');
Route::get('/services', [ServicesController::class, 'index'])->name('services');
Route::get('/visite-campus', [VisitController::class, 'index'])->name('visit');

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

Route::post('/campus/book-visit', [CampusController::class, 'bookVisit'])->name('campus.book-visit');
