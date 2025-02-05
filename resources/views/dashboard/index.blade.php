@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">Événements</h5>
                <p class="card-text display-6">{{ $stats['total_events'] }}</p>
                <small>{{ $stats['upcoming_events'] }} événements à venir</small>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">Inscriptions</h5>
                <p class="card-text display-6">{{ $stats['total_EventRegistrations'] }}</p>
                <small>Total des inscriptions aux événements</small>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5 class="card-title">Articles</h5>
                <p class="card-text display-6">{{ $stats['total_articles'] }}</p>
                <small>{{ $stats['published_articles'] }} articles publiés</small>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <h5 class="card-title">Newsletter</h5>
                <p class="card-text display-6">{{ $stats['total_subscribers'] }}</p>
                <small>{{ $stats['email_subscribers'] }} par email, {{ $stats['whatsapp_subscribers'] }} par WhatsApp</small>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Actions rapides
            </div>
            <div class="card-body">
                <div class="d-flex gap-2">
                    <a href="{{ route('events.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Nouvel événement
                    </a>
                    <a href="{{ route('articles.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Nouvel article
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
