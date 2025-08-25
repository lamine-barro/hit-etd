<x-layouts.email>
    <h1>Candidature Expert reçue</h1>
    
    <p>Bonjour {{ $expert->name }},</p>
    
    <p>Nous avons bien reçu votre candidature pour rejoindre notre réseau d'experts au Hub Ivoire Tech. Nous vous remercions de votre intérêt pour notre communauté d'innovation.</p>
    
    @if($expert->id)
    <div class="code-box">
        <p style="margin: 0; color: #FF6B35; font-size: 18px; font-weight: 600;">
            Référence : #EXP{{ str_pad($expert->id, 4, '0', STR_PAD_LEFT) }}
        </p>
    </div>
    @endif
    
    <div class="info-box">
        <h4>Récapitulatif de votre candidature</h4>
        <p><strong>Email :</strong> {{ $expert->email }}</p>
        @if($expert->phone)
        <p><strong>Téléphone :</strong> {{ $expert->phone }}</p>
        @endif
        @if($expert->specialties && is_array($expert->specialties) && count($expert->specialties) > 0)
        <p><strong>Domaines d'expertise :</strong></p>
        <ul style="margin-top: 8px;">
            @foreach($expert->specialties as $specialty)
            <li>{{ ucfirst(str_replace('_', ' ', $specialty)) }}</li>
            @endforeach
        </ul>
        @endif
        @if($expert->intervention_frequency)
        <p><strong>Fréquence d'intervention :</strong> {{ ucfirst($expert->intervention_frequency) }}</p>
        @endif
    </div>
    
    <h3>Prochaines étapes :</h3>
    <ol>
        <li>Évaluation de votre profil (5-7 jours ouvrés)</li>
        <li>Vérification de vos compétences et références</li>
        <li>Entretien avec notre équipe si votre profil est retenu</li>
        <li>Intégration dans notre pool d'experts agréés</li>
    </ol>
    
    <div class="alert alert-info">
        <strong>Information :</strong><br>
        Pendant ce temps, n'hésitez pas à visiter notre site web pour découvrir nos actualités et événements à venir.
    </div>
    
    <div class="divider"></div>
    
    <p>Nous vous remercions pour votre volonté de partager votre expertise avec notre communauté.</p>
    
    <p style="margin-bottom: 0;">
        Cordialement,<br>
        <strong>L'équipe Hub Ivoire Tech</strong>
    </p>
</x-layouts.email>