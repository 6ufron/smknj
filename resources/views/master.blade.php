<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title') - SMK Nurul Jadid</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('img/logo.png') }}" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> {{-- Use 5.15.4 for fas fa-bars --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <style>
        /* == CSS CHATBOT == */
        :root {
             --primary: #06A3DA; /* Sesuaikan warna primer Anda */
        }
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Wrapper Utama */
        #chatbot-wrapper {
            position: fixed; bottom: 20px; right: 20px;
            width: 600px; height: 450px; /* Lebar total awal (Sidebar 180 + Chat 420) */
            max-width: 95%; max-height: 80vh;
            background-color: #f8f9fa;
            border-radius: 10px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.25);
            overflow: hidden; display: none; /* Awalnya disembunyikan */
            flex-direction: row; z-index: 1050;
            transition: width 0.3s ease-in-out; /* Animasi perubahan lebar wrapper */
        }

        /* Sidebar History (Tema Terang) */
        #chatbot-sidebar {
            width: 180px; /* Lebar awal */
            background-color: #f1f3f5; /* Warna background terang */
            color: #495057; /* Warna teks gelap */
            padding: 15px; display: flex; flex-direction: column;
            border-right: 1px solid #dee2e6; /* Border terang */
            font-size: 0.85rem; flex-shrink: 0;
            transition: width 0.3s ease-in-out, padding 0.3s ease-in-out; /* Transisi lebar & padding */
            position: relative;
            overflow: hidden; /* Sembunyikan konten saat menyempit */
        }

        /* Tombol Toggle Sidebar */
        #sidebar-toggle-button {
            background: none; border: 1px solid #ced4da; color: #495057;
            padding: 5px 8px; border-radius: 5px; cursor: pointer;
            position: absolute; /* Posisi di kanan atas */
            top: 10px; right: 10px; z-index: 2;
            transition: background-color 0.2s ease, color 0.2s ease, right 0.3s ease-in-out, top 0.3s ease-in-out, position 0s linear 0.3s; /* Transisi */
        }
        #sidebar-toggle-button:hover { background-color: #e9ecef; color: #212529; }

        /* Konten Sidebar */
        #new-chat-button, #chat-history-list {
            /* Transisi fade out/in */
            transition: opacity 0.2s ease-out, visibility 0.2s ease-out;
            opacity: 1;
            visibility: visible;
        }

        /* Styling untuk judul sidebar */
        .sidebar-title {
            color: #5b5b5b; /* Warna putih */
            text-align: left; /* Tengah */
            font-weight: 600;
            margin-top: 0px; /* Sedikit jarak atas */
            margin-bottom: 0px; /* Jarak ke tombol New Chat */
            font-size: 1rem;
            /* Pastikan terlihat saat sidebar normal */
             transition: opacity 0.2s ease-out 0.1s, visibility 0.2s ease-out 0.1s;
             opacity: 1;
             visibility: visible;
        }

        /* Logo di sidebar */
        .sidebar-logo {
            height: 22px; /* Sesuaikan ukuran logo */
            width: auto;
            margin-right: 6px;
            vertical-align: middle;
        }

        #new-chat-button {
            width: calc(100% - 40px); /* Beri ruang untuk tombol toggle di atasnya */
            margin-top: 25px;
            border-color: #ced4da; color: #495057; background-color: white;
        }

        /* Sembunyikan judul saat sidebar collapsed */
        #chatbot-wrapper.sidebar-hidden .sidebar-title {
            opacity: 0;
            visibility: hidden;
            height: 0;
            margin: 0;
            padding: 0;
            transition-delay: 0s;
        }

        #new-chat-button:hover { background-color: #e9ecef; color: #212529; }
        #chat-history-list { flex-grow: 1; overflow-y: auto; margin-top: 15px; }
        .history-item { /* Style history */
             padding: 8px 10px; margin-bottom: 5px; border-radius: 5px;
             cursor: pointer; white-space: nowrap; overflow: hidden;
             text-overflow: ellipsis; transition: background-color 0.2s ease; color: #495057;
        }
        .history-item:hover { background-color: #e9ecef; color: #212529; }
        .history-item.active { background-color: var(--primary); color: white; font-weight: 500; }

        /* State Sidebar Disembunyikan (Collapsed) */
        #chatbot-wrapper.sidebar-hidden {
            width: 470px; /* Lebar wrapper = lebar kontainer chat (420) + lebar sidebar collapsed (50) */
        }
        #chatbot-wrapper.sidebar-hidden #chatbot-sidebar {
            width: 50px; /* Lebar sidebar menyempit */
            padding-left: 5px; padding-right: 5px; /* Padding lebih kecil */
            border-right-color: transparent; /* Sembunyikan border */
            background-color: #f1f3f5; 
        }
        #chatbot-wrapper.sidebar-hidden #sidebar-toggle-button {
             position: static; 
             margin: 5px auto 15px auto; /* Tengah */
             align-self: center;
             display: block; /* Pastikan terlihat */
             
        }
        #chatbot-wrapper.sidebar-hidden #new-chat-button,
        #chatbot-wrapper.sidebar-hidden #chat-history-list {
            opacity: 0; visibility: hidden; height: 0; margin: 0; padding: 0; /* Sembunyikan total */
            transition-delay: 0s; /* Hilang langsung */
        }

        /* Kontainer Chat Utama */
        #chatbot-container {
            width: 420px; /* Lebar kontainer chat tetap */
            flex-grow: 1; display: flex; flex-direction: column; background-color: white;
            flex-shrink: 0;
            /* Tidak perlu transisi margin */
        }

        /* Header Chat */
        #chatbot-header {
            background-color: var(--primary); color: white; padding: 8px 15px;
            font-weight: 600; display: flex; justify-content: space-between; align-items: center;
            flex-shrink: 0;
        }
        .chatbot-profile { display: flex; align-items: center; }
        .chatbot-avatar {
            width: 30px; height: 30px; border-radius: 50%; margin-right: 10px;
            object-fit: cover; border: 1px solid rgba(255, 255, 255, 0.5);
        }
        #chatbot-close-btn {
            background: none; border: none; color: white; font-size: 1.4rem;
            cursor: pointer; padding: 0 5px; line-height: 1;
        }

        /* Area Pesan */
        #chat-messages {
            flex-grow: 1; overflow-y: auto; padding: 15px; background-color: #f9f9f9; height: auto;
        }
        #chat-messages p { margin-bottom: 10px; line-height: 1.4; font-size: 0.9rem;}
        #chat-messages p strong { color: var(--primary); display: block; margin-bottom: 2px; font-size: 0.8em; }

        /* Area Input */
        #chatbot-input-area { display: flex; border-top: 1px solid #eee; flex-shrink: 0; }
        #chat-input { flex-grow: 1; border: none; padding: 12px 15px; outline: none; }
        #chat-send {
            background-color: var(--primary); color: white; border: none;
            padding: 0 18px; cursor: pointer; font-size: 1rem;
        }
        #chat-send:disabled { background-color: #ccc; cursor: not-allowed; }

        /* Tombol Toggle Bulat */
        #chatbot-toggle-button {
             position: fixed; bottom: 20px; right: 20px; width: 50px; height: 50px;
             background-color: var(--primary); color: white; border-radius: 50%; border: none;
             display: flex; align-items: center; justify-content: center; font-size: 1.5rem;
             box-shadow: 0 2px 10px rgba(0,0,0,0.2); cursor: pointer; z-index: 1049;
             transition: transform 0.3s ease;
         }
         #chatbot-toggle-button:hover { transform: scale(1.1); }

         /* Responsive */
         @media (max-width: 768px) {
            #chatbot-wrapper {
                width: calc(100% - 30px); height: 75vh; right: 15px; bottom: 15px;
                /* Pastikan sidebar-hidden class tidak aktif di mobile jika sidebar disembunyikan total */
                &.sidebar-hidden { width: calc(100% - 30px); } 
            }
             #chatbot-sidebar, #sidebar-toggle-button {
                 display: none; /* Sembunyikan sidebar & tombolnya di mobile */
             }
             #chatbot-container {
                 width: 100%; /* Kontainer chat ambil lebar penuh di mobile */
             }
            #chatbot-toggle-button { width: 45px; height: 45px; font-size: 1.3rem;}
         }
        /* == AKHIR CSS CHATBOT == */
    </style>

    @stack('styles')

</head>

<body>
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
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

    @yield('content') {{-- KONTEN UTAMA HALAMAN --}}

    @include('components/footer')
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    {{-- == HTML CHATBOT NJ-BOT (DENGAN SIDEBAR & TOGGLE) == --}}
    <button id="chatbot-toggle-button"> <i class="fas fa-comments"></i> </button>
    <div id="chatbot-wrapper"> {{-- Awalnya display: none; --}}
        <div id="chatbot-sidebar">
            <button id="sidebar-toggle-button" title="Toggle Sidebar">
                <i class="fas fa-bars"></i> {{-- Default ikon hamburger --}}
            </button>
            <h4 class="sidebar-title">
                <img src="{{ asset('img/logo.png') }}" class="sidebar-logo" alt="Logo SMK">
                    SMKNJ Bot
            </h4>
            <button id="new-chat-button" class="btn btn-outline-light btn-sm mb-3">
                <i class="fas fa-plus me-1"></i>
                    New Chat
            </button>
            <div id="chat-history-list">
                <p class="text-muted small text-center">
                    Loading history...</p>
            </div>
        </div>
        <div id="chatbot-container">
            <div id="chatbot-header">
                <div class="chatbot-profile">
                    <img src="{{ asset('img/logo.png') }}" alt="SMKNJ Bot" class="chatbot-avatar">
                    <span>SMKNJ Bot</span>
                </div>
                <button id="chatbot-close-btn">&times;</button>
            </div>
            <div id="chat-messages">
                <p><strong>SMKNJ Bot:</strong> Halo! Ada yang bisa saya bantu seputar SMK Nurul Jadid?</p>
            </div>
            <div id="chatbot-input-area">
                <input type="text" id="chat-input" placeholder="Ketik pertanyaan...">
                <button id="chat-send"><i class="fa fa-paper-plane"></i></button>
            </div>
        </div>
    </div>
    {{-- == AKHIR HTML CHATBOT == --}}

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    {{-- == JAVASCRIPT CHATBOT NJ-BOT == --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- Variabel Elemen DOM ---
            const chatWrapper = document.getElementById('chatbot-wrapper');
            const chatContainer = document.getElementById('chatbot-container');
            const chatBox = document.getElementById('chat-messages');
            const chatInput = document.getElementById('chat-input');
            const chatSendBtn = document.getElementById('chat-send');
            const toggleBtn = document.getElementById('chatbot-toggle-button');
            const closeBtn = document.getElementById('chatbot-close-btn');
            const sidebar = document.getElementById('chatbot-sidebar');
            const newChatBtn = document.getElementById('new-chat-button');
            const historyList = document.getElementById('chat-history-list');
            const navbarToggleBtn = document.getElementById('navbar-chatbot-toggle');
            const sidebarToggleBtn = document.getElementById('sidebar-toggle-button');

            // --- State Aplikasi ---
            let chatHistory = [];
            let currentChatId = null;
            let isSidebarVisible = true; // Default sidebar terlihat

            // --- Fungsi Utility ---
            function generateUniqueId() { return Date.now().toString(36) + Math.random().toString(36).substring(2); }
            function generateTitle(msg) { return msg.length > 25 ? msg.substring(0, 22) + '...' : msg; }

            // --- Fungsi Load/Save History ---
            function loadHistoryFromStorage() {
                const stored = localStorage.getItem('smknjChatHistory');
                chatHistory = stored ? JSON.parse(stored) : [];
                currentChatId = chatHistory.length > 0 ? chatHistory[chatHistory.length - 1]?.id : null;
            }
            function saveHistoryToStorage() { localStorage.setItem('smknjChatHistory', JSON.stringify(chatHistory)); }

            // --- Fungsi Render UI ---
            function renderHistoryList() {
                if (!historyList) return;
                historyList.innerHTML = '';
                if (chatHistory.length === 0) {
                    historyList.innerHTML = '<p class="text-muted small text-center mt-2">No history.</p>'; return;
                }
                [...chatHistory].reverse().forEach(chat => {
                    const item = document.createElement('div');
                    item.className = 'history-item';
                    item.textContent = chat.title || 'Untitled';
                    item.dataset.chatId = chat.id;
                    if (chat.id === currentChatId) item.classList.add('active');
                    item.addEventListener('click', () => { loadChatMessages(chat.id); });
                    historyList.appendChild(item);
                });
            }

            function loadChatMessages(chatId) {
                currentChatId = chatId;
                if (!chatBox) return;
                chatBox.innerHTML = '';
                const chat = chatHistory.find(c => c.id === chatId);
                if (chat?.messages) {
                    chat.messages.forEach(msg => appendMessage(msg.sender, msg.text, false));
                } else {
                    currentChatId = null;
                    appendMessage('bot', 'Halo! Ada yang bisa saya bantu seputar SMK Nurul Jadid?', false);
                }
                renderHistoryList();
                chatBox.scrollTop = chatBox.scrollHeight;
            }

            function appendMessage(sender, text, save = true) {
                if (!chatBox) return;
                const msgEl = document.createElement('p');
                msgEl.innerHTML = `<strong>${sender === 'user' ? 'Anda' : 'NJ-Bot'}:</strong> ${text}`;
                chatBox.appendChild(msgEl);
                chatBox.scrollTop = chatBox.scrollHeight;

                if (save) {
                    let chat = chatHistory.find(c => c.id === currentChatId);
                    if (chat) {
                        chat.messages.push({ sender, text });
                    } else {
                        const newId = generateUniqueId();
                        const newTitle = sender === 'user' ? generateTitle(text) : 'New Chat';
                        const welcomeMsg = { sender: 'bot', text: 'Halo! Ada yang bisa saya bantu seputar SMK Nurul Jadid?' };
                        chat = { id: newId, title: newTitle, messages: [welcomeMsg, { sender, text }] };
                        chatHistory.push(chat);
                        currentChatId = newId;
                        renderHistoryList();
                    }
                    saveHistoryToStorage();
                }
            }

            // --- Fungsi Kirim ke Backend ---
            async function sendMessage() { 
                if (!chatInput || !chatSendBtn) return;
                const message = chatInput.value.trim();
                if (message === '') return;

                appendMessage('user', message);
                const chatIdContext = currentChatId;
                chatInput.value = '';
                chatInput.disabled = true;
                chatSendBtn.disabled = true;
                appendMessage('bot', '<i>Mengetik...</i>', false);

                try {
                    const response = await fetch('/ai-chat', {
                         method: 'POST',
                         headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                         },
                         body: JSON.stringify({ message: message })
                    });

                    const typingIndicator = chatBox ? chatBox.querySelector('p:last-child > i') : null;
                    if (typingIndicator?.textContent === 'Mengetik...') typingIndicator.closest('p').remove();

                    const data = await response.json();

                    if (!response.ok) {
                        appendMessage('bot', `Error ${response.status}: ${data.reply || 'Gagal.'}`, false);
                    } else {
                        let targetChat = chatHistory.find(c => c.id === chatIdContext);
                        if (targetChat) {
                            targetChat.messages.push({ sender: 'bot', text: data.reply });
                            saveHistoryToStorage();
                            if (currentChatId === chatIdContext) {
                                appendMessage('bot', data.reply, false);
                            }
                        } else {
                            appendMessage('bot', data.reply);
                        }
                    }
                } catch (error) {
                    const typingIndicator = chatBox ? chatBox.querySelector('p:last-child > i') : null;
                    if (typingIndicator?.textContent === 'Mengetik...') typingIndicator.closest('p').remove();
                    console.error("Error sending chat:", error);
                    appendMessage('bot', 'Gagal terhubung ke server. Periksa koneksi.', false);
                } finally {
                    if(chatInput) chatInput.disabled = false;
                    if(chatSendBtn) chatSendBtn.disabled = false;
                    if(chatInput) chatInput.focus();
                }
            }

            // --- Event Listeners UI ---
            function openChatbox(event) {
                if (event) event.preventDefault();
                if(chatWrapper) chatWrapper.style.display = 'flex';
                if(toggleBtn) toggleBtn.style.display = 'none';
                // Tampilkan sidebar jika di desktop dan sebelumnya disembunyikan
                if (isSidebarVisible === false && window.innerWidth > 768 && sidebarToggleBtn) {
                   toggleSidebar(); // Panggil fungsi toggle untuk menampilkannya
                } else if (isSidebarVisible === true && window.innerWidth > 768 && sidebarToggleBtn){
                    // Pastikan ikon benar saat dibuka kembali
                     sidebarToggleBtn.innerHTML = '<i class="fas fa-bars"></i>';
                     sidebarToggleBtn.title = 'Hide Sidebar';
                     if(chatWrapper) chatWrapper.classList.remove('sidebar-hidden');
                }
                if(chatInput) chatInput.focus();
            }
            function closeChatbox() {
                if(chatWrapper) chatWrapper.style.display = 'none';
                if(toggleBtn) toggleBtn.style.display = 'block';
            }

            function toggleSidebar() {
                if (!chatWrapper || !sidebarToggleBtn) return;
                isSidebarVisible = !isSidebarVisible;
                chatWrapper.classList.toggle('sidebar-hidden', !isSidebarVisible);
                sidebarToggleBtn.innerHTML = isSidebarVisible ? '<i class="fas fa-bars"></i>' : '<i class="fas fa-arrow-right"></i>';
                sidebarToggleBtn.title = isSidebarVisible ? 'Hide Sidebar' : 'Show Sidebar';
            }

            // Tambahkan event listener
            if(toggleBtn) toggleBtn.addEventListener('click', openChatbox);
            if(closeBtn) closeBtn.addEventListener('click', closeChatbox);
            if(chatSendBtn) chatSendBtn.addEventListener('click', sendMessage);
            if(chatInput) chatInput.addEventListener('keypress', e => { if (e.key === 'Enter') sendMessage(); });
            if(newChatBtn) newChatBtn.addEventListener('click', () => { loadChatMessages(null); });
            if(navbarToggleBtn) navbarToggleBtn.addEventListener('click', openChatbox); // Link navbar buka chat
            if(sidebarToggleBtn) sidebarToggleBtn.addEventListener('click', toggleSidebar);

            // --- Inisialisasi ---
            loadHistoryFromStorage();
            renderHistoryList();
            loadChatMessages(currentChatId); // Muat chat terakhir

            // Set state sidebar awal (terlihat)
            if (chatWrapper && sidebarToggleBtn && isSidebarVisible) {
                 chatWrapper.classList.remove('sidebar-hidden');
                 sidebarToggleBtn.innerHTML = '<i class="fas fa-bars"></i>';
                 sidebarToggleBtn.title = 'Hide Sidebar';
            } else if (chatWrapper && sidebarToggleBtn && !isSidebarVisible) {
                // Jika state tersimpan sbg hidden (misal dari localStorage nanti)
                 chatWrapper.classList.add('sidebar-hidden');
                 sidebarToggleBtn.innerHTML = '<i class="fas fa-arrow-right"></i>';
                 sidebarToggleBtn.title = 'Show Sidebar';
            }


        });

        // == AKHIR JAVASCRIPT CHATBOT == //
    </script>

    @stack('scripts')

</body>
</html>