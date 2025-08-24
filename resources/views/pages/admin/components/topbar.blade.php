<!-- Top navigation -->
<div class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8 lg:pl-80">
        <!-- Mobile menu button -->
        <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden">
            <span class="sr-only">Open sidebar</span>
            <i data-lucide="menu" class="h-6 w-6"></i>
        </button>

        <!-- Separator -->
        <div class="h-6 w-px bg-gray-200 lg:hidden" aria-hidden="true"></div>

        <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
            <div class="relative flex flex-1 items-center">
                <!-- Breadcrumb ou titre de page -->
                <div class="flex items-center space-x-2 text-sm text-gray-500 font-poppins">
                    <i data-lucide="home" class="h-4 w-4"></i>
                    <span>Administration</span>
                    <span>/</span>
                    <span class="font-medium text-gray-900">@yield('page-title', 'Dashboard')</span>
                </div>
            </div>
            
            <!-- Actions de droite -->
            <div class="flex items-center gap-x-4 lg:gap-x-6">
                <!-- Notifications -->
                <button type="button" class="-m-2.5 p-2.5 text-gray-400 hover:text-primary transition-colors duration-200">
                    <span class="sr-only">View notifications</span>
                    <i data-lucide="bell" class="h-6 w-6"></i>
                </button>

                <!-- Separator -->
                <div class="hidden lg:block lg:h-6 lg:w-px lg:bg-gray-200" aria-hidden="true"></div>

                <!-- Profile dropdown -->
                <div class="relative">
                    <button type="button" class="-m-1.5 flex items-center p-1.5 group" id="user-menu-button" onclick="toggleUserMenu()">
                        <span class="sr-only">Open user menu</span>
                        <div class="h-8 w-8 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, #FF6B00 0%, #FF8533 100%);">
                            <span class="text-sm font-medium text-white font-poppins">A</span>
                        </div>
                        <span class="hidden lg:flex lg:items-center">
                            <span class="ml-4 text-sm font-semibold leading-6 text-gray-900 font-poppins">{{ Auth::guard('admin')->user()->email ?? 'admin@hubivoiretech.ci' }}</span>
                            <i data-lucide="chevron-down" class="ml-2 h-5 w-5 text-gray-400 group-hover:text-gray-500"></i>
                        </span>
                    </button>

                    <!-- Dropdown menu (hidden by default) -->
                    <div id="user-menu" class="hidden absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 font-poppins">Mon profil</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 font-poppins">Paramètres</a>
                        <hr class="my-1">
                        <button type="button" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-700 font-poppins" onclick="openConfirmModal('{{ route('admin.otp.logout') }}', 'Êtes-vous sûr de vouloir vous déconnecter ?', 'reject', 'POST')">
                            <i data-lucide="log-out" class="h-4 w-4 inline mr-2"></i>
                            Se déconnecter
                        </button>
                    </div>
                </div>
            </div>
        </div>
</div>

<script>
function toggleUserMenu() {
    const menu = document.getElementById('user-menu');
    menu.classList.toggle('hidden');
}

// Close menu when clicking outside
document.addEventListener('click', function(event) {
    const button = document.getElementById('user-menu-button');
    const menu = document.getElementById('user-menu');
    
    if (!button.contains(event.target) && !menu.contains(event.target)) {
        menu.classList.add('hidden');
    }
});
</script>