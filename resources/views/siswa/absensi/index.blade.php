@extends('layouts.app')

@section('page_class', 'page-siswa-absensi')
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
                            <div class="bg-gradient-to-r from-green-500 to-teal-600 rounded-lg p-2 mr-3">
                                <i data-lucide="clipboard-check" class="w-6 h-6 text-white"></i>
                            </div>
                            Absensi Saya
                        </h1>
                        <p class="text-gray-600 dark:text-gray-300 mt-1">Riwayat kehadiran dan absensi Anda</p>
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-300">
                        <i data-lucide="calendar" class="w-4 h-4 mr-1 inline"></i>
                        {{ now()->format('d F Y') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Absensi Table -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl">
            <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800/50 rounded-t-xl">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                        <div class="bg-gradient-to-r from-green-500 to-teal-600 rounded-lg p-2 mr-3 shadow-lg">
                            <i data-lucide="clipboard-list" class="w-5 h-5 text-white"></i>
                        </div>
                        Daftar Absensi
                    </h5>
                    <div class="relative">
                        <input type="text"
                               id="searchAbsensiSiswa"
                               class="w-full sm:w-64 px-4 py-2 pl-10 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:border-green-500 dark:focus:border-green-400 transition-all duration-200 shadow-sm"
                               placeholder=" Cari absensi...">
                        <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500"></i>
                    </div>
                </div>
            </div>
            <div class="overflow-hidden rounded-b-xl">
                <div class="overflow-x-auto">
                    <table id="tableAbsensiSiswa" class="w-full text-sm bg-white dark:bg-gray-800">
                        <thead class="bg-gray-100 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white w-16">
                                    <span class="flex items-center">
                                        <i data-lucide="hash" class="w-4 h-4 text-blue-500 dark:text-blue-400 mr-1"></i>
                                        No
                                    </span>
                                </th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                    <span class="flex items-center">
                                        <i data-lucide="calendar" class="w-4 h-4 text-purple-500 dark:text-purple-400 mr-1"></i>
                                        Tanggal
                                    </span>
                                </th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                    <span class="flex items-center">
                                        <i data-lucide="book" class="w-4 h-4 text-green-500 dark:text-green-400 mr-1"></i>
                                        Mata Pelajaran
                                    </span>
                                </th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                    <span class="flex items-center">
                                        <i data-lucide="user" class="w-4 h-4 text-orange-500 dark:text-orange-400 mr-1"></i>
                                        Guru
                                    </span>
                                </th>
                                <th class="px-4 py-3 text-center font-semibold text-gray-900 dark:text-white">
                                    <span class="flex items-center justify-center">
                                        <i data-lucide="activity" class="w-4 h-4 text-red-500 dark:text-red-400 mr-1"></i>
                                        Status
                                    </span>
                                </th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                    <span class="flex items-center">
                                        <i data-lucide="message-square" class="w-4 h-4 text-indigo-500 dark:text-indigo-400 mr-1"></i>
                                        Keterangan
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-600 bg-white dark:bg-gray-800">
                            @forelse($absensis as $index => $absensi)
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200">
                                <td class="px-4 py-4 text-gray-900 dark:text-white font-medium">{{ $absensis->firstItem() + $index }}</td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mr-3">
                                            <i data-lucide="calendar" class="w-4 h-4 text-purple-600 dark:text-purple-400"></i>
                                        </div>
                                        <span class="text-gray-900 dark:text-white font-medium">{{ $absensi->tanggal ? \Carbon\Carbon::parse($absensi->tanggal)->format('d/m/Y') : '-' }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mr-3">
                                            <i data-lucide="book-open" class="w-4 h-4 text-green-600 dark:text-green-400"></i>
                                        </div>
                                        <span class="font-semibold text-gray-900 dark:text-white">{{ $absensi->jadwal->mapel ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center mr-3">
                                            <i data-lucide="user-check" class="w-4 h-4 text-orange-600 dark:text-orange-400"></i>
                                        </div>
                                        <span class="text-gray-900 dark:text-white font-medium">{{ $absensi->jadwal->guru->nama ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    @php
                                        $statusColors = [
                                            'Hadir' => 'bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-200 border-green-200 dark:border-green-800',
                                            'Sakit' => 'bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-200 border-yellow-200 dark:border-yellow-800',
                                            'Izin' => 'bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200 border-blue-200 dark:border-blue-800',
                                            'Alpha' => 'bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-200 border-red-200 dark:border-red-800'
                                        ];
                                        $statusColor = $statusColors[$absensi->status] ?? 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 border-gray-200 dark:border-gray-600';
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold border {{ $statusColor }}">
                                        <i data-lucide="{{ $absensi->status == 'Hadir' ? 'check-circle' : ($absensi->status == 'Sakit' ? 'thermometer' : ($absensi->status == 'Izin' ? 'file-text' : 'x-circle')) }}" class="w-4 h-4 mr-1"></i>
                                        {{ $absensi->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-4">
                                    @if($absensi->keterangan)
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center mr-3">
                                                <i data-lucide="message-square" class="w-4 h-4 text-indigo-600 dark:text-indigo-400"></i>
                                            </div>
                                            <span class="text-gray-900 dark:text-white">{{ $absensi->keterangan }}</span>
                                        </div>
                                    @else
                                        <span class="text-gray-400 dark:text-gray-500">-</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr class="bg-white dark:bg-gray-800">
                                <td colspan="6" class="px-4 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                            <i data-lucide="clipboard-x" class="w-8 h-8 text-gray-400 dark:text-gray-500"></i>
                                        </div>
                                        <p class="text-gray-500 dark:text-gray-400 font-medium">Belum ada data absensi</p>
                                        <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Data absensi akan muncul setelah guru menginput absensi untuk Anda</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($absensis->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                    {{ $absensis->withQueryString()->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/page.js') }}"></script>
@endsection