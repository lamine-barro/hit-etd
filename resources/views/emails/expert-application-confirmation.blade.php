<x-layouts.email title="Confirmation de candidature Expert">
    <p>Bonjour <strong>{{ $expert->name }}</strong>,</p>
    <p>Votre candidature pour devenir expert au <strong>Hub Ivoire Tech</strong> a été reçue avec succès.</p>

    <div style="background: #d1ecf1; border: 1px solid #bee5eb; padding: 15px; border-radius: 8px; margin: 20px 0; text-align: center;">
        <strong>Candidature enregistrée !</strong>
        @if($expert->id)
            <br>Référence : <strong>#EXP{{ str_pad($expert->id, 4, '0', STR_PAD_LEFT) }}</strong>
        @endif
    </div>

    <div style="background: #f8f9fa; border: 1px solid #e9ecef; padding: 15px; border-radius: 8px; margin: 20px 0;">
        <h3 style="margin: 0 0 15px 0; color: #495057; border-bottom: 1px solid #e9ecef; padding-bottom: 10px;">
            Récapitulatif
        </h3>
        <p><strong>Email:</strong> {{ $expert->email }}</p>
        @if($expert->phone)
            <p><strong>Téléphone:</strong> {{ $expert->phone }}</p>
        @endif
        @if($expert->specialties && is_array($expert->specialties) && count($expert->specialties) > 0)
            <div>
                <strong>Spécialités:</strong>
                <div style="display: flex; flex-wrap: wrap; gap: 8px; margin-top: 5px;">
                    @foreach($expert->specialties as $specialty)
                        <span style="background: #e9ecef; padding: 4px 8px; border-radius: 12px; font-size: 12px; color: #495057;">
                            {{ ucfirst(str_replace('_', ' ', $specialty)) }}
                        </span>
                    @endforeach
                </div>
            </div>
        @endif
        @if($expert->intervention_frequency)
            <p style="margin-top: 10px;"><strong>Fréquence:</strong> {{ ucfirst($expert->intervention_frequency) }}</p>
        @endif
    </div>

    <div style="background: #fff3cd; border: 1px solid #ffeaa7; padding: 15px; border-radius: 8px; margin: 20px 0;">
        <h3 style="margin: 0 0 15px 0; color: #856404;">Prochaines étapes</h3>
        <ul>
            <li><strong>Évaluation:</strong> Analyse de votre profil sous 5-7 jours.</li>
            <li><strong>Validation:</strong> Vérification de vos compétences.</li>
            <li><strong>Intégration:</strong> Inscription dans notre pool d'experts.</li>
        </ul>
    </div>

    <p>Nous vous remercions pour votre volonté de partager votre expertise.</p>
    <p>Cordialement,<br>
    <strong>L'équipe Hub Ivoire Tech</strong></p>
</x-layouts.email>