<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">

            <div class="flex items-center gap-4">
                <a href="{{ route('orders.index') }}"
                   class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition">
                    ← Back
                </a>

                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
                    Order #{{ $order->id }}
                </h2>
            </div>

            <span class="px-3 py-1 rounded-full text-sm font-medium
                {{ $order->status === 'paid'
                    ? 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-200'
                    : ($order->status === 'cancelled'
                        ? 'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-200'
                        : 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-200') }}">
                {{ ucfirst($order->status) }}
            </span>

        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4">

            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-6 transition-colors">

                {{-- Order Info --}}
                <div class="mb-6 grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div class="text-gray-600 dark:text-gray-400">
                        <p><strong class="text-gray-800 dark:text-gray-200">Date:</strong>
                            {{ $order->created_at->format('d/m/Y H:i') }}
                        </p>
                    </div>

                    @if($order->table_number)
                        <div class="text-gray-600 dark:text-gray-400 text-right">
                            <p><strong class="text-gray-800 dark:text-gray-200">Table:</strong>
                                {{ $order->table_number }}
                            </p>
                        </div>
                    @endif
                </div>

                {{-- Drinks --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-100 dark:bg-gray-900 text-gray-600 dark:text-gray-300">
                            <tr>
                                <th class="p-3 text-left">Drink</th>
                                <th class="p-3 text-center">Qty</th>
                                <th class="p-3 text-right">Price</th>
                                <th class="p-3 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->drinks as $drink)
                                <tr class="border-t border-gray-200 dark:border-gray-700
                                           hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="p-3 text-gray-800 dark:text-gray-100">
                                        {{ $drink->name }}
                                    </td>
                                    <td class="p-3 text-center text-gray-700 dark:text-gray-300">
                                        {{ $drink->pivot->quantity }}
                                    </td>
                                    <td class="p-3 text-right text-gray-700 dark:text-gray-300">
                                        {{ number_format($drink->price, 2) }} DH
                                    </td>
                                    <td class="p-3 text-right font-medium text-gray-800 dark:text-gray-100">
                                        {{ number_format($drink->price * $drink->pivot->quantity, 2) }} DH
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Total --}}
                <div class="mt-6 flex justify-end">
                    <div class="bg-gray-100 dark:bg-gray-900 px-6 py-3 rounded-xl text-lg font-bold
                                text-gray-800 dark:text-gray-100">
                        Total: {{ number_format($order->total, 2) }} DH
                    </div>
                </div>

                {{-- Actions --}}
                <div class="mt-8 flex flex-wrap gap-3 justify-end">

                    @if($order->status === 'pending')
                        <a href="{{ route('orders.edit', $order) }}"
                           class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                            ✏️ Edit
                        </a>
                    @endif

                    @if(auth()->user()->canPay() && $order->status === 'pending')

                        <form method="POST" action="{{ route('orders.updateStatus', $order) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="paid">
                            <button
                                class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">
                                💰 Pay
                            </button>
                        </form>

                        <a href="{{ route('orders.receipt', $order) }}"
                           class="px-4 py-2 bg-cyan-600 hover:bg-cyan-700 text-white rounded-lg transition">
                            🧾 Ticket
                        </a>

                        <form method="POST" action="{{ route('orders.updateStatus', $order) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="cancelled">
                            <button
                                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition">
                                ❌ Cancel
                            </button>
                        </form>

                    @endif

                    <a href="{{ route('orders.pdf', $order) }}"
                       class="px-4 py-2 bg-zinc-700 hover:bg-zinc-800 text-white rounded-lg transition">
                        📄 PDF
                    </a>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
