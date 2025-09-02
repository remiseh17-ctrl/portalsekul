@extends('layouts.app')

@section('page_class', 'page-guru-tugas')
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
                            Cek Tugas Siswa
                        </h1>
                        <p class="text-gray-600 dark:text-gray-300 mt-1">Pantau dan nilai tugas yang telah disubmit siswa</p>
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-300">
                        <i data-lucide="calendar" class="w-4 h-4 mr-1 inline"></i>
                        {{ now()->format('d F Y') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Submission</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['total'] }}</p>
                    </div>
                    <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                        <i data-lucide="file-text" class="w-5 h-5 text-blue-600 dark:text-blue-400"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Menunggu Review</p>
                        <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">{{ $stats['pending'] }}</p>
                    </div>
                    <div class="w-10 h-10 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg flex items-center justify-center">
                        <i data-lucide="clock" class="w-5 h-5 text-yellow-600 dark:text-yellow-400"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Sedang Direview</p>
                        <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $stats['reviewed'] }}</p>
                    </div>
                    <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                        <i data-lucide="eye" class="w-5 h-5 text-blue-600 dark:text-blue-400"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Disetujui</p>
                        <p class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $stats['approved'] }}</p>
                    </div>
                    <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                        <i data-lucide="check-circle" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Ditolak</p>
                        <p class="text-2xl font-bold text-red-600 dark:text-red-400">{{ $stats['rejected'] }}</p>
                    </div>
                    <div class="w-10 h-10 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center">
                        <i data-lucide="x-circle" class="w-5 h-5 text-red-600 dark:text-red-400"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden mb-6">
            <div class="p-6 border-b border-gray-200 dark:border-gray-600">
                <div class="flex flex-col lg:flex-row gap-4 items-start lg:items-center justify-between">
                    <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                        <div class="bg-gradient-to-r from-blue-500 to-cyan-600 rounded-lg p-2 mr-3 shadow-lg">
                            <i data-lucide="filter" class="w-5 h-5 text-white"></i>
                        </div>
                        Filter Submission
                    </h5>
                </div>
            </div>

            <div class="p-6">
                <form method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Filter Kelas -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Pilih Kelas
                        </label>
                        <select name="kelas_id" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua Kelas</option>
                            @foreach($kelas as $kelasItem)
                                <option value="{{ $kelasItem->id }}" {{ request('kelas_id') == $kelasItem->id ? 'selected' : '' }}>
                                    {{ $kelasItem->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filter Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Status
                        </label>
                        <select name="status" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Review</option>
                            <option value="reviewed" {{ request('status') == 'reviewed' ? 'selected' : '' }}>Sedang Direview</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-end gap-2">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2">
                            <i data-lucide="search" class="w-4 h-4"></i>
                            Filter
                        </button>
                        <a href="{{ route('guru.tugas.index') }}" class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors flex items-center gap-2">
                            <i data-lucide="x" class="w-4 h-4"></i>
                            Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Submissions Table -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="p-6 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-800/50 rounded-t-xl">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                        <div class="bg-gradient-to-r from-blue-500 to-cyan-600 rounded-lg p-2 mr-3 shadow-lg">
                            <i data-lucide="table" class="w-5 h-5 text-white"></i>
                        </div>
                        Daftar Submission Tugas
                    </h5>
                    <div class="text-sm text-gray-500 dark:text-gray-300">
                        Total: {{ $submissions->total() }} submission
                    </div>
                </div>
            </div>

            <div class="overflow-hidden rounded-b-xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm bg-white dark:bg-gray-800">
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
                                        <i data-lucide="user" class="w-4 h-4 text-purple-500 dark:text-purple-400 mr-1"></i>
                                        Siswa
                                    </span>
                                </th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                    <span class="flex items-center">
                                        <i data-lucide="file-text" class="w-4 h-4 text-green-500 dark:text-green-400 mr-1"></i>
                                        Materi & Kelas
                                    </span>
                                </th>
                                <th class="px-4 py-3 text-center font-semibold text-gray-900 dark:text-white">
                                    <span class="flex items-center justify-center">
                                        <i data-lucide="clock" class="w-4 h-4 text-orange-500 dark:text-orange-400 mr-1"></i>
                                        Waktu Submit
                                    </span>
                                </th>
                                <th class="px-4 py-3 text-center font-semibold text-gray-900 dark:text-white">
                                    <span class="flex items-center justify-center">
                                        <i data-lucide="tag" class="w-4 h-4 text-indigo-500 dark:text-indigo-400 mr-1"></i>
                                        Status
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
                            @forelse($submissions as $index => $submission)
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200">
                                <td class="px-4 py-4 text-gray-900 dark:text-white font-medium">
                                    {{ $submissions->firstItem() + $index }}
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mr-3">
                                            <i data-lucide="user" class="w-4 h-4 text-purple-600 dark:text-purple-400"></i>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="font-semibold text-gray-900 dark:text-white">{{ $submission->siswa->nama }}</span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $submission->siswa->kelas->nama ?? '-' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex flex-col">
                                        <div class="flex items-center mb-1">
                                            <div class="w-6 h-6 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mr-2">
                                                <i data-lucide="file-text" class="w-3 h-3 text-green-600 dark:text-green-400"></i>
                                            </div>
                                            <span class="font-medium text-gray-900 dark:text-white text-sm">{{ $submission->materi->judul }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <div class="w-6 h-6 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center mr-2">
                                                <i data-lucide="school" class="w-3 h-3 text-blue-600 dark:text-blue-400"></i>
                                            </div>
                                            <span class="text-xs text-gray-600 dark:text-gray-400">{{ $submission->siswa->kelas->nama ?? '-' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <div class="flex flex-col items-center">
                                        <span class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $submission->submitted_at->format('d/m/Y') }}
                                        </span>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $submission->submitted_at->format('H:i') }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    @php
                                        $statusConfig = [
                                            'pending' => ['label' => 'Menunggu Review', 'color' => 'yellow', 'icon' => 'clock'],
                                            'reviewed' => ['label' => 'Sedang Direview', 'color' => 'blue', 'icon' => 'eye'],
                                            'approved' => ['label' => 'Disetujui', 'color' => 'green', 'icon' => 'check-circle'],
                                            'rejected' => ['label' => 'Ditolak', 'color' => 'red', 'icon' => 'x-circle'],
                                        ];
                                        $config = $statusConfig[$submission->status] ?? $statusConfig['pending'];
                                    @endphp
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-semibold bg-{{ $config['color'] }}-100 dark:bg-{{ $config['color'] }}-900/30 text-{{ $config['color'] }}-800 dark:text-{{ $config['color'] }}-200">
                                        <i data-lucide="{{ $config['icon'] }}" class="w-3 h-3"></i>
                                        {{ $config['label'] }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('guru.tugas.show', $submission) }}"
                                           class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300"
                                           title="Lihat Detail">
                                            <i data-lucide="eye" class="w-4 h-4"></i>
                                        </a>
                                        <button onclick="updateStatus({{ $submission->id }}, 'reviewed')"
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-r from-green-500 to-green-600 text-white shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300"
                                                title="Tandai Sedang Direview">
                                            <i data-lucide="check" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr class="bg-white dark:bg-gray-800">
                                <td colspan="6" class="px-4 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                            <i data-lucide="file-x" class="w-8 h-8 text-gray-400 dark:text-gray-500"></i>
                                        </div>
                                        <p class="text-gray-500 dark:text-gray-400 font-medium">Belum ada submission tugas</p>
                                        <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">
                                            Submission tugas siswa akan muncul di sini setelah mereka mengupload tugas
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($submissions->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                    {{ $submissions->withQueryString()->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
// Quick status update function
function updateStatus(submissionId, status) {
    if (!confirm('Apakah Anda yakin ingin mengubah status submission ini?')) {
        return;
    }

    fetch(`{{ url('/guru/tugas') }}/${submissionId}/status`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            status: status
        })
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