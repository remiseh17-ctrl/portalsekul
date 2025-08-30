@extends('layouts.app')

@section('page_class', 'page-siswa-materi')
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
                            <div class="bg-gradient-to-r from-cyan-500 to-blue-600 rounded-lg p-2 mr-3">
                                <i data-lucide="file-text" class="w-6 h-6 text-white"></i>
                            </div>
                            Materi Pembelajaran
                        </h1>
                        <p class="text-gray-600 dark:text-gray-300 mt-1">Akses materi dan file pembelajaran Anda</p>
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-300">
                        <i data-lucide="calendar" class="w-4 h-4 mr-1 inline"></i>
                        {{ now()->format('d F Y') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Materi Table -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl">
            <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800/50 rounded-t-xl">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                        <div class="bg-gradient-to-r from-cyan-500 to-blue-600 rounded-lg p-2 mr-3 shadow-lg">
                            <i data-lucide="files" class="w-5 h-5 text-white"></i>
                        </div>
                        Daftar Materi
                    </h5>
                    <div class="relative">
                        <input type="text"
                               id="searchMateriSiswa"
                               class="w-full sm:w-64 px-4 py-2 pl-10 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-cyan-500 dark:focus:ring-cyan-400 focus:border-cyan-500 dark:focus:border-cyan-400 transition-all duration-200 shadow-sm"
                               placeholder=" Cari materi...">
                        <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500"></i>
                    </div>
                </div>
            </div>
            <div class="overflow-hidden rounded-b-xl">
                <div class="overflow-x-auto">
                    <table id="tableMateriSiswa" class="w-full text-sm bg-white dark:bg-gray-800">
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
                                        <i data-lucide="file-text" class="w-4 h-4 text-purple-500 dark:text-purple-400 mr-1"></i>
                                        Judul
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
                                        <i data-lucide="message-square" class="w-4 h-4 text-indigo-500 dark:text-indigo-400 mr-1"></i>
                                        Deskripsi
                                    </span>
                                </th>
                                <th class="px-4 py-3 text-center font-semibold text-gray-900 dark:text-white">
                                    <span class="flex items-center justify-center">
                                        <i data-lucide="download" class="w-4 h-4 text-teal-500 dark:text-teal-400 mr-1"></i>
                                        File
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-600 bg-white dark:bg-gray-800">
                            @forelse($materis as $index => $materi)
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200">
                                <td class="px-4 py-4 text-gray-900 dark:text-white font-medium">{{ $materis->firstItem() + $index }}</td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mr-3">
                                            <i data-lucide="file-text" class="w-4 h-4 text-purple-600 dark:text-purple-400"></i>
                                        </div>
                                        <span class="font-semibold text-gray-900 dark:text-white">{{ $materi->judul }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mr-3">
                                            <i data-lucide="book-open" class="w-4 h-4 text-green-600 dark:text-green-400"></i>
                                        </div>
                                        <span class="text-gray-900 dark:text-white font-medium">{{ $materi->jadwal->mapel ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center mr-3">
                                            <i data-lucide="user-check" class="w-4 h-4 text-orange-600 dark:text-orange-400"></i>
                                        </div>
                                        <span class="text-gray-900 dark:text-white font-medium">{{ $materi->guru->nama ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    @if($materi->deskripsi)
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center mr-3">
                                                <i data-lucide="message-square" class="w-4 h-4 text-indigo-600 dark:text-indigo-400"></i>
                                            </div>
                                            <span class="text-gray-900 dark:text-white">{{ Str::limit($materi->deskripsi, 50) }}</span>
                                        </div>
                                    @else
                                        <span class="text-gray-400 dark:text-gray-500">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 text-center">
                                    @if($materi->file)
                                        <a href="{{ Storage::url($materi->file) }}"
                                           class="inline-flex items-center gap-1 px-3 py-1 rounded-md text-xs font-semibold bg-teal-100 dark:bg-teal-900/50 text-teal-800 dark:text-teal-200 hover:bg-teal-200 dark:hover:bg-teal-800 border border-teal-200 dark:border-teal-800 transition-colors"
                                           target="_blank"
                                           title="Download">
                                            <i data-lucide="download" class="w-3 h-3"></i>
                                            Download
                                        </a>
                                    @else
                                        <span class="text-gray-400 dark:text-gray-500">Tidak ada file</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr class="bg-white dark:bg-gray-800">
                                <td colspan="6" class="px-4 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                            <i data-lucide="file-x" class="w-8 h-8 text-gray-400 dark:text-gray-500"></i>
                                        </div>
                                        <p class="text-gray-500 dark:text-gray-400 font-medium">Belum ada materi</p>
                                        <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Materi pembelajaran akan muncul setelah guru mengupload materi untuk kelas Anda</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($materis->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                    {{ $materis->withQueryString()->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/page.js') }}"></script>
@endsection