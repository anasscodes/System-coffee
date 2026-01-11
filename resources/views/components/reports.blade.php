<div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">

    <!-- Revenue -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow
                text-gray-800 dark:text-gray-100 transition-colors">
        <p class="text-sm text-gray-500 dark:text-gray-400">
            💰 Today Revenue
        </p>
        <p class="mt-2 text-2xl font-bold text-green-600">
            {{ number_format($todayRevenue, 2) }} DH
        </p>
    </div>

    <!-- Paid -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow
                text-gray-800 dark:text-gray-100 transition-colors">
        <p class="text-sm text-gray-500 dark:text-gray-400">
            ✅ Paid Orders
        </p>
        <p class="mt-2 text-2xl font-bold text-blue-600">
            {{ $paidCount }}
        </p>
    </div>

    <!-- Pending -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow
                text-gray-800 dark:text-gray-100 transition-colors">
        <p class="text-sm text-gray-500 dark:text-gray-400">
            ⏳ Pending Orders
        </p>
        <p class="mt-2 text-2xl font-bold text-yellow-500">
            {{ $pendingCount }}
        </p>
    </div>

</div>
