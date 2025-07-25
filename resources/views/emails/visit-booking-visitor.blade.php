<x-layouts.email title="Confirmation de demande de visite">
    <p>Bonjour <strong>{{ $name }}</strong>,</p>
    <p>Votre demande de visite du <strong>Hub Ivoire Tech</strong> a été reçue avec succès.</p>

    <div style="background: #e6fffa; border: 1px solid #b2f5ea; padding: 15px; border-radius: 8px; margin: 20px 0; text-align: center;">
        <h3 style="margin: 0 0 10px 0; color: #00897b;">Demande enregistrée !</h3>
        <p style="margin: 0;">Nous vous contacterons sous 3 jours ouvrés pour confirmer votre rendez-vous.</p>
    </div>

    <div style="background: #f8f9fa; border: 1px solid #e9ecef; padding: 15px; border-radius: 8px; margin: 20px 0;">
        <h3 style="margin: 0 0 15px 0; color: #FF6B00; border-bottom: 1px solid #e9ecef; padding-bottom: 10px;">
            Récapitulatif de votre demande
        </h3>
        <p><strong>Date souhaitée:</strong> {{ $date }}</p>
        <p><strong>Heure souhaitée:</strong> {{ $time }}</p>
        <p><strong>Objet de la visite:</strong> {{ ucfirst($purpose) }}</p>
        <div>
            <strong>Espaces à visiter:</strong>
            <div style="display: flex; flex-wrap: wrap; gap: 8px; margin-top: 5px;">
                @foreach($spaces as $space)
                    <span style="background: #FF6B00; color: white; padding: 5px 10px; border-radius: 15px; font-size: 12px;">
                        {{ ucfirst($space) }}
                    </span>
                @endforeach
            </div>
        </div>
    </div>

    <div style="background: #fff3e0; border: 1px solid #ffcc80; padding: 15px; border-radius: 8px; margin: 20px 0;">
        <h3 style="margin: 0 0 15px 0; color: #ff8f00;">Prochaines étapes</h3>
        <ul>
            <li><strong>Confirmation:</strong> Validation de votre créneau sous 3 jours ouvrés.</li>
            <li><strong>Préparation:</strong> Organisation de votre visite personnalisée.</li>
            <li><strong>Accueil:</strong> Découverte de nos espaces et de notre écosystème.</li>
        </ul>
        <div style="background: #fff8e1; padding: 10px; border-radius: 4px; margin-top: 15px; border-left: 4px solid #FF6B00;">
            <strong>Rappel:</strong> Les visites nécessitent un préavis de 72h minimum et se font uniquement sur rendez-vous (mardi et jeudi).
        </div>
    </div>

    <p style="text-align: center;">Merci pour votre intérêt à découvrir notre campus !</p>
    <p style="text-align: center;"><strong>L'équipe Hub Ivoire Tech</strong></p>
</x-layouts.email>
