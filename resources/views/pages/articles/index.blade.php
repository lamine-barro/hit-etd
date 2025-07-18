<x-layouts.main>
    <x-slot:title>{{ $pageTitle }}</x-slot:title>
    <x-slot:metaDescription>{{ $metaDescription }}</x-slot:metaDescription>

    <div class="bg-gray-50 py-12 sm:py-16 lg:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- En-tête -->
            <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                <h1 class="text-4xl font-bold text-gray-900 sm:text-5xl">{{ __("Actualités") }}</h1>
                <p class="mt-4 text-xl text-gray-600">
                    {{ __("Restez informé des dernières nouvelles et événements du Hub Ivoire Tech") }}
                </p>
            </div>

            <!-- Grille des actualités -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($news as $article)
                    <x-articles.card :article="$article" />
                @endforeach
            </div>

            <!-- Pagination -->
            @if($news->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $news->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layouts.main> 