<x-layouts.email>
    <h1>Nouvelle demande de visite</h1>
    
    <p>Équipe administrative,</p>
    
    <p>Une nouvelle demande de visite du campus vient d'être soumise et nécessite votre attention.</p>
    
    <div class="alert alert-info">
        <strong>Date demandée :</strong> {{ $date }} à {{ $time ?? 'Non spécifiée' }}
    </div>
    
    <div class="info-box">
        <h4>Informations du visiteur</h4>
        <p><strong>Nom complet :</strong> {{ $name }}</p>
        <p><strong>Email :</strong> <a href="mailto:{{ $email }}">{{ $email }}</a></p>
        <p><strong>Téléphone :</strong> <a href="tel:{{ $phone }}">{{ $phone }}</a></p>
    </div>
    
    <div class="info-box">
        <h4>Détails de la visite</h4>
        <p><strong>Date souhaitée :</strong> {{ $date }}</p>
        <p><strong>Heure souhaitée :</strong> {{ $time ?? 'Non spécifiée' }}</p>
        <p><strong>Objet de la visite :</strong> {{ ucfirst(str_replace('_', ' ', $purpose)) }}</p>
        <p><strong>Espaces à visiter :</strong></p>
        <ul style="margin-top: 8px;">
            @foreach($spaces as $space)
            <li>{{ ucfirst(str_replace('_', ' ', $space)) }}</li>
            @endforeach
        </ul>
    </div>
    
    @if($visitor_message)
    <div class="info-box" style="background-color: #fffaf0; border-left: 4px solid #ff9800;">
        <h4>Message du visiteur</h4>
        <p style="font-style: italic; color: #666666;">{{ $visitor_message }}</p>
    </div>
    @endif
    
    <h3>Actions requises :</h3>
    <ol>
        <li>Vérifier la disponibilité à la date demandée</li>
        <li>Confirmer ou proposer une autre date au visiteur</li>
        <li>Préparer l'accueil et la visite guidée</li>
        <li>Mettre à jour le statut dans le système</li>
    </ol>
    
    <div class="alert alert-warning">
        <strong>Rappel :</strong><br>
        Merci de traiter cette demande dans les 24-48 heures pour assurer une bonne expérience visiteur.
    </div>
    
    <div style="text-align: center; margin: 32px 0;">
        <a href="{{ config('app.url') }}/admin/bookings" class="btn">
            Gérer les réservations
        </a>
    </div>
    
    <div class="divider"></div>
    
    <p style="margin-bottom: 0;">
        Bonne journée,<br>
        <strong>Système de réservation Hub Ivoire Tech</strong>
    </p>
</x-layouts.email>