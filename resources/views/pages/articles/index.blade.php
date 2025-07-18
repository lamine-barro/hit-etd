<x-layouts.main>
    <x-slot:title>{{ $pageTitle }}</x-slot:title>
    <x-slot:metaDescription>{{ $metaDescription }}</x-slot:metaDescription>

    <div class="bg-white" x-data="articleFilters()">
        <!-- Header Section -->
        <div class="relative bg-gradient-to-br from-slate-600 via-blue-600 to-indigo-600 py-16 sm:py-20 lg:py-32 overflow-hidden">
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/10 via-transparent to-white/5"></div>
            
            <!-- Background Pattern -->
            <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.03"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
            
            <!-- Decorative Elements -->
            <div class="absolute top-20 left-10 w-24 h-24 bg-white/5 rounded-full blur-xl"></div>
            <div class="absolute bottom-20 right-10 w-32 h-32 bg-blue-400/10 rounded-full blur-2xl"></div>
            <div class="absolute top-40 right-20 w-16 h-16 bg-indigo-300/10 rounded-full blur-lg"></div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <!-- Title -->
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-6 drop-shadow-sm">
                        {{ __("Actualités") }}
                    </h1>
                    
                    <!-- Subtitle -->
                    <p class="text-xl sm:text-2xl text-slate-100 max-w-3xl mx-auto opacity-90">
                        {{ __("Restez informé des dernières nouvelles et événements du Hub Ivoire Tech") }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 lg:py-20">
            <!-- Filtres et recherche -->
            <div class="mb-8 flex flex-col sm:flex-row gap-4 justify-between items-center">
                <div class="flex flex-wrap gap-2">
                    <button @click="activeFilter = 'all'" 
                            :class="{ 'bg-primary-600 text-white': activeFilter === 'all', 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50': activeFilter !== 'all' }"
                            class="px-4 py-2 rounded-lg font-medium transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                        {{ __("Tous") }}
                        <span x-text="'(' + getArticleCountByStatus('all') + ')'" 
                              class="ml-1 text-sm opacity-80"></span>
                    </button>
                    <button @click="activeFilter = 'recent'" 
                            :class="{ 'bg-primary-600 text-white': activeFilter === 'recent', 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50': activeFilter !== 'recent' }"
                            class="px-4 py-2 rounded-lg font-medium transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                        {{ __("Récents") }}
                        <span x-text="'(' + getArticleCountByStatus('recent') + ')'" 
                              class="ml-1 text-sm opacity-80"></span>
                    </button>
                    <button @click="activeFilter = 'older'" 
                            :class="{ 'bg-primary-600 text-white': activeFilter === 'older', 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50': activeFilter !== 'older' }"
                            class="px-4 py-2 rounded-lg font-medium transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                        {{ __("Plus anciens") }}
                        <span x-text="'(' + getArticleCountByStatus('older') + ')'" 
                              class="ml-1 text-sm opacity-80"></span>
                    </button>
                </div>
                
                <div class="relative">
                    <input type="text" 
                           x-model="searchQuery"
                           @input="filterArticles()"
                           placeholder="{{ __("Rechercher un article...") }}" 
                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                    <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <!-- Bouton clear search -->
                    <button x-show="searchQuery.length > 0" 
                            @click="searchQuery = ''; filterArticles()"
                            class="absolute right-3 top-2.5 w-5 h-5 text-gray-400 hover:text-gray-600 focus:outline-none">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Indicateur de résultats -->
            <div x-show="searchQuery.length > 0 || activeFilter !== 'all'" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform translate-y-2"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 class="mb-6 text-sm text-gray-600">
                <span x-text="filteredArticles.length"></span> 
                <span x-text="filteredArticles.length === 1 ? '{{ __("article trouvé") }}' : '{{ __("articles trouvés") }}'"></span>
                <span x-show="searchQuery.length > 0">
                    {{ __("pour") }} "<span x-text="searchQuery" class="font-medium"></span>"
                </span>
            </div>

            <!-- Grille des actualités -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($news as $article)
                    <div x-show="isArticleVisible({{ $loop->index }})" 
                         x-transition:enter="transition ease-out duration-300 delay-{{ $loop->index * 50 }}"
                         x-transition:enter-start="opacity-0 transform scale-95 translate-y-4"
                         x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         data-article-index="{{ $loop->index }}"
                         data-article-title="{{ strtolower($article->getTranslatedAttribute('title')) }}"
                         data-article-excerpt="{{ strtolower(strip_tags($article->getTranslatedAttribute('excerpt'))) }}"
                         data-article-date="{{ $article->published_at ? $article->published_at->format('Y-m-d') : '' }}"
                         data-article-age="{{ $article->published_at && $article->published_at->diffInDays(now()) <= 30 ? 'recent' : 'older' }}">
                        <x-articles.card :article="$article" />
                    </div>
                @endforeach
            </div>

            <!-- État vide pour les filtres -->
            <div x-show="hasArticles && filteredArticles.length === 0" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 class="col-span-full text-center py-16">
                <svg class="mx-auto w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <h3 class="text-xl font-medium text-gray-900 mb-2">{{ __("Aucun article trouvé") }}</h3>
                <p class="text-gray-600 mb-4">{{ __("Essayez de modifier vos critères de recherche ou filtres.") }}</p>
                <button @click="resetFilters()" 
                        class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors duration-200">
                    {{ __("Réinitialiser les filtres") }}
                </button>
            </div>

            <!-- Pagination -->
            @if($news->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $news->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        function articleFilters() {
            return {
                activeFilter: 'all',
                searchQuery: '',
                filteredArticles: [],
                hasArticles: {{ isset($news) && $news->count() > 0 ? 'true' : 'false' }},

                init() {
                    this.filterArticles();
                },

                filterArticles() {
                    const articleElements = document.querySelectorAll('[data-article-index]');
                    this.filteredArticles = Array.from(articleElements).filter(element => {
                        // Filtre par âge
                        const articleAge = element.dataset.articleAge;
                        const ageMatch = this.activeFilter === 'all' || 
                                        (this.activeFilter === 'recent' && articleAge === 'recent') ||
                                        (this.activeFilter === 'older' && articleAge === 'older');

                        // Filtre par recherche
                        let searchMatch = true;
                        if (this.searchQuery.length > 0) {
                            const query = this.searchQuery.toLowerCase();
                            const title = element.dataset.articleTitle;
                            const excerpt = element.dataset.articleExcerpt;
                            searchMatch = title.includes(query) || excerpt.includes(query);
                        }

                        return ageMatch && searchMatch;
                    });
                },

                isArticleVisible(index) {
                    const element = document.querySelector(`[data-article-index="${index}"]`);
                    if (!element) return false;
                    
                    const articleAge = element.dataset.articleAge;
                    const ageMatch = this.activeFilter === 'all' || 
                                    (this.activeFilter === 'recent' && articleAge === 'recent') ||
                                    (this.activeFilter === 'older' && articleAge === 'older');

                    let searchMatch = true;
                    if (this.searchQuery.length > 0) {
                        const query = this.searchQuery.toLowerCase();
                        const title = element.dataset.articleTitle;
                        const excerpt = element.dataset.articleExcerpt;
                        searchMatch = title.includes(query) || excerpt.includes(query);
                    }

                    return ageMatch && searchMatch;
                },

                getArticleCountByStatus(status) {
                    const articleElements = document.querySelectorAll('[data-article-index]');
                    return Array.from(articleElements).filter(element => {
                        const articleAge = element.dataset.articleAge;
                        return status === 'all' || 
                               (status === 'recent' && articleAge === 'recent') ||
                               (status === 'older' && articleAge === 'older');
                    }).length;
                },

                resetFilters() {
                    this.activeFilter = 'all';
                    this.searchQuery = '';
                    this.filterArticles();
                }
            }
        }
    </script>
</x-layouts.main> 