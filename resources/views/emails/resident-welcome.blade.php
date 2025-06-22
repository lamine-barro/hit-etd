@component('mail::message')
Bonjour {{ $resident->name }},<br><br>

Nous avons le plaisir de vous informer que votre compte a été créé avec succès sur notre plateforme.<br>
Vous pouvez dès à présent vous connecter en utilisant les identifiants suivants :<br>
<br>
Identifiant : {{ $resident->email }}<br>
Mot de passe : {{ $password }}<br>
<br><br>
Pour vous connecter, veuillez cliquer sur le lien suivant :<br>

[Se connecter à votre compte]({{ route('filament.resident.auth.login') }})<br>
<br><br>
Si vous avez des questions ou avez besoin d'assistance, n'hésitez pas à nous contacter.
<br><br>
Cordialement,<br>
L'équipe de Hub Ivoire Tech<br>
<br><br>
---<br>
This email was sent to {{ $resident->email }}.<br>
If you did not create an account, please ignore this email.<br>
Vous pouvez vous désinscrire de ces notifications en modifiant vos préférences dans votre compte.<br>
---<br>
<br><br>
@endcomponent
