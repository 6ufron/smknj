@extends('master')

@section('title', 'Ekstrakurikuler')

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
            @foreach ($ekstrakurikulers as $v)
                <div class="col-lg-4 col-md-6 wow zoomIn d-flex" data-wow-delay="0.3s">
                    <div class="card shadow-sm border-0 w-100">
                        <img src="{{ asset('storage/' . $v->foto) }}"
                             alt="{{ $v->nama }}"
                             class="card-img-top"
                             style="height: 250px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h4 class="card-title">{{ $v->nama }}</h4>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>
<!-- Ekstrakurikuler End -->

@endsection
