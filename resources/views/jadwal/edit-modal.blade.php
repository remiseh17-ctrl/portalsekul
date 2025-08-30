<!-- Modal Edit Jadwal -->
<div class="modal fade" id="modalEditJadwal{{ $jadwal->id }}" tabindex="-1" aria-labelledby="modalEditJadwalLabel{{ $jadwal->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content bg-white dark:bg-gray-800 rounded-xl shadow-lg border-0 overflow-y-auto max-h-[90vh]">
      <form action="{{ route('jadwal.update', $jadwal) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-header border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 flex justify-between items-center">
          <h5 class="modal-title font-bold text-gray-900 dark:text-white flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            Edit Jadwal
          </h5>
          <button type="button" class="text-gray-600 hover:text-red-500 transition" data-bs-dismiss="modal" aria-label="Tutup">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
          </button>
        </div>
        <div class="modal-body overflow-y-auto max-h-[70vh]">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-gray-700 dark:text-gray-300 font-semibold">Kelas <span class="text-red-500">*</span></label>
              <select name="kelas_id" class="form-select mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 transition" required>
                <option value="">Pilih Kelas</option>
                @foreach($kelasList as $kelas)
                  <option value="{{ $kelas->id }}" @selected(old('kelas_id', $jadwal->kelas_id) == $kelas->id)>{{ $kelas->nama }}</option>
                @endforeach
              </select>
            </div>
            <div>
              <label class="block text-gray-700 dark:text-gray-300 font-semibold">Guru <span class="text-red-500">*</span></label>
              <select name="guru_id" class="form-select mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 transition" required>
                <option value="">Pilih Guru</option>
                @foreach($guruList as $guru)
                  <option value="{{ $guru->id }}" @selected(old('guru_id', $jadwal->guru_id) == $guru->id)>{{ $guru->nama }} ({{ $guru->mapel }})</option>
                @endforeach
              </select>
            </div>
            <div>
              <label class="block text-gray-700 dark:text-gray-300 font-semibold">Hari <span class="text-red-500">*</span></label>
              <select name="hari" class="form-select mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 transition" required>
                <option value="">Pilih Hari</option>
                <option value="Senin" @selected(old('hari', $jadwal->hari) == 'Senin')>Senin</option>
                <option value="Selasa" @selected(old('hari', $jadwal->hari) == 'Selasa')>Selasa</option>
                <option value="Rabu" @selected(old('hari', $jadwal->hari) == 'Rabu')>Rabu</option>
                <option value="Kamis" @selected(old('hari', $jadwal->hari) == 'Kamis')>Kamis</option>
                <option value="Jumat" @selected(old('hari', $jadwal->hari) == 'Jumat')>Jumat</option>
                <option value="Sabtu" @selected(old('hari', $jadwal->hari) == 'Sabtu')>Sabtu</option>
              </select>
            </div>
            <div>
              <label class="block text-gray-700 dark:text-gray-300 font-semibold">Jam Mulai <span class="text-red-500">*</span></label>
              <input type="time" name="jam_mulai" value="{{ old('jam_mulai', $jadwal->jam_mulai) }}" class="form-input mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 transition" required>
            </div>
            <div>
              <label class="block text-gray-700 dark:text-gray-300 font-semibold">Jam Selesai <span class="text-red-500">*</span></label>
              <input type="time" name="jam_selesai" value="{{ old('jam_selesai', $jadwal->jam_selesai) }}" class="form-input mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 transition" required>
            </div>
            <div>
              <label class="block text-gray-700 dark:text-gray-300 font-semibold">Mata Pelajaran <span class="text-red-500">*</span></label>
              <input type="text" name="mata_pelajaran" value="{{ old('mata_pelajaran', $jadwal->mata_pelajaran) }}" class="form-input mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 transition" required>
            </div>
            <div>
              <label class="block text-gray-700 dark:text-gray-300 font-semibold">Ruangan</label>
              <input type="text" name="ruangan" value="{{ old('ruangan', $jadwal->ruangan) }}" class="form-input mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 transition" placeholder="Contoh: Lab 1, Ruang 101">
            </div>
            <div class="md:col-span-2">
              <label class="block text-gray-700 dark:text-gray-300 font-semibold">Keterangan</label>
              <textarea name="keterangan" class="form-textarea mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 transition" rows="3" placeholder="Keterangan tambahan (opsional)">{{ old('keterangan', $jadwal->keterangan) }}</textarea>
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
