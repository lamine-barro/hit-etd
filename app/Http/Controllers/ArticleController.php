<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ArticleController extends Controller
{
    /**
     * Display a listing of articles.
     */
    public function index(Request $request)
    {
        $query = Article::query();

        // Appliquer les filtres
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->boolean('featured')) {
            $query->where('featured', true);
        }

        // Trier par date de création décroissante
        $query->latest();

        $articles = $query->paginate(10)->withQueryString();

        return view('dashboard.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new article.
     */
    public function create()
    {
        return view('dashboard.articles.create');
    }

    /**
     * Store a newly created article.
     */
    public function store(Request $request)
    {
        try {
            // Log des données reçues
            Log::info('Tentative de création d\'article', [
                'request_data' => $request->all(),
            ]);

            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'category' => 'required|string|in:actualite,technologie,evenement',
                'excerpt' => 'nullable|string|max:500',
                'content' => 'required|string',
                'tags' => 'nullable|json',
                'status' => 'required|in:draft,published',
                'featured' => 'boolean',
                'illustration' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Log après validation
            Log::info('Données validées avec succès', [
                'validated_data' => $validatedData,
            ]);

            // Générer le slug à partir du titre
            $validatedData['slug'] = Str::slug($validatedData['title']);

            // Vérifier si le slug existe déjà et ajouter un suffixe si nécessaire
            $originalSlug = $validatedData['slug'];
            $counter = 1;
            while (Article::where('slug', $validatedData['slug'])->exists()) {
                $validatedData['slug'] = $originalSlug.'-'.$counter;
                $counter++;
            }

            Log::info('Slug généré', ['slug' => $validatedData['slug']]);

            // Gérer l'illustration si elle est présente
            if ($request->hasFile('illustration')) {
                $file = $request->file('illustration');
                Log::info('Fichier d\'illustration reçu', [
                    'original_name' => $file->getClientOriginalName(),
                    'mime_type' => $file->getMimeType(),
                    'size' => $file->getSize(),
                ]);

                $filename = time().'_'.$file->getClientOriginalName();
                $path = $file->storeAs('articles', $filename, 'public');
                $validatedData['illustration'] = $path;

                Log::info('Illustration sauvegardée', ['path' => $path]);
            }

            // Gérer les tags
            if (isset($validatedData['tags'])) {
                try {
                    $tags = json_decode($validatedData['tags'], true);
                    Log::info('Tags décodés', ['tags' => $tags]);
                } catch (\JsonException $e) {
                    Log::error('Erreur de décodage des tags', ['error' => $e->getMessage()]);
                }
            }

            // Créer l'article
            $article = Article::create($validatedData);
            Log::info('Article créé avec succès', ['article_id' => $article->id]);

            return redirect()->route('articles.index')->with('toast', [
                'type' => 'success',
                'message' => 'Article créé avec succès!',
            ]);

        } catch (ValidationException $e) {
            Log::error('Erreur de validation lors de la création de l\'article', [
                'errors' => $e->errors(),
                'request_data' => $request->all(),
            ]);

            return back()->withErrors($e->errors())->withInput()->with('toast', [
                'type' => 'error',
                'message' => 'Erreur de validation. Veuillez vérifier les champs.',
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création de l\'article', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all(),
            ]);

            // Si une image a été uploadée, la supprimer
            if (isset($path)) {
                Storage::disk('public')->delete($path);
                Log::info('Suppression de l\'image après erreur', ['path' => $path]);
            }

            return back()->withInput()->with('toast', [
                'type' => 'error',
                'message' => 'Une erreur est survenue lors de la création de l\'article.',
            ]);
        }
    }

    /**
     * Display the specified article.
     */
    public function show(Article $article)
    {
        return view('dashboard.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified article.
     */
    public function edit(Article $article)
    {
        return view('dashboard.articles.edit', compact('article'));
    }

    /**
     * Update the specified article in storage.
     */
    public function update(Request $request, Article $article)
    {
        try {
            // Log des données reçues
            Log::info('Tentative de mise à jour d\'article', [
                'article_id' => $article->id,
                'request_data' => $request->all(),
            ]);

            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'category' => 'required|string|in:actualite,technologie,evenement',
                'excerpt' => 'nullable|string|max:500',
                'content' => 'required|string',
                'tags' => 'nullable|json',
                'status' => 'required|in:draft,published',
                'featured' => 'boolean',
                'illustration' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Log après validation
            Log::info('Données validées avec succès pour la mise à jour', [
                'validated_data' => $validatedData,
            ]);

            // Générer le slug uniquement si le titre a changé
            if ($article->title !== $validatedData['title']) {
                $validatedData['slug'] = Str::slug($validatedData['title']);

                // Vérifier si le slug existe déjà et ajouter un suffixe si nécessaire
                $originalSlug = $validatedData['slug'];
                $counter = 1;
                while (Article::where('slug', $validatedData['slug'])
                    ->where('id', '!=', $article->id)
                    ->exists()) {
                    $validatedData['slug'] = $originalSlug.'-'.$counter;
                    $counter++;
                }

                Log::info('Nouveau slug généré', ['slug' => $validatedData['slug']]);
            }

            // Gérer l'illustration si elle est présente
            if ($request->hasFile('illustration')) {
                Log::info('Nouvelle illustration reçue', [
                    'original_name' => $request->file('illustration')->getClientOriginalName(),
                ]);

                // Supprimer l'ancienne image si elle existe
                if ($article->illustration) {
                    Storage::disk('public')->delete($article->illustration);
                    Log::info('Ancienne illustration supprimée', [
                        'old_path' => $article->illustration,
                    ]);
                }

                $file = $request->file('illustration');
                $filename = time().'_'.$file->getClientOriginalName();
                $path = $file->storeAs('articles', $filename, 'public');
                $validatedData['illustration'] = $path;

                Log::info('Nouvelle illustration sauvegardée', ['path' => $path]);
            }

            // Gérer les tags
            if (isset($validatedData['tags'])) {
                try {
                    $tags = json_decode($validatedData['tags'], true);
                    Log::info('Tags mis à jour', ['tags' => $tags]);
                } catch (\JsonException $e) {
                    Log::error('Erreur de décodage des tags lors de la mise à jour', [
                        'error' => $e->getMessage(),
                    ]);
                }
            }

            // Mettre à jour l'article
            $article->update($validatedData);
            Log::info('Article mis à jour avec succès', ['article_id' => $article->id]);

            return redirect()->route('articles.show', $article)->with('toast', [
                'type' => 'success',
                'message' => 'Article mis à jour avec succès!',
            ]);

        } catch (ValidationException $e) {
            Log::error('Erreur de validation lors de la mise à jour de l\'article', [
                'article_id' => $article->id,
                'errors' => $e->errors(),
                'request_data' => $request->all(),
            ]);

            return back()->withErrors($e->errors())->withInput()->with('toast', [
                'type' => 'error',
                'message' => 'Erreur de validation. Veuillez vérifier les champs.',
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour de l\'article', [
                'article_id' => $article->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all(),
            ]);

            // Si une nouvelle image a été uploadée, la supprimer
            if (isset($path)) {
                Storage::disk('public')->delete($path);
                Log::info('Suppression de la nouvelle image après erreur', ['path' => $path]);
            }

            return back()->withInput()->with('toast', [
                'type' => 'error',
                'message' => 'Une erreur est survenue lors de la mise à jour de l\'article.',
            ]);
        }
    }

    /**
     * Remove the specified article from storage.
     */
    public function destroy(Article $article)
    {
        try {
            Log::info('Tentative de suppression d\'article', [
                'article_id' => $article->id,
                'title' => $article->title,
            ]);

            // Supprimer l'illustration si elle existe
            if ($article->illustration) {
                Storage::disk('public')->delete($article->illustration);
                Log::info('Illustration supprimée', [
                    'path' => $article->illustration,
                ]);
            }

            // Supprimer l'article
            $article->delete();
            Log::info('Article supprimé avec succès', [
                'article_id' => $article->id,
            ]);

            return redirect()->route('articles.index')->with('toast', [
                'type' => 'success',
                'message' => 'Article supprimé avec succès!',
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur lors de la suppression de l\'article', [
                'article_id' => $article->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->with('toast', [
                'type' => 'error',
                'message' => 'Une erreur est survenue lors de la suppression de l\'article.',
            ]);
        }
    }
}
