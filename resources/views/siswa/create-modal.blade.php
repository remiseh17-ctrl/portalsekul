<!-- Modal Create Siswa -->
<div class="modal fade" id="modalCreateSiswa" tabindex="-1" aria-labelledby="modalCreateSiswaLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content bg-white dark:bg-gray-800 rounded-xl shadow-lg border-0 overflow-y-auto max-h-[90vh]">
      <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 flex justify-between items-center">
          <h5 class="modal-title font-bold text-gray-900 dark:text-white flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Siswa
          </h5>
          <button type="button" class="text-gray-600 hover:text-red-500 transition" data-bs-dismiss="modal" aria-label="Tutup">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
          </button>
        </div>
        <div class="modal-body overflow-y-auto max-h-[70vh]">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-gray-700 dark:text-gray-300 font-semibold">NIS <span class="text-red-500">*</span></label>
              <input type="text" name="nis" class="form-input mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 transition" required maxlength="8" minlength="8" pattern="[0-9]{8}" placeholder="12345678" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 8)">
              <small class="text-gray-500">NIS harus tepat 8 digit angka (contoh: 12345678)</small>
            </div>
            <div>
              <label class="block text-gray-700 dark:text-gray-300 font-semibold">Nama <span class="text-red-500">*</span></label>
              <input type="text" name="nama" class="form-input mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 transition" required>
            </div>
            <div>
              <label class="block text-gray-700 dark:text-gray-300 font-semibold">Kelas <span class="text-red-500">*</span></label>
              <select name="kelas_id" class="form-select mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 transition" required>
                <option value="">Pilih Kelas</option>
                @foreach($kelasList as $kelas)
                  <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                @endforeach
              </select>
            </div>
            <div>
              <label class="block text-gray-700 dark:text-gray-300 font-semibold">Jenis Kelamin <span class="text-red-500">*</span></label>
              <select name="jenis_kelamin" class="form-select mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 transition" required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
              </select>
            </div>
            <div>
              <label class="block text-gray-700 dark:text-gray-300 font-semibold">Tanggal Lahir <span class="text-red-500">*</span></label>
              <input type="date" name="tanggal_lahir" class="form-input mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 transition" required>
              <small class="text-gray-500">Akan digunakan sebagai password awal (format: YYYYMMDD)</small>
            </div>
            <div>
              <label class="block text-gray-700 dark:text-gray-300 font-semibold">Jurusan</label>
              <input type="text" name="jurusan" class="form-input mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 transition">
            </div>
            <div>
              <label class="block text-gray-700 dark:text-gray-300 font-semibold">No HP</label>
              <input type="text" name="no_hp" class="form-input mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 transition">
            </div>
            <div class="md:col-span-2">
              <label class="block text-gray-700 dark:text-gray-300 font-semibold">Alamat</label>
              <textarea name="alamat" class="form-textarea mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 transition" rows="2"></textarea>
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
            Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>