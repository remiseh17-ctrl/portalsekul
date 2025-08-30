@extends('layouts.app')

@section('page_class', 'page-dashboard-guru')
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
                                <i data-lucide="user-check" class="w-6 h-6 text-white"></i>
                            </div>
                            Dashboard Guru
                        </h1>
                        <p class="text-gray-600 dark:text-gray-300 mt-1">Ringkasan aktivitas dan informasi terkini</p>
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-300">
                        <i data-lucide="calendar" class="w-4 h-4 mr-1 inline"></i>
                        {{ now()->format('d F Y') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Jadwal Mengajar Hari Ini -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl">
                <!-- Header -->
                <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800/50 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg p-2 mr-3 shadow-lg">
                            <i data-lucide="calendar-days" class="w-5 h-5 text-white"></i>
                        </div>
                        Jadwal Mengajar Hari Ini
                    </h5>
                    <div class="relative w-full sm:w-auto">
                        <input type="text" id="searchJadwal" class="w-full sm:w-[200px] pl-9 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-200 shadow-sm text-sm"
                               placeholder="Cari jadwal...">
                        <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                            <i data-lucide="search" class="w-4 h-4 text-gray-400 dark:text-gray-500"></i>
                        </div>
                    </div>
                </div>
                <!-- Body -->
                <div class="p-0">
                    @if($jadwalHariIni->count())
                        <div class="divide-y divide-gray-200 dark:divide-gray-600" id="jadwalList">
                            @foreach($jadwalHariIni as $jadwal)
                                <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                        <div class="flex items-center gap-3 flex-1 min-w-0">
                                            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center flex-shrink-0">
                                                <i data-lucide="school" class="w-5 h-5 text-blue-600 dark:text-blue-400"></i>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="font-semibold text-gray-900 dark:text-white truncate">
                                                    {{ $jadwal->kelas->nama ?? '-' }}
                                                </div>
                                                <div class="text-sm text-gray-600 dark:text-gray-300 flex items-center gap-1">
                                                    <i data-lucide="book-open" class="w-3 h-3"></i>
                                                    {{ $jadwal->mapel }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2 text-blue-600 dark:text-blue-400 font-medium text-sm">
                                            <i data-lucide="clock" class="w-4 h-4"></i>
                                            <span>{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-8 text-center">
                            <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4 mx-auto">
                                <i data-lucide="calendar-x" class="w-8 h-8 text-gray-400 dark:text-gray-500"></i>
                            </div>
                            <p class="text-gray-500 dark:text-gray-400 font-medium">Tidak ada jadwal hari ini</p>
                            <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Semua jadwal mengajar telah selesai</p>
                        </div>
                    @endif
                </div>
            </div>
        
            <!-- Absensi Terbaru -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl">
                <!-- Header -->
                <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800/50 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                        <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg p-2 mr-3 shadow-lg">
                            <i data-lucide="clipboard-check" class="w-5 h-5 text-white"></i>
                        </div>
                        Absensi Terbaru
                    </h5>
                    <div class="relative w-full sm:w-auto">
                        <input type="text" id="searchAbsensi" class="w-full sm:w-[200px] pl-9 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:border-green-500 dark:focus:border-green-400 transition-all duration-200 shadow-sm text-sm"
                               placeholder="Cari absensi...">
                        <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                            <i data-lucide="search" class="w-4 h-4 text-gray-400 dark:text-gray-500"></i>
                        </div>
                    </div>
                </div>
                <!-- Body -->
                <div class="p-0">
                    @if($absensiTerbaru->count())
                        <div class="divide-y divide-gray-200 dark:divide-gray-600" id="absensiList">
                            @foreach($absensiTerbaru as $absensi)
                                <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                        <div class="flex items-center gap-3 flex-1 min-w-0">
                                            <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center flex-shrink-0">
                                                <i data-lucide="user-check" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="font-semibold text-gray-900 dark:text-white truncate">
                                                    {{ $absensi->siswa->nama ?? '-' }}
                                                </div>
                                                <div class="text-sm text-gray-600 dark:text-gray-300 flex items-center gap-1">
                                                    <i data-lucide="school" class="w-3 h-3"></i>
                                                    {{ $absensi->jadwal->kelas->nama ?? '-' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex flex-col items-end gap-1">
                                            @php
                                                $statusColor = $absensi->status == 'Hadir' ? 'bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-200 border-green-200 dark:border-green-800' :
                                                              ($absensi->status == 'Sakit' ? 'bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-200 border-yellow-200 dark:border-yellow-800' :
                                                              ($absensi->status == 'Izin' ? 'bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200 border-blue-200 dark:border-blue-800' :
                                                              'bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-200 border-red-200 dark:border-red-800'));
                                            @endphp
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $statusColor }}">
                                                <i data-lucide="circle" class="w-2 h-2 mr-1"></i>
                                                {{ $absensi->status }}
                                            </span>
                                            <div class="text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1">
                                                <i data-lucide="calendar" class="w-3 h-3"></i>
                                                {{ $absensi->tanggal->format('d/m/Y') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-8 text-center">
                            <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4 mx-auto">
                                <i data-lucide="clipboard-x" class="w-8 h-8 text-gray-400 dark:text-gray-500"></i>
                            </div>
                            <p class="text-gray-500 dark:text-gray-400 font-medium">Belum ada absensi terbaru</p>
                            <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Absensi siswa akan muncul di sini</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    
        <!-- Nilai Terbaru -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl mb-8">
            <!-- Header -->
            <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800/50 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                    <div class="bg-gradient-to-r from-yellow-500 to-orange-600 rounded-lg p-2 mr-3 shadow-lg">
                        <i data-lucide="star" class="w-5 h-5 text-white"></i>
                    </div>
                    Nilai Terbaru
                </h5>
                <div class="relative w-full sm:w-auto">
                    <input type="text" id="searchNilai" class="w-full sm:w-[200px] pl-9 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-yellow-500 dark:focus:ring-yellow-400 focus:border-yellow-500 dark:focus:border-yellow-400 transition-all duration-200 shadow-sm text-sm"
                           placeholder="Cari nilai...">
                    <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                        <i data-lucide="search" class="w-4 h-4 text-gray-400 dark:text-gray-500"></i>
                    </div>
                </div>
            </div>
            <!-- Body -->
            <div class="overflow-x-auto">
                @if($nilaiTerbaru->count())
                    <table class="w-full text-sm" id="nilaiTable">
                        <thead class="bg-gray-100 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                    <span class="flex items-center">
                                        <i data-lucide="user" class="w-4 h-4 text-green-500 dark:text-green-400 mr-1"></i>
                                        Siswa
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
                                        <i data-lucide="file-text" class="w-4 h-4 text-purple-500 dark:text-purple-400 mr-1"></i>
                                        Jenis
                                    </span>
                                </th>
                                <th class="px-4 py-3 text-center font-semibold text-gray-900 dark:text-white">
                                    <span class="flex items-center justify-center">
                                        <i data-lucide="target" class="w-4 h-4 text-orange-500 dark:text-orange-400 mr-1"></i>
                                        Nilai
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-600 bg-white dark:bg-gray-800">
                            @foreach($nilaiTerbaru as $nilai)
                                <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200">
                                    <td class="px-4 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                                                <i data-lucide="user-check" class="w-4 h-4 text-green-600 dark:text-green-400"></i>
                                            </div>
                                            <span class="font-semibold text-gray-900 dark:text-white">{{ $nilai->siswa->nama ?? '-' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                                                <i data-lucide="school" class="w-4 h-4 text-blue-600 dark:text-blue-400"></i>
                                            </div>
                                            <span class="text-gray-900 dark:text-white font-medium">{{ $nilai->jadwal->kelas->nama ?? '-' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-purple-100 dark:bg-purple-900/50 text-purple-800 dark:text-purple-200 border border-purple-200 dark:border-purple-800">
                                            <i data-lucide="file-text" class="w-3 h-3 mr-1"></i>
                                            {{ ucfirst($nilai->jenis) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        @php
                                            $nilaiColor = $nilai->nilai >= 85 ? 'bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-200 border-green-200 dark:border-green-800' :
                                                         ($nilai->nilai >= 75 ? 'bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200 border-blue-200 dark:border-blue-800' :
                                                         ($nilai->nilai >= 60 ? 'bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-200 border-yellow-200 dark:border-yellow-800' :
                                                         'bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-200 border-red-200 dark:border-red-800'));
                                        @endphp
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold {{ $nilaiColor }}">
                                            <i data-lucide="target" class="w-3 h-3 mr-1"></i>
                                            {{ $nilai->nilai }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="p-8 text-center">
                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4 mx-auto">
                            <i data-lucide="star" class="w-8 h-8 text-gray-400 dark:text-gray-500"></i>
                        </div>
                        <p class="text-gray-500 dark:text-gray-400 font-medium">Belum ada nilai terbaru</p>
                        <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Nilai siswa akan muncul di sini setelah diinput</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Pengumuman Admin Terbaru -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl">
            <!-- Header -->
            <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800/50">
                <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg p-2 mr-3 shadow-lg">
                        <i data-lucide="megaphone" class="w-5 h-5 text-white"></i>
                    </div>
                    Pengumuman Admin Terbaru
                </h5>
            </div>
            <!-- Body -->
            <div class="p-0">
                @if($pengumumanAdminTerbaru->count())
                    <div class="divide-y divide-gray-200 dark:divide-gray-600">
                        @foreach($pengumumanAdminTerbaru as $p)
                            <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                    <div class="flex items-center gap-3 flex-1 min-w-0">
                                        <div class="w-10 h-10 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <i data-lucide="info" class="w-5 h-5 text-indigo-600 dark:text-indigo-400"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="font-semibold text-gray-900 dark:text-white truncate">
                                                {{ $p->judul }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2 text-gray-500 dark:text-gray-400 text-sm">
                                        <i data-lucide="calendar" class="w-4 h-4"></i>
                                        <span>{{ $p->tanggal?->format('d/m/Y') ?? $p->tanggal }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-8 text-center">
                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4 mx-auto">
                            <i data-lucide="megaphone" class="w-8 h-8 text-gray-400 dark:text-gray-500"></i>
                        </div>
                        <p class="text-gray-500 dark:text-gray-400 font-medium">Belum ada pengumuman admin</p>
                        <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Pengumuman dari admin akan muncul di sini</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/page.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter Jadwal
    const searchJadwal = document.getElementById('searchJadwal');
    if (searchJadwal) {
        searchJadwal.addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            document.querySelectorAll('#jadwalList > div').forEach(function(item) {
                const text = item.textContent.toLowerCase();
                item.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    }

    // Filter Absensi
    const searchAbsensi = document.getElementById('searchAbsensi');
    if (searchAbsensi) {
        searchAbsensi.addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            document.querySelectorAll('#absensiList > div').forEach(function(item) {
                const text = item.textContent.toLowerCase();
                item.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    }

    // Filter Nilai
    const searchNilai = document.getElementById('searchNilai');
    if (searchNilai) {
        searchNilai.addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            document.querySelectorAll('#nilaiTable tbody tr').forEach(function(row) {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    }
});
</script>
@endsection
