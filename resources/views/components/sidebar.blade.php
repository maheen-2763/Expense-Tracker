<aside class="w-64 bg-white shadow-lg hidden md:flex flex-col">

    <!-- Logo -->
    <div class="p-6 text-xl font-bold text-blue-600 border-b">
        💰 ExpenseTracker
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-4 space-y-2">

        <a href="{{ route('dashboard') }}"
           class="block px-4 py-2 rounded-lg 
           {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600 font-medium' : 'hover:bg-gray-100' }}">
            📊 Dashboard
        </a>

        <a href="{{ route('expenses.index') }}"
           class="block px-4 py-2 rounded-lg 
           {{ request()->routeIs('expenses.*') ? 'bg-blue-50 text-blue-600 font-medium' : 'hover:bg-gray-100' }}">
            💸 Expenses
        </a>

    </nav>

    <!-- Footer -->
    <div class="p-4 border-t text-sm text-gray-500 text-center">
        © {{ date('Y') }} ExpenseTracker
    </div>

</aside>