@extends('layouts.app')

@section('page_class', 'page-guru-materi')
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
                            <div class="bg-gradient-to-r from-violet-500 to-purple-600 rounded-lg p-2 mr-3">
                                <i data-lucide="file-text" class="w-6 h-6 text-white"></i>
                            </div>
                            Manajemen Materi
                        </h1>
                        <p class="text-gray-600 dark:text-gray-300 mt-1">Kelola materi pembelajaran dan file ajar Anda</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="text-sm text-gray-500 dark:text-gray-300 hidden sm:flex items-center">
                            <i data-lucide="file-text" class="w-4 h-4 mr-1"></i>
                            {{ $materis->total() }} Materi
                        </div>
                        <a href="{{ route('guru.tugas.index') }}"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-500 to-cyan-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium">
                            <i data-lucide="clipboard-check" class="w-5 h-5"></i>
                            <span>Cek Tugas Siswa</span>
                        </a>
                        <button type="button"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-violet-500 to-purple-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium"
                                data-bs-toggle="modal" data-bs-target="#modalCreateMateri">
                            <i data-lucide="plus" class="w-5 h-5"></i>
                            <span>Upload Materi</span>
                        </button>
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

        <!-- Materi Table -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl">
            <!-- Header: Judul kiri, Search & Filter kanan -->
            <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800/50 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <!-- Judul kiri -->
                <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                    <div class="bg-gradient-to-r from-violet-500 to-purple-600 rounded-lg p-2 mr-3 shadow-lg">
                        <i data-lucide="table" class="w-5 h-5 text-white"></i>
                    </div>
                    Daftar Materi Pembelajaran
                </h5>
                <!-- Search & Filter kanan -->
                <div class="flex flex-col sm:flex-row gap-2 items-stretch sm:items-center">
                    <div class="relative">
                        <input type="text"
                            id="liveSearchInput"
                            class="w-[150px] md:w-[180px] pl-9 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-violet-500 dark:focus:ring-violet-400 focus:border-violet-500 dark:focus:border-violet-400 transition-all duration-200 shadow-sm"
                            placeholder="Cari materi..."
                            autocomplete="off">
                        <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                            <i data-lucide="search" class="w-4 h-4 text-gray-400 dark:text-gray-500"></i>
                        </div>
                        <div class="absolute inset-y-0 right-0 pr-2 flex items-center">
                            <button type="button" id="clearSearch" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hidden">
                                <i data-lucide="x" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Header -->

            <div class="overflow-x-auto">
                <table id="tableMateriGuru" class="w-full text-sm">
                    <thead class="bg-gray-100 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                        <tr>
                            <th class="px-4 py-3 text-center font-semibold text-gray-900 dark:text-white w-16">
                                <span class="flex items-center justify-center">
                                    <i data-lucide="hash" class="w-4 h-4 text-violet-500 dark:text-violet-400 mr-1"></i>
                                    No
                                </span>
                            </th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                <span class="flex items-center">
                                    <i data-lucide="file-text" class="w-4 h-4 text-green-500 dark:text-green-400 mr-1"></i>
                                    Judul
                                </span>
                            </th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                <span class="flex items-center">
                                    <i data-lucide="school" class="w-4 h-4 text-blue-500 dark:text-blue-400 mr-1"></i>
                                    Kelas Tujuan
                                </span>
                            </th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                <span class="flex items-center">
                                    <i data-lucide="download" class="w-4 h-4 text-indigo-500 dark:text-indigo-400 mr-1"></i>
                                    File/Link
                                </span>
                            </th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-900 dark:text-white">
                                <span class="flex items-center justify-center">
                                    <i data-lucide="settings" class="w-4 h-4 text-red-500 dark:text-red-400 mr-1"></i>
                                    Aksi
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-600 bg-white dark:bg-gray-800">
                        @forelse($materis as $index => $materi)
                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200">
                            <td class="px-4 py-4 text-center text-gray-900 dark:text-white font-medium">
                                {{ $materis->firstItem() + $index }}
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mr-3">
                                        <i data-lucide="file-text" class="w-4 h-4 text-green-600 dark:text-green-400"></i>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-semibold text-gray-900 dark:text-white">{{ $materi->judul }}</span>
                                        @if($materi->deskripsi)
                                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ Str::limit($materi->deskripsi, 50) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center mr-3">
                                        <i data-lucide="school" class="w-4 h-4 text-blue-600 dark:text-blue-400"></i>
                                    </div>
                                    <div class="flex flex-col">
                                        @php
                                            $allKelas = $materi->getAllKelas();
                                        @endphp
                                        @if($allKelas->count() > 0)
                                            @foreach($allKelas as $kelas)
                                                <span class="inline-block bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200 text-xs px-2 py-1 rounded-full mr-1 mb-1">
                                                    {{ $kelas->nama }}
                                                </span>
                                            @endforeach
                                        @else
                                            <span class="text-gray-500 dark:text-gray-400">-</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex flex-col gap-2">
                                    @if($materi->file)
                                        <a href="{{ Storage::url($materi->file) }}"
                                           class="inline-flex items-center gap-2 px-3 py-1 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium text-sm"
                                           target="_blank" title="Download File">
                                            <i data-lucide="download" class="w-4 h-4"></i>
                                            <span>Download File</span>
                                        </a>
                                    @endif
                                    @if($materi->link_drive)
                                        <a href="{{ $materi->link_drive }}"
                                           class="inline-flex items-center gap-2 px-3 py-1 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium text-sm"
                                           target="_blank" title="Buka Link Drive">
                                            <i data-lucide="external-link" class="w-4 h-4"></i>
                                            <span>Link Drive</span>
                                        </a>
                                    @endif
                                    @if(!$materi->file && !$materi->link_drive)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-gray-100 dark:bg-gray-900/50 text-gray-800 dark:text-gray-200 border border-gray-200 dark:border-gray-800">
                                            <i data-lucide="minus" class="w-3 h-3 mr-1"></i>
                                            Tidak ada file
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex justify-center gap-2">
                                    <button type="button"
                                       class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300"
                                       title="Lihat Detail" data-bs-toggle="modal" data-bs-target="#modalViewMateri{{ $materi->id }}">
                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                    </button>
                                    <button type="button"
                                       class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-r from-yellow-500 to-orange-600 text-white shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300"
                                       title="Edit Materi" data-bs-toggle="modal" data-bs-target="#modalEditMateri{{ $materi->id }}">
                                        <i data-lucide="pencil" class="w-4 h-4"></i>
                                    </button>
                                    <form action="{{ route('materi.destroy', $materi->id) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus materi ini?')" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-r from-red-500 to-red-600 text-white shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300"
                                                title="Hapus Materi" data-bs-toggle="tooltip">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="bg-white dark:bg-gray-800">
                            <td colspan="5" class="px-4 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                        <i data-lucide="file-x" class="w-8 h-8 text-gray-400 dark:text-gray-500"></i>
                                    </div>
                                    <p class="text-gray-500 dark:text-gray-400 font-medium">Belum ada materi</p>
                                    <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Mulai dengan mengupload materi pembelajaran</p>
                                    <button type="button" 
                                           class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-violet-500 to-purple-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium mt-4"
                                           data-bs-toggle="modal" data-bs-target="#modalCreateMateri">
                                        <i data-lucide="plus" class="w-5 h-5"></i>
                                        <span>Upload Materi Pertama</span>
                                    </button>
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

<script src="{{ asset('js/page.js') }}"></script>
<script>
document.body.classList.add('page-guru-materi');
</script>

{{-- Include Modal Create Materi --}}
@include('guru.materi.create-modal')

{{-- Include Modal Edit Materi --}}
@foreach($materis as $materi)
    @include('guru.materi.edit-modal', ['materi' => $materi, 'availableKelas' => $availableKelas])
@endforeach

{{-- Include Modal View Materi --}}
@foreach($materis as $materi)
    @include('guru.materi.view-modal', ['materi' => $materi])
@endforeach

@endsection