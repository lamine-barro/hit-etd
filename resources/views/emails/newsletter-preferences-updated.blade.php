<x-layouts.email>
    <h1>Préférences mises à jour</h1>
    
    <p>Bonjour {{ $name }},</p>
    <p>Vos préférences de newsletter ont été mises à jour avec succès.</p>
    
    <div style="background-color: #f7fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 20px; margin: 20px 0;">
        <h3 style="color: #2d3748; margin: 0 0 15px 0;">Nouvelles préférences</h3>
        <p><strong>Email :</strong> {{ $newsletter_email ? 'Activé' : 'Désactivé' }}</p>
        <p><strong>WhatsApp :</strong> {{ $newsletter_whatsapp ? 'Activé' : 'Désactivé' }}</p>
        
        @if(count($interests) > 0)
        <p><strong>Centres d'intérêt :</strong> {{ implode(', ', $interests) }}</p>
        @endif
    </div>
    
    <p>Ces modifications sont effectives immédiatement.</p>
    
    <div style="background-color: #fef5e7; border: 1px solid #f6ad55; border-radius: 6px; padding: 16px; margin: 20px 0;">
        <p style="margin: 0; color: #744210; font-size: 14px;">Si vous n'avez pas effectué cette modification, contactez-nous immédiatement.</p>
    </div>
    
    <p>Merci de votre confiance,<br>L'équipe Hub Ivoire Tech</p>
</x-layouts.email> 