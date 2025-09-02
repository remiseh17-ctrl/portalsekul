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
                            <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg p-2 mr-3">
                                <i data-lucide="table" class="w-6 h-6 text-white"></i>
                            </div>
                            Nilai Akhir Kelas - {{ $kelas->nama ?? 'Kelas' }}
                        </h1>
                        <p class="text-gray-600 dark:text-gray-300 mt-1">Laporan nilai akhir siswa per kelas</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('nilai.index') }}"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-gray-500 to-gray-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium">
                            <i data-lucide="arrow-left" class="w-5 h-5"></i>
                            <span>Kembali</span>
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

        <!-- Main Content Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl">
            <div class="p-6">
                <!-- Class Information -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                        <i data-lucide="info" class="w-6 h-6 mr-3 text-blue-500"></i>
                        Informasi Kelas
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                                    <i data-lucide="school" class="w-5 h-5 text-blue-600 dark:text-blue-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Nama Kelas</p>
                                    <p class="font-semibold text-gray-900 dark:text-white">{{ $kelas->nama ?? 'Tidak ada data' }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                                    <i data-lucide="user" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Wali Kelas</p>
                                    <p class="font-semibold text-gray-900 dark:text-white">{{ $kelas->waliKelas->nama ?? 'Tidak ada data' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                                    <i data-lucide="users" class="w-5 h-5 text-purple-600 dark:text-purple-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Jumlah Siswa</p>
                                    <p class="font-semibold text-gray-900 dark:text-white">{{ $siswas->count() }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center">
                                    <i data-lucide="book-open" class="w-5 h-5 text-orange-600 dark:text-orange-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Jumlah Mata Pelajaran</p>
                                    <p class="font-semibold text-gray-900 dark:text-white">{{ $jadwals->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Final Grades Table -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                        <i data-lucide="graduation-cap" class="w-6 h-6 mr-3 text-green-500"></i>
                        Nilai Akhir Siswa
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-100 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                                <tr>
                                    <th class="px-4 py-3 text-center font-semibold text-gray-900 dark:text-white w-16">
                                        <span class="flex items-center justify-center">
                                            <i data-lucide="hash" class="w-4 h-4 text-indigo-500 dark:text-indigo-400 mr-1"></i>
                                            No
                                        </span>
                                    </th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                        <span class="flex items-center">
                                            <i data-lucide="user" class="w-4 h-4 text-green-500 dark:text-green-400 mr-1"></i>
                                            Nama Siswa
                                        </span>
                                    </th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                        <span class="flex items-center">
                                            <i data-lucide="id-card" class="w-4 h-4 text-blue-500 dark:text-blue-400 mr-1"></i>
                                            NIS
                                        </span>
                                    </th>
                                    @foreach($jadwals as $jadwalId)
                                        <th class="px-4 py-3 text-center font-semibold text-gray-900 dark:text-white">
                                            <span class="flex items-center justify-center">
                                                <i data-lucide="book-open" class="w-4 h-4 text-purple-500 dark:text-purple-400 mr-1"></i>
                                                {{ \App\Models\Jadwal::find($jadwalId)->mapel ?? 'Mata Pelajaran' }}
                                            </span>
                                        </th>
                                    @endforeach
                                    <th class="px-4 py-3 text-center font-semibold text-gray-900 dark:text-white">
                                        <span class="flex items-center justify-center">
                                            <i data-lucide="target" class="w-4 h-4 text-orange-500 dark:text-orange-400 mr-1"></i>
                                            Rata-rata
                                        </span>
                                    </th>
                                    <th class="px-4 py-3 text-center font-semibold text-gray-900 dark:text-white">
                                        <span class="flex items-center justify-center">
                                            <i data-lucide="award" class="w-4 h-4 text-red-500 dark:text-red-400 mr-1"></i>
                                            Status
                                        </span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-600 bg-white dark:bg-gray-800">
                                @forelse($siswas as $index => $siswa)
                                    @php
                                        $totalNilai = 0;
                                        $jumlahNilai = 0;
                                    @endphp
                                    <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200">
                                        <td class="px-4 py-4 text-center text-gray-900 dark:text-white font-medium">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mr-3">
                                                    <i data-lucide="user-check" class="w-4 h-4 text-green-600 dark:text-green-400"></i>
                                                </div>
                                                <div class="flex flex-col">
                                                    <span class="font-semibold text-gray-900 dark:text-white">{{ $siswa->nama }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200 border border-blue-200 dark:border-blue-800">
                                                <i data-lucide="id-card" class="w-3 h-3 mr-1"></i>
                                                {{ $siswa->nis }}
                                            </span>
                                        </td>
                                        @foreach($jadwals as $jadwalId)
                                            @php
                                                $nilaiAkhir = $nilaiAkhir[$siswa->id][$jadwalId]['nilai_akhir'] ?? null;
                                                if ($nilaiAkhir !== null) {
                                                    $totalNilai += $nilaiAkhir;
                                                    $jumlahNilai++;
                                                }
                                            @endphp
                                            <td class="px-4 py-4 text-center">
                                                @if($nilaiAkhir !== null)
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-indigo-100 dark:bg-indigo-900/50 text-indigo-800 dark:text-indigo-200 border border-indigo-200 dark:border-indigo-800">
                                                        <i data-lucide="target" class="w-3 h-3 mr-1"></i>
                                                        {{ $nilaiAkhir }}
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 border border-gray-200 dark:border-gray-600">
                                                        <i data-lucide="minus" class="w-3 h-3 mr-1"></i>
                                                        -
                                                    </span>
                                                @endif
                                            </td>
                                        @endforeach
                                        @php
                                            $rataRata = $jumlahNilai > 0 ? round($totalNilai / $jumlahNilai, 2) : null;
                                        @endphp
                                        <td class="px-4 py-4 text-center">
                                            @if($rataRata !== null)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-orange-100 dark:bg-orange-900/50 text-orange-800 dark:text-orange-200 border border-orange-200 dark:border-orange-800">
                                                    <i data-lucide="target" class="w-3 h-3 mr-1"></i>
                                                    {{ $rataRata }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 border border-gray-200 dark:border-gray-600">
                                                    <i data-lucide="minus" class="w-3 h-3 mr-1"></i>
                                                    -
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4 text-center">
                                            @if($rataRata !== null)
                                                @php
                                                    $statusColor = $rataRata >= 85 ? 'bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-200 border-green-200 dark:border-green-800' :
                                                                  ($rataRata >= 75 ? 'bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200 border-blue-200 dark:border-blue-800' :
                                                                  ($rataRata >= 60 ? 'bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-200 border-yellow-200 dark:border-yellow-800' :
                                                                  'bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-200 border-red-200 dark:border-red-800'));
                                                    $statusText = $rataRata >= 85 ? 'Sangat Baik (A)' :
                                                                 ($rataRata >= 75 ? 'Baik (B)' :
                                                                 ($rataRata >= 60 ? 'Cukup (C)' : 'Kurang (D)'));
                                                @endphp
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $statusColor }}">
                                                    <i data-lucide="award" class="w-3 h-3 mr-1"></i>
                                                    {{ $statusText }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 border border-gray-200 dark:border-gray-600">
                                                    <i data-lucide="minus" class="w-3 h-3 mr-1"></i>
                                                    -
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-white dark:bg-gray-800">
                                        <td colspan="{{ 4 + $jadwals->count() }}" class="px-4 py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                                    <i data-lucide="users" class="w-8 h-8 text-gray-400 dark:text-gray-500"></i>
                                                </div>
                                                <p class="text-gray-500 dark:text-gray-400 font-medium">Belum ada data siswa</p>
                                                <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Belum ada siswa yang terdaftar di kelas ini</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Statistics -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                        <i data-lucide="bar-chart-3" class="w-6 h-6 mr-3 text-purple-500"></i>
                        Statistik Kelas
                    </h3>
                    @php
                        $totalSiswa = $siswas->count();
                        $siswaDenganNilai = 0;
                        $totalRataRata = 0;
                        $jumlahRataRata = 0;

                        foreach ($siswas as $siswa) {
                            $totalNilai = 0;
                            $jumlahNilai = 0;

                            foreach ($jadwals as $jadwalId) {
                                $nilaiAkhir = $nilaiAkhir[$siswa->id][$jadwalId]['nilai_akhir'] ?? null;
                                if ($nilaiAkhir !== null) {
                                    $totalNilai += $nilaiAkhir;
                                    $jumlahNilai++;
                                }
                            }

                            if ($jumlahNilai > 0) {
                                $siswaDenganNilai++;
                                $rataRata = $totalNilai / $jumlahNilai;
                                $totalRataRata += $rataRata;
                                $jumlahRataRata++;
                            }
                        }

                        $rataRataKelas = $jumlahRataRata > 0 ? round($totalRataRata / $jumlahRataRata, 2) : null;
                    @endphp

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Total Siswa -->
                        <div class="bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl p-6 text-white shadow-lg transform hover:-translate-y-1 hover:shadow-2xl transition-all duration-300">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-blue-100 text-sm font-medium">Total Siswa</p>
                                    <p class="text-3xl font-bold">{{ $totalSiswa }}</p>
                                </div>
                                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                                    <i data-lucide="users" class="w-6 h-6"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Siswa dengan Nilai -->
                        <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl p-6 text-white shadow-lg transform hover:-translate-y-1 hover:shadow-2xl transition-all duration-300">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-green-100 text-sm font-medium">Siswa dengan Nilai</p>
                                    <p class="text-3xl font-bold">{{ $siswaDenganNilai }}</p>
                                </div>
                                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                                    <i data-lucide="user-check" class="w-6 h-6"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Rata-rata Kelas -->
                        <div class="bg-gradient-to-br from-orange-500 to-yellow-600 rounded-xl p-6 text-white shadow-lg transform hover:-translate-y-1 hover:shadow-2xl transition-all duration-300">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-orange-100 text-sm font-medium">Rata-rata Kelas</p>
                                    <p class="text-3xl font-bold">{{ $rataRataKelas ?? '-' }}</p>
                                </div>
                                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                                    <i data-lucide="target" class="w-6 h-6"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Persentase Lengkap -->
                        <div class="bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl p-6 text-white shadow-lg transform hover:-translate-y-1 hover:shadow-2xl transition-all duration-300">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-purple-100 text-sm font-medium">Persentase Lengkap</p>
                                    <p class="text-3xl font-bold">{{ $totalSiswa > 0 ? round(($siswaDenganNilai / $totalSiswa) * 100, 1) : 0 }}%</p>
                                </div>
                                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                                    <i data-lucide="percent" class="w-6 h-6"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end gap-4">
                    <button onclick="printNilaiAkhir()"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium">
                        <i data-lucide="printer" class="w-5 h-5"></i>
                        <span>Cetak Nilai Akhir</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
        function printNilaiAkhir() {
            window.print();
        }
    </script>

    <script src="{{ asset('js/page.js') }}"></script>
@endsection
