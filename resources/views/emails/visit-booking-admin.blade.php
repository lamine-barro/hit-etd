<x-layouts.email title="Nouvelle Demande de Visite">
    <p><strong>Équipe administrative,</strong></p>
    <p>Une nouvelle demande de visite du campus a été soumise et nécessite votre attention.</p>

    <div style="background: #e3f2fd; border: 1px solid #bbdefb; padding: 15px; border-radius: 8px; margin: 20px 0;">
        <h3 style="margin: 0 0 15px 0; color: #1976d2; border-bottom: 1px solid #bbdefb; padding-bottom: 10px;">
            Informations du visiteur
        </h3>
        <p><strong>Nom complet:</strong> {{ $name }}</p>
        <p><strong>Email:</strong> {{ $email }}</p>
        <p><strong>Téléphone:</strong> {{ $phone }}</p>
    </div>

    <div style="background: #fff3e0; border: 1px solid #ffcc80; padding: 15px; border-radius: 8px; margin: 20px 0;">
        <h3 style="margin: 0 0 15px 0; color: #ff8f00; border-bottom: 1px solid #ffcc80; padding-bottom: 10px;">
            Détails de la visite
        </h3>
        <p><strong>Date souhaitée:</strong> {{ $date }}</p>
        <p><strong>Heure souhaitée:</strong> {{ $time ?? 'Non spécifiée' }}</p>
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

    @if($message)
    <div style="background: #f8f9fa; border-left: 4px solid #FF6B00; padding: 15px; border-radius: 4px; margin: 20px 0;">
        <h4 style="margin: 0 0 10px 0; color: #FF6B00;">Message du visiteur :</h4>
        <p style="margin: 0;">{{ $message }}</p>
    </div>
    @endif

    <div style="background: #f1f1f1; border: 1px solid #e0e0e0; padding: 15px; border-radius: 8px; margin: 20px 0; text-align: center;">
        <h3 style="margin: 0 0 15px 0;">Actions à effectuer</h3>
        <p>Veuillez traiter cette demande dans les plus brefs délais.</p>
    </div>
</x-layouts.email>
