<nav x-data="{ open: false }" class="bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-700 transition-colors">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    @if(auth()->user()->isAdmin())
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            Dashboard
                        </x-nav-link>
                    @endif

                    <x-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.*')">
                        Orders
                    </x-nav-link>

                    @if(auth()->user()->isAdmin())
                        <x-nav-link :href="route('drinks.index')" :active="request()->routeIs('drinks.*')">
                            Drinks
                        </x-nav-link>
                    @endif

                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm rounded-md
                                    text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white">

                            {{ auth()->user()->name }}
                            <svg class="ms-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293L10 11.586l4.707-4.293 1.414 1.414L10 14.414 3.879 8.707z"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>
                                
                    </x-slot>
                    
                </x-dropdown>
                    <button id="darkToggle"
                        class="ml-4 p-2 rounded-lg bg-gray-200 dark:bg-gray-700">
                        🌙
                    </button>

            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open" class="p-2 text-gray-500">
                    ☰
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Menu -->
    <div x-show="open" x-transition class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">

            @if(auth()->user()->isAdmin())
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    Dashboard
                </x-responsive-nav-link>
            @endif

            <x-responsive-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.*')">
                Orders
            </x-responsive-nav-link>

            @if(auth()->user()->isAdmin())
                <x-responsive-nav-link :href="route('drinks.index')" :active="request()->routeIs('drinks.*')">
                    Drinks
                </x-responsive-nav-link>
            @endif

        </div>

        <div class="pt-4 pb-1 border-t">
            <div class="px-4 text-sm">
                {{ auth()->user()->email }}
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    Log Out
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</nav>
