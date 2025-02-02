@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-b from-gray-50 to-white">
    <!-- Hero Section -->
    <div class="pt-24 pb-16 sm:pt-32 sm:pb-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-6">
                    {{ __('Soutenez l\'innovation en Afrique') }}
                </h1>
                <p class="text-xl text-gray-600 mb-8">
                    {{ __('Participez au développement de l\'écosystème tech africain en soutenant les startups innovantes.') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Impact Section -->
    <div class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">
                    {{ __('Votre impact') }}
                </h2>
                
                <div class="grid gap-8 md:grid-cols-2">
                    <!-- Impact Card 1 -->
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                        <div class="flex items-start gap-4">
                            <div class="p-3 bg-primary-100 rounded-lg">
                                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                    {{ __('Accélération des startups') }}
                                </h3>
                                <p class="text-gray-600">
                                    {{ __('Permettez aux startups de bénéficier de ressources et d\'accompagnement pour accélérer leur croissance.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Impact Card 2 -->
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                        <div class="flex items-start gap-4">
                            <div class="p-3 bg-primary-100 rounded-lg">
                                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                    {{ __('Création d\'emplois') }}
                                </h3>
                                <p class="text-gray-600">
                                    {{ __('Contribuez à la création d\'emplois qualifiés et au développement économique local.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Impact Card 3 -->
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                        <div class="flex items-start gap-4">
                            <div class="p-3 bg-primary-100 rounded-lg">
                                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                    {{ __('Innovation technologique') }}
                                </h3>
                                <p class="text-gray-600">
                                    {{ __('Soutenez le développement de solutions innovantes pour répondre aux défis locaux.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Impact Card 4 -->
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                        <div class="flex items-start gap-4">
                            <div class="p-3 bg-primary-100 rounded-lg">
                                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                    {{ __('Rayonnement international') }}
                                </h3>
                                <p class="text-gray-600">
                                    {{ __('Participez au rayonnement de la Côte d\'Ivoire sur la scène tech internationale.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="py-16 bg-gradient-to-r from-primary-600 to-primary-700">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-white mb-6">
                    {{ __('Prêt à nous soutenir ?') }}
                </h2>
                <p class="text-lg text-primary-100 mb-8">
                    {{ __('Contactez-nous pour discuter des différentes possibilités de soutien et devenir partenaire de l\'innovation.') }}
                </p>
                <a href="mailto:hello@hubivoiretech.ci" class="inline-flex items-center px-6 py-3 text-lg font-semibold rounded-lg text-primary-700 bg-white hover:bg-primary-50 transition-all duration-300 shadow-md hover:shadow-xl transform hover:-translate-y-0.5">
                    {{ __('Contactez-nous') }}
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 