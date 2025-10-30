@extends('master')

@section('title', 'Daftar Pengumuman')

@push('styles')
<style>
    .read-more-link {
        font-size: 0.9em;
        font-weight: 600;
        color: var(--bs-primary);
        cursor: pointer;
        text-decoration: none;
    }
    .read-more-link:hover {
        text-decoration: underline;
    }
    .excerpt-container .full-text {
        display: none;
    }
    .excerpt-container ol,
    .excerpt-container ul {
        padding-left: 1.2rem;
        margin-top: 0.5rem;
    }
</style>
@endpush

@section('content')

<!-- Header -->
<div class="container-fluid bg-primary py-5 mb-5 page-header">
    <div class="container py-5 text-center">
        <h1 class="display-3 text-white animated slideInDown">
            @yield('title')
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item">
                    <a class="text-white" href="{{ route('beranda') }}">Beranda</a>
                </li>
                <li class="breadcrumb-item text-white active">
                    @yield('title')
                </li>
            </ol>
        </nav>
    </div>
</div>

<!-- Content -->
<div class="container-xxl py-5">
    <div class="container">

        <!-- Search Bar -->
        <form class="row justify-content-center mb-5 wow fadeInUp" method="GET" action="{{ route('pengumuman') }}" data-wow-delay="0.1s">
            <div class="col-lg-8">
                <div class="input-group">
                    <input type="text"
                           name="search"
                           class="form-control form-control-lg"
                           placeholder="Cari pengumuman..."
                           value="{{ request('search') }}">
                    <button class="btn btn-light" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Daftar Pengumuman -->
        <div class="row g-4 justify-content-center">
        @forelse ($pengumumans as $item)
            <div class="col-lg-4 col-md-6 col-12 wow fadeInUp" data-wow-delay="0.2s">
                <div class="card h-100 shadow border-0">
                    <div class="card-body d-flex flex-column p-4">

                        <small class="text-primary mb-2">
                            <i class="fa fa-calendar-alt me-2"></i>
                            {{ $item->formatted_published_at }}
                        </small>

                        <h5 class="card-title mb-3 text-dark">
                            {{ $item->title }}
                        </h5>

                        @php
                            $isLong = strlen(strip_tags($item->content)) > 100;
                            $id = 'item-'.$item->id;
                        @endphp

                        <div id="{{ $id }}" class="excerpt-container text-muted mb-3">
                            <span class="truncated-text">
                                {{ $item->excerpt }}
                            </span>

                            <span class="full-text">
                                {!! $item->content !!}
                            </span>

                            @if($isLong)
                            <a href="#" class="read-more-link" data-id="{{ $id }}">
                                Selengkapnya »
                            </a>
                            @endif
                        </div>

                        <a href="{{ $item->link_url ?? route('pengumuman-detail', $item->id) }}"
                           class="btn btn-outline-primary btn-sm mt-auto"
                           @if(!empty($item->link_url) && Str::startsWith($item->link_url, 'http')) target="_blank" @endif>
                           Lihat <i class="fa fa-eye ms-1"></i>
                        </a>

                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                <p class="text-muted fs-5">Pengumuman tidak ditemukan.</p>

                @if(request('search'))
                <a href="{{ route('pengumuman') }}" class="text-primary">
                    Tampilkan semua pengumuman
                </a>
                @endif
            </div>
        @endforelse
        </div>

        <!-- Pagination -->
        <div class="row mt-5">
            <div class="col-12 d-flex justify-content-center wow fadeInUp" data-wow-delay="0.3s">
                {{ $pengumumans->links('pagination::bootstrap-5') }}
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.read-more-link').forEach(link => {
            link.addEventListener('click', e => {
                e.preventDefault();
                const container = document.getElementById(link.dataset.id);
                container.querySelector('.truncated-text').style.display = 'none';
                container.querySelector('.full-text').style.display = 'inline';
                link.remove();
            });
        });
    });
</script>
@endpush
