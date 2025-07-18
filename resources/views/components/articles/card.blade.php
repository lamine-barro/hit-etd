@props(['article'])

<div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1 group border border-gray-100 h-full">
    <div class="relative">
        @if($article->illustration)
            <div class="aspect-w-16 aspect-h-9 overflow-hidden">
                <img src="{{ Str::startsWith($article->illustration, 'http') ? $article->illustration : Storage::url($article->illustration) }}"
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

        <!-- Badge de catégorie -->
        <div class="absolute top-4 left-4">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                {{ $article->category->getTranslatedLabel() }}
            </span>
        </div>
    </div>

    <div class="p-6 flex flex-col h-full">
        <!-- Titre -->
        <a href="{{ $article->getSlug() ? route('actualites.show', ['slug' => $article->getSlug()]) : '#' }}" class="block mb-3">
            <h3 class="text-xl font-bold text-gray-900 group-hover:text-primary-600 transition-colors duration-300 line-clamp-2">
                {{ $article->getTranslatedAttribute('title') }}
            </h3>
        </a>

        <!-- Excerpt -->
        <p class="text-gray-600 text-sm leading-relaxed mb-4 flex-grow line-clamp-3">
            {{ $article->getTranslatedAttribute('excerpt') }}
        </p>

        <!-- Footer de la card -->
        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <span class="text-sm text-gray-500" title="{{ $article->published_at->format('d/m/Y H:i') }}">
                    {{ $article->published_at->diffForHumans() }}
                </span>
            </div>

            <a href="{{ $article->getSlug() ? route('actualites.show', ['slug' => $article->getSlug()]) : '#' }}"
               class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium text-sm transition-colors duration-300">
                {{ __("Lire plus") }}
                <svg class="w-4 h-4 ml-1 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
    </div>
</div> 