@php
    // Métadonnées SEO
    $pageTitle = $article->getTranslatedAttribute('meta_title') ?: $article->getTranslatedAttribute('title');
    $metaDescription = $article->getTranslatedAttribute('meta_description') ?: $article->getTranslatedAttribute('excerpt');
    $ogImage = $article->illustration ? Storage::url($article->illustration) : asset('images/hero_bg.jpg');
    $ogType = 'article';
    $articleTags = is_array($article->tags) ? implode(', ', $article->tags) : '';
@endphp

<x-layouts.main>
    <x-slot:title>{{ $pageTitle }}</x-slot:title>
    <x-slot:metaDescription>{{ $metaDescription }}</x-slot:metaDescription>
    
    <x-slot:styles>
        <!-- Meta Tags SEO spécifiques à l'article -->
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
    </x-slot:styles>

    <div class="bg-gray-50 min-h-screen py-8 sm:py-12">
        <!-- Navigation de retour -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
            <nav class="flex items-center space-x-2 text-sm text-gray-600">
                <a href="{{ route('actualites') }}" class="hover:text-primary-600 transition-colors duration-300">
                    {{ __("Actualités") }}
                </a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-gray-900">{{ $article->getTranslatedAttribute('title') }}</span>
            </nav>
        </div>

        <article class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Image d'en-tête -->
            @if($article->illustration)
                <div class="relative h-64 sm:h-80 lg:h-96 overflow-hidden">
                    <img src="{{ Storage::url($article->illustration) }}"
                         alt="{{ $article->getTranslatedAttribute('title') }}"
                         class="w-full h-full object-cover">
                    
                    <!-- Overlay pour améliorer la lisibilité -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    
                    <!-- Badge de catégorie superposé -->
                    <div class="absolute top-6 left-6">
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-white/90 text-gray-900 backdrop-blur-sm">
                            {{ $article->category->getTranslatedLabel() }}
                        </span>
                    </div>
                </div>
            @endif

            <!-- Contenu principal -->
            <div class="px-6 sm:px-8 lg:px-12 py-8 sm:py-12">
                <!-- En-tête de l'article -->
                <header class="mb-8">
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                        {{ $article->getTranslatedAttribute('title') }}
                    </h1>

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
                </header>

                <!-- Contenu de l'article -->
                <div class="prose prose-lg max-w-none prose-headings:text-gray-900 prose-a:text-primary-600 prose-a:no-underline hover:prose-a:text-primary-700 prose-a:font-medium prose-img:rounded-lg">
                    {!! $article->getTranslatedAttribute('content') !!}
                </div>
            </div>
        </article>

        <!-- Articles similaires -->
        @if($relatedArticles && $relatedArticles->count() > 0)
            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ __("Articles similaires") }}</h2>
                    <p class="text-xl text-gray-600">{{ __("Découvrez d'autres articles qui pourraient vous intéresser") }}</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($relatedArticles as $relatedArticle)
                        <x-articles.card :article="$relatedArticle" />
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</x-layouts.main> 