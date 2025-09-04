<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Siswa: ') . $siswa->nama }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold text-gray-900">Informasi Siswa</h3>
                        <a href="{{ route('siswa.index', ['kelas_id' => $siswa->kelas_id]) }}"
                           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Kembali ke Daftar Siswa
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Foto Siswa -->
                        <div class="md:col-span-2 flex justify-center mb-6">
                            @if($siswa->foto)
                                <img src="{{ asset('storage/'.$siswa->foto) }}"
                                     class="w-32 h-32 rounded-full border-4 border-gray-200 shadow-lg object-cover">
                            @else
                                <div class="w-32 h-32 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 rounded-full flex items-center justify-center border-4 border-gray-200 shadow-lg">
                                    <i data-lucide="user" class="w-16 h-16 text-gray-500 dark:text-gray-400"></i>
                                </div>
                            @endif
                        </div>

                        <!-- NIS -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">NIS</label>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $siswa->nis }}</p>
                        </div>

                        <!-- Nama -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Lengkap</label>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $siswa->nama }}</p>
                        </div>

                        <!-- Kelas -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kelas</label>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $siswa->kelas->nama ?? '-' }}</p>
                        </div>

                        <!-- Jurusan -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jurusan</label>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $siswa->jurusan ?? '-' }}</p>
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tanggal Lahir</label>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                @if($siswa->tanggal_lahir)
                                    {{ $siswa->tanggal_lahir->format('d F Y') }}
                                @else
                                    -
                                @endif
                            </p>
                        </div>

                        <!-- No HP -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">No. HP</label>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $siswa->no_hp ?? '-' }}</p>
                        </div>

                        <!-- Alamat -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Alamat</label>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $siswa->alamat ?? '-' }}</p>
                        </div>
                    </div>

                    <!-- User Account Info -->
                    @if($siswa->user)
                    <div class="mt-8">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Informasi Akun Login</h4>
                        <div class="bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 rounded-xl p-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-blue-700 dark:text-blue-300 mb-1">Username</label>
                                    <p class="text-lg font-semibold text-blue-900 dark:text-blue-100">{{ $siswa->user->username }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-blue-700 dark:text-blue-300 mb-1">Role</label>
                                    <p class="text-lg font-semibold text-blue-900 dark:text-blue-100">{{ ucfirst($siswa->user->role) }}</p>
                                </div>
                            </div>
                            <div class="mt-3 p-3 bg-blue-100 dark:bg-blue-900/50 rounded-lg">
                                <p class="text-sm text-blue-800 dark:text-blue-200">
                                    <strong>Password Awal:</strong> {{ date('Ymd', strtotime($siswa->tanggal_lahir)) }}
                                    <br><em class="text-xs">Format: Ymd (TahunBulanTanggal)</em>
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-end">
                        <a href="{{ route('siswa.edit', $siswa) }}"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                            <i data-lucide="pencil" class="w-4 h-4"></i>
                            Edit Siswa
                        </a>

                        <form action="{{ route('siswa.destroy', $siswa) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus siswa ini?')"
                              class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-red-500 hover:bg-red-700 text-white font-medium rounded-lg transition-colors">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                Hapus Siswa
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>