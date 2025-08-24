<x-layouts.email>
    <h1>Nouvelle demande de visite</h1>
    
    <p>Équipe administrative,</p>
    <p>Une nouvelle demande de visite du campus a été soumise.</p>
    
    <div style="background-color: #f7fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 20px; margin: 20px 0;">
        <h3 style="color: #2d3748; margin: 0 0 15px 0;">Visiteur</h3>
        <p><strong>Nom :</strong> {{ $name }}</p>
        <p><strong>Email :</strong> {{ $email }}</p>
        <p><strong>Téléphone :</strong> {{ $phone }}</p>
    </div>
    
    <div style="background-color: #f7fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 20px; margin: 20px 0;">
        <h3 style="color: #2d3748; margin: 0 0 15px 0;">Détails de la visite</h3>
        <p><strong>Date :</strong> {{ $date }}</p>
        <p><strong>Heure :</strong> {{ $time ?? 'Non spécifiée' }}</p>
        <p><strong>Objet :</strong> {{ ucfirst($purpose) }}</p>
        <p><strong>Espaces :</strong> {{ implode(', ', array_map('ucfirst', $spaces)) }}</p>
    </div>
    
    @if($message)
    <div style="background-color: #fef5e7; border: 1px solid #f6ad55; border-radius: 6px; padding: 20px; margin: 20px 0;">
        <h3 style="color: #744210; margin: 0 0 10px 0;">Message</h3>
        <p>{{ $message }}</p>
    </div>
    @endif
    
    <p>Veuillez traiter cette demande dans les plus brefs délais.</p>
    
    <p>Cordialement,<br>L'équipe Hub Ivoire Tech</p>
</x-layouts.email>
