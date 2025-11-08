<style>
    /* === Feature Card (Modern Replacement for Service Item) === */
    .feature-card {
        background: #fff;
        padding: 2.5rem 1.5rem;
        border-radius: 7px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        transform: translateY(0);
        height: 100%;
        text-align: center;
        border-top: 4px solid transparent;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        border-top-color: var(--primary);
    }

    /* Icon Wrapper (Circle Style) */
    .feature-card .icon-wrapper {
        margin: 0 auto 1.5rem;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: rgba(var(--primary-rgb), 0.1);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.4s ease;
    }

    .feature-card .icon-wrapper i {
        font-size: 2.5rem;
    }

    .feature-card:hover .icon-wrapper {
        background: var(--primary);
        color: #fff;
        transform: scale(1.1) rotate(15deg);
    }

    .feature-card h5 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #232323;
    }

    .feature-card p {
        font-size: 0.95rem;
        color: #555;
        line-height: 1.7;
    }
</style>

<div class="container-xxl py-5">
    <div class="container">

        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Keunggulan</h6>
            <h1 class="mb-5">Fasilitas Lengkap</h1>
        </div>

        <div class="row g-4">
            @forelse ($layanan as $l)
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="{{ 0.1 + ($loop->index * 0.2) }}s">
                    <div class="feature-card">
                        <div class="icon-wrapper">
                            <i class="{{ $l->icon }}"></i>
                        </div>
                        <h5 class="mb-3">{{ $l->nama }}</h5>
                        <p class="mb-0">{{ $l->deskripsi }}</p>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                    <p class="text-muted fs-5">Data layanan atau keunggulan belum tersedia.</p>
                </div>
            @endforelse
        </div>

    </div>
</div>
