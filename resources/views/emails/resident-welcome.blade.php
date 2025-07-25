<x-layouts.email title="Bienvenue sur Hub Ivoire Tech !">
    <p>Bonjour <strong>{{ $resident->name }}</strong>,</p>
    <p>Nous avons le plaisir de vous informer que votre candidature a été <strong>approuvée</strong> et que votre compte résident a été activé avec succès sur notre plateforme.</p>
    
    <h2>Connexion à votre espace résident</h2>
    <p>Votre identifiant de connexion : <strong>{{ $resident->email }}</strong></p>
    <p>La connexion à votre espace se fait par <strong>code OTP</strong> (One-Time Password) qui vous sera envoyé par email à chaque connexion pour sécuriser votre compte.</p>
    
    <p style="text-align: center; margin: 30px 0;">
        <a href="{{ route('filament.resident.auth.login') }}" class="button">Accéder à mon espace résident</a>
    </p>

    <h2>Que pouvez-vous faire maintenant ?</h2>
    <ul>
        <li>Réserver des espaces de travail</li>
        <li>Consulter le calendrier des événements</li>
        <li>Mettre à jour votre profil</li>
        <li>Accéder aux services du hub</li>
    </ul>

    <p>Si vous avez des questions ou avez besoin d'assistance, n'hésitez pas à nous contacter.</p>
    <p>Bienvenue dans la communauté Hub Ivoire Tech !</p>
    
    <p>Cordialement,<br>
    <strong>L'équipe Hub Ivoire Tech</strong></p>

    <hr>
    <p style="font-size: 12px; color: #777;"><em>Cet email a été envoyé à {{ $resident->email }}.</em></p>
</x-layouts.email>
