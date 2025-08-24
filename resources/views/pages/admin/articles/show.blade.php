@extends('pages.admin.layouts.app')

@section('title', $article->getTitle())
@section('page-title', 'Détails de l\'article')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- En-tête -->
    <div class="mb-8">
        <div class="flex items-center space-x-3 text-sm text-gray-500 mb-4">
            <a href="{{ route('admin.articles.index') }}" class="hover:text-primary transition-colors">Articles</a>
            <i data-lucide="chevron-right" class="h-4 w-4"></i>
            <span class="text-gray-900">{{ Str::limit($article->getTitle(), 50) }}</span>
        </div>
        
        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 font-poppins">{{ $article->getTitle() }}</h1>
                <div class="mt-2 flex items-center gap-x-4 text-sm text-gray-500">
                    <div class="flex items-center gap-x-1">
                        <i data-lucide="calendar" class="h-4 w-4"></i>
                        <span>Publié le {{ $article->published_at ? $article->published_at->format('d/m/Y') : $article->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex items-center gap-x-1">
                        <i data-lucide="user" class="h-4 w-4"></i>
                        <span>Par {{ $article->author?->getName() ?? 'Admin' }}</span>
                    </div>
                    <div class="flex items-center gap-x-1">
                        <i data-lucide="eye" class="h-4 w-4"></i>
                        <span>{{ number_format($article->views ?? 0) }} vues</span>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center gap-x-3">
                <a href="{{ route('admin.articles.edit', $article) }}" 
                   class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 transition-colors font-poppins">
                    <i data-lucide="edit" class="h-4 w-4 mr-2"></i>
                    Modifier
                </a>
                <button type="button" 
                        onclick="openConfirmModal('{{ route('admin.articles.destroy', $article) }}', 'Êtes-vous sûr de vouloir supprimer cet article ?', 'delete', 'DELETE')"
                        class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-red-50 hover:text-red-700 hover:ring-red-300 transition-colors font-poppins">
                    <i data-lucide="trash-2" class="h-4 w-4 mr-2"></i>
                    Supprimer
                </button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Contenu principal -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Image d'illustration -->
            @if($article->illustration)
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl overflow-hidden">
                <img src="{{ $article->illustration }}" 
                     alt="{{ $article->getTitle() }}" 
                     class="w-full h-auto">
            </div>
            @endif

            <!-- Contenu de l'article -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                <div class="px-4 py-6 sm:p-8">
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-gray-900 font-poppins mb-3">Extrait</h2>
                        <p class="text-gray-700 leading-relaxed">{{ $article->getExcerpt() }}</p>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-6">
                        <h2 class="text-lg font-semibold text-gray-900 font-poppins mb-3">Contenu</h2>
                        <div class="prose max-w-none text-gray-700">
                            {!! nl2br(e($article->getContent())) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            
            <!-- Informations -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                <div class="px-4 py-6 sm:p-6">
                    <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Informations</h3>
                    
                    <dl class="space-y-4">
                        <!-- Statut -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Statut</dt>
                            <dd class="mt-1">
                                @switch($article->status?->value)
                                    @case('draft')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                            Brouillon
                                        </span>
                                        @break
                                    @case('published')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Publié
                                        </span>
                                        @break
                                    @case('archived')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Archivé
                                        </span>
                                        @break
                                    @default
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                            {{ $article->status?->value ?? 'Non défini' }}
                                        </span>
                                @endswitch
                            </dd>
                        </div>

                        <!-- Catégorie -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Catégorie</dt>
                            <dd class="mt-1">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full" style="background-color: #FFF4ED; color: #CC4700;">
                                    {{ $article->category?->label() ?? 'Non définie' }}
                                </span>
                            </dd>
                        </div>

                        <!-- En vedette -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500">En vedette</dt>
                            <dd class="mt-1">
                                @if($article->featured)
                                    <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        <i data-lucide="star" class="h-3 w-3 mr-1"></i>
                                        Oui
                                    </span>
                                @else
                                    <span class="text-sm text-gray-600">Non</span>
                                @endif
                            </dd>
                        </div>

                        <!-- Date de création -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Créé le</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $article->created_at->format('d/m/Y à H:i') }}
                            </dd>
                        </div>

                        <!-- Dernière modification -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Modifié le</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $article->updated_at->format('d/m/Y à H:i') }}
                            </dd>
                        </div>

                        <!-- Date de publication -->
                        @if($article->published_at)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Publié le</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $article->published_at->format('d/m/Y à H:i') }}
                            </dd>
                        </div>
                        @endif
                    </dl>
                </div>
            </div>

            <!-- Tags -->
            @if($article->tags && count($article->tags) > 0)
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                <div class="px-4 py-6 sm:p-6">
                    <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($article->tags as $tag)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                {{ $tag }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Actions rapides -->
            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                <div class="px-4 py-6 sm:p-6">
                    <h3 class="text-lg font-semibold text-gray-900 font-poppins mb-4">Actions rapides</h3>
                    <div class="space-y-3">
                        @if($article->status?->value === 'draft')
                        <form action="{{ route('admin.articles.publish', $article) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full inline-flex justify-center items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors font-poppins">
                                <i data-lucide="send" class="h-4 w-4 mr-2"></i>
                                Publier l'article
                            </button>
                        </form>
                        @elseif($article->status?->value === 'published')
                        <form action="{{ route('admin.articles.archive', $article) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full inline-flex justify-center items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors font-poppins">
                                <i data-lucide="archive" class="h-4 w-4 mr-2"></i>
                                Archiver l'article
                            </button>
                        </form>
                        @endif
                        
                        <a href="{{ route('admin.articles.duplicate', $article) }}" 
                           class="w-full inline-flex justify-center items-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors font-poppins">
                            <i data-lucide="copy" class="h-4 w-4 mr-2"></i>
                            Dupliquer l'article
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Inclure le modal de suppression -->
@include('pages.admin.components.delete-modal')

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialiser les icônes Lucide
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
});
</script>
@endsection