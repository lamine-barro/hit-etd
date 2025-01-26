@extends('layouts.dashboard')

@section('title', 'Abonnés Newsletter')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-0">Liste des abonnés</h5>
            <small class="text-muted">Gérez les abonnés à la newsletter</small>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exportModal">
                <i class="bi bi-download me-1"></i> Exporter
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-light">
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>WhatsApp</th>
                        <th>Centres d'intérêt</th>
                        <th>Date d'inscription</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subscribers as $subscriber)
                    <tr>
                        <td>{{ $subscriber->name }}</td>
                        <td>{{ $subscriber->email }}</td>
                        <td>{{ $subscriber->whatsapp ?? '-' }}</td>
                        <td>
                            @if(count($subscriber->interests) > 0)
                                @foreach($subscriber->interests as $interest)
                                    <span class="badge bg-primary-subtle text-primary me-1">{{ $interest }}</span>
                                @endforeach
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $subscriber->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-light" title="Modifier" data-bs-toggle="modal" data-bs-target="#editSubscriberModal{{ $subscriber->id }}">
                                    <i class="bi bi-pencil text-primary"></i>
                                </button>
                                <form action="{{ route('audiences.subscribers.destroy', $subscriber) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-light" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet abonné ?')">
                                        <i class="bi bi-trash text-danger"></i>
                                    </button>
                                </form>
                            </div>

                            <!-- Modal de modification -->
                            <div class="modal fade" id="editSubscriberModal{{ $subscriber->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Modifier l'abonné</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('audiences.subscribers.update', $subscriber) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Nom</label>
                                                    <input type="text" name="name" class="form-control" value="{{ $subscriber->name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Email</label>
                                                    <input type="email" name="email" class="form-control" value="{{ $subscriber->email }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">WhatsApp</label>
                                                    <input type="tel" name="whatsapp" class="form-control" value="{{ $subscriber->whatsapp }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Centres d'intérêt</label>
                                                    <div class="d-flex flex-wrap gap-2">
                                                        @foreach(['startups', 'tech', 'events', 'formation'] as $interest)
                                                            <div class="form-check">
                                                                <input type="checkbox" name="interests[]" value="{{ $interest }}" class="form-check-input" id="interest_{{ $subscriber->id }}_{{ $interest }}"
                                                                    {{ in_array($interest, $subscriber->interests) ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="interest_{{ $subscriber->id }}_{{ $interest }}">
                                                                    {{ ucfirst($interest) }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Préférences de notification</label>
                                                    <div class="form-check">
                                                        <input type="checkbox" name="newsletter_email" class="form-check-input" id="newsletter_email_{{ $subscriber->id }}"
                                                            {{ $subscriber->newsletter_email ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="newsletter_email_{{ $subscriber->id }}">
                                                            Newsletter par email
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" name="newsletter_whatsapp" class="form-check-input" id="newsletter_whatsapp_{{ $subscriber->id }}"
                                                            {{ $subscriber->newsletter_whatsapp ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="newsletter_whatsapp_{{ $subscriber->id }}">
                                                            Newsletter par WhatsApp
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            <i class="bi bi-people display-4 d-block mb-3"></i>
                            Aucun abonné trouvé
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($subscribers->hasPages())
    <div class="card-footer">
        <div class="d-flex justify-content-between align-items-center">
            <small class="text-muted">
                Affichage de {{ $subscribers->firstItem() ?? 0 }} à {{ $subscribers->lastItem() ?? 0 }} sur {{ $subscribers->total() }} abonnés
            </small>
            {{ $subscribers->links() }}
        </div>
    </div>
    @endif
</div>

<!-- Modal d'export -->
<div class="modal fade" id="exportModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Exporter les abonnés</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('audiences.subscribers.export') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Format d'export</label>
                        <select name="format" class="form-select">
                            <option value="csv">CSV</option>
                            <option value="xlsx">Excel</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Colonnes à exporter</label>
                        <div class="form-check">
                            <input type="checkbox" name="columns[]" value="name" class="form-check-input" id="col_name" checked>
                            <label class="form-check-label" for="col_name">Nom</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="columns[]" value="email" class="form-check-input" id="col_email" checked>
                            <label class="form-check-label" for="col_email">Email</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="columns[]" value="whatsapp" class="form-check-input" id="col_whatsapp" checked>
                            <label class="form-check-label" for="col_whatsapp">WhatsApp</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="columns[]" value="interests" class="form-check-input" id="col_interests" checked>
                            <label class="form-check-label" for="col_interests">Centres d'intérêt</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="columns[]" value="created_at" class="form-check-input" id="col_created_at" checked>
                            <label class="form-check-label" for="col_created_at">Date d'inscription</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Exporter</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 