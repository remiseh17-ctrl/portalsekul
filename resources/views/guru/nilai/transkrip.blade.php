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
                            <div class="bg-gradient-to-r from-cyan-500 to-blue-600 rounded-lg p-2 mr-3">
                                <i data-lucide="file-text" class="w-6 h-6 text-white"></i>
                            </div>
                            Transkrip Siswa
                        </h1>
                        <p class="text-gray-600 dark:text-gray-300 mt-1">Laporan nilai lengkap siswa per mata pelajaran</p>
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

        <!-- Main Content Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/20 border border-gray-200 dark:border-gray-700 overflow-hidden transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl">
            <div class="p-6">
                <!-- Student Information -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                        <i data-lucide="user" class="w-6 h-6 mr-3 text-blue-500"></i>
                        Informasi Siswa
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                                    <i data-lucide="user" class="w-5 h-5 text-blue-600 dark:text-blue-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Nama</p>
                                    <p class="font-semibold text-gray-900 dark:text-white">{{ $transkrip['siswa']->nama }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                                    <i data-lucide="id-card" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">NIS</p>
                                    <p class="font-semibold text-gray-900 dark:text-white">{{ $transkrip['siswa']->nis }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                                    <i data-lucide="school" class="w-5 h-5 text-purple-600 dark:text-purple-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Kelas</p>
                                    <p class="font-semibold text-gray-900 dark:text-white">{{ $transkrip['siswa']->kelas->nama ?? 'Tidak ada kelas' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center">
                                    <i data-lucide="target" class="w-5 h-5 text-orange-600 dark:text-orange-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Rata-rata Nilai</p>
                                    @if($transkrip['rata_rata'])
                                        <div class="flex items-center gap-2">
                                            <p class="font-semibold text-gray-900 dark:text-white">{{ $transkrip['rata_rata'] }}</p>
                                            @php
                                                $statusColor = $transkrip['rata_rata'] >= 85 ? 'bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-200 border-green-200 dark:border-green-800' :
                                                              ($transkrip['rata_rata'] >= 75 ? 'bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200 border-blue-200 dark:border-blue-800' :
                                                              ($transkrip['rata_rata'] >= 60 ? 'bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-200 border-yellow-200 dark:border-yellow-800' :
                                                              'bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-200 border-red-200 dark:border-red-800'));
                                            @endphp
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $statusColor }}">
                                                <i data-lucide="award" class="w-3 h-3 mr-1"></i>
                                                {{ $transkrip['status_rata_rata'] }}
                                            </span>
                                        </div>
                                    @else
                                        <p class="font-semibold text-gray-500 dark:text-gray-400">Belum ada nilai</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center">
                                    <i data-lucide="book-open" class="w-5 h-5 text-indigo-600 dark:text-indigo-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Jumlah Mata Pelajaran</p>
                                    <p class="font-semibold text-gray-900 dark:text-white">{{ $transkrip['jumlah_mata_pelajaran'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Transcript Table -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                        <i data-lucide="file-text" class="w-6 h-6 mr-3 text-cyan-500"></i>
                        Transkrip Nilai
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-100 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                        <span class="flex items-center">
                                            <i data-lucide="book-open" class="w-4 h-4 text-blue-500 dark:text-blue-400 mr-1"></i>
                                            Mata Pelajaran
                                        </span>
                                    </th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-900 dark:text-white">
                                        <span class="flex items-center">
                                            <i data-lucide="user" class="w-4 h-4 text-green-500 dark:text-green-400 mr-1"></i>
                                            Guru
                                        </span>
                                    </th>
                                    <th class="px-4 py-3 text-center font-semibold text-gray-900 dark:text-white">
                                        <span class="flex items-center justify-center">
                                            <i data-lucide="target" class="w-4 h-4 text-orange-500 dark:text-orange-400 mr-1"></i>
                                            Nilai Akhir
                                        </span>
                                    </th>
                                    <th class="px-4 py-3 text-center font-semibold text-gray-900 dark:text-white">
                                        <span class="flex items-center justify-center">
                                            <i data-lucide="award" class="w-4 h-4 text-red-500 dark:text-red-400 mr-1"></i>
                                            Status
                                        </span>
                                    </th>
                                    <th class="px-4 py-3 text-center font-semibold text-gray-900 dark:text-white">
                                        <span class="flex items-center justify-center">
                                            <i data-lucide="eye" class="w-4 h-4 text-purple-500 dark:text-purple-400 mr-1"></i>
                                            Detail
                                        </span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-600 bg-white dark:bg-gray-800">
                                @forelse($transkrip['transkrip'] as $nilai)
                                    <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200">
                                        <td class="px-4 py-4">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center mr-3">
                                                    <i data-lucide="book-open" class="w-4 h-4 text-blue-600 dark:text-blue-400"></i>
                                                </div>
                                                <div class="flex flex-col">
                                                    <span class="font-semibold text-gray-900 dark:text-white">{{ $nilai['mata_pelajaran'] }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mr-3">
                                                    <i data-lucide="user" class="w-4 h-4 text-green-600 dark:text-green-400"></i>
                                                </div>
                                                <div class="flex flex-col">
                                                    <span class="font-semibold text-gray-900 dark:text-white">{{ $nilai['guru'] }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 text-center">
                                            @if($nilai['nilai_akhir'])
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-indigo-100 dark:bg-indigo-900/50 text-indigo-800 dark:text-indigo-200 border border-indigo-200 dark:border-indigo-800">
                                                    <i data-lucide="target" class="w-3 h-3 mr-1"></i>
                                                    {{ $nilai['nilai_akhir'] }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 border border-gray-200 dark:border-gray-600">
                                                    <i data-lucide="minus" class="w-3 h-3 mr-1"></i>
                                                    -
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4 text-center">
                                            @if($nilai['nilai_akhir'])
                                                @php
                                                    $statusColor = $nilai['nilai_akhir'] >= 85 ? 'bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-200 border-green-200 dark:border-green-800' :
                                                                  ($nilai['nilai_akhir'] >= 75 ? 'bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200 border-blue-200 dark:border-blue-800' :
                                                                  ($nilai['nilai_akhir'] >= 60 ? 'bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-200 border-yellow-200 dark:border-yellow-800' :
                                                                  'bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-200 border-red-200 dark:border-red-800'));
                                                @endphp
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $statusColor }}">
                                                    <i data-lucide="award" class="w-3 h-3 mr-1"></i>
                                                    {{ $nilai['status'] }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 border border-gray-200 dark:border-gray-600">
                                                    <i data-lucide="minus" class="w-3 h-3 mr-1"></i>
                                                    -
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4 text-center">
                                            @if(!empty($nilai['nilai_detail']))
                                                <button onclick="showDetail({{ json_encode($nilai['nilai_detail']) }}, '{{ $nilai['mata_pelajaran'] }}')"
                                                        class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-purple-500 to-pink-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium text-sm">
                                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                                    <span>Lihat Detail</span>
                                                </button>
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
                                        <td colspan="5" class="px-4 py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                                    <i data-lucide="file-x" class="w-8 h-8 text-gray-400 dark:text-gray-500"></i>
                                                </div>
                                                <p class="text-gray-500 dark:text-gray-400 font-medium">Belum ada data nilai</p>
                                                <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Transkrip nilai akan muncul setelah ada nilai yang diinput</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between items-center">
                    <div class="text-gray-600 dark:text-gray-300">
                        <small class="flex items-center">
                            <i data-lucide="info" class="w-4 h-4 mr-1"></i>
                            Transkrip nilai lengkap siswa per mata pelajaran
                        </small>
                    </div>
                    <button onclick="printTranskrip()"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium">
                        <i data-lucide="printer" class="w-5 h-5"></i>
                        <span>Cetak Transkrip</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Detail Modal -->
    <div class="fixed inset-0 bg-black bg-opacity-50 hidden z-50" id="detailModal" style="display: none;">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-pink-600 text-white px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h5 class="text-lg font-bold flex items-center">
                            <i data-lucide="file-text" class="w-5 h-5 mr-2"></i>
                            <span id="modalTitle">Detail Nilai</span>
                        </h5>
                        <button type="button" onclick="closeModal()" class="text-white hover:text-gray-200 transition-colors">
                            <i data-lucide="x" class="w-6 h-6"></i>
                        </button>
                    </div>
                </div>
                <div class="p-6 overflow-y-auto max-h-96" id="modalContent">
                    <!-- Content will be populated by JavaScript -->
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-t border-gray-200 dark:border-gray-600">
                    <div class="flex justify-end">
                        <button type="button" onclick="closeModal()"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-gray-500 to-gray-600 text-white rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 font-medium">
                            <i data-lucide="x" class="w-4 h-4"></i>
                            <span>Tutup</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDetail(nilaiDetail, mataPelajaran) {
            const modalTitle = document.getElementById('modalTitle');
            const modalContent = document.getElementById('modalContent');
            const modal = document.getElementById('detailModal');

            modalTitle.textContent = `Detail Nilai - ${mataPelajaran}`;

            let content = '<div class="space-y-4">';
            nilaiDetail.forEach(detail => {
                const statusColor = detail.nilai >= 75 ? 'bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-200 border-green-200 dark:border-green-800' :
                                   (detail.nilai >= 60 ? 'bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-200 border-yellow-200 dark:border-yellow-800' :
                                   'bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-200 border-red-200 dark:border-red-800');
                const statusText = detail.nilai >= 75 ? 'Baik' :
                                  (detail.nilai >= 60 ? 'Cukup' : 'Kurang');

                content += `
                    <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                                <i data-lucide="clipboard-list" class="w-5 h-5 text-blue-600 dark:text-blue-400"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900 dark:text-white">${detail.jenis}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Bobot: ${detail.bobot}%</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold ${statusColor} mb-2">
                                <i data-lucide="target" class="w-3 h-3 mr-1"></i>
                                ${detail.nilai}
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">${statusText}</p>
                        </div>
                    </div>
                `;
            });
            content += '</div>';

            modalContent.innerHTML = content;
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('detailModal');
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        function printTranskrip() {
            window.print();
        }

        // Close modal when clicking outside
        document.getElementById('detailModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>

    <script src="{{ asset('js/page.js') }}"></script>
@endsection
