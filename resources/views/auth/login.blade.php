<x-guest-layout>
    <!-- Session Status -->
    <div class="mb-6">
        <x-auth-session-status :status="session('status')" />
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Username (NIP/NIS) -->
        <div class="space-y-2">
            <label for="username" class="block text-sm font-medium text-white">
                NIP/NIS (8 digit)
            </label>
            <input id="username"
                   class="form-input w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50 transition-all duration-200"
                   type="text"
                   name="username"
                   value="{{ old('username') }}"
                   required
                   autofocus
                   autocomplete="username"
                   maxlength="8"
                   minlength="8"
                   pattern="\d{8}"
                   placeholder="Masukkan NIP/NIS">
            <x-input-error :messages="$errors->get('username')" class="mt-2 text-red-300 text-sm" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <label for="password" class="block text-sm font-medium text-white">
                Password
            </label>
            <input id="password"
                   class="form-input w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50 transition-all duration-200"
                   type="password"
                   name="password"
                   required
                   autocomplete="current-password"
                   placeholder="Masukkan password">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-300 text-sm" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me"
                       type="checkbox"
                       class="w-4 h-4 text-white border-white border-opacity-30 rounded focus:ring-white focus:ring-opacity-50 bg-transparent"
                       name="remember">
                <span class="ml-2 text-sm text-white">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-white hover:text-blue-200 transition-colors duration-200"
                   href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <!-- Login Button -->
        <button type="submit"
                class="w-full px-6 py-3 bg-white bg-opacity-20 text-white font-medium rounded-lg hover:bg-opacity-30 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50 transition-all duration-200 border border-white border-opacity-30">
            Masuk
        </button>

        <!-- Back to Home Link -->
        <div class="text-center pt-4">
            <a href="{{ url('/') }}"
               class="inline-flex items-center text-sm text-white hover:text-blue-200 transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Beranda
            </a>
        </div>
    </form>
</x-guest-layout>
