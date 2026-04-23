<header class="bg-white border-b border-gray-100 px-6 h-14 flex items-center">

    <!-- LEFT: Page context -->
    <div class="flex items-center min-w-[180px]">

        <h2 class="text-sm font-medium text-gray-900 tracking-tight">
            @yield('title')
        </h2>

    </div>

    <!-- CENTER: Command-style search -->
    <div class="flex-1 flex justify-center hidden md:flex">

        <form method="GET" action="{{ route('expenses.index') }}" class="w-full max-w-md">

            <div class="relative">

                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">
                    🔍
                </span>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search expenses..."
                    class="w-full pl-9 pr-3 py-2 text-sm
                    bg-gray-50 border border-gray-200 rounded-md
                    focus:bg-white focus:border-gray-300 focus:ring-0
                    transition outline-none"
                >

            </div>

        </form>

    </div>

    <!-- RIGHT: User -->
    <div class="flex items-center justify-end min-w-[180px]">

        <div x-data="{ open: false }" class="relative">

            <!-- Trigger -->
            <button @click="open = !open"
                class="flex items-center gap-2">

                <span class="text-sm text-gray-600 hidden sm:block">
                    {{ Auth::user()->name }}
                </span>

                <div class="w-7 h-7 rounded-full bg-gray-100 border border-gray-200
                            flex items-center justify-center text-xs font-medium text-gray-700">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

            </button>

            <!-- Dropdown -->
            <div x-show="open"
                 @click.outside="open = false"
                 x-transition
                 class="absolute right-0 mt-2 w-44 bg-white border border-gray-100
                        rounded-md shadow-sm overflow-hidden z-50">

                <div class="px-3 py-2 border-b border-gray-100">
                    <p class="text-sm font-medium text-gray-900">
                        {{ Auth::user()->name }}
                    </p>
                    <p class="text-xs text-gray-500">
                        {{ Auth::user()->email }}
                    </p>
                </div>

                <a href="{{ route('dashboard') }}"
                   class="block px-3 py-2 text-sm text-gray-600 hover:bg-gray-50">
                    Dashboard
                </a>

                <a href="#"
                   class="block px-3 py-2 text-sm text-gray-600 hover:bg-gray-50">
                    Settings
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-3 py-2 text-sm text-red-500 hover:bg-gray-50">
                        Logout
                    </button>
                </form>

            </div>

        </div>

    </div>

</header>