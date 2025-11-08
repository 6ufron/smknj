@extends('master')

@section('title', 'Fasilitas')

@php
    use Illuminate\Support\Str;
@endphp

@push('styles')
<style>
    /* === Modern Kategori Header (Reusable) === */
    .kategori-header {
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--primary);
        display: flex;
        align-items: center;
        gap: 15px;
        margin-top: 2.5rem; /* Mengurangi margin atas */
        margin-bottom: 1.5rem;
        position: relative;
        padding-bottom: 10px;
    }

    .kategori-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, var(--primary), transparent);
        border-radius: 2px;
    }

    .kategori-header i {
        font-size: 2rem;
        background: rgba(var(--primary-rgb), 0.1);
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .kategori-desc {
        font-size: 1.05rem;
        color: #6c757d;
        margin-bottom: 2.5rem;
        padding-left: 75px; /* Sesuai dengan ikon header + gap */
        position: relative;
        max-width: 800px;
    }

    /* === Modern Facility Card Design === */
    .facility-card-modern {
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

    .facility-card-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--primary), #4facfe);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
        z-index: 2;
    }

    .facility-card-modern:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .facility-card-modern:hover::before {
        transform: scaleX(1);
    }

    .facility-card-modern img {
        height: 250px; /* Tinggi gambar yang konsisten */
        width: 100%;
        object-fit: cover;
        filter: brightness(0.95);
        transition: all 0.5s ease;
    }

    .facility-card-modern:hover img {
        filter: brightness(1);
        transform: scale(1.03);
    }

    /* === PERBAIKAN 1 === */
    .facility-card-modern .card-body {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1; /* DIUBAH DARI height: 100% */
    }
    /* === AKHIR PERBAIKAN 1 === */

    .facility-card-modern .card-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #232323;
        display: flex;
        align-items: center;
        margin-bottom: 0.75rem;
    }
    
    .facility-card-modern .card-title i {
        margin-right: 10px;
        color: var(--primary);
        font-size: 1.1rem; /* Ikon di judul kartu */
    }

    .facility-card-modern .description-container {
        font-size: 0.95rem;
        color: #666;
        line-height: 1.7;
        flex-grow: 1;
        margin-bottom: 1rem;
    }

    /* === PERBAIKAN 2 === */
    .read-more-toggle {
        font-size: 0.9rem;
        font-weight: 600;
        text-decoration: none;
        color: var(--primary);
        display: inline-flex;
        align-items: center;
        /* margin-top: auto; <-- BARIS INI DIHAPUS */
        padding: 8px 0;
        transition: all 0.3s ease;
        border-radius: 4px;
        width: fit-content;
    }
    /* === AKHIR PERBAIKAN 2 === */

    .read-more-toggle:hover {
        color: #0a58ca;
        background: rgba(var(--primary-rgb), 0.05);
        padding: 8px 12px;
    }

    .read-more-toggle i {
        margin-left: 6px;
        transition: transform 0.3s ease;
    }

    .read-more-toggle.active i {
        transform: rotate(180deg);
    }

    /* === Empty State (Reusable) === */
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        background: #f8f9fa;
        border-radius: 7px;
        margin: 2rem 0;
    }
    .empty-state i {
        font-size: 3rem;
        color: #6c757d;
        margin-bottom: 1rem;
    }
    .empty-state h4 { color: #495057; margin-bottom: 0.5rem; }
    .empty-state p { color: #6c757d; }

    /* Animation for staggered card appearance */
    @keyframes fadeInUpStagger {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .facility-card-modern {
        animation: fadeInUpStagger 0.6s ease forwards;
        opacity: 0;
    }
    
    @media (max-width: 768px) {
        .kategori-header { font-size: 1.8rem; }
        .kategori-header i { width: 50px; height: 50px; font-size: 1.6rem; }
        .kategori-desc { padding-left: 0; }
    }

    .fasilitas-section .pagination {
        display: flex;
        padding-left: 0;
        list-style: none;
        justify-content: center;
    }
    .fasilitas-section .page-item {
        margin: 0 0.25rem;
    }
    .fasilitas-section .page-item .page-link {
        border-radius: 1px !important; /* Sesuaikan border-radius */
        padding: 0.5rem 0.9rem;
        color: var(--primary);
        background-color: #fff;
        border: 1px solid #dee2e6;
        transition: all 0.3s ease;
        box-shadow: none; /* Menghapus shadow jika ada */
        /* Memastikan style <a> tidak tertimpa */
        text-decoration: none !important; 
        display: block; 
    }
    .fasilitas-section .page-item.active .page-link {
        z-index: 3;
        color: #fff;
        background-color: var(--primary);
        border-color: var(--primary);
    }
    .fasilitas-section .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        background-color: #fff;
        border-color: #dee2e6;
    }
    .fasilitas-section .page-link:hover {
        z-index: 2;
        color: #0a58ca; /* Warna hover standar bootstrap */
        background-color: #e9ecef;
        border-color: #dee2e6;
    }
</style>
@endpush

@section('content')

{{-- Page Header (Tidak Diubah) --}}
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
{{-- Akhir Page Header --}}

<div class="container-xxl py-5 fasilitas-section">
    <div class="container">
        <div class="text-center wow fadeInUp mb-5" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Galeri Sarana</h6>
            <h1 class="mb-5">Fasilitas Sekolah</h1>
        </div>

        @php
            $utama = $fasilitasUtama ?? collect();
            $pendukung = $fasilitasPendukung ?? collect();
        @endphp

        @if ($utama->isEmpty() && $pendukung->isEmpty())
            <div class="col-12">
                <div class="empty-state">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h4>Belum ada data fasilitas</h4>
                    <p>Data fasilitas akan segera tersedia.</p>
                </div>
            </div>
        @else

            <h2 class="kategori-header wow fadeInUp" data-wow-delay="0.1s" id="fasilitas-utama">
                <i class="fas fa-building"></i> Fasilitas Utama
            </h2>
            <p class="kategori-desc wow fadeInUp" data-wow-delay="0.15s">
                Sarana inti yang menunjang kegiatan belajar mengajar dan operasional sekolah.
            </p>

            @if ($utama->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-clipboard-list"></i>
                    <h4>Belum ada Fasilitas Utama</h4>
                    <p>Belum ada data Fasilitas Utama yang tersedia.</p>
                </div>
            @else
                <div class="row g-4 justify-content-center">
                    @foreach ($utama as $item)
                        <div class="col-lg-4 col-md-6 d-flex wow fadeInUp">
                            <div class="facility-card-modern d-flex flex-column" 
                                 style="animation-delay: {{ $loop->index * 0.1 }}s">
                                
                                <img src="{{ asset('storage/'. $item->foto_path) }}" alt="{{ $item->nama }}">
                                
                                <div class="card-body d-flex flex-column">
                                    <h4 class="card-title">
                                        <i class="fas fa-check-circle"></i> {{ $item->nama }}
                                    </h4>

                                    @php
                                        $limit = 120;
                                        $fullDesc = strip_tags($item->deskripsi ?? 'Deskripsi belum tersedia.');
                                        $needsToggle = strlen($fullDesc) > $limit;
                                    @endphp

                                    <div class="description-container">
                                        @if ($needsToggle)
                                            <span class="description-short">{{ Str::limit($fullDesc, $limit) }}</span>
                                            <span class="description-full d-none">{!! nl2br(e($fullDesc)) !!}</span>
                                        @else
                                            <span class="description-full">{!! nl2br(e($fullDesc)) !!}</span>
                                        @endif
                                    </div>

                                    @if ($needsToggle)
                                        <a href="javascript:void(0)" class="read-more-toggle">
                                            Baca selengkapnya <i class="fas fa-chevron-down"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            @if (method_exists($utama, 'hasPages') && $utama->hasPages())
                <div class="d-flex justify-content-center mt-4 wow fadeInUp" data-wow-delay="0.1s">
                    {!! $utama->withQueryString()->fragment('fasilitas-utama')->links('pagination::bootstrap-5') !!}
                </div>
            @endif

            {{-- Spacer --}}
            <div style="height: 3rem;"></div> 

            <h2 class="kategori-header wow fadeInUp" data-wow-delay="0.1s" id="fasilitas-pendukung">
                <i class="fas fa-cogs"></i> Fasilitas Pendukung
            </h2>
            <p class="kategori-desc wow fadeInUp" data-wow-delay="0.15s">
                Sarana tambahan untuk melengkapi dan mendukung kenyamanan seluruh warga sekolah.
            </p>

            @if ($pendukung->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-clipboard-list"></i>
                    <h4>Belum ada Fasilitas Pendukung</h4>
                    <p>Belum ada data Fasilitas Pendukung yang tersedia.</p>
                </div>
            @else
                <div class="row g-4 justify-content-center">
                    @foreach ($pendukung as $item)
                        <div class="col-lg-4 col-md-6 d-flex wow fadeInUp">
                            <div class="facility-card-modern d-flex flex-column" 
                                 style="animation-delay: {{ $loop->index * 0.1 }}s">
                                
                                <img src="{{ asset('storage/' . $item->foto_path) }}" alt="{{ $item->nama }}">
                                
                                <div class="card-body d-flex flex-column">
                                    <h4 class="card-title">
                                        <i class="fas fa-check-circle"></i> {{ $item->nama }}
                                    </h4>

                                    @php
                                        $limit = 120;
                                        $fullDesc = strip_tags($item->deskripsi ?? 'Deskripsi belum tersedia.');
                                        $needsToggle = strlen($fullDesc) > $limit;
                                    @endphp

                                    <div class="description-container">
                                        @if ($needsToggle)
                                            <span class="description-short">{{ Str::limit($fullDesc, $limit) }}</span>
                                            <span class="description-full d-none">{!! nl2br(e($fullDesc)) !!}</span>
                                        @else
                                            <span class="description-full">{!! nl2br(e($fullDesc)) !!}</span>
                                        @endif
                                    </div>

                                    @if ($needsToggle)
                                        <a href="javascript:void(0)" class="read-more-toggle">
                                            Baca selengkapnya <i class="fas fa-chevron-down"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            @if (method_exists($pendukung, 'hasPages') && $pendukung->hasPages())
                <div class="d-flex justify-content-center mt-4 wow fadeInUp" data-wow-delay="0.1s">
                    {!! $pendukung->withQueryString()->fragment('fasilitas-pendukung')->links('pagination::bootstrap-5') !!}
                </div>
            @endif

        @endif
    </div>
</div>

@endsection

@push('scripts')
{{-- JavaScript Anda sudah benar dan tidak perlu diubah. --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Read more toggle functionality (Reusable)
        document.querySelectorAll('.read-more-toggle').forEach(toggle => {
            toggle.addEventListener('click', function (e) {
                e.preventDefault();
                const cardBody = this.closest('.card-body');
                const shortText = cardBody.querySelector('.description-short');
                const fullText = cardBody.querySelector('.description-full');
                
                const isHidden = fullText.classList.contains('d-none');
                
                if (isHidden) {
                    fullText.classList.remove('d-none');
                    if (shortText) shortText.classList.add('d-none');
                    this.innerHTML = 'Sembunyikan <i class="fas fa-chevron-up"></i>';
                    this.classList.add('active');
                } else {
                    fullText.classList.add('d-none');
                    if (shortText) shortText.classList.remove('d-none');
                    this.innerHTML = 'Baca selengkapnya <i class="fas fa-chevron-down"></i>';
                    this.classList.remove('active');
                }
            });
        });
    });
</script>
@endpush