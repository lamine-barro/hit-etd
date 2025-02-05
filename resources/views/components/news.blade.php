<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- En-tête -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">
                {{ __('news.title') }}
            </h2>
            <p class="mt-4 text-xl text-gray-600">
                {{ __('news.subtitle') }}
            </p>
        </div>

        <!-- Articles mis en avant et Événements -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-16">
            <!-- Article principal (Featured) -->
            @if($featuredArticle = \App\Models\Article::published()->featured()->latest('published_at')->first())
            <div class="relative group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                <div class="aspect-w-16 aspect-h-9">
                    @if($featuredArticle->illustration)
                        <img src="{{ Storage::url($featuredArticle->illustration) }}"
                             alt="{{ $featuredArticle->title }}"
                             class="object-cover w-full h-full transform group-hover:scale-105 transition duration-500">
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-2">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ $featuredArticle->published_at->translatedFormat('d M Y') }}
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">
                        <a href="{{ route('actualites.show', $featuredArticle) }}" class="hover:text-primary-600 transition duration-300">
                            {{ $featuredArticle->title }}
                        </a>
                    </h3>
                    <p class="text-gray-600 mb-4">
                        {{ $featuredArticle->excerpt ?? Str::limit(strip_tags($featuredArticle->content), 150) }}
                    </p>
                    <a href="{{ route('actualites.show', $featuredArticle) }}" class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium">
                        {{ __('news.read_more') }}
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
            @endif

            <!-- Événements à venir -->
            <div class="space-y-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('news.upcoming_events') }}</h3>

                @forelse(\App\Models\Event::whereNotNull('start_date')
                    ->whereNotNull('end_date')
                    ->where('start_date', '>', now())
                    ->orderBy('start_date')
                    ->take(3)
                    ->get() as $event)
                <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition duration-300">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-primary-100 rounded-lg p-3 text-center">
                            @if($event->start_date)
                            <span class="block text-xl font-bold text-primary-600">{{ $event->start_date->format('d') }}</span>
                            <span class="block text-sm text-primary-600">{{ $event->start_date->translatedFormat('M') }}</span>
                            @else
                            <span class="block text-xl font-bold text-primary-600">--</span>
                            <span class="block text-sm text-primary-600">---</span>
                            @endif
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-900">{{ $event->title }}</h4>
                            <p class="text-gray-600 text-sm mb-2">
                                @if($event->start_date && $event->end_date)
                                    {{ $event->start_date->format('H:i') }} - {{ $event->end_date->format('H:i') }} | {{ $event->location }}
                                @else
                                    {{ $event->location ?? __('news.location_tbd') }}
                                @endif
                            </p>
                            <a href="{{ route('events.show', $event) }}" class="text-primary-600 hover:text-primary-700 text-sm font-medium">
                                {{ __('news.register') }} →
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center text-gray-500 py-8">
                    {{ __('news.no_events') }}
                </div>
                @endforelse
            </div>
        </div>

        <!-- Dernières actualités -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach(\App\Models\Article::published()->where('featured', false)->latest('published_at')->take(3)->get() as $article)
            <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                <div class="aspect-w-16 aspect-h-9">
                    @if($article->illustration)
                        <img src="{{ Storage::url($article->illustration) }}"
                             alt="{{ $article->title }}"
                             class="object-cover w-full h-full">
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="p-6">
                    <div class="text-sm text-gray-500 mb-2">{{ $article->published_at->translatedFormat('d M Y') }}</div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                        <a href="{{ route('actualites.show', $article) }}" class="hover:text-primary-600">
                            {{ $article->title }}
                        </a>
                    </h3>
                    <p class="text-gray-600 text-sm">
                        {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 100) }}
                    </p>
                </div>
            </article>
            @endforeach
        </div>

        <!-- CTA -->
        <div class="mt-12 text-center">
            <a href="{{ route('actualites') }}" class="inline-flex items-center px-6 py-3 border border-primary-600 text-base font-medium rounded-md text-primary-600 bg-white hover:bg-primary-50 transition duration-300">
                {{ __('news.view_all_news') }}
                <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
    </div>
</section>
