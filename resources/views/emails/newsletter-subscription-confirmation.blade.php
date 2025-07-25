<x-layouts.email title="Bienvenue dans la communauté Hub Ivoire Tech !">
    <p>Cher·e {{ $name }},</p>
    <p>Nous sommes ravis de vous confirmer votre inscription à notre newsletter. Vous recevrez désormais nos actualités et informations importantes concernant nos activités, événements et opportunités.</p>

    <h2>Vos préférences de communication</h2>
    <ul>
        <li>Newsletter par email : {{ $newsletter_email ? 'Activée' : 'Désactivée' }}</li>
        <li>Newsletter par WhatsApp : {{ $newsletter_whatsapp ? 'Activée' : 'Désactivée' }}</li>
    </ul>

    @if(count($interests) > 0)
    <h2>Vos centres d'intérêt</h2>
    <ul>
        @foreach($interests as $interest)
        <li>{{ $interest }}</li>
        @endforeach
    </ul>
    @endif

    <p>Vous pouvez à tout moment modifier vos préférences ou vous désinscrire en nous contactant.</p>

    <p style="text-align: center; margin: 30px 0;">
        <a href="{{ config('app.url') }}" class="button">Visiter notre site</a>
    </p>

    <p>Merci de votre confiance,<br>
    <strong>{{ config('app.name') }}</strong></p>
</x-layouts.email>
