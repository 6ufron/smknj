{{-- resources/views/pengumuman.blade.php --}}

@extends('master')

@section('title', 'Daftar Pengumuman SMK Nurul Jadid')

@section('content')
{{-- CSS Khusus untuk halaman ini --}}
@push('styles') {{-- Gunakan @push agar CSS ini dimuat setelah CSS master --}}
<style>
    /* Style untuk link Read More */
    .read-more-link {
        font-size: 0.9em;
        font-weight: 600;
        color: var(--bs-primary); /* Warna primer Bootstrap */
        text-decoration: none;
        cursor: pointer;
        display: inline-block; /* Agar tidak memecah baris jika teks pendek */
    }
    .read-more-link:hover {
        text-decoration: underline;
    }
    /* Pastikan list di dalam excerpt punya padding jika diperlukan */
    .excerpt-container ol,
    .excerpt-container ul {
        padding-left: 1.2rem;
        margin-top: 0.5rem;
        margin-bottom: 0; /* Hapus margin bawah default dari list */
    }
    .full-text ol, .full-text ul {
         margin-bottom: 1rem; /* Beri margin bawah pada list di teks lengkap */
    }
</style>
@endpush

    {{-- Header Halaman (opsional, bisa diaktifkan kembali jika perlu) --}}
    {{-- <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Pengumuman</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="/">Beranda</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Pengumuman</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="container-xxl py-5">
        <div class="container">

            {{-- Search Bar --}}
            <div class="row justify-content-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-lg-8">
                    <form action="{{ route('pengumuman') }}" method="GET"> {{-- Gunakan route name --}}
                        <div class="input-group">
                            <input type="text" name="search" class="form-control form-control-lg" placeholder="Cari pengumuman..." value="{{ request('search') }}">
                            <button class="btn btn-primary px-4" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Daftar Pengumuman --}}
            <div class="row g-4 justify-content-center">
                {{-- Loop data $pengumumans dari controller --}}
                @forelse ($pengumumans as $item)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="card h-100 shadow-sm border-0 d-flex flex-column">
                            <div class="card-body p-4 d-flex flex-column">
                                {{-- Tampilkan tanggal terformat dari accessor --}}
                                <small class="text-primary mb-2"><i class="fa fa-calendar-alt me-2"></i>{{ $item->formatted_published_at }}</small>
                                <h5 class="card-title mb-3">{{ $item->title }}</h5>

                                {{-- Logika Read More --}}
                                @php
                                    $fullExcerpt = $item->content; // Konten asli (bisa HTML)
                                    $limit = 100; // Batas karakter ringkasan
                                    $strippedExcerpt = strip_tags($fullExcerpt); // Konten tanpa HTML untuk cek panjang
                                    $isLong = strlen($strippedExcerpt) > $limit; // Cek apakah lebih panjang dari batas
                                    $excerptContainerId = 'excerpt-' . $item->id; // Buat ID unik
                                @endphp

                                {{-- Container untuk teks excerpt --}}
                                <div id="{{ $excerptContainerId }}" class="card-text text-muted mb-3 excerpt-container">
                                    @if ($isLong)
                                        {{-- Teks terpotong (awalnya terlihat) --}}
                                        <span class="truncated-text">
                                            {{-- Gunakan accessor $item->excerpt (yang sudah di-limit 100 char tanpa HTML) --}}
                                            {{ $item->excerpt }}
                                        </span>
                                        {{-- Teks lengkap (awalnya disembunyikan) --}}
                                        <span class="full-text" style="display: none;">
                                            {{-- Tampilkan konten asli DENGAN HTML --}}
                                            {!! $fullExcerpt !!}
                                        </span>
                                        {{-- Link Read More --}}
                                        <a href="#"
                                           class="read-more-link ms-1"
                                           data-target-id="{{ $excerptContainerId }}"> {{-- Atribut data untuk JS --}}
                                            Read More
                                        </a>
                                    @else
                                        {{-- Tampilkan teks penuh jika pendek (dengan HTML) --}}
                                        {!! $fullExcerpt !!}
                                    @endif
                                </div>
                                {{-- Akhir Logika Read More --}}

                                {{-- Tombol "Lihat" --}}
                                {{-- Gunakan link_url jika ada, jika tidak, gunakan route detail (jika ada) --}}
                                <a href="{{ $item->link_url ?? '#' }}" {{-- Ganti '#' dengan route('detail-pengumuman', $item->id) jika sudah dibuat --}}
                                   class="btn btn-outline-primary btn-sm mt-auto" {{-- mt-auto dorong ke bawah --}}
                                   @if(Str::startsWith($item->link_url, 'http')) target="_blank" @endif> {{-- Buka di tab baru jika link eksternal --}}
                                    Lihat <i class="fa fa-eye ms-2"></i>
                                </a>

                            </div> {{-- Akhir card-body --}}
                        </div> {{-- Akhir card --}}
                    </div> {{-- Akhir col --}}
                @empty {{-- Jika $pengumumans kosong --}}
                    <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                        <p class="text-muted fs-5">Pengumuman tidak ditemukan.</p>
                        {{-- Tampilkan link kembali jika sedang mencari --}}
                        @if(request('search'))
                            <p><a href="{{ route('pengumuman') }}">Lihat semua pengumuman</a></p>
                        @endif
                    </div>
                @endforelse {{-- Akhir @forelse --}}
            </div> {{-- Akhir row --}}

            {{-- Pagination Links --}}
            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-center wow fadeInUp" data-wow-delay="0.3s">
                    {{-- Tampilkan link pagination dari Laravel (sesuaikan style jika perlu) --}}
                    {{ $pengumumans->links('pagination::bootstrap-5') }}
                </div>
            </div>

        </div> {{-- Akhir container --}}
    </div> {{-- Akhir container-xxl --}}

{{-- JavaScript untuk Read More (diletakkan di stack agar dimuat setelah JS master) --}}
@push('scripts')
<script>
    // Pastikan DOMContentLoaded hanya dipanggil sekali (biasanya sudah ada di master.blade.php)
    // Jika tidak ada di master, aktifkan baris ini: document.addEventListener('DOMContentLoaded', function () {
        
        // --- KODE UNTUK READ MORE ---
        document.querySelectorAll('.read-more-link').forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah link pindah halaman
                const targetId = this.getAttribute('data-target-id'); // Ambil ID container target
                const container = document.getElementById(targetId);
                if (container) {
                    const truncatedText = container.querySelector('.truncated-text');
                    const fullText = container.querySelector('.full-text');
                    if (truncatedText && fullText) {
                        truncatedText.style.display = 'none'; // Sembunyikan teks terpotong
                        fullText.style.display = 'inline';    // Tampilkan teks lengkap
                        this.style.display = 'none';           // Sembunyikan link "Read More"
                    }
                }
            });
        });
        // --- AKHIR KODE READ MORE ---

    // Jika tidak ada DOMContentLoaded di master, aktifkan baris ini: });
</script>
@endpush

@endsection {{-- Mengakhiri bagian konten --}}