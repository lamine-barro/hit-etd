<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        } else {
            // Détecte la langue du navigateur
            $locale = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);

            // Vérifie si la langue est supportée
            if (in_array($locale, ['fr', 'en'])) {
                App::setLocale($locale);
                Session::put('locale', $locale);
            } else {
                App::setLocale('fr'); // Langue par défaut
                Session::put('locale', 'fr');
            }
        }

        return $next($request);
    }
}
