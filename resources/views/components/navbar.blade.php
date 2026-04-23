<header class="bg-white border-b border-gray-100 px-6 h-14 flex items-center justify-between">

    <!-- LEFT: Title + subtle product feel -->
    <div class="flex items-center gap-3">

        <div class="flex flex-col leading-tight">
            <h2 class="text-sm font-semibold text-gray-900 tracking-tight">
                @yield('title')
            </h2>
        </div>

    </div>

    <!-- CENTER: Command-style search (Linear-inspired) -->
    <x-search 
    :action="route('expenses.index')" 
    placeholder="Search expenses, categories..."
/>

    <!-- RIGHT: User + actions -->
    <div class="flex items-center gap-3">

        <!-- Quick Add Button (Linear style CTA) -->
        <a href="{{ route('expenses.create') }}"
           class="hidden sm:inline-flex items-center gap-1 px-3 py-1.5 text-sm
           bg-black text-white rounded-md hover:bg-gray-900 transition">
            + Add Expense
        </a>

        <!-- User dropdown -->
        <div x-data="{ open: false }" class="relative">

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
                 class="absolute right-0 mt-2 w-48 bg-white border border-gray-100
                        rounded-lg shadow-sm overflow-hidden z-50">

                <!-- User info -->
                <div class="px-3 py-2 border-b border-gray-100">
                    <p class="text-sm font-medium text-gray-900">
                        {{ Auth::user()->name }}
                    </p>
                    <p class="text-xs text-gray-500">
                        {{ Auth::user()->email }}
                    </p>
                </div>

                <!-- Links -->
                <a href="{{ route('dashboard') }}"
                   class="block px-3 py-2 text-sm text-gray-600 hover:bg-gray-50">
                    Dashboard
                </a>

                <a href="#"
                   class="block px-3 py-2 text-sm text-gray-600 hover:bg-gray-50">
                    Settings
                </a>

                <!-- Logout -->
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