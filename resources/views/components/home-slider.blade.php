@php
    // Data slide sumber data
    $slides = [
        [
            'image' => 'img/Sekolah.jpg',
            'subtitle' => 'Selamat Datang di',
            'title' => 'SMK Nurul Jadid',
            'description' => 'Berinovasi tiada henti, mengabdi setulus hati.',
            'link' => 'https://psb.nuruljadid.net',
            'button_text' => 'DAFTAR SEKARANG',
            'thumb_title' => 'SMK Nurul Jadid' 
        ],
        [
            'image' => 'img/slider2.jpeg',
            'subtitle' => 'Program Keahlian',
            'title' => 'SMK BISA',
            'description' => 'Mencetak siswa siap bekerja sesuai program keahlian.',
            'link' => '/program-keahlian',
            'button_text' => 'LIHAT JURUSAN',
            'thumb_title' => 'Program Keahlian'
        ],
        [
            'image' => 'img/Ekstrakulikuler.jpg',
            'subtitle' => 'Prestasi Siswa',
            'title' => 'JUARA LKS NASIONAL',
            'description' => 'Membuktikan kualitas pendidikan melalui pencapaian di tingkat nasional.',
            'link' => '/galeri-prestasi',
            'button_text' => 'LIHAT PRESTASI',
            'thumb_title' => 'Prestasi Siswa'
        ],
        [
            'image' => 'img/ektra.png',
            'subtitle' => 'Kegiatan Unggulan',
            'title' => 'EKSTRAKURIKULER JURNALISTIK',
            'description' => 'Mengembangkan kreativitas dan logika melalui perakitan dan pemrograman robot.',
            'link' => '/ekstrakurikuler',
            'button_text' => 'JELAJAHI',
            'thumb_title' => 'Ekstrakurikuler'
        ],
        [
            'image' => 'img/lab.jpg',
            'subtitle' => 'Fasilitas Modern',
            'title' => 'LABORATORIUM LENGKAP',
            'description' => 'Menunjang praktik siswa dengan peralatan terkini dan modern.',
            'link' => '/fasilitas',
            'button_text' => 'LIHAT FASILITAS',
            'thumb_title' => 'Fasilitas'
        ],
    ];
@endphp

<main class="hero-section">
    <div class="swiper main-slider">
        <div class="swiper-wrapper">
            @foreach ($slides as $slide)
            <div class="swiper-slide" style="background-image: url('{{ asset($slide['image']) }}');">
                <div class="text-content">
                    <p class="subtitle">{{ $slide['subtitle'] }}</p>
                    <h1 class="title">{{ $slide['title'] }}</h1>
                    <p class="description">{{ $slide['description'] }}</p>
                    <div class="progress-bar-container">
                        <div class="progress-bar"></div>
                    </div>
                    <a href="{{ $slide['link'] }}" target="_blank" class="btn-discover">{{ $slide['button_text'] }}</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="slide-counter">
        <span class="current-slide">01</span>
    </div>
    
    <div class="card-stack-container">
        @foreach ($slides as $slide)
            <div class="card-stack-item" data-index="{{ $loop->index }}">
                <img src="{{ asset($slide['image']) }}" alt="Slide thumbnail {{ $loop->iteration }}">
            </div>
        @endforeach
    </div>
</main>