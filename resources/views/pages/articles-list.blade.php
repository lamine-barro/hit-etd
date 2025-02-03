@extends('layouts.app')

@section('content')
    <br><br><br>
    <div class="bg-gray-50 py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- En-tête -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ __('Actualités') }}</h1>
            <p class="text-lg text-gray-600">{{ __('Restez informé des dernières actualités de HIT') }}</p>
        </div>

        <!-- Articles mis en avant -->
        @if($featuredArticles->isNotEmpty())
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ __('À la une') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($featuredArticles as $article)
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
                                        {{ __($article->category) }}
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
                    @endforeach
                </div>
            </div>
        @endif
        <!-- Filtres -->
        <div class="mb-8">
            <form action="{{ route('actualites') }}" method="GET" class="flex flex-wrap gap-4 justify-center">
                <select name="category" class="px-4 py-2.5 rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    <option value="">{{ __('Toutes les catégories') }}</option>
                    <option value="actualite" {{ request('category') === 'actualite' ? 'selected' : '' }}>{{ __('Actualités') }}</option>
                    <option value="technologie" {{ request('category') === 'technologie' ? 'selected' : '' }}>{{ __('Technologie') }}</option>
                    <option value="evenement" {{ request('category') === 'evenement' ? 'selected' : '' }}>{{ __('Événements') }}</option>
                </select>

                <button type="submit" class="px-6 py-2.5 bg-primary-600 text-white rounded-md hover:bg-primary-700">
                    {{ __('Filtrer') }}
                </button>
            </form>
        </div>

        <!-- Liste des articles -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
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
                                {{ __($article->category) }}
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
                <div class="col-span-full min-h-[300px] flex items-center justify-center">
                    <p class="text-gray-500 text-lg text-center">{{ __('Aucun article disponible pour le moment.') }}</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $articles->links() }}
        </div>
    </div>
</div>
@endsection