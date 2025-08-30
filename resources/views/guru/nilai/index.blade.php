@extends('layouts.app')

@section('page_class', 'page-guru-nilai')
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
                            <div class="bg-gradient-to-r from-amber-500 to-yellow-600 rounded-lg p-2 mr-3">
                                <i data-lucide="star" class="w-6 h-6 text-white"></i>
                            </div>
                            Manajemen Nilai
                        </h1>
                        <p class="text-gray-600 dark:text-gray-300 mt-1">Kelola nilai siswa dan laporan akademik</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="text-sm text-gray-500 dark:text-gray-300 hidden sm:flex items-center">
                            <i data-lucide="star" class="w-4 h-4 mr-1"></i>
                            {{ $nilais->total() }} Data Nilai
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('nilai.select') }}"
                               class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-amber-500 to-yellow-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium">
                                <i data-lucide="plus" class="w-5 h-5"></i>
                                <span>Input Nilai Batch</span>
                            </a>
                            <div class="dropdown">
                                <button class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i data-lucide="file-text" class="w-5 h-5"></i>
                                    <span>Laporan</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item flex items-center gap-2" href="#" onclick="showKelasSelection()">
                                        <i data-lucide="table" class="w-4 h-4"></i>
                                        <span>Nilai Akhir Kelas</span>
                                    </a></li>
                                    <li><a class="dropdown-item flex items-center gap-2" href="#" onclick="showSiswaSelection()">
                                        <i data-lucide="user" class="w-4 h-4"></i>
                                        <span>Transkrip Siswa</span>
                                    </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Success Notification --}}
        @if(session('success'))
        <div class="mb-6">
            <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-xl p-4 shadow-sm">
                <div class="flex items-center">
                    <div class="bg-green-100 dark:bg-green-900/50 rounded-lg p-2 mr-3">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-green-800 dark:text-green-200">Berhasil!</p>
                        <p class="text-green-700 dark:text-green-300 text-sm">{{ session('success') }}</p>
                    </div>
                    <button type="button" class="ml-auto text-green-500 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300" data-bs-dismiss="alert">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>
        </div>
        @endif

        <!-- Nilai Table -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl">
            <!-- Header: Judul kiri, Search & Filter kanan -->
            <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800/50 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <!-- Judul kiri -->
                <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                    <div class="bg-gradient-to-r from-amber-500 to-yellow-600 rounded-lg p-2 mr-3 shadow-lg">
                        <i data-lucide="table" class="w-5 h-5 text-white"></i>
                    </div>
                    Daftar Nilai Siswa
                </h5>
                <!-- Search & Filter kanan -->
                <div class="flex flex-col sm:flex-row gap-2 items-stretch sm:items-center">
                    <div class="relative">
                        <input type="text"
                            id="liveSearchInput"
                            class="w-[150px] md:w-[180px] pl-9 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-amber-500 dark:focus:ring-amber-400 focus:border-amber-500 dark:focus:border-amber-400 transition-all duration-200 shadow-sm"
                            placeholder="Cari nilai..."
                            autocomplete="off">
                        <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                            <i data-lucide="search" class="w-4 h-4 text-gray-400 dark:text-gray-500"></i>
                        </div>
                        <div class="absolute inset-y-0 right-0 pr-2 flex items-center">
                            <button type="button" id="clearSearch" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hidden">
                                <i data-lucide="x" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Header -->

            <div class="overflow-x-auto">
                <table id="tableNilaiGuru" class="w-full text-sm">
                    <thead class="bg-gray-100 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                        <tr>
                            <th class="px-4 py-3 text-center font-semibold text-gray-900 dark:text-white w-16">
                                <span class="flex items-center justify-center">
                                    <i data-lucide="hash" class="w-4 h-4 text-amber-500 dark:text-amber-400 mr-1"></i>
                                    No
                                </span>
                            </th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                <span class="flex items-center">
                                    <i data-lucide="user" class="w-4 h-4 text-green-500 dark:text-green-400 mr-1"></i>
                                    Siswa
                                </span>
                            </th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                <span class="flex items-center">
                                    <i data-lucide="school" class="w-4 h-4 text-blue-500 dark:text-blue-400 mr-1"></i>
                                    Kelas
                                </span>
                            </th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                <span class="flex items-center">
                                    <i data-lucide="book-open" class="w-4 h-4 text-purple-500 dark:text-purple-400 mr-1"></i>
                                    Mata Pelajaran
                                </span>
                            </th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                <span class="flex items-center">
                                    <i data-lucide="clipboard-list" class="w-4 h-4 text-orange-500 dark:text-orange-400 mr-1"></i>
                                    Jenis Penilaian
                                </span>
                            </th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                <span class="flex items-center">
                                    <i data-lucide="target" class="w-4 h-4 text-red-500 dark:text-red-400 mr-1"></i>
                                    Nilai
                                </span>
                            </th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-900 dark:text-white">
                                <span class="flex items-center justify-center">
                                    <i data-lucide="settings" class="w-4 h-4 text-gray-500 dark:text-gray-400 mr-1"></i>
                                    Aksi
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-600 bg-white dark:bg-gray-800">
                        @forelse($nilais as $index => $nilai)
                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200">
                            <td class="px-4 py-4 text-center text-gray-900 dark:text-white font-medium">
                                {{ $nilais->firstItem() + $index }}
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mr-3">
                                        <i data-lucide="user-check" class="w-4 h-4 text-green-600 dark:text-green-400"></i>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-semibold text-gray-900 dark:text-white">{{ $nilai->siswa->nama ?? '-' }}</span>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $nilai->siswa->nis ?? '-' }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center mr-3">
                                        <i data-lucide="school" class="w-4 h-4 text-blue-600 dark:text-blue-400"></i>
                                    </div>
                                    <span class="text-gray-900 dark:text-white font-medium">{{ $nilai->jadwal->kelas->nama ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mr-3">
                                        <i data-lucide="book-open" class="w-4 h-4 text-purple-600 dark:text-purple-400"></i>
                                    </div>
                                    <span class="text-gray-900 dark:text-white font-medium">{{ $nilai->jadwal->mapel ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center mr-3">
                                        <i data-lucide="clipboard-list" class="w-4 h-4 text-orange-600 dark:text-orange-400"></i>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-gray-900 dark:text-white font-medium">{{ $nilai->jenisPenilaian->nama_formatted ?? '-' }}</span>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $nilai->jenisPenilaian->bobot_formatted ?? '-' }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                @php
                                    $statusColor = $nilai->status == 'success' ? 'bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-200 border-green-200 dark:border-green-800' :
                                                  ($nilai->status == 'warning' ? 'bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-200 border-yellow-200 dark:border-yellow-800' :
                                                  ($nilai->status == 'danger' ? 'bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-200 border-red-200 dark:border-red-800' :
                                                  'bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200 border-blue-200 dark:border-blue-800'));
                                @endphp
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $statusColor }}">
                                    <i data-lucide="target" class="w-3 h-3 mr-1"></i>
                                    {{ $nilai->nilai_formatted }}
                                </span>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('nilai.editBatch', ['jadwal_id' => $nilai->jadwal_id, 'jenis_penilaian_id' => $nilai->jenis_penilaian_id]) }}"
                                       class="inline-flex items-center gap-2 px-3 py-1 bg-gradient-to-r from-yellow-500 to-orange-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium text-sm"
                                       title="Edit Batch">
                                        <i data-lucide="pencil" class="w-4 h-4"></i>
                                        <span>Edit Batch</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="bg-white dark:bg-gray-800">
                            <td colspan="7" class="px-4 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                        <i data-lucide="star-off" class="w-8 h-8 text-gray-400 dark:text-gray-500"></i>
                                    </div>
                                    <p class="text-gray-500 dark:text-gray-400 font-medium">Belum ada data nilai</p>
                                    <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Mulai dengan menginput nilai siswa secara batch</p>
                                    <a href="{{ route('nilai.select') }}"
                                       class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-amber-500 to-yellow-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium mt-4">
                                        <i data-lucide="plus" class="w-5 h-5"></i>
                                        <span>Input Nilai Batch Pertama</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($nilais->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                {{ $nilais->withQueryString()->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Pilihan Kelas -->
<div class="modal fade" id="kelasModal" tabindex="-1" aria-labelledby="kelasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-white dark:bg-gray-800 rounded-xl shadow-lg border-0">
            <div class="modal-header border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 flex justify-between items-center">
                <h5 class="modal-title font-bold text-gray-900 dark:text-white flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Pilih Kelas
                </h5>
                <button type="button" class="text-gray-600 hover:text-red-500 transition" data-bs-dismiss="modal" aria-label="Tutup">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="modal-body p-6">
                <div class="mb-4">
                    <label for="kelasSelect" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Kelas:</label>
                    <select id="kelasSelect" class="form-select w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500 transition">
                        <option value="">Pilih Kelas...</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer flex justify-between bg-gray-50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-700">
                <button type="button" class="btn btn-secondary rounded-lg px-4 py-2 flex items-center gap-2" data-bs-dismiss="modal">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    Batal
                </button>
                <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white rounded-lg px-4 py-2 flex items-center gap-2" onclick="viewNilaiAkhirKelas()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Lihat Nilai Akhir
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pilihan Siswa -->
<div class="modal fade" id="siswaModal" tabindex="-1" aria-labelledby="siswaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-white dark:bg-gray-800 rounded-xl shadow-lg border-0">
            <div class="modal-header border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 flex justify-between items-center">
                <h5 class="modal-title font-bold text-gray-900 dark:text-white flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Pilih Siswa
                </h5>
                <button type="button" class="text-gray-600 hover:text-red-500 transition" data-bs-dismiss="modal" aria-label="Tutup">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="modal-body p-6">
                <div class="mb-4">
                    <label for="siswaSelect" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Siswa:</label>
                    <select id="siswaSelect" class="form-select w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-green-500 focus:border-green-500 transition">
                        <option value="">Pilih Siswa...</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer flex justify-between bg-gray-50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-700">
                <button type="button" class="btn btn-secondary rounded-lg px-4 py-2 flex items-center gap-2" data-bs-dismiss="modal">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    Batal
                </button>
                <button type="button" class="bg-green-600 hover:bg-green-700 text-white rounded-lg px-4 py-2 flex items-center gap-2" onclick="viewTranskripSiswa()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Lihat Transkrip
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function showKelasSelection() {
    console.log('Loading kelas data...');
    // Fetch kelas data from the server
    fetch('/get-kelas-guru', {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
        .then(response => {
            console.log('Response status:', response.status);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Kelas data:', data);
            const select = document.getElementById('kelasSelect');
            select.innerHTML = '<option value="">Pilih Kelas...</option>';
            
            if (data.kelas && data.kelas.length > 0) {
                data.kelas.forEach(kelas => {
                    const option = document.createElement('option');
                    option.value = kelas.id;
                    option.textContent = kelas.nama;
                    select.appendChild(option);
                });
                
                new bootstrap.Modal(document.getElementById('kelasModal')).show();
            } else {
                alert('Tidak ada data kelas yang tersedia');
            }
        })
        .catch(error => {
            console.error('Error loading kelas:', error);
            alert('Terjadi kesalahan saat memuat data kelas: ' + error.message);
        });
}

function showSiswaSelection() {
    console.log('Loading siswa data...');
    // Fetch siswa data from the server
    fetch('/get-siswa-guru', {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
        .then(response => {
            console.log('Response status:', response.status);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Siswa data:', data);
            const select = document.getElementById('siswaSelect');
            select.innerHTML = '<option value="">Pilih Siswa...</option>';
            
            if (data.siswa && data.siswa.length > 0) {
                data.siswa.forEach(siswa => {
                    const option = document.createElement('option');
                    option.value = siswa.id;
                    option.textContent = `${siswa.nama} (${siswa.nis}) - ${siswa.kelas?.nama || 'Tidak ada kelas'}`;
                    select.appendChild(option);
                });
                
                new bootstrap.Modal(document.getElementById('siswaModal')).show();
            } else {
                alert('Tidak ada data siswa yang tersedia');
            }
        })
        .catch(error => {
            console.error('Error loading siswa:', error);
            alert('Terjadi kesalahan saat memuat data siswa: ' + error.message);
        });
}

function viewNilaiAkhirKelas() {
    const kelasId = document.getElementById('kelasSelect').value;
    console.log('Selected kelas ID:', kelasId);
    if (kelasId) {
        const url = `/nilai/akhir-kelas/${kelasId}`;
        console.log('Redirecting to:', url);
        window.location.href = url;
    } else {
        alert('Silakan pilih kelas terlebih dahulu');
    }
}

function viewTranskripSiswa() {
    const siswaId = document.getElementById('siswaSelect').value;
    console.log('Selected siswa ID:', siswaId);
    if (siswaId) {
        const url = `/nilai/transkrip/${siswaId}`;
        console.log('Redirecting to:', url);
        window.location.href = url;
    } else {
        alert('Silakan pilih siswa terlebih dahulu');
    }
}
</script>

<script src="{{ asset('js/page.js') }}"></script>
@endsection