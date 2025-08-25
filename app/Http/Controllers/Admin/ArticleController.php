<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Administrator;
use App\Enums\ArticleStatus;
use App\Enums\ArticleCategory;
use App\Traits\HandlesImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    use HandlesImageUpload;
    public function index()
    {
        $articles = Article::with('author')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('pages.admin.articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        return view('pages.admin.articles.show', compact('article'));
    }

    public function create()
    {
        return view('pages.admin.articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_fr' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'slug_fr' => 'required|string|max:255|unique:article_translations,slug',
            'slug_en' => 'nullable|string|max:255|unique:article_translations,slug',
            'excerpt_fr' => 'nullable|string',
            'excerpt_en' => 'nullable|string',
            'content_fr' => 'required|string',
            'content_en' => 'nullable|string',
            'category' => 'required|string',
            'status' => 'required|string',
            'featured' => 'boolean',
            'illustration' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'tags' => 'nullable|string',
            'meta_title_fr' => 'nullable|string|max:255',
            'meta_title_en' => 'nullable|string|max:255',
            'meta_description_fr' => 'nullable|string',
            'meta_description_en' => 'nullable|string',
        ]);

        if ($request->hasFile('illustration')) {
            $validated['illustration'] = $this->optimizeArticleImage($request->file('illustration'));
        }

        $validated['featured'] = $request->has('featured');
        $validated['tags'] = $request->tags ? explode(',', $request->tags) : [];
        
        // Définir author_id avec l'administrateur connecté
        $validated['author_id'] = auth()->guard('admin')->id();

        $article = Article::create($validated);

        // Créer les traductions
        $article->translations()->create([
            'locale' => 'fr',
            'title' => $validated['title_fr'],
            'slug' => $validated['slug_fr'],
            'excerpt' => $validated['excerpt_fr'] ?? null,
            'content' => $validated['content_fr'],
            'meta_title' => $validated['meta_title_fr'] ?? null,
            'meta_description' => $validated['meta_description_fr'] ?? null,
        ]);

        if (!empty($validated['title_en'])) {
            $article->translations()->create([
                'locale' => 'en',
                'title' => $validated['title_en'],
                'slug' => $validated['slug_en'],
                'excerpt' => $validated['excerpt_en'] ?? null,
                'content' => $validated['content_en'] ?? null,
                'meta_title' => $validated['meta_title_en'] ?? null,
                'meta_description' => $validated['meta_description_en'] ?? null,
            ]);
        }

        return redirect()->route('admin.articles.index')->with('success', 'Article créé avec succès.');
    }

    public function edit(Article $article)
    {
        $article->load('translations');
        return view('pages.admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title_fr' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'slug_fr' => 'required|string|max:255|unique:article_translations,slug,' . $article->translations->where('locale', 'fr')->first()?->id,
            'slug_en' => 'nullable|string|max:255|unique:article_translations,slug,' . $article->translations->where('locale', 'en')->first()?->id,
            'excerpt_fr' => 'nullable|string',
            'excerpt_en' => 'nullable|string',
            'content_fr' => 'required|string',
            'content_en' => 'nullable|string',
            'category' => 'required|string',
            'status' => 'required|string',
            'featured' => 'boolean',
            'illustration' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'tags' => 'nullable|string',
        ]);

        if ($request->hasFile('illustration')) {
            $this->deleteImage($article->illustration);
            $validated['illustration'] = $this->optimizeArticleImage($request->file('illustration'));
        }

        $validated['featured'] = $request->has('featured');
        $validated['tags'] = $request->tags ? explode(',', $request->tags) : [];

        $article->update($validated);

        // Mettre à jour les traductions
        $frTranslation = $article->translations->where('locale', 'fr')->first();
        if ($frTranslation) {
            $frTranslation->update([
                'title' => $validated['title_fr'],
                'slug' => $validated['slug_fr'],
                'excerpt' => $validated['excerpt_fr'] ?? null,
                'content' => $validated['content_fr'],
            ]);
        }

        $enTranslation = $article->translations->where('locale', 'en')->first();
        if (!empty($validated['title_en'])) {
            if ($enTranslation) {
                $enTranslation->update([
                    'title' => $validated['title_en'],
                    'slug' => $validated['slug_en'],
                    'excerpt' => $validated['excerpt_en'] ?? null,
                    'content' => $validated['content_en'] ?? null,
                ]);
            } else {
                $article->translations()->create([
                    'locale' => 'en',
                    'title' => $validated['title_en'],
                    'slug' => $validated['slug_en'],
                    'excerpt' => $validated['excerpt_en'] ?? null,
                    'content' => $validated['content_en'] ?? null,
                ]);
            }
        } elseif ($enTranslation) {
            $enTranslation->delete();
        }

        return redirect()->route('admin.articles.index')->with('success', 'Article mis à jour avec succès.');
    }

    public function destroy(Article $article)
    {
        $this->deleteImage($article->illustration);

        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Article supprimé avec succès.');
    }

    public function archive(Article $article)
    {
        $article->update(['status' => ArticleStatus::ARCHIVED]);

        return redirect()->route('admin.articles.index')->with('success', 'Article archivé avec succès.');
    }
}