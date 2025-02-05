@extends('layouts.dashboard')

@section('title', $event->title)

@section('content')
<div class="container px-6 mx-auto" x-data="eventActions">
    <!-- Bouton retour -->
    <div class="mb-4">
        <a href="{{ route('events.index') }}" class="btn btn-light">
            <i class="bi bi-arrow-left me-2"></i>Retour
        </a>
    </div>

    <!-- En-tête -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-2">{{ $event->title }}</h1>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-secondary">{{ $event->type }}</span>
                @if($event->is_paid)
                    <span class="badge bg-success">{{ number_format($event->price, 0, ',', ' ') }} {{ $event->currency }}</span>
                @else
                    <span class="badge bg-secondary">Gratuit</span>
                @endif
                <span class="badge bg-{{ $event->status === 'published' ? 'success' : ($event->status === 'cancelled' ? 'danger' : 'secondary') }}">
                    {{ $event->status === 'published' ? 'Publié' : ($event->status === 'cancelled' ? 'Annulé' : 'Brouillon') }}
                </span>
            </div>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('events.edit', $event) }}" class="btn btn-primary">
                <i class="bi bi-pencil me-2"></i>Modifier
            </a>
            <button type="button" class="btn btn-danger" @click="confirmDelete">
                <i class="bi bi-trash me-2"></i>Supprimer
            </button>
        </div>
    </div>

    <div class="row">
        <!-- Informations principales -->
        <div class="col-lg-8">
            <!-- Image et Description -->
            <div class="card mb-4">
                <div class="card-body">
                    @if($event->illustration)
                        <img src="{{ asset('storage/' . $event->illustration) }}"
                             alt="{{ $event->title }}"
                             class="img-fluid rounded mb-4"
                             style="width: 100%; height: 300px; object-fit: cover;">
                    @endif
                    <div class="mb-4">
                        <h5 class="card-title border-bottom pb-2">Description</h5>
                        <div class="text-muted">
                            {!! nl2br(e($event->description)) !!}
                        </div>
                    </div>

                    @if($event->external_link)
                        <div class="mt-4">
                            <h6 class="mb-2">Lien externe</h6>
                            <a href="{{ $event->external_link }}" target="_blank" class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-box-arrow-up-right me-2"></i>Accéder au lien
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Liste des inscriptions -->
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Inscriptions</h5>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-download me-2"></i>Exporter
                        </button>
                        @if($event->status === 'published' && (!$event->EventRegistration_end_date || now() <= $event->EventRegistration_end_date))
                            <button type="button" class="btn btn-sm btn-success">
                                <i class="bi bi-plus-circle me-2"></i>Nouvelle inscription
                            </button>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    @if($event->EventRegistrations->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Participant</th>
                                        <th>Date d'inscription</th>
                                        <th>Statut</th>
                                        <th>Paiement</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($event->EventRegistrations as $eventRegistration)
                                        <tr>
                                            <td>{{ $eventRegistration->user->name }}</td>
                                            <td>{{ $eventRegistration->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <span class="badge bg-{{ $eventRegistration->status === 'confirmed' ? 'success' : ($eventRegistration->status === 'cancelled' ? 'danger' : 'secondary') }}">
                                                    {{ $eventRegistration->status }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($event->is_paid)
                                                    <span class="badge bg-{{ $eventRegistration->payment_status === 'completed' ? 'success' : 'secondary' }}">
                                                        {{ $eventRegistration->payment_status }}
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary">N/A</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary">
                                                        <i class="bi bi-envelope"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-outline-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4 text-muted">
                            <i class="bi bi-calendar-x display-4"></i>
                            <p class="mt-2">Aucune inscription pour le moment</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Informations complémentaires -->
        <div class="col-lg-4">
            <!-- Détails de l'événement -->
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Détails</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3">
                            <div class="d-flex align-items-center text-success mb-1">
                                <i class="bi bi-calendar2-check me-2"></i>
                                <strong>Date de début</strong>
                            </div>
                            <span class="text-muted">{{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y H:i') }}</span>
                        </li>
                        @if($event->end_date)
                            <li class="mb-3">
                                <div class="d-flex align-items-center text-danger mb-1">
                                    <i class="bi bi-calendar2-x me-2"></i>
                                    <strong>Date de fin</strong>
                                </div>
                                <span class="text-muted">{{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y H:i') }}</span>
                            </li>
                        @endif
                        <li class="mb-3">
                            <div class="d-flex align-items-center text-secondary mb-1">
                                <i class="bi bi-{{ $event->is_remote ? 'laptop' : 'geo-alt' }} me-2"></i>
                                <strong>Lieu</strong>
                            </div>
                            <span class="text-muted">{{ $event->location }}</span>
                        </li>
                        <li class="mb-3">
                            <div class="d-flex align-items-center text-secondary mb-1">
                                <i class="bi bi-people me-2"></i>
                                <strong>Participants</strong>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="text-muted me-3">
                                    {{ $event->EventRegistrations_count }}
                                    @if($event->max_participants > 0)
                                        / {{ $event->max_participants }}
                                    @endif
                                </span>
                                @if($event->max_participants > 0)
                                    @php
                                        $percentage = ($event->EventRegistrations_count / $event->max_participants) * 100;
                                        $progressClass = $percentage >= 90 ? 'danger' : ($percentage >= 70 ? 'secondary' : 'success');
                                    @endphp
                                    <div class="flex-grow-1">
                                        <div class="progress" style="height: 6px;">
                                            <div class="progress-bar bg-{{ $progressClass }}"
                                                 role="progressbar"
                                                 style="width: {{ $percentage }}%">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </li>
                        @if($event->EventRegistration_end_date)
                            <li class="mb-3">
                                <div class="d-flex align-items-center text-secondary mb-1">
                                    <i class="bi bi-clock me-2"></i>
                                    <strong>Date limite d'inscription</strong>
                                </div>
                                <span class="text-muted">{{ \Carbon\Carbon::parse($event->EventRegistration_end_date)->format('d/m/Y H:i') }}</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            <!-- Options de paiement -->
            @if($event->is_paid)
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Options de paiement</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-3">
                                <div class="d-flex align-items-center text-success mb-1">
                                    <i class="bi bi-cash me-2"></i>
                                    <strong>Prix standard</strong>
                                </div>
                                <span class="text-muted">{{ number_format($event->price, 0, ',', ' ') }} {{ $event->currency }}</span>
                            </li>
                            @if($event->early_bird_price)
                                <li class="mb-3">
                                    <div class="d-flex align-items-center text-secondary mb-1">
                                        <i class="bi bi-gift me-2"></i>
                                        <strong>Prix Early Bird</strong>
                                    </div>
                                    <span class="text-muted">{{ number_format($event->early_bird_price, 0, ',', ' ') }} {{ $event->currency }}</span>
                                    @if($event->early_bird_end_date)
                                        <br>
                                        <small class="text-muted">
                                            Jusqu'au {{ \Carbon\Carbon::parse($event->early_bird_end_date)->format('d/m/Y H:i') }}
                                        </small>
                                    @endif
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal de confirmation de suppression -->
    <div class="modal fade" id="deleteModal" tabindex="-1" x-ref="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Êtes-vous sûr de vouloir supprimer cet événement ? Cette action est irréversible.</p>
                    @if($event->EventRegistrations_count > 0)
                        <div class="alert alert-warning mt-3 mb-0">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            Attention : Cet événement contient {{ $event->EventRegistrations_count }} inscription(s).
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                    <form action="{{ route('events.destroy', $event) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash me-2"></i>Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('eventActions', () => ({
        deleteModal: null,

        init() {
            this.deleteModal = new bootstrap.Modal(this.$refs.deleteModal);
        },

        confirmDelete() {
            this.deleteModal.show();
        }
    }));
});
</script>
@endpush

<style>
.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border: none;
    margin-bottom: 1.5rem;
}

.card-header {
    background-color: transparent;
    border-bottom: 1px solid rgba(0, 0, 0, 0.125);
}

.badge {
    padding: 0.5em 0.75em;
    font-weight: 500;
}

.progress {
    background-color: #e9ecef;
    overflow: hidden;
}

.btn-group .btn {
    padding: 0.25rem 0.5rem;
}

.table > :not(caption) > * > * {
    padding: 1rem;
}

.table-hover tbody tr:hover {
    background-color: rgba(var(--bs-secondary-rgb), 0.05);
}

/* Styles additionnels pour la modale */
.modal-content {
    border: none;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.modal-header {
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}

.modal-footer {
    border-top: 1px solid rgba(0, 0, 0, 0.1);
}

.alert {
    border: none;
}
</style>
@endsection
