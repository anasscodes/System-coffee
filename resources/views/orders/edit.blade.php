<x-app-layout>
<x-slot name="header">
    <h2 class="text-xl font-semibold">
        Edit Order #{{ $order->id }}
    </h2>
</x-slot>

<div class="py-6 max-w-4xl mx-auto">
    <a href="{{ route('orders.show', $order) }}"
   class="inline-block mb-4 text-gray-600 hover:text-gray-900 text-sm">
   ← Back to Order
</a>

<form method="POST" action="{{ route('orders.update', $order) }}">
@csrf
@method('PUT')

<div class="bg-white shadow rounded-lg p-6">

<table class="w-full text-sm">
<thead class="bg-gray-100">
<tr>
    <th class="p-2 text-left">Drink</th>
    <th class="p-2 text-center">Quantity</th>
</tr>
</thead>
<tbody>

@foreach($drinks as $drink)
<tr class="border-t">
<td class="p-2">{{ $drink->name }}</td>
<td class="p-2 text-center">
<input type="number"
       name="quantities[{{ $drink->id }}]"
       min="0"
       value="{{ optional($order->drinks->firstWhere('id', $drink->id))->pivot->quantity ?? 0 }}"
       class="w-20 border rounded text-center">
</td>
</tr>
@endforeach

</tbody>
</table>

<div class="mt-6 flex justify-end gap-3">
<button class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
    Update Order
</button>
</div>

</div>
</form>
</div>
</x-app-layout>
