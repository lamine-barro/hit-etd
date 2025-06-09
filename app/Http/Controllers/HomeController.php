<?php

namespace App\Http\Controllers;

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
            'pageTitle' => __('Accueil - Hub Ivoire Tech'),
            'metaDescription' => __('Le Hub Ivoire Tech a pour vocation d\'être le plus grand Campus de Startups en Afrique. Découvrez nos services d\'accompagnement pour les entrepreneurs et innovateurs.'),
        ]);
    }
}
