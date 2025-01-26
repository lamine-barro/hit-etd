<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function switchLang(Request $request)
    {
        $locale = $request->input('lang', 'fr');
        
        if (!in_array($locale, ['en', 'fr'])) {
            $locale = 'fr';
        }

        // Définir la locale dans la session
        Session::put('locale', $locale);
        
        // Forcer la persistance de la session
        Session::save();
        
        // Définir la locale pour l'application
        App::setLocale($locale);

        return back()->withCookie(cookie()->forever('locale', $locale));
    }
} 