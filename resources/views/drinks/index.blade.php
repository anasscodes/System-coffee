<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            Drinks
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto">

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-200 rounded">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('drinks.create') }}"
           class="mb-6 inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700
                  dark:bg-blue-500 dark:hover:bg-blue-600
                  text-white rounded transition">
            + Add Drink
        </a>

        <div x-data="{ tab: 'coffee' }">

    {{-- TABS --}}
    <div class="flex gap-2 mb-6">
        <button @click="tab='coffee'"
            :class="tab==='coffee'
                ? 'bg-green-600 text-white'
                : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300'"
            class="px-4 py-2 rounded-lg transition">
            ☕ Coffee
        </button>

        <button @click="tab='milk'"
            :class="tab==='milk'
                ? 'bg-green-600 text-white'
                : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300'"
            class="px-4 py-2 rounded-lg transition">
            🥛 Milk
        </button>

        <button @click="tab='juice'"
            :class="tab==='juice'
                ? 'bg-green-600 text-white'
                : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300'"
            class="px-4 py-2 rounded-lg transition">
            🍊 Juice
        </button>

        <button @click="tab='cold'"
            :class="tab==='cold'
                ? 'bg-green-600 text-white'
                : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300'"
            class="px-4 py-2 rounded-lg transition">
            🧊 Cold
        </button>

        <button @click="tab='soda'"
    :class="tab==='soda'
        ? 'bg-green-600 text-white'
        : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300'"
    class="px-4 py-2 rounded-lg transition">
    🥤 Soda
</button>

    </div>



       @foreach($drinks as $category => $items)
    <div x-show="tab === '{{ $category }}'" x-transition>

        <div class="bg-white dark:bg-gray-800 shadow rounded p-4 mb-8 transition-colors">
            <table class="w-full text-left">
                <thead class="bg-gray-50 dark:bg-gray-900">
                    <tr class="border-b border-gray-200 dark:border-gray-700
                               text-gray-600 dark:text-gray-300">
                        <th>#</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($items as $drink)
                        <tr class="border-b border-gray-200 dark:border-gray-700
                                   hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="text-gray-800 dark:text-gray-100">{{ $drink->id }}</td>
                            <td>{{ $drink->name }}</td>
                            <td>{{ $drink->price }} DH</td>
                            <td>{{ $drink->is_available ? 'Available' : 'Not available' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endforeach


    </div>
</x-app-layout>
