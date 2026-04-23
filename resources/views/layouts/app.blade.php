<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Expense Tracker')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    @include('components.sidebar')

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">

        <!-- Navbar -->
        @include('components.navbar')

        <!-- Page Content -->
        <main class="p-6">
            @yield('content')
        </main>
    </div>
</div>
    @stack('scripts')
<x-toast />
</body>
</html>