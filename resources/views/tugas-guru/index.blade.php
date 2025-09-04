@extends('layouts.app')
@section('page_class', 'page-admin-tugas-guru')
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
                            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg p-2 mr-3">
                                <i data-lucide="clipboard-list" class="w-6 h-6 text-white"></i>
                            </div>
                            Manajemen Tugas Guru
                        </h1>
                        <p class="text-gray-600 dark:text-gray-300 mt-1">Kelola tugas yang diberikan kepada guru dengan mudah dan efisien</p>
                        <div class="mt-3 flex items-center gap-4">
                            <div class="flex items-center gap-2 px-3 py-1 bg-blue-100 dark:bg-blue-900/30 rounded-full">
                                <i data-lucide="clipboard-list" class="w-4 h-4 text-blue-600 dark:text-blue-400"></i>
                                <span class="text-sm font-medium text-blue-700 dark:text-blue-300">
                                    {{ $tugas->total() }} tugas
                                </span>
                            </div>
                            <div class="flex items-center gap-2 px-3 py-1 bg-green-100 dark:bg-green-900/30 rounded-full">
                                <i data-lucide="users" class="w-4 h-4 text-green-600 dark:text-green-400"></i>
                                <span class="text-sm font-medium text-green-700 dark:text-green-300">
                                    {{ $tugas->sum(function($t) { return $t->submissions->count(); }) }} total submission
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="text-sm text-gray-500 dark:text-gray-300 hidden sm:flex items-center">
                            <i data-lucide="clipboard-list" class="w-4 h-4 mr-1"></i>
                            {{ $tugas->total() }} Tugas
                        </div>
                        <a href="{{ route('admin-tugas-guru.create') }}"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium">
                            <i data-lucide="plus" class="w-5 h-5"></i>
                            <span>Buat Tugas</span>
                        </a>
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

        <!-- Tasks Table -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl">
            <!-- Header: Judul kiri, Search & Filter kanan -->
            <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800/50 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <!-- Judul kiri -->
                <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg p-2 mr-3 shadow-lg">
                        <i data-lucide="table" class="w-5 h-5 text-white"></i>
                    </div>
                    Daftar Tugas Guru
                </h5>
                <!-- Search & Filter kanan -->
                <div class="flex flex-col sm:flex-row gap-2 items-stretch sm:items-center">
                    <div class="relative">
                        <input type="text"
                            id="liveSearchInput"
                            class="w-[150px] md:w-[180px] pl-9 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-200 shadow-sm"
                            placeholder="Cari tugas..."
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
                    <select id="statusFilter" class="w-[110px] md:w-[130px] px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-200 shadow-sm">
                        <option value="">Semua Status</option>
                        <option value="aktif">Aktif</option>
                        <option value="terlambat">Terlambat</option>
                        <option value="selesai">Selesai</option>
                    </select>
                    <select id="submissionFilter" class="w-[140px] md:w-[160px] px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-200 shadow-sm">
                        <option value="">Semua Submission</option>
                        <option value="ada">Ada Submission</option>
                        <option value="kosong">Belum Ada</option>
                    </select>
                </div>
            </div>
            <!-- End Header -->

            <div class="overflow-x-auto">
                <table id="tableTugas" class="w-full text-sm">
                    <thead class="bg-gray-100 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                        <tr>
                            <th class="px-4 py-3 text-center font-semibold text-gray-900 dark:text-white w-16">
                                <span class="flex items-center justify-center">
                                    <i data-lucide="hash" class="w-4 h-4 text-blue-500 dark:text-blue-400 mr-1"></i>
                                    No
                                </span>
                            </th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                <span class="flex items-center">
                                    <i data-lucide="clipboard-list" class="w-4 h-4 text-blue-500 dark:text-blue-400 mr-1"></i>
                                    Judul Tugas
                                </span>
                            </th>

                            <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                <span class="flex items-center">
                                    <i data-lucide="calendar" class="w-4 h-4 text-orange-500 dark:text-orange-400 mr-1"></i>
                                    Deadline
                                </span>
                            </th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-900 dark:text-white">
                                <span class="flex items-center justify-center">
                                    <i data-lucide="info" class="w-4 h-4 text-indigo-500 dark:text-indigo-400 mr-1"></i>
                                    Status
                                </span>
                            </th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-900 dark:text-white">
                                <span class="flex items-center justify-center">
                                    <i data-lucide="users" class="w-4 h-4 text-green-500 dark:text-green-400 mr-1"></i>
                                    Submission
                                </span>
                            </th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-900 dark:text-white">
                                <span class="flex items-center justify-center">
                                    <i data-lucide="settings" class="w-4 h-4 text-red-500 dark:text-red-400 mr-1"></i>
                                    Aksi
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-600 bg-white dark:bg-gray-800">
                        @forelse($tugas as $i => $tugasItem)
                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200">
                            <td class="px-4 py-4 text-center text-gray-900 dark:text-white font-medium">
                                {{ $tugas->firstItem() + $i }}
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center mr-3">
                                        <i data-lucide="clipboard-list" class="w-4 h-4 text-blue-600 dark:text-blue-400"></i>
                                    </div>
                                    <div>
                                        <span class="font-semibold text-gray-900 dark:text-white">{{ $tugasItem->judul }}</span>
                                        @if($tugasItem->deskripsi)
                                            <p class="text-gray-500 dark:text-gray-400 text-xs mt-1">{{ Str::limit($tugasItem->deskripsi, 50) }}</p>
                                        @endif
                                        @if($tugasItem->link_drive)
                                            <p class="text-blue-500 dark:text-blue-400 text-xs mt-1">
                                                <i data-lucide="link" class="w-3 h-3 inline mr-1"></i>
                                                Link Drive tersedia
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <td class="px-4 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center mr-3">
                                        <i data-lucide="calendar" class="w-4 h-4 text-orange-600 dark:text-orange-400"></i>
                                    </div>
                                    @if($tugasItem->deadline)
                                        <span class="text-gray-900 dark:text-white font-medium">{{ $tugasItem->deadline->format('d/m/Y') }}</span>
                                    @else
                                        <span class="text-gray-500 dark:text-gray-400">-</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex justify-center">
                                    @php
                                        $statusColor = $tugasItem->status_color;
                                        $statusText = $tugasItem->status_text;
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold 
                                        @if($statusColor === 'red') bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-200 border border-red-200 dark:border-red-800
                                        @elseif($statusColor === 'green') bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-200 border border-green-200 dark:border-green-800
                                        @else bg-gray-100 dark:bg-gray-900/50 text-gray-800 dark:text-gray-200 border border-gray-200 dark:border-gray-800
                                        @endif">
                                        <i data-lucide="circle" class="w-3 h-3 mr-1 
                                            @if($statusColor === 'red') text-red-600 dark:text-red-400
                                            @elseif($statusColor === 'green') text-green-600 dark:text-green-400
                                            @else text-gray-600 dark:text-gray-400
                                            @endif"></i>
                                        {{ $statusText }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex flex-col items-center gap-2">
                                    @php
                                        $submissionCount = $tugasItem->submissions->count();
                                    @endphp
                                    
                                    <!-- Submission Count & Status -->
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                                            <i data-lucide="users" class="w-4 h-4 text-green-600 dark:text-green-400"></i>
                                        </div>
                                        <div class="text-center">
                                            <div class="text-lg font-bold text-green-600 dark:text-green-400">{{ $submissionCount }}</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">guru</div>
                                        </div>
                                    </div>
                                    
                                    <!-- View Submissions Button -->
                                    @if($submissionCount > 0)
                                        <a href="{{ route('admin-tugas-guru.show', ['admin_tugas_guru' => $tugasItem]) }}#submissions"
                                           class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded text-xs hover:bg-green-200 dark:hover:bg-green-900/50 transition-colors duration-200 font-medium">
                                            <i data-lucide="eye" class="w-3 h-3"></i>
                                            Lihat
                                        </a>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2 py-1 bg-gray-100 dark:bg-gray-900/30 text-gray-500 dark:text-gray-400 rounded text-xs font-medium">
                                            <i data-lucide="clock" class="w-3 h-3"></i>
                                            Belum ada
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin-tugas-guru.show', ['admin_tugas_guru' => $tugasItem]) }}"
                                       class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300"
                                       title="Lihat Detail">
                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                    </a>
                                    <a href="{{ route('admin-tugas-guru.edit', ['admin_tugas_guru' => $tugasItem]) }}"
                                       class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-r from-yellow-500 to-orange-600 text-white shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300"
                                       title="Edit Tugas">
                                        <i data-lucide="pencil" class="w-4 h-4"></i>
                                    </a>
                                    <a href="{{ route('admin-tugas-guru.show', ['admin_tugas_guru' => $tugasItem]) }}#submissions"
                                       class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-r from-green-500 to-emerald-600 text-white shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300"
                                       title="Lihat Submission">
                                        <i data-lucide="users" class="w-4 h-4"></i>
                                    </a>
                                    <form action="{{ route('admin-tugas-guru.destroy', ['admin_tugas_guru' => $tugasItem]) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus tugas ini?')" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-r from-red-500 to-red-600 text-white shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300" 
                                                title="Hapus Tugas">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="bg-white dark:bg-gray-800">
                            <td colspan="6" class="px-4 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                        <i data-lucide="clipboard-list" class="w-8 h-8 text-gray-400 dark:text-gray-500"></i>
                                    </div>
                                    <p class="text-gray-500 dark:text-gray-400 font-medium">Tidak ada tugas</p>
                                    <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Mulai dengan membuat tugas baru</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($tugas->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                {{ $tugas->withQueryString()->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<script src="{{ asset('js/page.js') }}"></script>
<script>
// Search functionality
document.getElementById('searchTugas').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll('#tableTugas tbody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        if (text.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Status filter functionality
document.getElementById('statusFilter').addEventListener('change', function() {
    const selectedStatus = this.value.toLowerCase();
    const rows = document.querySelectorAll('#tableTugas tbody tr');
    
    rows.forEach(row => {
        const statusCell = row.querySelector('td:nth-child(4)'); // Status column
        if (statusCell) {
            const statusText = statusCell.textContent.toLowerCase();
            if (selectedStatus === '' || statusText.includes(selectedStatus)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
});

// Submission filter functionality
document.getElementById('submissionFilter').addEventListener('change', function() {
    const selectedSubmission = this.value.toLowerCase();
    const rows = document.querySelectorAll('#tableTugas tbody tr');
    
    rows.forEach(row => {
        const submissionCell = row.querySelector('td:nth-child(5)'); // Submission column
        if (submissionCell) {
            const submissionText = submissionCell.textContent.toLowerCase();
            if (selectedSubmission === '') {
                row.style.display = '';
            } else if (selectedSubmission === 'ada' && submissionText.includes('lihat')) {
                row.style.display = '';
            } else if (selectedSubmission === 'kosong' && submissionText.includes('belum ada')) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
});
</script>
@endsection 