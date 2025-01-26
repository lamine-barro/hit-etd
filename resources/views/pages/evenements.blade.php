@extends('layouts.app')

@section('title', 'Événements')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-8">Nos Événements</h1>
        
        <!-- Événements Grid Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Événement cards will go here -->
        </div>
    </div>

    <!-- Newsletter Section -->
    @include('components.newsletter')
@endsection 