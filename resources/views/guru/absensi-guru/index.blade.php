@extends('layouts.app')

@section('page_class', 'page-guru-absensi-guru')
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
                            <div class="bg-gradient-to-r from-emerald-500 to-cyan-600 rounded-lg p-2 mr-3">
                                <i data-lucide="clipboard-check" class="w-6 h-6 text-white"></i>
                            </div>
                            Absensi Guru
                        </h1>
                        <p class="text-gray-600 dark:text-gray-300 mt-1">Kelola absensi mengajar dan riwayat kehadiran Anda</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="text-sm text-gray-500 dark:text-gray-300 hidden sm:flex items-center">
                            <i data-lucide="clipboard-check" class="w-4 h-4 mr-1"></i>
                            {{ $absensiGuru->total() }} Data Absensi
                        </div>
                        <a href="{{ route('absensi-guru.create') }}"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-emerald-500 to-cyan-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium">
                            <i data-lucide="plus" class="w-5 h-5"></i>
                            <span>Tambah Absensi</span>
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

        {{-- Error Notification --}}
        @if(session('error'))
        <div class="mb-6">
            <div class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-xl p-4 shadow-sm">
                <div class="flex items-center">
                    <div class="bg-red-100 dark:bg-red-900/50 rounded-lg p-2 mr-3">
                        <i data-lucide="alert-triangle" class="w-5 h-5 text-red-600 dark:text-red-400"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-red-800 dark:text-red-200">Error!</p>
                        <p class="text-red-700 dark:text-red-300 text-sm">{{ session('error') }}</p>
                    </div>
                    <button type="button" class="ml-auto text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300" data-bs-dismiss="alert">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>
        </div>
        @endif

        <!-- Today's Teaching Schedule -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden mb-8 transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl">
            <!-- Header: Judul kiri, Search & Filter kanan -->
            <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800/50 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <!-- Judul kiri -->
                <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg p-2 mr-3 shadow-lg">
                        <i data-lucide="calendar" class="w-5 h-5 text-white"></i>
                    </div>
                    Jadwal Mengajar Hari Ini
                </h5>
                <!-- Current date display -->
                <div class="text-sm text-gray-500 dark:text-gray-300">
                    <i data-lucide="calendar" class="w-4 h-4 mr-1 inline"></i>
                    {{ now()->format('l, d F Y') }}
                </div>
            </div>
            <!-- End Header -->

            <div class="overflow-x-auto">
                <table id="tableJadwalHariIni" class="w-full text-sm">
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
                                    <i data-lucide="school" class="w-4 h-4 text-green-500 dark:text-green-400 mr-1"></i>
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
                                    <i data-lucide="calendar-days" class="w-4 h-4 text-orange-500 dark:text-orange-400 mr-1"></i>
                                    Hari
                                </span>
                            </th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                <span class="flex items-center">
                                    <i data-lucide="clock" class="w-4 h-4 text-indigo-500 dark:text-indigo-400 mr-1"></i>
                                    Jam
                                </span>
                            </th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                <span class="flex items-center">
                                    <i data-lucide="check-circle" class="w-4 h-4 text-teal-500 dark:text-teal-400 mr-1"></i>
                                    Status Absensi
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
                        @forelse($jadwalMengajar as $i => $jadwal)
                        @php
                            $hariIni = \Carbon\Carbon::now()->format('l');
                            $hariIndonesia = [
                                'Monday' => 'Senin',
                                'Tuesday' => 'Selasa',
                                'Wednesday' => 'Rabu',
                                'Thursday' => 'Kamis',
                                'Friday' => 'Jumat',
                                'Saturday' => 'Sabtu',
                                'Sunday' => 'Minggu',
                            ][$hariIni] ?? $hariIni;

                            $isHariIni = $jadwal->hari === $hariIndonesia;
                            $absensiHariIni = $absensiGuru->where('jadwal_id', $jadwal->id)
                                ->where('tanggal', \Carbon\Carbon::now()->toDateString())
                                ->first();
                        @endphp

                        @if($isHariIni)
                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200">
                            <td class="px-4 py-4 text-center text-gray-900 dark:text-white font-medium">
                                {{ $jadwals->firstItem() + $i }}
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mr-3">
                                        <i data-lucide="school" class="w-4 h-4 text-green-600 dark:text-green-400"></i>
                                    </div>
                                    <span class="font-semibold text-gray-900 dark:text-white">{{ $jadwal->kelas->nama ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mr-3">
                                        <i data-lucide="book-open" class="w-4 h-4 text-purple-600 dark:text-purple-400"></i>
                                    </div>
                                    <span class="text-gray-900 dark:text-white font-medium">{{ $jadwal->mapel }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center mr-3">
                                        <i data-lucide="calendar-days" class="w-4 h-4 text-orange-600 dark:text-orange-400"></i>
                                    </div>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-orange-100 dark:bg-orange-900/50 text-orange-800 dark:text-orange-200 border border-orange-200 dark:border-orange-800">
                                        <i data-lucide="calendar" class="w-3 h-3 mr-1"></i>
                                        {{ $jadwal->hari }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center mr-3">
                                        <i data-lucide="clock" class="w-4 h-4 text-indigo-600 dark:text-indigo-400"></i>
                                    </div>
                                    <span class="font-semibold text-gray-900 dark:text-white">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                @if($absensiHariIni)
                                    @php
                                        $statusColor = $absensiHariIni->status == 'Hadir' ? 'bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-200 border-green-200 dark:border-green-800' :
                                                      ($absensiHariIni->status == 'Izin' ? 'bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-200 border-yellow-200 dark:border-yellow-800' :
                                                      ($absensiHariIni->status == 'Sakit' ? 'bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200 border-blue-200 dark:border-blue-800' :
                                                      'bg-gray-100 dark:bg-gray-900/50 text-gray-800 dark:text-gray-200 border-gray-200 dark:border-gray-800'));
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $statusColor }}">
                                        <i data-lucide="{{ $absensiHariIni->status == 'Hadir' ? 'check-circle' : ($absensiHariIni->status == 'Izin' ? 'file-text' : ($absensiHariIni->status == 'Sakit' ? 'thermometer' : 'minus-circle')) }}" class="w-3 h-3 mr-1"></i>
                                        {{ $absensiHariIni->status }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-200 border border-yellow-200 dark:border-yellow-800">
                                        <i data-lucide="clock" class="w-3 h-3 mr-1"></i>
                                        Belum Absen
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex justify-center gap-2">
                                    @if($absensiHariIni)
                                        <a href="{{ route('absensi-guru.show', $absensiHariIni->id) }}"
                                           class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300"
                                           title="Lihat Detail">
                                            <i data-lucide="eye" class="w-4 h-4"></i>
                                        </a>
                                        <a href="{{ route('absensi-guru.edit', $absensiHariIni->id) }}"
                                           class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-r from-yellow-500 to-orange-600 text-white shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300"
                                           title="Edit Absensi">
                                            <i data-lucide="pencil" class="w-4 h-4"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('absensi-guru.create') }}?jadwal_id={{ $jadwal->id }}"
                                           class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium"
                                           title="Lakukan Absensi">
                                            <i data-lucide="plus" class="w-4 h-4"></i>
                                            <span>Absen</span>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endif
                        @empty
                        <tr class="bg-white dark:bg-gray-800">
                            <td colspan="7" class="px-4 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                        <i data-lucide="calendar-x" class="w-8 h-8 text-gray-400 dark:text-gray-500"></i>
                                    </div>
                                    <p class="text-gray-500 dark:text-gray-400 font-medium">Tidak ada jadwal mengajar hari ini</p>
                                    <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Jadwal mengajar akan muncul berdasarkan hari ini</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Attendance History -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl">
            <!-- Header: Judul kiri, Search & Filter kanan -->
            <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800/50 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <!-- Judul kiri -->
                <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                    <div class="bg-gradient-to-r from-purple-500 to-pink-600 rounded-lg p-2 mr-3 shadow-lg">
                        <i data-lucide="clock" class="w-5 h-5 text-white"></i>
                    </div>
                    Riwayat Absensi
                </h5>
                <!-- Search & Filter kanan -->
                <div class="flex flex-col sm:flex-row gap-2 items-stretch sm:items-center">
                    <div class="relative">
                        <input type="text"
                            id="liveSearchInput"
                            class="w-[150px] md:w-[180px] pl-9 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-purple-500 dark:focus:border-purple-400 transition-all duration-200 shadow-sm"
                            placeholder="Cari riwayat..."
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
                <table id="tableRiwayatAbsensi" class="w-full text-sm">
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
                                    <i data-lucide="calendar" class="w-4 h-4 text-green-500 dark:text-green-400 mr-1"></i>
                                    Tanggal
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
                                    <i data-lucide="book-open" class="w-4 h-4 text-orange-500 dark:text-orange-400 mr-1"></i>
                                    Mata Pelajaran
                                </span>
                            </th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                <span class="flex items-center">
                                    <i data-lucide="calendar-days" class="w-4 h-4 text-indigo-500 dark:text-indigo-400 mr-1"></i>
                                    Hari
                                </span>
                            </th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                <span class="flex items-center">
                                    <i data-lucide="clock" class="w-4 h-4 text-teal-500 dark:text-teal-400 mr-1"></i>
                                    Jam
                                </span>
                            </th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                <span class="flex items-center">
                                    <i data-lucide="check-circle" class="w-4 h-4 text-cyan-500 dark:text-cyan-400 mr-1"></i>
                                    Status
                                </span>
                            </th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                <span class="flex items-center">
                                    <i data-lucide="file-text" class="w-4 h-4 text-pink-500 dark:text-pink-400 mr-1"></i>
                                    Keterangan
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
                        @forelse($absensiGuru as $i => $absensi)
                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200">
                            <td class="px-4 py-4 text-center text-gray-900 dark:text-white font-medium">
                                {{ $absensiGuru->firstItem() + $i }}
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mr-3">
                                        <i data-lucide="calendar" class="w-4 h-4 text-green-600 dark:text-green-400"></i>
                                    </div>
                                    <span class="font-semibold text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($absensi->tanggal)->format('d/m/Y') }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center mr-3">
                                        <i data-lucide="school" class="w-4 h-4 text-blue-600 dark:text-blue-400"></i>
                                    </div>
                                    <span class="text-gray-900 dark:text-white font-medium">{{ $absensi->jadwal->kelas->nama ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center mr-3">
                                        <i data-lucide="book-open" class="w-4 h-4 text-orange-600 dark:text-orange-400"></i>
                                    </div>
                                    <span class="text-gray-900 dark:text-white font-medium">{{ $absensi->jadwal->mapel }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center mr-3">
                                        <i data-lucide="calendar-days" class="w-4 h-4 text-indigo-600 dark:text-indigo-400"></i>
                                    </div>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-indigo-100 dark:bg-indigo-900/50 text-indigo-800 dark:text-indigo-200 border border-indigo-200 dark:border-indigo-800">
                                        <i data-lucide="calendar" class="w-3 h-3 mr-1"></i>
                                        {{ $absensi->jadwal->hari }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-teal-100 dark:bg-teal-900/30 rounded-lg flex items-center justify-center mr-3">
                                        <i data-lucide="clock" class="w-4 h-4 text-teal-600 dark:text-teal-400"></i>
                                    </div>
                                    <span class="font-semibold text-gray-900 dark:text-white">{{ $absensi->jadwal->jam_mulai }} - {{ $absensi->jadwal->jam_selesai }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                @php
                                    $statusColors = [
                                        'Hadir' => 'bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-200 border-green-200 dark:border-green-800',
                                        'Izin' => 'bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-200 border-yellow-200 dark:border-yellow-800',
                                        'Sakit' => 'bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200 border-blue-200 dark:border-blue-800',
                                        'Tidak KBM' => 'bg-gray-100 dark:bg-gray-900/50 text-gray-800 dark:text-gray-200 border-gray-200 dark:border-gray-800',
                                        'Tugas' => 'bg-purple-100 dark:bg-purple-900/50 text-purple-800 dark:text-purple-200 border-purple-200 dark:border-purple-800'
                                    ];
                                @endphp
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $statusColors[$absensi->status] ?? 'bg-gray-100 dark:bg-gray-900/50 text-gray-800 dark:text-gray-200 border-gray-200 dark:border-gray-800' }}">
                                    <i data-lucide="{{ $absensi->status == 'Hadir' ? 'check-circle' : ($absensi->status == 'Izin' ? 'file-text' : ($absensi->status == 'Sakit' ? 'thermometer' : ($absensi->status == 'Tidak KBM' ? 'minus-circle' : 'briefcase'))) }}" class="w-3 h-3 mr-1"></i>
                                    {{ $absensi->status }}
                                </span>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-pink-100 dark:bg-pink-900/30 rounded-lg flex items-center justify-center mr-3">
                                        <i data-lucide="file-text" class="w-4 h-4 text-pink-600 dark:text-pink-400"></i>
                                    </div>
                                    <span class="text-gray-900 dark:text-white text-sm">
                                        @if($absensi->keterangan)
                                            {{ Str::limit($absensi->keterangan, 30) }}
                                        @else
                                            <span class="text-gray-500 dark:text-gray-400">-</span>
                                        @endif
                                    </span>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('absensi-guru.show', $absensi->id) }}"
                                       class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300"
                                       title="Lihat Detail">
                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                    </a>
                                    <a href="{{ route('absensi-guru.edit', $absensi->id) }}"
                                       class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-r from-yellow-500 to-orange-600 text-white shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300"
                                       title="Edit Absensi">
                                        <i data-lucide="pencil" class="w-4 h-4"></i>
                                    </a>
                                    <form action="{{ route('absensi-guru.destroy', $absensi->id) }}" method="POST"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus absensi ini?')" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-r from-red-500 to-red-600 text-white shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300"
                                                title="Hapus Absensi" data-bs-toggle="tooltip">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="bg-white dark:bg-gray-800">
                            <td colspan="9" class="px-4 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                        <i data-lucide="clock-x" class="w-8 h-8 text-gray-400 dark:text-gray-500"></i>
                                    </div>
                                    <p class="text-gray-500 dark:text-gray-400 font-medium">Belum ada riwayat absensi</p>
                                    <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Riwayat absensi akan muncul setelah Anda melakukan absensi</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($absensiGuru->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                {{ $absensiGuru->withQueryString()->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<script src="{{ asset('js/page.js') }}"></script>
@endsection