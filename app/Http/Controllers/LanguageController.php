<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switchLang(Request $request, $lang)
    {
        // Vérifie si la langue est supportée
        if (in_array($lang, ['fr', 'en'])) {
            $request->session()->put('locale', $lang);
        }

        return redirect()->back();
    }
}
