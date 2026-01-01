<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Customers
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('customers.create') }}"
            class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded">
                + Add Customer
            </a>

            <div class="bg-white shadow rounded p-4">
                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2">#</th>
                            <th class="border px-4 py-2">Name</th>
                            <th class="border px-4 py-2">Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                            <tr>
                                <td class="border px-4 py-2">{{ $customer->id }}</td>
                                <td class="border px-4 py-2">{{ $customer->name }}</td>
                                <td class="border px-4 py-2">{{ $customer->phone ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</x-app-layout>
