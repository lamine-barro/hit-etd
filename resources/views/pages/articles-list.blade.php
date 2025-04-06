@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-primary-600 to-primary-800 text-white overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <svg class="h-full w-full" viewBox="0 0 150 150" xmlns="http://www.w3.org/2000/svg">
                <path d="M-31.3,21.9c35.7,0,77.2,67,142.9,67s153.1-66.7,238.3-67c43.2-0.2,86.3,13.5,129.1,29.8" stroke="currentColor" stroke-width="1" fill="none" stroke-dasharray="5,5" />
                <path d="M-31.3,78.9c35.7,0,77.2,67,142.9,67s153.1-66.7,238.3-67c43.2-0.2,86.3,13.5,129.1,29.8" stroke="currentColor" stroke-width="1" fill="none" stroke-dasharray="5,5" />
                <path d="M-31.3,135.9c35.7,0,77.2,67,142.9,67s153.1-66.7,238.3-67c43.2-0.2,86.3,13.5,129.1,29.8" stroke="currentColor" stroke-width="1" fill="none" stroke-dasharray="5,5" />
            </svg>
        </div>
        <br>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-24 relative z-10">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-extrabold mb-6 leading-tight mt-12">{{ __('Actualités & Insights') }}</h1>
                <p class="text-xl md:text-2xl font-light mb-8 opacity-90">{{ __('Restez informé des dernières tendances et innovations de l\'écosystème tech') }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-gray-50 py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Filtres -->
        <div class="mb-12 bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                </svg>
                {{ __('Filtrer les articles') }}
            </h3>
            <form action="{{ route('actualites') }}" method="GET" class="flex flex-wrap gap-4 md:flex-row md:items-end">
                <div class="w-full md:w-auto flex-1">
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Catégorie') }}</label>
                    <select id="category" name="category" class="w-full px-4 py-2.5 rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 transition-colors duration-300">
                        <option value="">{{ __('Toutes les catégories') }}</option>
                        @foreach(\App\Enums\ArticleCategory::cases() as $category)
                            <option value="{{ $category->value }}" {{ request('category') === $category->value ? 'selected' : '' }}>
                                {{ $category->label() }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="w-full md:w-auto flex-1">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Recherche') }}</label>
                    <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="{{ __('Rechercher un article...') }}" class="w-full px-4 py-2.5 rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 transition-colors duration-300">
                </div>

                <button type="submit" class="w-full md:w-auto px-6 py-2.5 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors duration-300 flex items-center justify-center shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    {{ __('Filtrer') }}
                </button>
                
                @if(request('category') || request('search'))
                    <a href="{{ route('actualites') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-300 flex items-center">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        {{ __('Réinitialiser') }}
                    </a>
                @endif
            </form>
        </div>
        
        <!-- Articles mis en avant -->
        @if($featuredArticles->isNotEmpty())
            <div class="mb-16">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center">
                        <span class="w-10 h-1 bg-primary-600 mr-3"></span>
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900">{{ __('À la une') }}</h2>
                    </div>
                    <a href="#tous-articles" class="text-primary-600 hover:text-primary-700 font-medium flex items-center transition-all duration-300">
                        {{ __('Voir tous les articles') }}
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($featuredArticles as $article)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1 group border border-gray-100">
                            <div class="relative">
                                @if($article->illustration)
                                    <div class="aspect-w-16 aspect-h-9 overflow-hidden">
                                        <img src="{{ Storage::url($article->illustration) }}" 
                                            alt="{{ $article->title }}" 
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
                                        {{ $article->category->label() }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-primary-600 transition-colors duration-300 line-clamp-2">{{ $article->title }}</h3>
                                
                                <p class="text-gray-600 mb-5 line-clamp-3 h-[4.5rem]">
                                    @php
                                        $excerpt = $article->excerpt ?? strip_tags($article->content);
                                        $words = str_word_count($excerpt, 1);
                                        $limitedWords = array_slice($words, 0, 25);
                                        $limitedExcerpt = implode(' ', $limitedWords);
                                        echo count($words) > 25 ? $limitedExcerpt . '...' : $limitedExcerpt;
                                    @endphp
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
                                            <span class="text-xs text-gray-500">{{ $article->reading_time ?? 5 }} min</span>
                                        </div>
                                    </div>
                                    
                                    <a href="{{ route('actualites.show', $article) }}" class="inline-flex items-center font-medium text-primary-600 hover:text-primary-700 transition-colors duration-300 text-sm">
                                        {{ __('Lire plus') }}
                                        <svg class="w-4 h-4 ml-1 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Liste des articles -->
        <div id="tous-articles" class="mb-8">
            <div class="flex items-center mb-8">
                <span class="w-10 h-1 bg-primary-600 mr-3"></span>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">{{ __('Tous les articles') }}</h2>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="articles-list">
            @forelse($articles as $article)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1 group border border-gray-100">
                    <div class="relative">
                        @if($article->illustration)
                            <div class="aspect-w-16 aspect-h-9 overflow-hidden">
                                <img src="{{ Storage::url($article->illustration) }}" 
                                    alt="{{ $article->title }}" 
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
                                {{ $article->category->label() }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-primary-600 transition-colors duration-300 line-clamp-2">{{ $article->title }}</h3>
                        
                        <p class="text-gray-600 mb-5 line-clamp-3 h-[4.5rem]">
                            @php
                                $excerpt = $article->excerpt ?? strip_tags($article->content);
                                $words = str_word_count($excerpt, 1);
                                $limitedWords = array_slice($words, 0, 25);
                                $limitedExcerpt = implode(' ', $limitedWords);
                                echo count($words) > 25 ? $limitedExcerpt . '...' : $limitedExcerpt;
                            @endphp
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
                                    <span class="text-xs text-gray-500">{{ $article->reading_time ?? 5 }} min</span>
                                </div>
                            </div>
                            
                            <a href="{{ route('actualites.show', $article) }}" class="inline-flex items-center font-medium text-primary-600 hover:text-primary-700 transition-colors duration-300 text-sm">
                                {{ __('Lire plus') }}
                                <svg class="w-4 h-4 ml-1 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full min-h-[300px] flex flex-col items-center justify-center py-12">
                    <svg class="w-20 h-20 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    <p class="text-gray-500 text-xl text-center font-light">{{ __('Aucun article disponible pour le moment.') }}</p>
                    @if(request('category') || request('search'))
                        <a href="{{ route('actualites') }}" class="mt-4 text-primary-600 hover:text-primary-700 font-medium flex items-center">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            {{ __('Voir tous les articles') }}
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
            {{ __('Affichage de') }} {{ $articles->firstItem() ?? 0 }} {{ __('à') }} {{ $articles->lastItem() ?? 0 }} {{ __('sur') }} {{ $articles->total() }} {{ __('articles') }}
        </div>
    </div>
</div>
@endsection