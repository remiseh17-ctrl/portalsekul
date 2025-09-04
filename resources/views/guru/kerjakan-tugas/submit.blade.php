@extends('layouts.app')
@section('page_class', 'page-guru-kerjakan-tugas-submit')
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
                                <i data-lucide="upload" class="w-6 h-6 text-white"></i>
                            </div>
                            Kumpulkan Tugas
                        </h1>
                        <p class="text-gray-600 dark:text-gray-300 mt-1">Upload hasil kerja tugas dari admin</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('guru.kerjakan-tugas.show', $tugas) }}"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium">
                            <i data-lucide="eye" class="w-5 h-5"></i>
                            <span>Lihat Detail</span>
                        </a>
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
            <!-- Task Info -->
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-blue-50 dark:bg-blue-900/20">
                        <h5 class="text-lg font-semibold text-blue-800 dark:text-blue-200 flex items-center">
                            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg p-2 mr-3 shadow-lg">
                                <i data-lucide="info" class="w-5 h-5 text-white"></i>
                            </div>
                            Informasi Tugas
                        </h5>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3">{{ $tugas->judul }}</h3>
                        
                        @if($tugas->deskripsi)
                        <div class="mb-4">
                            <p class="text-gray-600 dark:text-gray-300 text-sm">{{ $tugas->deskripsi }}</p>
                        </div>
                        @endif

                        @if($tugas->deadline)
                        <div class="mb-4 p-3 bg-orange-50 dark:bg-orange-900/20 rounded-lg border border-orange-200 dark:border-orange-800">
                            <div class="flex items-center gap-2">
                                <i data-lucide="calendar-days" class="w-4 h-4 text-orange-600 dark:text-orange-400"></i>
                                <span class="text-sm font-medium text-orange-800 dark:text-orange-200">Deadline:</span>
                            </div>
                            <p class="text-orange-700 dark:text-orange-300 text-sm mt-1">{{ $tugas->deadline->format('d/m/Y') }}</p>
                        </div>
                        @endif

                        @if($tugas->file)
                        <div class="mb-4 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                            <div class="flex items-center gap-2 mb-2">
                                <i data-lucide="file" class="w-4 h-4 text-blue-600 dark:text-blue-400"></i>
                                <span class="text-sm font-medium text-blue-800 dark:text-blue-200">File Tugas:</span>
                            </div>
                            <a href="{{ route('guru.kerjakan-tugas.download', $tugas) }}"
                               class="inline-flex items-center gap-2 px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-lg hover:bg-blue-200 dark:hover:bg-blue-900/50 transition-colors duration-200">
                                <i data-lucide="download" class="w-4 h-4"></i>
                                <span>Download File</span>
                            </a>
                        </div>
                        @endif

                        @if($tugas->link_drive)
                        <div class="mb-4 p-3 bg-green-50 dark:bg-green-900/20 rounded-lg border border-green-200 dark:border-green-800">
                            <div class="flex items-center gap-2 mb-2">
                                <i data-lucide="link" class="w-4 h-4 text-green-600 dark:text-green-400"></i>
                                <span class="text-sm font-medium text-green-800 dark:text-green-200">Link Drive:</span>
                            </div>
                            <a href="{{ $tugas->link_drive }}" target="_blank"
                               class="inline-flex items-center gap-2 px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-lg hover:bg-green-200 dark:hover:bg-green-900/50 transition-colors duration-200">
                                <i data-lucide="external-link" class="w-4 h-4"></i>
                                <span>Buka Link</span>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Submission Form -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-green-50 dark:bg-green-900/20">
                        <h5 class="text-lg font-semibold text-green-800 dark:text-green-200 flex items-center">
                            <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg p-2 mr-3 shadow-lg">
                                <i data-lucide="upload-cloud" class="w-5 h-5 text-white"></i>
                            </div>
                            Form Pengumpulan Tugas
                        </h5>
                    </div>

                    <form action="{{ route('guru.kerjakan-tugas.store', $tugas) }}" method="POST" enctype="multipart/form-data" class="p-6">
                        @csrf
                        
                        <!-- Komentar -->
                        <div class="mb-6">
                            <label for="komentar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                <i data-lucide="message-square" class="w-4 h-4 inline mr-2 text-indigo-500"></i>
                                Komentar (Opsional)
                            </label>
                            <textarea id="komentar" name="komentar" rows="4"
                                      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-200"
                                      placeholder="Tambahkan komentar atau catatan tentang tugas yang dikumpulkan">{{ old('komentar') }}</textarea>
                            @error('komentar')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- File Upload -->
                        <div class="mb-6">
                            <label for="file" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                <i data-lucide="upload" class="w-4 h-4 inline mr-2 text-blue-500"></i>
                                File Hasil Kerja *
                            </label>
                            <input type="file" id="file" name="file" required
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900/20 dark:file:text-blue-300">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Format yang didukung: PDF, DOC, DOCX, PPT, PPTX, XLS, XLSX, ZIP, RAR (Max: 10MB)
                            </p>
                            @error('file')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Link Drive -->
                        <div class="mb-6">
                            <label for="link_drive" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                <i data-lucide="link" class="w-4 h-4 inline mr-2 text-green-500"></i>
                                Link Google Drive (Opsional)
                            </label>
                            <input type="url" id="link_drive" name="link_drive" value="{{ old('link_drive') }}"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-200"
                                   placeholder="https://drive.google.com/...">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Link Google Drive untuk file hasil kerja (opsional)
                            </p>
                            @error('link_drive')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Info -->
                        <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                            <div class="flex items-start">
                                <i data-lucide="info" class="w-5 h-5 text-blue-600 dark:text-blue-400 mr-3 mt-0.5"></i>
                                <div>
                                    <h4 class="text-sm font-medium text-blue-800 dark:text-blue-200">Panduan Pengumpulan</h4>
                                    <ul class="text-sm text-blue-700 dark:text-blue-300 mt-1 space-y-1">
                                        <li>• Upload file hasil kerja dalam format yang didukung</li>
                                        <li>• Atau berikan link Google Drive jika file terlalu besar</li>
                                        <li>• Tambahkan komentar jika diperlukan</li>
                                        <li>• Setelah dikumpulkan, Anda masih bisa mengedit submission</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end gap-3">
                            <a href="{{ route('guru.kerjakan-tugas.show', $tugas) }}"
                               class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-gray-500 to-gray-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium">
                                <i data-lucide="x" class="w-5 h-5"></i>
                                <span>Batal</span>
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium">
                                <i data-lucide="upload" class="w-5 h-5"></i>
                                <span>Kumpulkan Tugas</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/page.js') }}"></script>
@endsection 