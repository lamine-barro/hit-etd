@extends('layouts.dashboard')

@section('title', 'Gestion des audiences')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-0">Liste des audiences</h5>
            <small class="text-muted">Gérez les types de public cible</small>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAudienceModal">
                <i class="bi bi-plus-circle me-1"></i> Nouvelle audience
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-light">
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Nombre d'utilisateurs</th>
                        <th>Date de création</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($audiences as $audience)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="badge rounded-pill bg-primary-subtle text-primary me-2">
                                    <i class="bi bi-people-fill"></i>
                                </span>
                                {{ $audience->name }}
                            </div>
                        </td>
                        <td>{{ $audience->description }}</td>
                        <td>{{ $audience->users_count ?? 0 }}</td>
                        <td>{{ $audience->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-light" title="Modifier" data-bs-toggle="modal" data-bs-target="#editAudienceModal{{ $audience->id }}">
                                    <i class="bi bi-pencil text-primary"></i>
                                </button>
                                <form action="{{ route('audiences.destroy', $audience) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-light" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette audience ?')">
                                        <i class="bi bi-trash text-danger"></i>
                                    </button>
                                </form>
                            </div>

                            <!-- Modal de modification -->
                            <div class="modal fade" id="editAudienceModal{{ $audience->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Modifier l'audience</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('audiences.update', $audience) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Nom de l'audience</label>
                                                    <input type="text" name="name" class="form-control" value="{{ $audience->name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Description</label>
                                                    <textarea name="description" class="form-control" rows="3" required>{{ $audience->description }}</textarea>
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
                        <td colspan="5" class="text-center py-4 text-muted">
                            <i class="bi bi-people display-4 d-block mb-3"></i>
                            Aucune audience trouvée
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($audiences->hasPages())
    <div class="card-footer">
        <div class="d-flex justify-content-between align-items-center">
            <small class="text-muted">
                Affichage de {{ $audiences->firstItem() ?? 0 }} à {{ $audiences->lastItem() ?? 0 }} sur {{ $audiences->total() }} audiences
            </small>
            {{ $audiences->links() }}
        </div>
    </div>
    @endif
</div>

<!-- Modal d'ajout -->
<div class="modal fade" id="addAudienceModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nouvelle audience</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('audiences.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nom de l'audience</label>
                        <input type="text" name="name" class="form-control" placeholder="Ex: Étudiants, Entrepreneurs..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Décrivez cette audience..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Créer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 