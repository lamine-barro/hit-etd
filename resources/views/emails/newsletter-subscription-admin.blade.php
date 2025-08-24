<x-layouts.email>
    <h1>Nouvelle inscription newsletter</h1>
    
    <p>Équipe administrative,</p>
    <p>Un nouveau membre vient de s'inscrire à la newsletter.</p>
    
    <div style="background-color: #f7fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 20px; margin: 20px 0;">
        <h3 style="color: #2d3748; margin: 0 0 15px 0;">Informations</h3>
        <p><strong>Nom :</strong> {{ $name }}</p>
        <p><strong>Email :</strong> {{ $email }}</p>
        @if($whatsapp)
        <p><strong>WhatsApp :</strong> {{ $whatsapp }}</p>
        @endif
    </div>
    
    <div style="background-color: #f7fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 20px; margin: 20px 0;">
        <h3 style="color: #2d3748; margin: 0 0 15px 0;">Préférences</h3>
        <p><strong>Email :</strong> {{ $newsletter_email ? 'Activé' : 'Désactivé' }}</p>
        <p><strong>WhatsApp :</strong> {{ $newsletter_whatsapp ? 'Activé' : 'Désactivé' }}</p>
        
        @if(count($interests) > 0)
        <p><strong>Centres d'intérêt :</strong> {{ implode(', ', $interests) }}</p>
        @endif
    </div>
    
    <p>Cordialement,<br>L'équipe Hub Ivoire Tech</p>
</x-layouts.email>
