<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Sekolah</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        .slider-container {
            position: relative;
            width: 100%;
            max-width: 700px;
            height: 380px;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            background: #fff;
        }
        .slider-image {
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }
        .slider-image.active {
            opacity: 1;
        }
        @media (max-width: 768px) {
            .slider-container {
                height: 220px;
                max-width: 95%;
            }
        }
        /* Scroll reveal animations */
        .reveal { opacity: 0; transform: translateY(20px); transition: all 700ms ease; }
        .reveal-active { opacity: 1; transform: translateY(0); }
        /* Floating background blobs */
        .blob { position: absolute; filter: blur(40px); opacity: .25; animation: float 10s ease-in-out infinite; }
        @keyframes float { 0%,100% { transform: translateY(0) } 50% { transform: translateY(-20px) } }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-green-50">

    {{-- Navbar --}}
    <nav class="flex justify-between items-center px-6 py-4 bg-white shadow-md">
        <h1 class="text-lg md:text-2xl font-bold text-green-700 tracking-wide">
            Portal Sekolah
        </h1>
        <div class="hidden md:flex items-center gap-6 text-green-700/80">
            <a href="#fitur" class="hover:text-green-800">Fitur</a>
            <a href="#cara-kerja" class="hover:text-green-800">Cara Kerja</a>
            <a href="#tentang" class="hover:text-green-800">Tentang</a>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('login') }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow transition">Masuk</a>
            {{-- <a href="{{ route('register') }}" class="px-4 py-2 border border-green-600 text-green-700 rounded-lg hover:bg-green-600 hover:text-white transition">Daftar</a> --}}
        </div>
    </nav>

    {{-- Hero Section --}}
    <section class="flex flex-col-reverse md:flex-row items-center justify-between 
                    flex-grow w-full px-6 md:px-36 xl:px-48 py-12 bg-white">
        
        {{-- Teks --}}
        <div class="max-w-md text-center md:text-left">
            <h2 class="text-3xl md:text-4xl font-extrabold text-green-800 mb-4 animate__animated animate__fadeInLeft">
                Selamat Datang di Portal Sekolah
            </h2>
            <p class="text-green-700 text-lg md:text-xl leading-relaxed animate__animated animate__fadeInLeft animate__delay-1s">
                Sistem terpadu untuk guru dan siswa dengan pengelolaan jadwal, materi, dan pengumuman yang modern dan mudah diakses.
            </p>
        </div>

        {{-- Slider Gambar --}}
        <div class="slider-container mt-6 md:mt-0">
            <img src="https://images.unsplash.com/photo-1600880292089-90a7e086ee0c?auto=format&fit=crop&w=800&q=80" class="slider-image active" alt="Sekolah 1">
            <img src="https://images.unsplash.com/photo-1596495578065-5eebc0f0f0ff?auto=format&fit=crop&w=800&q=80" class="slider-image" alt="Sekolah 2">
            <img src="https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?auto=format&fit=crop&w=800&q=80" class="slider-image" alt="Sekolah 3">
        </div>
    </section>

    {{-- Tentang --}}
    <section id="tentang" class="bg-white border-t border-green-100">
        <div class="max-w-7xl mx-auto px-6 py-14 md:py-20">
            <div class="grid md:grid-cols-3 gap-8 items-center">
                <div class="md:col-span-2 reveal">
                    <h2 class="text-2xl md:text-4xl font-extrabold text-green-800">Tentang Portal Sekolah</h2>
                    <p class="text-green-700/90 mt-3">Aplikasi ini dibangun untuk mempermudah komunikasi dan administrasi sekolah. Dengan antarmuka yang bersih dan performa yang ringan, Portal Sekolah membantu semua pihak fokus pada inti aktivitas belajar mengajar.</p>
                    <div class="mt-6 flex flex-wrap gap-3">
                        <span class="px-3 py-1 rounded-full bg-green-50 border border-green-200 text-sm text-green-800">UI Modern</span>
                        <span class="px-3 py-1 rounded-full bg-green-50 border border-green-200 text-sm text-green-800">Mobile‑first</span>
                        <span class="px-3 py-1 rounded-full bg-green-50 border border-green-200 text-sm text-green-800">Aman</span>
                        <span class="px-3 py-1 rounded-full bg-green-50 border border-green-200 text-sm text-green-800">Mudah Digunakan</span>
                    </div>
                </div>
                <div class="reveal">
                    <div class="p-6 rounded-2xl bg-green-50 border border-green-100 shadow-sm">
                        <p class="text-green-900 font-semibold">“Satu portal untuk semua kebutuhan sekolah. Hemat waktu, kurangi kesalahan, tingkatkan kolaborasi.”</p>
                        <p class="text-green-700/80 text-sm mt-3">— Tim Pengembang</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Cara Kerja --}}
    <section id="cara-kerja" class="bg-green-50 border-t border-green-100">
        <div class="max-w-7xl mx-auto px-6 py-14 md:py-20">
            <div class="grid md:grid-cols-2 gap-10 items-center">
                <div class="reveal">
                    <h2 class="text-2xl md:text-4xl font-extrabold text-green-800">Alur Penggunaan yang Sederhana</h2>
                    <p class="text-green-700/90 mt-3">Mulai cepat tanpa kurva belajar yang rumit. Setiap langkah dirancang untuk meminimalkan klik dan mempercepat pekerjaan harian.</p>
                    <ul class="mt-6 space-y-4">
                        <li class="flex gap-3 items-start">
                            <span class="h-6 w-6 rounded-full bg-green-600 text-white text-sm grid place-content-center">1</span>
                            <div>
                                <p class="font-semibold text-green-900">Masuk sesuai peran</p>
                                <p class="text-green-700/90 text-sm">Admin, guru, atau siswa mendapatkan menu yang relevan.</p>
                            </div>
                        </li>
                        <li class="flex gap-3 items-start">
                            <span class="h-6 w-6 rounded-full bg-green-600 text-white text-sm grid place-content-center">2</span>
                            <div>
                                <p class="font-semibold text-green-900">Kelola data dan aktivitas</p>
                                <p class="text-green-700/90 text-sm">Jadwal, absensi, materi, tugas, nilai, dan pengumuman dalam satu tempat.</p>
                            </div>
                        </li>
                        <li class="flex gap-3 items-start">
                            <span class="h-6 w-6 rounded-full bg-green-600 text-white text-sm grid place-content-center">3</span>
                            <div>
                                <p class="font-semibold text-green-900">Pantau hasil</p>
                                <p class="text-green-700/90 text-sm">Lihat rekap nilai dan kehadiran untuk pengambilan keputusan yang cepat.</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="grid grid-cols-2 gap-4 reveal">
                    <div class="p-4 rounded-xl bg-white shadow-sm border border-green-100">
                        <p class="text-sm text-green-700/80">Untuk Guru</p>
                        <p class="font-semibold text-green-900 mt-1">Input nilai sekali, rekap otomatis.</p>
                    </div>
                    <div class="p-4 rounded-xl bg-white shadow-sm border border-green-100">
                        <p class="text-sm text-green-700/80">Untuk Siswa</p>
                        <p class="font-semibold text-green-900 mt-1">Akses materi dan tugas kapan pun.</p>
                    </div>
                    <div class="p-4 rounded-xl bg-white shadow-sm border border-green-100">
                        <p class="text-sm text-green-700/80">Untuk Admin</p>
                        <p class="font-semibold text-green-900 mt-1">Kontrol penuh data dan pengguna.</p>
                    </div>
                    <div class="p-4 rounded-xl bg-white shadow-sm border border-green-100">
                        <p class="text-sm text-green-700/80">Keamanan</p>
                        <p class="font-semibold text-green-900 mt-1">Hak akses tersegmentasi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Fitur Section --}}
    <section id="fitur" class="bg-white border-t border-green-100">
        <div class="max-w-7xl mx-auto px-6 py-14 md:py-20">
            <div class="text-center max-w-2xl mx-auto mb-10 md:mb-14 reveal">
                <h2 class="text-2xl md:text-4xl font-extrabold text-green-800">Semua yang Dibutuhkan, dalam Satu Portal</h2>
                <p class="text-green-700/90 mt-3">Portal ini menyatukan fitur-fitur penting untuk mendukung kegiatan belajar mengajar agar lebih efektif dan transparan.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="p-6 rounded-2xl bg-green-50 border border-green-100 hover:shadow-lg transition group reveal">
                    <div class="h-12 w-12 rounded-xl bg-green-600/10 text-green-700 grid place-content-center mb-4 group-hover:scale-110 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor"><path d="M6 2h9a1 1 0 0 1 .8.4l4 5.333A1 1 0 0 1 20 9H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2Z"/><path d="M4 13a2 2 0 0 1 2-2h14v7a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-5Z"/></svg>
                    </div>
                    <h3 class="font-semibold text-lg text-green-900">Jadwal Terkelola</h3>
                    <p class="text-green-700/90 mt-1">Atur jadwal pelajaran dan mengajar dalam tampilan yang rapi, mudah dipahami, dan selalu sinkron.</p>
                </div>
                <div class="p-6 rounded-2xl bg-green-50 border border-green-100 hover:shadow-lg transition group reveal">
                    <div class="h-12 w-12 rounded-xl bg-green-600/10 text-green-700 grid place-content-center mb-4 group-hover:scale-110 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor"><path d="M9 7h6v2H9V7Zm-4 0h2v2H5V7Zm0 4h2v2H5v-2Zm0 4h2v2H5v-2Zm4 0h6v2H9v-2Zm0-4h6v2H9v-2Zm8-4h2v10h-2V7Z"/></svg>
                    </div>
                    <h3 class="font-semibold text-lg text-green-900">Absensi Terintegrasi</h3>
                    <p class="text-green-700/90 mt-1">Catat kehadiran siswa dan guru dengan cepat, akurat, dan terhubung dengan laporan.</p>
                </div>
                <div class="p-6 rounded-2xl bg-green-50 border border-green-100 hover:shadow-lg transition group reveal">
                    <div class="h-12 w-12 rounded-xl bg-green-600/10 text-green-700 grid place-content-center mb-4 group-hover:scale-110 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor"><path d="M5 4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v14.586l-3.707-3.707a1 1 0 0 0-1.414 0L8 20.586V4H5Z"/></svg>
                    </div>
                    <h3 class="font-semibold text-lg text-green-900">Materi & Tugas</h3>
                    <p class="text-green-700/90 mt-1">Bagikan materi, tugaskan pekerjaan rumah, dan pantau progres siswa dalam satu tempat.</p>
                </div>
                <div class="p-6 rounded-2xl bg-green-50 border border-green-100 hover:shadow-lg transition group reveal">
                    <div class="h-12 w-12 rounded-xl bg-green-600/10 text-green-700 grid place-content-center mb-4 group-hover:scale-110 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2Zm-1 15-4-4 1.414-1.414L11 13.172l5.586-5.586L18 9l-7 8Z"/></svg>
                    </div>
                    <h3 class="font-semibold text-lg text-green-900">Penilaian Transparan</h3>
                    <p class="text-green-700/90 mt-1">Input nilai berdasarkan jenis penilaian, tampilkan rekap yang jelas untuk siswa dan orang tua.</p>
                </div>
                <div class="p-6 rounded-2xl bg-green-50 border border-green-100 hover:shadow-lg transition group reveal">
                    <div class="h-12 w-12 rounded-xl bg-green-600/10 text-green-700 grid place-content-center mb-4 group-hover:scale-110 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor"><path d="M3 5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v3H3V5Zm0 5h18v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-9Zm4 3v2h10v-2H7Z"/></svg>
                    </div>
                    <h3 class="font-semibold text-lg text-green-900">Pengumuman Real‑time</h3>
                    <p class="text-green-700/90 mt-1">Sebarkan informasi penting ke seluruh kelas secara cepat dan terstruktur.</p>
                </div>
                <div class="p-6 rounded-2xl bg-green-50 border border-green-100 hover:shadow-lg transition group reveal">
                    <div class="h-12 w-12 rounded-xl bg-green-600/10 text-green-700 grid place-content-center mb-4 group-hover:scale-110 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor"><path d="M4 5h16v2H4V5Zm0 6h10v2H4v-2Zm0 6h16v2H4v-2Z"/></svg>
                    </div>
                    <h3 class="font-semibold text-lg text-green-900">Multi‑Peran</h3>
                    <p class="text-green-700/90 mt-1">Akses disesuaikan untuk admin, guru, dan siswa demi keamanan dan kemudahan.</p>
                </div>
            </div>
        </div>
    </section>
    {{-- Call To Action --}}
    <section class="relative bg-gradient-to-r from-green-600 to-emerald-600 text-white">
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 20% 20%, white 0, transparent 50%), radial-gradient(circle at 80% 0%, white 0, transparent 50%);"></div>
        <div class="relative max-w-7xl mx-auto px-6 py-14 md:py-16 text-center">
            <h2 class="text-2xl md:text-4xl font-extrabold">Siap Memulai?</h2>
            <p class="mt-2 text-green-50/90">Masuk dan nikmati kemudahan mengelola aktivitas sekolah setiap hari.</p>
            <div class="mt-6">
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-green-700 font-semibold rounded-lg shadow hover:shadow-md hover:-translate-y-0.5 transition">
                    Masuk ke Portal
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="text-center py-6 text-sm bg-white border-t border-green-100 text-green-700">
        &copy; {{ date('Y') }} Portal Sekolah · Dibangun dengan cinta untuk pendidikan yang lebih baik
    </footer>

    {{-- Scripts --}}
    <script>
        // Slider
        (function(){
            const slides = document.querySelectorAll('.slider-image');
            if (!slides.length) return;
            let currentIndex = 0;
            setInterval(() => {
                slides[currentIndex].classList.remove('active');
                currentIndex = (currentIndex + 1) % slides.length;
                slides[currentIndex].classList.add('active');
            }, 4000);
        })();
        // Scroll reveal
        (function(){
            const revealEls = document.querySelectorAll('.reveal');
            if (!('IntersectionObserver' in window)) { revealEls.forEach(el => el.classList.add('reveal-active')); return; }
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) { entry.target.classList.add('reveal-active'); observer.unobserve(entry.target); }
                });
            }, { threshold: 0.15 });
            revealEls.forEach(el => observer.observe(el));
        })();
        // Counter animation
        (function(){
            const counters = document.querySelectorAll('.counter');
            const animate = (el) => {
                const target = parseInt(el.getAttribute('data-counter') || '0', 10);
                const duration = 900; // ms
                const start = performance.now();
                const step = (now) => {
                    const progress = Math.min((now - start) / duration, 1);
                    const value = Math.floor(progress * target);
                    el.textContent = value.toString();
                    if (progress < 1) requestAnimationFrame(step);
                };
                requestAnimationFrame(step);
            };
            if (!('IntersectionObserver' in window)) { counters.forEach(animate); return; }
            const io = new IntersectionObserver((entries) => { entries.forEach(e => { if (e.isIntersecting) { animate(e.target); io.unobserve(e.target); } }); }, { threshold: 0.6 });
            counters.forEach(c => io.observe(c));
        })();
        // Smooth scroll for navbar anchors
        (function(){
            document.querySelectorAll('a[href^="#"]').forEach(function(anchor){
                anchor.addEventListener('click', function(e){
                    const href = this.getAttribute('href');
                    if (href && href.length > 1) { e.preventDefault(); document.querySelector(href).scrollIntoView({ behavior: 'smooth' }); }
                });
            });
        })();
    </script>
</body>
</html>
