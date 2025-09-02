<!-- Modal View Materi -->
<div class="modal fade" id="modalViewMateri{{ $materi->id }}" tabindex="-1" aria-labelledby="modalViewMateriLabel{{ $materi->id }}" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content bg-white dark:bg-gray-800 rounded-xl shadow-lg border-0 overflow-y-auto max-h-[90vh]">
      <div class="modal-header border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 flex justify-between items-center">
        <h5 class="modal-title font-bold text-gray-900 dark:text-white flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
          </svg>
          Detail Materi Pembelajaran
        </h5>
        <button type="button" class="text-gray-600 hover:text-red-500 transition" data-bs-dismiss="modal" aria-label="Tutup">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>
      <div class="modal-body overflow-y-auto max-h-[70vh]">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
          <!-- Materi Information -->
          <div class="lg:col-span-2 space-y-6">
            <!-- Basic Info -->
            <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6">
              <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Informasi Materi
              </h4>
              <div class="space-y-3">
                <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-gray-600">
                  <span class="text-gray-600 dark:text-gray-400">Judul:</span>
                  <span class="font-semibold text-gray-900 dark:text-white">{{ $materi->judul }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-gray-600">
                  <span class="text-gray-600 dark:text-gray-400">Mata Pelajaran:</span>
                  <span class="font-semibold text-gray-900 dark:text-white">{{ $materi->jadwal->mapel ?? '-' }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-gray-600">
                  <span class="text-gray-600 dark:text-gray-400">Tanggal Upload:</span>
                  <span class="font-semibold text-gray-900 dark:text-white">{{ $materi->created_at->format('d M Y') }}</span>
                </div>
                <div class="flex justify-between items-center py-2">
                  <span class="text-gray-600 dark:text-gray-400">Status:</span>
                  <span class="px-3 py-1 rounded-full text-sm font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200">Aktif</span>
                </div>
              </div>
            </div>

            <!-- Description -->
            <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6">
              <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Deskripsi
              </h4>
              <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $materi->deskripsi ?: 'Tidak ada deskripsi tersedia.' }}</p>
            </div>
          </div>

          <!-- File & Classes Info -->
          <div class="space-y-6">
            <!-- File Information -->
            <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6">
              <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
                File Materi
              </h4>
              <div class="space-y-3">
                <div class="flex items-center space-x-3 p-3 bg-white dark:bg-gray-600 rounded-lg">
                  <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $materi->file ? basename($materi->file) : 'Tidak ada file' }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $materi->file ? 'File tersedia' : 'Tidak ada file' }}</p>
                  </div>
                </div>
                @if($materi->file)
                  <a href="{{ Storage::url($materi->file) }}" target="_blank" class="w-full px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white text-center rounded-lg hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300 inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Download File
                  </a>
                @endif
              </div>
            </div>

            <!-- Classes -->
            <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6">
              <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-orange-600 dark:text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-1.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                </svg>
                Kelas Tujuan
              </h4>
              <div class="space-y-2">
                <div class="flex items-center space-x-2 p-2 bg-white dark:bg-gray-600 rounded-lg">
                  <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                  </div>
                  <div>
                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $materi->jadwal->mapel ?? 'Mata Pelajaran' }} ({{ $materi->jadwal->hari ?? 'Hari' }} {{ $materi->jadwal->jam_mulai ?? '' }}-{{ $materi->jadwal->jam_selesai ?? '' }})</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Jadwal mengajar aktif</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer flex justify-end bg-gray-50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-700">
        <button type="button" class="bg-gray-600 dark:bg-gray-500 text-white rounded-lg px-4 py-2 hover:bg-gray-700 dark:hover:bg-gray-600 transition-colors" data-bs-dismiss="modal">
          Tutup
        </button>
      </div>
    </div>
  </div>
</div>