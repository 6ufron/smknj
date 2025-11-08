@extends('master')

@section('title', $jurusan->nama)

@push('styles')
<style>
    .detail-jurusan-img {
        width: 100%;
        height: auto;
        object-fit: contain;
        border-radius: 7px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        display: block;
    }
    .detail-content h1 {
        font-weight: 700;
        color: var(--primary);
    }
    .detail-content p {
        font-size: 1.1rem;
        line-height: 1.7;
        color: #444;
    }
</style>
@endpush

@section('content')

<!-- Header -->
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

<!-- Detail Jurusan -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-start justify-content-center">

            <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                @if($jurusan->foto)
                    <img src="{{ asset('storage/' . $jurusan->foto) }}"
                        alt="Foto {{ $jurusan->nama }}"
                        class="detail-jurusan-img">
                @else
                    <img src="https://placehold.co/500x500?text={{ $jurusan->singkatan }}"
                        alt="Foto {{ $jurusan->nama }}"
                        class="detail-jurusan-img">
                @endif
            </div>

            <div class="col-lg-8 detail-content wow fadeInRight" data-wow-delay="0.2s">
                <span class="badge bg-primary mb-3 px-3 py-2">
                    {{ $jurusan->singkatan }}
                </span>

                <h1 class="mb-4">{{ $jurusan->nama }}</h1>

                <p class="mb-4">
                    {!! nl2br(e($jurusan->deskripsi)) !!}
                </p>

                <a href="{{ route('program.keahlian') }}"
                   class="btn btn-primary px-4 py-2 mt-3">
                    <i class="fas fa-arrow-left me-2"></i>
                    Semua Jurusan
                </a>
            </div>

        </div>
    </div>
</div>

@endsection
