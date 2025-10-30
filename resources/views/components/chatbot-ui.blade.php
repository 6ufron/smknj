{{-- == HTML CHATBOT NJ-BOT (DENGAN SIDEBAR & TOGGLE + MENU HISTORY) == --}}

<button id="chatbot-toggle-button"> <i class="fas fa-comments"></i> </button>

<div id="chatbot-wrapper"> 

    <div id="chatbot-sidebar">

        <button id="sidebar-toggle-button" title="Toggle Sidebar">
            <i class="fas fa-bars"></i> 
        </button>

        <h4 class="sidebar-title">
            <img src="{{ asset('img/logo.png') }}" class="sidebar-logo" alt="Logo SMK">
            SMKNJ Bot
        </h4>

        <div class="d-flex flex-column mb-1">
            <button id="new-chat-button" class="d-flex align-items-center gap-2 rounded-2 w-100">
                <i class="fa-regular fa-pen-to-square"></i>
                <span>Percakapan baru</span>
            </button>
        </div>
        
        <span>
            Terbaru
        </span>

        <div id="chat-history-list">
            <p class="text-muted small text-center">Loading history...</p>
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
            <input type="text" id="chat-input" placeholder="Assalamualaikum, Admin...">
            <button id="chat-send"><i class="fa fa-paper-plane"></i></button>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

    // --- Elemen DOM ---
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

    // --- State ---
    let chatHistory = [];
    let currentChatId = null;
    let isSidebarVisible = true;
    let activeMenu = null;

    // --- Utility ---
    function generateUniqueId() {
        return Date.now().toString(36) + Math.random().toString(36).substring(2);
    }
    function generateTitle(msg) {
        return msg.length > 25 ? msg.substring(0,22)+'...' : msg;
    }

    // --- Load / Save History ---
    function loadHistoryFromStorage() {
        const stored = localStorage.getItem('smknjChatHistory');
        chatHistory = stored ? JSON.parse(stored) : [];
        currentChatId = chatHistory.length > 0 ? chatHistory[chatHistory.length - 1]?.id : null;
    }
    function saveHistoryToStorage() {
        localStorage.setItem('smknjChatHistory', JSON.stringify(chatHistory));
    }

    // --- Render History dengan Menu ---
    function renderHistoryList() {
        if (!historyList) return;
        historyList.innerHTML = '';
        if (chatHistory.length === 0) {
            historyList.innerHTML = '<p class="text-muted small text-center mt-2">No history.</p>';
            return;
        }
        
        [...chatHistory].reverse().forEach(chat => {
            const item = document.createElement('div');
            item.className = 'history-item';
            item.dataset.chatId = chat.id;
            if (chat.id === currentChatId) item.classList.add('active');
            
            // Konten utama history item
            const itemContent = document.createElement('div');
            itemContent.className = 'history-item-content';
            itemContent.textContent = chat.title || 'Untitled';
            
            // Menu toggle (titik tiga)
            const menuToggle = document.createElement('button');
            menuToggle.className = 'history-menu-toggle';
            menuToggle.innerHTML = '<i class="fas fa-ellipsis-v"></i>';
            menuToggle.title = 'Menu';
            
            // Menu dropdown
            const menuDropdown = document.createElement('div');
            menuDropdown.className = 'history-menu-dropdown';
            menuDropdown.innerHTML = `
                <button class="menu-item rename-item" data-chat-id="${chat.id}">
                    <i class="fas fa-edit"></i> Rename
                </button>
                <button class="menu-item delete-item" data-chat-id="${chat.id}">
                    <i class="fas fa-trash"></i> Delete
                </button>
            `;
            
            // Event untuk toggle menu
            menuToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                e.preventDefault();
                console.log('Menu toggle clicked for chat:', chat.id);
                
                // Close other menus first
                closeActiveMenu();
                
                // Toggle current menu
                if (activeMenu === chat.id) {
                    activeMenu = null;
                    menuDropdown.classList.remove('active');
                } else {
                    activeMenu = chat.id;
                    menuDropdown.classList.add('active');
                }
            });
            
            // Event untuk memuat chat ketika content diklik
            itemContent.addEventListener('click', (e) => {
                console.log('Content clicked for chat:', chat.id);
                closeActiveMenu();
                loadChatMessages(chat.id);
            });
            
            // Append elements
            item.appendChild(itemContent);
            item.appendChild(menuToggle);
            item.appendChild(menuDropdown);
            historyList.appendChild(item);
        });

        // Setup event delegation untuk menu items
        setupMenuEventDelegation();
    }

    // --- Setup Event Delegation untuk Menu ---
    function setupMenuEventDelegation() {
        // Event untuk rename
        historyList.addEventListener('click', (e) => {
            if (e.target.closest('.rename-item')) {
                const button = e.target.closest('.rename-item');
                const chatId = button.dataset.chatId;
                console.log('Rename clicked for:', chatId);
                renameChatHistory(chatId);
            }
        });

        // Event untuk delete
        historyList.addEventListener('click', (e) => {
            if (e.target.closest('.delete-item')) {
                const button = e.target.closest('.delete-item');
                const chatId = button.dataset.chatId;
                console.log('Delete clicked for:', chatId);
                deleteChatHistory(chatId);
            }
        });
    }

    // --- Fungsi untuk menutup menu aktif ---
    function closeActiveMenu() {
        console.log('Closing active menu');
        if (activeMenu) {
            const activeDropdowns = document.querySelectorAll('.history-menu-dropdown.active');
            activeDropdowns.forEach(dropdown => {
                dropdown.classList.remove('active');
            });
            activeMenu = null;
        }
    }

    // --- Fungsi rename history ---
    function renameChatHistory(chatId) {
        console.log('Renaming chat:', chatId);
        const chat = chatHistory.find(c => c.id === chatId);
        if (!chat) {
            console.log('Chat not found:', chatId);
            return;
        }
        
        const newTitle = prompt('Rename chat:', chat.title || 'Untitled');
        if (newTitle !== null && newTitle.trim() !== '') {
            chat.title = newTitle.trim();
            saveHistoryToStorage();
            renderHistoryList();
            console.log('Chat renamed to:', newTitle);
        }
    }

    // --- Fungsi delete history ---
    function deleteChatHistory(chatId) {
        console.log('Deleting chat:', chatId);
        if (!confirm('Apakah Anda yakin ingin menghapus chat ini?')) return;
        
        const initialLength = chatHistory.length;
        chatHistory = chatHistory.filter(c => c.id !== chatId);
        console.log('Chats filtered, before:', initialLength, 'after:', chatHistory.length);
        
        // Jika chat yang dihapus sedang aktif, pindah ke chat terbaru
        if (currentChatId === chatId) {
            currentChatId = chatHistory.length > 0 ? chatHistory[chatHistory.length - 1]?.id : null;
            console.log('Current chat changed to:', currentChatId);
            loadChatMessages(currentChatId);
        }
        
        saveHistoryToStorage();
        renderHistoryList();
    }

    function loadChatMessages(chatId) {
        console.log('Loading messages for chat:', chatId);
        closeActiveMenu();
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
        msgEl.innerHTML = `<strong>${sender==='user'?'Anda':'NJ-Bot'}:</strong> ${text}`;
        chatBox.appendChild(msgEl);
        chatBox.scrollTop = chatBox.scrollHeight;

        if (save) {
            let chat = chatHistory.find(c => c.id===currentChatId);
            if (chat) {
                chat.messages.push({sender, text});
            } else {
                const newId = generateUniqueId();
                const newTitle = sender==='user'?generateTitle(text):'New Chat';
                const welcomeMsg = {sender:'bot', text:'Halo! Ada yang bisa saya bantu seputar SMK Nurul Jadid?'};
                chat = {id:newId, title:newTitle, messages:[welcomeMsg, {sender, text}]};
                chatHistory.push(chat);
                currentChatId = newId;
                renderHistoryList();
            }
            saveHistoryToStorage();
        }
    }

    // --- Send Message ke Backend ---
    async function sendMessage() {
        if (!chatInput || !chatSendBtn) return;
        const message = chatInput.value.trim();
        if (message==='') return;

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
                    'Content-Type':'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({message:message})
            });

            const typingIndicator = chatBox ? chatBox.querySelector('p:last-child > i') : null;
            if (typingIndicator?.textContent==='Mengetik...') typingIndicator.closest('p').remove();

            const data = await response.json();

            if (!response.ok) {
                appendMessage('bot', `Error ${response.status}: ${data.reply || 'Gagal.'}`, false);
            } else {
                let targetChat = chatHistory.find(c => c.id===chatIdContext);
                if (targetChat) {
                    targetChat.messages.push({sender:'bot', text:data.reply});
                    saveHistoryToStorage();
                    if (currentChatId===chatIdContext) appendMessage('bot', data.reply, false);
                } else {
                    appendMessage('bot', data.reply);
                }
            }
        } catch (error) {
            const typingIndicator = chatBox ? chatBox.querySelector('p:last-child > i') : null;
            if (typingIndicator?.textContent==='Mengetik...') typingIndicator.closest('p').remove();
            console.error("Error sending chat:", error);
            appendMessage('bot', 'Gagal terhubung ke server. Periksa koneksi.', false);
        } finally {
            if (chatInput) chatInput.disabled=false;
            if (chatSendBtn) chatSendBtn.disabled=false;
            if (chatInput) chatInput.focus();
        }
    }

    // --- Open / Close / Toggle Sidebar ---
    function openChatbox(event){ 
        if(event) event.preventDefault();
        if(chatWrapper) chatWrapper.style.display='flex';
        if(toggleBtn) toggleBtn.style.display='none';
        if(isSidebarVisible===false && window.innerWidth>768 && sidebarToggleBtn) toggleSidebar();
        if(chatInput) chatInput.focus();
    }
    function closeChatbox(){ 
        closeActiveMenu();
        if(chatWrapper) chatWrapper.style.display='none';
        if(toggleBtn) toggleBtn.style.display='block';
    }
    function toggleSidebar(){
        if(!chatWrapper || !sidebarToggleBtn) return;
        isSidebarVisible = !isSidebarVisible;
        chatWrapper.classList.toggle('sidebar-hidden', !isSidebarVisible);
        sidebarToggleBtn.innerHTML = isSidebarVisible ? '<i class="fas fa-arrow-right"></i>' : '<i class="fas fa-bars"></i>';
        sidebarToggleBtn.title = isSidebarVisible ? 'Hide Sidebar' : 'Show Sidebar';
    }

    // --- Event Listeners ---
    if(toggleBtn) toggleBtn.addEventListener('click', openChatbox);
    if(closeBtn) closeBtn.addEventListener('click', closeChatbox);
    if(chatSendBtn) chatSendBtn.addEventListener('click', sendMessage);
    if(chatInput) chatInput.addEventListener('keypress', e => { if(e.key==='Enter') sendMessage(); });
    if(newChatBtn) newChatBtn.addEventListener('click', ()=>{
        closeActiveMenu();
        loadChatMessages(null);
    });
    if(navbarToggleBtn) navbarToggleBtn.addEventListener('click', openChatbox);
    if(sidebarToggleBtn) sidebarToggleBtn.addEventListener('click', toggleSidebar);

    // Tutup menu saat klik di luar
    document.addEventListener('click', (e) => {
        if (!e.target.closest('.history-menu-toggle') && !e.target.closest('.history-menu-dropdown')) {
            closeActiveMenu();
        }
    });

    // --- Inisialisasi ---
    loadHistoryFromStorage();
    renderHistoryList();
    loadChatMessages(currentChatId);

    // Debug info
    console.log('Chatbot initialized with', chatHistory.length, 'chats');
});
</script>

{{-- <style>
/* === SIDEBAR === */
#chatbot-sidebar {
    position: relative;
    background: #fafafa;
    color: #333;
    padding: 8px 10px;
    height: 100%;
    overflow-y: auto;
    border-right: 1px solid #e5e7eb;
    font-family: "Inter", "Nunito", sans-serif;
    font-size: 10px;
    letter-spacing: 0.1px;
}

/* Logo dan Judul Sidebar */
.sidebar-title {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 10px;
    font-weight: 600;
    color: #222;
    margin-bottom: 0px;
}

.sidebar-logo {
    width: 22px;
    height: 22px;
    border-radius: 4px;
}

/* Tombol New Chat */
#new-chat-button {
    background: #ffffff;
    color: #111827;
    border: 1px solid #d1d5db;
    font-size: 9px;
    padding: 4px 8px;
    border-radius: 4px;
    transition: all 0.2s ease;
    margin-bottom: 0px;
    width: 100%;
}

#new-chat-button:hover {
    background: #06bbcc;
    color: #fff;
}

/* === HISTORY LIST === */
.history-item {
    position: relative;
    padding: 2px 4px;
    margin-top: 0;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border: 1px solid transparent;
    background: transparent;
    line-height: 1.3;
}

.history-item:hover {
    background-color: #f3f4f6;
    border-color: #e5e7eb;
}

.history-item.active {
    background-color: #06bbcc;
    border-color: #06bbcc;
    color: #fff;
}

.history-item-content {
    flex: 1;
    padding-right: 4px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-size: 9px;
}

/* === MENU TOGGLE (TITIK TIGA) === */
.history-menu-toggle {
    background: none;
    border: none;
    color: #9ca3af;
    padding: 2px;
    border-radius: 4px;
    cursor: pointer;
    opacity: 0;
    transition: all 0.2s ease;
    width: 20px;
    height: 20px;
    font-size: 10px;
}

.history-item:hover .history-menu-toggle {
    opacity: 1;
    background-color: rgba(0, 0, 0, 0.02);
}

.history-menu-toggle:hover {
    background-color: rgba(0, 0, 0, 0.05);
    color: #374151;
}

/* === MENU DROPDOWN === */
.history-menu-dropdown {
    position: absolute;
    top: 100%;
    right: 4px;
    background: #ffffff;
    border-radius: 4px;
    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    min-width: 110px;
    display: none;
    overflow: hidden;
    border: 1px solid #e5e7eb;
}

.history-menu-dropdown.active {
    display: block;
    animation: fadeIn 0.15s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-4px); }
    to { opacity: 1; transform: translateY(0); }
}

.menu-item {
    width: 100%;
    padding: 5px 8px;
    border: none;
    background: none;
    text-align: left;
    cursor: pointer;
    color: #374151;
    font-size: 9px;
    display: flex;
    align-items: center;
    gap: 5px;
    transition: background-color 0.2s;
}

.menu-item:hover {
    background-color: #f9fafb;
}

.menu-item i {
    width: 12px;
    text-align: center;
    font-size: 9px;
}

.rename-item {
    border-bottom: 1px solid #f3f4f6;
}

.delete-item {
    color: #ef4444;
}

.delete-item:hover {
    background-color: #fef2f2;
    color: #dc2626;
}

/* === LIST CONTAINER === */
#chat-history-list {
    overflow: visible;
    padding-bottom: 20px;
}

.history-item {
    overflow: visible;
}

/* === KESELARASAN FONT UNTUK SELURUH CHATBOT === */
#chatbot-container,
#chat-messages,
#chatbot-input-area,
#chatbot-header {
    font-family: "Inter", "Nunito", sans-serif;
    font-size: 10px;
    color: #1f2937;
    line-height: 1.4;
}
</style> --}}
