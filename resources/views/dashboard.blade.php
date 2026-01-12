<x-app-layout>

  <x-slot name="header">
    <div class="flex items-center justify-between">
       <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100 tracking-tight">
            ☕ Coffee <span class="text-amber-400">POS</span><br>
        </h2>

      <span class="text-sm text-gray-500 dark:text-gray-400">
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

           


            

<div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md mt-8 transition-colors">
    <h3 class="font-semibold mb-4 text-gray-800 dark:text-gray-100">
        Revenue (Last 7 days)
    </h3>

    <canvas id="revenueChart"></canvas>
</div>



            {{-- TODAY ORDERS --}}
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
               <div class="p-4 font-semibold text-gray-800 dark:text-gray-100">
                    Today Orders
                </div>

                <table class="w-full text-sm">
  <thead class="bg-gray-50 dark:bg-gray-900
              text-gray-600 dark:text-gray-300
              uppercase text-xs">
    <tr>
        <th class="px-4 py-3 text-left w-1/4">Order</th>
        <th class="px-4 py-3 text-center w-1/4">Total</th>
        <th class="px-4 py-3 text-center w-1/4">Status</th>
        <th class="px-4 py-3 text-center w-1/4">Action</th>
    </tr>
</thead>

   <tbody>
@foreach(\App\Models\Order::whereDate('created_at', today())
        ->where('user_id', auth()->id())
        ->latest()
        ->get() as $order)

<tr class="border-t border-gray-200 dark:border-gray-700
           hover:bg-gray-50 dark:hover:bg-gray-800 transition">

    {{-- Order --}}
    <td class="px-4 py-3 font-medium text-gray-800 dark:text-gray-100">
        #{{ $order->id }}
    </td>

    {{-- Total --}}
    <td class="px-4 py-3 text-center text-gray-700 dark:text-gray-300 font-semibold">
        {{ number_format($order->total, 2) }} DH
    </td>

    {{-- Status --}}
    <td class="px-4 py-3 text-center">
        <span class="inline-flex items-center justify-center
                     px-3 py-1 rounded-full text-xs font-semibold
            {{ $order->status === 'paid'
                ? 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300'
                : 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300' }}">
            {{ ucfirst($order->status) }}
        </span>
    </td>

    {{-- Action --}}
    <td class="px-4 py-3 text-center">
        <a href="{{ route('orders.show', $order) }}"
           class="inline-flex items-center gap-1
                  text-blue-600 dark:text-blue-400
                  hover:underline font-medium">
            👁 View
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

