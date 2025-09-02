<!-- Create Pengumuman Modal -->
<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" id="createPengumumanModal" style="display: none;">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-4 rounded-t-2xl">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                        <i data-lucide="megaphone" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold">Buat Pengumuman Baru</h3>
                        <p class="text-indigo-100 text-sm">Kirim pengumuman ke siswa</p>
                    </div>
                </div>
                <button onclick="closeCreatePengumumanModal()" class="text-white hover:text-red-300 transition-colors">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>
        </div>

        <!-- Modal Body -->
        <div class="p-6">
            <form id="createPengumumanForm" method="POST" action="{{ route('pengumuman-kelas.store') }}">
                @csrf

                <!-- Kelas Selection -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Pilih Kelas Tujuan <span class="text-red-500">*</span>
                    </label>
                    {{-- Debug: @if(isset($kelas)) Kelas count: {{ $kelas->count() ?? 0 }} @endif --}}
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @if(isset($kelas) && $kelas->count() > 0)
                            @foreach($kelas as $k)
                            <label class="relative">
                                <input type="radio" name="kelas_id" value="{{ $k->id }}"
                                       class="sr-only peer" required>
                                <div class="p-3 border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-indigo-500 peer-checked:bg-indigo-50 transition-all hover:border-indigo-300">
                                    <div class="flex items-center justify-center space-x-2">
                                        <i data-lucide="school" class="w-4 h-4 text-indigo-500"></i>
                                        <div class="text-center">
                                            <div class="font-semibold text-gray-900">{{ $k->nama_kelas }}</div>
                                            <div class="text-sm text-gray-600">{{ $k->wali_kelas }}</div>
                                        </div>
                                    </div>
                                </div>
                            </label>
                            @endforeach
                        @else
                        <div class="col-span-full text-center py-8">
                            <div class="text-gray-500">
                                <i data-lucide="school" class="w-12 h-12 mx-auto mb-4 text-gray-300"></i>
                                <p class="font-medium">Tidak ada kelas yang tersedia</p>
                                <p class="text-sm text-gray-400 mt-1">Anda belum memiliki jadwal mengajar di kelas manapun</p>
                            </div>
                        </div>
                        @endif
                    </div>
                    <x-input-error :messages="$errors->get('kelas_id')" class="mt-2" />
                </div>

                <!-- Pengumuman Details -->
                <div class="space-y-6">
                    <!-- Judul Pengumuman -->
                    <div>
                        <label for="judul" class="block text-sm font-semibold text-gray-700 mb-2">
                            Judul Pengumuman <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="judul" name="judul"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                               placeholder="Masukkan judul pengumuman" required>
                        <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                    </div>


                    <!-- Isi Pengumuman -->
                    <div>
                        <label for="isi" class="block text-sm font-semibold text-gray-700 mb-2">
                            Isi Pengumuman <span class="text-red-500">*</span>
                        </label>
                        <textarea id="isi" name="isi" rows="6"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all resize-none"
                                  placeholder="Tulis isi pengumuman di sini..." required></textarea>
                        <x-input-error :messages="$errors->get('isi')" class="mt-2" />
                    </div>

                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="bg-gray-50 px-6 py-4 rounded-b-2xl flex justify-end space-x-3">
            <button onclick="closeCreatePengumumanModal()"
                    class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                Batal
            </button>
            <button type="submit" form="createPengumumanForm"
                    class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors flex items-center space-x-2">
                <i data-lucide="send" class="w-4 h-4"></i>
                <span>Kirim Pengumuman</span>
            </button>
        </div>
    </div>
</div>

<script>
function closeCreatePengumumanModal() {
    document.getElementById('createPengumumanModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}
</script>