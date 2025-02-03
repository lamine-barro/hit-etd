<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

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