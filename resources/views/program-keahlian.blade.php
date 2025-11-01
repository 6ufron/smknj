@extends('master')

@section('title', 'Program Keahlian')

@push('styles')
<style>
    .jurusan-item-link {
        text-decoration: none;
        color: inherit;
    }
    .jurusan-item {
        background-color: #ffffff;
        padding: 2rem;
        border-radius: 12px;
        text-align: center;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.07);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        border-radius: 1px;
    }
    .jurusan-item:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    .jurusan-logo {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 1px;
        background-color: #f8f9fa;
        margin: 0 auto 1.5rem auto;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    .jurusan-content {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    .jurusan-content h4 {
        font-weight: 700;
        font-size: 1.25rem;
        color: var(--primary);
    }
    .jurusan-content p {
        color: #555;
        font-size: 0.9rem;
        line-height: 1.6;
        flex-grow: 1;
    }
    .jurusan-read-more {
        margin-top: 1rem;
        font-weight: 600;
        color: var(--primary);
        text-decoration: none;
    }
    .jurusan-read-more:hover {
        text-decoration: underline;
    }
</style>
@endpush

@section('content')

<!-- Header -->
<div class="container-fluid bg-primary py-5 mb-5 page-header">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="display-3 text-white animated slideInDown">@yield('title')</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-white" href="{{ route('beranda') }}">Beranda</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">@yield('title')</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Konten Jurusan -->
<div class="container-xxl py-5">
    <div class="container">

        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Jurusan Kami</h6>
            <h1 class="mb-5">Program Keahlian Unggulan</h1>
            <p class="mb-5" style="max-width: 700px; margin: 0 auto;">
                Kami berkomitmen menghadirkan lingkungan belajar terbaik
                untuk membentuk lulusan yang siap berdaya saing.
                Pilih program keahlian yang sesuai dengan minat dan potensi kamu!
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            @forelse ($keahlian as $jurusan)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                    <a href="{{ route('program.detail', $jurusan) }}" class="jurusan-item-link">
                        <div class="jurusan-item">
                            
                            @if($jurusan->foto)
                                <img src="{{ asset('storage/' . $jurusan->foto) }}"
                                     alt="Logo {{ $jurusan->nama }}"
                                     class="jurusan-logo">
                            @else
                                <img src="https://placehold.co/100x100/06A3DA/FFFFFF?text={{ $jurusan->singkatan }}&font=poppins"
                                     alt="Logo {{ $jurusan->nama }}"
                                     class="jurusan-logo">
                            @endif

                            <div class="jurusan-content">
                                <h4>{{ $jurusan->nama }}</h4>
                                <small class="text-muted mb-3">({{ $jurusan->singkatan }})</small>
                                <p>{{ Str::limit($jurusan->deskripsi, 120, '...') }}</p>

                                <span class="jurusan-read-more mt-auto">
                                    Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                                </span>
                            </div>

                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted fs-5">Belum ada data program keahlian yang tersedia.</p>
                </div>
            @endforelse
        </div>

        <div class="row mt-5">
            <div class="col-lg-10 col-md-12 text-center mx-auto wow fadeInUp" data-wow-delay="0.3s">
                <p>Kami terus memperbarui fasilitas, kurikulum, dan metode pembelajaran
                untuk menghasilkan generasi profesional yang siap kerja.</p>
                <p>Temukan jurusan terbaikmu.
                Wujudkan masa depan dengan keterampilan yang nyata!</p>
            </div>
        </div>

    </div>
</div>

@endsection
