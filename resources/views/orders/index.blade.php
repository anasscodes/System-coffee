<x-app-layout>
   <x-slot name="header">
    <div class="flex items-center justify-between">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
            Orders
        </h2>

        <a href="{{ route('orders.create') }}"
           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm transition">
            + New Order
        </a>
    </div>
</x-slot>


 <div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden transition-colors">

            <table class="w-full text-sm">

                   <thead class="bg-gray-100 dark:bg-gray-900 text-gray-600 dark:text-gray-300 uppercase text-xs">
    <tr>
        <th class="p-3 text-left">#</th>
        <th class="p-3 text-left">Type</th>
        <th class="p-3 text-center">Drinks</th>
        <th class="p-3 text-center">Total</th>
        <th class="p-3 text-center">Status</th>
        <th class="p-3 text-center">Date</th>
    </tr>
</thead>


 <tbody>
@foreach($orders as $order)
<tr
    onclick="window.location='{{ route('orders.show', $order) }}'"
    class="cursor-pointer border-t border-gray-200 dark:border-gray-700
           hover:bg-gray-50 dark:hover:bg-gray-700 transition">

    <td class="p-3 font-semibold text-gray-800 dark:text-gray-100">
        #{{ $order->id }}
    </td>

    <td class="p-3">
        {{ $order->table_number ? 'Table ' . $order->table_number : 'Takeaway' }}
    </td>

    <td class="p-3 text-center">
        {{ $order->drinks->count() }}
    </td>

    <td class="p-3 text-center font-medium">
        {{ number_format($order->total, 2) }} DH
    </td>

    <td class="p-3 text-center">
        <span class="px-2 py-1 rounded text-xs
            {{ $order->status === 'paid'
                ? 'bg-green-100 text-green-700'
                : ($order->status === 'cancelled'
                    ? 'bg-red-100 text-red-700'
                    : 'bg-yellow-100 text-yellow-700') }}">
            {{ ucfirst($order->status) }}
        </span>
    </td>

    <td class="p-3 text-center text-gray-500 dark:text-gray-400">
        {{ $order->created_at->format('d M Y H:i') }}
    </td>
</tr>
@endforeach
</tbody>



                </table>

            </div>
        </div>
    </div>
</x-app-layout>
