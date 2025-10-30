@extends('master')

@section('title', 'Galeri Video')

@section('content')
<div class="container-fluid bg-primary py-5 mb-5 page-header">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="display-3 text-white animated slideInDown">@yield('title')</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-white" href="{{ route('beranda') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">@yield('title')</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Galeri Video -->
<div class="container-xxl py-5">
    <div class="container-fluid">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Galeri</h6>
            <h1 class="mb-5">Video SMK Nurul Jadid</h1>
        </div>

        <div class="row g-4">
            @foreach ($video as $v)
            <div class="col-lg-6 col-md-12">
                <div class="card shadow-sm wow zoomIn h-100" data-wow-delay="0.3s">
                    <div class="ratio ratio-16x9">
                        {!! $v->link_youtube !!}
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $v->nama_video ?? 'Video Kegiatan' }}</h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
