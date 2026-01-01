<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Customer
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded p-6">

                <form method="POST" action="{{ route('customers.store') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">
                            Name
                        </label>
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="mt-1 block w-full rounded border-gray-300"
                            required
                        >

                        @error('name')
                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">
                            Phone
                        </label>
                        <input
                            type="text"
                            name="phone"
                            value="{{ old('phone') }}"
                            class="mt-1 block w-full rounded border-gray-300"
                        >
                    </div>

                    <!-- Submit -->
                    <div class="flex gap-2">
                        <button
                            type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700"
                        >
                            Save
                        </button>

                        <a
                            href="{{ route('customers.index') }}"
                            class="px-4 py-2 bg-gray-300 rounded"
                        >
                            Cancel
                        </a>
                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>
