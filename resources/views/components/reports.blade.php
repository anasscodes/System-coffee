<div>
    <div class="bg-white shadow rounded-lg p-6 mb-6">
    <h2 class="text-lg font-bold mb-4">📊 Reports</h2>

    <ul class="space-y-2">
        <li>💰 Today Revenue: <strong>{{ number_format($todayRevenue, 2) }} DH</strong></li>
        <li>✅ Paid Orders: <strong>{{ $paidCount }}</strong></li>
        <li>⏳ Pending Orders: <strong>{{ $pendingCount }}</strong></li>
    </ul>
</div>
    <!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->
</div>