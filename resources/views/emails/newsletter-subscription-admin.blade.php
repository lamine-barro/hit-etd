@component('mail::message')
# Nouvelle inscription à la newsletter

Un nouveau membre vient de s'inscrire à la newsletter du Hub Ivoire Tech.

## Informations du membre
**Nom :** {{ $name }}
**Email :** {{ $email }}
@if($whatsapp)
**WhatsApp :** {{ $whatsapp }}
@endif

## Préférences de communication
- Newsletter par email : {{ $newsletter_email ? 'Oui' : 'Non' }}
- Newsletter par WhatsApp : {{ $newsletter_whatsapp ? 'Oui' : 'Non' }}

@if(count($interests) > 0)
## Centres d'intérêt
@foreach($interests as $interest)
- {{ $interest }}
@endforeach
@endif

Cordialement,<br>
{{ config('app.name') }}
@endcomponent
