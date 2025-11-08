@extends('master')

@section('title', 'Galeri Prestasi')

{{-- Carbon (untuk format tanggal) --}}
@php
    use Carbon\Carbon;
    use Illuminate\Support\Str;
@endphp

@push('styles')
<style>
    /* === Modern Prestasi Card Design === */
    .prestasi-card {
        border-radius: 7px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        background: #fff;
        transform: translateY(0);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: none;
        height: 100%;
        position: relative;
    }

    .prestasi-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #ffc107, #ff9800); /* Warna emas untuk prestasi */
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
        z-index: 2;
    }

    .prestasi-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .prestasi-card:hover::before {
        transform: scaleX(1);
    }

    .prestasi-card .card-img-container {
        position: relative;
        height: 250px;
        overflow: hidden; /* Untuk zoom gambar & menampung badge */
    }

    .prestasi-card img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        filter: brightness(0.95);
        transition: all 0.5s ease;
    }

    .prestasi-card:hover img {
        filter: brightness(1);
        transform: scale(1.03);
    }

    /* === BARU: Badge Prestasi === */
    .prestasi-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: #ffc107; /* Warna emas/warning */
        color: #333; /* Teks gelap agar kontras di atas kuning */
        padding: 0.4rem 0.8rem;
        border-radius: 7px;
        font-size: 0.85rem;
        font-weight: 700;
        z-index: 2;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .prestasi-badge i {
        font-size: 0.8rem;
    }

    .prestasi-card .card-body {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1; /* Memastikan body mengisi sisa ruang */
    }

    .prestasi-card .card-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #232323;
        margin-bottom: 0.5rem; /* Kurangi margin */
    }

    .prestasi-card .card-meta {
        font-size: 0.9rem;
        color: #555;
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .prestasi-card .card-meta i {
        color: var(--primary);
        width: 16px;
        text-align: center;
    }
    .prestasi-card .card-date {
        font-size: 0.85rem;
        color: #777;
        margin-bottom: 1rem; /* Memberi jarak bawah */
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .prestasi-card .card-date i {
        color: var(--primary);
        width: 16px;
        text-align: center;
    }

    /* Animasi (Konsisten) */
    @keyframes fadeInUpStagger {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .prestasi-card {
        animation: fadeInUpStagger 0.6s ease forwards;
        opacity: 0;
    }

    /* Empty State (Reusable) */
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
        <div class="container-fluid">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Galeri</h6>
                <h1 class="mb-5">Prestasi SMK Nurul Jadid</h1>
            </div>
            
            <div class="row g-4"> 
                @forelse ($prestasi as $v)
                    <div class="col-lg-4 col-md-6 wow fadeInUp d-flex">
                        
                        <div class="prestasi-card d-flex flex-column" style="animation-delay: {{ $loop->index * 0.1 }}s"> 
                            
                            <div class="card-img-container">
                                <img src="{{ asset('storage/' . $v->foto_prestasi) }}" alt="Foto {{ $v->judul }}" />
                                
                                @if($v->juara)
                                <span class="prestasi-badge">
                                    <i class="fas fa-trophy"></i> {{ $v->juara }}
                                </span>
                                @endif
                            </div>
                            
                            <div class="card-body d-flex flex-column flex-grow-1">
                                <h4 class="card-title">{{ $v->judul }}</h4>
                                
                                @if($v->peserta)
                                <div class="card-meta">
                                    <i class="fas fa-user-check"></i> {{ $v->peserta }}
                                </div>
                                @endif

                                <div class="card-date">
                                    <i class="fa fa-calendar-alt"></i>
                                    {{ Carbon::parse($v->tanggal)->isoFormat('D MMMM Y') }}
                                </div>

                                {{-- Bagian Deskripsi dan Tombol Dihapus --}}

                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="empty-state">
                            <i class="fas fa-trophy"></i>
                            <h4>Belum Ada Prestasi</h4>
                            <p>Belum ada data prestasi yang dipublikasikan saat ini.</p>
                        </div>
                    </div>
                @endforelse
            </div>
            
             {{-- Pagination --}}
             @if(method_exists($prestasi, 'links'))
                <div class="mt-5 d-flex justify-content-center wow fadeInUp" data-wow-delay="0.5s">
                    {{ $prestasi->links('pagination::bootstrap-5') }}
                </div>
            @endif

        </div>
    </div>
    @endsection

@push('scripts')
@endpush