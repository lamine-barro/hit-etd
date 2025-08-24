<x-layouts.email>
    <h1>Demande de visite reçue</h1>
    
    <p>Bonjour {{ $name }},</p>
    <p>Votre demande de visite du Hub Ivoire Tech a été reçue avec succès.</p>
    
    <div style="background-color: #f0f9ff; border: 1px solid #bfdbfe; border-radius: 6px; padding: 20px; margin: 20px 0; text-align: center;">
        <p style="margin: 0; color: #1d4ed8; font-weight: 600;">Nous vous contacterons sous 3 jours ouvrés</p>
    </div>
    
    <div style="background-color: #f7fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 20px; margin: 20px 0;">
        <h3 style="color: #2d3748; margin: 0 0 15px 0;">Récapitulatif</h3>
        <p><strong>Date :</strong> {{ $date }}</p>
        <p><strong>Heure :</strong> {{ $time }}</p>
        <p><strong>Objet :</strong> {{ ucfirst($purpose) }}</p>
        <p><strong>Espaces :</strong> {{ implode(', ', array_map('ucfirst', $spaces)) }}</p>
    </div>
    
    <div style="background-color: #fef5e7; border: 1px solid #f6ad55; border-radius: 6px; padding: 20px; margin: 20px 0;">
        <h3 style="color: #744210; margin: 0 0 15px 0;">Rappel important</h3>
        <p>Les visites se font uniquement sur rendez-vous (mardi et jeudi) avec un préavis de 72h minimum.</p>
    </div>
    
    <p>Merci pour votre intérêt à découvrir notre campus !</p>
    
    <p>Cordialement,<br>L'équipe Hub Ivoire Tech</p>
</x-layouts.email>
