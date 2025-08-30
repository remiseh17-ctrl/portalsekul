@extends('layouts.app')

@section('page_class', 'page-siswa-pengumuman')
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
                            <div class="bg-gradient-to-r from-yellow-500 to-orange-600 rounded-lg p-2 mr-3">
                                <i data-lucide="megaphone" class="w-6 h-6 text-white"></i>
                            </div>
                            Pengumuman
                        </h1>
                        <p class="text-gray-600 dark:text-gray-300 mt-1">Informasi penting dari admin dan guru</p>
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-300">
                        <i data-lucide="calendar" class="w-4 h-4 mr-1 inline"></i>
                        {{ now()->format('d F Y') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
            <!-- Pengumuman Admin -->
            <div class="xl:col-span-1">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800/50 rounded-t-xl">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                <div class="bg-gradient-to-r from-red-500 to-pink-600 rounded-lg p-2 mr-3 shadow-lg">
                                    <i data-lucide="shield" class="w-5 h-5 text-white"></i>
                                </div>
                                Pengumuman Admin
                            </h5>
                            <div class="relative">
                                <input type="text"
                                       id="searchPengumumanAdmin"
                                       class="w-full sm:w-48 px-4 py-2 pl-10 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-red-500 dark:focus:ring-red-400 focus:border-red-500 dark:focus:border-red-400 transition-all duration-200 shadow-sm"
                                       placeholder=" Cari...">
                                <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500"></i>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-hidden rounded-b-xl">
                        <div class="overflow-x-auto">
                            <table id="tablePengumumanAdmin" class="w-full text-sm bg-white dark:bg-gray-800">
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
                                                <i data-lucide="calendar" class="w-4 h-4 text-green-500 dark:text-green-400 mr-1"></i>
                                                Tanggal
                                            </span>
                                        </th>
                                        <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                            <span class="flex items-center">
                                                <i data-lucide="align-left" class="w-4 h-4 text-orange-500 dark:text-orange-400 mr-1"></i>
                                                Isi
                                            </span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-600 bg-white dark:bg-gray-800">
                                    @forelse($pengumumanAdmin ?? [] as $index => $p)
                                    <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200">
                                        <td class="px-4 py-4 text-gray-900 dark:text-white font-medium">{{ $pengumumanAdmin->firstItem() + $index }}</td>
                                        <td class="px-4 py-4">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mr-3">
                                                    <i data-lucide="file-text" class="w-4 h-4 text-purple-600 dark:text-purple-400"></i>
                                                </div>
                                                <span class="font-semibold text-gray-900 dark:text-white">{{ $p->judul }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mr-3">
                                                    <i data-lucide="calendar" class="w-4 h-4 text-green-600 dark:text-green-400"></i>
                                                </div>
                                                <span class="text-gray-900 dark:text-white font-medium">{{ $p->tanggal ? \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') : '-' }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="max-w-xs">
                                                <p class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed">
                                                    {{ Str::limit($p->isi, 80) }}
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="bg-white dark:bg-gray-800">
                                        <td colspan="4" class="px-4 py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                                    <i data-lucide="shield-x" class="w-8 h-8 text-gray-400 dark:text-gray-500"></i>
                                                </div>
                                                <p class="text-gray-500 dark:text-gray-400 font-medium">Belum ada pengumuman admin</p>
                                                <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Pengumuman dari admin akan muncul di sini</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if(isset($pengumumanAdmin) && $pengumumanAdmin->hasPages())
                        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                            {{ $pengumumanAdmin->appends(['kelas_page' => request('kelas_page')])->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Pengumuman Kelas -->
            <div class="xl:col-span-1">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800/50 rounded-t-xl">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg p-2 mr-3 shadow-lg">
                                    <i data-lucide="users" class="w-5 h-5 text-white"></i>
                                </div>
                                Pengumuman Kelas
                            </h5>
                            <div class="relative">
                                <input type="text"
                                       id="searchPengumumanKelas"
                                       class="w-full sm:w-48 px-4 py-2 pl-10 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-200 shadow-sm"
                                       placeholder=" Cari...">
                                <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500"></i>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-hidden rounded-b-xl">
                        <div class="overflow-x-auto">
                            <table id="tablePengumumanKelas" class="w-full text-sm bg-white dark:bg-gray-800">
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
                                                <i data-lucide="user" class="w-4 h-4 text-orange-500 dark:text-orange-400 mr-1"></i>
                                                Guru
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
                                                <i data-lucide="align-left" class="w-4 h-4 text-indigo-500 dark:text-indigo-400 mr-1"></i>
                                                Isi
                                            </span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-600 bg-white dark:bg-gray-800">
                                    @forelse($pengumumanKelas as $index => $pengumuman)
                                    <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200">
                                        <td class="px-4 py-4 text-gray-900 dark:text-white font-medium">{{ $pengumumanKelas->firstItem() + $index }}</td>
                                        <td class="px-4 py-4">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mr-3">
                                                    <i data-lucide="file-text" class="w-4 h-4 text-purple-600 dark:text-purple-400"></i>
                                                </div>
                                                <span class="font-semibold text-gray-900 dark:text-white">{{ $pengumuman->judul }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center mr-3">
                                                    <i data-lucide="user-check" class="w-4 h-4 text-orange-600 dark:text-orange-400"></i>
                                                </div>
                                                <span class="text-gray-900 dark:text-white font-medium">{{ $pengumuman->guru->nama ?? '-' }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mr-3">
                                                    <i data-lucide="calendar" class="w-4 h-4 text-green-600 dark:text-green-400"></i>
                                                </div>
                                                <span class="text-gray-900 dark:text-white font-medium">{{ $pengumuman->tanggal ? \Carbon\Carbon::parse($pengumuman->tanggal)->format('d/m/Y') : '-' }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="max-w-xs">
                                                <p class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed">
                                                    {{ Str::limit($pengumuman->isi, 80) }}
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="bg-white dark:bg-gray-800">
                                        <td colspan="5" class="px-4 py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                                    <i data-lucide="users-x" class="w-8 h-8 text-gray-400 dark:text-gray-500"></i>
                                                </div>
                                                <p class="text-gray-500 dark:text-gray-400 font-medium">Belum ada pengumuman kelas</p>
                                                <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Pengumuman kelas akan muncul setelah guru membuat pengumuman untuk kelas Anda</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if($pengumumanKelas->hasPages())
                        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                            {{ $pengumumanKelas->appends(['admin_page' => request('admin_page')])->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/page.js') }}"></script>
@endsection