<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>LMS SMA MUSLIMIN</title>
        
        <!-- Keep Bootstrap temporarily to avoid breaking existing Bootstrap-based pages during transition -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link tailwindcss href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.2/dist/tailwind.min.css" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
        @stack('styles')
    </head>
    <body class="min-h-screen bg-gray-50 text-gray-900 antialiased dark:bg-gray-900 dark:text-gray-100 @yield('page_class')">
        <!-- Global Top Navbar -->
        @include('layouts.navigation')

        <!-- Sidebar + Main Layout -->
        <div class="relative">
            <!-- Backdrop (mobile) -->
            <div id="backdrop" class="fixed inset-0 z-30 hidden bg-black/40 md:hidden"></div>

            <!-- Sidebar -->
            <aside id="sidebar" class="fixed z-40 inset-y-0 left-0 pt-16 transform transition-transform duration-200 w-64 -translate-x-full md:translate-x-0 bg-gray-50 border-r border-gray-200 dark:bg-gray-900 dark:border-gray-800">
                <div class="h-full overflow-y-auto">
                    <nav class="px-2 py-4 flex flex-col gap-1 text-sm">
                        <!-- Dashboard -->
                        <a href="{{ route('dashboard') }}" title="Dashboard" aria-label="Dashboard" class="group flex items-center gap-3 w-full px-3 py-2 rounded-lg transition-colors {{ request()->is('dashboard') ? 'bg-gray-200 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                            <i data-lucide="layout-dashboard" class="h-5 w-5"></i>
                            <span class="sidebar-label hidden md:inline font-medium">Dashboard</span>
                        </a>

                        @if(Auth::user()->role === 'admin')
                            <!-- Admin -->
                            <a href="{{ route('siswa.index') }}" title="Siswa" aria-label="Siswa" class="group flex items-center gap-3 w-full px-3 py-2 rounded-lg transition-colors {{ request()->is('siswa*') ? 'bg-gray-200 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                <i data-lucide="users" class="h-5 w-5"></i>
                                <span class="sidebar-label hidden md:inline font-medium">Siswa</span>
                            </a>
                            <a href="{{ route('guru.index') }}" title="Guru" aria-label="Guru" class="group flex items-center gap-3 w-full px-3 py-2 rounded-lg transition-colors {{ request()->is('guru*') ? 'bg-gray-200 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                <i data-lucide="graduation-cap" class="h-5 w-5"></i>
                                <span class="sidebar-label hidden md:inline font-medium">Guru</span>
                            </a>
                            <a href="{{ route('kelas.index') }}" title="Kelas" aria-label="Kelas" class="group flex items-center gap-3 w-full px-3 py-2 rounded-lg transition-colors {{ request()->is('kelas*') ? 'bg-gray-200 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                <i data-lucide="layers" class="h-5 w-5"></i>
                                <span class="sidebar-label hidden md:inline font-medium">Kelas</span>
                            </a>
                            <a href="{{ route('jadwal.index') }}" title="Jadwal" aria-label="Jadwal" class="group flex items-center gap-3 w-full px-3 py-2 rounded-lg transition-colors {{ request()->is('jadwal*') ? 'bg-gray-200 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                <i data-lucide="calendar" class="h-5 w-5"></i>
                                <span class="sidebar-label hidden md:inline font-medium">Jadwal</span>
                            </a>
                            <a href="{{ route('pengumuman.index') }}" title="Pengumuman" aria-label="Pengumuman" class="group flex items-center gap-3 w-full px-3 py-2 rounded-lg transition-colors {{ request()->is('pengumuman*') ? 'bg-gray-200 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                <i data-lucide="megaphone" class="h-5 w-5"></i>
                                <span class="sidebar-label hidden md:inline font-medium">Pengumuman</span>
                            </a>
                        @elseif(Auth::user()->role === 'guru')
                            <!-- Guru -->
                            <a href="{{ route('guru.jadwal') }}" title="Jadwal Mengajar" aria-label="Jadwal Mengajar" class="group flex items-center gap-3 w-full px-3 py-2 rounded-lg transition-colors {{ request()->is('jadwal-mengajar') ? 'bg-gray-200 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                <i data-lucide="calendar" class="h-5 w-5"></i>
                                <span class="sidebar-label hidden md:inline font-medium">Jadwal Mengajar</span>
                            </a>
                            <a href="{{ route('absensi.index') }}" title="Absensi" aria-label="Absensi" class="group flex items-center gap-3 w-full px-3 py-2 rounded-lg transition-colors {{ request()->is('absensi*') ? 'bg-gray-200 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                <i data-lucide="clipboard-check" class="h-5 w-5"></i>
                                <span class="sidebar-label hidden md:inline font-medium">Absensi</span>
                            </a>
                            <a href="{{ route('nilai.index') }}" title="Nilai" aria-label="Nilai" class="group flex items-center gap-3 w-full px-3 py-2 rounded-lg transition-colors {{ request()->is('nilai*') ? 'bg-gray-200 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                <i data-lucide="star" class="h-5 w-5"></i>
                                <span class="sidebar-label hidden md:inline font-medium">Nilai</span>
                            </a>
                            <a href="{{ route('materi.index') }}" title="Materi" aria-label="Materi" class="group flex items-center gap-3 w-full px-3 py-2 rounded-lg transition-colors {{ request()->is('materi*') ? 'bg-gray-200 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                <i data-lucide="file-text" class="h-5 w-5"></i>
                                <span class="sidebar-label hidden md:inline font-medium">Materi</span>
                            </a>
                            <a href="{{ route('pengumuman-kelas.index') }}" title="Pengumuman Kelas" aria-label="Pengumuman Kelas" class="group flex items-center gap-3 w-full px-3 py-2 rounded-lg transition-colors {{ request()->is('pengumuman-kelas*') ? 'bg-gray-200 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                <i data-lucide="megaphone" class="h-5 w-5"></i>
                                <span class="sidebar-label hidden md:inline font-medium">Pengumuman Kelas</span>
                            </a>
                        @elseif(Auth::user()->role === 'siswa')
                            <!-- Siswa -->
                            <a href="{{ route('siswa.jadwal') }}" title="Jadwal Pelajaran" aria-label="Jadwal Pelajaran" class="group flex items-center gap-3 w-full px-3 py-2 rounded-lg transition-colors {{ request()->is('jadwal-siswa') ? 'bg-gray-200 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                <i data-lucide="calendar" class="h-5 w-5"></i>
                                <span class="sidebar-label hidden md:inline font-medium">Jadwal Pelajaran</span>
                            </a>
                            <a href="{{ route('siswa.nilai') }}" title="Nilai" aria-label="Nilai" class="group flex items-center gap-3 w-full px-3 py-2 rounded-lg transition-colors {{ request()->is('nilai-siswa') ? 'bg-gray-200 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                <i data-lucide="star" class="h-5 w-5"></i>
                                <span class="sidebar-label hidden md:inline font-medium">Nilai</span>
                            </a>
                            <a href="{{ route('siswa.absensi') }}" title="Absensi" aria-label="Absensi" class="group flex items-center gap-3 w-full px-3 py-2 rounded-lg transition-colors {{ request()->is('absensi-siswa') ? 'bg-gray-200 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                <i data-lucide="clipboard-check" class="h-5 w-5"></i>
                                <span class="sidebar-label hidden md:inline font-medium">Absensi</span>
                            </a>
                            <a href="{{ route('siswa.materi') }}" title="Materi" aria-label="Materi" class="group flex items-center gap-3 w-full px-3 py-2 rounded-lg transition-colors {{ request()->is('materi-siswa') ? 'bg-gray-200 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                <i data-lucide="file-text" class="h-5 w-5"></i>
                                <span class="sidebar-label hidden md:inline font-medium">Materi</span>
                            </a>
                            <a href="{{ route('siswa.pengumuman') }}" title="Pengumuman" aria-label="Pengumuman" class="group flex items-center gap-3 w-full px-3 py-2 rounded-lg transition-colors {{ request()->is('pengumuman-siswa') ? 'bg-gray-200 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                <i data-lucide="megaphone" class="h-5 w-5"></i>
                                <span class="sidebar-label hidden md:inline font-medium">Pengumuman</span>
                            </a>
                        @endif
                    </nav>
                    <!-- Desktop: collapse toggle (icon-only) -->
                    <div class="px-2 py-4 border-t border-gray-200 dark:border-gray-800 hidden md:block">
                        <button id="collapseSidebarBtn" type="button" aria-expanded="true" aria-controls="sidebar" aria-label="Toggle sidebar" class="mx-auto inline-flex items-center justify-center h-10 w-10 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-200 dark:border-gray-700 dark:text-gray-200 dark:hover:bg-gray-700 transition-colors">
                            <i id="collapseCaret" data-lucide="chevron-left" class="h-5 w-5 transition-transform duration-300 ease-in-out"></i>
                        </button>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <main id="main" class="min-h-screen pt-24 md:ml-64 transition-all duration-200 p-4">
                @yield('content')
            </main>
        </div>
        <script src="https://unpkg.com/lucide@latest"></script>

        <!-- Icons CDN (Lucide) -->
        <script src="https://unpkg.com/lucide@latest"></script>
        
        <!-- Keep Bootstrap JS for pages that still use it -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/layout.js') }}"></script>
        @stack('scripts')
    </body>
</html>