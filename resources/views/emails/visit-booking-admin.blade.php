@component('mail::message')
# Nouvelle demande de visite

Une nouvelle demande de visite a été soumise avec les détails suivants :

**Informations du visiteur :**
- Nom complet : {{ $name }}
- Email : {{ $email }}
- Téléphone : {{ $phone }}

**Détails de la visite :**
- Date : {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}
- Heure : {{ $time }}
- Objet : {{ $purpose }}

**Espaces à visiter :**
@foreach($spaces as $space)
- {{ ucfirst($space) }}
@endforeach

@if($message)
**Message du visiteur :**
{{ $message }}
@endif

@component('mail::button', ['url' => route('admin.bookings')])
Voir toutes les réservations
@endcomponent

Cordialement,<br>
{{ config('app.name') }}
@endcomponent 