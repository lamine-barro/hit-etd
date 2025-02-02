@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <article class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Image de l'article -->
            @if ($article->illustration)
                <div class="relative h-96">
                    <img src="{{ Storage::url($article->illustration) }}" 
                         alt="{{ $article->title }}" 
                         class="w-full h-full object-cover">
                </div>
            @endif

            <div class="p-8">
                <!-- En-tête -->
                <div class="max-w-3xl mx-auto">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="text-sm font-medium px-3 py-1 rounded {{ $article->category === 'actualite' ? 'bg-blue-100 text-blue-800' : ($article->category === 'technologie' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800') }}">
                            {{ __($article->category) }}
                        </span>
                        <span class="text-sm text-gray-500">
                            {{ $article->reading_time }} min de lecture
                        </span>
                    </div>

                    <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $article->title }}</h1>
                    
                    @if($article->excerpt)
                        <p class="text-xl text-gray-600 mb-8">{{ $article->excerpt }}</p>
                    @endif

                    <div class="flex items-center justify-between border-b border-gray-200 pb-6 mb-8">
                        <div class="flex items-center">
                            <span class="text-gray-600">{{ __('Publié le') }} {{ $article->published_at->format('d/m/Y') }}</span>
                        </div>
                        @if($article->tags)
                            <div class="flex flex-wrap gap-2">
                                @foreach($article->tags as $tag)
                                    <span class="text-sm bg-gray-100 text-gray-700 px-3 py-1 rounded-full">
                                        {{ $tag }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Contenu -->
                    <div class="prose max-w-none">
                        {!! $article->content !!}
                    </div>
                </div>
            </div>
        </article>

        <!-- Articles similaires -->
        @if($relatedArticles->isNotEmpty())
            <div class="mt-16">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">{{ __('Articles similaires') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($relatedArticles as $relatedArticle)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            @if($relatedArticle->illustration)
                                <img src="{{ Storage::url($relatedArticle->illustration) }}" 
                                     alt="{{ $relatedArticle->title }}" 
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
                                    <span class="text-sm font-medium px-2 py-1 rounded {{ $relatedArticle->category === 'actualite' ? 'bg-blue-100 text-blue-800' : ($relatedArticle->category === 'technologie' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800') }}">
                                        {{ __($relatedArticle->category) }}
                                    </span>
                                    <span class="text-sm text-gray-500">
                                        {{ $relatedArticle->reading_time }} min
                                    </span>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $relatedArticle->title }}</h3>
                                <p class="text-gray-600 mb-4">{{ Str::limit($relatedArticle->excerpt ?? strip_tags($relatedArticle->content), 120) }}</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">
                                        {{ $relatedArticle->published_at->format('d/m/Y') }}
                                    </span>
                                    <a href="{{ route('actualites.show', $relatedArticle) }}" class="inline-flex items-center text-primary-600 hover:text-primary-700">
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
    </div>
</div>
@endsection 