<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center">
                <h6 class="section-title bg-white text-center text-primary px-3">Testimonial</h6>
                <h1 class="mb-5">Our Students Say</h1>
            </div>
            <div class="owl-carousel testimonial-carousel position-relative">
                @foreach ($katalum as $k)
                <div class="testimonial-item text-center">
                    <img class="border rounded-circle p-2 mx-auto mb-3" src="{{ asset ('storage/'.$k->foto) }}" style="width: 200px; height: 200px;">
                    <h5 class="mb-0">{{ $k->nama }}</h5>
                    <p>{{ $k->pekerjaan }}</p>
                    <div class="testimonial-text bg-light text-center p-4">
                        <p class="mb-0 short-message">{!! Str::limit($k->pesan, 200) !!}</p>
                        <p class="mb-0 full-message">{!! nl2br(e($k->pesan)) !!}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>