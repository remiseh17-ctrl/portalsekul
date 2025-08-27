@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Judul Halaman -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 mb-6 p-6 transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center">
                <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg p-3 mr-4 shadow-lg">
                    <i data-lucide="users" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Manajemen Siswa</h1>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">Kelola data siswa dengan mudah dan efisien</p>
                </div>
            </div>
            <button type="button" 
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-200 text-gray-700 bg-white hover:bg-gray-100 dark:border-gray-700 dark:text-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 transition-colors shadow-md hover:shadow-lg transform hover:-translate-y-0.5" 
                    data-bs-toggle="modal" data-bs-target="#modalCreateSiswa">
                <i data-lucide="plus" class="w-5 h-5"></i>
                <span class="text-sm font-medium">Tambah Siswa</span>
            </button>
        </div>
    </div>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-lg border-0 mb-6" role="alert">
            <div class="flex items-center">
                <i data-lucide="check-circle-2" class="w-5 h-5 me-3"></i>
                <div class="flex-1">
                    <strong class="font-semibold">Berhasil!</strong>
                    <span class="ml-2">{{ session('success') }}</span>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Filter dan Pencarian -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 mb-6 overflow-hidden transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
            <h5 class="mb-0 font-semibold text-gray-900 dark:text-white flex items-center">
                <i data-lucide="filter" class="w-5 h-5 text-blue-600 mr-2"></i>
                Filter & Pencarian
            </h5>
        </div>
        <div class="p-6">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                <div class="md:col-span-2">
                    <label class="form-label text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Cari Siswa</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white dark:bg-gray-800 border-r-0 dark:border-gray-700">
                            <i data-lucide="search" class="w-4 h-4 text-gray-500"></i>
                        </span>
                        <input type="text" name="q" value="{{ request('q') }}" 
                               class="form-control border-l-0 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100"
                               placeholder="Cari berdasarkan nama, NIS, atau jurusan...">
                    </div>
                </div>
                <div>
                    <label class="form-label text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Filter Kelas</label>
                    <select name="kelas_id" class="form-select focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100">
                        <option value="">Semua Kelas</option>
                        @foreach($kelasList as $kelas)
                            <option value="{{ $kelas->id }}" @selected(request('kelas_id') == $kelas->id)>
                                {{ $kelas->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button type="submit" class="inline-flex items-center justify-center gap-2 w-full px-4 py-2 rounded-lg border border-blue-600 text-white bg-blue-600 hover:bg-blue-700 transition-colors shadow-md hover:shadow-lg">
                        <i data-lucide="search" class="w-4 h-4"></i>
                        <span class="text-sm font-medium">Cari</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Siswa -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <h5 class="mb-0 font-semibold text-gray-900 dark:text-white flex items-center">
                    <i data-lucide="table" class="w-5 h-5 text-blue-600 mr-2"></i>
                    Data Siswa
                </h5>
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center gap-1 bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-200 px-3 py-1.5 rounded-full font-medium border border-blue-200 dark:border-blue-800">
                        <i data-lucide="users" class="w-4 h-4"></i>
                        {{ $siswas->total() }} Siswa
                    </span>
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="text-center px-4 py-3 font-semibold text-gray-900 dark:text-white" style="width: 5%;">No</th>
                        <th class="px-4 py-3 font-semibold text-gray-900 dark:text-white" style="width: 8%;">Foto</th>
                        <th class="px-4 py-3 font-semibold text-gray-900 dark:text-white" style="width: 10%;">NIS</th>
                        <th class="px-4 py-3 font-semibold text-gray-900 dark:text-white">Nama</th>
                        <th class="px-4 py-3 font-semibold text-gray-900 dark:text-white" style="width: 12%;">Kelas</th>
                        <th class="px-4 py-3 font-semibold text-gray-900 dark:text-white" style="width: 15%;">Jurusan</th>
                        <th class="px-4 py-3 font-semibold text-gray-900 dark:text-white" style="width: 12%;">No HP</th>
                        <th class="text-center px-4 py-3 font-semibold text-gray-900 dark:text-white" style="width: 12%;">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($siswas as $i => $siswa)
                    <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                        <td class="text-center px-4 py-3 text-sm text-gray-600 dark:text-gray-300">
                            {{ $siswas->firstItem() + $i }}
                        </td>
                        <td class="px-4 py-3">
                            @if($siswa->foto)
                                <img src="{{ asset('storage/'.$siswa->foto) }}"
                                     class="rounded-full border-2 border-gray-200 dark:border-gray-700 shadow-md" 
                                     style="height: 45px; width: 45px; object-fit: cover;">
                            @else
                                <div class="rounded-full bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 flex justify-center items-center border-2 border-gray-200 dark:border-gray-700 shadow-md"
                                     style="height: 45px; width: 45px;">
                                    <i data-lucide="user" class="w-5 h-5 text-gray-500"></i>
                                </div>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <span class="font-semibold text-blue-700 dark:text-blue-300 bg-blue-50 dark:bg-blue-900/30 px-2 py-1 rounded text-sm">
                                {{ $siswa->nis }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="font-semibold text-gray-900 dark:text-white">{{ $siswa->nama }}</div>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-200">
                                <i data-lucide="layers" class="w-4 h-4 mr-1"></i> {{ $siswa->kelas->nama ?? '-' }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="text-gray-700 dark:text-gray-300">{{ $siswa->jurusan ?? '-' }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center text-gray-600 dark:text-gray-300">
                                <i data-lucide="phone" class="w-4 h-4 mr-2 text-green-500"></i> {{ $siswa->no_hp ?? '-' }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('siswa.edit', $siswa) }}" 
                                   class="inline-flex items-center justify-center gap-2 px-3 py-1.5 rounded-md text-white bg-yellow-500 hover:bg-yellow-600 transition-colors shadow-md hover:shadow-lg transform hover:-translate-y-0.5"
                                   title="Edit Siswa" data-bs-toggle="tooltip">
                                    <i data-lucide="pencil" class="w-4 h-4"></i>
                                </a>
                                <form action="{{ route('siswa.destroy', $siswa) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus siswa ini?')" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="inline-flex items-center justify-center gap-2 px-3 py-1.5 rounded-md text-white bg-red-600 hover:bg-red-700 transition-colors shadow-md hover:shadow-lg transform hover:-translate-y-0.5" 
                                            title="Hapus Siswa" data-bs-toggle="tooltip">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr class="bg-white dark:bg-gray-800">
                        <td colspan="8" class="text-center py-12">
                            <div class="flex flex-col items-center text-gray-500 dark:text-gray-400">
                                <i data-lucide="inbox" class="w-14 h-14 mb-4 opacity-50"></i>
                                <h5 class="text-lg font-medium mb-2 text-gray-900 dark:text-white">Tidak ada data siswa</h5>
                                <p class="text-sm">Mulai dengan menambahkan siswa baru</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($siswas->hasPages())
        <div class="bg-gray-50 dark:bg-gray-800/50 px-6 py-4 border-t border-gray-200 dark:border-gray-700">
            {{ $siswas->withQueryString()->links() }}
                        </div>
        @endif
    </div>
</div>

{{-- Include Modal Create Siswa --}}
@include('siswa.create-modal')

{{-- Style tambahan --}}
<style>
    /* Custom scrollbar */
    .overflow-x-auto::-webkit-scrollbar {
        height: 8px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .container-fluid {
            padding-left: 15px;
            padding-right: 15px;
        }
        
        .table th,
        .table td {
            padding: 0.5rem 0.25rem;
            font-size: 0.875rem;
        }
        
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }
    }
    
    @media (max-width: 576px) {
        .table-responsive {
            font-size: 0.8rem;
        }
        
        .badge {
            font-size: 0.75rem;
        }
    }
</style>

{{-- Script untuk tooltip --}}
<script>
    // Initialize tooltips and lucide icons
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
    if (typeof lucide !== 'undefined') { lucide.createIcons(); }
</script>
@endsection
