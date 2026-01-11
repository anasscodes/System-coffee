<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            ➕ Add Drink
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto px-4">
        <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6 transition-colors">

            <form method="POST" action="{{ route('drinks.store') }}">
                @csrf

                {{-- Name --}}
                <div class="mb-4">
                    <label class="block mb-1 text-gray-700 dark:text-gray-300">
                        Drink Name
                    </label>
                    <input type="text" name="name"
                           class="w-full border border-gray-300 dark:border-gray-600
                                  bg-white dark:bg-gray-900
                                  text-gray-800 dark:text-gray-100
                                  rounded-md p-2 focus:ring focus:ring-green-400"
                           required>
                </div>

                {{-- Price --}}
                <div class="mb-6">
                    <label class="block mb-1 text-gray-700 dark:text-gray-300">
                        Price (DH)
                    </label>
                    <input type="number" step="0.01" name="price"
                           class="w-full border border-gray-300 dark:border-gray-600
                                  bg-white dark:bg-gray-900
                                  text-gray-800 dark:text-gray-100
                                  rounded-md p-2 focus:ring focus:ring-green-400"
                           required>
                </div>
                    <div class="mb-4">
    <label class="block mb-1">Category</label>
    <select name="category"
        class="w-full border-gray-300 dark:border-gray-600
               bg-white dark:bg-gray-800
               text-gray-800 dark:text-gray-100
               rounded-md">
        <option value="coffee">☕ Coffee</option>
        <option value="milk">🥛 Milk</option>
        <option value="cold">🧊 Cold</option>
        <option value="juice">🍹 Juice</option>
        <option value="soda">🥤 Soda</option>
    </select>
</div>

                {{-- Actions --}}
                <div class="flex items-center justify-between">
                    <a href="{{ route('drinks.index') }}"
                       class="text-sm text-gray-500 dark:text-gray-400 hover:underline">
                        ← Back
                    </a>

                    <button
                        class="px-5 py-2 bg-green-600 hover:bg-green-700
                               text-white rounded-lg transition">
                        💾 Save Drink
                    </button>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>
