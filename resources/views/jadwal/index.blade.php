@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Judul Halaman -->
    <div class="bg-gradient-to-r from-purple-600 to-purple-700 rounded-lg shadow-lg mb-6 p-6 text-white">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center">
                <div class="bg-white/20 rounded-full p-3 mr-4">
                    <i class="bi bi-calendar3 text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold mb-1">Manajemen Jadwal</h1>
                    <p class="text-purple-100 text-sm opacity-90">Kelola jadwal pelajaran dan pengaturan waktu belajar</p>
                </div>
            </div>
            <button type="button" class="btn btn-light shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-1" 
                    data-bs-toggle="modal" data-bs-target="#modalCreateJadwal">
                <i class="bi bi-plus-lg me-2"></i> Tambah Jadwal
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

    <!-- Notifikasi Error -->
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-lg border-0 mb-6" role="alert">
            <div class="flex items-center">
                <i class="bi bi-exclamation-triangle-fill me-3 text-lg"></i>
                <div class="flex-1">
                    <strong class="font-semibold">Terjadi kesalahan:</strong>
                    <ul class="mb-0 mt-2 list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Filter dan Pencarian -->
    <div class="bg-white rounded-lg shadow-lg border-0 mb-6 overflow-hidden">
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
            <h5 class="mb-0 font-semibold text-gray-800 flex items-center">
                <i class="bi bi-funnel me-3 text-purple-600"></i> Filter & Pencarian
            </h5>
        </div>
        <div class="p-6">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
                <div>
                    <label class="form-label text-sm font-medium text-gray-700 mb-2">Cari Mapel</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-r-0">
                            <i class="bi bi-search text-gray-500"></i>
                        </span>
                        <input type="text" name="q" value="{{ request('q') }}" 
                               class="form-control border-l-0 focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                               placeholder="Cari mata pelajaran...">
                    </div>
                </div>
                <div>
                    <label class="form-label text-sm font-medium text-gray-700 mb-2">Filter Kelas</label>
                    <select name="kelas_id" class="form-select focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        <option value="">Semua Kelas</option>
                        @foreach($kelasList as $kelas)
                            <option value="{{ $kelas->id }}" @selected(request('kelas_id') == $kelas->id)>
                                {{ $kelas->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @if(Auth::user()->role === 'admin')
                <div>
                    <label class="form-label text-sm font-medium text-gray-700 mb-2">Filter Guru</label>
                    <select name="guru_id" class="form-select focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        <option value="">Semua Guru</option>
                        @foreach($guruList as $guru)
                            <option value="{{ $guru->id }}" @selected(request('guru_id') == $guru->id)>
                                {{ $guru->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div>
                    <label class="form-label text-sm font-medium text-gray-700 mb-2">Filter Hari</label>
                    <select name="hari" class="form-select focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        <option value="">Semua Hari</option>
                        @foreach($hariList as $hari)
                            <option value="{{ $hari }}" @selected(request('hari') == $hari)>
                                {{ $hari }}
                            </option>
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

    <!-- Tabel Jadwal -->
    <div class="bg-white rounded-lg shadow-lg border-0 overflow-hidden">
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <h5 class="mb-0 font-semibold text-gray-800 flex items-center">
                    <i class="bi bi-table me-3 text-purple-600"></i> Data Jadwal
                </h5>
                <div class="flex items-center gap-3">
                    <span class="badge bg-purple-100 text-purple-800 px-3 py-2 rounded-full font-medium">
                        <i class="bi bi-calendar3 me-1"></i> {{ $jadwals->total() }} Jadwal
                    </span>
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-gradient-to-r from-purple-50 to-purple-100">
                    <tr>
                        <th class="text-center px-4 py-3 font-semibold text-gray-700" style="width: 5%;">No</th>
                        <th class="px-4 py-3 font-semibold text-gray-700" style="width: 20%;">Kelas</th>
                        <th class="px-4 py-3 font-semibold text-gray-700" style="width: 20%;">Mata Pelajaran</th>
                        <th class="px-4 py-3 font-semibold text-gray-700" style="width: 20%;">Guru</th>
                        <th class="px-4 py-3 font-semibold text-gray-700" style="width: 15%;">Hari</th>
                        <th class="px-4 py-3 font-semibold text-gray-700" style="width: 15%;">Jam</th>
                        <th class="text-center px-4 py-3 font-semibold text-gray-700" style="width: 10%;">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($jadwals as $i => $jadwal)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="text-center px-4 py-3 text-sm text-gray-600">
                            {{ $jadwals->firstItem() + $i }}
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center">
                                <div class="bg-blue-100 rounded-lg p-2 mr-3">
                                    <i class="bi bi-easel text-blue-600"></i>
                                </div>
                                <span class="font-semibold text-gray-900">{{ $jadwal->kelas->nama ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center">
                                <div class="bg-indigo-100 rounded-lg p-2 mr-3">
                                    <i class="bi bi-book text-indigo-600"></i>
                                </div>
                                <span class="font-semibold text-gray-900">{{ $jadwal->mapel }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center">
                                <div class="bg-green-100 rounded-lg p-2 mr-3">
                                    <i class="bi bi-person-badge text-green-600"></i>
                                </div>
                                <span class="text-gray-900">{{ $jadwal->guru->nama ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <span class="badge bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-medium">
                                {{ $jadwal->hari }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center">
                                <div class="bg-yellow-100 rounded-lg p-2 mr-3">
                                    <i class="bi bi-clock text-yellow-600"></i>
                                </div>
                                <span class="time-display font-mono font-semibold text-gray-900">
                                    {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}
                                </span>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex justify-center gap-2">
                                @if(Auth::user()->role === 'admin')
                                <a href="{{ route('jadwal.edit', $jadwal) }}" 
                                    class="btn btn-warning btn-sm text-white shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-1" 
                                    title="Edit Jadwal" data-bs-toggle="tooltip">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('jadwal.destroy', $jadwal) }}" method="POST" 
                                    onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-1" 
                                            title="Hapus Jadwal" data-bs-toggle="tooltip">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                                @else
                                <span class="badge bg-info-100 text-info-800 px-3 py-1 rounded-full text-sm font-medium">
                                    Jadwal Mengajar
                                </span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-12">
                            <div class="flex flex-col items-center text-gray-500">
                                <i class="bi bi-calendar-x text-6xl mb-4 opacity-50"></i>
                                <h5 class="text-lg font-medium mb-2">Tidak ada data jadwal</h5>
                                <p class="text-sm">Mulai dengan menambahkan jadwal baru</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($jadwals->hasPages())
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            {{ $jadwals->withQueryString()->links() }}
        </div>
        @endif
    </div>
</div>

{{-- Include Modal Create Jadwal --}}
@include('jadwal.create-modal')

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
    
    /* Ensure time inputs display in 24-hour format */
    input[type="time"] {
        font-family: 'Courier New', monospace;
        font-weight: 600;
        text-align: center;
    }
    
    /* Style for time display in table */
    .time-display {
        font-family: 'Courier New', monospace;
        font-weight: 600;
        background: #f8f9fa;
        padding: 4px 8px;
        border-radius: 4px;
        border: 1px solid #e9ecef;
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
        
        .grid-cols-5 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }
    
    @media (max-width: 576px) {
        .table-responsive {
            font-size: 0.8rem;
        }
        
        .badge {
            font-size: 0.75rem;
        }
        
        .grid-cols-5 {
            grid-template-columns: 1fr;
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