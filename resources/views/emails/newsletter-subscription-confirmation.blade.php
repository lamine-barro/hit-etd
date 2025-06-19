@component('mail::message')
# Bienvenue dans la communauté Hub Ivoire Tech !

Cher·e {{ $name }},

Nous sommes ravis de vous confirmer votre inscription à notre newsletter. Vous recevrez désormais nos actualités et informations importantes concernant nos activités, événements et opportunités.

## Vos préférences de communication
- Newsletter par email : {{ $newsletter_email ? 'Activée' : 'Désactivée' }}
- Newsletter par WhatsApp : {{ $newsletter_whatsapp ? 'Activée' : 'Désactivée' }}

@if(count($interests) > 0)
## Vos centres d'intérêt
@foreach($interests as $interest)
- {{ $interest }}
@endforeach
@endif

Vous pouvez à tout moment modifier vos préférences ou vous désinscrire en nous contactant.

@component('mail::button', ['url' => config('app.url')])
Visiter notre site
@endcomponent

Merci de votre confiance,<br>
{{ config('app.name') }}
@endcomponent
