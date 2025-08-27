@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Judul Halaman -->
    <div class="bg-gradient-to-r from-orange-600 to-orange-700 rounded-lg shadow-lg mb-6 p-6 text-white">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center">
                <div class="bg-white/20 rounded-full p-3 mr-4">
                    <i class="bi bi-megaphone-fill text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold mb-1">Manajemen Pengumuman</h1>
                    <p class="text-orange-100 text-sm opacity-90">Kelola pengumuman dan informasi penting sekolah</p>
                </div>
            </div>
            <button class="btn btn-light shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-1" 
                    data-bs-toggle="modal" data-bs-target="#modalCreatePengumuman">
                <i class="bi bi-plus-lg me-2"></i> Tambah Pengumuman
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
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Tabel Pengumuman -->
    <div class="bg-white rounded-lg shadow-lg border-0 overflow-hidden">
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <h5 class="mb-0 font-semibold text-gray-800 flex items-center">
                    <i class="bi bi-table me-3 text-orange-600"></i> Data Pengumuman
                </h5>
                <div class="flex items-center gap-3">
                    <span class="badge bg-orange-100 text-orange-800 px-3 py-2 rounded-full font-medium">
                        <i class="bi bi-megaphone me-1"></i> {{ $pengumumen->total() }} Pengumuman
                    </span>
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-gradient-to-r from-orange-50 to-orange-100">
                    <tr>
                        <th class="text-center px-4 py-3 font-semibold text-gray-700" style="width: 5%;">No</th>
                        <th class="px-4 py-3 font-semibold text-gray-700">Judul</th>
                        <th class="px-4 py-3 font-semibold text-gray-700" style="width: 15%;">Tanggal</th>
                        <th class="px-4 py-3 font-semibold text-gray-700">Isi</th>
                        <th class="text-center px-4 py-3 font-semibold text-gray-700" style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($pengumumen as $index => $pengumuman)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="text-center px-4 py-3 text-sm text-gray-600">
                                {{ $pengumumen->firstItem() + $index }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center">
                                    <div class="bg-orange-100 rounded-lg p-2 mr-3">
                                        <i class="bi bi-megaphone text-orange-600"></i>
                                    </div>
                                    <span class="font-semibold text-gray-900">{{ $pengumuman->judul }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="text-center">
                                    <span class="badge bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                        <i class="bi bi-calendar3 me-1"></i> {{ $pengumuman->tanggal->format('d/m/Y') }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="max-w-xs">
                                    <p class="text-gray-700 text-sm leading-relaxed">
                                        {{ Str::limit($pengumuman->isi, 80) }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex justify-center gap-2">
                                    <!-- Detail Modal Trigger -->
                                    <button class="btn btn-info btn-sm text-white shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalDetailPengumuman{{ $pengumuman->id }}"
                                            title="Lihat Detail">
                                        <i class="bi bi-eye"></i>
                                    </button>

                                    <!-- Edit Modal Trigger -->
                                    <button class="btn btn-warning btn-sm text-white shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalEditPengumuman{{ $pengumuman->id }}"
                                            title="Edit Pengumuman">
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <!-- Hapus Form -->
                                    <form action="{{ route('pengumuman.destroy', $pengumuman->id) }}" method="POST" 
                                          onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?')" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-1"
                                                title="Hapus Pengumuman">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Include Modals Per Row -->
                        @include('pengumuman.modal-detail', ['pengumuman' => $pengumuman])
                        @include('pengumuman.modal-edit', ['pengumuman' => $pengumuman])
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-12">
                                <div class="flex flex-col items-center text-gray-500">
                                    <i class="bi bi-exclamation-circle text-6xl mb-4 opacity-50"></i>
                                    <h5 class="text-lg font-medium mb-2">Tidak ada pengumuman</h5>
                                    <p class="text-sm">Mulai dengan menambahkan pengumuman baru</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($pengumumen->hasPages())
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            <div class="flex justify-center">
                {{ $pengumumen->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Modal Create -->
@include('pengumuman.modal-create')

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
        
        .max-w-xs {
            max-width: 200px;
        }
    }
    
    @media (max-width: 576px) {
        .table-responsive {
            font-size: 0.8rem;
        }
        
        .badge {
            font-size: 0.75rem;
        }
        
        .max-w-xs {
            max-width: 150px;
        }
    }
</style>

@endsection
