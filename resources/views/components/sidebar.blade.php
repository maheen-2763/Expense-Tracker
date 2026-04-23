<style>
    [x-cloak] { display: none !important; }
</style>

<aside
    x-data="{ collapsed: false }"
    :class="collapsed ? 'w-20' : 'w-64'"
    class="bg-white border-r border-gray-100 flex flex-col hidden md:flex transition-[width] duration-300"
>

    <!-- Header -->
    <div class="px-4 py-5 border-b border-gray-100 flex items-center justify-between">

        <div class="w-7 h-7 rounded-md bg-black text-white flex items-center justify-center text-xs font-semibold">
        ET
    </div>
        
        <!-- Logo / Workspace -->
        <div class="overflow-hidden">
            <p x-show="!collapsed" x-cloak class="text-[11px] text-gray-400">
                Workspace
            </p>
        </div>

        <!-- Toggle -->
        <button
            @click="collapsed = !collapsed"
            class="text-gray-400 hover:text-gray-600 transition text-sm"
            title="Toggle sidebar"
        >
            ☰
        </button>

    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-2 py-4 space-y-1">

        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
           title="Dashboard"
           :class="collapsed ? 'justify-center' : 'gap-3'"
           class="flex items-center px-3 py-2 rounded-md text-sm transition
           {{ request()->routeIs('dashboard')
                ? 'bg-gray-100 text-gray-900 font-medium'
                : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">

            <span class="text-xs">📊</span>

            <span x-show="!collapsed" x-cloak x-transition.opacity>
                Dashboard
            </span>

        </a>

        <!-- Expenses -->
        <a href="{{ route('expenses.index') }}"
           title="Expenses"
           :class="collapsed ? 'justify-center' : 'gap-3'"
           class="flex items-center px-3 py-2 rounded-md text-sm transition
           {{ request()->routeIs('expenses.*')
                ? 'bg-gray-100 text-gray-900 font-medium'
                : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">

            <span class="text-xs">💸</span>

            <span x-show="!collapsed" x-cloak x-transition.opacity>
                Expenses
            </span>

        </a>

    </nav>

    <!-- CTA -->
    <div class="px-2 pb-3">

        <a href="{{ route('expenses.create') }}"
           title="New Expense"
           :class="collapsed ? 'justify-center' : ''"
           class="flex items-center justify-center gap-2 w-full py-2 text-sm
           bg-black text-white rounded-md hover:bg-gray-900 transition">

            <span>+</span>

            <span x-show="!collapsed" x-cloak x-transition.opacity>
                New Expense
            </span>

        </a>

    </div>

    <!-- Footer -->
    <div class="px-3 py-3 border-t border-gray-100 text-[11px] text-gray-400 text-center">

        <span x-show="!collapsed" x-cloak x-transition.opacity>
            © {{ date('Y') }} ExpenseTracker
        </span>

        <span x-show="collapsed">
            ©
        </span>

    </div>

</aside>