<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Animated background particles */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .particle:nth-child(1) { width: 20px; height: 20px; left: 10%; animation-delay: 0s; }
        .particle:nth-child(2) { width: 15px; height: 15px; left: 20%; animation-delay: 1s; }
        .particle:nth-child(3) { width: 25px; height: 25px; left: 30%; animation-delay: 2s; }
        .particle:nth-child(4) { width: 18px; height: 18px; left: 40%; animation-delay: 3s; }
        .particle:nth-child(5) { width: 22px; height: 22px; left: 50%; animation-delay: 4s; }
        .particle:nth-child(6) { width: 16px; height: 16px; left: 60%; animation-delay: 5s; }
        .particle:nth-child(7) { width: 28px; height: 28px; left: 70%; animation-delay: 0.5s; }
        .particle:nth-child(8) { width: 14px; height: 14px; left: 80%; animation-delay: 1.5s; }

        @keyframes float {
            0%, 100% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-100px) rotate(360deg); opacity: 0; }
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 2rem 1.5rem;
            text-align: center;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            max-width: 95vw;
            width: 100%;
            max-height: 95vh;
            overflow-y: auto;
            z-index: 10;
            position: relative;
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-code {
            font-size: 4rem;
            font-weight: 900;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
            line-height: 1;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .error-svg {
            width: 120px;
            height: 120px;
            margin: 0.5rem auto 1rem;
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .error-svg:hover {
            transform: scale(1.1) rotate(5deg);
        }

        .error-title {
            font-size: 1.4rem;
            color: #2d3748;
            margin-bottom: 0.8rem;
            font-weight: 700;
        }

        .error-message {
            font-size: 0.95rem;
            color: #4a5568;
            margin-bottom: 1.5rem;
            line-height: 1.5;
        }

        .buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 10px 18px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: rgba(45, 55, 72, 0.1);
            color: #2d3748;
            border: 2px solid rgba(45, 55, 72, 0.2);
        }

        .btn-secondary:hover {
            background: rgba(45, 55, 72, 0.2);
            transform: translateY(-2px);
        }

        .joke-section {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        .joke-text {
            font-style: italic;
            color: #666;
            margin-bottom: 0.8rem;
            min-height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }

        .joke-btn {
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
            color: white;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.8rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .joke-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
        }

        @media (max-width: 768px) {
            .container {
                padding: 1.5rem 1rem;
                margin: 1rem;
                border-radius: 16px;
            }
            
            .error-code {
                font-size: 3rem;
            }
            
            .error-title {
                font-size: 1.2rem;
            }
            
            .error-message {
                font-size: 0.9rem;
            }
            
            .error-svg {
                width: 100px;
                height: 100px;
            }
            
            .buttons {
                flex-direction: column;
                gap: 0.8rem;
            }

            .btn {
                font-size: 0.85rem;
                padding: 8px 16px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 1rem;
                margin: 0.5rem;
            }
            
            .error-code {
                font-size: 2.5rem;
            }

            .error-title {
                font-size: 1.1rem;
            }

            .error-message {
                font-size: 0.85rem;
            }
            
            .error-svg {
                width: 80px;
                height: 80px;
            }
        }

        .loading {
            opacity: 0.6;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <div class="container">
        <div class="error-code">404</div>
        
        <div class="error-svg" id="errorSvg" onclick="animateSvg()">
            <!-- Cute Lost Cat SVG -->
            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient id="catGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#ff9a56;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#ffecd2;stop-opacity:1" />
                    </linearGradient>
                    <linearGradient id="heartGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#ff6b6b;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#ff8e8e;stop-opacity:1" />
                    </linearGradient>
                </defs>
                
                <!-- Cat Body -->
                <ellipse cx="100" cy="130" rx="45" ry="35" fill="url(#catGradient)" />
                
                <!-- Cat Head -->
                <circle cx="100" cy="85" r="35" fill="url(#catGradient)" />
                
                <!-- Cat Ears -->
                <ellipse cx="80" cy="60" rx="12" ry="20" fill="url(#catGradient)" transform="rotate(-30 80 60)" />
                <ellipse cx="120" cy="60" rx="12" ry="20" fill="url(#catGradient)" transform="rotate(30 120 60)" />
                
                <!-- Inner Ears -->
                <ellipse cx="82" cy="62" rx="6" ry="12" fill="#ff6b6b" transform="rotate(-30 82 62)" />
                <ellipse cx="118" cy="62" rx="6" ry="12" fill="#ff6b6b" transform="rotate(30 118 62)" />
                
                <!-- Cat Eyes -->
                <ellipse cx="90" cy="80" rx="8" ry="12" fill="#2d3748" class="cat-eye" />
                <ellipse cx="110" cy="80" rx="8" ry="12" fill="#2d3748" class="cat-eye" />
                
                <!-- Eye highlights -->
                <circle cx="88" cy="76" r="3" fill="#fff" />
                <circle cx="108" cy="76" r="3" fill="#fff" />
                
                <!-- Cat Nose -->
                <path d="M 100 90 L 95 95 L 105 95 Z" fill="#ff6b6b" />
                
                <!-- Cat Mouth -->
                <path d="M 100 95 Q 95 105 90 100" stroke="#2d3748" stroke-width="2" fill="none" class="cat-mouth" />
                <path d="M 100 95 Q 105 105 110 100" stroke="#2d3748" stroke-width="2" fill="none" class="cat-mouth" />
                
                <!-- Cat Whiskers -->
                <line x1="60" y1="85" x2="75" y2="82" stroke="#2d3748" stroke-width="2" class="whisker" />
                <line x1="60" y1="95" x2="75" y2="95" stroke="#2d3748" stroke-width="2" class="whisker" />
                <line x1="125" y1="82" x2="140" y2="85" stroke="#2d3748" stroke-width="2" class="whisker" />
                <line x1="125" y1="95" x2="140" y2="95" stroke="#2d3748" stroke-width="2" class="whisker" />
                
                <!-- Cat Tail -->
                <path d="M 140 140 Q 165 120 170 90 Q 175 70 165 50" stroke="url(#catGradient)" stroke-width="15" fill="none" class="cat-tail" />
                
                <!-- Cat Paws -->
                <ellipse cx="80" cy="160" rx="8" ry="12" fill="url(#catGradient)" />
                <ellipse cx="120" cy="160" rx="8" ry="12" fill="url(#catGradient)" />
                
                <!-- Paw pads -->
                <ellipse cx="80" cy="165" rx="4" ry="6" fill="#ff6b6b" />
                <ellipse cx="120" cy="165" rx="4" ry="6" fill="#ff6b6b" />
                
                <!-- Floating hearts -->
                <path d="M 160 40 C 160 35, 165 30, 170 30 C 175 30, 180 35, 180 40 C 180 50, 170 60, 170 60 C 170 60, 160 50, 160 40 Z" fill="url(#heartGradient)" class="floating-heart" />
                <path d="M 30 110 C 30 107, 33 104, 36 104 C 39 104, 42 107, 42 110 C 42 116, 36 122, 36 122 C 36 122, 30 116, 30 110 Z" fill="url(#heartGradient)" class="floating-heart" />
                
                <!-- Question mark -->
                <text x="25" y="50" font-family="Arial" font-size="24" fill="#667eea" class="question-mark">?</text>
            </svg>
        </div>
        
        <h1 class="error-title">Oops! Halaman Tidak Ditemukan</h1>
        <p class="error-message">
            Sepertinya halaman yang Anda cari sedang bermain petak umpet dengan server kami. 
            Jangan khawatir, mari kita bantu Anda menemukan jalan pulang!
        </p>
        
        <div class="buttons">
            <a href="/" class="btn btn-primary" id="homeBtn">
                🏠 Kembali ke Beranda
            </a>
            <button class="btn btn-secondary" onclick="goBack()">
                ← Halaman Sebelumnya
            </button>
        </div>
        
        <div class="joke-section">
            <div class="joke-text" id="jokeText">Klik tombol di bawah untuk joke programmer! 😄</div>
            <button class="joke-btn" onclick="getRandomJoke()">Joke Baru! 🎭</button>
        </div>
    </div>

    <script>
        // Array of programmer jokes in Indonesian
        const jokes = [
            "Mengapa programmer suka kopi? Karena tanpa kopi, code-nya jadi de-coffee-nated! ☕",
            "Apa bedanya bug dan feature? Bug adalah feature yang belum didokumentasikan! 🐛",
            "Mengapa 404 error selalu sedih? Karena dia tidak pernah ditemukan! 😢",
            "Apa yang dilakukan programmer saat lapar? Makan cookie dari browser! 🍪",
            "Mengapa array dimulai dari 0? Karena programmer terlalu malas untuk mulai dari 1! 😴",
            "Apa yang paling menakutkan bagi programmer? Deadline yang lebih cepat dari internet kantor! ⚡",
            "Mengapa programmer tidak suka keluar rumah? Karena di luar ada terlalu banyak bug! 🏠",
            "Apa itu infinite loop? Baca joke ini lagi dari awal! ♾️"
        ];

        let currentJokeIndex = -1;

        function getRandomJoke() {
            const jokeText = document.getElementById('jokeText');
            const jokeBtn = document.querySelector('.joke-btn');
            
            // Add loading state
            jokeBtn.classList.add('loading');
            jokeText.innerHTML = "Sedang mencari joke... 🤔";
            
            setTimeout(() => {
                let newIndex;
                do {
                    newIndex = Math.floor(Math.random() * jokes.length);
                } while (newIndex === currentJokeIndex && jokes.length > 1);
                
                currentJokeIndex = newIndex;
                jokeText.innerHTML = jokes[currentJokeIndex];
                jokeBtn.classList.remove('loading');
            }, 1000);
        }

        function goBack() {
            if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = '/';
            }
        }

        function animateSvg() {
            const svg = document.getElementById('errorSvg');
            const eyes = svg.querySelectorAll('.cat-eye');
            const hearts = svg.querySelectorAll('.floating-heart');
            const questionMark = svg.querySelector('.question-mark');
            const tail = svg.querySelector('.cat-tail');
            const whiskers = svg.querySelectorAll('.whisker');
            
            // Animate cat eyes (blink effect)
            eyes.forEach(eye => {
                eye.style.transition = 'all 0.3s ease';
                eye.setAttribute('ry', '2');
                setTimeout(() => {
                    eye.setAttribute('ry', '12');
                }, 150);
            });
            
            // Animate hearts (scale up)
            hearts.forEach((heart, index) => {
                heart.style.transition = 'transform 0.5s ease';
                heart.style.transformOrigin = 'center';
                setTimeout(() => {
                    heart.style.transform = 'scale(1.3)';
                    setTimeout(() => {
                        heart.style.transform = 'scale(1)';
                    }, 300);
                }, index * 100);
            });
            
            // Animate question mark
            questionMark.style.transform = 'rotate(360deg) scale(1.5)';
            questionMark.style.transition = 'transform 0.6s ease';
            questionMark.style.fill = '#ff6b6b';
            
            setTimeout(() => {
                questionMark.style.transform = 'rotate(0deg) scale(1)';
                questionMark.style.fill = '#667eea';
            }, 600);

            // Animate tail (wag effect)
            tail.style.transition = 'transform 0.3s ease';
            tail.style.transformOrigin = '140px 140px';
            tail.style.transform = 'rotate(10deg)';
            
            setTimeout(() => {
                tail.style.transform = 'rotate(-5deg)';
                setTimeout(() => {
                    tail.style.transform = 'rotate(0deg)';
                }, 150);
            }, 150);

            // Animate whiskers
            whiskers.forEach((whisker, index) => {
                whisker.style.transition = 'transform 0.2s ease';
                setTimeout(() => {
                    whisker.style.transform = 'scaleX(1.2)';
                    setTimeout(() => {
                        whisker.style.transform = 'scaleX(1)';
                    }, 200);
                }, index * 50);
            });
        }

        // Add floating animation to hearts
        function animateFloatingHearts() {
            const hearts = document.querySelectorAll('.floating-heart');
            hearts.forEach((heart, index) => {
                heart.style.animation = `floatHeart 3s ease-in-out infinite ${index * 0.5}s`;
            });
        }

        // Add CSS animation for floating hearts
        const style = document.createElement('style');
        style.textContent = `
            @keyframes floatHeart {
                0%, 100% { transform: translateY(0px) scale(1); }
                50% { transform: translateY(-8px) scale(1.1); }
            }
            
            .floating-heart {
                animation: floatHeart 2.5s ease-in-out infinite;
            }

            .cat-tail {
                animation: tailSway 4s ease-in-out infinite;
            }

            @keyframes tailSway {
                0%, 100% { transform: rotate(0deg); }
                25% { transform: rotate(5deg); }
                75% { transform: rotate(-3deg); }
            }
        `;
        document.head.appendChild(style);

        // Initialize animations
        animateFloatingHearts();

        // Add click counter for easter egg
        let clickCount = 0;
        document.addEventListener('click', () => {
            clickCount++;
            if (clickCount === 10) {
                alert('🎉 Easter Egg! Anda telah mengklik 10 kali! Selamat, Anda adalah click master! 🎉');
                clickCount = 0;
            }
        });

        // Add keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                document.getElementById('homeBtn').click();
            } else if (e.key === 'Escape') {
                goBack();
            } else if (e.key === ' ') {
                e.preventDefault();
                getRandomJoke();
            }
        });
    </script>
</body>
</html>