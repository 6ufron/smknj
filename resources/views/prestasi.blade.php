@extends('master')

@section('title', 'Galeri Prestasi')

{{-- Carbon (untuk format tanggal) --}}
@php
    use Carbon\Carbon;
@endphp

@section('content')
    <!-- Header Halaman -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">@yield('title')</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="{{ route('beranda') }}">Beranda</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">@yield('title')</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
    
    <!-- Bagian Prestasi Start -->
    <div class="container-xxl py-5">
        <div class="container-fluid">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Galeri</h6>
                <h1 class="mb-5">Prestasi SMK Nurul Jadid</h1>
            </div>
            <div class="row g-5">
                @forelse ($prestasi as $v)
                    <div class="col-lg-4 col-md-12 wow zoomIn d-flex" data-wow-delay="0.3s">
                        
                        {{-- Tambahkan class d-flex flex-column agar tinggi kartu konsisten --}}
                        <div class="card d-flex flex-column"> 
                            <img class="card-img-top" src="{{ asset('storage/' . $v->foto_prestasi) }}" alt="Foto {{ $v->judul }}" style="height: 250px; object-fit: cover;" />
                            
                            <div class="card-body d-flex flex-column flex-grow-1">
                                <h4 class="card-title">{{ $v->judul }}</h4>
                                
                                {{-- 2. Tampilkan Tanggal --}}
                                <p class="card-text text-muted mb-3">
                                    <i class="fa fa-calendar-alt text-primary me-2"></i>
                                    {{-- Asumsi nama kolom adalah 'tanggal', format tanggalnya --}}
                                    {{ Carbon::parse($v->tanggal)->isoFormat('D MMMM Y') }}
                                </p>

                                {{-- 3. Tombol Baca Selengkapnya --}}
                                {{-- Gunakan 'mt-auto' agar tombol selalu di bawah --}}
                                {{-- Asumsi nama kolom adalah 'link_url' --}}
                                {{-- <a href="{{ $v->link_url ?? 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.nuruljadid.net%2F14650%2Fsmk-nurul-jadid-berhasil-rajai-lomba-kompetensi-siswa-bidang-teknologi-informasi-tingkat-kabupaten&psig=AOvVaw1nIYqgAyW5WDpXBRuG0vfV&ust=1762008905410000&source=images&cd=vfe&opi=89978449&ved=0CBgQjhxqFwoTCLiS4enYzpADFQAAAAAdAAAAABAE' }}" class="btn btn-primary mt-auto" target="_blank" rel="noopener noreferrer">
                                    Baca Selengkapnya
                                </a> --}}
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- Tambahkan pesan jika tidak ada prestasi --}}
                    <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                        <div class="alert alert-warning" role="alert">
                            Belum ada data prestasi yang dipublikasikan.
                        </div>
                    </div>
                @endforelse
            </div>
            
             {{-- Tambahkan Pagination jika ada --}}
             @if(method_exists($prestasi, 'links'))
                <div class="mt-5 d-flex justify-content-center wow fadeInUp" data-wow-delay="0.5s">
                    {{ $prestasi->links('pagination::bootstrap-5') }}
                </div>
            @endif

        </div>
    </div>
    <!-- Contact End -->
@endsection
