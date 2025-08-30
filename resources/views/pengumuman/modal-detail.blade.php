<!-- Modal Detail Pengumuman -->
<div class="modal fade" id="modalDetailPengumuman{{ $pengumuman->id }}" tabindex="-1" aria-labelledby="modalDetailPengumumanLabel{{ $pengumuman->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content bg-white dark:bg-gray-800 rounded-xl shadow-lg border-0">
      <div class="modal-header border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 flex justify-between items-center">
        <h5 class="modal-title font-bold text-gray-900 dark:text-white flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
          Detail Pengumuman
        </h5>
        <button type="button" class="text-gray-600 hover:text-red-500 transition" data-bs-dismiss="modal" aria-label="Tutup">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
      </div>
      <div class="modal-body p-6">
        <div class="mb-6">
          <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ $pengumuman->judul }}</h3>
          <div class="flex items-center text-gray-600 dark:text-gray-300 mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            <span class="font-medium">{{ $pengumuman->tanggal->format('d F Y') }}</span>
          </div>
          <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
            <div class="prose dark:prose-invert max-w-none">
              <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-line">{{ $pengumuman->isi }}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer flex justify-end bg-gray-50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-700">
        <button type="button" class="btn btn-secondary rounded-lg px-4 py-2 flex items-center gap-2" data-bs-dismiss="modal">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
          Tutup
        </button>
      </div>
    </div>
  </div>
</div>
