<x-layouts.email title="Vos préférences ont été mises à jour !">
    <p>Cher·e {{ $name }},</p>
    <p>Nous vous confirmons que vos préférences de newsletter ont été mises à jour avec succès. Voici un récapitulatif de vos nouveaux paramètres :</p>

    <h2>Vos nouvelles préférences de communication</h2>
    <ul>
        <li>Newsletter par email : <strong>{{ $newsletter_email ? 'Activée' : 'Désactivée' }}</strong></li>
        <li>Newsletter par WhatsApp : <strong>{{ $newsletter_whatsapp ? 'Activée' : 'Désactivée' }}</strong></li>
    </ul>

    @if(count($interests) > 0)
    <h2>Vos centres d'intérêt mis à jour</h2>
    <ul>
        @foreach($interests as $interest)
        <li>{{ $interest }}</li>
        @endforeach
    </ul>
    @endif

    <p>Ces modifications prendront effet immédiatement. Vous recevrez désormais nos communications selon vos nouvelles préférences.</p>
    <p>Si vous souhaitez modifier à nouveau vos préférences ou vous désinscrire, vous pouvez nous contacter à tout moment.</p>
    
    <p style="text-align: center; margin: 30px 0;">
        <a href="{{ config('app.url') }}" class="button">Visiter notre site</a>
    </p>

    <p>Merci de votre fidélité et de votre confiance,<br>
    <strong>{{ config('app.name') }}</strong></p>

    <hr>
    <p style="font-size: 12px; color: #777;"><em>Si vous n'avez pas effectué cette modification, veuillez nous contacter immédiatement.</em></p>
</x-layouts.email> 