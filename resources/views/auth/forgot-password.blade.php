<x-guest-layout>
    <!-- Session Status -->
    <div class="mb-6">
        <x-auth-session-status :status="session('status')" />
    </div>

    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Lupa Password</h2>
        <p class="text-gray-600 text-sm">Masukkan email Anda untuk mendapatkan link reset password</p>
    </div>

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <label for="email" class="block text-sm font-medium text-gray-700">
                Email
            </label>
            <input id="email"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                   type="email"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   autofocus
                   placeholder="Masukkan email Anda">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Submit Button -->
        <button type="submit"
                class="w-full px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200">
            Kirim Link Reset Password
        </button>

        <!-- Back to Login Link -->
        <div class="text-center pt-4">
            <a href="{{ route('login') }}"
               class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Login
            </a>
        </div>
    </form>
</x-guest-layout>
