<form method="post" action="{{ route('password.update') }}" class="space-y-6">
    @csrf
    @method('put')

    <!-- Current Password -->
    <div>
        <label for="update_password_current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            <div class="flex items-center space-x-2">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                <span>Password Saat Ini</span>
            </div>
        </label>
        <div class="relative">
            <input 
                id="update_password_current_password" 
                name="current_password" 
                type="password" 
                class="w-full px-4 py-3 pr-12 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-200 @error('current_password', 'updatePassword') border-red-500 ring-2 ring-red-500 @enderror" 
                autocomplete="current-password"
                placeholder="Masukkan password saat ini">
            <button type="button" onclick="togglePassword('update_password_current_password')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                <svg class="w-5 h-5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
            </button>
        </div>
        @error('current_password', 'updatePassword')
            <div class="mt-2 flex items-center space-x-2 text-red-600 dark:text-red-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-sm">{{ $message }}</span>
            </div>
        @enderror
    </div>

    <!-- New Password -->
    <div>
        <label for="update_password_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            <div class="flex items-center space-x-2">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                <span>Password Baru</span>
            </div>
        </label>
        <div class="relative">
            <input 
                id="update_password_password" 
                name="password" 
                type="password" 
                class="w-full px-4 py-3 pr-12 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-200 @error('password', 'updatePassword') border-red-500 ring-2 ring-red-500 @enderror" 
                autocomplete="new-password"
                placeholder="Masukkan password baru"
                onkeyup="checkPasswordStrength(this.value)">
            <button type="button" onclick="togglePassword('update_password_password')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                <svg class="w-5 h-5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
            </button>
        </div>
        
        <!-- Password Strength Indicator -->
        <div id="passwordStrength" class="mt-2 hidden">
            <div class="flex items-center space-x-2">
                <div class="flex-1 bg-gray-200 dark:bg-gray-600 rounded-full h-2">
                    <div id="strengthBar" class="h-2 rounded-full transition-all duration-300"></div>
                </div>
                <span id="strengthText" class="text-xs font-medium"></span>
            </div>
        </div>
        
        @error('password', 'updatePassword')
            <div class="mt-2 flex items-center space-x-2 text-red-600 dark:text-red-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-sm">{{ $message }}</span>
            </div>
        @enderror
    </div>

    <!-- Confirm Password -->
    <div>
        <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            <div class="flex items-center space-x-2">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Konfirmasi Password Baru</span>
            </div>
        </label>
        <div class="relative">
            <input 
                id="update_password_password_confirmation" 
                name="password_confirmation" 
                type="password" 
                class="w-full px-4 py-3 pr-12 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-200 @error('password_confirmation', 'updatePassword') border-red-500 ring-2 ring-red-500 @enderror" 
                autocomplete="new-password"
                placeholder="Konfirmasi password baru">
            <button type="button" onclick="togglePassword('update_password_password_confirmation')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                <svg class="w-5 h-5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
            </button>
        </div>
        @error('password_confirmation', 'updatePassword')
            <div class="mt-2 flex items-center space-x-2 text-red-600 dark:text-red-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-sm">{{ $message }}</span>
            </div>
        @enderror
    </div>

    <!-- Password Requirements -->
    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
        <div class="flex items-start space-x-3">
            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div>
                <h4 class="text-sm font-medium text-blue-900 dark:text-blue-300">Persyaratan Password:</h4>
                <ul class="mt-2 text-sm text-blue-800 dark:text-blue-400 space-y-1">
                    <li>• Minimal 8 karakter</li>
                    <li>• Kombinasi huruf besar dan kecil</li>
                    <li>• Minimal 1 angka</li>
                    <li>• Minimal 1 karakter khusus (!@#$%^&*)</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="flex items-center justify-between pt-4">
        <div class="flex items-center space-x-4">
            <button 
                type="submit" 
                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-medium rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 hover:scale-105 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                Update Password
            </button>
            
            @if (session('status') === 'password-updated')
                <div class="flex items-center space-x-2 text-green-600 dark:text-green-400 animate-fade-in">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-sm font-medium">Password berhasil diperbarui!</span>
                </div>
            @endif
        </div>
    </div>
</form>

<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
    field.setAttribute('type', type);
}

function checkPasswordStrength(password) {
    const strengthIndicator = document.getElementById('passwordStrength');
    const strengthBar = document.getElementById('strengthBar');
    const strengthText = document.getElementById('strengthText');
    
    if (password.length === 0) {
        strengthIndicator.classList.add('hidden');
        return;
    }
    
    strengthIndicator.classList.remove('hidden');
    
    let strength = 0;
    let feedback = '';
    
    // Length check
    if (password.length >= 8) strength += 1;
    
    // Uppercase check
    if (/[A-Z]/.test(password)) strength += 1;
    
    // Lowercase check
    if (/[a-z]/.test(password)) strength += 1;
    
    // Number check
    if (/[0-9]/.test(password)) strength += 1;
    
    // Special character check
    if (/[^A-Za-z0-9]/.test(password)) strength += 1;
    
    // Update UI based on strength
    switch (strength) {
        case 0:
        case 1:
            strengthBar.style.width = '20%';
            strengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-red-500';
            strengthText.textContent = 'Sangat Lemah';
            strengthText.className = 'text-xs font-medium text-red-600 dark:text-red-400';
            break;
        case 2:
            strengthBar.style.width = '40%';
            strengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-orange-500';
            strengthText.textContent = 'Lemah';
            strengthText.className = 'text-xs font-medium text-orange-600 dark:text-orange-400';
            break;
        case 3:
            strengthBar.style.width = '60%';
            strengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-yellow-500';
            strengthText.textContent = 'Sedang';
            strengthText.className = 'text-xs font-medium text-yellow-600 dark:text-yellow-400';
            break;
        case 4:
            strengthBar.style.width = '80%';
            strengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-blue-500';
            strengthText.textContent = 'Kuat';
            strengthText.className = 'text-xs font-medium text-blue-600 dark:text-blue-400';
            break;
        case 5:
            strengthBar.style.width = '100%';
            strengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-green-500';
            strengthText.textContent = 'Sangat Kuat';
            strengthText.className = 'text-xs font-medium text-green-600 dark:text-green-400';
            break;
    }
}
</script>

<style>
@keyframes fade-in {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-fade-in {
    animation: fade-in 0.5s ease-out;
}
</style>