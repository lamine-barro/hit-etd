<x-layouts.email>
    <h1>Demande de partenariat reçue</h1>
    
    <p>Bonjour {{ $partnership->representative_name }},</p>
    <p>Votre demande de partenariat avec le Hub Ivoire Tech a été reçue avec succès.</p>
    
    @if($partnership->id)
    <div style="background-color: #f0f9ff; border: 1px solid #bfdbfe; border-radius: 6px; padding: 20px; margin: 20px 0; text-align: center;">
        <p style="margin: 0; color: #1d4ed8; font-weight: 600;">Référence : #PART{{ str_pad($partnership->id, 4, '0', STR_PAD_LEFT) }}</p>
    </div>
    @endif
    
    <div style="background-color: #f7fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 20px; margin: 20px 0;">
        <h3 style="color: #2d3748; margin: 0 0 15px 0;">Récapitulatif</h3>
        <p><strong>Type :</strong> {{ $partnership->partnership_type ? ucfirst($partnership->partnership_type) : 'Non spécifié' }}</p>
        <p><strong>Organisation :</strong> {{ $partnership->organization_name }}</p>
        <p><strong>Email :</strong> {{ $partnership->email }}</p>
        @if($partnership->phone)
        <p><strong>Téléphone :</strong> {{ $partnership->phone }}</p>
        @endif
    </div>
    
    @if($partnership->message)
    <div style="background-color: #fef5e7; border: 1px solid #f6ad55; border-radius: 6px; padding: 20px; margin: 20px 0;">
        <h3 style="color: #744210; margin: 0 0 10px 0;">Votre message</h3>
        <p>{{ $partnership->message }}</p>
    </div>
    @endif
    
    <p><strong>Prochaines étapes :</strong></p>
    <p>• Analyse de votre proposition (7-10 jours)<br>
    • Discussion sur les modalités de collaboration<br>
    • Formalisation de l'accord de partenariat</p>
    
    <p>Nous sommes ravis de votre intérêt pour collaborer avec notre écosystème.</p>
    
    <p>Cordialement,<br>L'équipe Hub Ivoire Tech</p>
</x-layouts.email>