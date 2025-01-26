@extends('layouts.dashboard')

@section('title', $article->title)

@section('content')
<div x-data="{ showDeleteModal: false }">
    <!-- En-tête -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('articles.index') }}" class="btn btn-link ps-0">
                <i class="bi bi-arrow-left me-2"></i>Retour aux articles
            </a>
            <h1 class="h3 mb-0 mt-2">{{ $article->title }}</h1>
        </div>
        <div>
            <a href="{{ route('articles.edit', $article) }}" class="btn btn-primary me-2">
                <i class="bi bi-pencil me-2"></i>Modifier
            </a>
            <button type="button" class="btn btn-danger" @click="showDeleteModal = true">
                <i class="bi bi-trash me-2"></i>Supprimer
            </button>
        </div>
    </div>

    <!-- Informations principales -->
    <div class="row">
        <!-- Colonne principale -->
        <div class="col-md-8">
            <!-- Image -->
            @if($article->illustration)
            <div class="card mb-4">
                <div class="card-body">
                    <img src="{{ asset('storage/' . $article->illustration) }}" 
                         alt="Illustration de l'article" 
                         class="img-fluid rounded">
                </div>
            </div>
            @endif

            <!-- Contenu -->
            <div class="card mb-4">
                <div class="card-body">
                    @if($article->excerpt)
                    <div class="lead mb-4">
                        {{ $article->excerpt }}
                    </div>
                    @endif

                    <div class="article-content">
                        {{ $article->content }}
                    </div>

                    @if($article->tags)
                    <div class="mt-4">
                        @foreach(json_decode($article->tags) as $tag)
                        <span class="badge bg-light text-dark me-2">{{ $tag }}</span>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Colonne latérale -->
        <div class="col-md-4">
            <!-- Informations -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Informations</h5>
                    
                    <dl class="mb-0">
                        <dt>Catégorie</dt>
                        <dd>
                            <span class="badge bg-primary">
                                {{ ucfirst($article->category) }}
                            </span>
                        </dd>

                        <dt class="mt-3">Statut</dt>
                        <dd>
                            @if($article->status === 'draft')
                            <span class="badge bg-secondary">Brouillon</span>
                            @elseif($article->status === 'published')
                            <span class="badge bg-success">Publié</span>
                            @else
                            <span class="badge bg-dark">Archivé</span>
                            @endif
                        </dd>

                        @if($article->featured)
                        <dt class="mt-3">Mise en avant</dt>
                        <dd>
                            <span class="badge bg-warning text-dark">
                                <i class="bi bi-star-fill me-1"></i>Article à la une
                            </span>
                        </dd>
                        @endif

                        <dt class="mt-3">Temps de lecture</dt>
                        <dd>{{ $article->reading_time }} min</dd>

                        <dt class="mt-3">Créé le</dt>
                        <dd>{{ $article->created_at->format('d/m/Y H:i') }}</dd>

                        <dt class="mt-3">Dernière modification</dt>
                        <dd>{{ $article->updated_at->format('d/m/Y H:i') }}</dd>

                        @if($article->published_at)
                        <dt class="mt-3">Date de publication</dt>
                        <dd>{{ $article->published_at->format('d/m/Y H:i') }}</dd>
                        @endif
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmation de suppression -->
    <div class="modal fade" :class="{ 'show d-block': showDeleteModal }" 
         tabindex="-1" 
         :style="showDeleteModal ? 'background-color: rgba(0,0,0,0.5);' : ''">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" @click="showDeleteModal = false"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer cet article ?</p>
                    <p class="mb-0 text-danger"><strong>Cette action est irréversible.</strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" @click="showDeleteModal = false">
                        Annuler
                    </button>
                    <form action="{{ route('articles.destroy', $article) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash me-2"></i>Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.article-content {
    line-height: 1.8;
    font-size: 1.1rem;
}

.modal.show {
    background-color: rgba(0, 0, 0, 0.5);
}
</style>
@endsection 