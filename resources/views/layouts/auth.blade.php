<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>HShop - Authentification</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Tailwind & Assets -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Style global -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .gradient-custom-3 {
  background: linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5));
}

.gradient-custom-4 {
  background: linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1));
}

    </style>
</head>
<body class="bg-gradient-to-br from-gray-100 via-white to-gray-200 min-h-screen flex flex-col">

    <!-- Navbar simple -->
    <nav class="bg-white shadow-sm py-4 px-6 border-b border-gray-200 flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <a href="{{ url('/') }}" class="text-xl font-bold text-gray-800 hover:text-indigo-600 transition">🛍️ HShop</a>
        </div>
        <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:text-indigo-600 transition">
            Retour à la boutique
        </a>
    </nav>

    <!-- Contenu principal -->
    <main class="flex-grow flex items-center justify-center px-4 py-10">
        <div class="w-full max-w-md bg-white/60 backdrop-blur-lg border border-white/30 shadow-2xl p-8 sm:p-10 rounded-3xl">
            @yield('content')
        </div>
    </main>


</body>
</html>
