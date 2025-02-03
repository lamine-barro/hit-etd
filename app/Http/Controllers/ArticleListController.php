<?php

namespace App\Http\Controllers;

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
            ->where('status', 'published')
            ->where('published_at', '<=', now());

        // Appliquer les filtres
        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        // Trier par date de publication décroissante
        $query->latest('published_at');

        // Articles mis en avant en premier
        $featuredArticles = clone $query;
        $featuredArticles->where('featured', true)->limit(3);

        // Articles normaux
        $articles = $query->paginate(9)->withQueryString();

        return view('pages.articles-list', [
            'articles' => $articles,
            'featuredArticles' => $featuredArticles->get()
        ]);
    }

    /**
     * Display the specified article.
     */
    public function show(Article $article)
    {
        if ($article->status !== 'published' || $article->published_at->isFuture()) {
            abort(404);
        }

        // Incrémenter le compteur de vues
        $article->incrementViews();

        // Récupérer les articles similaires
        $relatedArticles = Article::where('id', '!=', $article->id)
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->where('category', $article->category)
            ->latest('published_at')
            ->limit(3)
            ->get();

        return view('pages.article-detail', [
            'article' => $article,
            'relatedArticles' => $relatedArticles
        ]);
    }
} 