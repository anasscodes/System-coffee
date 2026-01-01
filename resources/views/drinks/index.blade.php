<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Drinks
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto">

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('drinks.create') }}"
           class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded">
            + Add Drink
        </a>

        <div class="bg-white shadow rounded p-4">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b">
                        <th class="py-2">#</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($drinks as $drink)
                        <tr class="border-b">
                            <td class="py-2">{{ $drink->id }}</td>
                            <td>{{ $drink->name }}</td>
                            <td>{{ $drink->price }} DH</td>
                            <td>
                                {{ $drink->is_available ? 'Available' : 'Not available' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">
                                No drinks found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
