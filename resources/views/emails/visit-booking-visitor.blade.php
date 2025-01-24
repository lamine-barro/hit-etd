@component('mail::message')
# Confirmation de votre demande de visite

Cher(e) {{ $name }},

Nous avons bien reçu votre demande de visite du Hub Ivoire Tech. Voici un récapitulatif de votre réservation :

**Date de la visite :** {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}  
**Heure :** {{ $time }}  
**Objet :** {{ ucfirst($purpose) }}

**Espaces que vous souhaitez visiter :**
@foreach($spaces as $space)
- {{ ucfirst($space) }}
@endforeach

Notre équipe examinera votre demande et vous contactera dans les plus brefs délais pour confirmer votre visite.

@component('mail::panel')
**Important :** Si vous devez modifier ou annuler votre visite, veuillez nous contacter au +225 XX XX XX XX ou par email à contact@hubivoiretech.ci
@endcomponent

@component('mail::button', ['url' => route('home')])
Visiter notre site
@endcomponent

Merci de votre intérêt pour Hub Ivoire Tech !

Cordialement,<br>
L'équipe Hub Ivoire Tech
@endcomponent 