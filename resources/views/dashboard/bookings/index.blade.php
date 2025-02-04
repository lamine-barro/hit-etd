@extends('layouts.dashboard')

@section('title', 'Réservations')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-0">Liste des réservations</h5>
            <small class="text-muted">Gérez les demandes de visite du campus</small>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-light">
                    <tr>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Date souhaitée</th>
                        <th>Message</th>
                        <th>Date de demande</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                    <tr>
                        <td>{{ $booking->firstname }}</td>
                        <td>{{ $booking->lastname }}</td>
                        <td>{{ $booking->email }}</td>
                        <td>{{ $booking->phone }}</td>
                        <td>{{ $booking->date->format('d/m/Y') }} à {{ $booking->time }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#messageModal{{ $booking->id }}">
                                <i class="bi bi-eye text-primary"></i>
                            </button>
                        </td>
                        <td>{{ $booking->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-light" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')">
                                        <i class="bi bi-trash text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal pour afficher le message -->
                    <div class="modal fade" id="messageModal{{ $booking->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Message de {{ $booking->firstname }} {{ $booking->lastname }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="mb-0">{{ $booking->message }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            <i class="bi bi-calendar-x display-4 d-block mb-3"></i>
                            Aucune réservation trouvée
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($bookings->hasPages())
    <div class="card-footer">
        <div class="d-flex justify-content-between align-items-center">
            <small class="text-muted">
                Affichage de {{ $bookings->firstItem() ?? 0 }} à {{ $bookings->lastItem() ?? 0 }} sur {{ $bookings->total() }} réservations
            </small>
            {{ $bookings->links() }}
        </div>
    </div>
    @endif
</div>
@endsection
