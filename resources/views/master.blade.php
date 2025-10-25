<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title') - SMK Nurul Jadid</title> {{-- Tambahkan nama sekolah untuk SEO --}}
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    {{-- PENTING: Tambahkan CSRF Token untuk AJAX --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('img/logo.png') }}" rel="icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- PERBAIKAN FONT: Gunakan Poppins sesuai halaman lain --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;900&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" /> {{-- Jika Anda pakai Swiper di halaman lain --}}


    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    {{-- TAMBAHKAN CSS UNTUK CHATBOT DI SINI --}}
    <style>
        /* PERBAIKAN FONT: Terapkan Poppins ke body */
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Styling Dasar Chatbot */
        #chatbot-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 320px; /* Lebar chatbox */
            max-width: 90%;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            z-index: 1050; /* Pastikan di atas elemen lain */
            font-size: 0.9rem; /* Ukuran font chat */
        }
        #chatbot-header {
            background-color: var(--primary); /* Warna primer template Anda */
            color: white;
            padding: 10px 15px;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #chatbot-header {
            background-color: var(--primary); 
            color: white;
            padding: 8px 15px; /* Sedikit kurangi padding vertikal */
            font-weight: 600;
            display: flex; /* Aktifkan flexbox */
            justify-content: space-between; /* Nama di kiri, tombol X di kanan */
            align-items: center; /* Ratakan vertikal */
        }

        /* Styling untuk profile (foto + nama) */
        .chatbot-profile {
            display: flex; /* Aktifkan flexbox untuk foto dan nama */
            align-items: center; /* Ratakan vertikal */
        }

        .chatbot-avatar {
            width: 30px; /* Ukuran foto profil */
            height: 30px;
            border-radius: 50%; /* Buat jadi bulat */
            margin-right: 10px; /* Jarak antara foto dan nama */
            object-fit: cover; /* Pastikan gambar terisi rapi */
            border: 1px solid rgba(255, 255, 255, 0.5); /* Optional: border tipis */
        }
        
        #chatbot-close-btn {
            background: none;
            border: none;
            color: white;
            font-size: 1.4rem; /* Sedikit perbesar tombol X */
            cursor: pointer;
            padding: 0 5px; /* Beri sedikit area klik */
            line-height: 1; /* Hapus spasi ekstra di tombol X */
        }

        /* Ubah nama bot di pesan */
        #chat-messages p strong { 
             color: var(--primary);
             display: block; 
             margin-bottom: 2px;
             font-size: 0.8em;
        }
        #chatbot-close-btn {
            background: none;
            border: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
        }
        #chat-messages {
            height: 300px; /* Tinggi area pesan */
            overflow-y: auto; /* Aktifkan scroll jika pesan panjang */
            padding: 15px;
            border-bottom: 1px solid #eee;
            background-color: #f9f9f9;
        }
        #chat-messages p {
            margin-bottom: 10px;
            line-height: 1.4;
        }
        #chat-messages p strong { /* Nama pengirim */
             color: var(--primary);
             display: block; /* Agar nama di baris sendiri */
             margin-bottom: 2px;
             font-size: 0.8em;
        }
        #chatbot-input-area {
            display: flex;
            border-top: 1px solid #eee;
        }
        #chat-input {
            flex-grow: 1;
            border: none;
            padding: 12px 15px;
            outline: none; /* Hilangkan border saat diklik */
        }
        #chat-send {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 0 18px;
            cursor: pointer;
            font-size: 1rem;
        }
         #chat-send:disabled {
             background-color: #ccc;
             cursor: not-allowed;
         }
        /* Tombol Toggle Chatbot (Ikon Bulat) */
         #chatbot-toggle-button {
             position: fixed;
             bottom: 20px;
             right: 20px;
             width: 50px;
             height: 50px;
             background-color: var(--primary);
             color: white;
             border-radius: 50%;
             border: none;
             display: flex;
             align-items: center;
             justify-content: center;
             font-size: 1.5rem;
             box-shadow: 0 2px 10px rgba(0,0,0,0.2);
             cursor: pointer;
             z-index: 1049; /* Sedikit di bawah chatbox */
             transition: transform 0.3s ease;
         }
         #chatbot-toggle-button:hover {
             transform: scale(1.1);
         }
         /* Sembunyikan container chatbox awalnya */
         #chatbot-container {
             display: none;
         }
    </style>

    @stack('styles') {{-- Untuk menambahkan CSS spesifik per halaman jika perlu --}}

</head>

<body>
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items: center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    @include('components/navbar')

    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">@yield('title')</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="{{ route('beranda') }}">Beranda</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">@yield('title')</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    {{-- KONTEN UTAMA HALAMAN --}}
    @yield('content')

    @include('components/footer')
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    {{-- TAMBAHKAN HTML CHATBOT DI SINI --}}
    <button id="chatbot-toggle-button">
        <i class="fas fa-comments"></i> {{-- Ganti ikon jika perlu --}}
    </button>
    
    <div id="chatbot-container">
        <div id="chatbot-header">
            {{-- Tambahkan div untuk foto dan nama --}}
            <div class="chatbot-profile"> 
                <img src="{{ asset('img/logo.png') }}" alt="SMKNJ Bot" class="chatbot-avatar"> {{-- Ganti path jika perlu --}}
                <span>SMKNJ Bot</span> {{-- Nama bot --}}
            </div>
            <button id="chatbot-close-btn">&times;</button>
        </div>
        <div id="chat-messages">
            {{-- Pesan Selamat Datang Awal --}}
            <p><strong>SMKNJ Bot:</strong> Halo! Ada yang bisa saya bantu seputar SMK Nurul Jadid?</p>
        </div>
        <div id="chatbot-input-area">
            <input type="text" id="chat-input" placeholder="Ketik pertanyaan...">
            <button id="chat-send"><i class="fa fa-paper-plane"></i></button>
        </div>
    </div>
    {{-- AKHIR HTML CHATBOT --}}


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script> {{-- Jika Anda pakai Swiper di halaman lain --}}


    <script src="{{ asset('js/main.js') }}"></script>

    {{-- TAMBAHKAN JAVASCRIPT CHATBOT DI SINI --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatContainer = document.getElementById('chatbot-container');
            const chatBox = document.getElementById('chat-messages');
            const chatInput = document.getElementById('chat-input');
            const chatSendBtn = document.getElementById('chat-send');
            const toggleBtn = document.getElementById('chatbot-toggle-button');
            const closeBtn = document.getElementById('chatbot-close-btn');
            
            // Fungsi untuk membuka chatbox
            function openChatbox() {
                chatContainer.style.display = 'flex';
                toggleBtn.style.display = 'none'; // Sembunyikan tombol bulat
                chatInput.focus();
            }

            // Fungsi untuk menutup chatbox
            function closeChatbox() {
                chatContainer.style.display = 'none';
                toggleBtn.style.display = 'block'; // Tampilkan lagi tombol bulat
            }
            
            // Event listener untuk tombol toggle dan close
            toggleBtn.addEventListener('click', openChatbox);
            closeBtn.addEventListener('click', closeChatbox);

            // Event listener untuk tombol kirim dan Enter
            chatSendBtn.addEventListener('click', sendMessage);
            chatInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    sendMessage();
                }
            });

            async function sendMessage() {
                const message = chatInput.value.trim();
                if (message === '') return;

                appendMessage('user', message); // Tampilkan pesan user
                chatInput.value = ''; // Kosongkan input
                chatInput.disabled = true; // Nonaktifkan input saat menunggu
                chatSendBtn.disabled = true;
                appendMessage('bot', '<i>Mengetik...</i>'); // Tampilkan indikator loading

                try {
                    const response = await fetch('/ai-chat', { // Panggil route Laravel
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Ambil CSRF token
                        },
                        body: JSON.stringify({ message: message }) // Kirim data sebagai JSON
                    });

                    // Hapus indikator loading
                    const typingIndicator = chatBox.querySelector('p:last-child > i');
                    if (typingIndicator && typingIndicator.textContent === 'Mengetik...') {
                        typingIndicator.closest('p').remove();
                    }
                    
                    const data = await response.json();

                    if (!response.ok) {
                    // Tampilkan pesan error dari Laravel jika status bukan 2xx
                    appendMessage('bot', `Error ${response.status}: ${data.reply || 'Gagal memproses permintaan.'}`);
                    } else {
                    appendMessage('bot', data.reply); // Tampilkan balasan AI
                    }

                } catch (error) {
                    // Hapus indikator loading jika masih ada
                    const typingIndicator = chatBox.querySelector('p:last-child > i');
                    if (typingIndicator && typingIndicator.textContent === 'Mengetik...') {
                        typingIndicator.closest('p').remove();
                    }
                    console.error("Error sending chat:", error);
                    appendMessage('bot', 'Gagal terhubung ke server. Periksa koneksi Anda.');
                } finally {
                    chatInput.disabled = false; // Aktifkan input lagi
                    chatSendBtn.disabled = false;
                    chatInput.focus();
                }
            }

            function appendMessage(sender, text) {
                const messageElement = document.createElement('p');
                // Tambahkan class untuk styling berbeda (opsional)
                // messageElement.classList.add(sender === 'user' ? 'user-message' : 'bot-message');
                messageElement.innerHTML = `<strong>${sender === 'user' ? 'Anda' : 'NJ-Bot'}:</strong> ${text}`; 
                chatBox.appendChild(messageElement);
                chatBox.scrollTop = chatBox.scrollHeight; // Auto scroll ke bawah
            }
        });
    </script>
    {{-- AKHIR JAVASCRIPT CHATBOT --}}

    @stack('scripts') {{-- Untuk menambahkan JS spesifik per halaman jika perlu --}}

</body>
</html>