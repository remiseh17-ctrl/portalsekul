@extends('layouts.app')

@section('page_class', 'page-dashboard-siswa')
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
                                <i data-lucide="layout-dashboard" class="w-6 h-6 text-white"></i>
                            </div>
                            Dashboard Siswa
                        </h1>
                        <p class="text-gray-600 dark:text-gray-300 mt-1">Selamat datang di dashboard siswa</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="text-sm text-gray-500 dark:text-gray-300">
                            <i data-lucide="calendar" class="w-4 h-4 mr-1 inline"></i>
                            {{ now()->format('d F Y') }}
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('siswa.nilai.transkrip') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium">
                                <i data-lucide="file-text" class="w-5 h-5"></i>
                                <span>Transkrip Nilai</span>
                            </a>
                            <a href="{{ route('siswa.nilai.akhir') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium">
                                <i data-lucide="table" class="w-5 h-5"></i>
                                <span>Nilai Akhir</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <!-- Jadwal Pelajaran -->
            <div class="xl:col-span-2">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800/50 rounded-t-xl">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg p-2 mr-3 shadow-lg">
                                    <i data-lucide="calendar-check" class="w-5 h-5 text-white"></i>
                                </div>
                                Jadwal Mata Pelajaran Minggu Ini
                            </h5>
                            <div class="flex items-center gap-3">
                                <div class="relative">
                                    <input type="text"
                                           id="searchJadwalSiswa"
                                           class="w-full sm:w-64 px-4 py-2 pl-10 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-200 shadow-sm"
                                           placeholder=" Cari jadwal...">
                                    <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500"></i>
                                </div>
                                <a href="{{ route('siswa.jadwal') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium text-sm">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                    <span>Lihat Semua</span>
                                </a>
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
                                    @forelse($jadwalMingguan as $i => $jadwal)
                                    <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200">
                                        <td class="px-4 py-4 text-gray-900 dark:text-white font-medium">{{ $i+1 }}</td>
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
                                            @if($jadwal->materis && count($jadwal->materis))
                                                <div class="flex flex-col gap-1">
                                                    @foreach($jadwal->materis as $materi)
                                                        <a href="{{ asset('storage/'.$materi->file) }}"
                                                            class="inline-flex items-center gap-1 px-2 py-1 rounded-md text-xs font-semibold bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200 hover:bg-blue-200 dark:hover:bg-blue-800 border border-blue-200 dark:border-blue-800 transition-colors"
                                                            target="_blank"
                                                            title="{{ $materi->judul }}">
                                                            <i data-lucide="file-text" class="w-3 h-3"></i>
                                                            {{ Str::limit($materi->judul, 15) }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @else
                                                <span class="text-gray-400 dark:text-gray-500">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="bg-white dark:bg-gray-800">
                                        <td colspan="7" class="px-4 py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                                    <i data-lucide="calendar-x" class="w-8 h-8 text-gray-400 dark:text-gray-500"></i>
                                                </div>
                                                <p class="text-gray-500 dark:text-gray-400 font-medium">Tidak ada jadwal tersedia</p>
                                                <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Jadwal mata pelajaran akan muncul di sini</p>
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

            <!-- Pengumuman Terbaru -->
            <div class="xl:col-span-1">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800/50 rounded-t-xl">
                        <div class="flex flex-col gap-4">
                            <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                <div class="bg-gradient-to-r from-yellow-500 to-orange-600 rounded-lg p-2 mr-3 shadow-lg">
                                    <i data-lucide="megaphone" class="w-5 h-5 text-white"></i>
                                </div>
                                Pengumuman Terbaru
                            </h5>
                            <div class="flex items-center gap-3">
                                <div class="relative flex-1">
                                    <input type="text"
                                           id="searchPengumumanSiswa"
                                           class="w-full px-4 py-2 pl-10 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-yellow-500 dark:focus:ring-yellow-400 focus:border-yellow-500 dark:focus:border-yellow-400 transition-all duration-200 shadow-sm"
                                           placeholder=" Cari pengumuman...">
                                    <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500"></i>
                                </div>
                                <a href="{{ route('siswa.pengumuman') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-yellow-500 to-orange-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium text-sm">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                    <span>Lihat Semua</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="max-h-96 overflow-y-auto rounded-b-xl">
                        <div id="tablePengumumanSiswa" class="divide-y divide-gray-200 dark:divide-gray-600 bg-white dark:bg-gray-800">
                            @forelse($pengumumanTerbaru as $i => $pengumuman)
                            <div class="p-4 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200">
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-10 h-10 bg-gradient-to-r from-yellow-500 to-orange-600 rounded-full flex items-center justify-center text-white text-sm font-bold shadow-lg">
                                            <i data-lucide="bell" class="w-5 h-5"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-start justify-between mb-2">
                                            <h6 class="text-sm font-semibold text-gray-900 dark:text-white mb-1 line-clamp-2 leading-5 cursor-pointer" onclick="showPengumumanDetail('{{ $pengumuman->judul }}', '{{ addslashes($pengumuman->isi) }}', '{{ $pengumuman->tanggal }}')">
                                                {{ $pengumuman->judul }}
                                            </h6>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center text-xs text-gray-500 dark:text-gray-400 space-x-3">
                                                <span class="flex items-center bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded-full">
                                                    <i data-lucide="calendar-days" class="w-3 h-3 mr-1"></i>
                                                    {{ $pengumuman->tanggal }}
                                                </span>
                                            </div>
                                            <button class="inline-flex items-center gap-1 px-2 py-1 rounded-md text-xs font-semibold bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200 hover:bg-blue-200 dark:hover:bg-blue-800 border border-blue-200 dark:border-blue-800 transition-colors"
                                                    onclick="showPengumumanDetail('{{ $pengumuman->judul }}', '{{ addslashes($pengumuman->isi) }}', '{{ $pengumuman->tanggal }}')">
                                                <i data-lucide="eye" class="w-3 h-3"></i>
                                                Detail
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="p-8 text-center bg-white dark:bg-gray-800">
                                <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i data-lucide="megaphone" class="w-8 h-8 text-gray-400 dark:text-gray-500"></i>
                                </div>
                                <p class="text-gray-500 dark:text-gray-400 font-medium">Belum ada pengumuman terbaru</p>
                                <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Pengumuman dari guru akan muncul di sini</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Pengumuman -->
<div class="modal fade" id="pengumumanModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-white dark:bg-gray-800 rounded-xl shadow-lg border-0">
            <div class="modal-header border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 flex justify-between items-center">
                <h5 class="modal-title font-bold text-gray-900 dark:text-white flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    Detail Pengumuman
                </h5>
                <button type="button" class="text-gray-600 hover:text-red-500 transition" data-bs-dismiss="modal" aria-label="Tutup">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="modal-body p-6">
                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4" id="pengumumanModalTitle">Detail Pengumuman</h3>
                    <div class="flex items-center text-gray-600 dark:text-gray-300 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="font-medium" id="pengumumanModalDate"></span>
                    </div>
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                        <div class="prose dark:prose-invert max-w-none">
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-line" id="pengumumanModalContent">
                                <!-- Content will be populated by JavaScript -->
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer flex justify-end bg-gray-50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-700">
                <button type="button" class="btn btn-secondary rounded-lg px-4 py-2 flex items-center gap-2" data-bs-dismiss="modal">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function showPengumumanDetail(judul, isi, tanggal) {
    document.getElementById('pengumumanModalTitle').textContent = judul;
    document.getElementById('pengumumanModalDate').textContent = tanggal;
    document.getElementById('pengumumanModalContent').textContent = isi;
    new bootstrap.Modal(document.getElementById('pengumumanModal')).show();
}
</script>

<script src="{{ asset('js/page.js') }}"></script>
@endsection