<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SMK Nurul Jadid</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <link href="{{ asset('img/logo.png') }}" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

<style>
        :root {
            --accent-color: #ffc107;
            --text-light: #ffffff;
            --text-dark: #212529;
        }
        body { font-family: 'Poppins', sans-serif; }
        .hero-section { position: relative; width: 100%; height: 100vh; overflow: hidden; }
        .main-slider { width: 100%; height: 100%; }
        .main-slider .swiper-slide { background-size: cover; background-position: center; }
        .main-slider .swiper-slide::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(24, 29, 56, 0.7); }
        .text-content { position: absolute; top: 50%; left: 10%; transform: translateY(-50%); color: var(--text-light); width: 90%; max-width: 600px; z-index: 5; opacity: 0; transform: translateY(-30px); transition: all 0.8s ease; }
        .swiper-slide-active .text-content { opacity: 1; transform: translateY(-50%); }
        .text-content .subtitle { font-size: 1.2rem; font-weight: 300; margin-bottom: 0; }
        .text-content .title { font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 900; line-height: 1.1; margin-top: 5px; text-transform: uppercase; color: #ffffff !important;}
        .text-content .description { font-size: 1rem; font-weight: 300; margin-top: 20px; max-width: 80%; }
        .btn-discover { display: inline-block; margin-top: 30px; padding: 12px 30px; background-color: var(--accent-color); color: var(--text-dark); text-decoration: none; font-weight: 600; border-radius: 5px; transition: background-color 0.3s ease; }
        .progress-bar-container { width: 150px; height: 3px; background-color: rgba(255, 255, 255, 0.3); margin-top: 30px; }
        .progress-bar { width: 0; height: 100%; background-color: var(--accent-color); }
        .swiper-slide-active .progress-bar { width: 100%; transition: width 5s linear; }
        .slide-counter { position: absolute; bottom: 40px; right: 50px; color: var(--text-light); font-size: clamp(3rem, 8vw, 4rem); font-weight: 200; z-index: 5; }
        .navbar { z-index: 999 !important; }

        /* Gaya Tumpukan Kartu untuk Desktop */
        .card-stack-container { position: absolute; bottom: 28%; right: 10%; width: 500px; height: 360px; z-index: 10; perspective: 1000px; transition: all 0.4s ease; }
        .card-stack-item { position: absolute; width: 100%; height: 100%; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2); cursor: pointer; transition: all 0.6s cubic-bezier(0.25, 0.8, 0.25, 1); }
        .card-stack-item img { width: 100%; height: 100%; object-fit: cover; }
        .card-stack-item[data-stack-pos="0"] { transform: translate(0, 0) scale(1); opacity: 1; z-index: 3; }
        .card-stack-item[data-stack-pos="1"] { transform: translate(30px, -15px) scale(0.9); opacity: 0.7; z-index: 2; }
        .card-stack-item[data-stack-pos="2"] { transform: translate(60px, -30px) scale(0.8); opacity: 0.5; z-index: 1; }
        .card-stack-item:not([data-stack-pos="0"]):not([data-stack-pos="1"]):not([data-stack-pos="2"]) { transform: translateX(150px) scale(0.7); opacity: 0; z-index: 0; }
        .card-stack-item.is-promoting { transform: scale(8) translate(-15%, -15%); opacity: 0; z-index: 20; }

        /* --- CSS UNTUK TOMBOL CLOSE CHATBOT --- */
        #close-chatbot-button {
            position: fixed;
            bottom: 80px;  /* Posisikan 80px dari bawah */
            right: 15px;   /* Posisikan 15px dari kanan */
            width: 25px;
            height: 25px;
            background-color: #FEA116; /* Warna oranye (sesuai tema) */
            color: #0F172B; /* Warna teks gelap (sesuai tema) */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            border: 2px solid white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            z-index: 2147483647; 
        }

        #close-chatbot-button:hover {
            background-color: #fca92a;
        }

        iframe[id="chatbase-iframe"] {
            background: transparent !important;
            backdrop-filter: none !important;
        }

        /* =================================================== */
        /* == PERBAIKAN TOTAL UNTUK RESPONSIVE == */
        /* =================================================== */

        /* Untuk Tablet (di bawah 992px) */
        @media (max-width: 992px) {
            .text-content { left: 5%; }
            .card-stack-container { width: 180px; height: 225px; right: 5%; bottom: 5%; }
        }

        /* Untuk Ponsel (di bawah 768px) - METODE FLEXBOX */
        @media (max-width: 768px) {
            .card-stack-container, .slide-counter {
                display: none; /* Sembunyikan tumpukan kartu & counter */
            }
            .main-slider .swiper-slide {
                display: flex;
                justify-content: center; /* Horizontally center */
                align-items: center;     /* Vertically center */
                text-align: center;      /* Center text inside */
            }
            .text-content {
                position: static; /* Hapus positioning absolute */
                transform: none !important; /* Hapus semua transform */
                left: auto;
                top: auto;
                width: 90%;
                max-width: 400px;
                opacity: 0; /* Tetap gunakan opacity untuk animasi fade-in */
                transition: opacity 0.8s ease;
            }
            .swiper-slide-active .text-content {
                opacity: 1;
            }
            .text-content .description,
            .progress-bar-container {
                margin-left: auto; /* Trik untuk sentering elemen block */
                margin-right: auto;
            }
        }
    </style>
</head>
<body>
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"><span class="sr-only">Loading...</span></div>
    </div>

    @include('components/navbar')
    @include('components/home-slider')
    @include('components/home-service')
    @include('components/home-greeting')
    @include('components/home-breaking-news')
    @include('components/akses-video')
    {{-- @include('components.home-testimonial') --}}
    @include('components/home-kalimatu')
    @include('components/footer')
    
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <div id="close-chatbot-button">X</div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            // --- KODE UNTUK SLIDER ---
            const autoplayDelay = 5000;
            const cards = document.querySelectorAll('.card-stack-item');
            const totalSlides = cards.length;

            function updateCardStack(activeIndex) {
                cards.forEach((card, index) => {
                    let pos = (index - activeIndex + totalSlides) % totalSlides;
                    card.dataset.stackPos = pos;
                });
            }

            const mainSlider = new Swiper('.main-slider', {
                loop: true,
                speed: 800,
                effect: 'fade',
                fadeEffect: { crossFade: true },
                autoplay: { delay: autoplayDelay, disableOnInteraction: false },
            });
            
            mainSlider.on('slideChangeTransitionStart', function () {
                const currentRealIndex = mainSlider.realIndex;
                const previousRealIndex = (currentRealIndex - 1 + totalSlides) % totalSlides;
                const promotingCard = document.querySelector(`.card-stack-item[data-index="${previousRealIndex}"]`);
                if (promotingCard) {
                    promotingCard.classList.add('is-promoting');
                    setTimeout(() => {
                        promotingCard.classList.remove('is-promoting');
                    }, 800);
                }
            });
            
            mainSlider.on('slideChange', function () {
                updateCardStack(mainSlider.realIndex);
                updateCounter();
            });
            
            const slideCounter = document.querySelector('.current-slide');
            function updateCounter() {
                // Perbaikan: Tambahkan pengecekan jika elemen ada
                if (slideCounter) { 
                    let currentSlideIndex = mainSlider.realIndex + 1;
                    slideCounter.textContent = currentSlideIndex < 10 ? '0' + currentSlideIndex : currentSlideIndex;
                }
            }
            
            updateCardStack(mainSlider.realIndex);
            updateCounter();
            // --- AKHIR KODE SLIDER ---


            // --- KODE UNTUK TOMBOL CLOSE CHATBOT ---
            const closeBtn = document.getElementById('close-chatbot-button');
            
            if (closeBtn) {
                closeBtn.addEventListener('click', function() {
                    const chatWidget = document.getElementById('chatbase-bubble-container');
                    
                    if (chatWidget) {
                        chatWidget.style.display = 'none'; 
                        closeBtn.style.display = 'none'; 
                    } else {
                        const chatIframe = document.querySelector('iframe[src*="chatbase.co"]');
                        if (chatIframe) {
                            chatIframe.style.display = 'none';
                            closeBtn.style.display = 'none';
                        } else {
                            // Nonaktifkan alert agar tidak mengganggu jika user mengklik terlalu cepat
                            console.log("Chatbot element not found yet.");
                        }
                    }
                });
            }
            // --- AKHIR KODE CLOSE CHATBOT ---

        }); // <-- AKHIR DARI BLOK DOMContentLoaded
    </script>
    <script>
        (function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="EK0gD7wvnCsG2mVKF1WQ4";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
    </script>
    
    <script>
        window.chatbaseConfig = {
            chatbotId: "93cfple2gp7a19f3j36p4asxr07bfb3a"
        }
        </script>
        <script
        src="https://www.chatbase.co/embed.min.js"
        id="93cfple2gp7a19f3j36p4asxr07bfb3a"
        defer>
    </script>
    </body>
</html>