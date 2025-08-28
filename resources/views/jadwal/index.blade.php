@extends('layouts.app')

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
                            <div class="bg-gradient-to-r from-purple-500 to-pink-600 rounded-lg p-2 mr-3">
                                <i data-lucide="calendar" class="w-6 h-6 text-white"></i>
                            </div>
                            Manajemen Jadwal
                        </h1>
                        <p class="text-gray-600 dark:text-gray-300 mt-1">Kelola jadwal pelajaran dan pengaturan waktu belajar dengan mudah</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="text-sm text-gray-500 dark:text-gray-300 hidden sm:flex items-center">
                            <i data-lucide="calendar" class="w-4 h-4 mr-1"></i>
                            {{ $jadwals->total() }} Jadwal Terdaftar
                        </div>
                        <button type="button" 
                                class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-purple-500 to-pink-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium" 
                                data-bs-toggle="modal" data-bs-target="#modalCreateJadwal">
                            <i data-lucide="plus" class="w-5 h-5"></i>
                            <span>Tambah Jadwal</span>
                        </button>
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

        {{-- Error Notification --}}
        @if($errors->any())
        <div class="mb-6">
            <div class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-xl p-4 shadow-sm">
                <div class="flex items-center">
                    <div class="bg-red-100 dark:bg-red-900/50 rounded-lg p-2 mr-3">
                        <i data-lucide="alert-triangle" class="w-5 h-5 text-red-600 dark:text-red-400"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-red-800 dark:text-red-200">Terjadi kesalahan:</p>
                        <ul class="mt-2 list-disc list-inside text-red-700 dark:text-red-300 text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" class="ml-auto text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300" data-bs-dismiss="alert">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>
        </div>
        @endif

        <!-- Schedule Table -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl">
            <!-- Header: Judul kiri, Search & Filter kanan -->
            <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800/50 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <!-- Judul kiri -->
                <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                    <div class="bg-gradient-to-r from-purple-500 to-pink-600 rounded-lg p-2 mr-3 shadow-lg">
                        <i data-lucide="table" class="w-5 h-5 text-white"></i>
                    </div>
                    Data Jadwal
                </h5>
                <!-- Search & Filter kanan -->
                <div class="flex flex-col sm:flex-row gap-2 items-stretch sm:items-center">
                    <div class="relative">
                        <input type="text"
                            id="liveSearchInput"
                            class="w-[150px] md:w-[180px] pl-9 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-purple-500 dark:focus:border-purple-400 transition-all duration-200 shadow-sm"
                            placeholder="Cari jadwal..."
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
                    <select id="kelasFilter" class="w-[100px] md:w-[120px] px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-purple-500 dark:focus:border-purple-400 transition-all duration-200 shadow-sm">
                        <option value="">Semua Kelas</option>
                        @foreach($kelasList as $kelas)
                            <option value="{{ $kelas->nama }}">{{ $kelas->nama }}</option>
                        @endforeach
                    </select>
                    @if(Auth::user()->role === 'admin')
                    <select id="guruFilter" class="w-[100px] md:w-[120px] px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-purple-500 dark:focus:border-purple-400 transition-all duration-200 shadow-sm">
                        <option value="">Semua Guru</option>
                        @foreach($guruList as $guru)
                            <option value="{{ $guru->nama }}">{{ $guru->nama }}</option>
                        @endforeach
                    </select>
                    @endif
                    <select id="hariFilter" class="w-[90px] md:w-[110px] px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-purple-500 dark:focus:border-purple-400 transition-all duration-200 shadow-sm">
                        <option value="">Semua Hari</option>
                        @foreach($hariList as $hari)
                            <option value="{{ $hari }}">{{ $hari }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- End Header -->

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                        <tr>
                            <th class="px-4 py-3 text-center font-semibold text-gray-900 dark:text-white w-16">
                                <span class="flex items-center justify-center">
                                    <i data-lucide="hash" class="w-4 h-4 text-purple-500 dark:text-purple-400 mr-1"></i>
                                    No
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
                                    <i data-lucide="book-open" class="w-4 h-4 text-indigo-500 dark:text-indigo-400 mr-1"></i>
                                    Mata Pelajaran
                                </span>
                            </th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                <span class="flex items-center">
                                    <i data-lucide="user-check" class="w-4 h-4 text-green-500 dark:text-green-400 mr-1"></i>
                                    Guru
                                </span>
                            </th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                <span class="flex items-center">
                                    <i data-lucide="calendar-days" class="w-4 h-4 text-orange-500 dark:text-orange-400 mr-1"></i>
                                    Hari
                                </span>
                            </th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                <span class="flex items-center">
                                    <i data-lucide="clock" class="w-4 h-4 text-yellow-500 dark:text-yellow-400 mr-1"></i>
                                    Jam
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
                        @forelse($jadwals as $i => $jadwal)
                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200">
                            <td class="px-4 py-4 text-center text-gray-900 dark:text-white font-medium">
                                {{ $jadwals->firstItem() + $i }}
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center mr-3">
                                        <i data-lucide="school" class="w-4 h-4 text-blue-600 dark:text-blue-400"></i>
                                    </div>
                                    <span class="font-semibold text-gray-900 dark:text-white">{{ $jadwal->kelas->nama ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center mr-3">
                                        <i data-lucide="book-open" class="w-4 h-4 text-indigo-600 dark:text-indigo-400"></i>
                                    </div>
                                    <span class="font-semibold text-gray-900 dark:text-white">{{ $jadwal->mapel }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mr-3">
                                        <i data-lucide="user-check" class="w-4 h-4 text-green-600 dark:text-green-400"></i>
                                    </div>
                                    <span class="text-gray-900 dark:text-white">{{ $jadwal->guru->nama ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center mr-3">
                                        <i data-lucide="calendar-days" class="w-4 h-4 text-orange-600 dark:text-orange-400"></i>
                                    </div>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 border border-gray-200 dark:border-gray-600">
                                        {{ $jadwal->hari }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg flex items-center justify-center mr-3">
                                        <i data-lucide="clock" class="w-4 h-4 text-yellow-600 dark:text-yellow-400"></i>
                                    </div>
                                    <span class="font-mono font-semibold text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 px-3 py-1 rounded-lg border border-gray-200 dark:border-gray-600">
                                        {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex justify-center gap-2">
                                    @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('jadwal.edit', $jadwal) }}" 
                                       class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-r from-yellow-500 to-orange-600 text-white shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300"
                                       title="Edit Jadwal" data-bs-toggle="tooltip">
                                        <i data-lucide="pencil" class="w-4 h-4"></i>
                                    </a>
                                    <form action="{{ route('jadwal.destroy', $jadwal) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-r from-red-500 to-red-600 text-white shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300" 
                                                title="Hapus Jadwal" data-bs-toggle="tooltip">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                    @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200 border border-blue-200 dark:border-blue-800">
                                        <i data-lucide="calendar-check" class="w-3 h-3 mr-1"></i>
                                        Jadwal Mengajar
                                    </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="bg-white dark:bg-gray-800">
                            <td colspan="7" class="px-4 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                        <i data-lucide="calendar-x" class="w-8 h-8 text-gray-400 dark:text-gray-500"></i>
                                    </div>
                                    <p class="text-gray-500 dark:text-gray-400 font-medium">Tidak ada data jadwal</p>
                                    <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Mulai dengan menambahkan jadwal baru</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($jadwals->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                {{ $jadwals->withQueryString()->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<script src="{{ asset('js/page.js') }}"></script>
{{-- Include Modal Create Jadwal --}}
@include('jadwal.create-modal')

@endsection