@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Judul Halaman -->
    <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 rounded-lg shadow-lg mb-6 p-6 text-white">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center">
                <div class="bg-white/20 rounded-full p-3 mr-4">
                    <i class="bi bi-person-badge text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold mb-1">Manajemen Guru</h1>
                    <p class="text-emerald-100 text-sm opacity-90">Kelola data guru dan pengajar dengan mudah</p>
                </div>
            </div>
            <button type="button" class="btn btn-light shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-1" 
                    data-bs-toggle="modal" data-bs-target="#modalCreateGuru">
                <i class="bi bi-plus-lg me-2"></i> Tambah Guru
            </button>
        </div>
    </div>

    <!-- Notifikasi Sukses -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-lg border-0 mb-6" role="alert">
            <div class="flex items-center">
                <i class="bi bi-check-circle-fill me-3 text-lg"></i>
                <div class="flex-1">
                    <strong class="font-semibold">Berhasil!</strong>
                    <span class="ml-2">{{ session('success') }}</span>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Filter dan Pencarian -->
    <div class="bg-white rounded-lg shadow-lg border-0 mb-6 overflow-hidden">
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
            <h5 class="mb-0 font-semibold text-gray-800 flex items-center">
                <i class="bi bi-funnel me-3 text-emerald-600"></i> Filter & Pencarian
            </h5>
        </div>
        <div class="p-6">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                <div>
                    <label class="form-label text-sm font-medium text-gray-700 mb-2">Cari Guru</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-r-0">
                            <i class="bi bi-search text-gray-500"></i>
                        </span>
                        <input type="text" name="q" value="{{ request('q') }}" 
                               class="form-control border-l-0 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                               placeholder="Cari berdasarkan nama atau NIP...">
                    </div>
                </div>
                <div>
                    <label class="form-label text-sm font-medium text-gray-700 mb-2">Filter Mata Pelajaran</label>
                    <select name="mapel" class="form-select focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <option value="">Semua Mapel</option>
                        @foreach($mapelList as $mapel)
                            <option value="{{ $mapel }}" @selected(request('mapel') == $mapel)>{{ $mapel }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary w-full shadow-md hover:shadow-lg transition-all duration-200">
                        <i class="bi bi-search me-2"></i> Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Guru -->
    <div class="bg-white rounded-lg shadow-lg border-0 overflow-hidden">
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <h5 class="mb-0 font-semibold text-gray-800 flex items-center">
                    <i class="bi bi-table me-3 text-emerald-600"></i> Data Guru
                </h5>
                <div class="flex items-center gap-3">
                    <span class="badge bg-emerald-100 text-emerald-800 px-3 py-2 rounded-full font-medium">
                        <i class="bi bi-person-badge me-1"></i> {{ $gurus->total() }} Guru
                    </span>
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-gradient-to-r from-emerald-50 to-emerald-100">
                    <tr>
                        <th class="text-center px-4 py-3 font-semibold text-gray-700" style="width: 5%;">No</th>
                        <th class="px-4 py-3 font-semibold text-gray-700" style="width: 8%;">Foto</th>
                        <th class="px-4 py-3 font-semibold text-gray-700" style="width: 10%;">NIP</th>
                        <th class="px-4 py-3 font-semibold text-gray-700">Nama</th>
                        <th class="px-4 py-3 font-semibold text-gray-700" style="width: 12%;">Mapel</th>
                        <th class="px-4 py-3 font-semibold text-gray-700" style="width: 10%;">Jenis Kelamin</th>
                        <th class="px-4 py-3 font-semibold text-gray-700" style="width: 12%;">No HP</th>
                        <th class="px-4 py-3 font-semibold text-gray-700" style="width: 8%;">Status Akun</th>
                        <th class="text-center px-4 py-3 font-semibold text-gray-700" style="width: 12%;">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($gurus as $i => $guru)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="text-center px-4 py-3 text-sm text-gray-600">
                            {{ $gurus->firstItem() + $i }}
                        </td>
                        <td class="px-4 py-3">
                            @if($guru->foto)
                                <img src="{{ asset('storage/'.$guru->foto) }}" alt="foto" 
                                     class="rounded-full border-2 border-gray-200 shadow-md" 
                                     style="height: 45px; width: 45px; object-fit: cover;">
                            @else
                                <div class="rounded-full bg-gradient-to-br from-gray-100 to-gray-200 flex justify-center items-center border-2 border-gray-200 shadow-md"
                                     style="height: 45px; width: 45px;">
                                    <i class="bi bi-person text-gray-500 text-lg"></i>
                                </div>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <span class="font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded text-sm">
                                {{ $guru->nip }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="font-semibold text-gray-900">{{ $guru->nama }}</div>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                <i class="bi bi-book me-1"></i> {{ $guru->mapel }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            @if($guru->jenis_kelamin == 'L')
                                <span class="badge bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                                    <i class="bi bi-gender-male me-1"></i> Laki-laki
                                </span>
                            @else
                                <span class="badge bg-pink-100 text-pink-800 px-3 py-1 rounded-full text-sm">
                                    <i class="bi bi-gender-female me-1"></i> Perempuan
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center text-gray-600">
                                <i class="bi bi-telephone me-2 text-green-500"></i> {{ $guru->no_hp ?? '-' }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            @if($guru->user)
                                <span class="badge bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">
                                    <i class="bi bi-check-circle me-1"></i> Aktif
                                </span>
                                <small class="block text-gray-500 text-xs mt-1">
                                    Username: {{ $guru->user->username }}
                                </small>
                            @else
                                <span class="badge bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm">
                                    <i class="bi bi-exclamation-triangle me-1"></i> No Account
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('guru.edit', $guru) }}" 
                                   class="btn btn-warning btn-sm text-white shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-1"
                                   title="Edit Guru" data-bs-toggle="tooltip">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('guru.destroy', $guru) }}" method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus guru ini? Akun login juga akan dihapus.')" 
                                      class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-1" 
                                            title="Hapus Guru" data-bs-toggle="tooltip">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-12">
                            <div class="flex flex-col items-center text-gray-500">
                                <i class="bi bi-inbox text-6xl mb-4 opacity-50"></i>
                                <h5 class="text-lg font-medium mb-2">Tidak ada data guru</h5>
                                <p class="text-sm">Mulai dengan menambahkan guru baru</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($gurus->hasPages())
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            {{ $gurus->withQueryString()->links() }}
        </div>
        @endif
    </div>
</div>

{{-- Include Modal Create Guru --}}
@include('guru.create-modal')

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
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
@endsection 