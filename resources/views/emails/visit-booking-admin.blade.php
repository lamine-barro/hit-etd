@component('mail::message')
# {{ __("Nouvelle demande de visite") }}

{{ __("Une nouvelle demande de visite a été soumise avec les détails suivants :") }}

**{{ __("Informations du visiteur") }} :**
- {{ __("Nom complet") }} : {{ $name }}
- {{ __("Email") }} : {{ $email }}
- {{ __("Téléphone") }} : {{ $phone }}

**{{ __("Détails de la visite") }} :**
- {{ __("Date") }} : {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}
- {{ __("Heure") }} : {{ $time }}
- {{ __("Objet") }} : {{ $purpose }}

**{{ __("Espaces à visiter") }} :**
@foreach($spaces as $space)
- {{ ucfirst($space) }}
@endforeach

@if($message)
**{{ __("Message du visiteur") }} :**
{{ $message }}
@endif

@component('mail::button', ['url' => route('admin.bookings')])
{{ __("Voir toutes les réservations") }}
@endcomponent

{{ __("Cordialement,") }}<br>
{{ config('app.name') }}
@endcomponent
