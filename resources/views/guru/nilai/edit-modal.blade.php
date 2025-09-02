<!-- Edit Nilai Modal -->
<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" id="editNilaiModal" style="display: none;">
    <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-amber-600 to-orange-600 text-white px-6 py-4 rounded-t-2xl">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold">Edit Nilai Siswa</h3>
                        <p class="text-amber-100 text-sm">Perbarui nilai siswa</p>
                    </div>
                </div>
                <button onclick="closeEditNilaiModal()" class="text-white hover:text-red-300 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Body -->
        <div class="p-6">
            <form id="editNilaiForm" method="POST" action="">
                @csrf
                @method('PUT')

                <!-- Current Info Display -->
                <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div>
                            <span class="font-semibold text-gray-700">Kelas:</span>
                            <span class="text-gray-900 ml-2" id="edit-kelas-info">-</span>
                        </div>
                        <div>
                            <span class="font-semibold text-gray-700">Mata Pelajaran:</span>
                            <span class="text-gray-900 ml-2" id="edit-mapel-info">-</span>
                        </div>
                        <div>
                            <span class="font-semibold text-gray-700">Jenis Penilaian:</span>
                            <span class="text-gray-900 ml-2" id="edit-jenis-info">-</span>
                        </div>
                    </div>
                </div>

                <!-- Student List with Current Values -->
                <div class="bg-gray-50 rounded-xl p-6">
                    <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Daftar Nilai Siswa
                    </h4>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="text-left py-3 px-4 font-semibold text-gray-900">Nama Siswa</th>
                                    <th class="text-left py-3 px-4 font-semibold text-gray-900">NIS</th>
                                    <th class="text-center py-3 px-4 font-semibold text-gray-900">Nilai Saat Ini</th>
                                    <th class="text-center py-3 px-4 font-semibold text-gray-900">Nilai Baru</th>
                                    <th class="text-left py-3 px-4 font-semibold text-gray-900">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody id="edit-student-list" class="divide-y divide-gray-200">
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-gray-500">
                                        Memuat data nilai siswa...
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
            <button onclick="closeEditNilaiModal()"
                    class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                Batal
            </button>
            <button type="submit" form="editNilaiForm"
                    class="px-6 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition-colors flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>Simpan Perubahan</span>
            </button>
        </div>
    </div>
</div>

<script>
function closeEditNilaiModal() {
    document.getElementById('editNilaiModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Function to populate edit modal with data
function openEditNilaiModal(nilaiData) {
    document.getElementById('edit-kelas-info').textContent = nilaiData.kelas;
    document.getElementById('edit-mapel-info').textContent = nilaiData.mapel;
    document.getElementById('edit-jenis-info').textContent = nilaiData.jenis_penilaian;

    const studentList = document.getElementById('edit-student-list');
    if (nilaiData.siswa && nilaiData.siswa.length > 0) {
        studentList.innerHTML = nilaiData.siswa.map(siswa => `
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
                <td class="py-3 px-4 text-center">
                    <span class="px-3 py-1 bg-gray-100 rounded-full text-sm font-medium text-gray-700">
                        ${siswa.nilai_lama || '-'}
                    </span>
                </td>
                <td class="py-3 px-4">
                    <input type="number" name="nilai[${siswa.id}]"
                           class="w-20 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent text-center"
                           min="0" max="100" step="0.01" value="${siswa.nilai_lama || ''}" placeholder="0">
                </td>
                <td class="py-3 px-4">
                    <input type="text" name="keterangan[${siswa.id}]"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                           value="${siswa.keterangan || ''}" placeholder="Opsional">
                </td>
            </tr>
        `).join('');
    } else {
        studentList.innerHTML = `
            <tr>
                <td colspan="5" class="py-8 text-center text-gray-500">
                    Tidak ada data nilai untuk diedit
                </td>
            </tr>
        `;
    }

    document.getElementById('editNilaiModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
</script>