@extends('master')

@section('title', 'Video SMK Nurul Jadid')

@section('content')
        <!-- Contact Start -->
        <div class="container-xxl py-5">
            <div class="container-fluid">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title bg-white text-center text-primary px-3">Galeri</h6>
                    <h1 class="mb-5">Video SMK Nurul Jadid</h1>
                </div>
                <div class="row g-5">
                    @foreach ($video as $v)
                    <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.3s">
                        {!! ($v->link_youtube) !!}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Contact End -->
@endsection