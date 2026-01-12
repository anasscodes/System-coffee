<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Create Order
        </h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto px-6">

        <a href="{{ route('orders.index') }}"
           class="text-sm text-gray-500 dark:text-gray-400 hover:underline mb-4 inline-block">
            ← Back to Orders
        </a>

        <!-- FORM -->
        <form method="POST" action="{{ route('orders.store') }}">
            @csrf

            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">

                <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-6">
                    Select Drinks
                </h3>

                @foreach($categories as $category => $drinks)

                    <!-- CATEGORY TITLE -->
                    <h4 class="text-lg font-semibold mt-6 mb-3
                               text-gray-700 dark:text-gray-300 capitalize">
                        @if($category === 'coffee') ☕ Coffee
                        @elseif($category === 'milk') 🥛 Milk
                        @elseif($category === 'juice') 🍊 Juice
                        @elseif($category === 'soda') 🥤 Soda
                        @else 🧊 Cold
                        @endif
                    </h4>

                    <!-- DRINKS GRID -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($drinks as $drink)
                            <label
                                class="cursor-pointer border rounded-xl p-4 text-center
                                bg-gray-50 dark:bg-gray-900
                                hover:ring-2 hover:ring-amber-500
                                transition">

                                <input type="checkbox"
                                    name="drinks[]"
                                    value="{{ $drink->id }}"
                                    class="hidden peer">
                                


                                <div class="text-3xl mb-2">
                                    🥤
                                </div>

                                <div class="font-semibold text-gray-800 dark:text-gray-100">
                                    {{ $drink->name }}
                                </div>

                                <div class="text-sm text-gray-500">
                                    {{ $drink->price }} DH
                                </div>

                            </label>
                        @endforeach
                    </div>

                @endforeach

                <!-- ACTION -->
                <div class="mt-8 flex justify-end">
                    <button type="submit"
                            class="bg-amber-500 hover:bg-amber-600
                                   text-black font-semibold
                                   px-8 py-3 rounded-xl transition">
                        ✔ Create Order
                    </button>
                </div>

            </div>
        </form>

    </div>
</x-app-layout>
