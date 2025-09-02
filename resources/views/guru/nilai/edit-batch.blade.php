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
                            <div class="bg-gradient-to-r from-orange-500 to-yellow-600 rounded-lg p-2 mr-3">
                                <i data-lucide="edit" class="w-6 h-6 text-white"></i>
                            </div>
                            Edit Nilai Batch
                        </h1>
                        <p class="text-gray-600 dark:text-gray-300 mt-1">Edit nilai siswa secara batch untuk efisiensi</p>
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

        <!-- Info Header -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl mb-6">
            <div class="bg-gradient-to-r from-orange-500 to-yellow-600 text-white px-6 py-4">
                <div class="flex items-center">
                    <i data-lucide="info" class="w-6 h-6 mr-3"></i>
                    <h5 class="text-lg font-bold">Informasi Edit Nilai</h5>
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                            <i data-lucide="school" class="w-5 h-5 text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Kelas</p>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $jadwal->kelas->nama }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                            <i data-lucide="book-open" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Mata Pelajaran</p>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $jadwal->mapel }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                            <i data-lucide="clipboard-list" class="w-5 h-5 text-purple-600 dark:text-purple-400"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Jenis Penilaian</p>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ ucfirst($jenisPenilaian->nama) }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center">
                            <i data-lucide="target" class="w-5 h-5 text-orange-600 dark:text-orange-400"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Bobot</p>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $jenisPenilaian->bobot }}%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Batch Edit Form -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl">
            <div class="bg-gradient-to-r from-orange-500 to-yellow-600 text-white px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i data-lucide="table" class="w-6 h-6 mr-3"></i>
                        <h5 class="text-lg font-bold">Tabel Edit Nilai Siswa</h5>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-white bg-opacity-20 text-white border border-white border-opacity-30">
                        <i data-lucide="users" class="w-4 h-4 mr-1"></i>
                        {{ $jadwal->kelas->siswas->count() }} Siswa
                    </span>
                </div>
            </div>
            <div class="p-0">
                <form action="{{ route('nilai.updateBatch') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
                    <input type="hidden" name="jenis_penilaian_id" value="{{ $jenisPenilaian->id }}">

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-100 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                                <tr>
                                    <th class="px-4 py-3 text-center font-semibold text-gray-900 dark:text-white w-16">
                                        <span class="flex items-center justify-center">
                                            <i data-lucide="hash" class="w-4 h-4 text-orange-500 dark:text-orange-400 mr-1"></i>
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
                                    <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                        <span class="flex items-center">
                                            <i data-lucide="target" class="w-4 h-4 text-orange-500 dark:text-orange-400 mr-1"></i>
                                            Nilai Saat Ini
                                        </span>
                                    </th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                        <span class="flex items-center">
                                            <i data-lucide="edit" class="w-4 h-4 text-purple-500 dark:text-purple-400 mr-1"></i>
                                            Edit Nilai
                                        </span>
                                    </th>
                                    <th class="px-4 py-3 text-center font-semibold text-gray-900 dark:text-white">
                                        <span class="flex items-center justify-center">
                                            <i data-lucide="info" class="w-4 h-4 text-red-500 dark:text-red-400 mr-1"></i>
                                            Status
                                        </span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-600 bg-white dark:bg-gray-800">
                                @forelse($jadwal->kelas->siswas as $index => $siswa)
                                    @php
                                        $existingNilai = $existingNilai->get($siswa->id);
                                        $currentNilai = $existingNilai ? $existingNilai->nilai : null;
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
                                        <td class="px-4 py-4">
                                            @if($currentNilai !== null)
                                                @php
                                                    $statusColor = $currentNilai >= 75 ? 'bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-200 border-green-200 dark:border-green-800' :
                                                                  ($currentNilai >= 60 ? 'bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-200 border-yellow-200 dark:border-yellow-800' :
                                                                  'bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-200 border-red-200 dark:border-red-800');
                                                @endphp
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $statusColor }}">
                                                    <i data-lucide="target" class="w-3 h-3 mr-1"></i>
                                                    {{ number_format($currentNilai, 1) }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 border border-gray-200 dark:border-gray-600">
                                                    <i data-lucide="minus" class="w-3 h-3 mr-1"></i>
                                                    Belum ada nilai
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4">
                                            @if($currentNilai !== null)
                                                <div class="space-y-2">
                                                    <div class="relative">
                                                        <input type="number"
                                                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all text-center font-semibold"
                                                            name="nilai[{{ $siswa->id }}]"
                                                            value="{{ $currentNilai }}"
                                                            min="0"
                                                            max="100"
                                                            step="0.1"
                                                            placeholder="0-100"
                                                            onchange="validateNilai(this)">
                                                        <div class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm">
                                                            / 100
                                                        </div>
                                                    </div>
                                                    <small class="text-gray-500 dark:text-gray-400 text-xs">
                                                        Range: 0.0 - 100.0
                                                    </small>
                                                </div>
                                            @else
                                                <span class="text-gray-500 dark:text-gray-400 text-sm italic">Tidak ada nilai untuk diedit</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4 text-center">
                                            @if($currentNilai !== null)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-orange-100 dark:bg-orange-900/50 text-orange-800 dark:text-orange-200 border border-orange-200 dark:border-orange-800">
                                                    <i data-lucide="edit" class="w-3 h-3 mr-1"></i>
                                                    Edit
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
                                        <td colspan="6" class="px-4 py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                                    <i data-lucide="users" class="w-8 h-8 text-gray-400 dark:text-gray-500"></i>
                                                </div>
                                                <p class="text-gray-500 dark:text-gray-400 font-medium">Tidak ada siswa dalam kelas ini</p>
                                                <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Belum ada siswa yang terdaftar di kelas ini</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($existingNilai->count() > 0)
                        <div class="bg-gray-50 dark:bg-gray-800/50 px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                                <div class="text-gray-600 dark:text-gray-300">
                                    <small class="flex items-center">
                                        <i data-lucide="info" class="w-4 h-4 mr-1"></i>
                                        Hanya nilai yang sudah ada yang dapat diedit
                                    </small>
                                </div>
                                <div class="flex gap-3">
                                    <button type="button" onclick="resetAllNilai()"
                                            class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-gray-500 to-gray-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium">
                                        <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                                        <span>Reset All</span>
                                    </button>
                                    <button type="submit"
                                            class="inline-flex items-center gap-2 px-6 py-2 bg-gradient-to-r from-orange-500 to-yellow-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium">
                                        <i data-lucide="save" class="w-4 h-4"></i>
                                        <span>Update Semua Nilai</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
        </div>

        <!-- Tips Section -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl mt-6">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-6 py-4">
                <div class="flex items-center">
                    <i data-lucide="lightbulb" class="w-6 h-6 mr-3"></i>
                    <h5 class="text-lg font-bold">Tips Edit Nilai</h5>
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-3">
                        <h6 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                            <i data-lucide="check-circle" class="w-5 h-5 mr-2 text-green-500"></i>
                            Validasi Nilai
                        </h6>
                        <ul class="space-y-2 text-gray-600 dark:text-gray-300">
                            <li class="flex items-center">
                                <i data-lucide="arrow-right" class="w-4 h-4 mr-2 text-blue-500"></i>
                                Range nilai: 0.0 - 100.0
                            </li>
                            <li class="flex items-center">
                                <i data-lucide="arrow-right" class="w-4 h-4 mr-2 text-blue-500"></i>
                                Bisa menggunakan desimal (contoh: 85.5)
                            </li>
                            <li class="flex items-center">
                                <i data-lucide="arrow-right" class="w-4 h-4 mr-2 text-blue-500"></i>
                                Hanya nilai yang sudah ada yang dapat diedit
                            </li>
                        </ul>
                    </div>
                    <div class="space-y-3">
                        <h6 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                            <i data-lucide="edit" class="w-5 h-5 mr-2 text-orange-500"></i>
                            Fitur Batch Edit
                        </h6>
                        <ul class="space-y-2 text-gray-600 dark:text-gray-300">
                            <li class="flex items-center">
                                <i data-lucide="arrow-right" class="w-4 h-4 mr-2 text-orange-500"></i>
                                Edit semua nilai sekaligus
                            </li>
                            <li class="flex items-center">
                                <i data-lucide="arrow-right" class="w-4 h-4 mr-2 text-orange-500"></i>
                                Update nilai yang sudah ada
                            </li>
                            <li class="flex items-center">
                                <i data-lucide="arrow-right" class="w-4 h-4 mr-2 text-orange-500"></i>
                                Validasi range nilai (0-100)
                            </li>
                            <li class="flex items-center">
                                <i data-lucide="arrow-right" class="w-4 h-4 mr-2 text-orange-500"></i>
                                Hanya untuk kelas yang diajar
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .nilai-input:focus {
        border-color: rgb(245 158 11);
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
    }

    .nilai-input.invalid {
        border-color: rgb(239 68 68);
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    }
</style>

<script>
    function validateNilai(input) {
        const value = parseFloat(input.value);
        const min = parseFloat(input.min);
        const max = parseFloat(input.max);

        if (input.value === '') {
            input.classList.remove('invalid');
            return true;
        }

        if (isNaN(value) || value < min || value > max) {
            input.classList.add('invalid');
            input.setCustomValidity('Nilai harus antara 0-100');
            return false;
        } else {
            input.classList.remove('invalid');
            input.setCustomValidity('');
            return true;
        }
    }

    function resetAllNilai() {
        if (confirm('Yakin ingin mereset semua nilai ke nilai asli?')) {
            // Reload the page to reset all values
            location.reload();
        }
    }

    // Form validation before submit
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                let isValid = true;
                const inputs = document.querySelectorAll('input[type="number"]');

                inputs.forEach(input => {
                    if (input.value !== '' && !validateNilai(input)) {
                        isValid = false;
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    alert('Mohon periksa input nilai yang tidak valid.');
                }
            });
        }
    });
</script>

<script src="{{ asset('js/page.js') }}"></script>
@endsection
