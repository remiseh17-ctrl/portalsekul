<!-- Modal Create Jadwal -->
<div class="modal fade" id="modalCreateJadwal" tabindex="-1" aria-labelledby="modalCreateJadwalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content bg-white dark:bg-gray-800 rounded-xl shadow-lg border-0 overflow-y-auto max-h-[90vh]">
      <form action="{{ route('jadwal.store') }}" method="POST">
        @csrf
        <!-- Header -->
        <div class="modal-header border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 flex justify-between items-center">
          <h5 class="modal-title font-bold text-gray-900 dark:text-white flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Jadwal Baru
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
            <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">
              <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Kelas -->
            <div>
              <label class="block text-gray-700 dark:text-gray-300 font-semibold">Kelas</label>
              <select name="kelas_id" class="form-select mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 transition" required>
                <option value="">Pilih Kelas</option>
                @foreach($kelasList as $kelas)
                  <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                @endforeach
              </select>
            </div>
            <!-- Mata Pelajaran -->
            <div>
              <label class="block text-gray-700 dark:text-gray-300 font-semibold">Mata Pelajaran</label>
              <input type="text" name="mapel" value="{{ old('mapel') }}" placeholder="Contoh: Matematika" class="form-input mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 transition" required>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <!-- Guru -->
            <div>
              <label class="block text-gray-700 dark:text-gray-300 font-semibold">Guru</label>
              <select name="guru_id" class="form-select mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 transition" required>
                <option value="">Pilih Guru</option>
                @foreach($guruList as $guru)
                  <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                @endforeach
              </select>
            </div>
            <!-- Hari -->
            <div>
              <label class="block text-gray-700 dark:text-gray-300 font-semibold">Hari</label>
              <select name="hari" class="form-select mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 transition" required>
                <option value="">Pilih Hari</option>
                @foreach($hariList as $hari)
                  <option value="{{ $hari }}">{{ $hari }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <!-- Jam Mulai -->
            <div>
              <label class="block text-gray-700 dark:text-gray-300 font-semibold">Jam Mulai</label>
              <input type="time" name="jam_mulai" step="900" class="form-input mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 transition" required>
            </div>
            <!-- Jam Selesai -->
            <div>
              <label class="block text-gray-700 dark:text-gray-300 font-semibold">Jam Selesai</label>
              <input type="time" name="jam_selesai" step="900" class="form-input mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 transition" required>
            </div>
          </div>

          <div class="bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 p-3 rounded-lg mt-4 text-sm">
            <strong>Tips:</strong> Gunakan format 24 jam. Pastikan jadwal tidak bentrok.
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
          <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg px-4 py-2 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            Simpan Jadwal
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
