@extends('layouts.dashboard')

@section('title', 'Gestion des événements')

@section('content')
<div class="container px-6 mx-auto" x-data="eventsList">
    <!-- En-tête avec actions -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-2">Événements</h1>
            <p class="text-muted">Gérez vos événements et suivez leurs inscriptions</p>
        </div>
        <a href="{{ route('events.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Créer un événement
        </a>
    </div>

    <!-- Filtres et recherche -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <!-- Recherche -->
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" placeholder="Rechercher un événement..."
                               x-model="filters.search" @input.debounce.300ms="applyFilters()">
                    </div>
                </div>

                <!-- Type d'événement -->
                <div class="col-md-3">
                    <select class="form-select" x-model="filters.type" @change="applyFilters()">
                        <option value="">Tous les types</option>
                        <template x-for="type in eventTypes" :key="type.value">
                            <option :value="type.value" x-text="type.label"></option>
                        </template>
                    </select>
                </div>

                <!-- Statut -->
                <div class="col-md-3">
                    <select class="form-select" x-model="filters.status" @change="applyFilters()">
                        <option value="">Tous les statuts</option>
                        <option value="draft">Brouillon</option>
                        <option value="published">Publié</option>
                        <option value="cancelled">Annulé</option>
                    </select>
                </div>

                <!-- Format -->
                <div class="col-md-2">
                    <select class="form-select" x-model="filters.format" @change="applyFilters()">
                        <option value="">Tous les formats</option>
                        <option value="0">Présentiel</option>
                        <option value="1">En ligne</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des événements -->
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 px-4 py-3">Événement</th>
                            <th class="border-0 px-4 py-3">Date</th>
                            <th class="border-0 px-4 py-3">Lieu</th>
                            <th class="border-0 px-4 py-3">Inscriptions</th>
                            <th class="border-0 px-4 py-3">Statut</th>
                            <th class="border-0 px-4 py-3 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $event)
                        <tr>
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center">
                                    @if($event->illustration)
                                        <img src="{{ asset('storage/' . $event->illustration) }}"
                                             class="rounded" style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                        <div class="rounded bg-light d-flex align-items-center justify-content-center"
                                             style="width: 40px; height: 40px;">
                                            <i class="bi bi-calendar-event text-muted"></i>
                                        </div>
                                    @endif
                                    <div class="ms-3">
                                        <h6 class="mb-1">{{ $event->title }}</h6>
                                        <span class="badge bg-secondary">{{ $event->type }}</span>
                                        @if($event->is_paid)
                                            <span class="badge bg-success ms-1">{{ number_format($event->price, 0, ',', ' ') }} {{ $event->currency }}</span>
                                        @else
                                            <span class="badge bg-info ms-1">Gratuit</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="small">
                                    <div class="mb-1">
                                        <i class="bi bi-calendar2-check text-success me-1"></i>
                                        {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y H:i') }}
                                    </div>
                                    @if($event->end_date)
                                    <div class="text-muted">
                                        <i class="bi bi-calendar2-x text-danger me-1"></i>
                                        {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y H:i') }}
                                    </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center">
                                    <i class="bi {{ $event->is_remote ? 'bi-laptop' : 'bi-geo-alt' }} me-2"></i>
                                    <span>{{ $event->location }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <strong>{{ $event->EventRegistrations_count }}</strong>
                                        @if($event->max_participants > 0)
                                            <span class="text-muted">/{{ $event->max_participants }}</span>
                                        @endif
                                    </div>
                                    @if($event->max_participants > 0)
                                        @php
                                            $percentage = ($event->EventRegistrations_count / $event->max_participants) * 100;
                                            $progressClass = $percentage >= 90 ? 'danger' : ($percentage >= 70 ? 'warning' : 'success');
                                        @endphp
                                        <div class="progress" style="width: 100px; height: 6px;">
                                            <div class="progress-bar bg-{{ $progressClass }}"
                                                 role="progressbar"
                                                 style="width: {{ $percentage }}%">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                @php
                                    $statusClass = [
                                        'draft' => 'bg-secondary',
                                        'published' => 'bg-success',
                                        'cancelled' => 'bg-danger'
                                    ][$event->status];

                                    $statusLabel = [
                                        'draft' => 'Brouillon',
                                        'published' => 'Publié',
                                        'cancelled' => 'Annulé'
                                    ][$event->status];
                                @endphp
                                <span class="badge {{ $statusClass }}">{{ $statusLabel }}</span>
                            </td>
                            <td class="px-4 py-3 text-end">
                                <div class="btn-group">
                                    <a href="{{ route('events.show', $event) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('events.edit', $event) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-sm btn-outline-danger"
                                            @click="confirmDelete({{ $event->id }})">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="bi bi-calendar2-x display-4"></i>
                                    <p class="mt-2">Aucun événement trouvé</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($events->hasPages())
        <div class="card-footer bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    Affichage de {{ $events->firstItem() }} à {{ $events->lastItem() }} sur {{ $events->total() }} événements
                </div>
                {{ $events->links() }}
            </div>
        </div>
        @endif
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
                    Êtes-vous sûr de vouloir supprimer cet événement ? Cette action est irréversible.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                    <form :action="deleteUrl" method="POST" style="display: inline;">
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
    Alpine.data('eventsList', () => ({
        deleteModal: null,
        deleteUrl: '',
        filters: {
            search: '',
            type: '',
            status: '',
            format: ''
        },
        eventTypes: [
            { value: 'masterclass', label: 'Masterclass' },
            { value: 'webinaire', label: 'Webinaire' },
            { value: 'atelier', label: 'Atelier' },
            { value: 'conference', label: 'Conférence' },
            { value: 'hackathon', label: 'Hackathon' },
            { value: 'pitch', label: 'Pitch' },
            { value: 'afterwork', label: 'Afterwork' },
            { value: 'autre', label: 'Autre' }
        ],

        init() {
            this.deleteModal = new bootstrap.Modal(this.$refs.deleteModal);
        },

        confirmDelete(eventId) {
            this.deleteUrl = `{{ route('events.destroy', '') }}/${eventId}`;
            this.deleteModal.show();
        },

        applyFilters() {
            // Construire l'URL avec les filtres
            const params = new URLSearchParams();

            if (this.filters.search) params.append('search', this.filters.search);
            if (this.filters.type) params.append('type', this.filters.type);
            if (this.filters.status) params.append('status', this.filters.status);
            if (this.filters.format) params.append('format', this.filters.format);

            // Rediriger avec les filtres
            window.location.href = `${window.location.pathname}?${params.toString()}`;
        }
    }));
});
</script>

<style>
/* Style pour le hover des lignes du tableau */
.table-hover tbody tr:hover {
    background-color: rgba(var(--bs-primary-rgb), 0.05);
}

/* Style pour les boutons d'action */
.btn-group .btn {
    padding: 0.25rem 0.5rem;
}

/* Style pour la pagination */
.pagination {
    margin-bottom: 0;
}

/* Animation pour les badges */
.badge {
    transition: all 0.2s ease-in-out;
}
.badge:hover {
    transform: scale(1.05);
}

/* Style pour la barre de progression */
.progress {
    background-color: #e9ecef;
    overflow: hidden;
}

/* Style pour l'aperçu des images */
.event-image {
    transition: transform 0.2s ease-in-out;
}
.event-image:hover {
    transform: scale(1.05);
}
</style>
@endpush
@endsection
