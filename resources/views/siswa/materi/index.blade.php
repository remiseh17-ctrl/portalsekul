@extends('layouts.app')

@section('page_class', 'page-siswa-materi')
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
                            <div class="bg-gradient-to-r from-cyan-500 to-blue-600 rounded-lg p-2 mr-3">
                                <i data-lucide="file-text" class="w-6 h-6 text-white"></i>
                            </div>
                            Materi Pembelajaran
                        </h1>
                        <p class="text-gray-600 dark:text-gray-300 mt-1">Akses materi dan file pembelajaran Anda</p>
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-300">
                        <i data-lucide="calendar" class="w-4 h-4 mr-1 inline"></i>
                        {{ now()->format('d F Y') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Materi Table -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl">
            <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800/50 rounded-t-xl">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                        <div class="bg-gradient-to-r from-cyan-500 to-blue-600 rounded-lg p-2 mr-3 shadow-lg">
                            <i data-lucide="files" class="w-5 h-5 text-white"></i>
                        </div>
                        Daftar Materi
                    </h5>
                    <div class="relative">
                        <input type="text"
                               id="searchMateriSiswa"
                               class="w-full sm:w-64 px-4 py-2 pl-10 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-cyan-500 dark:focus:ring-cyan-400 focus:border-cyan-500 dark:focus:border-cyan-400 transition-all duration-200 shadow-sm"
                               placeholder=" Cari materi...">
                        <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500"></i>
                    </div>
                </div>
            </div>
            <div class="overflow-hidden rounded-b-xl">
                <div class="overflow-x-auto">
                    <table id="tableMateriSiswa" class="w-full text-sm bg-white dark:bg-gray-800">
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
                                        <i data-lucide="file-text" class="w-4 h-4 text-purple-500 dark:text-purple-400 mr-1"></i>
                                        Judul
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
                                        <i data-lucide="message-square" class="w-4 h-4 text-indigo-500 dark:text-indigo-400 mr-1"></i>
                                        Deskripsi
                                    </span>
                                </th>
                                <th class="px-4 py-3 text-center font-semibold text-gray-900 dark:text-white">
                                    <span class="flex items-center justify-center">
                                        <i data-lucide="download" class="w-4 h-4 text-teal-500 dark:text-teal-400 mr-1"></i>
                                        File/Link
                                    </span>
                                </th>
                                <th class="px-4 py-3 text-center font-semibold text-gray-900 dark:text-white">
                                    <span class="flex items-center justify-center">
                                        <i data-lucide="upload" class="w-4 h-4 text-purple-500 dark:text-purple-400 mr-1"></i>
                                        Tugas
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-600 bg-white dark:bg-gray-800">
                            @forelse($materis as $index => $materi)
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200">
                                <td class="px-4 py-4 text-gray-900 dark:text-white font-medium">{{ $materis->firstItem() + $index }}</td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mr-3">
                                            <i data-lucide="file-text" class="w-4 h-4 text-purple-600 dark:text-purple-400"></i>
                                        </div>
                                        <span class="font-semibold text-gray-900 dark:text-white">{{ $materi->judul }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center mr-3">
                                            <i data-lucide="user-check" class="w-4 h-4 text-orange-600 dark:text-orange-400"></i>
                                        </div>
                                        <span class="text-gray-900 dark:text-white font-medium">{{ $materi->guru->nama ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    @if($materi->deskripsi)
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center mr-3">
                                                <i data-lucide="message-square" class="w-4 h-4 text-indigo-600 dark:text-indigo-400"></i>
                                            </div>
                                            <span class="text-gray-900 dark:text-white">{{ Str::limit($materi->deskripsi, 50) }}</span>
                                        </div>
                                    @else
                                        <span class="text-gray-400 dark:text-gray-500">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <div class="flex flex-col gap-1">
                                        @if($materi->file)
                                            <a href="{{ Storage::url($materi->file) }}"
                                               class="inline-flex items-center gap-1 px-3 py-1 rounded-md text-xs font-semibold bg-teal-100 dark:bg-teal-900/50 text-teal-800 dark:text-teal-200 hover:bg-teal-200 dark:hover:bg-teal-800 border border-teal-200 dark:border-teal-800 transition-colors"
                                               target="_blank"
                                               title="Download File">
                                                <i data-lucide="download" class="w-3 h-3"></i>
                                                Download
                                            </a>
                                        @endif
                                        @if($materi->link_drive)
                                            <a href="{{ $materi->link_drive }}"
                                               class="inline-flex items-center gap-1 px-3 py-1 rounded-md text-xs font-semibold bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-200 hover:bg-green-200 dark:hover:bg-green-800 border border-green-200 dark:border-green-800 transition-colors"
                                               target="_blank"
                                               title="Buka Link Drive">
                                                <i data-lucide="external-link" class="w-3 h-3"></i>
                                                Link Drive
                                            </a>
                                        @endif
                                        @if(!$materi->file && !$materi->link_drive)
                                            <span class="text-gray-400 dark:text-gray-500 text-xs">Tidak ada file</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <button onclick="openTugasModal({{ $materi->id }}, '{{ $materi->judul }}')"
                                       class="inline-flex items-center gap-1 px-3 py-1 rounded-md text-xs font-semibold bg-purple-100 dark:bg-purple-900/50 text-purple-800 dark:text-purple-200 hover:bg-purple-200 dark:hover:bg-purple-800 border border-purple-200 dark:border-purple-800 transition-colors"
                                       title="Upload Tugas">
                                        <i data-lucide="upload" class="w-3 h-3"></i>
                                        Upload
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr class="bg-white dark:bg-gray-800">
                                <td colspan="6" class="px-4 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                            <i data-lucide="file-x" class="w-8 h-8 text-gray-400 dark:text-gray-500"></i>
                                        </div>
                                        <p class="text-gray-500 dark:text-gray-400 font-medium">Belum ada materi</p>
                                        <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Materi pembelajaran akan muncul setelah guru mengupload materi untuk kelas Anda</p>
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
</div>

<script src="{{ asset('js/page.js') }}"></script>

<!-- Modal Upload Tugas -->
<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" id="tugasModal" style="display: none;">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-md w-full mx-4">
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-4 rounded-t-2xl">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                        <i data-lucide="upload" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold">Upload Tugas</h3>
                        <p class="text-purple-100 text-sm" id="tugasJudul">Materi: ...</p>
                    </div>
                </div>
                <button onclick="closeTugasModal()" class="text-white hover:text-red-300 transition-colors">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>
        </div>

        <!-- Modal Body -->
        <div class="p-6">
            <form id="tugasForm" method="POST">
                @csrf
                <input type="hidden" name="materi_id" id="tugasMateriId">

                <div class="space-y-4">
                    <!-- Link Tugas -->
                    <div>
                        <label for="link_tugas" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Link Tugas <span class="text-red-500">*</span>
                        </label>
                        <input type="url" id="link_tugas" name="link_tugas"
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                               placeholder="https://drive.google.com/file/..." required>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            Masukkan link Google Drive, GitHub, atau platform lainnya
                        </p>
                    </div>

                    <!-- Catatan (Opsional) -->
                    <div>
                        <label for="catatan" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Catatan (Opsional)
                        </label>
                        <textarea id="catatan" name="catatan" rows="3"
                                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all resize-none bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                                  placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="bg-gray-50 dark:bg-gray-800/50 px-6 py-4 rounded-b-2xl flex justify-end space-x-3">
            <button onclick="closeTugasModal()"
                    class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                Batal
            </button>
            <button type="submit" form="tugasForm"
                    class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors flex items-center space-x-2">
                <i data-lucide="send" class="w-4 h-4"></i>
                <span>Submit Tugas</span>
            </button>
        </div>
    </div>
</div>

<script>
// Modal Tugas Functions
function openTugasModal(materiId, judul) {
    document.getElementById('tugasMateriId').value = materiId;
    document.getElementById('tugasJudul').textContent = 'Materi: ' + judul;
    document.getElementById('tugasModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeTugasModal() {
    document.getElementById('tugasModal').style.display = 'none';
    document.body.style.overflow = 'auto';
    // Reset form
    document.getElementById('tugasForm').reset();
}

// Handle form submission
document.getElementById('tugasForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('{{ route("siswa.submit-tugas") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Tugas berhasil diupload!');
            closeTugasModal();
        } else {
            alert('Terjadi kesalahan: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengupload tugas');
    });
});
</script>
@endsection