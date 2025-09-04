@extends('layouts.app')
@section('page_class', 'page-admin-tugas-guru-edit')
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
                                <i data-lucide="edit" class="w-6 h-6 text-white"></i>
                            </div>
                            Edit Tugas Guru
                        </h1>
                        <p class="text-gray-600 dark:text-gray-300 mt-1">Edit tugas yang sudah ada</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin-tugas-guru.show', ['admin_tugas_guru' => $tugas]) }}"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium">
                            <i data-lucide="eye" class="w-5 h-5"></i>
                            <span>Lihat Detail</span>
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

        <!-- Form Section -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800/50">
                <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                    <div class="bg-gradient-to-r from-yellow-500 to-orange-600 rounded-lg p-2 mr-3 shadow-lg">
                        <i data-lucide="edit-3" class="w-5 h-5 text-white"></i>
                    </div>
                    Form Edit Tugas Guru
                </h5>
            </div>

            <form action="{{ route('admin-tugas-guru.update', ['admin_tugas_guru' => $tugas]) }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Judul -->
                    <div class="md:col-span-2">
                        <label for="judul" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="clipboard-list" class="w-4 h-4 inline mr-2 text-blue-500"></i>
                            Judul Tugas *
                        </label>
                        <input type="text" id="judul" name="judul" value="{{ old('judul', $tugas->judul) }}" required
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-200"
                               placeholder="Masukkan judul tugas">
                        @error('judul')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deadline -->
                    <div>
                        <label for="deadline" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="calendar-days" class="w-4 h-4 inline mr-2 text-orange-500"></i>
                            Deadline
                        </label>
                        <input type="date" id="deadline" name="deadline" value="{{ old('deadline', $tugas->deadline ? $tugas->deadline->format('Y-m-d') : '') }}"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-200">
                        @error('deadline')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File -->
                    <div>
                        <label for="file" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="upload" class="w-4 h-4 inline mr-2 text-green-500"></i>
                            File Tugas
                        </label>
                        <input type="file" id="file" name="file"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900/20 dark:file:text-blue-300">
                        @if($tugas->file)
                            <div class="mt-2 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                                <p class="text-sm text-blue-700 dark:text-blue-300 mb-2">File saat ini:</p>
                                <div class="flex items-center gap-2">
                                    <i data-lucide="file" class="w-4 h-4 text-blue-600 dark:text-blue-400"></i>
                                    <span class="text-sm text-blue-800 dark:text-blue-200">{{ basename($tugas->file) }}</span>
                                    <a href="{{ route('admin-tugas-guru.download', ['admin_tugas_guru' => $tugas]) }}"
                                       class="inline-flex items-center gap-1 px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded text-xs hover:bg-blue-200 dark:hover:bg-blue-900/50 transition-colors duration-200">
                                        <i data-lucide="download" class="w-3 h-3"></i>
                                        Download
                                    </a>
                                </div>
                            </div>
                        @endif
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Format yang didukung: PDF, DOC, DOCX, PPT, PPTX, XLS, XLSX (Max: 10MB)
                        </p>
                        @error('file')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="mt-6">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i data-lucide="file-text" class="w-4 h-4 inline mr-2 text-indigo-500"></i>
                        Deskripsi Tugas
                    </label>
                    <textarea id="deskripsi" name="deskripsi" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-200"
                              placeholder="Masukkan deskripsi tugas (opsional)">{{ old('deskripsi', $tugas->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Link Drive -->
                <div class="mt-6">
                    <label for="link_drive" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i data-lucide="link" class="w-4 h-4 inline mr-2 text-green-500"></i>
                        Link Google Drive
                    </label>
                    <input type="url" id="link_drive" name="link_drive" value="{{ old('link_drive', $tugas->link_drive) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-200"
                           placeholder="https://drive.google.com/...">
                    @if($tugas->link_drive)
                        <div class="mt-2 p-3 bg-green-50 dark:bg-green-900/20 rounded-lg border border-green-200 dark:border-green-800">
                            <p class="text-sm text-green-700 dark:text-green-300 mb-2">Link saat ini:</p>
                            <a href="{{ $tugas->link_drive }}" target="_blank"
                               class="inline-flex items-center gap-2 px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-lg hover:bg-green-200 dark:hover:bg-green-900/50 transition-colors duration-200">
                                <i data-lucide="external-link" class="w-4 h-4"></i>
                                <span>Buka Link</span>
                            </a>
                        </div>
                    @endif
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Link Google Drive untuk file tugas (opsional)
                    </p>
                    @error('link_drive')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Info -->
                <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                    <div class="flex items-start">
                        <i data-lucide="info" class="w-5 h-5 text-blue-600 dark:text-blue-400 mr-3 mt-0.5"></i>
                        <div>
                            <h4 class="text-sm font-medium text-blue-800 dark:text-blue-200">Informasi</h4>
                            <p class="text-sm text-blue-700 dark:text-blue-300 mt-1">
                                Perubahan pada tugas ini akan mempengaruhi semua guru yang mengerjakan. 
                                File yang diupload akan menggantikan file yang lama.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-8 flex justify-end gap-3">
                    <a href="{{ route('admin-tugas-guru.show', ['admin_tugas_guru' => $tugas]) }}"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-gray-500 to-gray-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium">
                        <i data-lucide="x" class="w-5 h-5"></i>
                        <span>Batal</span>
                    </a>
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-yellow-500 to-orange-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium">
                        <i data-lucide="save" class="w-5 h-5"></i>
                        <span>Update Tugas</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/page.js') }}"></script>
@endsection 