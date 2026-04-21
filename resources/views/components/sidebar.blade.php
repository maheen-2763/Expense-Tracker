<aside id="sidebar"
       class="fixed md:static z-50 top-0 left-0 h-full w-64 bg-white dark:bg-gray-800 shadow-lg transform -translate-x-full md:translate-x-0 transition duration-200">

    <div class="p-6 text-xl font-bold text-blue-600">
        Dashboard
    </div>

    <nav class="px-4 space-y-2">

        <a href="{{ route('dashboard') }}"
           class="block px-4 py-2 rounded-lg
           {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600 dark:bg-gray-700' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}">
            Dashboard
        </a>

        <a href="{{ route('expenses.index') }}"
           class="block px-4 py-2 rounded-lg
           {{ request()->routeIs('expenses.*') ? 'bg-blue-50 text-blue-600 dark:bg-gray-700' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}">
            Expenses
        </a>

    </nav>
</aside>