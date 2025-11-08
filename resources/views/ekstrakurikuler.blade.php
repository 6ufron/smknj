@extends('master')

@section('title', 'Ekstrakurikuler')

@php
    use Illuminate\Support\Str;
@endphp

@push('styles')
<style>
    /* === Modern Ekstrakurikuler Card Design === */
    .ekstra-section {
        position: relative;
        overflow: hidden;
    }

    .ekstra-card {
        border-radius: 7px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        background: #fff;
        transform: translateY(0);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: none;
        height: 100%;
        position: relative;
        display: flex;
        flex-direction: column;
    }

    .ekstra-card::before {
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

    .ekstra-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .ekstra-card:hover::before {
        transform: scaleX(1);
    }

    /* Wrapper gambar */
    .ekstra-card .card-img-wrapper {
        height: 200px;
        width: 100%;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
        flex-shrink: 0;
    }

    .ekstra-card .card-img-wrapper .fallback-icon {
        font-size: 3.5rem;
        color: #ced4da;
    }

    .ekstra-card img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        filter: brightness(0.95);
        transition: all 0.5s ease;
    }

    .ekstra-card:hover img {
        filter: brightness(1);
        transform: scale(1.03);
    }

    .ekstra-card .card-body {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .ekstra-card .card-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #232323;
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
    }

    .ekstra-card .card-title i {
        margin-right: 12px;
        color: var(--primary);
        background: rgba(var(--primary-rgb), 0.1);
        width: 38px;
        height: 38px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .ekstra-card .card-meta {
        font-size: 0.85rem;
        color: #777;
        margin-bottom: 1rem;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .ekstra-card .card-meta span {
        display: inline-flex;
        align-items: center;
    }

    .ekstra-card .card-meta i {
        margin-right: 8px;
        color: var(--primary);
        width: 16px;
        text-align: center;
    }

    .ekstra-card .description-container {
        font-size: 0.95rem;
        color: #666;
        line-height: 1.7;
        flex-grow: 1;
        margin-bottom: 1rem;
    }

    .read-more-toggle {
        font-size: 0.9rem;
        font-weight: 600;
        text-decoration: none;
        color: var(--primary);
        display: inline-flex;
        align-items: center;
        margin-top: auto;
        padding: 8px 0;
        transition: all 0.3s ease;
        border-radius: 4px;
        width: fit-content;
    }

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

    .kategori-header {
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--primary);
        display: flex;
        align-items: center;
        gap: 15px;
        margin-top: 4rem;
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
        padding-left: 75px;
        position: relative;
        max-width: 800px;
    }

    .kategori-desc i {
        position: absolute;
        left: 0;
        top: 2px;
        color: var(--primary);
    }

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

    .empty-state h4 {
        color: #495057;
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        color: #6c757d;
    }

    /* Pagination custom (bootstrap-5 style compatible) */
    .ekstra-section .pagination {
        display: flex;
        padding-left: 0;
        list-style: none;
        justify-content: center;
    }
    .ekstra-section .page-item {
        margin: 0 0.25rem;
    }
    .ekstra-section .page-item .page-link {
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
    .ekstra-section .page-item.active .page-link {
        z-index: 3;
        color: #fff;
        background-color: var(--primary);
        border-color: var(--primary);
    }
    .ekstra-section .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        background-color: #fff;
        border-color: #dee2e6;
    }
    .ekstra-section .page-link:hover {
        z-index: 2;
        color: #0a58ca; /* Warna hover standar bootstrap */
        background-color: #e9ecef;
        border-color: #dee2e6;
    }

    /* Animation for staggered card appearance */
    @keyframes fadeInUpStagger {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .ekstra-card {
        animation: fadeInUpStagger 0.6s ease forwards;
        opacity: 0;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .kategori-header {
            font-size: 1.8rem;
            margin-top: 3rem;
        }
        
        .kategori-header i {
            width: 50px;
            height: 50px;
            font-size: 1.6rem;
        }
        
        .kategori-desc {
            padding-left: 0;
            margin-top: -1rem;
        }
        
        .kategori-desc i {
            position: relative;
            margin-right: 8px;
        }
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

<div class="container-xxl py-5 ekstra-section">
    <div class="container-fluid">

        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">
                <i class=""></i> Ekstrakurikuler
            </h6>
            <h1 class="mb-3">Kegiatan Ekstrakurikuler</h1>
            <p class="mb-5 text-muted">
                Ekstrakurikuler di SMK Nurul Jadid dirancang sebagai wadah pengembangan karakter, keterampilan, dan kompetensi siswa. Setiap program dipandu pembina kompeten, dilaksanakan terstruktur, dan berfokus pada pengembangan soft-skill serta kesiapan kerja.
            </p>
        </div>

        {{-- === LOOP 1: EKSTRA DENGAN KATEGORI === --}}
        @forelse ($kategoriEkstra as $kategori)

            <div class="kategori-header wow fadeInUp" data-wow-delay="0.1s" id="kategori-{{ $kategori->id }}">
                <i class="{{ $kategori->icon ?? 'fas fa-folder-open' }}"></i> {{ $kategori->nama_bidang }}
            </div>

            <p class="kategori-desc wow fadeInUp" data-wow-delay="0.15s">
                {{ $kategori->deskripsi ?? 'Kategori ini memuat berbagai kegiatan yang bertujuan mengembangkan potensi siswa sesuai minat dan bakat.' }}
            </p>

            <div class="row g-4">

                @forelse ($kategori->programEkstra as $index => $v)
                    <div class="col-lg-4 col-md-6 d-flex">
                        <div class="ekstra-card d-flex flex-column" style="animation-delay: {{ ($index % 6) * 0.08 }}s">
                            
                            <div class="card-img-wrapper">
                                @if(!empty($v->foto) && file_exists(public_path('storage/' . $v->foto)))
                                    <img src="{{ asset('storage/' . $v->foto) }}" alt="{{ $v->nama }}">
                                @else
                                    <i class="{{ $kategori->icon ?? 'fas fa-star' }} fallback-icon"></i>
                                @endif
                            </div>
                            
                            <div class="card-body d-flex flex-column">
                                <h4 class="card-title">
                                    <i class="{{ $kategori->icon ?? 'fas fa-star' }}"></i> {{ $v->nama }}
                                </h4>

                                <div class="card-meta">
                                    @if(!empty($v->pembina))
                                        <span><i class="fas fa-user-tie"></i> {{ $v->pembina }}</span>
                                    @endif
                                    @if(!empty($v->jadwal))
                                        <span><i class="fas fa-calendar-alt"></i> {{ $v->jadwal }}</span>
                                    @endif
                                </div>

                                @php
                                    $limit = 140;
                                    $fullDesc = trim($v->deskripsi ?? '');
                                    $fullDesc = $fullDesc === '' ? 'Deskripsi belum tersedia.' : $fullDesc;
                                    $needsToggle = strlen($fullDesc) > $limit;
                                @endphp

                                <div class="description-container">
                                    @if ($needsToggle)
                                        <span class="description-short">{{ Str::limit($fullDesc, $limit) }}</span>
                                        <span class="description-full d-none">{{ $fullDesc }}</span>
                                    @else
                                        <span class="description-full">{{ $fullDesc }}</span>
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
                @empty
                    <div class="col-12">
                        <div class="empty-state">
                            <i class="fas fa-clipboard-list"></i>
                            <h4>Belum ada ekstrakurikuler</h4>
                            <p>Belum ada ekstrakurikuler yang tersedia pada kategori ini.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Pagination per-kategori (tampil hanya bila relation berupa paginator) --}}
            @if (method_exists($kategori->programEkstra, 'hasPages') && $kategori->programEkstra->hasPages())
                <div class="d-flex justify-content-center mt-4 wow fadeInUp" data-wow-delay="0.1s">
                    {!! $kategori->programEkstra->withQueryString()->fragment('kategori-' . $kategori->id)->links('pagination::bootstrap-5') !!}
                </div>
            @endif

        @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h4>Belum ada data ekstrakurikuler</h4>
                    <p>Data ekstrakurikuler akan segera tersedia.</p>
                </div>
            </div>
        @endforelse


        {{-- === LOOP 2: EKSTRA TANPA KATEGORI === --}}
        @if ($ekstraTanpaKategori->isNotEmpty())
            <div class="kategori-header wow fadeInUp" data-wow-delay="0.1s" id="kategori-lainnya">
                <i class="fas fa-shapes"></i> Kegiatan Lainnya
            </div>

            <div class="row g-4">
                @foreach ($ekstraTanpaKategori as $index => $v)
                    <div class="col-lg-4 col-md-6 d-flex">
                        <div class="ekstra-card d-flex flex-column" style="animation-delay: {{ ($index % 6) * 0.08 }}s">
                            
                            <div class="card-img-wrapper">
                                @if(!empty($v->foto) && file_exists(public_path('storage/' . $v->foto)))
                                    <img src="{{ asset('storage/' . $v->foto) }}" alt="{{ $v->nama }}">
                                @else
                                    <i class="fas fa-star fallback-icon"></i>
                                @endif
                            </div>
                            
                            <div class="card-body d-flex flex-column">
                                <h4 class="card-title">
                                    <i class="fas fa-star"></i> {{ $v->nama }}
                                </h4>

                                <div class="card-meta">
                                    @if(!empty($v->pembina))
                                        <span><i class="fas fa-user-tie"></i> {{ $v->pembina }}</span>
                                    @endif
                                    @if(!empty($v->jadwal))
                                        <span><i class="fas fa-calendar-alt"></i> {{ $v->jadwal }}</span>
                                    @endif
                                </div>

                                @php
                                    $limit = 140;
                                    $fullDesc = trim($v->deskripsi ?? '');
                                    $fullDesc = $fullDesc === '' ? 'Deskripsi belum tersedia.' : $fullDesc;
                                    $needsToggle = strlen($fullDesc) > $limit;
                                @endphp

                                <div class="description-container">
                                    @if ($needsToggle)
                                        <span class="description-short">{{ Str::limit($fullDesc, $limit) }}</span>
                                        <span class="description-full d-none">{{ $fullDesc }}</span>
                                    @else
                                        <span class="description-full">{{ $fullDesc }}</span>
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

            {{-- Pagination untuk ekstra tanpa kategori --}}
            @if (method_exists($ekstraTanpaKategori, 'hasPages') && $ekstraTanpaKategori->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {!! $ekstraTanpaKategori->withQueryString()->fragment('kategori-lainnya')->links('pagination::bootstrap-5') !!}
                </div>
            @endif
        @endif
        {{-- === AKHIR LOOP 2 === --}}

    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Read more toggle: event delegation untuk mendukung elemen dinamis
        document.body.addEventListener('click', function (e) {
            const toggle = e.target.closest('.read-more-toggle');
            if (!toggle) return;
            e.preventDefault();

            const cardBody = toggle.closest('.card-body');
            if (!cardBody) return;

            const shortText = cardBody.querySelector('.description-short');
            const fullText = cardBody.querySelector('.description-full');

            if (!fullText) return;

            const isHidden = fullText.classList.contains('d-none');

            if (isHidden) {
                fullText.classList.remove('d-none');
                if (shortText) shortText.classList.add('d-none');
                toggle.innerHTML = 'Sembunyikan <i class="fas fa-chevron-up"></i>';
                toggle.classList.add('active');
            } else {
                fullText.classList.add('d-none');
                if (shortText) shortText.classList.remove('d-none');
                toggle.innerHTML = 'Baca selengkapnya <i class="fas fa-chevron-down"></i>';
                toggle.classList.remove('active');
            }
        });

        // Hapus animasi delay on window resize untuk menjaga konsistensi
        window.addEventListener('resize', function () {
            document.querySelectorAll('.ekstra-card').forEach(el => el.style.animationDelay = '');
        });
    });
</script>
@endpush
