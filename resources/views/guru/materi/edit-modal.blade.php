<!-- Modal Edit Materi -->
<div class="modal fade" id="modalEditMateri{{ $materi->id }}" tabindex="-1" aria-labelledby="modalEditMateriLabel{{ $materi->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content bg-white dark:bg-gray-800 rounded-xl shadow-lg border-0 overflow-y-auto max-h-[90vh]">
      <form action="{{ route('materi.update', $materi) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-header border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 flex justify-between items-center">
          <h5 class="modal-title font-bold text-gray-900 dark:text-white flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            Edit Materi
          </h5>
          <button type="button" class="text-gray-600 hover:text-red-500 transition" data-bs-dismiss="modal" aria-label="Tutup">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
          </button>
        </div>
        <div class="modal-body overflow-y-auto max-h-[70vh]">
          <!-- Kelas Selection -->
          <div class="mb-6">
            <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">
              Pilih Kelas <span class="text-red-500">*</span>
            </label>
            <div class="mb-3 p-3 bg-yellow-50 dark:bg-yellow-900/30 border border-yellow-200 dark:border-yellow-800 rounded-lg">
              <div class="flex items-center">
                <div class="w-5 h-5 bg-yellow-100 dark:bg-yellow-900/50 rounded-full flex items-center justify-center mr-2">
                  <i data-lucide="info" class="w-3 h-3 text-yellow-600 dark:text-yellow-400"></i>
                </div>
                <p class="text-sm text-yellow-800 dark:text-yellow-200">
                  <strong>Pilih satu atau lebih kelas untuk memperbarui materi.</strong>
                  Materi akan dapat diakses oleh semua siswa di kelas yang dipilih.
                </p>
              </div>
            </div>
            <div class="max-h-40 overflow-y-auto border border-gray-300 dark:border-gray-600 rounded-lg p-3 bg-white dark:bg-gray-700">
              @php
                // Ambil kelas yang sudah dipilih untuk materi ini
                $selectedKelasIds = [];
                if ($materi->kelas_id) {
                  $selectedKelasIds[] = $materi->kelas_id;
                }
                if ($materi->shared_kelas) {
                  $selectedKelasIds = array_merge($selectedKelasIds, $materi->shared_kelas);
                }
              @endphp
              @forelse($availableKelas as $kelas)
                <div class="flex items-center mb-2">
                  <input type="checkbox" name="kelas_ids[]" value="{{ $kelas->id }}"
                         id="edit_kelas_{{ $materi->id }}_{{ $kelas->id }}"
                         class="w-4 h-4 text-yellow-600 bg-gray-100 border-gray-300 rounded focus:ring-yellow-500 dark:focus:ring-yellow-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                         {{ in_array($kelas->id, $selectedKelasIds) ? 'checked' : '' }}>
                  <label for="edit_kelas_{{ $materi->id }}_{{ $kelas->id }}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    {{ $kelas->nama }}
                  </label>
                </div>
              @empty
                <p class="text-gray-500 dark:text-gray-400 text-sm">Tidak ada kelas tersedia</p>
              @endforelse
            </div>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
              Pilih minimal satu kelas. Materi akan dapat diakses oleh siswa di semua kelas yang dipilih.
            </p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="md:col-span-2">
              <label class="block text-gray-700 dark:text-gray-300 font-semibold">Judul Materi <span class="text-red-500">*</span></label>
              <input type="text" name="judul" value="{{ old('judul', $materi->judul) }}" placeholder="Masukkan judul materi" class="form-input mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-yellow-500 focus:border-yellow-500 transition" required>
            </div>
          </div>


          <div class="mt-4">
            <label class="block text-gray-700 dark:text-gray-300 font-semibold">Deskripsi Materi</label>
            <textarea name="deskripsi" rows="4" placeholder="Jelaskan materi yang akan diupload..." class="form-textarea mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-yellow-500 focus:border-yellow-500 transition resize-none">{{ old('deskripsi', $materi->deskripsi) }}</textarea>
          </div>

          <!-- File Upload -->
          <div class="mt-4">
            <label class="block text-gray-700 dark:text-gray-300 font-semibold">
              Ganti File Materi (Opsional)
            </label>
            <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center hover:border-yellow-400 dark:hover:border-yellow-500 transition-colors">
              <div class="space-y-4">
                <div class="mx-auto w-12 h-12 bg-yellow-100 dark:bg-yellow-900/30 rounded-full flex items-center justify-center">
                  <i data-lucide="upload" class="w-6 h-6 text-yellow-600 dark:text-yellow-400"></i>
                </div>
                <div>
                  <p class="text-gray-600 dark:text-gray-300">Upload file baru jika ingin mengganti</p>
                  <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Format: PDF, DOC, DOCX, PPT, PPTX, XLS, XLSX (Max: 10MB)</p>
                  <p class="text-xs text-amber-600 dark:text-amber-400 mt-2">💡 Jika file > 10MB, gunakan Link Drive di bawah</p>
                </div>
                <input type="file" name="file_materi" class="hidden" accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx">
                <button type="button" onclick="document.querySelector('input[name=file_materi]').click()" class="px-4 py-2 bg-yellow-600 dark:bg-yellow-500 text-white rounded-lg hover:bg-yellow-700 dark:hover:bg-yellow-600 transition-colors">
                  Pilih File Baru
                </button>
              </div>
              <div id="edit-file-info-{{ $materi->id }}" class="mt-4 text-sm text-gray-600 dark:text-gray-400 hidden">
                <p>File dipilih: <span id="edit-file-name-{{ $materi->id }}" class="font-medium"></span></p>
                <p>Ukuran: <span id="edit-file-size-{{ $materi->id }}" class="font-medium"></span></p>
              </div>
            </div>
            <div class="mt-2 text-sm text-gray-600 dark:text-gray-400">
              <p>File saat ini: <span class="font-medium">{{ $materi->file ? basename($materi->file) : 'Tidak ada file' }}</span></p>
            </div>
          </div>

          <!-- Link Drive -->
          <div class="mt-4">
            <label class="block text-gray-700 dark:text-gray-300 font-semibold">Link Drive (Opsional)</label>
            <input type="url" name="link_drive" value="{{ old('link_drive', $materi->link_drive) }}"
                   placeholder="https://drive.google.com/file/..."
                   class="form-input mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-yellow-500 focus:border-yellow-500 transition">
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Gunakan link ini jika file terlalu besar untuk diupload langsung</p>
          </div>

          <div class="bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300 p-3 rounded-lg mt-4 text-sm">
            <strong>Tips:</strong> File lama akan diganti dengan file baru jika diupload.
          </div>
        </div>
        <div class="modal-footer flex justify-between bg-gray-50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-700">
          <button type="button" class="btn btn-secondary rounded-lg px-4 py-2 flex items-center gap-2" data-bs-dismiss="modal">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            Batal
          </button>
          <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg px-4 py-2 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            Update
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
// File upload preview for edit modal
document.querySelector('input[name=file_materi]').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const fileInfo = document.getElementById('edit-file-info-{{ $materi->id }}');
        const fileName = document.getElementById('edit-file-name-{{ $materi->id }}');
        const fileSize = document.getElementById('edit-file-size-{{ $materi->id }}');

        if (fileInfo && fileName && fileSize) {
            fileName.textContent = file.name;
            fileSize.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
            fileInfo.classList.remove('hidden');
        }
    }
});

// Validasi checkbox kelas untuk edit modal
document.addEventListener('DOMContentLoaded', function() {
    // Update info ketika checkbox berubah
    const modal = document.getElementById('modalEditMateri{{ $materi->id }}');
    if (modal) {
        const checkboxes = modal.querySelectorAll('input[name="kelas_ids[]"]');
        const infoDiv = modal.querySelector('.bg-yellow-50');

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const checkedBoxes = modal.querySelectorAll('input[name="kelas_ids[]"]:checked');

                if (checkedBoxes.length > 0) {
                    const kelasNames = Array.from(checkedBoxes).map(cb => {
                        return cb.nextElementSibling.textContent.trim();
                    }).join(', ');

                    if (infoDiv) {
                        infoDiv.innerHTML = `
                            <div class="flex items-center">
                                <div class="w-5 h-5 bg-green-100 dark:bg-green-900/50 rounded-full flex items-center justify-center mr-2">
                                    <i data-lucide="check-circle" class="w-3 h-3 text-green-600 dark:text-green-400"></i>
                                </div>
                                <p class="text-sm text-green-800 dark:text-green-200">
                                    <strong>${checkedBoxes.length} kelas dipilih:</strong> ${kelasNames}<br>
                                    Materi akan dapat diakses oleh siswa di kelas yang dipilih.
                                </p>
                            </div>
                        `;
                    }
                } else {
                    if (infoDiv) {
                        infoDiv.innerHTML = `
                            <div class="flex items-center">
                                <div class="w-5 h-5 bg-yellow-100 dark:bg-yellow-900/50 rounded-full flex items-center justify-center mr-2">
                                    <i data-lucide="info" class="w-3 h-3 text-yellow-600 dark:text-yellow-400"></i>
                                </div>
                                <p class="text-sm text-yellow-800 dark:text-yellow-200">
                                    <strong>Pilih satu atau lebih kelas untuk memperbarui materi.</strong>
                                    Materi akan dapat diakses oleh semua siswa di kelas yang dipilih.
                                </p>
                            </div>
                        `;
                    }
                }
            });
        });
    }
});
</script>