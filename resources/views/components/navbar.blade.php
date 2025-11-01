<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0 modern-navbar">
    <a href="{{ route('beranda') }}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h5 class="m-0 text-primary">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Sekolah">
        </h5>
    </a>

    <button type="button" class="navbar-toggler me-2" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">

            <a href="{{ route('beranda') }}"
               class="nav-item nav-link {{ Request::routeIs('beranda') ? 'active' : '' }}">Beranda</a>

            <!-- Dropdown Profil -->
            <div class="nav-item dropdown">
                <a href="#"
                   class="nav-link dropdown-toggle {{ Request::routeIs('smknj.*') ? 'active' : '' }}"
                   data-bs-toggle="dropdown">
                    Profil
                </a>
                <div class="dropdown-menu m-0">
                    <a href="{{ route('smknj.index') }}"
                       class="dropdown-item {{ Request::routeIs('smknj.index') ? 'active' : '' }}">SMK Nurul Jadid</a>
                    <a href="{{ route('smknj.vimisi') }}"
                       class="dropdown-item {{ Request::routeIs('smknj.vimisi') ? 'active' : '' }}">Visi & Misi</a>
                    <a href="{{ route('smknj.identitas') }}"
                       class="dropdown-item {{ Request::routeIs('smknj.identitas') ? 'active' : '' }}">Identitas Sekolah</a>
                    <a href="{{ route('fasilitas.index') }}"
                        class="dropdown-item {{ Request::routeIs('fasilitas.index') ? 'active' : '' }}">Fasilitas</a>
                </div>
            </div>

            <!-- Dropdown Program -->
            <div class="nav-item dropdown">
                <a href="#"
                   class="nav-link dropdown-toggle {{ Request::routeIs('program.*') ? 'active' : '' }}"
                   data-bs-toggle="dropdown">
                    Program
                </a>
                <div class="dropdown-menu m-0">
                    <a href="{{ route('program.keahlian') }}"
                       class="dropdown-item {{ Request::routeIs('program.keahlian') ? 'active' : '' }}">Program Keahlian</a>
                    <a href="{{ route('ekstrakurikuler') }}" class="dropdown-item">Ekstrakurikuler</a>
                </div>
            </div>

            <!-- Dropdown Galeri -->
            <div class="nav-item dropdown">
                <a href="#"
                   class="nav-link dropdown-toggle {{ Request::routeIs('galeri.*') ? 'active' : '' }}"
                   data-bs-toggle="dropdown">
                    Galeri
                </a>
                <div class="dropdown-menu m-0">
                    <a href="{{ route('galeri.foto') }}"
                       class="dropdown-item {{ Request::routeIs('galeri.foto') ? 'active' : '' }}">Foto</a>
                    <a href="{{ route('galeri.video') }}"
                       class="dropdown-item {{ Request::routeIs('galeri.video') ? 'active' : '' }}">Video</a>
                    <a href="{{ route('galeri.prestasi') }}" class="dropdown-item">Prestasi</a>
                </div>
            </div>

            <a href="{{ route('berita-sekolah') }}"
               class="nav-item nav-link {{ Request::routeIs('berita-sekolah') ? 'active' : '' }}">Berita</a>

            <a href="{{ route('alumni') }}"
               class="nav-item nav-link {{ Request::routeIs('alumni') ? 'active' : '' }}">Alumni</a>

            <a href="{{ route('pengumuman') }}" class="nav-item nav-link">Pengumuman</a>

            <a href="{{ route('download.index') }}" class="nav-item nav-link">Download</a>

            <a href="{{ route('kontak_kami') }}"
               class="nav-item nav-link {{ Request::routeIs('kontak_kami') ? 'active' : '' }}">Kontak</a>

            <a href="#" id="navbar-chatbot-toggle" class="nav-item nav-link">
                <i class="fas fa-robot me-1"></i> Chatbot
            </a>

            <a href="{{ route('ppdb') }}" class="nav-item nav-link special-link">PPDB</a>

        </div>
    </div>
</nav>
