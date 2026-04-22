<header class="bg-white shadow-sm px-6 py-4 flex items-center justify-between gap-4">

    <!-- Left: Title -->
    <h2 class="text-lg font-semibold text-gray-700 whitespace-nowrap">
        @yield('title')
    </h2>

    <!-- Center: Search -->
    <form method="GET" action="{{ route('expenses.index') }}"
          class="flex-1 max-w-md mx-4 hidden md:block">
        
        <div class="relative">
               <span class="absolute left-3 top-2.5 text-gray-400">
        🔍
    </span>
            <input class="w-full px-4 py-2 pl-10 rounded-xl border border-gray-300 
               transition-all duration-300 ease-in-out
               focus:w-full focus:ring-2 focus:ring-blue-400 focus:border-blue-400
               hover:border-green-300
               outline-none"
        type="text" 
        name="search"
        value="{{ request('search') }}"
        placeholder="Search..."
        class="w-64 px-4 py-2 rounded-xl border border-gray-300 
               transition-all duration-300 ease-in-out
               focus:w-80 focus:ring-2 focus:ring-blue-400 focus:border-blue-400
               hover:border-blue-300
               outline-none">
        </div>
    </form>

    <!-- Right: User -->
    <div x-data="{ open: false }" class="relative">

    <!-- Trigger -->
    <button @click="open = !open"
        class="flex items-center gap-3 focus:outline-none">

        <!-- Name -->
        <span class="text-gray-600 text-sm hidden sm:block">
            {{ Auth::user()->name }}
        </span>

        <!-- Avatar -->
        <div class="w-9 h-9 bg-blue-600 text-white rounded-full flex items-center justify-center font-semibold shadow-sm">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
    </button>

    <!-- Dropdown -->
    <div x-show="open"
         @click.outside="open = false"
         x-transition
         class="absolute right-0 mt-3 w-48 bg-white border rounded-xl shadow-lg overflow-hidden z-50">

        <!-- User Info -->
        <div class="px-4 py-3 border-b">
            <p class="text-sm font-medium text-gray-800">
                {{ Auth::user()->name }}
            </p>
            <p class="text-xs text-gray-500">
                {{ Auth::user()->email }}
            </p>
        </div>

        <!-- Links -->
        <a href="{{ route('dashboard') }}"
           class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 transition">
            Dashboard
        </a>

        <a href="#"
           class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 transition">
            Profile
        </a>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-50 transition">
                Logout
            </button>
        </form>

    </div>
</div>

</header>