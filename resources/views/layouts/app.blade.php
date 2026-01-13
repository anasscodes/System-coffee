<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

           <!-- 🔹 Inline script to apply theme immediately -->
    <script>
      (function() {
        const theme = localStorage.getItem('theme'); // 'dark' أو 'light'
        if (theme === 'dark') {
          document.documentElement.classList.add('dark');
        } else if (theme === 'light') {
          document.documentElement.classList.remove('dark');
        }
        // إذا ماكانش theme مخزن → خلي default dark (أو light حسب اختيارك)
      })();
    </script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
  <body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100 transition-colors duration-300">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 transition-colors">



            {{-- @include('layouts.navigation') --}}
            @auth
                @include('layouts.navigation')
            @endauth


            <!-- Page Heading -->
            @isset($header)
             <header class="bg-white dark:bg-gray-800 shadow">
    <div class="max-w-7xl mx-auto py-6 px-4">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ $header }}
        </h2>
    </div>
</header>

            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>


        @if(session('notify'))
<div id="toast"
    class="fixed top-5 right-5 z-50 bg-green-600 text-white px-4 py-3 rounded-lg shadow-lg">
    {{ session('notify') }}
</div>

<script>
setTimeout(() => {
    document.getElementById('toast')?.remove();
}, 4000);
</script>
@endif


        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    </body>
</html>
