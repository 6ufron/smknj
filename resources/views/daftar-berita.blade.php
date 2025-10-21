@extends('master')

@section('title', 'Daftar Berita')

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h3 class="section-title bg-white text-center text-primary px-3 mb-5">Daftar Berita</h3>
        </div>
        <div class="row g-4 justify-content-center">

            @foreach ($berita as $b)
            <div class="col-lg-4 col-md-7 wow fadeInUp" data-wow-delay="0.1s">
                <div class="course-item bg-light">
                    <div class="position-relative overflow-hidden" style="display: flex; justify-content: center; align-items: center;">
                        <img class="img" src="{{ asset ('storage/'.$b->foto) }}" alt="" height="300px;" width="auto">
                    </div>
                    <div class="text-end p-4 pb-0">
                        <div class="mb-3">
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small>({{ $b->akses }}x diakses)</small>
                        </div>
                        <h5 class="mb-4">{{ $b->judul }}</h5>
                        <p class="card-text">{!! Str::limit($b->kalimat, 200) !!}</p>
                    </div>
                    <div class="d-flex border-top">
                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar text-primary me-2"></i>{{ $b->created_at }} WIB</small>
                        <small class="flex-fill text-center border-end py-2"><i class="fas fa-tag text-primary me-2"></i>{{ $b->kategori }}</small>
                        <small class="flex-fill text-center py-2">
                            <a href="{{ route('detail-berita', $b->id) }}" class="text-danger"><b>Read More</b></a>
                        </small>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="d-flex justify-content-center">
                {{ $berita->links('pagination::bootstrap-4') }}
            </div>

        </div>
    </div>
</div>
@endsection