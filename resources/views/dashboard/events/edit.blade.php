@extends('layouts.dashboard')

@section('title', 'Modifier l\'événement')

@section('content')
<div class="container px-6 mx-auto">
    <!-- En-tête -->
    <div class="mb-4">
        <a href="{{ route('events.show', $event) }}" class="btn btn-light">
            <i class="bi bi-arrow-left me-2"></i>Retour
        </a>
    </div>

    <div class="card">
        <div class="card-header bg-white">
            <h1 class="h3 mb-0">Modifier l'événement</h1>
        </div>
        <div class="card-body">
            <x-forms.event-form :event="$event" :action="route('events.update', $event)" method="PUT" />
        </div>
    </div>
</div>
@endsection 