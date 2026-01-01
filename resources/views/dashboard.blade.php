<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

                {{-- Today Revenue --}}
                <div class="bg-white shadow rounded-lg p-6">
                    <p class="text-sm text-gray-500">Today Revenue</p>
                    <p class="mt-2 text-2xl font-bold text-green-600">
                        {{ number_format($todayRevenue, 2) }} DH
                    </p>
                </div>

                {{-- Paid Orders --}}
                <div class="bg-white shadow rounded-lg p-6">
                    <p class="text-sm text-gray-500">Paid Orders</p>
                    <p class="mt-2 text-2xl font-bold text-blue-600">
                        {{ $paidCount }}
                    </p>
                </div>

                {{-- Pending Orders --}}
                <div class="bg-white shadow rounded-lg p-6">
                    <p class="text-sm text-gray-500">Pending Orders</p>
                    <p class="mt-2 text-2xl font-bold text-yellow-600">
                        {{ $pendingCount }}
                    </p>
                </div>

            </div>

            <div class="mt-8 bg-white shadow rounded-lg overflow-hidden">
    <div class="p-4 font-semibold">
        Today Orders
    </div>

    <table class="w-full text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 text-left">#</th>
                <th class="p-2">Total</th>
                <th class="p-2">Status</th>
                <th class="p-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach(
                \App\Models\Order::whereDate('created_at', today())
                ->where('user_id', auth()->id())
                ->latest()->get()
            as $order)
                <tr class="border-t">
                    <td class="p-2">#{{ $order->id }}</td>
                    <td class="p-2">{{ $order->total }} DH</td>
                    <td class="p-2">{{ ucfirst($order->status) }}</td>
                    <td class="p-2">
                        <a href="{{ route('orders.show', $order) }}"
                        class="text-blue-600 hover:underline">
                            View
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>



        </div>
        
    </div>

    
</x-app-layout>
