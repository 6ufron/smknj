@extends('master')

@section('title', 'Profil')

@push('styles')
<style>
    /* === Modern Profile Section Styling === */
    .profile-section {
        padding: 3rem 0;
        border-bottom: 1px solid #f0f0f0;
    }
    .profile-section:last-of-type {
        border-bottom: none;
        padding-bottom: 1rem; /* Kurangi padding di akhir */
    }

    .profile-image-wrapper {
        border-radius: 7px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        /* Tentukan tinggi tetap agar semua gambar seragam */
        height: 450px; 
        position: relative;
        background: #f8f9fa; /* Fallback jika gambar tidak ada */
    }

    .profile-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    
    .profile-image-wrapper:hover img {
        transform: scale(1.05);
    }

    .profile-content {
        /* Pusatkan konten secara vertikal jika ada ruang */
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 100%;
    }

    .profile-content h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary); /* Gunakan warna primer */
        line-height: 1.3;
        margin-bottom: 1.5rem;
    }

    .profile-content p {
        font-size: 1.05rem;
        line-height: 1.8;
        color: #555;
    }
    
    /* Responsive adjustment */
    @media (max-width: 991px) {
        .profile-image-wrapper {
            height: 350px; /* Tinggi lebih kecil di tablet */
            margin-bottom: 2rem;
        }
        .profile-section {
            padding: 2rem 0;
        }
        .profile-content h2 {
            font-size: 2rem;
        }
        /* Selalu tampilkan gambar di atas pada mode mobile */
        .profile-image-wrapper {
            order: 1 !important;
        }
        .profile-content {
            order: 2 !important;
        }
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        background: #f8f9fa;
        border-radius: 7px;
        margin: 2rem 0;
    }
    .empty-state i { font-size: 3rem; color: #6c757d; margin-bottom: 1rem; }
    .empty-state h4 { color: #495057; margin-bottom: 0.5rem; }
    .empty-state p { color: #6c757d; }
</style>
@endpush

@section('content')

<div class="container-fluid bg-primary py-5 mb-5 page-header">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="display-3 text-white animated slideInDown">
                    @yield('title')
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item">
                            <a class="text-white" href="{{ route('beranda') }}">Beranda</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-white" href="#">Pages</a>
                        </li>
                        <li class="breadcrumb-item text-white active" aria-current="page">
                            @yield('title')
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-xxl py-5">
    <div class="container">

        <div class="text-center wow fadeInUp mb-5" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">
                Tentang
            </h6>
            <h1 class="mb-4">SMK Nurul Jadid</h1>
        </div>

        {{-- Cek apakah $profil ada dan tidak kosong --}}
        @if(isset($profil) && $profil->count() > 0)
            
            @foreach ($profil as $b)
                
                {{-- Logika untuk tata letak zig-zag --}}
                @php
                    $isOdd = $loop->iteration % 2 != 0;
                    // Jika ganjil (1, 3, ...): Gambar Kiri, Teks Kanan
                    // Jika genap (2, 4, ...): Teks Kiri, Gambar Kanan
                    $imageOrder = $isOdd ? 'order-lg-1' : 'order-lg-2';
                    $contentOrder = $isOdd ? 'order-lg-2' : 'order-lg-1';
                @endphp

                <div class="row g-5 align-items-center profile-section wow fadeInUp" data-wow-delay="0.2s">
                    
                    <div class="col-lg-6 {{ $imageOrder }}">
                        <div class="profile-image-wrapper">
                            <img src="{{ asset('storage/'.$b->foto) }}"
                                 alt="Foto {{ $b->judul ?? 'Profil' }}" {{-- Asumsi ada kolom 'judul' --}}
                                 class="img-fluid">
                        </div>
                    </div>

                    <div class="col-lg-6 {{ $contentOrder }}">
                        <div class="profile-content">
                            {{-- Asumsi Anda memiliki kolom 'judul' di database --}}
                            {{-- Jika tidak ada, ganti $b->judul dengan teks statis --}}
                            <h2 class="mb-4">{{ $b->judul ?? '' }}</h2>
                            
                            <p class="mb-0">
                                {{-- nl2br(e()) adalah cara aman untuk menampilkan teks --}}
                                {{-- yang mempertahankan baris baru tanpa risiko XSS --}}
                                {!! nl2br(e($b->kalimat)) !!}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach

        @else
            {{-- Tampilan jika tidak ada data profil --}}
            <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                <div class="empty-state">
                    <i class="fas fa-school"></i>
                    <h4>Data Profil Belum Tersedia</h4>
                    <p>Informasi mengenai profil sekolah akan segera diperbarui.</p>
                </div>
            </div>
        @endif
        
    </div>
</div>

@endsection