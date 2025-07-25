<x-layouts.email title="Confirmation de candidature de partenariat">
    <p>Bonjour <strong>{{ $partnership->representative_name }}</strong>,</p>
    <p>Votre demande de partenariat avec le <strong>Hub Ivoire Tech</strong> a été reçue avec succès.</p>

    <div style="background: #f3e5f5; border: 1px solid #e1bee7; padding: 15px; border-radius: 8px; margin: 20px 0; text-align: center;">
        <strong>Demande enregistrée !</strong>
        @if($partnership->id)
            <br>Référence : <strong>#PART{{ str_pad($partnership->id, 4, '0', STR_PAD_LEFT) }}</strong>
        @endif
    </div>

    <div style="background: #f8f9fa; border: 1px solid #e9ecef; padding: 15px; border-radius: 8px; margin: 20px 0;">
        <h3 style="margin: 0 0 15px 0; color: #495057; border-bottom: 1px solid #e9ecef; padding-bottom: 10px;">
            Récapitulatif
        </h3>
        <p><strong>Type de partenariat:</strong> {{ $partnership->partnership_type ? ucfirst($partnership->partnership_type) : 'Non spécifié' }}</p>
        <p><strong>Organisation:</strong> {{ $partnership->organization_name }}</p>
        <p><strong>Email:</strong> {{ $partnership->email }}</p>
        @if($partnership->phone)
            <p><strong>Téléphone:</strong> {{ $partnership->phone }}</p>
        @endif
    </div>

    @if($partnership->message)
    <div style="background: #e9ecef; padding: 15px; border-radius: 8px; margin: 20px 0;">
        <strong>Votre message :</strong><br>
        <p style="font-style: italic; margin-top: 5px;">{{ $partnership->message }}</p>
    </div>
    @endif

    <div style="background: #fff3cd; border: 1px solid #ffeaa7; padding: 15px; border-radius: 8px; margin: 20px 0;">
        <h3 style="margin: 0 0 15px 0; color: #856404;">Prochaines étapes</h3>
        <ul>
            <li><strong>Analyse:</strong> Étude de votre proposition sous 7-10 jours.</li>
            <li><strong>Discussion:</strong> Échange sur les modalités de collaboration.</li>
            <li><strong>Formalisation:</strong> Signature d'un accord de partenariat.</li>
        </ul>
    </div>

    <p>Nous sommes ravis de votre intérêt pour collaborer avec notre écosystème.</p>
    <p>Cordialement,<br>
    <strong>L'équipe Hub Ivoire Tech</strong></p>
</x-layouts.email>