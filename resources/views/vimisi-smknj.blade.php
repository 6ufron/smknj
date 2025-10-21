@extends('master')

@section('title', 'Visi & Misi SMK Nurul Jadid')

@section('content')
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
                <img src="{{ asset('storage/'.$b->foto) }}" alt="" class="w-100 h-100" style="border-radius: 15px">
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection