<x-layouts.email>
    <h1>Demande de visite confirmée</h1>
    
    <p>Bonjour {{ $name }},</p>
    
    <p>Nous avons bien reçu votre demande de visite du Hub Ivoire Tech. Notre équipe examinera votre demande et vous contactera dans les plus brefs délais.</p>
    
    <div class="code-box">
        <p style="margin: 0; color: #FF6B35; font-size: 18px; font-weight: 600;">
            {{ $date }} à {{ $time }}
        </p>
    </div>
    
    <div class="info-box">
        <h4>Détails de votre visite</h4>
        <p><strong>Nom :</strong> {{ $name }}</p>
        <p><strong>Email :</strong> {{ $email }}</p>
        <p><strong>Téléphone :</strong> {{ $phone }}</p>
        <p><strong>Objet de la visite :</strong> {{ ucfirst(str_replace('_', ' ', $purpose)) }}</p>
        <p><strong>Espaces à visiter :</strong></p>
        <ul style="margin-top: 8px;">
            @foreach($spaces as $space)
            <li>{{ ucfirst(str_replace('_', ' ', $space)) }}</li>
            @endforeach
        </ul>
        @if($visitor_message)
        <p style="margin-top: 12px;"><strong>Votre message :</strong><br>
        <span style="font-style: italic; color: #666666;">{{ $visitor_message }}</span></p>
        @endif
    </div>
    
    <h3>Prochaines étapes :</h3>
    <ol>
        <li>Notre équipe examinera votre demande sous 24-48h</li>
        <li>Nous vous contacterons pour confirmer le rendez-vous</li>
        <li>Vous recevrez un email de confirmation avec tous les détails</li>
        <li>Le jour de la visite, présentez-vous à l'accueil avec une pièce d'identité</li>
    </ol>
    
    <div class="alert alert-warning">
        <strong>Important :</strong><br>
        • Les visites se font uniquement les mardis et jeudis<br>
        • Un préavis de 72 heures minimum est requis<br>
        • La visite est soumise à confirmation par notre équipe
    </div>
    
    <div class="alert alert-info">
        <strong>Adresse :</strong><br>
        Tour POSTEL 2001 - Plateau, Abidjan<br>
        Côte d'Ivoire
    </div>
    
    <div class="divider"></div>
    
    <p>Nous sommes impatients de vous accueillir et de vous faire découvrir notre espace d'innovation.</p>
    
    <p style="margin-bottom: 0;">
        À bientôt,<br>
        <strong>L'équipe Hub Ivoire Tech</strong>
    </p>
</x-layouts.email>