<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Affiche la page des actualités
     */
    public function index()
    {
        // TODO: Récupérer les actualités depuis la base de données
        $news = [
            [
                'title' => 'Lancement de la nouvelle promotion',
                'excerpt' => 'Le Hub Ivoire Tech accueille sa nouvelle promotion de startups innovantes.',
                'date' => '2024-03-15',
                'image' => 'news/promotion-2024.jpg'
            ],
            [
                'title' => 'Hackathon IA & Développement Durable',
                'excerpt' => 'Un weekend d\'innovation autour de l\'intelligence artificielle.',
                'date' => '2024-03-10',
                'image' => 'news/hackathon-ia.jpg'
            ],
            [
                'title' => 'Partenariat avec Microsoft',
                'excerpt' => 'Microsoft rejoint notre réseau de partenaires technologiques.',
                'date' => '2024-03-05',
                'image' => 'news/microsoft-partner.jpg'
            ],
        ];

        return view('pages.actualites', [
            'pageTitle' => 'Actualités - Hub Ivoire Tech',
            'metaDescription' => 'Découvrez les dernières actualités du Hub Ivoire Tech : événements, success stories, nouveaux partenariats et plus encore.',
            'news' => $news
        ]);
    }
}
