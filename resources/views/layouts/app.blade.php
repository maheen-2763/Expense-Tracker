<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg hidden md:flex flex-col">

        <div class="p-6 text-xl font-bold text-blue-600">
            ExpenseTracker
        </div>

        <nav class="flex-1 px-4 space-y-2">

            <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded-lg bg-blue-50 text-blue-600 font-medium">
                Dashboard
            </a>

            <a href="{{ route('expenses.index') }}" 
               class="block px-4 py-2 rounded-lg hover:bg-gray-100">
                Expenses
            </a>

        </nav>

        <div class="p-4 border-t text-sm text-gray-500">
            © 2026 App
        </div>

    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">

        <!-- Navbar -->
        <header class="bg-white shadow-sm px-6 py-4 flex justify-between items-center">

            <h2 class="text-lg font-semibold text-gray-700">
                @yield('title')
            </h2>

            <div class="flex items-center gap-4">
                <span class="text-gray-600 text-sm">{{ Auth::user()->name }}</span>

                <div class="w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </div>

        </header>

        <!-- Page Content -->
        <main class="p-6">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>