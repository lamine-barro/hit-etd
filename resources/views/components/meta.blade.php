<!-- Meta Tags SEO -->
<meta name="description" content="{{ $metaDescription ?? config('hit.description', 'Le Hub Ivoire Tech est le plus grand campus de startups en Côte d\'Ivoire et en Afrique, offrant des programmes d\'incubation, d\'accélération et des espaces de coworking pour les entrepreneurs innovants.') }}">
<meta name="keywords" content="hub technologique, startups, innovation, entrepreneuriat, Côte d'Ivoire, Afrique, incubateur, accélérateur, coworking, fintech, edtech">
<meta name="author" content="{{ config('hit.name', 'Hub Ivoire Tech') }}">
<link rel="canonical" href="{{ url()->current() }}" />

<!-- Open Graph / Facebook -->
<meta property="og:type" content="{{ $ogType ?? 'website' }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="{{ $pageTitle ?? config('hit.name', 'Hub Ivoire Tech') }}">
<meta property="og:description" content="{{ $metaDescription ?? config('hit.description', 'Le Hub Ivoire Tech est le plus grand campus de startups en Côte d\'Ivoire et en Afrique, offrant des programmes d\'incubation, d\'accélération et des espaces de coworking pour les entrepreneurs innovants.') }}">
<meta property="og:image" content="{{ $ogImage ?? asset('images/hero_bg.jpg') }}">
<meta property="og:site_name" content="{{ config('hit.name', 'Hub Ivoire Tech') }}" />

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ url()->current() }}">
<meta property="twitter:title" content="{{ $pageTitle ?? config('hit.name', 'Hub Ivoire Tech') }}">
<meta property="twitter:description" content="{{ $metaDescription ?? config('hit.description', 'Le Hub Ivoire Tech est le plus grand campus de startups en Côte d\'Ivoire et en Afrique, offrant des programmes d\'incubation, d\'accélération et des espaces de coworking pour les entrepreneurs innovants.') }}">
<meta property="twitter:image" content="{{ $ogImage ?? asset('images/hero_bg.jpg') }}">

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<!-- Organization Schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Hub Ivoire Tech",
  "url": "{{ url('/') }}",
  "logo": "{{ asset('favicon/android-chrome-512x512.png') }}",
  "sameAs": [
    "https://web.facebook.com/profile.php?id=61568083378984",
    "https://x.com/hub_ivoire",
    "https://www.linkedin.com/company/hub-ivoire-tech/about/?viewAsMember=true",
    "https://www.instagram.com/hub_ivoire_tech/?hl=fr%C2%B5"
  ]
}
</script> 