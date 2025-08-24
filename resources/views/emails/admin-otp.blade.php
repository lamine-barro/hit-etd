<x-layouts.email>
    <h1>Code d'accès administrateur</h1>
    
    <p>Bonjour {{ $adminName }},</p>
    
    <p>Voici votre code d'accès à l'administration :</p>
    
    <div class="otp-code">{{ $otpCode }}</div>
    
    <div class="warning">
        <strong>Important :</strong> Ce code expire dans 10 minutes. Si vous n'avez pas demandé ce code, ignorez cet email.
    </div>
    
    <p>Cordialement,<br>L'équipe Hub Ivoire Tech</p>
</x-layouts.email>