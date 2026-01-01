<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Order
        </h2>
    </x-slot>

    <div class="py-6">
        
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-6">
    <a href="{{ route('orders.index') }}"
       class="text-sm text-gray-500 hover:underline">
        ← Back to Orders
    </a>
</div>

            <div class="bg-white shadow rounded p-6">
                
                <form method="POST" action="{{ route('orders.store') }}">
                    @csrf

                    <h5 class="font-semibold mb-3">Order Type</h5>

                    <div class="mb-3">
                        <label class="block mb-1">Table Number (optional)</label>
                        <input type="number" name="table_number"
                               class="border rounded w-full px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Customer Phone (optional)</label>
                        <input type="text" name="customer_phone"
                               class="border rounded w-full px-3 py-2">
                    </div>

                    <hr class="my-4">

                    <h5 class="font-semibold mb-3">Drinks</h5>

                    @foreach($drinks as $drink)
                        <div class="flex items-center mb-2">
                            <input type="checkbox"
                                   name="drinks[]"
                                   value="{{ $drink->id }}"
                                   class="mr-2">

                            <span class="w-40">
                                {{ $drink->name }} ({{ $drink->price }} DH)
                            </span>

                            <input type="number"
                                   name="quantities[{{ $drink->id }}]"
                                   value="1"
                                   min="1"
                                   class="ml-3 w-20 border rounded px-2 py-1">
                        </div>
                    @endforeach

                    <button type="submit"
                        class="mt-6 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Create Order
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
