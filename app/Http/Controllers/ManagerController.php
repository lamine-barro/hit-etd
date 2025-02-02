<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Affiche la page d'accueil
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Vous pourrez ajouter ici la logique pour récupérer les données nécessaires
        // comme les actualités récentes, les partenaires, etc.
        
        return view('pages.home', [
            'pageTitle' => 'Accueil - Hub Ivoire Tech',
            'metaDescription' => 'Le Hub Ivoire Tech est le plus grand Campus de Startups en Afrique. Découvrez nos services d\'accompagnement pour les entrepreneurs et innovateurs.',
        ]);
    }
}
