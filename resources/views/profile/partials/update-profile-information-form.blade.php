<form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('patch')

    <!-- Name Field -->
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            <div class="flex items-center space-x-2">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span>Nama Lengkap</span>
            </div>
        </label>
        <input 
            id="name" 
            name="name" 
            type="text" 
            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-200 @error('name') border-red-500 ring-2 ring-red-500 @enderror" 
            value="{{ old('name', $user->name) }}" 
            required 
            autofocus 
            autocomplete="name"
            placeholder="Masukkan nama lengkap Anda">
        @error('name')
            <div class="mt-2 flex items-center space-x-2 text-red-600 dark:text-red-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-sm">{{ $message }}</span>
            </div>
        @enderror
    </div>

    <!-- Avatar Field -->
    <div>
        <label for="avatar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            <div class="flex items-center space-x-2">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span>Foto Profil</span>
            </div>
        </label>
        
        <!-- Current Avatar Display -->
        @if($user->avatar)
            <div class="mb-4 flex items-center space-x-4">
                <img src="{{ asset('storage/'.$user->avatar) }}" alt="Avatar saat ini" class="w-16 h-16 rounded-full object-cover border-2 border-gray-200 dark:border-gray-600 shadow-sm">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Foto profil saat ini</p>
                    <p class="text-xs text-gray-500 dark:text-gray-500">Pilih file baru untuk mengubah</p>
                </div>
            </div>
        @endif
        
        <!-- File Input -->
        <div class="relative">
            <input 
                id="avatar" 
                name="avatar" 
                type="file" 
                accept="image/*" 
                class="hidden"
                onchange="previewImage(this)">
            <label for="avatar" class="cursor-pointer inline-flex items-center px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 transition-all duration-200 w-full justify-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                </svg>
                <span>Pilih Foto Baru</span>
            </label>
        </div>
        
        <!-- Preview Area -->
        <div id="imagePreview" class="mt-4 hidden">
            <div class="flex items-center space-x-4">
                <img id="previewImg" class="w-16 h-16 rounded-full object-cover border-2 border-gray-200 dark:border-gray-600 shadow-sm">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Preview foto baru</p>
                    <button type="button" onclick="clearPreview()" class="text-xs text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">Hapus preview</button>
                </div>
            </div>
        </div>
        
        @error('avatar')
            <div class="mt-2 flex items-center space-x-2 text-red-600 dark:text-red-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-sm">{{ $message }}</span>
            </div>
        @enderror
        
        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
            Format yang didukung: JPG, PNG, GIF. Maksimal 2MB.
        </p>
    </div>

    <!-- Submit Button -->
    <div class="flex items-center justify-between pt-4">
        <div class="flex items-center space-x-4">
            <button 
                type="submit" 
                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-medium rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 hover:scale-105 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Simpan Perubahan
            </button>
            
            @if (session('status') === 'profile-updated')
                <div class="flex items-center space-x-2 text-green-600 dark:text-green-400 animate-fade-in">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-sm font-medium">Berhasil disimpan!</span>
                </div>
            @endif
        </div>
    </div>
</form>

<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

function clearPreview() {
    const preview = document.getElementById('imagePreview');
    const input = document.getElementById('avatar');
    
    preview.classList.add('hidden');
    input.value = '';
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