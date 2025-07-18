@component('mail::message')
# Bienvenue sur Hub Ivoire Tech !

Bonjour **{{ $resident->name }}**,

Nous avons le plaisir de vous informer que votre candidature a été **approuvée** et que votre compte résident a été activé avec succès sur notre plateforme.

## Connexion à votre espace résident

Votre identifiant de connexion : **{{ $resident->email }}**

La connexion à votre espace se fait par **code OTP** (One-Time Password) qui vous sera envoyé par email à chaque connexion pour sécuriser votre compte.

@component('mail::button', ['url' => route('filament.resident.auth.login')])
🚀 Accéder à mon espace résident
@endcomponent

## Que pouvez-vous faire maintenant ?

- ✅ Réserver des espaces de travail
- ✅ Consulter le calendrier des événements  
- ✅ Mettre à jour votre profil
- ✅ Accéder aux services du hub

Si vous avez des questions ou avez besoin d'assistance, n'hésitez pas à nous contacter.

Bienvenue dans la communauté Hub Ivoire Tech ! 🎉

Cordialement,<br>
**L'équipe Hub Ivoire Tech**

---
*Cet email a été envoyé à {{ $resident->email }}.*
@endcomponent
