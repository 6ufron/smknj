@extends('master')

@section('title', 'Detail Berita')

{{-- Tambahkan Carbon untuk format tanggal di sidebar --}}
@php
    use Carbon\Carbon;
@endphp

@push('styles')
<style>
    /* == GAYA KONTEN ARTIKEL == */
    .article-metadata {
        font-size: 0.9rem;
        gap: 1.5rem; /* Memberi jarak antar item metadata */
    }
    .article-content {
        font-size: 1.1rem; /* Ukuran font lebih nyaman dibaca */
        line-height: 1.7; /* Jarak antar baris lebih lega */
        color: #333;
    }

    /* == GAYA TOMBOL SHARE (Modern) == */
    .share-buttons {
        font-family: 'Nunito', sans-serif;
    }
    .share-buttons span {
        font-weight: 600;
        font-size: 1rem;
        color: #555;
        vertical-align: middle;
        margin-right: 8px;
    }
    .share-buttons a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 1px; /* Sudut lebih bulat */
        font-size: 0.85rem;
        font-weight: 600;
        padding: 6px 14px;
        margin: 4px;
        color: #fff !important;
        text-decoration: none;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        vertical-align: middle;
    }
    .share-buttons a:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .btn-wa { background-color: #25D366; } /* WhatsApp */
    .btn-tg { background-color: #0088cc; } /* Telegram */
    .btn-fb { background-color: #1877F2; } /* Facebook */
    .btn-tw { background-color: #1DA1F2; } /* Twitter */
    .btn-copy { background-color: #6c757d; } /* Salin Link */
    .btn-ig { background-color: #E4405F; } /* DIKEMBALIKAN: Instagram */

    #copy-success-msg {
        display: none;
        color: #198754;
        margin-left: 10px;
        font-size: 0.9rem;
        font-weight: 600;
    }

    /* == GAYA SIDEBAR (Modern) == */
    .sidebar-berita-lainnya h3 {
        font-weight: 700;
        font-size: 1.5rem;
        padding-left: 12px;
        /* Mengganti border-bottom menjadi border-left */
        border-left: 4px solid var(--primary);
        margin-bottom: 25px;
    }
    
    /* Tautkan seluruh kartu */
    .sidebar-item-link {
        text-decoration: none;
        display: block;
        margin-bottom: 20px;
        border-radius: 1px;
        /* Efek transisi untuk hover */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden; /* Penting untuk border-radius gambar */
        background: #fff;
        border: 1px solid #e9ecef;
    }

    /* Ini adalah efek hover yang diminta */
    .sidebar-item-link:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.07);
    }

    .sidebar-item {
        display: flex;
        gap: 15px; 
        align-items: center; /* Vertikal di tengah */
    }
    .sidebar-item img {
        width: 100px;
        height: 75px;
        object-fit: cover;
        flex-shrink: 0;
        /* Hapus border-radius dari sini, karena sudah di parent */
    }
    .sidebar-item-content {
        padding: 10px 10px 10px 0; /* Beri padding di kanan */
    }
    
    .sidebar-item-content h5 {
        font-size: 0.95rem; /* Sedikit lebih kecil */
        font-weight: 600;
        color: #333;
        line-height: 1.4;
        margin-bottom: 5px;
        transition: color 0.3s ease;
    }
    /* Efek hover pada judul saat tautan di-hover */
    .sidebar-item-link:hover .sidebar-item-content h5 {
        color: var(--primary);
    }
    .sidebar-item-content small {
        font-size: 0.8rem;
        color: #777;
    }
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
        <div class="row g-5">

            {{-- Kolom Konten Utama (10 bagian) --}}
            <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">
                <div class="card shadow-sm border-0 h-100">
                    
                    <div class="text-center p-3">
                        <img src="{{ asset('storage/' . $berita->foto) }}"
                             class="img-fluid rounded"
                             style="max-height: 450px; object-fit: cover;"
                             alt="Foto Berita {{ $berita->judul }}">
                    </div>

                    <div class="card-body p-4 p-md-5">

                        {{-- Metadata (Info Berita) --}}
                        <div class="d-flex align-items-center flex-wrap border-bottom pb-3 mb-4 text-muted article-metadata">
                            <span class="py-1">
                                <i class="fa fa-calendar text-primary me-2"></i>
                                {{ \Carbon\Carbon::parse($berita->created_at)->format('d M Y') }} WIB
                            </span>
                            <span class="py-1">
                                <i class="fas fa-tag text-primary me-2"></i>
                                {{ $berita->kategori }}
                            </span>
                            <span class="py-1">
                                <i class="fa fa-eye text-primary me-2"></i>
                                Dilihat {{ $berita->akses }} kali
                            </span>
                        </div>
                        
                        {{-- Isi Konten Berita --}}
                        <div class="article-content mt-4">
                            {!! nl2br(e($berita->kalimat)) !!}
                        </div>

                        {{-- Tombol Share --}}
                        @php
                            $currentUrl = request()->url();
                            $beritaTitle = $berita->judul;
                        @endphp
                        <div class="share-buttons border-top pt-3 mt-5">
                            <span>Bagikan:</span>
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($beritaTitle . ' - ' . $currentUrl) }}" target="_blank" class="btn-wa" title="Bagikan ke WhatsApp">
                                <i class="fab fa-whatsapp me-1"></i> WhatsApp
                            </a>
                            <a href="https://t.me/share/url?url={{ urlencode($currentUrl) }}&text={{ urlencode($beritaTitle) }}" target="_blank" class="btn-tg" title="Bagikan ke Telegram">
                                <i class="fab fa-telegram-plane me-1"></i> Telegram
                            </a>
                            <a href="https://www.instagram.com/direct/new/" target="_blank" class="btn-ig" title="Bagikan ke Instagram">
                                <i class="fab fa-instagram me-1"></i> Instagram
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($currentUrl) }}" target="_blank" class="btn-fb" title="Bagikan ke Facebook">
                                <i class="fab fa-facebook-f me-1"></i> Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode($currentUrl) }}&text={{ urlencode($beritaTitle) }}" target="_blank" class="btn-tw" title="Bagikan ke Twitter">
                                <i class="fab fa-twitter me-1"></i> Twitter
                            </a>
                            <a href="javascript:void(0);" id="btn-copy-link" class="btn-copy" title="Salin Link">
                                <i class="fas fa-link me-1"></i> Salin Link
                            </a>
                            <span id="copy-success-msg">Link disalin!</span>
                        </div>
                        
                        {{-- Tombol Kembali --}}
                        <div class="text-start mt-4">
                             <a href="{{ route('berita-sekolah') }}" class="btn btn-outline-danger">
                                <i class="fa fa-arrow-left me-2"></i>
                                Kembali ke Daftar Berita
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Kolom Sidebar "Berita Lainnya" (4 bagian) --}}
            <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="sidebar-berita-lainnya">
                    <h3>Berita Lainnya</h3>
                    
                    @forelse ($beritaLainnya as $item)
                        <a href="{{ route('detail-berita', $item) }}" class="sidebar-item-link">
                            <div class="sidebar-item">
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto {{ $item->judul }}">
                                <div class="sidebar-item-content">
                                    <h5>{{ $item->judul }}</h5>
                                    <small>
                                        <i class="fa fa-calendar-alt text-primary me-1"></i>
                                        {{ $item->created_at->format('d M Y') }}
                                    </small>
                                </div>
                            </div>
                        </a>
                    @empty
                        <p class="text-muted">Tidak ada berita lainnya saat ini.</p>
                    @endforelse

                </div>
            </div>

        </div>
    </div>
</div>

@endsection

{{-- Script untuk fungsionalitas Salin Link (Tidak berubah) --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const copyButton = document.getElementById('btn-copy-link');
    if (copyButton) {
        copyButton.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Teks yang akan di-copy
            const urlToCopy = '{{ $currentUrl }}';

            // Buat elemen textarea sementara
            const tempTextArea = document.createElement('textarea');
            tempTextArea.value = urlToCopy;
            tempTextArea.style.position = 'absolute';
            tempTextArea.style.left = '-9999px'; // Sembunyikan
            document.body.appendChild(tempTextArea);
            
            try {
                tempTextArea.select();
                // Gunakan document.execCommand('copy') untuk kompatibilitas
                var successful = document.execCommand('copy');
                var msg = successful ? 'Link disalin!' : 'Gagal menyalin';
                
                // Tampilkan pesan sukses
                const successMsg = document.getElementById('copy-success-msg');
                if (successMsg) {
                    successMsg.textContent = msg;
                    successMsg.style.display = 'inline';
                    setTimeout(() => {
                        successMsg.style.display = 'none';
                    }, 2500); // Pesan hilang setelah 2.5 detik
                }

            } catch (err) {
                console.error('Gagal menyalin link: ', err);
                const successMsg = document.getElementById('copy-success-msg');
                if (successMsg) {
                    successMsg.textContent = 'Gagal menyalin';
                    successMsg.style.display = 'inline';
                    setTimeout(() => {
                        successMsg.style.display = 'none';
                    }, 2500);
                }
            }

            document.body.removeChild(tempTextArea);
        });
    }
});
</script>
@endpush

