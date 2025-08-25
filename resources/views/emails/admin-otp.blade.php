<x-layouts.email>
    <h1>Code d'accès administrateur</h1>
    
    <p>Bonjour {{ $adminName }},</p>
    
    <p>Vous avez demandé un code d'accès pour vous connecter à l'interface d'administration de Hub Ivoire Tech.</p>
    
    <p>Voici votre code de vérification :</p>
    
    <div class="code-box">
        <span class="code">{{ $otpCode }}</span>
    </div>
    
    <div class="alert alert-warning">
        <strong>Important :</strong><br>
        Ce code expire dans 10 minutes. Ne le partagez avec personne.
    </div>
    
    <p>Si vous n'avez pas demandé ce code, vous pouvez ignorer cet email en toute sécurité.</p>
    
    <div class="divider"></div>
    
    <p style="margin-bottom: 0;">
        Cordialement,<br>
        <strong>L'équipe Hub Ivoire Tech</strong>
    </p>
</x-layouts.email>