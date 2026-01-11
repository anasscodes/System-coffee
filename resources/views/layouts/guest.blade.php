<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Coffee POS') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black
             flex items-center justify-center font-sans">

    <div class="w-full max-w-md px-6">
        <div class="bg-gray-900/80 backdrop-blur
                    border border-gray-700
                    rounded-2xl shadow-2xl p-8">

            <div class="text-center mb-6">
                <div class="text-5xl mb-2">☕</div>
                <h1 class="text-2xl font-bold text-white">Coffee POS</h1>
                <p class="text-gray-400 text-sm">
                    Sign in to manage your orders
                </p>
            </div>

            {{ $slot }}

        </div>
    </div>

</body>
</html>
