<div class="container-xxl py-5 category">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Galeri</h6>
            <h1 class="mb-5">Video SMK-NJ</h1>
        </div>
        <div class="row">
            @foreach ($video as $v)
            <div class="col-lg-6 col-md-12 wow zoomIn mb-4" data-wow-delay="0.3s">
                {!! ($v->link_youtube) !!}
            </div>
            @endforeach
        </div>
    </div>
</div>