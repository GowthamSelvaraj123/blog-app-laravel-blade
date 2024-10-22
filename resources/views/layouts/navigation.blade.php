<nav x-data="{ open: false }" class="bg-white border-r border-gray-200 w-64 h-screen fixed shadow-lg">
    <div class="h-full flex flex-col">
        <div class="flex-shrink-0 p-4">
            <a href="{{ route('dashboard') }}">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
            </a>
        </div>
        <div class="flex-1 overflow-y-auto">
            <div class="mt-4 flex flex-col space-y-2">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                    class="flex items-center p-3 text-gray-700 
                    {{ request()->routeIs('dashboard') ? 'bg-gray-100' : 'hover:bg-gray-100 transition duration-300 ease-in-out' }}">
                    <svg class="h-5 w-5 mr-3 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a8 8 0 100 16 8 8 0 000-16z" />
                    </svg>
                    <span class="font-semibold">{{ __('Dashboard') }}</span>
                </x-nav-link>

                <x-nav-link :href="route('blogs.index')" :active="request()->routeIs('blogs.index')"
                    class="flex items-center p-3 text-gray-700
                    {{ request()->routeIs('blogs.index') ? 'bg-gray-100' : 'hover:bg-gray-100 transition duration-300 ease-in-out' }}">
                    <svg class="h-5 w-5 mr-3 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4h12v12H4V4z" />
                    </svg>
                    <span class="font-semibold">{{ __('Blogs') }}</span>
                </x-nav-link>

                <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.index')"
                    class="flex items-center p-3  text-gray-700 
                    {{ request()->routeIs('categories.index') ? 'bg-gray-100' : 'hover:bg-gray-100 transition duration-300 ease-in-out' }}">
                    <svg class="h-5 w-5 mr-3 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 3h10v10H5V3z" />
                    </svg>
                    <span class="font-semibold">{{ __('Categories') }}</span>
                </x-nav-link>
            </div>
        </div>
        <div class="p-4 border-t border-gray-200">
            <x-dropdown align="left" width="48">
                <x-slot name="trigger">
                    <button class="flex items-center p-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        <div class="font-semibold">{{ Auth::user()->name }}</div>
                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</nav>
