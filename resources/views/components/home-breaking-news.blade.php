<div class="container-xxl py-5 container-news">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Info Sekolah</h6>
                <h1 class="mb-5">Berita Terbaru</h1>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach ($berita as $b)
                <div class="col-lg-4 col-md-6 wow fadeInUp mt-3" data-wow-delay="0.1s">
                    <div class="course-item bg-light d-flex flex-column h-100">
                        <div class="position-relative overflow-hidden" style="display: flex; justify-content: center; align-items: center;">
                            <img class="img-fluid w-100" src="{{ asset('storage/berita/'.$b->foto) }}" alt="{{ $b->judul }}" style="height: 250px; object-fit: cover;">
                        </div>
                        <div class="p-4 pb-0 d-flex flex-column flex-grow-1">
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small>({{ $b->akses }}x diakses)</small>
                            </div>
                            <h5 class="mb-4">{{ $b->judul }}</h5>
                            <p class="card-text">{!! Str::limit(strip_tags($b->kalimat), 200) !!}</p>
                        </div>
                        <div class="d-flex border-top">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar text-primary me-2"></i>{{ $b->created_at }} WIB</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fas fa-tag text-primary me-2"></i>{{ $b->kategori }}</small>
                            <small class="flex-fill text-center py-2">
                                <a href="{{ route('detail-berita', $b->id) }}" class="text-danger" target="_blank"><b>Read More</b></a>
                            </small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>