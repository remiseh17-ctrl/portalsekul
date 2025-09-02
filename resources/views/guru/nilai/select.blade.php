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
                            <div class="bg-gradient-to-r from-yellow-500 to-orange-600 rounded-lg p-2 mr-3">
                                <i data-lucide="star" class="w-6 h-6 text-white"></i>
                            </div>
                            Pilih Jadwal & Jenis Penilaian
                        </h1>
                        <p class="text-gray-600 dark:text-gray-300 mt-1">Pilih jadwal mengajar dan jenis penilaian untuk input nilai batch</p>
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

        {{-- Error Notification --}}
        @if($errors->any())
        <div class="mb-6">
            <div class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-xl p-4 shadow-sm">
                <div class="flex items-center">
                    <div class="bg-red-100 dark:bg-red-900/50 rounded-lg p-2 mr-3">
                        <i data-lucide="alert-triangle" class="w-5 h-5 text-red-600 dark:text-red-400"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-red-800 dark:text-red-200">Terjadi kesalahan:</p>
                        <ul class="mt-2 list-disc list-inside text-red-700 dark:text-red-300 text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" class="ml-auto text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300" data-bs-dismiss="alert">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Form Section -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl">
                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-4">
                        <div class="flex items-center">
                            <i data-lucide="calendar-check" class="w-6 h-6 mr-3"></i>
                            <h5 class="text-lg font-bold">Input Nilai Batch</h5>
                        </div>
                    </div>
                    <div class="p-6">
                        <form action="{{ route('nilai.createBatch') }}" method="GET">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="jadwal_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                                        <i data-lucide="calendar" class="w-4 h-4 mr-2 text-indigo-500"></i>
                                        Pilih Jadwal
                                    </label>
                                    <select class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all" name="jadwal_id" id="jadwal_id" required>
                                        <option value="">Pilih Jadwal Mengajar</option>
                                        @foreach($jadwals as $jadwal)
                                            <option value="{{ $jadwal->id }}">
                                                {{ $jadwal->kelas->nama }} - {{ $jadwal->mapel }}
                                                ({{ $jadwal->hari }}: {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="jenis_penilaian_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                                        <i data-lucide="clipboard-list" class="w-4 h-4 mr-2 text-green-500"></i>
                                        Pilih Jenis Penilaian
                                    </label>
                                    <select class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all" name="jenis_penilaian_id" id="jenis_penilaian_id" required>
                                        <option value="">Pilih Jenis Penilaian</option>
                                        @foreach($jenisPenilaians as $jenis)
                                            <option value="{{ $jenis->id }}">
                                                {{ ucfirst($jenis->nama) }} (Bobot: {{ $jenis->bobot }}%)
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit"
                                        class="inline-flex items-center gap-2 px-8 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium">
                                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                                    <span>Lanjutkan ke Input Nilai</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Information Section -->
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl">
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-6 py-4">
                        <div class="flex items-center">
                            <i data-lucide="info" class="w-6 h-6 mr-3"></i>
                            <h5 class="text-lg font-bold">Informasi</h5>
                        </div>
                    </div>
                    <div class="p-6 space-y-6">
                        <!-- Cara Input -->
                        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                            <h6 class="text-lg font-semibold text-blue-900 dark:text-blue-100 mb-3 flex items-center">
                                <i data-lucide="list-ordered" class="w-5 h-5 mr-2"></i>
                                Cara Input Nilai Batch
                            </h6>
                            <ol class="space-y-2 text-blue-800 dark:text-blue-200 text-sm">
                                <li class="flex items-start">
                                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-blue-500 text-white text-xs font-bold mr-3 mt-0.5">1</span>
                                    Pilih jadwal mengajar yang sesuai
                                </li>
                                <li class="flex items-start">
                                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-blue-500 text-white text-xs font-bold mr-3 mt-0.5">2</span>
                                    Pilih jenis penilaian (Tugas, UTS, UAS)
                                </li>
                                <li class="flex items-start">
                                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-blue-500 text-white text-xs font-bold mr-3 mt-0.5">3</span>
                                    Sistem akan menampilkan semua siswa dalam kelas tersebut
                                </li>
                                <li class="flex items-start">
                                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-blue-500 text-white text-xs font-bold mr-3 mt-0.5">4</span>
                                    Input nilai untuk setiap siswa dalam satu tabel
                                </li>
                                <li class="flex items-start">
                                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-blue-500 text-white text-xs font-bold mr-3 mt-0.5">5</span>
                                    Gunakan <strong class="text-indigo-600 dark:text-indigo-400">updateOrCreate</strong> untuk efisiensi
                                </li>
                            </ol>
                        </div>

                        <!-- Fitur Batch Input -->
                        <div class="bg-orange-50 dark:bg-orange-900/20 border border-orange-200 dark:border-orange-800 rounded-lg p-4">
                            <h6 class="text-lg font-semibold text-orange-900 dark:text-orange-100 mb-3 flex items-center">
                                <i data-lucide="zap" class="w-5 h-5 mr-2"></i>
                                Fitur Batch Input
                            </h6>
                            <ul class="space-y-2 text-orange-800 dark:text-orange-200 text-sm">
                                <li class="flex items-center">
                                    <i data-lucide="check" class="w-4 h-4 mr-2 text-green-500"></i>
                                    Input semua nilai siswa sekaligus
                                </li>
                                <li class="flex items-center">
                                    <i data-lucide="check" class="w-4 h-4 mr-2 text-green-500"></i>
                                    Auto-update nilai yang sudah ada
                                </li>
                                <li class="flex items-center">
                                    <i data-lucide="check" class="w-4 h-4 mr-2 text-green-500"></i>
                                    Validasi range nilai (0-100)
                                </li>
                                <li class="flex items-center">
                                    <i data-lucide="check" class="w-4 h-4 mr-2 text-green-500"></i>
                                    Hanya untuk kelas yang diajar
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    select option {
        padding: 8px;
        line-height: 1.4;
    }

    select option small {
        color: rgb(108 117 125);
        font-size: 0.875em;
    }
</style>

<script src="{{ asset('js/page.js') }}"></script>
@endsection
