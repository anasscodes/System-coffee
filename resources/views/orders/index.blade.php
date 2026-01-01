<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">
                Orders
            </h2>

            <a href="{{ route('orders.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + New Order
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg overflow-hidden">

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-medium">#</th>
                            <th class="px-4 py-3 text-left text-sm font-medium">Type</th>
                            <th class="px-4 py-3 text-left text-sm font-medium">Drinks</th>
                            <th class="px-4 py-3 text-left text-sm font-medium">Total</th>
                            <th class="px-4 py-3 text-left text-sm font-medium">Status</th>
                            <th class="px-4 py-3 text-left text-sm font-medium">Date</th>
                        </tr>
                    </thead>

                   <tbody class="divide-y divide-gray-200">
@forelse($orders as $order)
<tr class="hover:bg-gray-50">

    {{-- ID --}}
    <td class="px-4 py-3 text-sm font-medium text-gray-700">
        #{{ $order->id }}
    </td>

    {{-- Type --}}
    <td class="px-4 py-3 font-semibold">
    <a href="{{ route('orders.show', $order) }}"
       class="text-blue-600 hover:underline">
        #{{ $order->id }}
    </a>
</td>


    {{-- <td class="px-4 py-3 text-sm text-gray-600">
        @if($order->table_number)
            Table {{ $order->table_number }}
        @elseif($order->customer)
            Takeaway
        @else
            —
        @endif
    </td> --}}

    {{-- Drinks --}}
    <td class="px-4 py-3 text-sm text-gray-600">
        {{ $order->drinks->count() }} items
    </td>

    {{-- Total --}}
    <td class="px-4 py-3 text-sm font-semibold">
        {{ number_format($order->total, 2) }} DH
    </td>

    {{-- Status + Actions --}}
    <td class="px-4 py-3 space-x-2">
        @if($order->status === 'pending')
            <form method="POST" action="{{ route('orders.updateStatus', $order) }}" class="inline">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="paid">
                <button class="bg-green-600 text-white px-2 py-1 text-xs rounded hover:bg-green-700">
                    Pay
                </button>
            </form>

            <form method="POST" action="{{ route('orders.updateStatus', $order) }}" class="inline">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="cancelled">
                <button class="bg-red-600 text-white px-2 py-1 text-xs rounded hover:bg-red-700">
                    Cancel
                </button>
            </form>
        @else
            <span class="px-2 py-1 text-xs rounded
                {{ $order->status === 'paid'
                    ? 'bg-green-100 text-green-700'
                    : 'bg-red-100 text-red-700' }}">
                {{ ucfirst($order->status) }}
            </span>
        @endif
    </td>

    {{-- Date --}}
    <td class="px-4 py-3 text-sm text-gray-500">
        {{ $order->created_at->format('d M Y H:i') }}
    </td>

</tr>
@empty
<tr>
    <td colspan="6" class="text-center py-6 text-gray-500">
        No orders yet
    </td>
</tr>
@endforelse
</tbody>

                </table>

            </div>
        </div>
    </div>
</x-app-layout>
