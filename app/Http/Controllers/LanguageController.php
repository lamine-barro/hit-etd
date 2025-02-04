<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switchLang($lang)
    {
        // Vérifie si la langue est supportée
        if (in_array($lang, ['fr', 'en'])) {
            Session::put('locale', $lang);
        }

        return redirect()->back();
    }
}
