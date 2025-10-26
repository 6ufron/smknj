<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0 modern-navbar">
    <a href="{{ route('beranda') }}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h5 class="m-0 text-primary"><img src="{{ asset('img/logo.png') }}" alt="Logo Sekolah"></h5>
    </a>
    <button type="button" class="navbar-toggler me-2" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{ route('beranda') }}" class="nav-item nav-link {{ Request::routeIs('beranda') ? 'active' : '' }}">Beranda</a>
            
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle {{ Request::routeIs('smknj.*') ? 'active' : '' }}" data-bs-toggle="dropdown">Profil</a>
                <div class="dropdown-menu m-0">
                    <a href="{{ route('smknj.index') }}" class="dropdown-item {{ Request::routeIs('smknj.index') ? 'active' : '' }}">SMK Nurul Jadid</a>
                    <a href="{{ route('smknj.vimisi') }}" class="dropdown-item {{ Request::routeIs('smknj.vimisi') ? 'active' : '' }}">Visi & Misi</a>
                    <a href="{{ route('smknj.identitas') }}" class="dropdown-item {{ Request::routeIs('smknj.identitas') ? 'active' : '' }}">Identitas Sekolah</a>
                    <a href="#" class="dropdown-item">Hubungan Industri</a>
                </div>
            </div>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle {{ Request::routeIs('program.*') ? 'active' : '' }}" data-bs-toggle="dropdown">Program</a>
                <div class="dropdown-menu m-0">
                    <a href="{{ route('program.keahlian') }}" class="dropdown-item {{ Request::routeIs('program.keahlian') ? 'active' : '' }}">Program Keahlian</a>
                    <a href="#" class="dropdown-item">Ekstrakurikuler</a>
                </div>
            </div>

            <a href="{{ route('alumni') }}" class="nav-item nav-link {{ Request::routeIs('alumni') ? 'active' : '' }}">Alumni</a>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle {{ Request::routeIs('galeri.*') ? 'active' : '' }}" data-bs-toggle="dropdown">Galeri</a>
                <div class="dropdown-menu m-0">
                    <a href="{{ route('galeri.foto') }}" class="dropdown-item {{ Request::routeIs('galeri.foto') ? 'active' : '' }}">Foto</a>
                    <a href="{{ route('galeri.video') }}" class="dropdown-item {{ Request::routeIs('galeri.video') ? 'active' : '' }}">Video</a>
                    <a href="#" class="dropdown-item">Fasilitas</a>
                </div>
            </div>

            <a href="{{ route('berita-sekolah') }}" class="nav-item nav-link {{ Request::routeIs('berita-sekolah') ? 'active' : '' }}">Berita</a>
            <a href="{{ route('pengumuman') }}" class="nav-item nav-link">Pengumuman</a>
            <a href="{{ route('download') }}" class="nav-item nav-link">Download</a>
            <a href="{{ route('kontak_kami') }}" class="nav-item nav-link {{ Request::routeIs('kontak_kami') ? 'active' : '' }}">Kontak</a>
            <a href="#" id="navbar-chatbot-toggle" class="nav-item nav-link">
                <i class="fas fa-robot me-1"></i> Chatbot 
            </a>
            <a href="{{ route('ppdb') }}" class="nav-item nav-link special-link">PPDB</a>
        </div>
    </div>
</nav>

<style>
    /* -- Tampilan Umum Navbar -- */
    .modern-navbar {
        padding-top: 0.75rem !important;
        padding-bottom: 0.75rem !important;
        transition: all 0.3s ease;
    }
    .modern-navbar .navbar-nav .nav-link {
        color: #333;
        font-weight: 500;
        padding: 10px 0px;
        position: relative;
        transition: color 0.3s ease, background-size 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        
        background-image: linear-gradient(var(--bs-primary), var(--bs-primary));
        background-repeat: no-repeat;
        background-position: 50% 100%;
        background-size: 0% 2px;
    }

    /* -- Efek Hover & Active dengan Underline Animasi -- */
    .modern-navbar .navbar-nav .nav-link:hover,
    .modern-navbar .navbar-nav .nav-link.active {
        color: var(--bs-primary);
        background-size: 60% 2px;
    }

    /* -- Tombol Khusus PPDB -- */
    .modern-navbar .special-link {
        background-color: var(--bs-primary);
        color: white !important;
        border-radius: 50px;
        margin: auto 15px;
        padding: 8px 22px !important;
        transition: all 0.3s ease;
    }
    .modern-navbar .special-link:hover {
        background-color: #0d6efd;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
        transform: translateY(-2px);
    }
    .modern-navbar .special-link,
    .modern-navbar .special-link:hover {
        background-image: none;
        background-size: 0% 2px;
    }

    /* -- Gaya Panah Dropdown -- */
    .modern-navbar .nav-link.dropdown-toggle::after {
        display: inline-block;
        margin-left: 0.5em;
        vertical-align: 0.1em;
        content: "";
        border-top: 0.4em solid;
        border-right: 0.4em solid transparent;
        border-bottom: 0;
        border-left: 0.4em solid transparent;
        transition: transform 0.3s ease;
    }
    .modern-navbar .dropdown-toggle.show::after {
        transform: rotate(180deg);
    }

    /* ========================================================= */
    /* == LOGIKA & GAYA DROPDOWN (DIPISAH UNTUK RESPONSIVE) == */
    /* ========================================================= */

    /* Aturan untuk MOBILE (hanya mengandalkan class .show dari klik) */
    .modern-navbar .dropdown-menu {
        border: none;
        box-shadow: none;
        padding: 0;
        margin: 0 !important;
        display: block; /* Tetap block agar bisa dianimasikan */
    }
    .modern-navbar .dropdown-menu.show {
        /* Dibiarkan kosong agar di-handle oleh media query di bawah */
    }
    
    /* Aturan untuk DESKTOP (menambahkan :hover, hanya untuk layar > 991px) */
    @media (min-width: 992px) {
        .modern-navbar .dropdown-menu {
            border-radius: 4px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
            margin-top: 10px !important;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        .modern-navbar .dropdown:hover .dropdown-menu,
        .modern-navbar .dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .modern-navbar .dropdown-item {
            padding: 10px 20px;
            transition: all 0.2s ease-in-out;
            color: #555;
        }
        .modern-navbar .dropdown-item:hover {
            background-color: rgba(13, 110, 253, 0.05);
            color: var(--bs-primary);
            padding-left: 25px;
        }
        .modern-navbar .dropdown-item.active {
            color: var(--bs-primary);
            font-weight: 600;
            background-color: transparent;
        }
    }

    /* =================================================== */
    /* == TAMPILAN UNTUK MOBILE (< 992px) == */
    /* =================================================== */
    @media (max-width: 991.98px) {
        /* 1. Perbaiki Masalah Jarak Submenu */
        .modern-navbar .dropdown-menu {
            /* Sembunyikan submenu dengan max-height */
            max-height: 0;
            overflow: hidden;
            background-color: #f8f9fa; /* Warna latar submenu */
            border-radius: 0 0 8px 8px;
            padding-left: 25px; /* Indentasi submenu */
            transition: max-height 0.4s ease-out;
        }
        .modern-navbar .dropdown-menu.show {
            /* Tampilkan submenu dengan slide-down */
            max-height: 500px; /* Nilai besar agar semua item muat */
        }
        .modern-navbar .dropdown-item {
            padding: 10px 15px;
        }

        /* 2. Perbaiki Posisi Underline Animasi */
        .modern-navbar .navbar-nav .nav-link {
            background-position: 0% 100%; /* Posisikan underline di kiri */
        }
        .modern-navbar .navbar-nav .nav-link.active,
        .modern-navbar .navbar-nav .nav-link:hover {
            background-size: 100% 2px; /* Lebarkan underline penuh */
        }

        /* 3. Posisikan Tombol PPDB ke Tengah */
        .modern-navbar .special-link {
            text-align: center;
            display: block; /* Ubah jadi block */
            margin: 10px auto; /* Margin atas-bawah 10px, kiri-kanan auto (untuk centering) */
            width: 100%; /* Lebar full */
        }
    }
</style>