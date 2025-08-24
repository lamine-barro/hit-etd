<x-layouts.email>
    <h1>Inscription confirmée</h1>
    
    <p>Bonjour {{ $name }},</p>
    <p>Votre inscription à notre newsletter est confirmée. Vous recevrez nos actualités et informations sur nos activités.</p>
    
    <div style="background-color: #f7fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 20px; margin: 20px 0;">
        <h3 style="color: #2d3748; margin: 0 0 15px 0;">Vos préférences</h3>
        <p><strong>Email :</strong> {{ $newsletter_email ? 'Activé' : 'Désactivé' }}</p>
        <p><strong>WhatsApp :</strong> {{ $newsletter_whatsapp ? 'Activé' : 'Désactivé' }}</p>
        
        @if(count($interests) > 0)
        <p><strong>Centres d'intérêt :</strong> {{ implode(', ', $interests) }}</p>
        @endif
    </div>
    
    <p>Vous pouvez modifier ces préférences ou vous désinscrire en nous contactant.</p>
    
    <p>Merci de votre confiance,<br>L'équipe Hub Ivoire Tech</p>
</x-layouts.email>
