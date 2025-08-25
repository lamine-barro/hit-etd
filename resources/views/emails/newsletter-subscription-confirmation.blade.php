<x-layouts.email>
    <h1>Bienvenue dans notre communauté</h1>
    
    <p>Bonjour {{ $name }},</p>
    
    <p>Nous sommes ravis de vous compter parmi les membres de notre communauté. Votre inscription à notre newsletter a été confirmée avec succès.</p>
    
    <div class="info-box">
        <h4>Vos préférences de communication</h4>
        <p><strong>Email :</strong> {{ $newsletter_email ? 'Activé' : 'Désactivé' }}</p>
        <p><strong>WhatsApp :</strong> {{ $newsletter_whatsapp ? 'Activé' : 'Désactivé' }}</p>
        
        @if(count($interests) > 0)
        <p><strong>Centres d'intérêt :</strong></p>
        <ul style="margin-top: 8px;">
            @foreach($interests as $interest)
            <li>{{ $interest }}</li>
            @endforeach
        </ul>
        @endif
    </div>
    
    <h3>Ce que vous allez recevoir :</h3>
    <ul>
        <li>Les dernières actualités du Hub Ivoire Tech</li>
        <li>Des invitations exclusives à nos événements</li>
        <li>Des opportunités de formation et de networking</li>
        <li>Des ressources pour développer vos projets</li>
    </ul>
    
    <div class="alert alert-info">
        <strong>Bon à savoir :</strong><br>
        Vous pouvez modifier vos préférences ou vous désinscrire à tout moment en cliquant sur le lien présent en bas de chaque email.
    </div>
    
    <div class="divider"></div>
    
    <p>Nous sommes impatients de partager avec vous notre passion pour l'innovation et la technologie.</p>
    
    <p style="margin-bottom: 0;">
        À très bientôt,<br>
        <strong>L'équipe Hub Ivoire Tech</strong>
    </p>
</x-layouts.email>