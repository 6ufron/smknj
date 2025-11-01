@extends('master')

@section('title', 'Galeri Fasilitas SMK Nurul Jadid')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')

    {{-- KOREKSI STRUKTUR FINAL: Pembagian Variabel di awal content --}}
    @php
        // Pembagian variabel di sini, di mana $fasilitas sudah tersedia.
        $fasilitasAkademik = $fasilitas->where('kategori', 'AKADEMIK');
        $fasilitasNonAkademik = $fasilitas->where('kategori', 'NON_AKADEMIK');
    @endphp

    <style>
        /* === CSS GALERI VISUAL MODEN (KOTAK & GRADASI BINGKAI) === */

        .facility-card {
            position: relative;
            height: 350px;
            overflow: hidden;
            border-radius: 5px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            border: 3px solid transparent;
            background: #fff;
            background-clip: padding-box;
        }

        /* Efek Gradasi pada Bingkai (Border) */
        .facility-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: -1;
            margin: -3px;
            border-radius: inherit;
            background: linear-gradient(45deg, #06bbcc, #181d38, #ffc107);
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .facility-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(6, 187, 204, 0.4);
        }

        .facility-card:hover::before {
            opacity: 1;
        }

        .facility-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .facility-card:hover img {
            transform: scale(1.05);
        }

        /* OVERLAY & TEKS (PUTIH SOLID) */
        .facility-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px;
            background: linear-gradient(to top, rgba(24, 29, 56, 0.9), rgba(24, 29, 56, 0.4));
            color: white;
            /* Teks solid putih */
            min-height: 120px;
        }

        .facility-overlay h5 {
            font-weight: 700;
            margin-bottom: 5px;
            color: white;
        }

        /* KOREKSI: Pastikan teks deskripsi dan link Read More di-override menjadi putih */
        .facility-overlay p {
            margin-bottom: 0;
            line-height: 1.4;
            color: white !important;
            /* Deskripsi singkat dan penuh (putih) */
        }

        /* KODE READ MORE */
        .read-more-link {
            color: #ffc107 !important;
            /* Warna link Read More yang kontras */
            font-weight: 600;
            text-decoration: underline;
            margin-left: 5px;
            cursor: pointer;
        }

        .page-category-header {
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary);
            border-bottom: 3px solid var(--primary);
            padding-bottom: 5px;
            margin-top: 40px;
            margin-bottom: 30px !important;
        }
    </style>

    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp mb-5" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Galeri Sarana</h6>
                <h1 class="mb-5">Fasilitas Sekolah</h1>
            </div>

            @if ($fasilitas->isEmpty())
                <div class="col-12 text-center mt-5">
                    <p class="text-muted fs-5">Data fasilitas belum tersedia.</p>
                </div>
            @else
                {{-- Bagian Akademik --}}
                <h2 class="page-category-header wow fadeInUp">Fasilitas Akademik dan Praktik</h2>

                @if ($fasilitasAkademik->isEmpty())
                    <p class="text-muted text-center">Belum ada data Fasilitas Akademik yang tersedia.</p>
                @else
                    <div class="row g-4 justify-content-center">
                        @foreach ($fasilitasAkademik as $item)
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                                {{-- KOREKSI 1: Menghilangkan tautan di seluruh kartu --}}
                                <div class="facility-card shadow-lg" data-facility-id="{{ $item->id }}">
                                    <img src="{{ asset('storage/' . $item->foto_path) }}" alt="{{ $item->nama }}">

                                    <div class="facility-overlay">
                                        <h5 class="mb-1">{{ $item->nama }}</h5>

                                        @php
                                            $shortLimit = 40;
                                            $strippedContent = strip_tags($item->deskripsi);
                                            $isLong = strlen($strippedContent) > $shortLimit;
                                        @endphp

                                        <p class="small mb-0">
                                            <span class="short-desc-{{ $item->id }}">
                                                {{ Str::limit($strippedContent, $shortLimit) }}
                                            </span>

                                            @if ($isLong)
                                                <span class="full-desc-{{ $item->id }}" style="display: none;">
                                                    {{ $strippedContent }}
                                                </span>
                                                <a href="#" class="read-more-link" data-id="{{ $item->id }}">
                                                    Read More
                                                </a>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Pembatas Visual Modern --}}
                <div class="py-5 my-5"></div>

                {{-- Bagian Non-Akademik --}}
                <h2 class="page-category-header wow fadeInUp">Fasilitas Non-Akademik dan Umum</h2>

                @if ($fasilitasNonAkademik->isEmpty())
                    <p class="text-muted text-center">Belum ada data Fasilitas Non-Akademik yang tersedia.</p>
                @else
                    <div class="row g-4 justify-content-center">
                        @foreach ($fasilitasNonAkademik as $item)
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                                {{-- KOREKSI 1: Menghilangkan tautan di seluruh kartu --}}
                                <div class="facility-card shadow-lg" data-facility-id="{{ $item->id }}">
                                    <img src="{{ asset('storage/' . $item->foto_path) }}" alt="{{ $item->nama }}">

                                    <div class="facility-overlay">
                                        <h5 class="mb-1">{{ $item->nama }}</h5>

                                        @php
                                            $shortLimit = 40;
                                            $strippedContent = strip_tags($item->deskripsi);
                                            $isLong = strlen($strippedContent) > $shortLimit;
                                        @endphp

                                        <p class="small mb-0">
                                            <span class="short-desc-{{ $item->id }}">
                                                {{ Str::limit($strippedContent, $shortLimit) }}
                                            </span>

                                            @if ($isLong)
                                                <span class="full-desc-{{ $item->id }}" style="display: none;">
                                                    {{ $strippedContent }}
                                                </span>
                                                <a href="#" class="read-more-link" data-id="{{ $item->id }}">
                                                    Read More
                                                </a>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            @endif
        </div>
    </div>

    {{-- JavaScript Read More tetap dipertahankan --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.read-more-link').forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    event.stopPropagation(); // Mencegah link kartu pindah halaman

                    const itemId = this.getAttribute('data-id');
                    const shortText = document.querySelector(`.short-desc-${itemId}`);
                    const fullText = document.querySelector(`.full-desc-${itemId}`);

                    if (shortText && fullText) {
                        shortText.style.display = 'none';
                        fullText.style.display = 'inline';
                        this.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endsection