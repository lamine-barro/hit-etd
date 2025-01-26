@extends('layouts.app')

@section('title', $pageTitle)
@section('meta_description', $metaDescription)

@section('content')
    <div class="bg-gray-50 py-12 sm:py-16 lg:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- En-tête -->
            <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                <h1 class="text-4xl font-bold text-gray-900 sm:text-5xl">Actualités</h1>
                <p class="mt-4 text-xl text-gray-600">
                    Restez informé des dernières nouvelles et événements du Hub Ivoire Tech
                </p>
            </div>

            <!-- Grille des actualités -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($news as $article)
                    <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <div class="aspect-w-16 aspect-h-9">
                            <img src="{{ asset($article['image']) }}" 
                                 alt="{{ $article['title'] }}" 
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="p-6">
                            <time datetime="{{ $article['date'] }}" class="text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($article['date'])->locale('fr')->isoFormat('LL') }}
                            </time>
                            <h2 class="mt-2 text-xl font-semibold text-gray-900 line-clamp-2">
                                {{ $article['title'] }}
                            </h2>
                            <p class="mt-3 text-base text-gray-600 line-clamp-3">
                                {{ $article['excerpt'] }}
                            </p>
                            <div class="mt-6">
                                <a href="#" class="inline-flex items-center text-primary-600 hover:text-primary-700">
                                    Lire la suite
                                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Pagination (à implémenter plus tard) -->
            <div class="mt-12 flex justify-center">
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <span class="sr-only">Précédent</span>
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">1</a>
                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">2</a>
                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">3</a>
                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <span class="sr-only">Suivant</span>
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </nav>
            </div>
        </div>
    </div>

    <!-- Newsletter Section -->
    @include('components.newsletter')
@endsection 