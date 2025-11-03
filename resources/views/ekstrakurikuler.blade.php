@extends('master')

@section('title', 'Ekstrakurikuler')

@push('styles')
<style>
    .ekstra-card {
        border-radius: 1px; 
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid #e9ecef; 
        height: 100%; 
    }

    .ekstra-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1) !important;
    }

    /* Memaksa card-body menggunakan flex-column dan rata kiri */
    .ekstra-card .card-body {
        text-align: left;
        display: flex;
        flex-direction: column;
        flex-grow: 1; /* Agar body mengisi sisa ruang */
    }

    /* Memastikan gambar tidak pecah dari card-img-top */
    .ekstra-card .card-img-top {
        border-top-left-radius: 1px;
        border-top-right-radius: 1px;
    }
    
    .ekstra-card .card-title {
        font-weight: 600;
        color: #333;
    }

    /* Style untuk deskripsi */
    .description-container {
        font-size: 0.95rem;
        color: #555;
        line-height: 1.6;
        flex-grow: 1; /* Mendorong tombol toggle ke bawah */
    }

    /* Style untuk tombol "Baca selengkapnya" */
    .read-more-toggle {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--primary);
        text-decoration: none;
        margin-top: auto; /* Mendorong tombol ke bagian bawah card-body */
        padding-top: 10px; /* Jarak dari teks deskripsi */
    }
    .read-more-toggle:hover {
        text-decoration: underline;
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
                        <li class="breadcrumb-item text-white">Pages</li>
                        <li class="breadcrumb-item text-white active" aria-current="page">
                            @yield('title')
                        </li>
                    </ol>
                </nav>

            </div>
        </div>
    </div>
</div>

<!-- Ekstrakurikuler Start -->
<div class="container-xxl py-5">
    <div class="container-fluid">

        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">
                Ekstrakurikuler
            </h6>
            <h1 class="mb-5">
                Ekstrakurikuler SMK Nurul Jadid
            </h1>
        </div>

        <div class="row g-5 justify-content-center">
            @forelse ($ekstrakurikulers as $v)
                <div class="col-lg-4 col-md-6 wow zoomIn d-flex" data-wow-delay="0.3s">
                    
                    <div class="card shadow-sm border-0 w-100 d-flex flex-column ekstra-card">
                        <img src="{{ asset('storage/' . $v->foto) }}"
                             alt="{{ $v->nama }}"
                             class="card-img-top"
                             style="height: 250px; object-fit: cover;">
                        
                        <div class="card-body d-flex flex-column flex-grow-1 text-start">
                            <h4 class="card-title mb-2">{{ $v->nama }}</h4>

                            {{-- "Baca Selengkapnya" --}}
                            @php
                                $limit = 100;
                                // Asumsi kolom deskripsi adalah 'deskripsi'
                                $fullDesc = $v->deskripsi ?? 'Deskripsi untuk ekstrakurikuler ini belum tersedia.'; 
                                $needsToggle = strlen($fullDesc) > $limit;
                            @endphp
                            
                            <p class="card-text description-container">
                            @if ($needsToggle)
                                {{-- Teks singkat (ditampilkan awalnya) --}}
                                <span class="description-short">
                                    {!! nl2br(e(Str::limit($fullDesc, $limit))) !!}
                                </span>
                                {{-- Teks lengkap (disembunyikan awalnya) --}}
                                <span class="description-full" style="display: none;">
                                    {!! nl2br(e($fullDesc)) !!}
                                </span>
                            @else
                                {{-- Tampilkan teks lengkap jika di bawah limit --}}
                                <span class="description-full" style="display: inline;">
                                    {!! nl2br(e($fullDesc)) !!}
                                </span>
                            @endif
                            </p>

                            {{-- Tombol "Baca Selengkapnya" --}}
                            @if ($needsToggle)
                                <a href="javascript:void(0);" class="read-more-toggle">Baca selengkapnya</a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                    <div class="alert alert-warning" role="alert">
                        Belum ada data ekstrakurikuler yang dipublikasikan.
                    </div>
                </div>
            @endforelse
        </div>
        
        {{-- Pagination (jika ada) --}}
         @if(method_exists($ekstrakurikulers, 'links'))
            <div class="mt-5 d-flex justify-content-center wow fadeInUp" data-wow-delay="0.5s">
                {{ $ekstrakurikulers->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>
</div>
<!-- Ekstrakurikuler End -->

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Cari semua tombol "Baca selengkapnya"
        const toggles = document.querySelectorAll('.read-more-toggle');

        toggles.forEach(toggle => {
            toggle.addEventListener('click', function (e) {
                e.preventDefault();

                // 1. Cari '.card-body' terdekat (parent)
                const cardBody = this.closest('.card-body');
                if (!cardBody) return; // Hentikan jika tidak ketemu

                // 2. Dari card-body, cari '.description-container' (sibling tombol)
                const container = cardBody.querySelector('.description-container');
                if (!container) return; // Hentikan jika tidak ketemu

                // 3. cari teks di dalam container
                const shortText = container.querySelector('.description-short');
                const fullText = container.querySelector('.description-full');

                if (!shortText || !fullText) return; 

                // Cek status saat ini (apakah teks lengkap sedang disembunyikan)
                const isHidden = fullText.style.display === 'none';

                if (isHidden) {
                    // Tampilkan teks lengkap
                    fullText.style.display = 'inline';
                    shortText.style.display = 'none';
                    this.textContent = 'Sembunyikan'; // Ubah teks tombol
                } else {
                    // Sembunyikan teks lengkap
                    fullText.style.display = 'none';
                    shortText.style.display = 'inline';
                    this.textContent = 'Baca selengkapnya'; 
                }
            });
        });
    });
</script>
@endpush

