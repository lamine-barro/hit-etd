@component('mail::message')
# {{ __("Confirmation de votre demande de visite") }}

{{ __("Cher·e") }} {{ $name }},

{{ __("Nous avons bien reçu votre demande de visite du Hub Ivoire Tech. Voici un récapitulatif de votre réservation :") }}

**{{ __("Date de la visite :") }}** {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}
**{{ __("Heure :") }}** {{ $time }}
**{{ __("Objet :") }}** {{ ucfirst($purpose) }}

**{{ __("Espaces que vous souhaitez visiter :") }}**
@foreach($spaces as $space)
- {{ ucfirst($space) }}
@endforeach

{{ __("Notre équipe examinera votre demande et vous contactera dans les plus brefs délais pour confirmer votre visite.") }}

@component('mail::panel')
{{ __("Important : Si vous devez modifier ou annuler votre visite, veuillez nous contacter au +225 XX XX XX XX ou par email à contact@hubivoiretech.ci") }}
@endcomponent

@component('mail::button', ['url' => route('home')])
{{ __("Visiter notre site") }}
@endcomponent

{{ __("Merci de votre intérêt pour Hub Ivoire Tech !") }}

{{ __("Cordialement,") }}<br>
{{ __("L'équipe Hub Ivoire Tech") }}
@endcomponent