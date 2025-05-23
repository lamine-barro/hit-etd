@extends('layouts.app')

@php
    // Métadonnées SEO
    $pageTitle = __('Actualités & Insights') . ' | ' . config('app.name');
    $metaDescription = __('Restez informé des dernières tendances et innovations de l\'écosystème tech en Afrique et dans le monde.');
    $ogType = 'website';
    
    // Catégorie filtrée
    if (request('category')) {
        $categoryEnum = \App\Enums\ArticleCategory::tryFrom(request('category'));
        if ($categoryEnum) {
            $categoryLabel = $categoryEnum->getTranslatedLabel();
            $pageTitle = $categoryLabel . ' | ' . config('app.name');
            $metaDescription = __('Articles sur') . ' ' . $categoryLabel . ' | ' . config('app.name');
        }
    }
    
    // Recherche
    if (request('search')) {
        $searchTerm = request('search');
        $pageTitle = __('Recherche') . ': ' . $searchTerm . ' | ' . config('app.name');
        $metaDescription = __('Résultats de recherche pour') . ' "' . $searchTerm . '" | ' . config('app.name');
    }
@endphp

@section('meta')
    <!-- Meta Tags SEO -->
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="keywords" content="actualités, articles, blog, tech, innovation, Afrique, Côte d'Ivoire, startups">
    <meta name="author" content="{{ config('hit.name') }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="{{ $ogType }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:image" content="{{ asset('images/hero_bg.jpg') }}">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $pageTitle }}">
    <meta property="twitter:description" content="{{ $metaDescription }}">
    <meta property="twitter:image" content="{{ asset('images/hero_bg.jpg') }}">
    
    <!-- Pagination SEO -->
    @if($articles->previousPageUrl())
        <link rel="prev" href="{{ $articles->previousPageUrl() }}">
    @endif
    @if($articles->nextPageUrl())
        <link rel="next" href="{{ $articles->nextPageUrl() }}">
    @endif
@endsection

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-br from-green-900 via-green-800 to-orange-900 text-white overflow-hidden">
        <!-- Motif de fond moderne -->
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-black opacity-30"></div>
            <div class="absolute inset-y-0 right-0 w-1/2 bg-gradient-to-l from-blue-500/20 to-transparent"></div>
            <div
                class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmZmZmYiIGZpbGwtb3BhY2l0eT0iMC4xIj48cGF0aCBkPSJNMzYgMzRjMC0yLjIgMS44LTQgNC00czQgMS44IDQgNC0xLjggNC00IDQtNC0xLjgtNC00eiIvPjxwYXRoIGQ9Ik0xNiAxNmMyLjIgMCA0IDEuOCA0IDRzLTEuOCA0LTQgNC00LTEuOC00LTQgNC0xLjgtNC00em0xNiAwYzIuMiAwIDQgMS44IDQgNHMtMS44IDQtNCA0LTQtMS44LTQtNCAxLjgtNCA0LTR6TTM2IDM0YzAtMi4yIDEuOC00IDQtNHM0IDEuOCA0IDQtMS44IDQtNCA0LTQtMS44LTQtNHoiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-40">
            </div>
        </div>

        <!-- Éléments décoratifs -->
        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 rounded-full bg-blue-600/20 blur-3xl" aria-hidden="true">
        </div>
        <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 rounded-full bg-purple-600/20 blur-3xl"
            aria-hidden="true"></div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28 relative z-10">
            <div class="text-center mt-5">
                <div class="text-center">
                    <div
                        class="inline-flex items-center px-3 py-1 mb-6 text-xs font-medium tracking-wide text-green-100 uppercase bg-green-800/40 rounded-full backdrop-blur-sm border border-green-700/50">
                        <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        {{ __("Actualités & Insights") }}
                    </div>

                    <h1 class="text-4xl md:text-5xl font-extrabold mb-6 leading-tight">
                        <span class="block mt-1 text-transparent bg-clip-text bg-gradient-to-r from-orange-300 via-green-300 to-green-200">{{ __("Actualités & Insights") }}</span>
                    </h1>

                    <p class="text-xl text-center font-light mb-8 text-green-100 leading-relaxed">
                        {{ __("Restez informé des dernières tendances et innovations de l'écosystème tech en Afrique et dans le monde.") }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Indicateur de défilement -->
        <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2">
            <a href="#articles-filter-form"
                class="flex flex-col items-center text-white/80 hover:text-white transition-colors duration-300"
                aria-label="Découvrir les filtres d'articles">
                <span class="text-xs font-medium mb-1">Explorer</span>
                <div class="w-8 h-12 border-2 border-white/40 rounded-full flex justify-center pt-1" aria-hidden="true">
                    <div class="w-1.5 h-3 bg-white/80 rounded-full animate-bounce"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="bg-gray-50 py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Filtres compacts -->
        <div id="articles-filter-form" class="mb-8 bg-white rounded border border-gray-100 shadow-sm">
            <div class="p-4">
                <form action="{{ route('actualites') }}" method="GET">
                    <div class="flex flex-wrap items-center gap-3">
                        <div class="w-full md:w-auto md:flex-1">
                            <div class="relative">
                                <select id="category" name="category" class="w-full rounded border border-gray-300 bg-white py-2.5 px-3 pr-8 text-gray-700 focus:border-orange-500 focus:ring-0 focus:outline-none">
                                    <option value="">{{ __("Toutes les catégories") }}</option>
                                    @foreach(\App\Enums\ArticleCategory::cases() as $category)
                                        <option value="{{ $category->value }}" {{ request('category') === $category->value ? 'selected' : '' }}>
                                            {{ $category->getTranslatedLabel() }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="w-full md:w-auto md:flex-1">
                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                placeholder="{{ __("Rechercher un article") }}..."
                                class="w-full rounded border border-gray-300 bg-white py-2.5 px-3 text-gray-700 focus:border-orange-500 focus:ring-0 focus:outline-none"
                                autocomplete="off">
                        </div>

                        <div class="flex items-center gap-3">
                            <button type="submit" class="px-4 py-2.5 bg-orange-600 hover:bg-orange-700 text-white rounded flex items-center">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                <span>{{ __("Filtrer") }}</span>
                            </button>

                            @if(request('category') || request('search'))
                                <a href="{{ route('actualites') }}" class="text-gray-500 hover:text-gray-700 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    <span>{{ __("Réinitialiser") }}</span>
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Styles pour éliminer la couleur bleue sur les inputs -->
                    <style>
                        input:focus, select:focus, textarea:focus {
                            outline: none !important;
                            border-color: #f97316 !important; /* orange-500 */
                            box-shadow: 0 0 0 1px rgba(249, 115, 22, 0.1) !important; /* orange-500 avec opacité minimale */
                        }
                    </style>
                </form>
            </div>
        </div>

        <!-- Articles mis en avant -->
        @if($featuredArticles->isNotEmpty())
            <div class="mb-16">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center">
                        <span class="w-10 h-1 bg-primary-600 mr-3"></span>
                        <h2 class="text-xl md:text-3xl font-bold text-gray-900">{{ __("À la une") }}</h2>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($featuredArticles as $article)
                        <a href="{{ route('actualites.show', $article->getTranslatedAttribute('slug')) }}" class="block relative">
                            <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1 group border border-gray-100 h-full">
                                <div class="relative">
                                    @if($article->illustration)
                                        <div class="aspect-w-16 aspect-h-9 overflow-hidden">
                                            <img src="{{ Storage::url($article->illustration) }}"
                                                alt="{{ $article->getTranslatedAttribute('title') }}"
                                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                        </div>
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    @else
                                        <div class="aspect-w-16 aspect-h-9 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="absolute top-4 left-4 z-10">
                                        <span class="text-sm font-medium px-3 py-1.5 rounded-full shadow-sm backdrop-blur-sm
                                            @switch($article->category->value)
                                                @case('tech_ecosystem')
                                                    bg-blue-100/90 text-blue-800
                                                    @break
                                                @case('digital_transformation')
                                                    bg-indigo-100/90 text-indigo-800
                                                    @break
                                                @case('artificial_intelligence')
                                                    bg-purple-100/90 text-purple-800
                                                    @break
                                                @case('cybersecurity')
                                                    bg-red-100/90 text-red-800
                                                    @break
                                                @case('fintech')
                                                    bg-green-100/90 text-green-800
                                                    @break
                                                @case('entrepreneurship')
                                                    bg-yellow-100/90 text-yellow-800
                                                    @break
                                                @case('diversity_inclusion')
                                                    bg-pink-100/90 text-pink-800
                                                    @break
                                                @default
                                                    bg-gray-100/90 text-gray-800
                                            @endswitch
                                        ">
                                            {{ $article->category->getTranslatedLabel() }}
                                        </span>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-primary-600 transition-colors duration-300 line-clamp-2">{{ $article->getTranslatedAttribute('title') }}</h3>

                                    <p class="text-gray-600 mb-5 line-clamp-3 h-[4.5rem]">
                                        @php
                                            $excerpt = $article->getTranslatedAttribute('excerpt');
                                            if (empty($excerpt)) {
                                                $excerpt = Str::limit(strip_tags($article->getTranslatedAttribute('content')), 150);
                                            }
                                        @endphp
                                        {{ $excerpt }}
                                    </p>

                                    <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex items-center space-x-1">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <span class="text-xs text-gray-500">{{ $article->published_at->format('d/m/Y') }}</span>
                                            </div>

                                            <div class="flex items-center space-x-1">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span class="text-xs text-gray-500">{{ $article->getTranslatedAttribute('reading_time') }} min</span>
                                            </div>
                                        </div>

                                        <div class="inline-flex items-center font-medium text-primary-600 hover:text-primary-700 transition-colors duration-300 text-sm">
                                            {{ __("Lire plus") }}
                                            <svg class="w-4 h-4 ml-1 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Liste des articles -->
        <div id="tous-articles" class="mb-8">
            <div class="flex items-center mb-8">
                <span class="w-10 h-1 bg-primary-600 mr-3"></span>
                <h2 class="text-2xl font-bold text-gray-900">{{ __("Tous les articles") }}</h2>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="articles-list">
            @forelse($articles as $article)
                <a href="{{ route('actualites.show', $article->getTranslatedAttribute('slug')) }}" class="block relative">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1 group border border-gray-100 h-full">
                        <div class="relative">
                            @if($article->illustration)
                                <div class="aspect-w-16 aspect-h-9 overflow-hidden">
                                    <img src="{{ Storage::url($article->illustration) }}"
                                        alt="{{ $article->getTranslatedAttribute('title') }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            @else
                                <div class="aspect-w-16 aspect-h-9 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute top-4 left-4 z-10">
                                <span class="text-sm font-medium px-3 py-1.5 rounded-full shadow-sm backdrop-blur-sm
                                    @switch($article->category->value)
                                        @case('tech_ecosystem')
                                            bg-blue-100/90 text-blue-800
                                            @break
                                        @case('digital_transformation')
                                            bg-indigo-100/90 text-indigo-800
                                            @break
                                        @case('artificial_intelligence')
                                            bg-purple-100/90 text-purple-800
                                            @break
                                        @case('cybersecurity')
                                            bg-red-100/90 text-red-800
                                            @break
                                        @case('fintech')
                                            bg-green-100/90 text-green-800
                                            @break
                                        @case('entrepreneurship')
                                            bg-yellow-100/90 text-yellow-800
                                            @break
                                        @case('diversity_inclusion')
                                            bg-pink-100/90 text-pink-800
                                            @break
                                        @default
                                            bg-gray-100/90 text-gray-800
                                    @endswitch
                                ">
                                    {{ $article->category->getTranslatedLabel() }}
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-primary-600 transition-colors duration-300 line-clamp-2">{{ $article->getTranslatedAttribute('title') }}</h3>

                            <p class="text-gray-600 mb-5 line-clamp-3 h-[4.5rem]">
                                @php
                                    $excerpt = $article->getTranslatedAttribute('excerpt');
                                    if (empty($excerpt)) {
                                        $excerpt = Str::limit(strip_tags($article->getTranslatedAttribute('content')), 150);
                                    }
                                @endphp
                                {{ $excerpt }}
                            </p>

                            <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-xs text-gray-500">{{ $article->published_at->format('d/m/Y') }}</span>
                                    </div>

                                    <div class="flex items-center space-x-1">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="text-xs text-gray-500">{{ $article->getTranslatedAttribute('reading_time') }} min</span>
                                    </div>
                                </div>

                                <div class="inline-flex items-center font-medium text-primary-600 hover:text-primary-700 transition-colors duration-300 text-sm">
                                    {{ __("Lire plus") }}
                                    <svg class="w-4 h-4 ml-1 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full min-h-[300px] flex flex-col items-center justify-center py-12">
                    <svg class="w-20 h-20 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    <p class="text-gray-500 text-xl text-center font-light">{{ __("Aucun article disponible pour le moment.") }}</p>
                    @if(request('category') || request('search'))
                        <a href="{{ route('actualites') }}" class="mt-4 text-primary-600 hover:text-primary-700 font-medium flex items-center">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            {{ __("Voir tous les articles") }}
                        </a>
                    @endif
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            <div class="bg-white rounded-xl shadow-sm p-4 border border-gray-100 w-full max-w-3xl">
                {{ $articles->onEachSide(1)->links() }}
            </div>
        </div>

        <!-- Information sur le nombre d'articles -->
        <div class="text-center text-gray-500 mt-4">
            {{ __("Affichage de") }} {{ $articles->firstItem() ?? 0 }} {{ __("à") }} {{ $articles->lastItem() ?? 0 }} {{ __("sur") }} {{ $articles->total() }} {{ __("articles") }}
        </div>
    </div>
</div>
@endsection
