@extends('layouts.dashboard')

@section('title', 'Gestion des articles')

@section('content')
<div x-data="{
    articleToDelete: null,
    deleteModal: null,
    
    init() {
        this.deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    },
    
    confirmDelete(articleId) {
        this.articleToDelete = articleId;
        this.deleteModal.show();
    },
    
    cancelDelete() {
        this.articleToDelete = null;
        this.deleteModal.hide();
    },
    
    submitDelete() {
        if (this.articleToDelete) {
            document.getElementById('delete-form-' + this.articleToDelete).submit();
        }
    }
}">
    <!-- En-tête -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Articles</h1>
        <a href="{{ route('articles.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Nouvel article
        </a>
    </div>

    <!-- Filtres -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('articles.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" name="search" class="form-control" 
                               placeholder="Rechercher..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="category" class="form-select">
                        <option value="">Toutes les catégories</option>
                        <option value="actualite" {{ request('category') === 'actualite' ? 'selected' : '' }}>Actualité</option>
                        <option value="technologie" {{ request('category') === 'technologie' ? 'selected' : '' }}>Technologie</option>
                        <option value="evenement" {{ request('category') === 'evenement' ? 'selected' : '' }}>Événement</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">Tous les statuts</option>
                        <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Brouillon</option>
                        <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Publié</option>
                        <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Archivé</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-funnel me-2"></i>Filtrer
                        </button>
                        @if(request()->hasAny(['search', 'category', 'status', 'featured']))
                            <a href="{{ route('articles.index') }}" class="btn btn-light">
                                <i class="bi bi-x-circle me-2"></i>Réinitialiser
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Liste des articles -->
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th style="width: 45%">Article</th>
                        <th>Catégorie</th>
                        <th>Statut</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $article)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($article->illustration)
                                        <img src="{{ asset('storage/' . $article->illustration) }}" 
                                             alt="{{ $article->title }}"
                                             class="rounded me-3"
                                             style="width: 64px; height: 64px; object-fit: cover;">
                                    @else
                                        <div class="rounded me-3 bg-light d-flex align-items-center justify-content-center"
                                             style="width: 64px; height: 64px;">
                                            <i class="bi bi-file-text fs-3 text-muted"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <h6 class="mb-1">
                                            <a href="{{ route('articles.show', $article) }}" 
                                               class="text-decoration-none">{{ $article->title }}</a>
                                            @if($article->featured)
                                                <span class="badge bg-warning ms-2">
                                                    <i class="bi bi-star-fill me-1"></i>À la une
                                                </span>
                                            @endif
                                        </h6>
                                        <small class="text-muted">
                                            {{ Str::limit($article->excerpt ?? strip_tags($article->content), 100) }}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark">
                                    {{ ucfirst($article->category) }}
                                </span>
                            </td>
                            <td>
                                @if($article->status === 'published')
                                    <span class="badge bg-success">Publié</span>
                                @elseif($article->status === 'draft')
                                    <span class="badge bg-secondary">Brouillon</span>
                                @else
                                    <span class="badge bg-danger">Archivé</span>
                                @endif
                            </td>
                            <td>
                                @if($article->published_at)
                                    <small class="text-muted">
                                        Publié le {{ $article->published_at->format('d/m/Y') }}
                                    </small>
                                @else
                                    <small class="text-muted">
                                        Créé le {{ $article->created_at->format('d/m/Y') }}
                                    </small>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('articles.show', $article) }}" 
                                       class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('articles.edit', $article) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-sm btn-outline-danger"
                                            @click="confirmDelete({{ $article->id }})">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                                <form id="delete-form-{{ $article->id }}"
                                      action="{{ route('articles.destroy', $article) }}"
                                      method="POST"
                                      class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="bi bi-inbox fs-2 mb-3"></i>
                                    <p class="mb-0">Aucun article trouvé</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($articles->hasPages())
            <div class="card-footer bg-white">
                {{ $articles->links() }}
            </div>
        @endif
    </div>

    <!-- Modal de confirmation de suppression -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" @click="cancelDelete"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer cet article ? Cette action est irréversible.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" @click="cancelDelete">Annuler</button>
                    <button type="button" class="btn btn-danger" @click="submitDelete">
                        <i class="bi bi-trash me-2"></i>Supprimer
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 