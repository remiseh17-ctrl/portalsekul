<!-- Create Nilai Modal -->
<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" id="createNilaiModal" style="display: none;">
    <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-emerald-600 to-green-600 text-white px-6 py-4 rounded-t-2xl">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold">Input Nilai Siswa</h3>
                        <p class="text-emerald-100 text-sm">Masukkan nilai untuk siswa</p>
                    </div>
                </div>
                <button onclick="closeCreateNilaiModal()" class="text-white hover:text-red-300 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Body -->
        <div class="p-6">
            <form id="createNilaiForm" method="POST" action="{{ route('guru.nilai.store') }}">
                @csrf

                <!-- Selection Criteria -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <!-- Kelas -->
                    <div>
                        <label for="kelas_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            Kelas <span class="text-red-500">*</span>
                        </label>
                        <select id="kelas_id" name="kelas_id"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all" required>
                            <option value="">Pilih Kelas</option>
                            @foreach($kelas as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('kelas_id')" class="mt-2" />
                    </div>

                    <!-- Mata Pelajaran -->
                    <div>
                        <label for="mapel" class="block text-sm font-semibold text-gray-700 mb-2">
                            Mata Pelajaran <span class="text-red-500">*</span>
                        </label>
                        <select id="mapel" name="mapel"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all" required>
                            <option value="">Pilih Mata Pelajaran</option>
                            <option value="Matematika">Matematika</option>
                            <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                            <option value="Bahasa Inggris">Bahasa Inggris</option>
                            <option value="Fisika">Fisika</option>
                            <option value="Kimia">Kimia</option>
                            <option value="Biologi">Biologi</option>
                            <option value="Sejarah">Sejarah</option>
                            <option value="Geografi">Geografi</option>
                            <option value="Ekonomi">Ekonomi</option>
                            <option value="Sosiologi">Sosiologi</option>
                            <option value="PPKN">PPKN</option>
                            <option value="Agama">Agama</option>
                            <option value="Seni Budaya">Seni Budaya</option>
                            <option value="Penjasorkes">Penjasorkes</option>
                            <option value="Bahasa Daerah">Bahasa Daerah</option>
                        </select>
                        <x-input-error :messages="$errors->get('mapel')" class="mt-2" />
                    </div>

                    <!-- Jenis Penilaian -->
                    <div>
                        <label for="jenis_penilaian_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            Jenis Penilaian <span class="text-red-500">*</span>
                        </label>
                        <select id="jenis_penilaian_id" name="jenis_penilaian_id"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all" required>
                            <option value="">Pilih Jenis Penilaian</option>
                            @foreach($jenisPenilaian as $jp)
                            <option value="{{ $jp->id }}">{{ $jp->nama }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('jenis_penilaian_id')" class="mt-2" />
                    </div>
                </div>

                <!-- Student List -->
                <div class="bg-gray-50 rounded-xl p-6">
                    <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Daftar Siswa
                    </h4>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="text-left py-3 px-4 font-semibold text-gray-900">Nama Siswa</th>
                                    <th class="text-left py-3 px-4 font-semibold text-gray-900">NIS</th>
                                    <th class="text-center py-3 px-4 font-semibold text-gray-900">Nilai</th>
                                    <th class="text-left py-3 px-4 font-semibold text-gray-900">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody id="student-list" class="divide-y divide-gray-200">
                                <tr>
                                    <td colspan="4" class="py-8 text-center text-gray-500">
                                        Pilih kelas terlebih dahulu untuk menampilkan daftar siswa
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="bg-gray-50 px-6 py-4 rounded-b-2xl flex justify-end space-x-3">
            <button onclick="closeCreateNilaiModal()"
                    class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                Batal
            </button>
            <button type="submit" form="createNilaiForm"
                    class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>Simpan Nilai</span>
            </button>
        </div>
    </div>
</div>

<script>
function closeCreateNilaiModal() {
    document.getElementById('createNilaiModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Load students when class is selected
document.getElementById('kelas_id').addEventListener('change', function() {
    const kelasId = this.value;
    if (kelasId) {
        fetch(`/guru/nilai/get-siswa/${kelasId}`)
            .then(response => response.json())
            .then(data => {
                const studentList = document.getElementById('student-list');
                if (data.length > 0) {
                    studentList.innerHTML = data.map(siswa => `
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <span class="text-sm font-medium text-blue-600">${siswa.nama.charAt(0)}</span>
                                    </div>
                                    <span class="font-medium text-gray-900">${siswa.nama}</span>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-gray-600">${siswa.nis}</td>
                            <td class="py-3 px-4">
                                <input type="number" name="nilai[${siswa.id}]"
                                       class="w-20 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-center"
                                       min="0" max="100" step="0.01" placeholder="0">
                            </td>
                            <td class="py-3 px-4">
                                <input type="text" name="keterangan[${siswa.id}]"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                                       placeholder="Opsional">
                            </td>
                        </tr>
                    `).join('');
                } else {
                    studentList.innerHTML = `
                        <tr>
                            <td colspan="4" class="py-8 text-center text-gray-500">
                                Tidak ada siswa di kelas ini
                            </td>
                        </tr>
                    `;
                }
            })
            .catch(error => {
                console.error('Error loading students:', error);
                document.getElementById('student-list').innerHTML = `
                    <tr>
                        <td colspan="4" class="py-8 text-center text-red-500">
                            Gagal memuat data siswa
                        </td>
                    </tr>
                `;
            });
    }
});
</script>