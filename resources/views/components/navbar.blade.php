<header class="bg-white shadow-sm px-6 py-4 flex items-center justify-between gap-4">

    <!-- Left: Title -->
    <h2 class="text-lg font-semibold text-gray-700 whitespace-nowrap">
        @yield('title')
    </h2>

    <!-- Center: Search -->
    <form method="GET" action="{{ route('expenses.index') }}"
          class="flex-1 max-w-md mx-4 hidden md:block">
        
        <div class="relative">
            <input 
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
    <div class="flex items-center gap-4">

        <span class="text-gray-600 text-sm hidden sm:block">
            {{ Auth::user()->name }}
        </span>

        <!-- Avatar -->
        <div class="w-9 h-9 bg-blue-600 text-white rounded-full flex items-center justify-center font-semibold shadow-sm">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-red-500 text-sm hover:text-red-600 transition">
                Logout
            </button>
        </form>

    </div>

</header>