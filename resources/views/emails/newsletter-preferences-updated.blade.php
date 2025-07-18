@component('mail::message')
# Vos préférences ont été mises à jour avec succès !

Cher·e {{ $name }},

Nous vous confirmons que vos préférences de newsletter ont été mises à jour avec succès. Voici un récapitulatif de vos nouveaux paramètres :

## Vos nouvelles préférences de communication
- Newsletter par email : {{ $newsletter_email ? 'Activée' : 'Désactivée' }}
- Newsletter par WhatsApp : {{ $newsletter_whatsapp ? 'Activée' : 'Désactivée' }}

@if(count($interests) > 0)
## Vos centres d'intérêt mis à jour
@foreach($interests as $interest)
- {{ $interest }}
@endforeach
@endif

Ces modifications prendront effet immédiatement. Vous recevrez désormais nos communications selon vos nouvelles préférences.

Si vous souhaitez modifier à nouveau vos préférences ou vous désinscrire, vous pouvez nous contacter à tout moment.

@component('mail::button', ['url' => config('app.url')])
Visiter notre site
@endcomponent

Merci de votre fidélité et de votre confiance,<br>
{{ config('app.name') }}

---
<small>Si vous n'avez pas effectué cette modification, veuillez nous contacter immédiatement.</small>
@endcomponent 