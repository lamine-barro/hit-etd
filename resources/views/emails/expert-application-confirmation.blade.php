<x-layouts.email>
    <h1>Candidature expert reçue</h1>
    
    <p>Bonjour {{ $expert->name }},</p>
    <p>Votre candidature pour devenir expert au Hub Ivoire Tech a été reçue avec succès.</p>
    
    @if($expert->id)
    <div style="background-color: #f0f9ff; border: 1px solid #bfdbfe; border-radius: 6px; padding: 20px; margin: 20px 0; text-align: center;">
        <p style="margin: 0; color: #1d4ed8; font-weight: 600;">Référence : #EXP{{ str_pad($expert->id, 4, '0', STR_PAD_LEFT) }}</p>
    </div>
    @endif
    
    <div style="background-color: #f7fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 20px; margin: 20px 0;">
        <h3 style="color: #2d3748; margin: 0 0 15px 0;">Récapitulatif</h3>
        <p><strong>Email :</strong> {{ $expert->email }}</p>
        @if($expert->phone)
        <p><strong>Téléphone :</strong> {{ $expert->phone }}</p>
        @endif
        @if($expert->specialties && is_array($expert->specialties) && count($expert->specialties) > 0)
        <p><strong>Spécialités :</strong> {{ implode(', ', array_map(fn($s) => ucfirst(str_replace('_', ' ', $s)), $expert->specialties)) }}</p>
        @endif
        @if($expert->intervention_frequency)
        <p><strong>Fréquence :</strong> {{ ucfirst($expert->intervention_frequency) }}</p>
        @endif
    </div>
    
    <p><strong>Prochaines étapes :</strong></p>
    <p>• Évaluation de votre profil (5-7 jours)<br>
    • Vérification de vos compétences<br>
    • Intégration dans notre pool d'experts</p>
    
    <p>Nous vous remercions pour votre volonté de partager votre expertise.</p>
    
    <p>Cordialement,<br>L'équipe Hub Ivoire Tech</p>
</x-layouts.email>