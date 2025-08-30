@extends('layouts.app')

@section('page_class', 'page-siswa-nilai')
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
                            <div class="bg-gradient-to-r from-amber-500 to-yellow-600 rounded-lg p-2 mr-3">
                                <i data-lucide="star" class="w-6 h-6 text-white"></i>
                            </div>
                            Nilai Saya
                        </h1>
                        <p class="text-gray-600 dark:text-gray-300 mt-1">Pantau perkembangan nilai akademik Anda</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="text-sm text-gray-500 dark:text-gray-300">
                            <i data-lucide="calendar" class="w-4 h-4 mr-1 inline"></i>
                            {{ now()->format('d F Y') }}
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('siswa.nilai.transkrip') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium">
                                <i data-lucide="file-text" class="w-5 h-5"></i>
                                <span>Transkrip</span>
                            </a>
                            <a href="{{ route('siswa.nilai.akhir') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium">
                                <i data-lucide="table" class="w-5 h-5"></i>
                                <span>Nilai Akhir</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        @if($nilais->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            @php
                $sangatBaikCount = $nilais->filter(function($nilai) {
                    return $nilai->nilai >= 85;
                })->count();
                $baikCount = $nilais->filter(function($nilai) {
                    return $nilai->nilai >= 75 && $nilai->nilai < 85;
                })->count();
                $cukupCount = $nilais->filter(function($nilai) {
                    return $nilai->nilai >= 60 && $nilai->nilai < 75;
                })->count();
                $kurangCount = $nilais->filter(function($nilai) {
                    return $nilai->nilai < 60;
                })->count();
            @endphp

            <div class="stat-card bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 p-6 transition-transform duration-300 hover:shadow-2xl dark:hover:shadow-gray-900/50 hover:-translate-y-1 hover:scale-[1.01]">
                <div class="flex items-center">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-3 mr-4 shadow-lg">
                        <i data-lucide="star" class="w-6 h-6 text-white"></i>
                    </div>
                    <div class="flex-1">
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($nilais->total()) }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-300 font-medium">Total Nilai</div>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 p-6 transition-transform duration-300 hover:shadow-2xl dark:hover:shadow-gray-900/50 hover:-translate-y-1 hover:scale-[1.01]">
                <div class="flex items-center">
                    <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-3 mr-4 shadow-lg">
                        <i data-lucide="check-circle" class="w-6 h-6 text-white"></i>
                    </div>
                    <div class="flex-1">
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($sangatBaikCount) }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-300 font-medium">Sangat Baik</div>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 p-6 transition-transform duration-300 hover:shadow-2xl dark:hover:shadow-gray-900/50 hover:-translate-y-1 hover:scale-[1.01]">
                <div class="flex items-center">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-3 mr-4 shadow-lg">
                        <i data-lucide="star" class="w-6 h-6 text-white"></i>
                    </div>
                    <div class="flex-1">
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($baikCount) }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-300 font-medium">Baik</div>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 p-6 transition-transform duration-300 hover:shadow-2xl dark:hover:shadow-gray-900/50 hover:-translate-y-1 hover:scale-[1.01]">
                <div class="flex items-center">
                    <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-xl p-3 mr-4 shadow-lg">
                        <i data-lucide="alert-triangle" class="w-6 h-6 text-white"></i>
                    </div>
                    <div class="flex-1">
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($cukupCount) }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-300 font-medium">Cukup</div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Content Grid -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <!-- Nilai Table -->
            <div class="xl:col-span-2">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800/50 rounded-t-xl">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                <div class="bg-gradient-to-r from-amber-500 to-yellow-600 rounded-lg p-2 mr-3 shadow-lg">
                                    <i data-lucide="clipboard-list" class="w-5 h-5 text-white"></i>
                                </div>
                                Daftar Nilai
                            </h5>
                            <div class="relative">
                                <input type="text"
                                       id="searchNilaiSiswa"
                                       class="w-full sm:w-64 px-4 py-2 pl-10 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-amber-500 dark:focus:ring-amber-400 focus:border-amber-500 dark:focus:border-amber-400 transition-all duration-200 shadow-sm"
                                       placeholder=" Cari nilai...">
                                <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500"></i>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-hidden rounded-b-xl">
                        <div class="overflow-x-auto">
                            <table id="tableNilaiSiswa" class="w-full text-sm bg-white dark:bg-gray-800">
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
                                                <i data-lucide="tag" class="w-4 h-4 text-purple-500 dark:text-purple-400 mr-1"></i>
                                                Jenis
                                            </span>
                                        </th>
                                        <th class="px-4 py-3 text-center font-semibold text-gray-900 dark:text-white">
                                            <span class="flex items-center justify-center">
                                                <i data-lucide="target" class="w-4 h-4 text-red-500 dark:text-red-400 mr-1"></i>
                                                Nilai
                                            </span>
                                        </th>
                                        <th class="px-4 py-3 text-center font-semibold text-gray-900 dark:text-white">
                                            <span class="flex items-center justify-center">
                                                <i data-lucide="activity" class="w-4 h-4 text-indigo-500 dark:text-indigo-400 mr-1"></i>
                                                Status
                                            </span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-600 bg-white dark:bg-gray-800">
                                    @forelse($nilais as $index => $nilai)
                                    <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200">
                                        <td class="px-4 py-4 text-gray-900 dark:text-white font-medium">{{ $nilais->firstItem() + $index }}</td>
                                        <td class="px-4 py-4">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mr-3">
                                                    <i data-lucide="book-open" class="w-4 h-4 text-green-600 dark:text-green-400"></i>
                                                </div>
                                                <span class="font-semibold text-gray-900 dark:text-white">{{ $nilai->jadwal->mapel ?? '-' }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center mr-3">
                                                    <i data-lucide="user-check" class="w-4 h-4 text-orange-600 dark:text-orange-400"></i>
                                                </div>
                                                <span class="text-gray-900 dark:text-white font-medium">{{ $nilai->jadwal->guru->nama ?? '-' }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mr-3">
                                                    <i data-lucide="tag" class="w-4 h-4 text-purple-600 dark:text-purple-400"></i>
                                                </div>
                                                <div class="flex flex-col">
                                                    <span class="text-gray-900 dark:text-white font-medium">{{ $nilai->jenisPenilaian->nama ?? ucfirst($nilai->jenis) }}</span>
                                                    @if($nilai->jenisPenilaian)
                                                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $nilai->jenisPenilaian->bobot }}%</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 text-center">
                                            @php
                                                $nilaiColor = $nilai->nilai >= 85 ? 'bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-200 border-green-200 dark:border-green-800' :
                                                             ($nilai->nilai >= 75 ? 'bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200 border-blue-200 dark:border-blue-800' :
                                                             ($nilai->nilai >= 60 ? 'bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-200 border-yellow-200 dark:border-yellow-800' :
                                                             'bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-200 border-red-200 dark:border-red-800'));
                                            @endphp
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold border {{ $nilaiColor }}">
                                                <i data-lucide="target" class="w-4 h-4 mr-1"></i>
                                                {{ number_format($nilai->nilai, 1) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-4 text-center">
                                            @php
                                                $statusColor = $nilai->nilai >= 85 ? 'bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-200 border-green-200 dark:border-green-800' :
                                                              ($nilai->nilai >= 75 ? 'bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200 border-blue-200 dark:border-blue-800' :
                                                              ($nilai->nilai >= 60 ? 'bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-200 border-yellow-200 dark:border-yellow-800' :
                                                              'bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-200 border-red-200 dark:border-red-800'));
                                                $statusText = $nilai->nilai >= 85 ? 'Sangat Baik' :
                                                             ($nilai->nilai >= 75 ? 'Baik' :
                                                             ($nilai->nilai >= 60 ? 'Cukup' : 'Kurang'));
                                            @endphp
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold border {{ $statusColor }}">
                                                <i data-lucide="{{ $nilai->nilai >= 85 ? 'check-circle' : ($nilai->nilai >= 75 ? 'star' : ($nilai->nilai >= 60 ? 'alert-triangle' : 'x-circle')) }}" class="w-4 h-4 mr-1"></i>
                                                {{ $statusText }}
                                            </span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="bg-white dark:bg-gray-800">
                                        <td colspan="6" class="px-4 py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                                    <i data-lucide="star" class="w-8 h-8 text-gray-400 dark:text-gray-500"></i>
                                                </div>
                                                <p class="text-gray-500 dark:text-gray-400 font-medium">Belum ada nilai</p>
                                                <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Nilai akan muncul setelah guru menginput nilai untuk Anda</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if($nilais->hasPages())
                        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                            {{ $nilais->withQueryString()->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Information Sidebar -->
            <div class="xl:col-span-1">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800/50 rounded-t-xl">
                        <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg p-2 mr-3 shadow-lg">
                                <i data-lucide="info" class="w-5 h-5 text-white"></i>
                            </div>
                            Informasi
                        </h5>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                            <h6 class="font-semibold text-blue-800 dark:text-blue-200 mb-3 flex items-center">
                                <i data-lucide="settings" class="w-4 h-4 mr-2"></i>
                                Fitur Nilai Siswa
                            </h6>
                            <ul class="text-sm text-blue-700 dark:text-blue-300 space-y-1">
                                <li class="flex items-start">
                                    <i data-lucide="check" class="w-3 h-3 mr-2 mt-0.5 flex-shrink-0"></i>
                                    <span><strong>Daftar Nilai:</strong> Lihat semua nilai per mata pelajaran</span>
                                </li>
                                <li class="flex items-start">
                                    <i data-lucide="check" class="w-3 h-3 mr-2 mt-0.5 flex-shrink-0"></i>
                                    <span><strong>Transkrip:</strong> Lihat transkrip lengkap dengan rata-rata</span>
                                </li>
                                <li class="flex items-start">
                                    <i data-lucide="check" class="w-3 h-3 mr-2 mt-0.5 flex-shrink-0"></i>
                                    <span><strong>Nilai Akhir:</strong> Lihat nilai akhir per mata pelajaran</span>
                                </li>
                                <li class="flex items-start">
                                    <i data-lucide="check" class="w-3 h-3 mr-2 mt-0.5 flex-shrink-0"></i>
                                    <span><strong>Detail:</strong> Lihat detail perhitungan bobot nilai</span>
                                </li>
                            </ul>
                        </div>

                        <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                            <h6 class="font-semibold text-yellow-800 dark:text-yellow-200 mb-3 flex items-center">
                                <i data-lucide="target" class="w-4 h-4 mr-2"></i>
                                Kriteria Nilai
                            </h6>
                            <ul class="text-sm text-yellow-700 dark:text-yellow-300 space-y-1">
                                <li class="flex items-center">
                                    <i data-lucide="star" class="w-3 h-3 mr-2"></i>
                                    <span><strong>Sangat Baik (A):</strong> ≥ 85</span>
                                </li>
                                <li class="flex items-center">
                                    <i data-lucide="star" class="w-3 h-3 mr-2"></i>
                                    <span><strong>Baik (B):</strong> ≥ 75</span>
                                </li>
                                <li class="flex items-center">
                                    <i data-lucide="alert-triangle" class="w-3 h-3 mr-2"></i>
                                    <span><strong>Cukup (C):</strong> ≥ 60</span>
                                </li>
                                <li class="flex items-center">
                                    <i data-lucide="x-circle" class="w-3 h-3 mr-2"></i>
                                    <span><strong>Kurang (D):</strong> < 60</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/page.js') }}"></script>
@endsection