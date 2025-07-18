@php
    // Métadonnées SEO
    $pageTitle = $article->getTranslatedAttribute('meta_title') ?: $article->getTranslatedAttribute('title');
    $metaDescription = $article->getTranslatedAttribute('meta_description') ?: $article->getTranslatedAttribute('excerpt');
    $ogImage = $article->illustration ? Storage::url($article->illustration) : asset('images/hero_bg.jpg');
    $ogType = 'article';
    $articleTags = is_array($article->tags) ? implode(', ', $article->tags) : '';
    $authorName = $article->author?->getFullName() ?? config('app.name');
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

    <div class="bg-white">
        <div class="pt-6">
            <!-- Breadcrumb -->
            <nav aria-label="Breadcrumb" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <ol role="list" class="flex items-center space-x-2">
                    <li>
                        <div class="flex items-center">
                            <a href="{{ route('actualites') }}" class="mr-2 text-sm font-medium text-gray-900">{{ __("Actualités") }}</a>
                            <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" aria-hidden="true" class="w-4 h-5 text-gray-300">
                                <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                            </svg>
                        </div>
                    </li>
                    <li class="text-sm">
                        <span aria-current="page" class="font-medium text-gray-500 hover:text-gray-600">{{ $article->getTranslatedAttribute('title') }}</span>
                    </li>
                </ol>
            </nav>

            <!-- Article content -->
            <div class="mt-6 max-w-2xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8 lg:grid lg:grid-cols-3 lg:gap-x-8">
                <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
                    @if($article->illustration)
                        <div class="aspect-w-3 aspect-h-2 rounded-lg overflow-hidden mb-6">
                            <img src="{{ Str::startsWith($article->illustration, 'http') ? $article->illustration : Storage::url($article->illustration) }}" alt="{{ $article->getTranslatedAttribute('title') }}" class="w-full h-full object-center object-cover">
                        </div>
                    @endif
                    <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">{{ $article->getTranslatedAttribute('title') }}</h1>
                    <div class="mt-3 text-sm text-gray-500">
                        <span>{{ __("Publié le") }} {{ $article->published_at->format('d F Y') }} {{ __("par") }}</span>
                        <span class="font-medium text-gray-900">{{ $authorName }}</span>
                    </div>

                    <div class="mt-6">
                        <div class="prose prose-lg text-gray-700 max-w-none">
                            {!! $article->getTranslatedAttribute('content') !!}
                        </div>
                    </div>
                </div>

                <!-- Article info -->
                <div class="mt-10 lg:mt-0">
                    <h2 class="text-lg font-medium text-gray-900">{{ __("Détails de l'article") }}</h2>

                    <div class="mt-4 border-t border-gray-200 pt-4">
                        <h3 class="text-sm font-medium text-gray-900">{{ __("Catégorie") }}</h3>
                        <div class="mt-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary-100 text-primary-800">
                                {{ $article->category->getTranslatedLabel() }}
                            </span>
                        </div>
                    </div>

                    @if($article->tags && is_array($article->tags) && count($article->tags) > 0)
                        <div class="mt-4 border-t border-gray-200 pt-4">
                            <h3 class="text-sm font-medium text-gray-900">{{ __("Tags") }}</h3>
                            <div class="mt-2 flex flex-wrap gap-2">
                                @foreach($article->tags as $tag)
                                    <span class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded-md">{{ $tag }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Articles similaires -->
        @if($relatedArticles && $relatedArticles->count() > 0)
            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 sm:mt-24">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ __("Continuer la lecture") }}</h2>
                    <p class="text-xl text-gray-600">{{ __("D'autres articles qui pourraient vous plaire") }}</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
                    @foreach($relatedArticles as $relatedArticle)
                        <x-articles.card :article="$relatedArticle" />
                    @endforeach
                </div>
            </section>
        @endif
        <div class="py-12"></div>
    </div>
</x-layouts.main> 