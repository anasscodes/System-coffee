<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
    @csrf

    <!-- Email -->
    <div>
        <label class="block text-sm text-gray-300 mb-1">Email</label>
        <input type="email" name="email"
               value="{{ old('email') }}"
               required autofocus
               class="w-full rounded-xl bg-gray-800 border border-gray-700
                      text-white placeholder-gray-400
                      focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
        <x-input-error :messages="$errors->get('email')" class="mt-1" />
    </div>

    <!-- Password -->
    <div>
        <label class="block text-sm text-gray-300 mb-1">Password</label>
        <input type="password" name="password" required
               class="w-full rounded-xl bg-gray-800 border border-gray-700
                      text-white placeholder-gray-400
                      focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
        <x-input-error :messages="$errors->get('password')" class="mt-1" />
    </div>

    <!-- Remember -->
    <div class="flex items-center justify-between text-sm">
        <label class="flex items-center text-gray-400">
            <input type="checkbox" name="remember"
                   class="rounded bg-gray-800 border-gray-600 text-amber-500">
            <span class="ml-2">Remember me</span>
        </label>

        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}"
               class="text-amber-400 hover:underline">
                Forgot?
            </a>
        @endif
    </div>

    <!-- Button -->
    <button type="submit"
        class="w-full py-3 rounded-xl
               bg-amber-500 hover:bg-amber-600
               text-black font-semibold transition">
        Login →
    </button>
</form>

</x-guest-layout>
