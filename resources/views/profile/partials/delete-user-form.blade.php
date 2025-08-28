<div class="space-y-6">
    <!-- Warning Message -->
    <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
        <div class="flex items-start space-x-3">
            <svg class="w-6 h-6 text-red-600 dark:text-red-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
            </svg>
            <div>
                <h4 class="text-sm font-medium text-red-900 dark:text-red-300">Peringatan Penting!</h4>
                <p class="mt-2 text-sm text-red-800 dark:text-red-400">
                    Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. 
                    Sebelum menghapus akun, silakan unduh data atau informasi yang ingin Anda simpan.
                </p>
            </div>
        </div>
    </div>

    <!-- Consequences List -->
    <div class="bg-gray-50 dark:bg-gray-800/50 rounded-lg p-4">
        <h4 class="text-sm font-medium text-gray-900 dark:text-gray-300 mb-3">Yang akan terjadi setelah penghapusan:</h4>
        <ul class="space-y-2 text-sm text-gray-700 dark:text-gray-400">
            <li class="flex items-center space-x-2">
                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span>Semua data profil akan dihapus permanen</span>
            </li>
            <li class="flex items-center space-x-2">
                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span>Akses ke sistem akan dicabut</span>
            </li>
            <li class="flex items-center space-x-2">
                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span>Riwayat aktivitas akan hilang</span>
            </li>
            <li class="flex items-center space-x-2">
                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span>Data tidak dapat dipulihkan</span>
            </li>
        </ul>
    </div>

    <!-- Delete Button -->
    <div class="flex justify-start">
        <button 
            type="button" 
            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-medium rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 hover:scale-105 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800" 
            data-bs-toggle="modal" 
            data-bs-target="#confirm-user-deletion">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
            Hapus Akun Permanen
        </button>
    </div>
</div>

<!-- Enhanced Confirmation Modal -->
<div class="modal fade" id="confirm-user-deletion" tabindex="-1" aria-labelledby="confirm-user-deletion-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-white dark:bg-gray-800 rounded-xl shadow-2xl border-0 overflow-hidden">
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-red-50 dark:bg-red-900/20">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <div>
                        <h5 class="text-lg font-semibold text-red-900 dark:text-red-300" id="confirm-user-deletion-label">
                            Konfirmasi Penghapusan Akun
                        </h5>
                        <p class="text-sm text-red-700 dark:text-red-400">Tindakan ini tidak dapat dibatalkan</p>
                    </div>
                </div>
                <button type="button" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" data-bs-dismiss="modal" aria-label="Close">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Modal Body -->
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')
                
                <div class="px-6 py-6 space-y-6">
                    <!-- Final Warning -->
                    <div class="text-center">
                        <div class="w-16 h-16 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                            Yakin ingin menghapus akun?
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Setelah akun dihapus, semua sumber daya dan data akan dihapus secara permanen. 
                            Masukkan password Anda untuk mengkonfirmasi penghapusan akun.
                        </p>
                    </div>
                    
                    <!-- Password Confirmation -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                <span>Konfirmasi Password</span>
                            </div>
                        </label>
                        <div class="relative">
                            <input 
                                id="password" 
                                name="password" 
                                type="password" 
                                class="w-full px-4 py-3 pr-12 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-red-500 dark:focus:ring-red-400 focus:border-red-500 dark:focus:border-red-400 transition-all duration-200 @error('password', 'userDeletion') border-red-500 ring-2 ring-red-500 @enderror" 
                                placeholder="Masukkan password untuk konfirmasi" 
                                required>
                            <button type="button" onclick="toggleModalPassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <svg class="w-5 h-5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                        @error('password', 'userDeletion')
                            <div class="mt-2 flex items-center space-x-2 text-red-600 dark:text-red-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Confirmation Checkbox -->
                    <div class="flex items-start space-x-3">
                        <input 
                            id="confirmDeletion" 
                            type="checkbox" 
                            class="mt-1 w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                            required>
                        <label for="confirmDeletion" class="text-sm text-gray-700 dark:text-gray-300">
                            Saya memahami bahwa tindakan ini akan menghapus akun saya secara permanen dan tidak dapat dibatalkan.
                        </label>
                    </div>
                </div>
                
                <!-- Modal Footer -->
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <button 
                        type="button" 
                        class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-600 text-gray-800 dark:text-gray-200 font-medium rounded-lg hover:bg-gray-300 dark:hover:bg-gray-500 transition-all duration-200" 
                        data-bs-dismiss="modal">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Batal
                    </button>
                    <button 
                        type="submit" 
                        class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white font-medium rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 hover:scale-105 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Hapus Akun Selamanya
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function toggleModalPassword() {
    const field = document.getElementById('password');
    const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
    field.setAttribute('type', type);
}
</script>