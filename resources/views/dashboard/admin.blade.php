@extends('layouts.app')

@section('page_class', 'page-dashboard')
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
                                <i data-lucide="layout-dashboard" class="w-6 h-6 text-white"></i>
                            </div>
                            Dashboard Admin
                        </h1>
                        <p class="text-gray-600 dark:text-gray-300 mt-1">Selamat datang di panel administrasi sekolah</p>
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-300">
                        <i data-lucide="calendar" class="w-4 h-4 mr-1 inline"></i>
                        {{ now()->format('d F Y') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            @php
                $stats = [
                    [
                        'count' => $jumlahSiswa,
                        'label' => 'Siswa Terdaftar',
                        'icon' => 'users',
                        'gradient' => 'from-blue-500 to-blue-600',
                        'bg' => 'bg-blue-50 dark:bg-blue-900/20',
                        'iconColor' => 'text-blue-500 dark:text-blue-400',
                        'url' => route('siswa.index'),
                    ],
                    [
                        'count' => $jumlahGuru,
                        'label' => 'Guru Aktif',
                        'icon' => 'graduation-cap',
                        'gradient' => 'from-green-500 to-green-600',
                        'bg' => 'bg-green-50 dark:bg-green-900/20',
                        'iconColor' => 'text-green-500 dark:text-green-400',
                        'url' => route('guru.index'),
                    ],
                    [
                        'count' => $jumlahKelas,
                        'label' => 'Total Kelas',
                        'icon' => 'layers',
                        'gradient' => 'from-purple-500 to-purple-600',
                        'bg' => 'bg-purple-50 dark:bg-purple-900/20',
                        'iconColor' => 'text-purple-500 dark:text-purple-400',
                        'url' => route('kelas.index'),
                    ],
                    [
                        'count' => $jumlahMapel,
                        'label' => 'Mata Pelajaran',
                        'icon' => 'book-open',
                        'gradient' => 'from-orange-500 to-orange-600',
                        'bg' => 'bg-orange-50 dark:bg-orange-900/20',
                        'iconColor' => 'text-orange-500 dark:text-orange-400',
                        // Belum ada route mapel terpisah; arahkan ke guru.index sebagai referensi mapel
                        'url' => route('guru.index'),
                    ],
                ];
            @endphp
            @foreach($stats as $stat)
            <div class="stat-card bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 p-6 transition-transform duration-300 hover:shadow-2xl dark:hover:shadow-gray-900/50 hover:-translate-y-1 hover:scale-[1.01]">
                <div class="flex items-center">
                    <div class="bg-gradient-to-r {{ $stat['gradient'] }} rounded-xl p-3 mr-4 shadow-lg">
                        <i data-lucide="{{ $stat['icon'] }}" class="w-6 h-6 text-white"></i>
                    </div>
                    <div class="flex-1">
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($stat['count']) }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-300 font-medium">{{ $stat['label'] }}</div>
                    </div>
                </div>
                <div class="{{ $stat['bg'] }} rounded-lg mt-4 p-3 border border-gray-100 dark:border-gray-600">
                    <div class="flex items-center justify-between">
                        <a href="{{ $stat['url'] }}" class="inline-flex items-center gap-1 px-2 py-1 rounded-md text-xs font-semibold bg-white/70 dark:bg-gray-800/70 text-gray-700 dark:text-gray-200 hover:bg-white dark:hover:bg-gray-800 border border-gray-200 dark:border-gray-700 transition-colors">
                            <i data-lucide="trending-up" class="w-3 h-3 {{ $stat['iconColor'] }}"></i>
                            <span>Data terkini</span>
                        </a>
                        <i data-lucide="arrow-up-right" class="w-3 h-3 {{ $stat['iconColor'] }}"></i>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Quick Actions -->
        <div class="mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800/50">
                    <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg p-2 mr-3 shadow-lg">
                            <i data-lucide="zap" class="w-5 h-5 text-white"></i>
                        </div>
                        Quick Actions
                    </h5>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <a href="{{ route('admin-tugas-guru.index') }}" 
                           class="group p-4 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-green-200 dark:border-green-800 rounded-lg hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300">
                                    <i data-lucide="clipboard-list" class="w-6 h-6 text-white"></i>
                                </div>
                                <div>
                                    <h6 class="font-semibold text-green-800 dark:text-green-200 group-hover:text-green-900 dark:group-hover:text-green-100 transition-colors">
                                        Monitoring Tugas Guru
                                    </h6>
                                    <p class="text-sm text-green-600 dark:text-green-400">Kelola & monitor tugas guru</p>
                                </div>
                            </div>
                        </a>
                        
                        <a href="{{ route('guru.index') }}" 
                           class="group p-4 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border border-blue-200 dark:border-blue-800 rounded-lg hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300">
                                    <i data-lucide="graduation-cap" class="w-6 h-6 text-white"></i>
                                </div>
                                <div>
                                    <h6 class="font-semibold text-blue-800 dark:text-blue-200 group-hover:text-blue-900 dark:group-hover:text-blue-100 transition-colors">
                                        Manajemen Guru
                                    </h6>
                                    <p class="text-sm text-blue-600 dark:text-blue-400">Kelola data guru</p>
                                </div>
                            </div>
                        </a>
                        
                        <a href="{{ route('siswa.index') }}" 
                           class="group p-4 bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 border border-purple-200 dark:border-purple-800 rounded-lg hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-600 rounded-lg flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300">
                                    <i data-lucide="users" class="w-6 h-6 text-white"></i>
                                </div>
                                <div>
                                    <h6 class="font-semibold text-purple-800 dark:text-purple-200 group-hover:text-purple-900 dark:group-hover:text-purple-100 transition-colors">
                                        Manajemen Siswa
                                    </h6>
                                    <p class="text-sm text-purple-600 dark:text-purple-400">Kelola data siswa</p>
                                </div>
                            </div>
                        </a>
                        
                        <a href="{{ route('pengumuman.index') }}" 
                           class="group p-4 bg-gradient-to-r from-orange-50 to-red-50 dark:from-orange-900/20 dark:to-red-900/20 border border-orange-200 dark:border-orange-800 rounded-lg hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-600 rounded-lg flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300">
                                    <i data-lucide="megaphone" class="w-6 h-6 text-white"></i>
                                </div>
                                <div>
                                    <h6 class="font-semibold text-orange-800 dark:text-orange-200 group-hover:text-orange-900 dark:group-hover:text-orange-100 transition-colors">
                                        Pengumuman
                                    </h6>
                                    <p class="text-sm text-orange-600 dark:text-orange-400">Buat pengumuman</p>
                                </div>
                            </div>
                        </a>
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
                                Jadwal Pelajaran Hari Ini
                            </h5>
                            <div class="relative">
                                <input type="text" 
                                       id="searchJadwal" 
                                       class="w-full sm:w-64 px-4 py-2 pl-10 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-200 shadow-sm" 
                                       placeholder=" Cari jadwal...">
                                <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500"></i>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-hidden rounded-b-xl">
                        <div class="overflow-x-auto">
                            <table id="tableJadwal" class="w-full text-sm bg-white dark:bg-gray-800">
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
                                                <i data-lucide="home" class="w-4 h-4 text-purple-500 dark:text-purple-400 mr-1"></i>
                                                Kelas
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
                                                <i data-lucide="clock" class="w-4 h-4 text-red-500 dark:text-red-400 mr-1"></i>
                                                Waktu
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
                                    @forelse($jadwalHariIni as $i => $jadwal)
                                    <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200">
                                        <td class="px-4 py-4 text-gray-900 dark:text-white font-medium">{{ $i+1 }}</td>
                                        <td class="px-4 py-4">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mr-3">
                                                    <i data-lucide="door-open" class="w-4 h-4 text-purple-600 dark:text-purple-400"></i>
                                                </div>
                                                <span class="text-gray-900 dark:text-white font-medium">{{ $jadwal->kelas->nama ?? '-' }}</span>
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
                                                <div class="w-8 h-8 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center mr-3">
                                                    <i data-lucide="clock" class="w-4 h-4 text-red-600 dark:text-red-400"></i>
                                                </div>
                                                <span class="text-gray-900 dark:text-white font-mono text-sm">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 text-center">
                                            @if(now()->format('H:i') >= $jadwal->jam_mulai && now()->format('H:i') <= $jadwal->jam_selesai)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-200 border border-green-200 dark:border-green-800">
                                                    <i data-lucide="play-circle" class="w-3 h-3 mr-1"></i>
                                                    Berlangsung
                                                </span>
                                            @elseif(now()->format('H:i') > $jadwal->jam_selesai)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 border border-gray-200 dark:border-gray-600">
                                                    <i data-lucide="check-circle" class="w-3 h-3 mr-1"></i>
                                                    Selesai
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-200 border border-yellow-200 dark:border-yellow-800">
                                                    <i data-lucide="clock" class="w-3 h-3 mr-1"></i>
                                                    Belum Mulai
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="bg-white dark:bg-gray-800">
                                        <td colspan="6" class="px-4 py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                                    <i data-lucide="calendar-x" class="w-8 h-8 text-gray-400 dark:text-gray-500"></i>
                                                </div>
                                                <p class="text-gray-500 dark:text-gray-400 font-medium">Tidak ada jadwal hari ini</p>
                                                <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Silakan periksa jadwal untuk hari lain</p>
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
                            <div class="relative">
                                <input type="text" 
                                       id="searchPengumuman" 
                                       class="w-full px-4 py-2 pl-10 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-yellow-500 dark:focus:ring-yellow-400 focus:border-yellow-500 dark:focus:border-yellow-400 transition-all duration-200 shadow-sm" 
                                       placeholder=" Cari pengumuman...">
                                <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500"></i>
                            </div>
                        </div>
                    </div>
                    <div class="max-h-96 overflow-y-auto rounded-b-xl">
                        <div id="tablePengumuman" class="divide-y divide-gray-200 dark:divide-gray-600 bg-white dark:bg-gray-800">
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
                                            <h6 class="text-sm font-semibold text-gray-900 dark:text-white mb-1 line-clamp-2 leading-5">
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
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200 border border-blue-200 dark:border-blue-800">
                                                <i data-lucide="globe" class="w-3 h-3 mr-1"></i>
                                                Umum
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="p-8 text-center bg-white dark:bg-gray-800">
                                <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i data-lucide="megaphone" class="w-8 h-8 text-gray-400 dark:text-gray-500"></i>
                                </div>
                                <p class="text-gray-500 dark:text-gray-400 font-medium">Tidak ada pengumuman</p>
                                <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Pengumuman akan muncul di sini</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Search functionality for Jadwal
document.getElementById('searchJadwal').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll('#tableJadwal tbody tr');

    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        if (text.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Search functionality for Pengumuman
document.getElementById('searchPengumuman').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const items = document.querySelectorAll('#tablePengumuman > div');

    items.forEach(item => {
        const text = item.textContent.toLowerCase();
        if (text.includes(searchTerm)) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
});
</script>
@endsection