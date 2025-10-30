@extends('master')

@section('title', 'Detail Berita')

@section('content')

<div class="container-fluid bg-primary py-5 mb-5 page-header">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="display-3 text-white animated slideInDown">{{ $berita->judul }}</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item">
                            <a class="text-white" href="{{ route('beranda') }}">Beranda</a>
                        </li>
                        <li class="breadcrumb-item text-white">Pages</li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Detail Berita</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-4 justify-content-center">
            <div class="col-lg-10">

                <div class="card shadow-sm border-0">
                    
                    <div class="text-center p-3">
                        <img src="{{ asset('storage/' . $berita->foto) }}"
                             class="img-fluid rounded"
                             style="max-height: 450px; object-fit: cover;"
                             alt="Foto Berita {{ $berita->judul }}">
                    </div>

                    <div class="card-body px-4 px-md-5">

                        <h3 class="card-title fw-bold text-center mb-4">{{ $berita->judul }}</h3>

                        <p class="card-text lh-lg">
                            {!! nl2br(e($berita->kalimat)) !!}
                        </p>

                        <div class="d-flex justify-content-center align-items-center flex-wrap border-top pt-3 mt-4 text-center small text-muted">

                            <span class="px-3">
                                <i class="fa fa-calendar text-primary me-2"></i>
                                {{ \Carbon\Carbon::parse($berita->created_at)->format('d M Y') }} WIB
                            </span>

                            <span class="px-3">
                                <i class="fas fa-tag text-primary me-2"></i>
                                {{ $berita->kategori }}
                            </span>

                            <span class="px-3">
                                <i class="fa fa-eye text-primary me-2"></i>
                                Dilihat {{ $berita->akses }} kali
                            </span>

                            <span class="px-3">
                                <a href="{{ route('berita-sekolah') }}" class="text-danger fw-bold">
                                    Kembali
                                </a>
                            </span>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

@endsection
