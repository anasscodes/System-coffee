<x-app-layout>

  <x-slot name="header">
    <div class="flex items-center justify-between">
        <h2 class="font-semibold text-2xl text-gray-800 tracking-tight">
            ☕ Coffee Shop
        </h2>

        <span class="text-sm text-gray-500">
            {{ now()->format('d M Y') }}
        </span>
    </div>
</x-slot>


    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- REPORTS --}}
          <x-reports
                :today-revenue="$todayRevenue"
                :paid-count="$paidCount"
                :pending-count="$pendingCount"
            />

           


            {{-- STATS --}}
           <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">

    {{-- Revenue --}}
<div class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 rounded-xl p-6 shadow-md">
        <p class="text-sm text-gray-500 dark:text-gray-400">Today Revenue</p>
        <p class="mt-2 text-3xl font-bold text-green-600">
            {{ number_format($todayRevenue, 2) }} DH
        </p>
    </div>

    {{-- Paid --}}
<div class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 rounded-xl p-6 shadow-md">
        <p class="text-sm text-gray-500 dark:text-gray-400">Paid Orders</p>
        <p class="mt-2 text-3xl font-bold text-blue-600">
            {{ $paidCount }}
        </p>
    </div>

    {{-- Pending --}}
<div class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 rounded-xl p-6 shadow-md">
        <p class="text-sm text-gray-500 dark:text-gray-400">Pending Orders</p>
        <p class="mt-2 text-3xl font-bold text-yellow-500">
            {{ $pendingCount }}
        </p>
    </div>

</div>

<div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md mt-8">
    <h3 class="font-semibold mb-4 text-gray-800 dark:text-gray-100">
        Revenue (Last 7 days)
    </h3>

    <canvas id="revenueChart"></canvas>
</div>



            {{-- TODAY ORDERS --}}
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="p-4 font-semibold">
                    Today Orders
                </div>

                <table class="w-full text-sm">
  <thead class="bg-gray-50 dark:bg-gray-900 text-gray-600 dark:text-gray-300 uppercase text-xs">


        <tr>
            <th class="p-3 text-left">Order</th>
            <th class="p-3 text-center">Total</th>
            <th class="p-3 text-center">Status</th>
            <th class="p-3 text-center">Action</th>
        </tr>
    </thead>

    <tbody>
@foreach(\App\Models\Order::whereDate('created_at', today())->where('user_id', auth()->id())->latest()->get() as $order)
    <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
        <td class="p-2 font-medium text-gray-800 dark:text-gray-100">{{ $order->id }}</td>
        <td class="p-2">{{ $order->total }} DH</td>
        <td class="p-2">
            <span class="px-2 py-1 rounded text-xs
                {{ $order->status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                {{ ucfirst($order->status) }}
            </span>
        </td>
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let revenueChart;

function renderChart(isDark) {
    const ctx = document.getElementById('revenueChart');
    if (!ctx) return;

    if (revenueChart) {
        revenueChart.destroy();
    }

    revenueChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($revenueByDay->pluck('day')) !!},
            datasets: [{
                data: {!! json_encode($revenueByDay->pluck('total')) !!},
                borderWidth: 3,
                tension: 0.4,
                fill: false,
                borderColor: isDark ? '#22c55e' : '#16a34a',
            }]
        },
        options: {
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: {
                    ticks: {
                        color: isDark ? '#e5e7eb' : '#374151'
                    }
                },
                y: {
                    ticks: {
                        color: isDark ? '#e5e7eb' : '#374151'
                    },
                    beginAtZero: true
                }
            }
        }
    });
}

// initial load
renderChart(document.documentElement.classList.contains('dark'));
</script>



</x-app-layout>
{{-- 
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('revenueChart');

    if (!ctx) return;

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Morning', 'Noon', 'Afternoon', 'Evening'],
            datasets: [{
                label: 'Revenue (DH)',
                data: [
                    {{ $todayRevenue * 0.2 }},
                    {{ $todayRevenue * 0.35 }},
                    {{ $todayRevenue * 0.25 }},
                    {{ $todayRevenue * 0.2 }},
                ],
                borderWidth: 2,
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script> --}}

