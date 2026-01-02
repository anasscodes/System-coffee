<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">

            <div class="flex items-center gap-3">
                <a href="{{ route('orders.index') }}"
                   class="text-gray-600 hover:text-gray-900 text-sm">
                    ← Back
                </a>

                <h2 class="font-semibold text-xl text-gray-800">
                    Order #{{ $order->id }}
                </h2>
            </div>

            <span class="px-3 py-1 rounded text-sm
                {{ $order->status === 'paid'
                    ? 'bg-green-100 text-green-700'
                    : ($order->status === 'cancelled'
                        ? 'bg-red-100 text-red-700'
                        : 'bg-yellow-100 text-yellow-700') }}">
                {{ ucfirst($order->status) }}
            </span>

        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                {{-- Order Info --}}
                <div class="mb-4 text-sm text-gray-600">
                    <p><strong>Date:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>

                    @if($order->table_number)
                        <p><strong>Table:</strong> {{ $order->table_number }}</p>
                    @endif
                </div>

                {{-- Drinks --}}
                <table class="w-full text-sm border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 text-left">Drink</th>
                            <th class="p-2 text-center">Qty</th>
                            <th class="p-2 text-right">Price</th>
                            <th class="p-2 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->drinks as $drink)
                            <tr class="border-t">
                                <td class="p-2">{{ $drink->name }}</td>
                                <td class="p-2 text-center">
                                    {{ $drink->pivot->quantity }}
                                </td>
                                <td class="p-2 text-right">
                                    {{ number_format($drink->price, 2) }} DH
                                </td>
                                <td class="p-2 text-right">
                                    {{ number_format($drink->price * $drink->pivot->quantity, 2) }} DH
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Total --}}
                <div class="mt-4 text-right text-lg font-semibold">
                    Total: {{ number_format($order->total, 2) }} DH
                </div>

                {{-- Actions --}}
                <div class="mt-6 flex flex-wrap gap-3">

                    {{-- Edit --}}
                    @if($order->status === 'pending')
                        <a href="{{ route('orders.edit', $order) }}"
                           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Edit Order
                        </a>
                    @endif

                    {{-- Pay / Cancel --}}
                    @if(auth()->user()->canPay() && $order->status === 'pending')

                        <form method="POST"
                              action="{{ route('orders.updateStatus', $order) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="paid">
                            <button
                                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                Pay
                            </button>
                        </form>

                        <a href="{{ route('orders.receipt', $order) }}"
                            class="bg-cyan-600 text-white px-4 py-2 rounded hover:bg-cyan-700">
                            🧾 Ticket
                            </a>

                        <form method="POST"
                              action="{{ route('orders.updateStatus', $order) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="cancelled">
                            <button
                                class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                Cancel
                            </button>
                        </form>

                    @endif

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
