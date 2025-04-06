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
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-24 relative z-10">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-extrabold mb-6 leading-tight">{{ __('Actualités & Insights') }}</h1>
                <p class="text-xl md:text-2xl font-light mb-8 opacity-90">{{ __('Restez informé des dernières tendances et innovations de l\'écosystème tech') }}</p>
                <div class="mt-8 flex justify-center">
                    <a href="#articles-list" class="animate-bounce bg-white bg-opacity-20 p-3 rounded-full hover:bg-opacity-30 transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-gray-50 py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

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
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1 group">
                            <div class="relative">
                                @if($article->illustration)
                                    <img src="{{ Storage::url($article->illustration) }}" 
                                        alt="{{ $article->title }}" 
                                        class="w-full h-52 object-cover transition-transform duration-500 group-hover:scale-105">
                                @else
                                    <div class="w-full h-52 bg-gradient-to-r from-gray-200 to-gray-300 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute top-4 left-4">
                                    <span class="text-sm font-medium px-3 py-1.5 rounded-full
                                        @switch($article->category->value)
                                            @case('tech_ecosystem')
                                                bg-blue-100 text-blue-800
                                                @break
                                            @case('digital_transformation')
                                                bg-indigo-100 text-indigo-800
                                                @break
                                            @case('artificial_intelligence')
                                                bg-purple-100 text-purple-800
                                                @break
                                            @case('cybersecurity')
                                                bg-red-100 text-red-800
                                                @break
                                            @case('fintech')
                                                bg-green-100 text-green-800
                                                @break
                                            @case('entrepreneurship')
                                                bg-yellow-100 text-yellow-800
                                                @break
                                            @case('diversity_inclusion')
                                                bg-pink-100 text-pink-800
                                                @break
                                            @default
                                                bg-gray-100 text-gray-800
                                        @endswitch
                                    ">
                                        {{ $article->category->label() }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center space-x-2 mb-3">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-sm text-gray-500">{{ $article->reading_time }} min de lecture</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-primary-600 transition-colors duration-300">{{ $article->title }}</h3>
                                <p class="text-gray-600 mb-5 line-clamp-3">{{ Str::limit($article->excerpt ?? strip_tags($article->content), 150) }}</p>
                                <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-sm text-gray-500">{{ $article->published_at->format('d/m/Y') }}</span>
                                    </div>
                                    <a href="{{ route('actualites.show', $article) }}" class="inline-flex items-center font-medium text-primary-600 hover:text-primary-700 transition-colors duration-300">
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

        <!-- Liste des articles -->
        <div id="tous-articles" class="mb-8">
            <div class="flex items-center mb-8">
                <span class="w-10 h-1 bg-primary-600 mr-3"></span>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">{{ __('Tous les articles') }}</h2>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="articles-list">
            @forelse($articles as $article)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if($article->illustration)
                        <img src="{{ Storage::url($article->illustration) }}" 
                             alt="{{ $article->title }}" 
                             class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                        </div>
                    @endif
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium px-2 py-1 rounded {{ $article->category === 'actualite' ? 'bg-blue-100 text-blue-800' : ($article->category === 'technologie' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800') }}">
                                {{ $article->category->label() }}
                            </span>
                            <span class="text-sm text-gray-500">
                                {{ $article->reading_time }} min
                            </span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $article->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($article->excerpt ?? strip_tags($article->content), 120) }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">
                                {{ $article->published_at->format('d/m/Y') }}
                            </span>
                            <a href="{{ route('actualites.show', $article) }}" class="inline-flex items-center text-primary-600 hover:text-primary-700">
                                {{ __('Lire plus') }}
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
        <div class="mt-12">
            {{ $articles->onEachSide(1)->links() }}
        </div>
        
        <!-- Newsletter -->
        <div class="mt-16 bg-gradient-to-r from-primary-600 to-primary-800 rounded-xl shadow-lg overflow-hidden">
            <div class="md:flex items-center">
                <div class="md:w-2/3 p-8 md:p-12">
                    <h3 class="text-2xl md:text-3xl font-bold text-white mb-4">{{ __('Restez informé des dernières actualités') }}</h3>
                    <p class="text-primary-100 mb-6">{{ __('Inscrivez-vous à notre newsletter pour recevoir les dernières actualités et tendances de l\'industrie tech.') }}</p>
                    <form action="#" method="POST" class="flex flex-col sm:flex-row gap-3">
                        <input type="email" placeholder="Votre adresse email" class="flex-1 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-white">
                        <button type="submit" class="px-6 py-3 bg-white text-primary-700 font-medium rounded-lg hover:bg-primary-50 transition-colors duration-300 whitespace-nowrap">
                            {{ __('S\'inscrire') }}
                        </button>
                    </form>
                    <p class="text-xs text-primary-200 mt-3">{{ __('En vous inscrivant, vous acceptez de recevoir des emails de notre part. Vous pourrez vous désinscrire à tout moment.') }}</p>
                </div>
                <div class="hidden md:block md:w-1/3 relative">
                    <svg class="absolute inset-0 h-full w-full text-white opacity-10" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                        <polygon points="0,0 100,0 0,100" />
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <svg class="w-32 h-32 text-white opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection