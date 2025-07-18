<x-layouts.main>
    <x-slot:title>{{ __("Accueil") }} - {{ config('app.name') }}</x-slot:title>
    
    <!-- Hero Section -->
    <x-sections.hero />

    <!-- Pourquoi H.I.T Section -->
    <x-sections.why-hit />

    <!-- Services -->
    <x-sections.services />

    <!-- Initiative Gouvernementale -->
    <x-sections.initiative />

    <!-- Partenaires -->
    <x-sections.partners />

    <!-- FAQ -->
    <x-sections.faq />

    <!-- Newsletter -->
    <x-sections.newsletter />
</x-layouts.main> 