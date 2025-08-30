@extends('layouts.app')

@section('page_class', 'page-guru-absensi-create')
@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <!-- Main Content Container -->
    <div class="container-fluid px-4 py-8 mt-4">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 transition-colors duration-300">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white flex items-center">
                            <div class="bg-gradient-to-r from-teal-500 to-cyan-600 rounded-lg p-2 mr-3">
                                <i data-lucide="clipboard-check" class="w-6 h-6 text-white"></i>
                            </div>
                            Absensi Terintegrasi
                        </h1>
                        <p class="text-gray-600 dark:text-gray-300 mt-1">Kelola absensi guru dan siswa dalam satu form</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('absensi.index') }}"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium">
                            <i data-lucide="arrow-left" class="w-5 h-5"></i>
                            <span>Kembali</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Error Notification --}}
        @if($errors->any())
        <div class="mb-6">
            <div class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-xl p-4 shadow-sm">
                <div class="flex items-start">
                    <div class="bg-red-100 dark:bg-red-900/50 rounded-lg p-2 mr-3">
                        <i data-lucide="alert-triangle" class="w-5 h-5 text-red-600 dark:text-red-400"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-red-800 dark:text-red-200">Terjadi Kesalahan!</p>
                        <ul class="text-red-700 dark:text-red-300 text-sm mt-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300" data-bs-dismiss="alert">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2">
                <!-- Form Absensi -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl">
                    <!-- Header -->
                    <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800/50">
                        <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                            <div class="bg-gradient-to-r from-teal-500 to-cyan-600 rounded-lg p-2 mr-3 shadow-lg">
                                <i data-lucide="calendar-plus" class="w-5 h-5 text-white"></i>
                            </div>
                            Form Absensi Siswa
                        </h5>
                    </div>
                    <!-- Body -->
                    <div class="p-6">
                        <form action="{{ route('absensi.store') }}" method="POST">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="jadwal_id" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">
                                        Jadwal Mengajar <span class="text-red-500">*</span>
                                    </label>
                                    <select class="form-select w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-teal-500 focus:border-teal-500 transition @error('jadwal_id') border-red-500 @enderror"
                                            id="jadwal_id" name="jadwal_id" required>
                                        <option value="">Pilih Jadwal</option>
                                        @foreach($jadwals as $jadwal)
                                            <option value="{{ $jadwal->id }}"
                                                    {{ old('jadwal_id', request('jadwal_id')) == $jadwal->id ? 'selected' : '' }}>
                                                {{ $jadwal->mapel }} - {{ $jadwal->kelas->nama }} ({{ $jadwal->hari }}, {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jadwal_id')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="tanggal" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">
                                        Tanggal <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" class="form-input w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-teal-500 focus:border-teal-500 transition @error('tanggal') border-red-500 @enderror"
                                           id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                                    @error('tanggal')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Absensi Guru -->
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-xl p-6 mb-6 border border-blue-200 dark:border-blue-800">
                                <div class="flex items-center mb-4">
                                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg p-2 mr-3 shadow-lg">
                                        <i data-lucide="user-check" class="w-5 h-5 text-white"></i>
                                    </div>
                                    <h6 class="text-lg font-semibold text-gray-900 dark:text-white">Absensi Guru</h6>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="status_guru" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">
                                            Status Guru <span class="text-red-500">*</span>
                                        </label>
                                        <select class="form-select w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500 transition @error('status_guru') border-red-500 @enderror"
                                                id="status_guru" name="status_guru" required>
                                            <option value="">Pilih Status</option>
                                            <option value="Hadir" {{ old('status_guru') == 'Hadir' ? 'selected' : '' }}>✅ Hadir</option>
                                            <option value="Izin" {{ old('status_guru') == 'Izin' ? 'selected' : '' }}>📄 Izin</option>
                                            <option value="Sakit" {{ old('status_guru') == 'Sakit' ? 'selected' : '' }}>🤒 Sakit</option>
                                            <option value="Tidak KBM" {{ old('status_guru') == 'Tidak KBM' ? 'selected' : '' }}>❌ Tidak KBM</option>
                                            <option value="Tugas" {{ old('status_guru') == 'Tugas' ? 'selected' : '' }}>📚 Tugas</option>
                                        </select>
                                        @error('status_guru')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="keterangan_guru" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">
                                            Keterangan Guru
                                        </label>
                                        <input type="text" class="form-input w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500 transition @error('keterangan_guru') border-red-500 @enderror"
                                               id="keterangan_guru" name="keterangan_guru" value="{{ old('keterangan_guru') }}" placeholder="Keterangan (opsional)">
                                        @error('keterangan_guru')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                                    <div>
                                        <label for="materi_yang_diajarkan" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">
                                            Materi yang Diajarkan
                                        </label>
                                        <textarea class="form-textarea w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500 transition @error('materi_yang_diajarkan') border-red-500 @enderror"
                                                  id="materi_yang_diajarkan" name="materi_yang_diajarkan" rows="3"
                                                  placeholder="Masukkan materi yang diajarkan">{{ old('materi_yang_diajarkan') }}</textarea>
                                        @error('materi_yang_diajarkan')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="catatan_kbm" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">
                                            Catatan KBM
                                        </label>
                                        <textarea class="form-textarea w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500 transition @error('catatan_kbm') border-red-500 @enderror"
                                                  id="catatan_kbm" name="catatan_kbm" rows="3"
                                                  placeholder="Catatan tambahan untuk sesi KBM ini">{{ old('catatan_kbm') }}</textarea>
                                        @error('catatan_kbm')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Absensi Siswa -->
                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-xl p-6 mb-6 border border-green-200 dark:border-green-800">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center">
                                        <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg p-2 mr-3 shadow-lg">
                                            <i data-lucide="users" class="w-5 h-5 text-white"></i>
                                        </div>
                                        <h6 class="text-lg font-semibold text-gray-900 dark:text-white">Absensi Siswa</h6>
                                    </div>
                                    <button type="button" class="inline-flex items-center gap-2 px-3 py-1 bg-green-100 dark:bg-green-900/50 text-green-700 dark:text-green-300 rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium text-sm" onclick="setAllHadir()">
                                        <i data-lucide="check-circle" class="w-4 h-4"></i>
                                        <span>Set Semua Hadir</span>
                                    </button>
                                </div>
                                <div id="daftar-siswa" class="border border-gray-200 dark:border-gray-600 rounded-lg p-4 bg-gray-50 dark:bg-gray-800/50">
                                    <div class="text-center text-gray-500 dark:text-gray-400 py-8">
                                        <i data-lucide="users" class="w-12 h-12 mx-auto mb-4 opacity-50"></i>
                                        <p class="text-sm">Pilih jadwal untuk menampilkan daftar siswa</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="flex gap-4">
                                <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-teal-500 to-cyan-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium">
                                    <i data-lucide="check-circle" class="w-5 h-5"></i>
                                    <span>Simpan Absensi</span>
                                </button>
                                <a href="{{ route('absensi.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium">
                                    <i data-lucide="x-circle" class="w-5 h-5"></i>
                                    <span>Batal</span>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar Information -->
            <div class="space-y-6">
                <!-- Information Card -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800/50">
                        <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg p-2 mr-3 shadow-lg">
                                <i data-lucide="info" class="w-5 h-5 text-white"></i>
                            </div>
                            Informasi
                        </h5>
                    </div>
                    <div class="p-6 space-y-4">
                        <!-- Tips Alert -->
                        <div class="bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                            <div class="flex items-start">
                                <div class="bg-blue-100 dark:bg-blue-900/50 rounded-lg p-2 mr-3">
                                    <i data-lucide="lightbulb" class="w-5 h-5 text-blue-600 dark:text-blue-400"></i>
                                </div>
                                <div>
                                    <h6 class="font-semibold text-blue-800 dark:text-blue-200 mb-2">Petunjuk:</h6>
                                    <ul class="text-blue-700 dark:text-blue-300 text-sm space-y-1">
                                        <li>• Pilih jadwal mengajar yang sesuai</li>
                                        <li>• Tanggal harus sesuai dengan hari jadwal</li>
                                        <li>• Guru otomatis hadir ketika mengisi absensi</li>
                                        <li>• Daftar siswa muncul otomatis setelah pilih jadwal</li>
                                        <li>• Gunakan "Set Semua Hadir" untuk efisiensi</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Features Alert -->
                        <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg p-4">
                            <div class="flex items-start">
                                <div class="bg-green-100 dark:bg-green-900/50 rounded-lg p-2 mr-3">
                                    <i data-lucide="check-circle" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                                </div>
                                <div>
                                    <h6 class="font-semibold text-green-800 dark:text-green-200 mb-2">Fitur Terintegrasi:</h6>
                                    <p class="text-green-700 dark:text-green-300 text-sm">Satu form untuk absensi guru dan siswa sekaligus. Lebih efisien dan terintegrasi!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('jadwal_id').addEventListener('change', function() {
    const jadwalId = this.value;
    const daftarSiswa = document.getElementById('daftar-siswa');
    
    if (jadwalId) {
        // Tampilkan loading
        daftarSiswa.innerHTML = `
            <div class="text-center py-4">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mb-0 mt-2">Memuat daftar siswa...</p>
            </div>
        `;
        
        fetch(`/get-siswa-by-jadwal?jadwal_id=${jadwalId}`)
            .then(response => response.json())
            .then(data => {
                if (data.siswas && data.siswas.length > 0) {
                    let html = '<div class="table-responsive"><table class="table table-sm">';
                    html += '<thead><tr><th>No</th><th>Nama Siswa</th><th>NIS</th><th>Status</th><th>Keterangan</th></tr></thead><tbody>';
                    
                    data.siswas.forEach((siswa, index) => {
                        html += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${siswa.nama}</td>
                                <td>${siswa.nis}</td>
                                <td>
                                    <select name="siswa_absensi[${siswa.id}][status]" class="form-select form-select-sm" style="width: 120px;">
                                        <option value="">Pilih Status</option>
                                        <option value="Hadir">✅ Hadir</option>
                                        <option value="Sakit">🤒 Sakit</option>
                                        <option value="Izin">📄 Izin</option>
                                        <option value="Alpha">❌ Alpha</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="siswa_absensi[${siswa.id}][keterangan]" 
                                           class="form-control form-control-sm" placeholder="Keterangan (opsional)">
                                </td>
                            </tr>
                        `;
                    });
                    
                    html += '</tbody></table></div>';
                    daftarSiswa.innerHTML = html;
                } else {
                    daftarSiswa.innerHTML = `
                        <div class="text-center text-muted py-4">
                            <i class="bi bi-exclamation-triangle" style="font-size: 2rem;"></i>
                            <p class="mb-0 mt-2">Tidak ada siswa di kelas ini</p>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                daftarSiswa.innerHTML = `
                    <div class="text-center text-danger py-4">
                        <i class="bi bi-exclamation-triangle" style="font-size: 2rem;"></i>
                        <p class="mb-0 mt-2">Terjadi kesalahan saat memuat data</p>
                    </div>
                `;
            });
    } else {
        daftarSiswa.innerHTML = `
            <div class="text-center text-muted py-4">
                <i class="bi bi-people" style="font-size: 2rem;"></i>
                <p class="mb-0 mt-2">Pilih jadwal untuk menampilkan daftar siswa</p>
            </div>
        `;
    }
});

function setAllHadir() {
    const statusSelects = document.querySelectorAll('select[name*="[status]"]');
    statusSelects.forEach(select => {
        select.value = 'Hadir';
    });
}
</script>

<script src="{{ asset('js/page.js') }}"></script>
@endsection