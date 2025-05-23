@extends('layouts.app')

@php
    // Métadonnées SEO
    $pageTitle = $article->getTranslatedAttribute('meta_title') ?: $article->getTranslatedAttribute('title');
    $metaDescription = $article->getTranslatedAttribute('meta_description') ?: $article->getTranslatedAttribute('excerpt');
    $ogImage = $article->illustration ? Storage::url($article->illustration) : asset('images/hero_bg.jpg');
    $ogType = 'article';
    $articleTags = is_array($article->tags) ? implode(', ', $article->tags) : '';
@endphp

@section('meta')
    <!-- Meta Tags SEO -->
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="keywords" content="{{ $articleTags }}">
    <meta name="author" content="{{ config('hit.name') }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="{{ $ogType }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="article:published_time" content="{{ $article->published_at->toIso8601String() }}">
    <meta property="article:section" content="{{ $article->category->getTranslatedLabel() }}">
    @if(is_array($article->tags))
        @foreach($article->tags as $tag)
            <meta property="article:tag" content="{{ $tag }}">
        @endforeach
    @endif
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $pageTitle }}">
    <meta property="twitter:description" content="{{ $metaDescription }}">
    <meta property="twitter:image" content="{{ $ogImage }}">
@endsection

@section('content')
<div class="min-h-screen bg-white mt-20">
    <!-- Fil d'Ariane -->
    <div class="mt-36">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="flex items-center text-sm font-medium" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li>
                        <a href="{{ route('home') }}" class="text-gray-500 hover:text-primary-600 transition-colors duration-200 flex items-center">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <span>{{ __("Accueil") }}</span>
                        </a>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                        <a href="{{ route('actualites') }}" class="text-gray-500 hover:text-primary-600 transition-colors duration-200">
                            {{ __("Actualités") }}
                        </a>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                        <span class="text-primary-600 font-semibold truncate max-w-xs" title="{{ $article->getTranslatedAttribute('title') }}">
                            {{ Str::limit($article->getTranslatedAttribute('title'), 40) }}
                        </span>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <article class="bg-white rounded-lg shadow-lg overflow-hidden pb-20">
            <!-- Image de l'article -->
            @if ($article->illustration)
                <div class="relative h-96">
                    <img src="{{ Storage::url($article->illustration) }}" 
                         alt="{{ $article->getTranslatedAttribute('title') }}" 
                         class="w-full h-full object-cover">
                </div>
            @endif

            <div class="p-8">
                <!-- En-tête -->
                <div class="max-w-3xl mx-auto">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-4">
                            <span class="text-sm font-medium px-3 py-1 rounded
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
                                {{ $article->category->getTranslatedLabel() }}
                            </span>
                            <span class="text-sm text-gray-500">
                                {{ $article->getTranslatedAttribute('reading_time') }} {{ __('min de lecture') }}
                            </span>
                        </div>
                        <div class="flex items-center gap-4">
                            <!-- Compteur de vues -->
                            <span class="text-sm text-gray-500 flex items-center">
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                {{ $article->views + 1 }} {{ __('vues') }}
                            </span>
                            <!-- Boutons de partage -->
                            <div class="flex items-center gap-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="text-blue-600 hover:text-blue-700">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/></svg>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($article->title) }}" target="_blank" class="text-blue-400 hover:text-blue-500">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.44 4.83c-.8.37-1.5.38-2.22.02.93-.56.98-.96 1.32-2.02-.88.52-1.86.9-2.9 1.1-.82-.88-2-1.43-3.3-1.43-2.5 0-4.55 2.04-4.55 4.54 0 .36.03.7.1 1.04-3.77-.2-7.12-2-9.36-4.75-.4.67-.6 1.45-.6 2.3 0 1.56.8 2.95 2 3.77-.74-.03-1.44-.23-2.05-.57v.06c0 2.2 1.56 4.03 3.64 4.44-.67.2-1.37.2-2.06.08.58 1.8 2.26 3.12 4.25 3.16C5.78 18.1 3.37 18.74 1 18.46c2 1.3 4.4 2.04 6.97 2.04 8.35 0 12.92-6.92 12.92-12.93 0-.2 0-.4-.02-.6.9-.63 1.96-1.22 2.56-2.14z"/></svg>
                                </a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($article->title) }}" target="_blank" class="text-blue-700 hover:text-blue-800">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $article->getTranslatedAttribute('title') }}</h1>
                    
                    @if($article->getTranslatedAttribute('excerpt'))
                        <div class="text-xl text-gray-600 mb-8 leading-relaxed">
                            {{ $article->getTranslatedAttribute('excerpt') }}
                        </div>
                    @endif

                    <div class="flex items-center justify-between border-b border-gray-200 pb-6 mb-8">
                        <div class="flex items-center">
                            <span class="text-gray-600">{{ __("Publié le") }} {{ $article->published_at->format('d/m/Y') }}</span>
                        </div>
                        @if($article->tags && is_array($article->tags) && count($article->tags) > 0)
                            <div class="flex flex-wrap gap-2">
                                @foreach($article->tags as $tag)
                                    <span class="text-sm bg-gray-100 text-gray-700 px-3 py-1 rounded-full">
                                        {{ $tag }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Contenu de l'article -->
                    <div class="prose prose-lg max-w-none prose-headings:text-gray-900 prose-a:text-primary-600 prose-a:no-underline hover:prose-a:text-primary-700 prose-a:font-medium prose-img:rounded-lg">
                        {!! $article->getTranslatedAttribute('content') !!}
                    </div>
                </div>
            </div>
        </article>

        <!-- Articles similaires -->
        @if($relatedArticles->isNotEmpty())
            <div class="mt-16 mb-24">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">{{ __("Articles similaires") }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($relatedArticles as $relatedArticle)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            @if($relatedArticle->illustration)
                                <img src="{{ Storage::url($relatedArticle->illustration) }}" 
                                     alt="{{ $relatedArticle->getTranslatedAttribute('title') }}" 
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
                                    <span class="text-sm font-medium px-2 py-1 rounded
                                        @switch($relatedArticle->category->value)
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
                                        {{ $relatedArticle->category->getTranslatedLabel() }}
                                    </span>
                                    <span class="text-sm text-gray-500">
                                        {{ $relatedArticle->getTranslatedAttribute('reading_time') }} {{ __('min de lecture') }}
                                    </span>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $relatedArticle->getTranslatedAttribute('title') }}</h3>
                                <p class="text-gray-600 mb-4">
                                    @php
                                        $excerpt = $relatedArticle->getTranslatedAttribute('excerpt');
                                        if (empty($excerpt)) {
                                            $excerpt = Str::limit(strip_tags($relatedArticle->getTranslatedAttribute('content')), 120);
                                        } else {
                                            $excerpt = Str::limit($excerpt, 120);
                                        }
                                    @endphp
                                    {{ $excerpt }}
                                </p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">
                                        {{ __('Publié le') }} {{ $relatedArticle->published_at->format('d/m/Y') }}
                                    </span>
                                    <a href="{{ route('actualites.show', $relatedArticle->getTranslatedAttribute('slug')) }}" class="inline-flex items-center text-primary-600 hover:text-primary-700">
                                        {{ __("Lire plus") }}
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