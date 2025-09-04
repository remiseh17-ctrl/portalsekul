@extends('layouts.app')
@section('page_class', 'page-admin-tugas-guru-show')
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
                            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg p-2 mr-3">
                                <i data-lucide="clipboard-list" class="w-6 h-6 text-white"></i>
                            </div>
                            Detail Tugas Guru
                        </h1>
                        <p class="text-gray-600 dark:text-gray-300 mt-1">Lihat detail tugas dan submission guru</p>
                        <div class="mt-2 flex items-center gap-4">
                            <div class="flex items-center gap-2 px-3 py-1 bg-green-100 dark:bg-green-900/30 rounded-full">
                                <i data-lucide="users" class="w-4 h-4 text-green-600 dark:text-green-400"></i>
                                <span class="text-sm font-medium text-green-700 dark:text-green-300">
                                    {{ $tugas->submissions->count() }} guru sudah mengumpulkan
                                </span>
                            </div>
                            @if($tugas->deadline)
                                <div class="flex items-center gap-2 px-3 py-1 {{ $tugas->is_overdue ? 'bg-red-100 dark:bg-red-900/30' : 'bg-blue-100 dark:bg-blue-900/30' }} rounded-full">
                                    <i data-lucide="calendar-days" class="w-4 h-4 {{ $tugas->is_overdue ? 'text-red-600 dark:text-red-400' : 'text-blue-600 dark:text-blue-400' }}"></i>
                                    <span class="text-sm font-medium {{ $tugas->is_overdue ? 'text-red-700 dark:text-red-300' : 'text-blue-700 dark:text-blue-300' }}">
                                        Deadline: {{ $tugas->deadline->format('d/m/Y') }}
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="#submissions"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium">
                            <i data-lucide="users" class="w-5 h-5"></i>
                            <span>Lihat Submission ({{ $tugas->submissions->count() }})</span>
                        </a>
                        <a href="{{ route('admin-tugas-guru.edit', ['admin_tugas_guru' => $tugas]) }}"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-yellow-500 to-orange-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium">
                            <i data-lucide="edit" class="w-5 h-5"></i>
                            <span>Edit Tugas</span>
                        </a>
                        <a href="{{ route('admin-tugas-guru.index') }}"
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
                                <a href="{{ route('admin-tugas-guru.download', ['admin_tugas_guru' => $tugas]) }}"
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

                        <!-- Updated At -->
                        @if($tugas->updated_at != $tugas->created_at)
                        <div class="mb-6">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Diperbarui:</span>
                                <span class="text-sm text-gray-900 dark:text-white">{{ $tugas->updated_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Submissions -->
            <div id="submissions" class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800/50">
                        <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                            <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg p-2 mr-3 shadow-lg">
                                <i data-lucide="users" class="w-5 h-5 text-white"></i>
                            </div>
                            Submission Guru
                            <span class="ml-3 px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-sm font-medium rounded-full">
                                {{ $tugas->submissions->count() }} guru
                            </span>
                        </h5>
                    </div>
                    
                    <div class="p-6">
                        @if($tugas->submissions->count() > 0)
                            <div class="space-y-4">
                                @foreach($tugas->submissions as $submission)
                                <div class="border border-gray-200 dark:border-gray-600 rounded-lg p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-3 mb-3">
                                                <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                                                    <i data-lucide="user" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                                                </div>
                                                <div>
                                                    <h4 class="font-semibold text-gray-900 dark:text-white">
                                                        {{ $submission->guru->nama ?? 'Guru' }}
                                                    </h4>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                                        Dikumpulkan: {{ $submission->submitted_at->format('d/m/Y H:i') }}
                                                    </p>
                                                </div>
                                            </div>
                                            
                                            @if($submission->komentar)
                                            <div class="mb-3">
                                                <p class="text-gray-700 dark:text-gray-300 text-sm">{{ $submission->komentar }}</p>
                                            </div>
                                            @endif

                                            <div class="flex items-center gap-3">
                                                @if($submission->file)
                                                <a href="{{ route('guru.kerjakan-tugas.download-submission', $submission) }}"
                                                   class="inline-flex items-center gap-2 px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-lg hover:bg-blue-200 dark:hover:bg-blue-900/50 transition-colors duration-200">
                                                    <i data-lucide="download" class="w-4 h-4"></i>
                                                    <span>Download File</span>
                                                </a>
                                                @endif
                                                
                                                @if($submission->link_drive)
                                                <a href="{{ $submission->link_drive }}" target="_blank"
                                                   class="inline-flex items-center gap-2 px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-lg hover:bg-green-200 dark:hover:bg-green-900/50 transition-colors duration-200">
                                                    <i data-lucide="external-link" class="w-4 h-4"></i>
                                                    <span>Link Drive</span>
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-center gap-2">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200">
                                                <i data-lucide="check-circle" class="w-3 h-3 mr-1"></i>
                                                Submitted
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i data-lucide="inbox" class="w-8 h-8 text-gray-400 dark:text-gray-500"></i>
                                </div>
                                <p class="text-gray-500 dark:text-gray-400 font-medium">Belum ada submission</p>
                                <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Guru belum mengumpulkan tugas ini</p>
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