<!-- Meta Tags SEO -->
<meta name="description" content="{{ $metaDescription ?? config('hit.description') }}">
<meta name="keywords" content="hub technologique, startups, innovation, entrepreneuriat, Côte d'Ivoire, Afrique, incubateur, accélérateur">
<meta name="author" content="{{ config('hit.name') }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="{{ $pageTitle ?? config('hit.name') }}">
<meta property="og:description" content="{{ $metaDescription ?? config('hit.description') }}">
<meta property="og:image" content="{{ asset('images/hero_bg.jpg') }}">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ url()->current() }}">
<meta property="twitter:title" content="{{ $pageTitle ?? config('hit.name') }}">
<meta property="twitter:description" content="{{ $metaDescription ?? config('hit.description') }}">
<meta property="twitter:image" content="{{ asset('images/hero_bg.jpg') }}">

<!-- Favicon -->
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"> 