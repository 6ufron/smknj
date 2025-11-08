@extends('master')

@section('title', 'Daftar Berita')

@php
use Illuminate\Support\Str;
@endphp

@section('content')

<style>
    /* Kartu Berita */
    .course-item {
        background: #ffffff;
        border-radius: 7px;
        overflow: hidden;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        border: 1px solid #e6e6e6;
    }

    .course-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    }

    /* Kontainer Gambar */
    .img-container {
        width: 100%;
        height: 220px;
        background: #fafafa;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    .img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.35s ease;
    }

    .course-item:hover .img-container img {
        transform: scale(1.05);
    }

    /* Isi Konten */
    .course-item h5 {
        font-weight: 700;
        color: #202020;
        line-height: 1.35;
        min-height: 48px;
    }

    .course-item p {
        font-size: 0.92rem;
        color: #555;
        min-height: 65px;
    }

    .course-item small {
        font-size: 0.85rem;
        color: #444;
    }

    .course-item .text-danger {
        font-weight: 600;
    }

    /* Breadcrumb */
    .page-header nav .breadcrumb-item a {
        opacity: 0.9;
        text-decoration: none;
    }

    .page-header nav .breadcrumb-item a:hover {
        opacity: 1;
    }

    /* Pagination Rapi */
    .page-link {
        border-radius: 0px !important;
    }

    .page-item.active .page-link {
        background-color: #06bbcc;
        border-color: #06bbcc;
    }
</style>


<!-- Header Halaman -->
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
<!-- Header End -->

<!-- Daftar Berita -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h3 class="section-title bg-white text-center text-primary px-3 mb-5">Daftar Berita</h3>
        </div>

        <div class="row g-4 justify-content-center">

            @foreach ($berita as $b)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="course-item h-100 d-flex flex-column">

                    <div class="position-relative overflow-hidden img-container">
                        <img src="{{ asset('storage/' . $b->foto) }}" alt="Foto {{ $b->judul }}">
                    </div>

                    <div class="text-end p-4 pb-0 flex-grow-1 d-flex flex-column">
                        <div class="mb-3">
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small>({{ $b->akses }}x diakses)</small>
                        </div>

                        <h5 class="mb-4">{{ $b->judul }}</h5>
                        <p class="card-text flex-grow-1">{!! Str::limit($b->kalimat, 100) !!}</p>
                    </div>

                    <div class="d-flex border-top mt-auto">
                        <small class="flex-fill text-center border-end py-2">
                            <i class="fa fa-calendar text-primary me-2"></i>
                            {{ \Carbon\Carbon::parse($b->created_at)->format('d M Y') }}
                        </small>

                        <small class="flex-fill text-center border-end py-2">
                            <i class="fas fa-tag text-primary me-2"></i>{{ $b->kategori }}
                        </small>

                        <small class="flex-fill text-center py-2">

                            <a href="{{ route('detail-berita', $b) }}" class="text-danger"><b>Baca Selengkapnya</b></a>
                        </small>
                    </div>

                </div>
            </div>
            @endforeach

            <!-- Pagination -->
            @if(method_exists($berita, 'links') && $berita->count())
                <div class="pagination-container wow fadeInUp" data-wow-delay="0.4s">
                    <div class="d-flex justify-content-center">
                        {{ $berita->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
<!-- End -->

@endsection