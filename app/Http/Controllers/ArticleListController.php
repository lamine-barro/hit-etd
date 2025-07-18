<?php

namespace App\Http\Controllers;

use App\Enums\ArticleStatus;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleListController extends Controller
{
    /**
     * Display a listing of public articles.
     */
    public function index(Request $request)
    {
        $query = Article::query()
            ->where('status', ArticleStatus::PUBLISHED)
            ->where('published_at', '<=', now());

        // Appliquer les filtres
        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        // Trier par date de publication décroissante
        $query->latest('published_at');

        // Articles mis en avant en premier
        $featuredArticlesQuery = clone $query;
        $featuredArticlesQuery->where('featured', true)->limit(3);
        $featuredArticles = $featuredArticlesQuery->get();

        // Articles normaux
        $articles = $query->paginate(9)->withQueryString();

        // Précharger les traductions pour optimiser les performances
        $articles->load('translations');
        $featuredArticles->load('translations');

        return view('pages.articles.index', [
            'news' => $articles,
            'featuredArticles' => $featuredArticles,
            'pageTitle' => __("Actualités") . ' | ' . config('app.name'),
            'metaDescription' => __("Restez informé des dernières nouvelles et événements du Hub Ivoire Tech"),
        ]);
    }

    /**
     * Display the specified article.
     */
    public function show($slug)
    {
        // Récupérer l'article par son slug dans la langue actuelle
        $locale = app()->getLocale();

        $article = Article::whereHas('translations', function ($query) use ($slug, $locale) {
            $query->where('slug', $slug)->where('locale', $locale);
        })->first();

        // Si l'article n'est pas trouvé dans la langue actuelle, essayer avec la langue par défaut
        if (! $article && $locale !== config('app.fallback_locale')) {
            $article = Article::whereHas('translations', function ($query) use ($slug) {
                $query->where('slug', $slug)->where('locale', config('app.fallback_locale'));
            })->first();
        }

        // Si toujours pas trouvé, vérifier dans toutes les langues
        if (! $article) {
            $article = Article::whereHas('translations', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })->first();
        }

        if (! $article || $article->status !== ArticleStatus::PUBLISHED || $article->published_at->isFuture()) {
            abort(404);
        }

        // Incrémenter le compteur de vues
        $article->incrementViews();

        // Récupérer les articles similaires
        $relatedArticles = Article::where('id', '!=', $article->id)
            ->where('status', ArticleStatus::PUBLISHED)
            ->where('published_at', '<=', now())
            ->where('category', $article->category)
            ->latest('published_at')
            ->limit(3)
            ->get();

        return view('pages.articles.show', [
            'article' => $article,
            'relatedArticles' => $relatedArticles,
        ]);
    }
}
