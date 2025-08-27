<header class="fixed inset-x-0 top-0 z-50 bg-white/90 backdrop-blur border-b border-gray-200 dark:bg-gray-800/80 dark:border-gray-700">
    <div class="container-fluid">
      <div class="row align-items-center py-3 px-2">
        <div class="col-auto flex items-center">
          <!-- Brand -->
          <a href="{{ url('/') }}" class="text-base font-semibold text-gray-900 dark:text-gray-100">{{ config('app.name', 'Portal Sekolah') }}</a>
        </div>
        <div class="col flex flex-row justify-end items-center gap-2">
        <!-- Brand -->
        <a href="{{ url('/') }}" class="text-base font-semibold text-gray-900 dark:text-gray-100">{{ config('app.name', 'Portal Sekolah') }}</a>
            <!-- Theme toggle -->
            <button id="theme-toggle" type="button" class="inline-flex items-center justify-center h-10 w-10 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-100 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700" aria-label="Toggle theme">
                <i id="theme-icon" data-lucide="moon" class="h-5 w-5"></i>
            </button>

            <!-- Desktop: profile dropdown (terpisah) -->
            <div class="relative hidden md:block">
                <button id="desktopProfileBtn" type="button" aria-expanded="false" aria-controls="desktopProfileMenu" aria-label="Buka profil" class="inline-flex items-center gap-2 px-3 h-10 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-100 dark:border-gray-700 dark:text-gray-200 dark:hover:bg-gray-700">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profil" class="h-6 w-6 rounded-full object-cover" />
                    <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                    <i data-lucide="chevron-down" class="h-4 w-4"></i>
                </button>
                <!-- Dropdown Desktop -->
                <div id="desktopProfileMenu" class="absolute right-0 mt-2 w-56 rounded-lg border border-gray-200 bg-white shadow-lg dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 hidden z-50 p-2">
                    <div class="px-3 py-2 text-xs text-gray-500 dark:text-gray-400">
                        Masuk sebagai <span class="font-medium text-gray-900 dark:text-gray-100">{{ Auth::user()->name }}</span>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2 rounded-md text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                        <i data-lucide="settings" class="h-5 w-5"></i>
                        Pengaturan Akun
                    </a>
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2 rounded-md text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                        <i data-lucide="id-card" class="h-5 w-5"></i>
                        Profil Pengguna
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="mt-1">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 rounded-md text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20">
                            <i data-lucide="log-out" class="h-5 w-5"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            <!-- Mobile: menu dropdown (gabungan menu utama + profil) -->
            <div class="relative md:hidden">
                <button id="mobileMenuBtn" type="button" aria-expanded="false" aria-controls="mobileMenu" aria-label="Buka menu" class="inline-flex items-center justify-center h-10 px-3 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-100 dark:border-gray-700 dark:text-gray-200 dark:hover:bg-gray-700 gap-2">
                    <i data-lucide="menu" class="h-5 w-5"></i>
                    <span class="text-sm font-medium">Menu</span>
                    <i id="mobileMenuCaret" data-lucide="chevron-down" class="h-4 w-4 transition-transform duration-300 ease-in-out"></i>
                </button>
                <!-- Dropdown Mobile -->
                <div id="mobileMenu" class="absolute right-0 mt-2 w-72 rounded-lg border border-gray-200 bg-white shadow-lg dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 hidden z-50 p-2">
                    <!-- Profil ringkas -->
                    <div class="flex items-center gap-3 px-3 py-2 rounded-md bg-gray-50 dark:bg-gray-800">
                        <img src="https://randomuser.me/api/portraits/men/64.jpg" alt="Profil" class="h-10 w-10 rounded-full object-cover" />
                        <div class="flex-1">
                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Profil Pengguna</div>
                        </div>
                    </div>
                    <div class="my-2 h-px bg-gray-200 dark:bg-gray-700"></div>
                    <!-- Menu utama -->
                    <nav class="flex flex-col space-y-1 text-sm">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-3 px-3 py-2 rounded-md transition-colors {{ request()->is('dashboard') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                            <i data-lucide="layout-dashboard" class="h-5 w-5"></i>
                            <span>Dashboard</span>
                        </a>
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('siswa.index') }}" class="inline-flex items-center gap-3 px-3 py-2 rounded-md transition-colors {{ request()->is('siswa*') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                <i data-lucide="users" class="h-5 w-5"></i>
                                <span>Siswa</span>
                            </a>
                            <a href="{{ route('guru.index') }}" class="inline-flex items-center gap-3 px-3 py-2 rounded-md transition-colors {{ request()->is('guru*') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                <i data-lucide="graduation-cap" class="h-5 w-5"></i>
                                <span>Guru</span>
                            </a>
                            <a href="{{ route('kelas.index') }}" class="inline-flex items-center gap-3 px-3 py-2 rounded-md transition-colors {{ request()->is('kelas*') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                <i data-lucide="layers" class="h-5 w-5"></i>
                                <span>Kelas</span>
                            </a>
                            <a href="{{ route('jadwal.index') }}" class="inline-flex items-center gap-3 px-3 py-2 rounded-md transition-colors {{ request()->is('jadwal*') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                <i data-lucide="calendar" class="h-5 w-5"></i>
                                <span>Jadwal</span>
                            </a>
                            <a href="{{ route('pengumuman.index') }}" class="inline-flex items-center gap-3 px-3 py-2 rounded-md transition-colors {{ request()->is('pengumuman*') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                <i data-lucide="megaphone" class="h-5 w-5"></i>
                                <span>Pengumuman</span>
                            </a>
                        @elseif(Auth::user()->role === 'guru')
                            <a href="{{ route('guru.jadwal') }}" class="inline-flex items-center gap-3 px-3 py-2 rounded-md transition-colors {{ request()->is('jadwal-mengajar') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                <i data-lucide="calendar" class="h-5 w-5"></i>
                                <span>Jadwal Mengajar</span>
                            </a>
                            <a href="{{ route('absensi.index') }}" class="inline-flex items-center gap-3 px-3 py-2 rounded-md transition-colors {{ request()->is('absensi*') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                <i data-lucide="clipboard-check" class="h-5 w-5"></i>
                                <span>Absensi</span>
                            </a>
                            <a href="{{ route('nilai.index') }}" class="inline-flex items-center gap-3 px-3 py-2 rounded-md transition-colors {{ request()->is('nilai*') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                <i data-lucide="star" class="h-5 w-5"></i>
                                <span>Nilai</span>
                            </a>
                            <a href="{{ route('materi.index') }}" class="inline-flex items-center gap-3 px-3 py-2 rounded-md transition-colors {{ request()->is('materi*') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                <i data-lucide="file-text" class="h-5 w-5"></i>
                                <span>Materi</span>
                            </a>
                            <a href="{{ route('pengumuman-kelas.index') }}" class="inline-flex items-center gap-3 px-3 py-2 rounded-md transition-colors {{ request()->is('pengumuman-kelas*') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                <i data-lucide="megaphone" class="h-5 w-5"></i>
                                <span>Pengumuman Kelas</span>
                            </a>
                        @elseif(Auth::user()->role === 'siswa')
                            <a href="{{ route('siswa.jadwal') }}" class="inline-flex items-center gap-3 px-3 py-2 rounded-md transition-colors {{ request()->is('jadwal-siswa') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                <i data-lucide="calendar" class="h-5 w-5"></i>
                                <span>Jadwal Pelajaran</span>
                            </a>
                            <a href="{{ route('siswa.nilai') }}" class="inline-flex items-center gap-3 px-3 py-2 rounded-md transition-colors {{ request()->is('nilai-siswa') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                <i data-lucide="star" class="h-5 w-5"></i>
                                <span>Nilai</span>
                            </a>
                            <a href="{{ route('siswa.absensi') }}" class="inline-flex items-center gap-3 px-3 py-2 rounded-md transition-colors {{ request()->is('absensi-siswa') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                <i data-lucide="clipboard-check" class="h-5 w-5"></i>
                                <span>Absensi</span>
                            </a>
                            <a href="{{ route('siswa.materi') }}" class="inline-flex items-center gap-3 px-3 py-2 rounded-md transition-colors {{ request()->is('materi-siswa') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                <i data-lucide="file-text" class="h-5 w-5"></i>
                                <span>Materi</span>
                            </a>
                            <a href="{{ route('siswa.pengumuman') }}" class="inline-flex items-center gap-3 px-3 py-2 rounded-md transition-colors {{ request()->is('pengumuman-siswa') ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                <i data-lucide="megaphone" class="h-5 w-5"></i>
                                <span>Pengumuman</span>
                            </a>
                        @endif
                    </nav>
                    <div class="my-2 h-px bg-gray-200 dark:bg-gray-700"></div>
                    <!-- Aksi profil -->
                    <div class="flex flex-col text-sm">
                        <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-3 px-3 py-2 rounded-md text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                            <i data-lucide="id-card" class="h-5 w-5"></i>
                            Profil Pengguna
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="mt-1">
                            @csrf
                            <button type="submit" class="w-full inline-flex items-center gap-3 px-3 py-2 rounded-md text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20">
                                <i data-lucide="log-out" class="h-5 w-5"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- End col & row -->
        </div>
      </div>
    </div>
</header>
