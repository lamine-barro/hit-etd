@extends('layouts.dashboard')

@section('title', 'Configuration')

@section('content')
<div class="row">
    <!-- Configuration générale -->
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="mb-0">Configuration générale</h5>
                <small class="text-muted">Paramètres principaux du site</small>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.config.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nom du site</label>
                        <input type="text" class="form-control" name="site_name" value="{{ config('site.name', 'Hub Ivoire Tech') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email de contact</label>
                        <input type="email" class="form-control" name="contact_email" value="{{ config('site.contact_email', 'hello@hubivoiretech.ci') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Téléphone</label>
                        <input type="tel" class="form-control" name="contact_phone" value="{{ config('site.contact_phone') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Adresse</label>
                        <textarea class="form-control" name="address" rows="2">{{ config('site.address') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Enregistrer
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Réseaux sociaux -->
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="mb-0">Réseaux sociaux</h5>
                <small class="text-muted">Liens vers vos réseaux sociaux</small>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.config.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-facebook me-1"></i> Facebook
                        </label>
                        <input type="url" class="form-control" name="social_facebook" value="{{ config('site.social_facebook') }}" placeholder="https://facebook.com/...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-twitter-x me-1"></i> Twitter
                        </label>
                        <input type="url" class="form-control" name="social_twitter" value="{{ config('site.social_twitter') }}" placeholder="https://twitter.com/...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-linkedin me-1"></i> LinkedIn
                        </label>
                        <input type="url" class="form-control" name="social_linkedin" value="{{ config('site.social_linkedin') }}" placeholder="https://linkedin.com/...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-instagram me-1"></i> Instagram
                        </label>
                        <input type="url" class="form-control" name="social_instagram" value="{{ config('site.social_instagram') }}" placeholder="https://instagram.com/...">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Enregistrer
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- SEO -->
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="mb-0">SEO</h5>
                <small class="text-muted">Optimisation pour les moteurs de recherche</small>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.config.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Titre par défaut</label>
                        <input type="text" class="form-control" name="seo_title" value="{{ config('site.seo_title') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description par défaut</label>
                        <textarea class="form-control" name="seo_description" rows="3">{{ config('site.seo_description') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mots-clés</label>
                        <input type="text" class="form-control" name="seo_keywords" value="{{ config('site.seo_keywords') }}" placeholder="mot-clé1, mot-clé2, ...">
                        <small class="text-muted">Séparez les mots-clés par des virgules</small>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Enregistrer
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Maintenance -->
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="mb-0">Maintenance</h5>
                <small class="text-muted">Mode maintenance du site</small>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.config.update') }}" method="POST">
                    @csrf
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="maintenance_mode" id="maintenanceMode" {{ config('site.maintenance_mode') ? 'checked' : '' }}>
                        <label class="form-check-label" for="maintenanceMode">Activer le mode maintenance</label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Message de maintenance</label>
                        <textarea class="form-control" name="maintenance_message" rows="3">{{ config('site.maintenance_message') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Enregistrer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 