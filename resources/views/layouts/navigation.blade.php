<!-- Navigation Links -->
<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
    <x-ui.nav-link :href="route('home')" :active="request()->routeIs('home')">
        {{ __('Home') }}
    </x-ui.nav-link>

    <x-ui.nav-link :href="route('events')" :active="request()->routeIs('events*')">
        {{ __('Events') }}
    </x-ui.nav-link>

    <x-ui.nav-link :href="route('actualites')" :active="request()->routeIs('actualites*')">
        {{ __('News') }}
    </x-ui.nav-link>

   {{--  <x-ui.nav-link :href="route('visitez-le-campus')" :active="request()->routeIs('visitez-le-campus')">
        {{ __('Visit Campus') }}
    </x-ui.nav-link> --}}
</div>

<!-- Mobile menu -->
<div class="-mr-2 flex items-center sm:hidden">
    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>

<!-- Responsive Navigation Menu -->
<div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
    <div class="pt-2 pb-3 space-y-1">
        <x-ui.responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
            {{ __('Home') }}
        </x-ui.responsive-nav-link>

        <x-ui.responsive-nav-link :href="route('events')" :active="request()->routeIs('events*')">
            {{ __('Events') }}
        </x-ui.responsive-nav-link>

        <x-ui.responsive-nav-link :href="route('actualites')" :active="request()->routeIs('actualites*')">
            {{ __('News') }}
        </x-ui.responsive-nav-link>

        {{-- <x-ui.responsive-nav-link :href="route('visitez-le-campus')" :active="request()->routeIs('visitez-le-campus')">
            {{ __('Visit Campus') }}
        </x-ui.responsive-nav-link> --}}
    </div>
</div>
