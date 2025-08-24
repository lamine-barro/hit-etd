<x-layouts.email>
    <h1>Bienvenue sur Hub Ivoire Tech !</h1>
    
    <p>Bonjour {{ $resident->name }},</p>
    <p>Votre candidature a été approuvée et votre compte résident est maintenant activé.</p>
    
    <div style="background-color: #f7fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 20px; margin: 20px 0;">
        <h3 style="color: #2d3748; margin: 0 0 15px 0;">Informations de connexion</h3>
        <p><strong>Email :</strong> {{ $resident->email }}</p>
        <p>La connexion se fait par code OTP envoyé par email à chaque connexion.</p>
    </div>
    
    <p><strong>Vos nouveaux accès :</strong></p>
    <p>• Réserver des espaces de travail<br>
    • Consulter le calendrier des événements<br>
    • Mettre à jour votre profil<br>
    • Accéder aux services du hub</p>
    
    <p>Bienvenue dans la communauté Hub Ivoire Tech !</p>
    
    <p>Cordialement,<br>L'équipe Hub Ivoire Tech</p>
</x-layouts.email>
