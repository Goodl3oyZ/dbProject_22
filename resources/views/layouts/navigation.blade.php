<nav x-data="{ open: false }" class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 border-b border-gray-700 shadow-2xl">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <a href="{{route('dashboard')}}" class="flex items-center space-x-3">
                    <img class="h-10 w-10 rounded-full border-2 border-yellow-500 shadow-lg" src="{{ asset('img/group21.jpg') }}" alt="Human Shop">
                    <span class="text-xl font-bold text-yellow-500 tracking-wide">Human Shop</span>
                </a>

                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:ml-8">
                    <x-nav-link :href="route('humanShop.shoplist')" :active="request()->routeIs('humanShop.shoplist')" class="text-yellow-400 hover:text-yellow-300 transition-colors duration-300">
                        {{ __('Products') }}
                    </x-nav-link>
                </div>
                <div class="hidden sm:flex sm:ml-8">
                    <x-nav-link :href="route('member')" :active="request()->routeIs('member')" class="text-yellow-400 hover:text-yellow-300 transition-colors duration-300">
                        {{ __('Member') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center space-x-8">
                <!-- Orders Link -->
                <a href="{{ route('orders.index') }}" class="text-gray-400 hover:text-yellow-400 text-sm font-semibold underline transition duration-300">คำสั่งซื้อของคุณ</a>
                
                <!-- Cart Icon -->
                <a href="{{ route('cart') }}" class="relative flex items-center justify-center w-10 h-10 bg-gray-800 hover:bg-gray-600 rounded-full shadow-lg transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="w-6 h-6 text-yellow-400">
                        <g id="cart">
                            <path fill="currentColor" d="M29.46 10.14A2.94 2.94 0 0 0 27.1 9H10.22L8.76 6.35A2.67 2.67 0 0 0 6.41 5H3a1 1 0 0 0 0 2h3.41a.68.68 0 0 1 .6.31l1.65 3 .86 9.32a3.84 3.84 0 0 0 4 3.38h10.37a3.92 3.92 0 0 0 3.85-2.78l2.17-7.82a2.58 2.58 0 0 0-.45-2.27zM28 11.86l-2.17 7.83A1.93 1.93 0 0 1 23.89 21H13.48a1.89 1.89 0 0 1-2-1.56L10.73 11H27.1a1 1 0 0 1 .77.35.59.59 0 0 1 .13.51z"/>
                            <circle fill="currentColor" cx="14" cy="26" r="2"/>
                            <circle fill="currentColor" cx="24" cy="26" r="2"/>
                        </g>
                    </svg>
                </a>    

                <!-- User Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center space-x-2 px-4 py-2 rounded-md text-gray-200 bg-gray-800 hover:bg-gray-700 shadow-md focus:outline-none transition">
                            <div>{{ Auth::user()->userName }}</div>
                            <img src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('img/default_profile.png') }}"
                                alt="Profile Photo" class="h-9 w-9 rounded-full border-2 border-yellow-500 shadow object-cover">

                            <svg class="h-4 w-4 fill-current text-gray-400" viewBox="0 0 20 20">
                                <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content" class="p-0 m-0">
                        <x-dropdown-link :href="route('profile.edit')" class="text-gray-300 hover:text-yellow-400 transition duration-300 p-2">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}" class="p-0 m-0">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-gray-300 hover:text-yellow-400 transition duration-300 p-2">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>

                </x-dropdown>
            </div>

            <!-- Mobile Menu Button -->
            <div class="flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md text-gray-400 hover:text-yellow-400 focus:outline-none transition duration-300">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden bg-gray-900">
        <div class="space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-yellow-400 hover:text-yellow-300">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profile.edit')" class="text-yellow-400 hover:text-yellow-300">
                {{ __('Profile') }}
            </x-responsive-nav-link>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-yellow-400 hover:text-yellow-300">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</nav>
