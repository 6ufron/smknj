@extends('master')

@section('title', 'Visi & Misi')

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
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h3 class="section-title bg-white text-center text-primary px-3">Visi & Misi</h3>
            <h1 class="mb-5">SMK Nurul Jadid</h1>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach ($vimisi as $b)
            <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <p class="">{!! nl2br(e($b->kalimat)) !!}</p>
            </div>
            <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <img src="{{ asset('storage/'.$b->foto) }}" alt="" class="w-100 h-100" style="border-radius: 7px">
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection