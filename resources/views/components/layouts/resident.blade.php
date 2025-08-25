<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Espace résident - Hub Ivoire Tech' }}</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Toastify -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .hit-toast {
            border-radius: 8px !important;
            font-family: 'Poppins', sans-serif !important;
            font-weight: 500 !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1) !important;
            padding: 14px 18px !important;
            font-size: 14px !important;
            line-height: 1.5 !important;
            max-width: 380px !important;
            min-width: 280px !important;
            z-index: 99999 !important;
            color: white !important;
            border: none !important;
        }
        
        .hit-toast-success { background: #059669 !important; }
        .hit-toast-error { background: #DC2626 !important; }
        .hit-toast-warning { background: #D97706 !important; }
        .hit-toast-info { background: #2563EB !important; }
        
        .sidebar-link {
            transition: all 0.2s ease;
        }
        
        .sidebar-link:hover:not(.active) {
            background: #f9fafb;
            transform: translateX(2px);
        }
        
        .sidebar-link.active {
            background: #FF6B35;
            color: white;
        }
        
        .sidebar-link.active i {
            color: white;
        }
    </style>

    {{ $styles ?? '' }}
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-56 bg-white border-r border-gray-200">
            <!-- Logo -->
            <div class="p-3 border-b border-gray-100">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('logo_hit.png') }}" alt="Hub Ivoire Tech" class="h-6 w-auto">
                    <div>
                        <h2 class="text-sm font-semibold text-gray-900">Espace résident</h2>
                        <p class="text-xs text-gray-500 truncate">{{ auth()->user()->name }}</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="p-2">
                <div class="space-y-0.5">
                    <a href="{{ route('resident.dashboard') }}" class="sidebar-link flex items-center px-3 py-2 text-gray-700 rounded text-sm {{ request()->routeIs('resident.dashboard') ? 'active' : '' }}">
                        <i data-lucide="layout-dashboard" class="w-4 h-4 mr-2"></i>
                        <span>Tableau de bord</span>
                    </a>

                    <a href="{{ route('resident.espaces.index') }}" class="sidebar-link flex items-center px-3 py-2 text-gray-700 rounded text-sm {{ request()->routeIs('resident.espaces.*') ? 'active' : '' }}">
                        <i data-lucide="building-2" class="w-4 h-4 mr-2"></i>
                        <span>Mes Espaces</span>
                    </a>

                    <a href="{{ route('resident.events.index') }}" class="sidebar-link flex items-center px-3 py-2 text-gray-700 rounded text-sm {{ request()->routeIs('resident.events.*') ? 'active' : '' }}">
                        <i data-lucide="calendar" class="w-4 h-4 mr-2"></i>
                        <span>Événements</span>
                    </a>

                    <a href="{{ route('resident.profile') }}" class="sidebar-link flex items-center px-3 py-2 text-gray-700 rounded text-sm {{ request()->routeIs('resident.profile') ? 'active' : '' }}">
                        <i data-lucide="user" class="w-4 h-4 mr-2"></i>
                        <span>Mon Profil</span>
                    </a>
                </div>

                <!-- Bottom Actions -->
                <div class="mt-6 pt-3 border-t border-gray-100 space-y-0.5">
                    <a href="{{ route('home') }}" class="sidebar-link flex items-center px-3 py-2 text-gray-600 rounded text-sm">
                        <i data-lucide="home" class="w-4 h-4 mr-2"></i>
                        <span>Retour au site</span>
                    </a>

                    <form method="POST" action="{{ route('resident.otp.logout') }}">
                        @csrf
                        <button type="submit" class="sidebar-link flex items-center px-3 py-2 text-gray-600 rounded text-sm w-full text-left hover:text-red-600 hover:bg-red-50">
                            <i data-lucide="log-out" class="w-4 h-4 mr-2"></i>
                            <span>Déconnexion</span>
                        </button>
                    </form>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Header -->
            <header class="bg-white border-b border-gray-200 px-4 py-3">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-lg font-semibold text-gray-900">{{ $pageTitle ?? 'Tableau de bord' }}</h1>
                        <p class="text-sm text-gray-500">{{ $pageDescription ?? 'Bienvenue dans votre espace résident' }}</p>
                    </div>

                    <div class="flex items-center">
                        <!-- Notifications -->
                        <button class="p-2 text-gray-400 hover:text-gray-600 relative">
                            <i data-lucide="bell" class="w-4 h-4"></i>
                            <span class="absolute -top-0.5 -right-0.5 h-3 w-3 bg-red-500 rounded-full text-xs text-white flex items-center justify-center">3</span>
                        </button>

                        <!-- User Menu -->
                        <div class="flex items-center ml-3">
                            <div class="text-right mr-2">
                                <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ ucfirst(str_replace('_', ' ', auth()->user()->category ?? '')) }}</p>
                            </div>
                            <div class="h-8 w-8 bg-orange-500 rounded-full flex items-center justify-center text-white text-sm">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-4 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Toast Notification System -->
    <script>
        window.showToast = function(message, type = 'success', options = {}) {
            const defaultOptions = {
                duration: type === 'error' ? 5000 : 3000,
                close: true,
                gravity: 'bottom',
                position: 'right',
                stopOnFocus: true,
                className: `hit-toast hit-toast-${type}`,
                offset: { x: 20, y: 20 }
            };

            const colors = {
                success: '#059669',
                error: '#DC2626', 
                warning: '#D97706',
                info: '#2563EB'
            };

            const config = {
                ...defaultOptions,
                ...options,
                text: message,
                backgroundColor: colors[type] || colors.success
            };

            if (typeof Toastify !== 'undefined') {
                Toastify(config).showToast();
            }
        };

        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                window.showToast('{{ addslashes(session('success')) }}', 'success');
            @endif
            
            @if (session('error'))
                window.showToast('{{ addslashes(session('error')) }}', 'error');
            @endif
            
            @if (session('toast'))
                window.showToast('{{ addslashes(session('toast')['message'] ?? '') }}', '{{ session('toast')['type'] ?? 'success' }}');
            @endif
        });
        
        // Initialize Lucide icons
        lucide.createIcons();
    </script>

    {{ $scripts ?? '' }}
</body>
</html>