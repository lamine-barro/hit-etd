<x-layouts.email title="Nouvelle inscription à la newsletter">
    <h2>Nouvelle inscription à la newsletter</h2>
    <p>Un nouveau membre vient de s'inscrire à la newsletter du Hub Ivoire Tech.</p>

    <h3>Informations du membre</h3>
    <p><strong>Nom :</strong> {{ $name }}</p>
    <p><strong>Email :</strong> {{ $email }}</p>
    @if($whatsapp)
    <p><strong>WhatsApp :</strong> {{ $whatsapp }}</p>
    @endif

    <h3>Préférences de communication</h3>
    <ul>
        <li>Newsletter par email : {{ $newsletter_email ? 'Oui' : 'Non' }}</li>
        <li>Newsletter par WhatsApp : {{ $newsletter_whatsapp ? 'Oui' : 'Non' }}</li>
    </ul>

    @if(count($interests) > 0)
    <h3>Centres d'intérêt</h3>
    <ul>
        @foreach($interests as $interest)
        <li>{{ $interest }}</li>
        @endforeach
    </ul>
    @endif

    <p>Cordialement,<br>
    L'équipe {{ config('app.name') }}</p>
</x-layouts.email>
