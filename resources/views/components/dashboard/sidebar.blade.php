<div class="sidebar bg-white border-end" style="min-height: 100vh; width: 280px;">
    <!-- Logo et Admin -->
    <div class="p-3 border-bottom">
        <div class="text-center mb-3">
            <img src="{{ asset('logo_hit.png') }}" alt="HIT Logo" height="50">
        </div>
        <div class="d-flex align-items-center justify-content-center">
            <span class="badge bg-primary-subtle text-primary px-3 py-2">
                <i class="bi bi-shield-lock me-1"></i>
                {{ __('Administration') }}
            </span>
        </div>
    </div>

    <!-- Menu -->
    <div class="p-3">
        <div class="mb-4">
            <small class="text-muted text-uppercase fw-semibold">{{ __('Menu principal') }}</small>
            <ul class="nav flex-column mt-2">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center {{ request()->routeIs('dashboard') ? 'active text-primary fw-medium' : 'text-dark' }}" 
                       href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2 me-2"></i>
                        {{ __('Tableau de bord') }}
                    </a>
                </li>
            </ul>
        </div>

        <div class="mb-4">
            <small class="text-muted text-uppercase fw-semibold">{{ __('Gestion') }}</small>
            <ul class="nav flex-column mt-2">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center {{ request()->routeIs('events.*') ? 'active text-primary fw-medium' : 'text-dark' }}" 
                       href="#">
                        <i class="bi bi-calendar-event me-2"></i>
                        {{ __('Événements') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center {{ request()->routeIs('articles.*') ? 'active text-primary fw-medium' : 'text-dark' }}" 
                       href="{{ route('articles.index') }}">
                        <i class="bi bi-newspaper me-2"></i>
                        {{ __('Articles') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center {{ request()->routeIs('users.*') ? 'active text-primary fw-medium' : 'text-dark' }}" 
                       href="{{ route('users.index') }}">
                        <i class="bi bi-people me-2"></i>
                        {{ __('Utilisateurs') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center {{ request()->routeIs('partners.*') ? 'active text-primary fw-medium' : 'text-dark' }}" 
                       href="{{ route('partners.index') }}">
                        <i class="bi bi-link-45deg me-2"></i>
                        {{ __('Partenaires') }}
                    </a>
                </li>
            </ul>
        </div>

        <div class="mb-4">
            <small class="text-muted text-uppercase fw-semibold">{{ __('Paramètres') }}</small>
            <ul class="nav flex-column mt-2">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center {{ request()->routeIs('profile') ? 'active text-primary fw-medium' : 'text-dark' }}" 
                       href="{{ route('profile.edit') }}">
                        <i class="bi bi-person me-2"></i>
                        {{ __('Profil') }}
                    </a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link d-flex align-items-center text-dark">
                            <i class="bi bi-box-arrow-right me-2"></i>
                            {{ __('Déconnexion') }}
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <!-- Déconnexion -->
    <div class="mt-auto p-3 border-top">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-light d-flex align-items-center justify-content-center w-100">
                <i class="bi bi-box-arrow-right me-2"></i>
                {{ __('Déconnexion') }}
            </button>
        </form>
    </div>
</div>

<style>
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        z-index: 100;
        overflow-y: auto;
    }

    .sidebar .nav-link {
        padding: 0.5rem 0;
        transition: all 0.3s ease;
        border-radius: 5px;
    }

    .sidebar .nav-link:hover {
        color: var(--primary-color) !important;
        background-color: rgba(255, 107, 0, 0.05);
        padding-left: 0.5rem;
    }

    .sidebar .nav-link.active {
        color: var(--primary-color) !important;
        background-color: rgba(255, 107, 0, 0.05);
        padding-left: 0.5rem;
    }

    .badge {
        font-size: 0.85rem;
    }

    /* Scrollbar personnalisé */
    .sidebar::-webkit-scrollbar {
        width: 5px;
    }

    .sidebar::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: #ddd;
        border-radius: 5px;
    }

    .sidebar::-webkit-scrollbar-thumb:hover {
        background: #ccc;
    }
</style> 