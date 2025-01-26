@extends('layouts.dashboard')

@section('title', 'Créer un événement')

@section('content')
<div class="container px-6 mx-auto">
    <!-- En-tête -->
    <div class="mb-4">
        <a href="{{ route('events.index') }}" class="btn btn-light">
            <i class="bi bi-arrow-left me-2"></i>Retour
        </a>
    </div>

    <div class="card">
        <div class="card-header bg-white">
            <h1 class="h3 mb-0">Créer un événement</h1>
        </div>
        <div class="card-body">
            <x-forms.event-form :action="route('events.store')" />
        </div>
    </div>
</div>
@endsection

<style>
.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border: none;
}

.form-label {
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.form-control:focus,
.form-select:focus {
    border-color: var(--bs-primary);
    box-shadow: 0 0 0 0.25rem rgba(var(--bs-primary-rgb), 0.25);
}

.form-check-input:checked {
    background-color: var(--bs-primary);
    border-color: var(--bs-primary);
}
</style> 