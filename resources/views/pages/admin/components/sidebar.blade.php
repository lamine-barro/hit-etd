<!-- Sidebar -->
<div id="sidebar" class="fixed lg:fixed lg:inset-y-0 lg:z-50 flex flex-col transition-all duration-300 ease-in-out bg-white border-r border-gray-200" 
     style="width: 280px; left: 0; transform: translateX(0);">
    <div class="flex grow flex-col gap-y-5 overflow-y-auto">
        <!-- Header avec logo -->
        <div class="flex h-20 shrink-0 items-center justify-center px-6 bg-white">
            <!-- Logo HIT -->
            <div class="flex items-center justify-center w-16 h-16">
                <img src="{{ asset('logo_hit.png') }}" alt="Hub Ivoire Tech" class="w-full h-full object-contain">
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex flex-1 flex-col px-6 pb-4">
            <ul role="list" class="flex flex-1 flex-col gap-y-7">
                <!-- Section principale -->
                <li>
                    <div class="text-xs font-semibold leading-6 text-gray-400 uppercase tracking-wide mb-2">
                        Navigation principale
                    </div>
                    <ul role="list" class="-mx-2 space-y-1">
                        <!-- Dashboard -->
                        <li>
                            <a href="{{ route('admin.dashboard') }}" 
                               class="{{ request()->routeIs('admin.dashboard') ? 'sidebar-item-active' : 'text-gray-700 hover:bg-orange-50 hover:text-primary' }} group flex gap-x-3 rounded-l-md p-3 text-sm leading-6 font-medium font-poppins transition-colors duration-200">
                                <i data-lucide="layout-dashboard" class="{{ request()->routeIs('admin.dashboard') ? 'text-primary' : 'text-gray-400 group-hover:text-primary' }} h-5 w-5 shrink-0"></i>
                                Dashboard
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Section Gestion des espaces -->
                <li>
                    <div class="text-xs font-semibold leading-6 text-gray-400 uppercase tracking-wide mb-2">
                        Gestion des espaces
                    </div>
                    <ul role="list" class="-mx-2 space-y-1">
                        <!-- Espaces -->
                        <li>
                            <a href="{{ route('admin.espaces.index') }}" 
                               class="{{ request()->routeIs('admin.espaces.*') ? 'sidebar-item-active' : 'text-gray-700 hover:bg-orange-50 hover:text-primary' }} group flex gap-x-3 rounded-l-md p-3 text-sm leading-6 font-medium font-poppins transition-colors duration-200">
                                <i data-lucide="building-2" class="{{ request()->routeIs('admin.espaces.*') ? 'text-primary' : 'text-gray-400 group-hover:text-primary' }} h-5 w-5 shrink-0"></i>
                                Espaces                                @if(\App\Models\Espace::count() > 0)
                                    <span class="ml-auto w-5 h-5 text-xs font-medium text-gray-600 bg-gray-100 rounded-full flex items-center justify-center ">
                                        {{ \App\Models\Espace::count() }}
                                                                    @endif
                            </a>
                        </li>

                        <!-- Demandes de visite -->
                        <li>
                            <a href="{{ route('admin.bookings.index') }}" 
                               class="{{ request()->routeIs('admin.bookings.*') ? 'sidebar-item-active' : 'text-gray-700 hover:bg-orange-50 hover:text-primary' }} group flex gap-x-3 rounded-l-md p-3 text-sm leading-6 font-medium font-poppins transition-colors duration-200">
                                <i data-lucide="calendar-check" class="{{ request()->routeIs('admin.bookings.*') ? 'text-primary' : 'text-gray-400 group-hover:text-primary' }} h-5 w-5 shrink-0"></i>
                                Demandes de visite                                @php
                                    $pendingBookings = \App\Models\Booking::where('status', 'pending')->count();
                                @endphp
                                @if($pendingBookings > 0)
                                    <span class="ml-auto w-5 h-5 text-xs font-medium text-white rounded-full flex items-center justify-center animate-pulse " style="background-color: #FF6B00;">
                                        {{ $pendingBookings }}
                                                                    @endif
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Section Contenu -->
                <li>
                    <div class="text-xs font-semibold leading-6 text-gray-400 uppercase tracking-wide mb-2">
                        Gestion du contenu
                    </div>
                    <ul role="list" class="-mx-2 space-y-1">
                        <!-- Articles -->
                        <li>
                            <a href="{{ route('admin.articles.index') }}" 
                               class="{{ request()->routeIs('admin.articles.*') ? 'sidebar-item-active' : 'text-gray-700 hover:bg-orange-50 hover:text-primary' }} group flex gap-x-3 rounded-l-md p-3 text-sm leading-6 font-medium font-poppins transition-colors duration-200">
                                <i data-lucide="file-text" class="{{ request()->routeIs('admin.articles.*') ? 'text-primary' : 'text-gray-400 group-hover:text-primary' }} h-5 w-5 shrink-0"></i>
                                Articles                                @if(\App\Models\Article::count() > 0)
                                    <span class="ml-auto w-5 h-5 text-xs font-medium text-gray-600 bg-gray-100 rounded-full flex items-center justify-center ">
                                        {{ \App\Models\Article::count() }}
                                                                    @endif
                            </a>
                        </li>

                        <!-- Événements -->
                        <li>
                            <a href="{{ route('admin.events.index') }}" 
                               class="{{ request()->routeIs('admin.events.*') ? 'sidebar-item-active' : 'text-gray-700 hover:bg-orange-50 hover:text-primary' }} group flex gap-x-3 rounded-l-md p-3 text-sm leading-6 font-medium font-poppins transition-colors duration-200">
                                <i data-lucide="calendar" class="{{ request()->routeIs('admin.events.*') ? 'text-primary' : 'text-gray-400 group-hover:text-primary' }} h-5 w-5 shrink-0"></i>
                                Événements                                @if(\App\Models\Event::count() > 0)
                                    <span class="ml-auto w-5 h-5 text-xs font-medium text-gray-600 bg-gray-100 rounded-full flex items-center justify-center ">
                                        {{ \App\Models\Event::count() }}
                                                                    @endif
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Section Communauté -->
                <li>
                    <div class="text-xs font-semibold leading-6 text-gray-400 uppercase tracking-wide mb-2">
                        Gestion de la communauté
                    </div>
                    <ul role="list" class="-mx-2 space-y-1">
                        <!-- Utilisateurs -->
                        <li>
                            <a href="{{ route('admin.users.index') }}" 
                               class="{{ request()->routeIs('admin.users.*') ? 'sidebar-item-active' : 'text-gray-700 hover:bg-orange-50 hover:text-primary' }} group flex gap-x-3 rounded-l-md p-3 text-sm leading-6 font-medium font-poppins transition-colors duration-200">
                                <i data-lucide="users" class="{{ request()->routeIs('admin.users.*') ? 'text-primary' : 'text-gray-400 group-hover:text-primary' }} h-5 w-5 shrink-0"></i>
                                Utilisateurs                                @if(\App\Models\User::count() > 0)
                                    <span class="ml-auto w-5 h-5 text-xs font-medium text-gray-600 bg-gray-100 rounded-full flex items-center justify-center ">
                                        {{ \App\Models\User::count() }}
                                                                    @endif
                            </a>
                        </li>

                        <!-- Experts -->
                        <li>
                            <a href="{{ route('admin.experts.index') }}" 
                               class="{{ request()->routeIs('admin.experts.*') ? 'sidebar-item-active' : 'text-gray-700 hover:bg-orange-50 hover:text-primary' }} group flex gap-x-3 rounded-l-md p-3 text-sm leading-6 font-medium font-poppins transition-colors duration-200">
                                <i data-lucide="graduation-cap" class="{{ request()->routeIs('admin.experts.*') ? 'text-primary' : 'text-gray-400 group-hover:text-primary' }} h-5 w-5 shrink-0"></i>
                                Experts                                @php
                                    $pendingExperts = \App\Models\Expert::where('status', 'pending')->count();
                                @endphp
                                @if($pendingExperts > 0)
                                    <span class="ml-auto w-5 h-5 text-xs font-medium text-white rounded-full flex items-center justify-center animate-pulse " style="background-color: #FF6B00;">
                                        {{ $pendingExperts }}
                                                                    @elseif(\App\Models\Expert::count() > 0)
                                    <span class="ml-auto w-5 h-5 text-xs font-medium text-gray-600 bg-gray-100 rounded-full flex items-center justify-center ">
                                        {{ \App\Models\Expert::count() }}
                                                                    @endif
                            </a>
                        </li>

                        <!-- Partenariats -->
                        <li>
                            <a href="{{ route('admin.partnerships.index') }}" 
                               class="{{ request()->routeIs('admin.partnerships.*') ? 'sidebar-item-active' : 'text-gray-700 hover:bg-orange-50 hover:text-primary' }} group flex gap-x-3 rounded-l-md p-3 text-sm leading-6 font-medium font-poppins transition-colors duration-200">
                                <i data-lucide="handshake" class="{{ request()->routeIs('admin.partnerships.*') ? 'text-primary' : 'text-gray-400 group-hover:text-primary' }} h-5 w-5 shrink-0"></i>
                                Partenariats                                @php
                                    $pendingPartnerships = \App\Models\Partnership::where('status', 'untreated')->count();
                                @endphp
                                @if($pendingPartnerships > 0)
                                    <span class="ml-auto w-5 h-5 text-xs font-medium text-white rounded-full flex items-center justify-center animate-pulse " style="background-color: #FF6B00;">
                                        {{ $pendingPartnerships }}
                                                                    @endif
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Spacer -->
                <li class="mt-auto">
                    <div class="border-t border-gray-200 pt-4">
                        <a href="{{ route('home') }}" class="flex items-center gap-x-3 p-3 text-sm text-gray-500 hover:text-gray-700 font-poppins transition-colors duration-200 group">
                            <i data-lucide="home" class="w-4 h-4 group-hover:text-gray-700"></i>
                            <span>Aller à l'accueil                        </a>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>

<!-- Mobile overlay -->
<div id="sidebar-overlay" class="fixed inset-0 z-30 bg-black bg-opacity-50 lg:hidden hidden"></div>

<!-- Mobile header -->
<div class="sticky top-0 z-40 flex items-center gap-x-6 bg-white px-4 py-4 shadow-sm lg:hidden">
    <button type="button" id="mobile-menu-button" class="-m-2.5 p-2.5 text-gray-700">
        <span class="sr-only">Open sidebar        <i data-lucide="menu" class="h-6 w-6"></i>
    </button>
    <div class="flex-1 text-sm font-semibold leading-6 text-gray-900 font-poppins">HIT Administration</div>
</div>

<script>
// Mobile menu functionality only
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    
    // Mobile toggle
    mobileMenuButton.addEventListener('click', function() {
        sidebar.style.transform = 'translateX(0)';
        sidebarOverlay.classList.remove('hidden');
    });
    
    // Close mobile menu
    sidebarOverlay.addEventListener('click', function() {
        sidebar.style.transform = 'translateX(-100%)';
        sidebarOverlay.classList.add('hidden');
    });
    
    // Mobile responsive
    function handleResize() {
        if (window.innerWidth >= 1024) {
            sidebar.style.transform = 'translateX(0)';
            sidebarOverlay.classList.add('hidden');
        } else {
            sidebar.style.transform = 'translateX(-100%)';
        }
    }
    
    window.addEventListener('resize', handleResize);
    handleResize();
});
</script>

<style>
@media (max-width: 1023px) {
    #sidebar {
        transform: translateX(-100%);
        z-index: 40;
    }
}
</style>