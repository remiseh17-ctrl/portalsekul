<!-- Modal Create Materi -->
<div class="modal fade" id="modalCreateMateri" tabindex="-1" aria-labelledby="modalCreateMateriLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content bg-white dark:bg-gray-800 rounded-xl shadow-lg border-0 overflow-y-auto max-h-[90vh]">
      <form action="{{ route('materi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Header -->
        <div class="modal-header border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 flex justify-between items-center">
          <h5 class="modal-title font-bold text-gray-900 dark:text-white flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-violet-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Upload Materi Baru
          </h5>
          <button type="button" class="text-gray-600 hover:text-red-500 transition" data-bs-dismiss="modal" aria-label="Tutup">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>

        <!-- Body -->
        <div class="modal-body overflow-y-auto max-h-[70vh]">
          @if($errors->any())
            <div class="bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 p-3 rounded-lg mb-4">
              <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <!-- Jadwal Selection -->
          <div class="mb-6">
            <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">
              Pilih Jadwal Mengajar <span class="text-red-500">*</span>
            </label>
            <div class="mb-3 p-3 bg-violet-50 dark:bg-violet-900/30 border border-violet-200 dark:border-violet-800 rounded-lg">
              <div class="flex items-center">
                <div class="w-5 h-5 bg-violet-100 dark:bg-violet-900/50 rounded-full flex items-center justify-center mr-2">
                  <i data-lucide="info" class="w-3 h-3 text-violet-600 dark:text-violet-400"></i>
                </div>
                <p class="text-sm text-violet-800 dark:text-violet-200">
                  <strong>Pilih jadwal mengajar Anda untuk mengupload materi.</strong>
                  Materi akan otomatis diupload ke kelas sesuai jadwal yang dipilih.
                </p>
              </div>
            </div>
            <select name="jadwal_id" class="form-select mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-violet-500 focus:border-violet-500 transition" required>
              <option value="">Pilih Jadwal Mengajar</option>
              @php
                $jadwals = \App\Models\Jadwal::where('guru_id', auth()->user()->guru->id ?? 0)
                  ->with('kelas')
                  ->get();
              @endphp
              @forelse($jadwals as $jadwal)
                <option value="{{ $jadwal->id }}">
                  {{ $jadwal->mapel }} - {{ $jadwal->kelas->nama ?? 'Kelas tidak ditemukan' }} ({{ $jadwal->hari }} {{ $jadwal->jam_mulai }}-{{ $jadwal->jam_selesai }})
                </option>
              @empty
                <option value="" disabled>Tidak ada jadwal mengajar tersedia</option>
              @endforelse
            </select>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Judul Materi -->
            <div class="md:col-span-2">
              <label class="block text-gray-700 dark:text-gray-300 font-semibold">Judul Materi <span class="text-red-500">*</span></label>
              <input type="text" name="judul" value="{{ old('judul') }}" placeholder="Masukkan judul materi" class="form-input mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-violet-500 focus:border-violet-500 transition" required>
            </div>
          </div>

          <!-- Hidden mapel field that will be auto-filled -->
          <input type="hidden" name="mapel" id="auto_mapel" value="">

          <!-- Deskripsi -->
          <div class="mt-4">
            <label class="block text-gray-700 dark:text-gray-300 font-semibold">Deskripsi Materi</label>
            <textarea name="deskripsi" rows="4" placeholder="Jelaskan materi yang akan diupload..." class="form-textarea mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-violet-500 focus:border-violet-500 transition resize-none">{{ old('deskripsi') }}</textarea>
          </div>

          <!-- File Upload -->
          <div class="mt-4">
            <label class="block text-gray-700 dark:text-gray-300 font-semibold">
              Upload File Materi <span class="text-red-500">*</span>
            </label>
            <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center hover:border-violet-400 dark:hover:border-violet-500 transition-colors">
              <div class="space-y-4">
                <div class="mx-auto w-12 h-12 bg-violet-100 dark:bg-violet-900/30 rounded-full flex items-center justify-center">
                  <i data-lucide="upload" class="w-6 h-6 text-violet-600 dark:text-violet-400"></i>
                </div>
                <div>
                  <p class="text-gray-600 dark:text-gray-300">Drag & drop file atau klik untuk upload</p>
                  <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Format: PDF, DOC, DOCX, PPT, PPTX, XLS, XLSX (Max: 10MB)</p>
                </div>
                <input type="file" name="file_materi" class="hidden" accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx" required>
                <button type="button" onclick="document.querySelector('input[name=file_materi]').click()" class="px-4 py-2 bg-violet-600 dark:bg-violet-500 text-white rounded-lg hover:bg-violet-700 dark:hover:bg-violet-600 transition-colors">
                  Pilih File
                </button>
              </div>
              <div id="file-info" class="mt-4 text-sm text-gray-600 dark:text-gray-400 hidden">
                <p>File dipilih: <span id="file-name" class="font-medium"></span></p>
                <p>Ukuran: <span id="file-size" class="font-medium"></span></p>
              </div>
            </div>
          </div>

          <div class="bg-violet-100 dark:bg-violet-900/30 text-violet-800 dark:text-violet-300 p-3 rounded-lg mt-4 text-sm">
            <strong>Tips:</strong> Pastikan file yang diupload sesuai format dan ukuran yang diizinkan.
          </div>
        </div>

        <!-- Footer -->
        <div class="modal-footer flex justify-between bg-gray-50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-700">
          <button type="button" class="btn btn-secondary rounded-lg px-4 py-2 flex items-center gap-2" data-bs-dismiss="modal">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            Batal
          </button>
          <button type="submit" class="bg-violet-600 hover:bg-violet-700 text-white rounded-lg px-4 py-2 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            Upload Materi
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
// File upload preview
document.querySelector('input[name=file_materi]').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const fileInfo = document.getElementById('file-info');
        const fileName = document.getElementById('file-name');
        const fileSize = document.getElementById('file-size');

        fileName.textContent = file.name;
        fileSize.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
        fileInfo.classList.remove('hidden');
    }
});

// Auto-fill mapel when jadwal is selected
document.querySelector('select[name=jadwal_id]').addEventListener('change', function() {
    const jadwalId = this.value;
    const mapelField = document.getElementById('auto_mapel');
    
    if (jadwalId) {
        const selectedOption = this.options[this.selectedIndex];
        const mapelText = selectedOption.textContent.split(' - ')[0];
        
        // Auto-fill the hidden mapel field
        mapelField.value = mapelText;
        
        // Show info about selected mapel
        const infoDiv = document.querySelector('.bg-violet-50');
        if (infoDiv) {
            infoDiv.innerHTML = `
                <div class="flex items-center">
                    <div class="w-5 h-5 bg-violet-100 dark:bg-violet-900/50 rounded-full flex items-center justify-center mr-2">
                        <i data-lucide="check-circle" class="w-3 h-3 text-violet-600 dark:text-violet-400"></i>
                    </div>
                    <p class="text-sm text-violet-800 dark:text-violet-200">
                        <strong>Mata Pelajaran: ${mapelText}</strong><br>
                        Materi akan diupload untuk kelas sesuai jadwal yang dipilih.
                    </p>
                </div>
            `;
        }
    } else {
        // Reset mapel field and show original info
        mapelField.value = '';
        const infoDiv = document.querySelector('.bg-violet-50');
        if (infoDiv) {
            infoDiv.innerHTML = `
                <div class="flex items-center">
                    <div class="w-5 h-5 bg-violet-100 dark:bg-violet-900/50 rounded-full flex items-center justify-center mr-2">
                        <i data-lucide="info" class="w-3 h-3 text-violet-600 dark:text-violet-400"></i>
                    </div>
                    <p class="text-sm text-violet-800 dark:text-violet-200">
                        <strong>Pilih jadwal mengajar Anda untuk mengupload materi.</strong>
                        Materi akan otomatis diupload ke kelas sesuai jadwal yang dipilih.
                    </p>
                </div>
            `;
        }
    }
});
</script>