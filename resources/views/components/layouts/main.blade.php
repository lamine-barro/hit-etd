<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Hub Ivoire Tech') }}</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">

    <!-- Apple Touch Icon -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="{{ config('app.name', 'Hub Ivoire Tech') }}">

    <!-- MS Tile Icon -->
    <meta name="msapplication-TileImage" content="{{ asset('favicon/favicon-16x16.png') }}">
    <meta name="msapplication-TileColor" content="#FF6B00">
    <meta name="theme-color" content="#FF6B00">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Toastify -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Meta Tags par défaut -->
    @if (isset($metaDescription) || isset($pageTitle))
        <x-meta :title="$pageTitle ?? null" :description="$metaDescription ?? null" />
    @else
        <x-meta />
    @endif

    <style>
        html {
            scroll-behavior: smooth;
        }
        
        /* HIT Toast Notifications - Système Unifié */
        .hit-toast {
            border-radius: 12px !important;
            font-family: 'Poppins', sans-serif !important;
            font-weight: 500 !important;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
            padding: 16px 20px !important;
            font-size: 14px !important;
            line-height: 1.5 !important;
            max-width: 400px !important;
            min-width: 300px !important;
            z-index: 99999 !important;
            color: white !important;
            border: none !important;
            backdrop-filter: blur(10px) !important;
            position: fixed !important;
        }
        
        .hit-toast-success {
            border-left: 4px solid #10B981 !important;
            background: linear-gradient(135deg, #059669 0%, #10B981 100%) !important;
        }
        
        .hit-toast-error {
            border-left: 4px solid #EF4444 !important;
            background: linear-gradient(135deg, #DC2626 0%, #EF4444 100%) !important;
        }
        
        .hit-toast-warning {
            border-left: 4px solid #F59E0B !important;
            background: linear-gradient(135deg, #D97706 0%, #F59E0B 100%) !important;
        }
        
        .hit-toast-info {
            border-left: 4px solid #3B82F6 !important;
            background: linear-gradient(135deg, #2563EB 0%, #3B82F6 100%) !important;
        }
        
        .toastify-right {
            right: 20px !important;
        }
        
        .toastify-bottom {
            bottom: 20px !important;
        }
        
        /* Animation globale et performance */
        .logo-animation {
            transition: transform 0.3s ease-in-out;
        }
        
        .logo-animation:hover {
            transform: scale(1.05);
        }
        
        /* Boutons avec état focus amélioré */
        .btn-hit:focus,
        .btn-hit:focus-visible {
            outline: 2px solid #FF6B00;
            outline-offset: 2px;
        }
        
        /* Navbar responsive avec animation */
        .navbar-mobile-menu {
            transform: translateY(-100%);
            transition: transform 0.3s ease-in-out;
        }
        
        .navbar-mobile-menu.active {
            transform: translateY(0);
        }
    </style>

    {{ $styles ?? '' }}
</head>

<body class="font-sans antialiased bg-white text-gray-900">
    <!-- Navbar -->
    <x-sections.navbar />

    <!-- HIT Toast Notification System -->
    <!-- Les notifications sont maintenant gérées par JavaScript dans le script ci-dessous -->

    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <x-sections.footer />

    <x-scripts />

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Toast Notification Function -->
    <script>
        // Fonction showToast globale pour les notifications
        window.showToast = function(message, type = 'success', options = {}) {
            // Configuration par défaut
            const defaultOptions = {
                duration: type === 'error' ? 5000 : 3000,
                close: true,
                gravity: 'bottom',
                position: 'right',
                stopOnFocus: true,
                className: `hit-toast hit-toast-${type}`,
                offset: {
                    x: 20,
                    y: 20
                }
            };

            // Couleurs selon le type
            const colors = {
                success: '#059669',
                error: '#DC2626', 
                warning: '#D97706',
                info: '#2563EB'
            };

            // Configuration finale
            const config = {
                ...defaultOptions,
                ...options,
                text: message,
                backgroundColor: colors[type] || colors.success
            };

            // Vérifier que Toastify est disponible
            if (typeof Toastify !== 'undefined') {
                Toastify(config).showToast();
                console.log('Toast affiché:', message, type);
            } else {
                console.error('Toastify not loaded');
                // Fallback avec alert si Toastify n'est pas disponible
                alert(message);
            }
        };

        // Test de debug - vous pouvez supprimer ceci après vérification
        console.log('showToast function loaded:', typeof window.showToast);
        
        // Auto-test quand la page se charge (pour debug)
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, Toastify available:', typeof Toastify);
            
            // Test automatique si il y a des messages en session
            @if (session('success'))
                setTimeout(() => {
                    console.log('Tentative d\'affichage du toast de succès');
                    window.showToast('{{ addslashes(session('success')) }}', 'success');
                }, 100);
            @endif
            
            @if (session('error'))
                setTimeout(() => {
                    console.log('Tentative d\'affichage du toast d\'erreur');
                    window.showToast('{{ addslashes(session('error')) }}', 'error');
                }, 100);
            @endif
            
            @if (session('toast'))
                setTimeout(() => {
                    console.log('Tentative d\'affichage du toast (format structuré)');
                    window.showToast('{{ addslashes(session('toast')['message'] ?? '') }}', '{{ session('toast')['type'] ?? 'success' }}');
                }, 100);
            @endif
        });
    </script>

    <!-- Smooth Scroll -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>

    <!-- Page Scripts -->
    {{ $scripts ?? '' }}
</body>
</html> 