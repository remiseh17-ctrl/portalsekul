<!-- Modal Edit Pengumuman -->
<div class="modal fade" id="modalEditPengumuman{{ $pengumuman->id }}" tabindex="-1" aria-labelledby="modalEditPengumumanLabel{{ $pengumuman->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content bg-white dark:bg-gray-800 rounded-xl shadow-lg border-0 overflow-y-auto max-h-[90vh]">
      <form action="{{ route('pengumuman.update', $pengumuman->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-header border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 flex justify-between items-center">
          <h5 class="modal-title font-bold text-gray-900 dark:text-white flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            Edit Pengumuman
          </h5>
          <button type="button" class="text-gray-600 hover:text-red-500 transition" data-bs-dismiss="modal" aria-label="Tutup">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
          </button>
        </div>
        <div class="modal-body overflow-y-auto max-h-[70vh]">
          <div class="grid grid-cols-1 gap-4">
            <div>
              <label class="block text-gray-700 dark:text-gray-300 font-semibold">Judul <span class="text-red-500">*</span></label>
              <input type="text" name="judul" value="{{ old('judul', $pengumuman->judul) }}" class="form-input mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-orange-500 focus:border-orange-500 transition" required>
            </div>
            <div>
              <label class="block text-gray-700 dark:text-gray-300 font-semibold">Tanggal <span class="text-red-500">*</span></label>
              <input type="date" name="tanggal" value="{{ old('tanggal', $pengumuman->tanggal->format('Y-m-d')) }}" class="form-input mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-orange-500 focus:border-orange-500 transition" required>
            </div>
            <div>
              <label class="block text-gray-700 dark:text-gray-300 font-semibold">Isi <span class="text-red-500">*</span></label>
              <textarea name="isi" class="form-textarea mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-orange-500 focus:border-orange-500 transition" rows="4" required>{{ old('isi', $pengumuman->isi) }}</textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer flex justify-between bg-gray-50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-700">
          <button type="button" class="btn btn-secondary rounded-lg px-4 py-2 flex items-center gap-2" data-bs-dismiss="modal">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            Batal
          </button>
          <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white rounded-lg px-4 py-2 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            Update
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
