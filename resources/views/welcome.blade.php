<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Coffee POS</title>
     <link rel="icon" type="image/png" href="/coffee.png">
    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen bg-gradient-to-br from-black via-gray-900 to-gray-800
             flex items-center justify-center text-white">
             

    <div class="max-w-4xl w-full px-8">
        <div class="grid md:grid-cols-2 gap-10 items-center">

            <!-- LEFT -->
            <div>
                <h1 class="text-5xl font-extrabold leading-tight mb-6">
                    Coffee <span class="text-amber-400">POS</span><br>
                    System
                </h1>

                <p class="text-gray-300 mb-8 text-lg">
                    Fast • Simple • Modern  
                    <br>Manage drinks & orders easily.
                </p>

                <a href="{{ route('login') }}"
                   class="inline-flex items-center gap-3
                          bg-amber-500 hover:bg-amber-600
                          text-black font-semibold
                          px-8 py-4 rounded-2xl
                          transition text-lg">
                    ▶ Start Working
                </a>
            </div>

            <!-- RIGHT -->
            <div class="hidden md:flex justify-center">
                <div class="bg-white/10 backdrop-blur
                            border border-white/20
                            rounded-3xl p-8 w-full max-w-sm shadow-2xl">

                    <div class="text-4xl mb-4">☕🥤</div>

                    <ul class="space-y-3 text-gray-200">
                        <li>✔ Coffee & Drinks</li>
                        <li>✔ Juice & Soda</li>
                        <li>✔ Fast Orders</li>
                        <li>✔ Simple UI</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

</body>
</html>
