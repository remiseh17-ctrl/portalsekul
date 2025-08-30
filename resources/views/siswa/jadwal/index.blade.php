@extends('layouts.app')

@section('page_class', 'page-siswa-jadwal')
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
                            <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg p-2 mr-3">
                                <i data-lucide="calendar-check" class="w-6 h-6 text-white"></i>
                            </div>
                            Jadwal Pelajaran
                        </h1>
                        <p class="text-gray-600 dark:text-gray-300 mt-1">Jadwal pelajaran mingguan untuk kelas Anda</p>
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-300">
                        <i data-lucide="calendar" class="w-4 h-4 mr-1 inline"></i>
                        {{ now()->format('d F Y') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Jadwal Table -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl">
            <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800/50 rounded-t-xl">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                        <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg p-2 mr-3 shadow-lg">
                            <i data-lucide="calendar-days" class="w-5 h-5 text-white"></i>
                        </div>
                        Jadwal Pelajaran Mingguan
                    </h5>
                    <div class="relative">
                        <input type="text"
                               id="searchJadwalSiswa"
                               class="w-full sm:w-64 px-4 py-2 pl-10 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-200 shadow-sm"
                               placeholder=" Cari jadwal...">
                        <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500"></i>
                    </div>
                </div>
            </div>
            <div class="overflow-hidden rounded-b-xl">
                <div class="overflow-x-auto">
                    <table id="tableJadwalSiswa" class="w-full text-sm bg-white dark:bg-gray-800">
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
                                        Hari
                                    </span>
                                </th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                    <span class="flex items-center">
                                        <i data-lucide="clock" class="w-4 h-4 text-red-500 dark:text-red-400 mr-1"></i>
                                        Waktu
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
                                <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                    <span class="flex items-center">
                                        <i data-lucide="home" class="w-4 h-4 text-indigo-500 dark:text-indigo-400 mr-1"></i>
                                        Kelas
                                    </span>
                                </th>
                                <th class="px-4 py-3 text-center font-semibold text-gray-900 dark:text-white">
                                    <span class="flex items-center justify-center">
                                        <i data-lucide="file-text" class="w-4 h-4 text-teal-500 dark:text-teal-400 mr-1"></i>
                                        Materi
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-600 bg-white dark:bg-gray-800">
                            @forelse($jadwals as $index => $jadwal)
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200">
                                <td class="px-4 py-4 text-gray-900 dark:text-white font-medium">{{ $index + 1 }}</td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mr-3">
                                            <i data-lucide="calendar" class="w-4 h-4 text-purple-600 dark:text-purple-400"></i>
                                        </div>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200 border border-blue-200 dark:border-blue-800">
                                            {{ $jadwal->hari }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center mr-3">
                                            <i data-lucide="clock" class="w-4 h-4 text-red-600 dark:text-red-400"></i>
                                        </div>
                                        <span class="text-gray-900 dark:text-white font-mono text-sm">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mr-3">
                                            <i data-lucide="book-open" class="w-4 h-4 text-green-600 dark:text-green-400"></i>
                                        </div>
                                        <span class="font-semibold text-gray-900 dark:text-white">{{ $jadwal->mapel }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center mr-3">
                                            <i data-lucide="user-check" class="w-4 h-4 text-orange-600 dark:text-orange-400"></i>
                                        </div>
                                        <span class="text-gray-900 dark:text-white font-medium">{{ $jadwal->guru->nama ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center mr-3">
                                            <i data-lucide="door-open" class="w-4 h-4 text-indigo-600 dark:text-indigo-400"></i>
                                        </div>
                                        <span class="text-gray-900 dark:text-white font-medium">{{ $jadwal->kelas->nama ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <a href="{{ route('siswa.materi') }}?mapel={{ $jadwal->mapel }}"
                                       class="inline-flex items-center gap-1 px-3 py-1 rounded-md text-xs font-semibold bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200 hover:bg-blue-200 dark:hover:bg-blue-800 border border-blue-200 dark:border-blue-800 transition-colors"
                                       title="Lihat Materi">
                                        <i data-lucide="file-text" class="w-3 h-3"></i>
                                        Materi
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr class="bg-white dark:bg-gray-800">
                                <td colspan="7" class="px-4 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                            <i data-lucide="calendar-x" class="w-8 h-8 text-gray-400 dark:text-gray-500"></i>
                                        </div>
                                        <p class="text-gray-500 dark:text-gray-400 font-medium">Belum ada jadwal pelajaran</p>
                                        <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Jadwal pelajaran akan muncul setelah admin menambahkan jadwal untuk kelas Anda</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/page.js') }}"></script>
@endsection