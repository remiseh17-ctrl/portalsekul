@extends('layouts.app')
@section('page_class', 'page-guru-kerjakan-tugas-show')
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
                                <i data-lucide="clipboard-list" class="w-6 h-6 text-white"></i>
                            </div>
                            Detail Tugas dari Admin
                        </h1>
                        <p class="text-gray-600 dark:text-gray-300 mt-1">Lihat detail tugas dan kumpulkan hasil kerja</p>
                    </div>
                    <div class="flex items-center gap-3">
                        @if(!$submission)
                            <a href="{{ route('guru.kerjakan-tugas.submit', $tugas) }}"
                               class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium">
                                <i data-lucide="upload" class="w-5 h-5"></i>
                                <span>Kumpulkan Tugas</span>
                            </a>
                        @else
                            <a href="{{ route('guru.kerjakan-tugas.edit', $tugas) }}"
                               class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-yellow-500 to-orange-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium">
                                <i data-lucide="edit" class="w-5 h-5"></i>
                                <span>Edit Submission</span>
                            </a>
                        @endif
                        <a href="{{ route('guru.kerjakan-tugas.index') }}"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-gray-500 to-gray-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium">
                            <i data-lucide="arrow-left" class="w-5 h-5"></i>
                            <span>Kembali</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Task Details -->
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800/50">
                        <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg p-2 mr-3 shadow-lg">
                                <i data-lucide="info" class="w-5 h-5 text-white"></i>
                            </div>
                            Informasi Tugas
                        </h5>
                    </div>
                    
                    <div class="p-6">
                        <!-- Judul -->
                        <div class="mb-6">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $tugas->judul }}</h3>
                            @if($tugas->deskripsi)
                                <p class="text-gray-600 dark:text-gray-300">{{ $tugas->deskripsi }}</p>
                            @endif
                        </div>

                        <!-- Status -->
                        <div class="mb-6">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Status:</span>
                                @php
                                    $statusColor = $tugas->status_color;
                                    $statusText = $tugas->status_text;
                                @endphp
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold 
                                    @if($statusColor === 'red') bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-200 border border-red-200 dark:border-red-800
                                    @elseif($statusColor === 'green') bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-200 border border-green-200 dark:border-green-800
                                    @else bg-gray-100 dark:bg-gray-900/50 text-gray-800 dark:text-gray-200 border border-gray-200 dark:border-gray-800
                                    @endif">
                                    <i data-lucide="circle" class="w-3 h-3 mr-1 
                                        @if($statusColor === 'red') text-red-600 dark:text-red-400
                                        @elseif($statusColor === 'green') text-green-600 dark:text-green-400
                                        @else text-gray-600 dark:text-gray-400
                                        @endif"></i>
                                    {{ $statusText }}
                                </span>
                            </div>
                        </div>

                        <!-- Deadline -->
                        @if($tugas->deadline)
                        <div class="mb-6">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Deadline:</span>
                                <span class="text-sm text-gray-900 dark:text-white font-medium">{{ $tugas->deadline->format('d/m/Y') }}</span>
                            </div>
                        </div>
                        @endif

                        <!-- File -->
                        @if($tugas->file)
                        <div class="mb-6">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">File Tugas:</span>
                                <a href="{{ route('guru.kerjakan-tugas.download', $tugas) }}"
                                   class="inline-flex items-center gap-2 px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-lg hover:bg-blue-200 dark:hover:bg-blue-900/50 transition-colors duration-200">
                                    <i data-lucide="download" class="w-4 h-4"></i>
                                    <span>Download</span>
                                </a>
                            </div>
                        </div>
                        @endif

                        <!-- Link Drive -->
                        @if($tugas->link_drive)
                        <div class="mb-6">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Link Drive:</span>
                                <a href="{{ $tugas->link_drive }}" target="_blank"
                                   class="inline-flex items-center gap-2 px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-lg hover:bg-green-200 dark:hover:bg-green-900/50 transition-colors duration-200">
                                    <i data-lucide="external-link" class="w-4 h-4"></i>
                                    <span>Buka</span>
                                </a>
                            </div>
                        </div>
                        @endif

                        <!-- Created At -->
                        <div class="mb-6">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Dibuat:</span>
                                <span class="text-sm text-gray-900 dark:text-white">{{ $tugas->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submission Status & Actions -->
            <div class="lg:col-span-2">
                @if($submission)
                    <!-- Already Submitted -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden">
                        <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-green-50 dark:bg-green-900/20">
                            <h5 class="text-lg font-semibold text-green-800 dark:text-green-200 flex items-center">
                                <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg p-2 mr-3 shadow-lg">
                                    <i data-lucide="check-circle" class="w-5 h-5 text-white"></i>
                                </div>
                                Tugas Sudah Dikumpulkan
                                <span class="ml-3 px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-sm font-medium rounded-full">
                                    Submitted
                                </span>
                            </h5>
                        </div>
                        
                        <div class="p-6">
                            <div class="mb-6">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                                        <i data-lucide="user-check" class="w-6 h-6 text-green-600 dark:text-green-400"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 dark:text-white">Submission Berhasil</h4>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            Dikumpulkan pada: {{ $submission->submitted_at->format('d/m/Y H:i') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            @if($submission->komentar)
                            <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                                <h5 class="text-sm font-medium text-blue-800 dark:text-blue-200 mb-2">Komentar:</h5>
                                <p class="text-blue-700 dark:text-blue-300">{{ $submission->komentar }}</p>
                            </div>
                            @endif

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                @if($submission->file)
                                <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                                    <h6 class="text-sm font-medium text-blue-800 dark:text-blue-200 mb-2">File Submission:</h6>
                                    <div class="flex items-center gap-2">
                                        <i data-lucide="file" class="w-4 h-4 text-blue-600 dark:text-blue-400"></i>
                                        <span class="text-sm text-blue-700 dark:text-blue-300">{{ basename($submission->file) }}</span>
                                        <a href="{{ route('guru.kerjakan-tugas.download-submission', $submission) }}"
                                           class="inline-flex items-center gap-1 px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded text-xs hover:bg-blue-200 dark:hover:bg-blue-900/50 transition-colors duration-200">
                                            <i data-lucide="download" class="w-3 h-3"></i>
                                            Download
                                        </a>
                                    </div>
                                </div>
                                @endif
                                
                                @if($submission->link_drive)
                                <div class="p-4 bg-green-50 dark:bg-green-900/20 rounded-lg border border-green-200 dark:border-green-800">
                                    <h6 class="text-sm font-medium text-green-800 dark:text-green-200 mb-2">Link Drive:</h6>
                                    <a href="{{ $submission->link_drive }}" target="_blank"
                                       class="inline-flex items-center gap-2 px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-lg hover:bg-green-200 dark:hover:bg-green-900/50 transition-colors duration-200">
                                        <i data-lucide="external-link" class="w-4 h-4"></i>
                                        <span>Buka Link</span>
                                    </a>
                                </div>
                                @endif
                            </div>

                            <div class="flex gap-3">
                                <a href="{{ route('guru.kerjakan-tugas.edit', $tugas) }}"
                                   class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-yellow-500 to-orange-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium">
                                    <i data-lucide="edit" class="w-5 h-5"></i>
                                    <span>Edit Submission</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Not Submitted Yet -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden">
                        <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-orange-50 dark:bg-orange-900/20">
                            <h5 class="text-lg font-semibold text-orange-800 dark:text-orange-200 flex items-center">
                                <div class="bg-gradient-to-r from-orange-500 to-red-600 rounded-lg p-2 mr-3 shadow-lg">
                                    <i data-lucide="clock" class="w-5 h-5 text-white"></i>
                                </div>
                                Belum Dikumpulkan
                                <span class="ml-3 px-2 py-1 bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-300 text-sm font-medium rounded-full">
                                    Pending
                                </span>
                            </h5>
                        </div>
                        
                        <div class="p-6">
                            <div class="text-center py-8">
                                <div class="w-16 h-16 bg-orange-100 dark:bg-orange-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i data-lucide="upload-cloud" class="w-8 h-8 text-orange-600 dark:text-orange-400"></i>
                                </div>
                                <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Siap Mengumpulkan Tugas?</h4>
                                <p class="text-gray-500 dark:text-gray-400 mb-6">
                                    Klik tombol di bawah untuk mengumpulkan hasil kerja Anda
                                </p>
                                <a href="{{ route('guru.kerjakan-tugas.submit', $tugas) }}"
                                   class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium">
                                    <i data-lucide="upload" class="w-5 h-5"></i>
                                    <span>Kumpulkan Tugas Sekarang</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/page.js') }}"></script>
@endsection 