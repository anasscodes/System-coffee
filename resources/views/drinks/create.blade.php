<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Drink
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">
        <div class="bg-white shadow rounded p-6">

            <form method="POST" action="{{ route('drinks.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="block mb-1">Name</label>
                    <input type="text" name="name"
                           class="w-full border rounded p-2"
                           required>
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Price (DH)</label>
                    <input type="number" step="0.01" name="price"
                           class="w-full border rounded p-2"
                           required>
                </div>

                <button class="px-4 py-2 bg-green-600 text-white rounded">
                    Save
                </button>

            </form>

        </div>
    </div>
</x-app-layout>
