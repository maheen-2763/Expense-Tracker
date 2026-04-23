<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Expense Tracker') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-900">

    <!-- Background -->
    <div class="min-h-screen flex items-center justify-center px-4">

        <!-- Soft gradient glow (Stripe-style feel) -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-white to-indigo-50"></div>

        <!-- Content wrapper -->
        <div class="relative w-full max-w-md">

            <!-- Auth Card -->
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-8">

                {{ $slot }}

            </div>

            <!-- Footer -->
            <p class="text-center text-xs text-gray-400 mt-6">
                © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </p>

        </div>

    </div>

</body>
</html>