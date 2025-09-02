<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS SMA MUSLIMIN - Sistem Manajemen Pembelajaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.8s ease-in-out',
                        'slide-up': 'slideUp 0.8s ease-out',
                        'float': 'float 3s ease-in-out infinite',
                        'pulse-glow': 'pulseGlow 2s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' }
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' }
                        },
                        pulseGlow: {
                            '0%, 100%': { boxShadow: '0 0 20px rgba(59, 130, 246, 0.3)' },
                            '50%': { boxShadow: '0 0 40px rgba(59, 130, 246, 0.6)' }
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #1e3a8a 0%, #3730a3 25%, #7c3aed 50%, #c026d3 75%, #db2777 100%);
            background-size: 300% 300%;
            animation: gradientShift 8s ease infinite;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .feature-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            transition: left 0.5s;
        }

        .feature-card:hover::before {
            left: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        }

        .scroll-indicator {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateX(-50%) translateY(0); }
            40% { transform: translateX(-50%) translateY(-10px); }
            60% { transform: translateX(-50%) translateY(-5px); }
        }

        .section-divider {
            height: 100px;
            background: linear-gradient(to bottom, transparent, rgba(59, 130, 246, 0.1), transparent);
        }

        .stats-counter {
            font-size: 3rem;
            font-weight: bold;
            background: linear-gradient(45deg, #3b82f6, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .shape {
            position: absolute;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        .shape:nth-child(1) { top: 20%; left: 10%; animation-delay: 0s; }
        .shape:nth-child(2) { top: 60%; right: 10%; animation-delay: 2s; }
        .shape:nth-child(3) { bottom: 20%; left: 20%; animation-delay: 4s; }

        .testimonial-card {
            background: linear-gradient(145deg, #ffffff, #f8fafc);
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="min-h-screen bg-gray-50 overflow-x-hidden">
<div class="min-h-screen bg-gray-50 overflow-x-hidden">

    <!-- Hero Section -->
    <section class="hero-gradient text-white min-h-screen flex items-center relative overflow-hidden">
        <div class="floating-shapes">
            <div class="shape w-32 h-32 bg-white rounded-full"></div>
            <div class="shape w-24 h-24 bg-yellow-300 rounded-lg transform rotate-45"></div>
            <div class="shape w-40 h-40 bg-blue-300 rounded-full"></div>
        </div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="space-y-8 animate-fade-in">
                <div class="space-y-6">
                    <div class="inline-flex items-center px-6 py-3 glass-effect rounded-full text-sm font-medium">
                        <span class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></span>
                        Sistem Manajemen Pembelajaran Terdepan
                    </div>

                    <h1 class="text-5xl md:text-7xl font-bold leading-tight">
                        LMS SMA
                        <span class="block bg-gradient-to-r from-yellow-300 to-orange-300 bg-clip-text text-transparent">
                            MUSLIMIN
                        </span>
                    </h1>

                    <p class="text-xl md:text-2xl text-blue-100 leading-relaxed max-w-4xl mx-auto">
                        Platform digital terintegrasi untuk mengelola seluruh aspek pendidikan di SMA MUSLIMIN.
                        Dari manajemen siswa dan guru, hingga sistem penilaian dan absensi yang modern.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                    <a href="{{ url('/login') }}" class="group inline-flex items-center justify-center px-10 py-5 bg-white text-blue-600 font-bold rounded-2xl text-xl transition-all duration-300 shadow-2xl hover:shadow-3xl transform hover:scale-105 animate-pulse-glow">
                        <svg class="w-6 h-6 mr-3 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Masuk ke Sistem LMS
                    </a>
                </div>

                <div class="pt-8">
                    <p class="text-blue-200 text-lg">
                        🌟 Platform modern untuk pendidikan yang lebih baik
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="fitur" class="min-h-screen flex items-center py-20 bg-gradient-to-br from-gray-50 to-blue-50 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="text-center mb-16 animate-slide-up">
                <span class="inline-block px-4 py-2 bg-blue-100 text-blue-600 rounded-full text-sm font-semibold mb-4">
                    Fitur Lengkap Sistem
                </span>
                <h2 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">
                    Manajemen Sekolah
                    <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                        Terintegrasi
                    </span>
                </h2>
                <p class="text-xl md:text-2xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                    Sistem lengkap untuk mengelola semua aspek pendidikan di SMA MUSLIMIN dengan fitur-fitur modern dan user-friendly
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                <!-- Fitur 1: Manajemen Siswa -->
                <div class="feature-card bg-white p-8 rounded-2xl shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Manajemen Siswa</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Kelola data siswa lengkap dengan informasi akademik, kontak, dan riwayat prestasi. Sistem pencarian cepat dan filter untuk akses data yang efisien.</p>
                    <div class="flex items-center text-blue-600 font-semibold">
                        <span>Pelajari lebih lanjut</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>

                <!-- Fitur 2: Manajemen Guru -->
                <div class="feature-card bg-white p-8 rounded-2xl shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Manajemen Guru</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Database lengkap guru dengan jadwal mengajar, mata pelajaran, dan informasi kontak. Sistem untuk mengelola tugas dan tanggung jawab setiap guru.</p>
                    <div class="flex items-center text-green-600 font-semibold">
                        <span>Pelajari lebih lanjut</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>

                <!-- Fitur 3: Sistem Penilaian -->
                <div class="feature-card bg-white p-8 rounded-2xl shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Sistem Penilaian</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Input nilai otomatis dengan berbagai jenis penilaian. Laporan nilai real-time, analisis performa siswa, dan sistem rapor digital yang terintegrasi.</p>
                    <div class="flex items-center text-purple-600 font-semibold">
                        <span>Pelajari lebih lanjut</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>

                <!-- Fitur 4: Absensi Digital -->
                <div class="feature-card bg-white p-8 rounded-2xl shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Absensi Digital</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Sistem absensi modern dengan QR code dan tracking lokasi. Monitoring kehadiran real-time dan laporan absensi otomatis untuk siswa dan guru.</p>
                    <div class="flex items-center text-red-600 font-semibold">
                        <span>Pelajari lebih lanjut</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>

                <!-- Fitur 5: Jadwal Terjadwal -->
                <div class="feature-card bg-white p-8 rounded-2xl shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Jadwal Terjadwal</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Sistem jadwal otomatis dengan deteksi konflik. Manajemen jadwal pelajaran, ujian, dan kegiatan ekstrakurikuler yang terintegrasi untuk semua kelas.</p>
                    <div class="flex items-center text-indigo-600 font-semibold">
                        <span>Pelajari lebih lanjut</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>

                <!-- Fitur 6: Bank Materi -->
                <div class="feature-card bg-white p-8 rounded-2xl shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-teal-500 to-teal-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Bank Materi</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Repository materi pembelajaran digital dengan sistem kategorisasi otomatis. Upload berbagai format file dan akses mudah untuk guru dan siswa.</p>
                    <div class="flex items-center text-teal-600 font-semibold">
                        <span>Pelajari lebih lanjut</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="min-h-screen flex items-center py-20 bg-gradient-to-br from-blue-900 to-purple-900 text-white relative overflow-hidden">
        <div class="floating-shapes">
            <div class="shape w-64 h-64 bg-blue-400 rounded-full opacity-5"></div>
            <div class="shape w-48 h-48 bg-purple-400 rounded-lg transform rotate-45 opacity-5"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-8">
                    <div class="space-y-6">
                        <span class="inline-block px-4 py-2 bg-white bg-opacity-10 backdrop-filter backdrop-blur-lg rounded-full text-sm font-semibold">
                            Tentang LMS SMA MUSLIMIN
                        </span>
                        
                        <h2 class="text-4xl md:text-6xl font-bold leading-tight">
                            Membangun
                            <span class="bg-gradient-to-r from-yellow-300 to-orange-300 bg-clip-text text-transparent">
                                Generasi Digital
                            </span>
                            <span class="block text-blue-100">
                                yang Berkarakter
                            </span>
                        </h2>
                        
                        <p class="text-xl text-blue-100 leading-relaxed">
                            SMA MUSLIMIN telah menjadi pionir dalam integrasi teknologi dan pendidikan Islami. LMS kami merupakan hasil dari bertahun-tahun penelitian dan pengembangan untuk menciptakan platform pembelajaran yang tidak hanya canggih secara teknologi, tetapi juga mengakar kuat pada nilai-nilai Islam.
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-6">
                        <div class="glass-effect p-6 rounded-xl">
                            <div class="text-3xl font-bold text-yellow-300 mb-2">15+</div>
                            <p class="text-blue-200">Tahun Pengalaman</p>
                        </div>
                        <div class="glass-effect p-6 rounded-xl">
                            <div class="text-3xl font-bold text-yellow-300 mb-2">98%</div>
                            <p class="text-blue-200">Tingkat Kepuasan</p>
                        </div>
                        <div class="glass-effect p-6 rounded-xl">
                            <div class="text-3xl font-bold text-yellow-300 mb-2">50+</div>
                            <p class="text-blue-200">Award Prestasi</p>
                        </div>
                        <div class="glass-effect p-6 rounded-xl">
                            <div class="text-3xl font-bold text-yellow-300 mb-2">24/7</div>
                            <p class="text-blue-200">Support System</p>
                        </div>
                    </div>
                </div>
                
                <div class="relative">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-yellow-400 to-orange-400 rounded-3xl transform -rotate-6 opacity-20"></div>
                        <div class="relative glass-effect rounded-3xl p-8">
                            <div class="space-y-6">
                                <h3 class="text-2xl font-bold text-white mb-6">Visi & Misi Kami</h3>
                                
                                <div class="space-y-4">
                                    <div class="flex items-start space-x-4">
                                        <div class="w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                            <svg class="w-4 h-4 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-yellow-300 mb-2">Visi</h4>
                                            <p class="text-blue-100 text-sm">Menjadi lembaga pendidikan Islam terdepan yang mengintegrasikan teknologi modern dengan nilai-nilai spiritual untuk mencetak generasi yang cerdas dan berkarakter.</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-start space-x-4">
                                        <div class="w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                            <svg class="w-4 h-4 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-yellow-300 mb-2">Misi</h4>
                                            <p class="text-blue-100 text-sm">Memberikan pendidikan berkualitas tinggi yang mengembangkan potensi akademik, spiritual, dan sosial siswa melalui pendekatan pembelajaran yang inovatif dan berbasis teknologi.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Prestasi & Kisah Sukses Section -->
    <section class="min-h-screen flex items-center py-20 bg-gray-50 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-blue-100 text-blue-600 rounded-full text-sm font-semibold mb-4">
                    Prestasi & Kisah Sukses
                </span>
                <h2 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">
                    Generasi
                    <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                        Unggul SMA MUSLIMIN
                    </span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Kisah inspiratif dari siswa, guru, dan alumni yang telah mencapai prestasi akademik dan pengembangan karakter melalui pendidikan berkualitas di SMA MUSLIMIN
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Prestasi Akademik -->
                <div class="testimonial-card p-8 rounded-2xl relative">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center mr-4">
                            <span class="text-white font-bold text-lg">SA</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">Siti Aminah</h4>
                            <p class="text-gray-600 text-sm">Alumni - Lulusan Cum Laude</p>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="flex text-yellow-400 mb-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        </div>
                    </div>
                    <blockquote class="text-lg text-gray-700 italic leading-relaxed">
                        "SMA MUSLIMIN telah membentuk fondasi pendidikan saya yang kuat. Dengan bimbingan guru-guru yang luar biasa, saya berhasil lulus cum laude dan melanjutkan studi ke universitas ternama. Pendidikan di sini tidak hanya tentang nilai akademik, tapi juga pembentukan karakter dan nilai-nilai Islam yang kokoh."
                    </blockquote>
                </div>

                <!-- Pengembangan Karakter -->
                <div class="testimonial-card p-8 rounded-2xl relative">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-teal-500 rounded-full flex items-center justify-center mr-4">
                            <span class="text-white font-bold text-lg">HR</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">Haji Rahman, S.Pd.I</h4>
                            <p class="text-gray-600 text-sm">Guru PAI & Bimbingan Konseling</p>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="flex text-yellow-400 mb-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        </div>
                    </div>
                    <blockquote class="text-lg text-gray-700 italic leading-relaxed">
                        "Melihat siswa-siswa berkembang dari remaja yang belum matang menjadi pemuda-pemudi yang bertanggung jawab adalah hadiah terbesar. SMA MUSLIMIN tidak hanya mengajarkan ilmu pengetahuan, tapi juga membentuk karakter, akhlak, dan kepedulian sosial. Ini adalah investasi pendidikan yang sesungguhnya."
                    </blockquote>
                </div>

                <!-- Prestasi Non-Akademik -->
                <div class="testimonial-card p-8 rounded-2xl relative">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-red-500 rounded-full flex items-center justify-center mr-4">
                            <span class="text-white font-bold text-lg">AF</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">Ahmad Fauzi</h4>
                            <p class="text-gray-600 text-sm">Ketua OSIS - Prestasi Olahraga</p>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="flex text-yellow-400 mb-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        </div>
                    </div>
                    <blockquote class="text-lg text-gray-700 italic leading-relaxed">
                        "SMA MUSLIMIN telah mengajarkan saya arti kepemimpinan sejati. Melalui organisasi siswa dan kegiatan olahraga, saya belajar tentang tanggung jawab, kerja sama tim, dan disiplin. Prestasi di bidang olahraga bukan hanya tentang kemenangan, tapi juga tentang membangun karakter dan semangat juang."
                    </blockquote>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="min-h-screen flex items-center py-20 bg-gradient-to-br from-gray-900 via-blue-900 to-purple-900 text-white relative overflow-hidden">
        <div class="floating-shapes">
            <div class="shape w-96 h-96 bg-gradient-to-r from-blue-400 to-purple-400 rounded-full opacity-10"></div>
            <div class="shape w-64 h-64 bg-gradient-to-r from-yellow-400 to-orange-400 rounded-lg transform rotate-45 opacity-10"></div>
        </div>

        <div class="max-w-5xl mx-auto text-center px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="space-y-8">
                <div class="space-y-6">
                    <span class="inline-block px-6 py-3 glass-effect rounded-full text-sm font-semibold">
                        🚀 Bergabung Sekarang
                    </span>

                    <h2 class="text-4xl md:text-7xl font-bold leading-tight">
                        Mulai
                        <span class="block bg-gradient-to-r from-yellow-300 to-orange-300 bg-clip-text text-transparent">
                            Perjalanan Digital
                        </span>
                        <span class="block text-2xl md:text-4xl text-blue-100">
                            SMA MUSLIMIN
                        </span>
                    </h2>

                    <p class="text-xl md:text-2xl text-blue-100 max-w-4xl mx-auto leading-relaxed">
                        Bergabunglah dengan komunitas SMA MUSLIMIN yang telah mengadopsi sistem pendidikan modern. Rasakan kemudahan mengelola akademik, monitoring siswa, dan komunikasi yang efektif.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                    <a href="{{ route('login') }}" class="group inline-flex items-center justify-center px-10 py-5 bg-gradient-to-r from-yellow-400 to-orange-400 text-gray-900 font-bold rounded-2xl text-xl transition-all duration-300 shadow-2xl hover:shadow-3xl transform hover:scale-105 hover:rotate-1">
                        <svg class="w-6 h-6 mr-3 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Masuk ke Sistem
                        <span class="ml-2 px-2 py-1 bg-white bg-opacity-30 rounded-lg text-sm">Login</span>
                    </a>

                    <a href="#kontak" class="inline-flex items-center justify-center px-8 py-4 glass-effect text-white font-semibold rounded-xl text-lg transition-all duration-300 hover:bg-white hover:text-blue-600 group">
                        <svg class="w-6 h-6 mr-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        Hubungi Kami
                    </a>
                </div>

                <div class="pt-8">
                    <p class="text-blue-200 text-sm">
                        ✨ Terpercaya oleh SMA MUSLIMIN dan komunitas pendidikan di Indonesia
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="kontak" class="min-h-screen flex items-center py-20 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-8">
                    <div class="space-y-6">
                        <span class="inline-block px-4 py-2 bg-blue-100 text-blue-600 rounded-full text-sm font-semibold">
                            Hubungi Kami
                        </span>
                        
                        <h2 class="text-4xl md:text-6xl font-bold text-gray-900 leading-tight">
                            Mari
                            <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                Terhubung
                            </span>
                        </h2>
                        
                        <p class="text-xl text-gray-600 leading-relaxed">
                            Tim support kami siap membantu Anda 24/7. Dapatkan panduan, konsultasi, atau bantuan teknis untuk memaksimalkan pengalaman belajar digital Anda.
                        </p>
                    </div>
                    
                    <div class="space-y-6">
                        <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Email</h4>
                                <p class="text-gray-600">info@sma-muslimin.ac.id</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Telepon</h4>
                                <p class="text-gray-600">(021) 1234-5678</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Alamat</h4>
                                <p class="text-gray-600">Jl. Pendidikan Raya No. 123, Jakarta Selatan</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                            <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Jam Operasional</h4>
                                <p class="text-gray-600">Senin - Jumat: 07:00 - 17:00 WIB</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="relative">
                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-3xl p-8 shadow-xl">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Kirim Pesan</h3>
                        <form id="contact-form" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="text" name="nama" placeholder="Nama Lengkap" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" required>
                                <input type="email" name="email" placeholder="Email" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" required>
                            </div>
                            <select name="kategori" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" required>
                                <option value="">Pilih Kategori</option>
                                <option value="informasi">Informasi Umum</option>
                                <option value="teknis">Bantuan Teknis</option>
                                <option value="akademik">Konsultasi Akademik</option>
                                <option value="kerjasama">Kerjasama</option>
                            </select>
                            <textarea name="pesan" placeholder="Pesan Anda..." rows="4" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none" required></textarea>
                            <button type="submit" class="w-full px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold rounded-xl text-lg transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                                <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@push('scripts')
<script>
    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Stats counter animation
    function animateCounter(element, target, duration = 2000) {
        let current = 0;
        const increment = target / (duration / 16);
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = target;
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current);
            }
        }, 16);
    }

    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-slide-up');

                // Animate stats when hero section is visible
                if (entry.target.id === 'beranda') {
                    setTimeout(() => {
                        animateCounter(document.getElementById('students'), {{ $jumlahSiswa ?? 1200 }});
                        animateCounter(document.getElementById('teachers'), {{ $jumlahGuru ?? 85 }});
                        animateCounter(document.getElementById('courses'), {{ $jumlahMapel ?? 24 }});
                    }, 500);
                }
            }
        });
    }, observerOptions);

    // Observe sections for animations
    document.querySelectorAll('section').forEach(section => {
        observer.observe(section);
    });

    // Parallax effect for floating shapes
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const shapes = document.querySelectorAll('.shape');

        shapes.forEach((shape, index) => {
            const speed = 0.5 + (index * 0.1);
            shape.style.transform = `translateY(${scrolled * speed}px) rotate(${scrolled * 0.1}deg)`;
        });
    });

    // Form submission handler
    const contactForm = document.querySelector('#contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Show success message
            const button = this.querySelector('button[type="submit"]');
            const originalText = button.innerHTML;

            button.innerHTML = `
                <svg class="w-5 h-5 mr-2 inline animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Mengirim...
            `;

            setTimeout(() => {
                button.innerHTML = `
                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Terkirim!
                `;
                button.classList.add('bg-green-500');

                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.classList.remove('bg-green-500');
                    this.reset();
                }, 2000);
            }, 1500);
        });
    }

    // Smooth reveal animations on scroll
    const revealElements = document.querySelectorAll('.feature-card, .testimonial-card');

    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
            }
        });
    }, { threshold: 0.1 });

    revealElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'all 0.6s ease';
        revealObserver.observe(el);
    });
</script>
@endpush