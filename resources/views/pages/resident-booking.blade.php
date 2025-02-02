@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">{{ __('Système de réservation') }}</h1>
            
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">{{ __('Faire une nouvelle réservation') }}</h5>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('resident.bookings.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="facility" class="form-label">{{ __('Installation') }}</label>
                                <select class="form-select" id="facility" name="facility" required>
                                    <option value="">{{ __('Choisir une installation') }}</option>
                                    <option value="salle_reunion">{{ __('Salle de réunion') }}</option>
                                    <option value="salle_conference">{{ __('Salle de conférence') }}</option>
                                    <option value="espace_coworking">{{ __('Espace de coworking') }}</option>
                                </select>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="date" class="form-label">{{ __('Date') }}</label>
                                <input type="date" class="form-control" id="date" name="date" required min="{{ date('Y-m-d') }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="start_time" class="form-label">{{ __('Heure de début') }}</label>
                                <input type="time" class="form-control" id="start_time" name="start_time" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="end_time" class="form-label">{{ __('Heure de fin') }}</label>
                                <input type="time" class="form-control" id="end_time" name="end_time" required>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="purpose" class="form-label">{{ __('Motif de la réservation') }}</label>
                                <textarea class="form-control" id="purpose" name="purpose" rows="3" required></textarea>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Confirmer la réservation') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ __('Mes réservations') }}</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Installation') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Horaire') }}</th>
                                    <th>{{ __('Statut') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookings ?? [] as $booking)
                                    <tr>
                                        <td>{{ $booking->facility }}</td>
                                        <td>{{ $booking->date }}</td>
                                        <td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                                        <td>{{ $booking->status }}</td>
                                        <td>
                                            <form action="{{ route('resident.bookings.destroy', $booking) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('Êtes-vous sûr de vouloir annuler cette réservation ?') }}')">
                                                    {{ __('Annuler') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">{{ __('Aucune réservation trouvée') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 