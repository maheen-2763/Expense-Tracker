<header class="bg-white dark:bg-gray-800 shadow px-4 md:px-6 py-4 flex justify-between items-center">

    <!-- Left -->
    <div class="flex items-center gap-3">
        
        <!-- Mobile Toggle -->
        <button id="menuBtn" class="md:hidden text-gray-600 dark:text-gray-300 text-xl">
            ☰
        </button>

        <h1 class="text-lg font-semibold text-gray-700 dark:text-gray-200">
            Expense Tracker
        </h1>
    </div>

    <!-- Right -->
    <div class="flex items-center gap-4">

        <!-- Dark Mode Toggle -->
        <button onclick="toggleDark()" class="text-sm px-3 py-1 bg-gray-200 dark:bg-gray-700 rounded">
            🌙
        </button>

        <span class="text-sm text-gray-600 dark:text-gray-300">
            {{ auth()->user()->name ?? 'User' }}
        </span>

        <div class="w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center">
            {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
        </div>

    </div>

</header>