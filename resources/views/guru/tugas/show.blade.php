@extends('layouts.app')

@section('page_class', 'page-guru-tugas-detail')
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
                            <div class="bg-gradient-to-r from-blue-500 to-cyan-600 rounded-lg p-2 mr-3">
                                <i data-lucide="clipboard-check" class="w-6 h-6 text-white"></i>
                            </div>
                            Detail Submission Tugas
                        </h1>
                        <p class="text-gray-600 dark:text-gray-300 mt-1">Review dan berikan feedback untuk tugas siswa</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('guru.tugas.index') }}"
                           class="inline-flex items-center gap-2 px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <i data-lucide="arrow-left" class="w-4 h-4"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Submission Details -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800/50">
                        <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                            <div class="bg-gradient-to-r from-blue-500 to-cyan-600 rounded-lg p-2 mr-3 shadow-lg">
                                <i data-lucide="file-text" class="w-5 h-5 text-white"></i>
                            </div>
                            Detail Submission
                        </h5>
                    </div>

                    <div class="p-6 space-y-6">
                        <!-- Materi Info -->
                        <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4 border border-blue-200 dark:border-blue-800">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="book-open" class="w-5 h-5 text-blue-600 dark:text-blue-400"></i>
                                </div>
                                <div class="flex-1">
                                    <h6 class="font-semibold text-blue-900 dark:text-blue-100">Materi</h6>
                                    <p class="text-blue-800 dark:text-blue-200 font-medium">{{ $submission->materi->judul }}</p>
                                    @if($submission->materi->deskripsi)
                                        <p class="text-blue-700 dark:text-blue-300 text-sm mt-1">{{ Str::limit($submission->materi->deskripsi, 100) }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Siswa Info -->
                        <div class="bg-purple-50 dark:bg-purple-900/20 rounded-lg p-4 border border-purple-200 dark:border-purple-800">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="user" class="w-5 h-5 text-purple-600 dark:text-purple-400"></i>
                                </div>
                                <div class="flex-1">
                                    <h6 class="font-semibold text-purple-900 dark:text-purple-100">Siswa</h6>
                                    <p class="text-purple-800 dark:text-purple-200 font-medium">{{ $submission->siswa->nama }}</p>
                                    <p class="text-purple-700 dark:text-purple-300 text-sm">Kelas: {{ $submission->siswa->kelas->nama ?? '-' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Submission Info -->
                        <div class="bg-green-50 dark:bg-green-900/20 rounded-lg p-4 border border-green-200 dark:border-green-800">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="upload" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                                </div>
                                <div class="flex-1">
                                    <h6 class="font-semibold text-green-900 dark:text-green-100">Waktu Submission</h6>
                                    <p class="text-green-800 dark:text-green-200 font-medium">
                                        {{ $submission->submitted_at->format('l, d F Y \p\u\k\u\l H:i') }}
                                    </p>
                                    <p class="text-green-700 dark:text-green-300 text-sm">
                                        {{ $submission->submitted_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Link Tugas -->
                        <div class="bg-indigo-50 dark:bg-indigo-900/20 rounded-lg p-4 border border-indigo-200 dark:border-indigo-800">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="link" class="w-5 h-5 text-indigo-600 dark:text-indigo-400"></i>
                                </div>
                                <div class="flex-1">
                                    <h6 class="font-semibold text-indigo-900 dark:text-indigo-100">Link Tugas</h6>
                                    <a href="{{ $submission->link_tugas }}"
                                       target="_blank"
                                       class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors text-sm font-medium">
                                        <i data-lucide="external-link" class="w-4 h-4"></i>
                                        Buka Link Tugas
                                    </a>
                                    <p class="text-indigo-700 dark:text-indigo-300 text-sm mt-2 break-all">
                                        {{ $submission->link_tugas }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Catatan Siswa -->
                        @if($submission->catatan)
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 rounded-lg p-4 border border-yellow-200 dark:border-yellow-800">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="message-square" class="w-5 h-5 text-yellow-600 dark:text-yellow-400"></i>
                                </div>
                                <div class="flex-1">
                                    <h6 class="font-semibold text-yellow-900 dark:text-yellow-100">Catatan Siswa</h6>
                                    <p class="text-yellow-800 dark:text-yellow-200 mt-1">{{ $submission->catatan }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Status & Feedback -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800/50">
                        <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                            <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg p-2 mr-3 shadow-lg">
                                <i data-lucide="check-circle" class="w-5 h-5 text-white"></i>
                            </div>
                            Status & Feedback
                        </h5>
                    </div>

                    <div class="p-6">
                        <!-- Current Status -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Status Saat Ini
                            </label>
                            @php
                                $statusConfig = [
                                    'pending' => ['label' => 'Menunggu Review', 'color' => 'yellow'],
                                    'reviewed' => ['label' => 'Sedang Direview', 'color' => 'blue'],
                                    'approved' => ['label' => 'Disetujui', 'color' => 'green'],
                                    'rejected' => ['label' => 'Ditolak', 'color' => 'red'],
                                ];
                                $config = $statusConfig[$submission->status] ?? $statusConfig['pending'];
                            @endphp
                            <div class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-{{ $config['color'] }}-100 dark:bg-{{ $config['color'] }}-900/30 text-{{ $config['color'] }}-800 dark:text-{{ $config['color'] }}-200 font-medium">
                                <i data-lucide="circle" class="w-4 h-4 fill-current"></i>
                                {{ $config['label'] }}
                            </div>
                        </div>

                        <!-- Update Status Form -->
                        <form id="statusForm" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Ubah Status
                                </label>
                                <select name="status" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="pending" {{ $submission->status == 'pending' ? 'selected' : '' }}>Menunggu Review</option>
                                    <option value="reviewed" {{ $submission->status == 'reviewed' ? 'selected' : '' }}>Sedang Direview</option>
                                    <option value="approved" {{ $submission->status == 'approved' ? 'selected' : '' }}>Disetujui</option>
                                    <option value="rejected" {{ $submission->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Feedback (Opsional)
                                </label>
                                <textarea name="feedback" rows="4"
                                          class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none"
                                          placeholder="Berikan komentar atau feedback untuk siswa...">{{ $submission->feedback }}</textarea>
                            </div>

                            <button type="submit"
                                    class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center justify-center gap-2 font-medium">
                                <i data-lucide="save" class="w-4 h-4"></i>
                                Update Status & Feedback
                            </button>
                        </form>

                        <!-- Previous Feedback -->
                        @if($submission->feedback)
                        <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-600">
                            <h6 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Feedback Sebelumnya</h6>
                            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3">
                                <p class="text-gray-800 dark:text-gray-200 text-sm">{{ $submission->feedback }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800/50">
                        <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                            <div class="bg-gradient-to-r from-purple-500 to-pink-600 rounded-lg p-2 mr-3 shadow-lg">
                                <i data-lucide="zap" class="w-5 h-5 text-white"></i>
                            </div>
                            Aksi Cepat
                        </h5>
                    </div>

                    <div class="p-6 space-y-3">
                        <button onclick="quickUpdate('reviewed')"
                                class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center justify-center gap-2 text-sm font-medium">
                            <i data-lucide="eye" class="w-4 h-4"></i>
                            Tandai Sedang Direview
                        </button>

                        <button onclick="quickUpdate('approved')"
                                class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors flex items-center justify-center gap-2 text-sm font-medium">
                            <i data-lucide="check-circle" class="w-4 h-4"></i>
                            Setujui Tugas
                        </button>

                        <button onclick="quickUpdate('rejected')"
                                class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors flex items-center justify-center gap-2 text-sm font-medium">
                            <i data-lucide="x-circle" class="w-4 h-4"></i>
                            Tolak Tugas
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Handle status form submission
document.getElementById('statusForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch(window.location.href + '/status', {
        method: 'PATCH',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            location.reload();
        } else {
            alert('Error: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengupdate status');
    });
});

// Quick update functions
function quickUpdate(status) {
    const confirmMessage = status === 'approved' ? 'Apakah Anda yakin ingin menyetujui tugas ini?' :
                          status === 'rejected' ? 'Apakah Anda yakin ingin menolak tugas ini?' :
                          'Apakah Anda yakin ingin mengubah status menjadi "Sedang Direview"?';

    if (!confirm(confirmMessage)) {
        return;
    }

    const formData = new FormData();
    formData.append('status', status);
    formData.append('_token', '{{ csrf_token() }}');

    fetch(window.location.href + '/status', {
        method: 'PATCH',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            location.reload();
        } else {
            alert('Error: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengupdate status');
    });
}
</script>

@endsection