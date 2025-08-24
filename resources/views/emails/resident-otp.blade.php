<x-layouts.email>
    <h1>Code de vérification</h1>
    
    <p>Bonjour {{ $userName }},</p>
    
    <p>Voici votre code de vérification pour accéder à votre espace résident :</p>
    
    <div class="otp-code">{{ $otpCode }}</div>
    
    <div class="warning">
        <strong>Important :</strong> Ce code expire dans 10 minutes. Si vous n'avez pas demandé ce code, ignorez cet email.
    </div>
    
    <p>Cordialement,<br>L'équipe Hub Ivoire Tech</p>
</x-layouts.email>