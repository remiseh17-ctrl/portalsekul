<!-- Modal Edit Absensi -->
<div class="modal fade" id="modalEditAbsensi{{ $absensi->id }}" tabindex="-1" aria-labelledby="modalEditAbsensiLabel{{ $absensi->id }}" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content bg-white dark:bg-gray-800 rounded-xl shadow-lg border-0 overflow-y-auto max-h-[90vh]">
      <form action="{{ route('absensi.update', $absensi) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-header border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 flex justify-between items-center">
          <h5 class="modal-title font-bold text-gray-900 dark:text-white flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            Edit Absensi
          </h5>
          <button type="button" class="text-gray-600 hover:text-red-500 transition" data-bs-dismiss="modal" aria-label="Tutup">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
          </button>
        </div>
        <div class="modal-body overflow-y-auto max-h-[70vh]">
          <div class="space-y-4">
            <div>
              <label class="block text-gray-700 dark:text-gray-300 font-semibold">Siswa</label>
              <input type="text" value="{{ $absensi->siswa->nama ?? 'N/A' }}" class="form-input mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-900 dark:text-white" readonly>
              <small class="text-gray-500">Nama siswa tidak dapat diubah</small>
            </div>
            <div>
              <label class="block text-gray-700 dark:text-gray-300 font-semibold">Tanggal <span class="text-red-500">*</span></label>
              <input type="date" name="tanggal" value="{{ old('tanggal', formatDateForInput($absensi->tanggal)) }}" class="form-input mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 transition" required>
            </div>
            <div>
              <label class="block text-gray-700 dark:text-gray-300 font-semibold">Status <span class="text-red-500">*</span></label>
              <select name="status" class="form-select mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 transition" required>
                <option value="">Pilih Status</option>
                <option value="Hadir" @selected(old('status', $absensi->status) == 'Hadir')>Hadir</option>
                <option value="Sakit" @selected(old('status', $absensi->status) == 'Sakit')>Sakit</option>
                <option value="Izin" @selected(old('status', $absensi->status) == 'Izin')>Izin</option>
                <option value="Alpha" @selected(old('status', $absensi->status) == 'Alpha')>Alpha</option>
              </select>
            </div>
            <div>
              <label class="block text-gray-700 dark:text-gray-300 font-semibold">Keterangan</label>
              <textarea name="keterangan" class="form-textarea mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 transition" rows="3" placeholder="Keterangan tambahan (opsional)">{{ old('keterangan', $absensi->keterangan) }}</textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer flex justify-between bg-gray-50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-700">
          <button type="button" class="btn btn-secondary rounded-lg px-4 py-2 flex items-center gap-2" data-bs-dismiss="modal">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            Batal
          </button>
          <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg px-4 py-2 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            Update
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
