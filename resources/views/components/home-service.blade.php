<div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                @foreach ($layanan as $l)
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="{{ $l->icon }} fa-3x text-primary mb-4"></i>
                            <h5 class="mb-3">{{ $l->nama }}</h5>
                            <p>{{ $l->deskripsi }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>