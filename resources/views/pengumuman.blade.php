@extends('master')

@section('title', 'Daftar Pengumuman SMK Nurul Jadid')

@section('content')
<style>
    /* Style untuk link Read More */
    .read-more-link {
    font-size: 0.9em;
    font-weight: 600;
    color: var(--bs-primary); /* Warna primer Bootstrap */
    text-decoration: none;
    cursor: pointer;
    }
    .read-more-link:hover {
        text-decoration: underline;
    }
    /* Pastikan list di dalam excerpt punya padding jika diperlukan */
    .excerpt-container ol,
    .excerpt-container ul {
        padding-left: 1.2rem; /* Sesuaikan jika perlu */
        margin-top: 0.5rem; /* Sesuaikan jika perlu */
    }
</style>

    @php
        $pengumuman = [
            [
                'id' => 1, 
                'title' => 'Informasi Kelulusan Siswa Kelas XII Tahun 2025', 
                'date' => '1 Mei 2025',
                'excerpt' => 'Informasi terkait mekanisme dan jadwal pengambilan Surat Tanda Lulus (STL) atau Surat Keterangan Lulus dan Ijazah untuk Kelas XII.',
                'link_url' => '/cek-kelulusan'
            ],
            [
                'id' => 2, 
                'title' => 'INFO TUGAS RAMADAN 1446 H & Penilaian Sumatif (PSTS)', 
                'date' => '1 April 2025',
                'excerpt' => 'Ketuntasan Tugas Libur Ramadan 1446 H merupakan salah satu prasyarat yang harus dipenuhi untuk:
                              <ol style="padding-left: 1.2rem; margin-top: 0.5rem;">
                                  <li>Penilaian Sumatif Tengah Semester (PSTS) pada 13 - 19 April 2025 (kelas X & XI)</li>
                                  <li>Pengambilan Surat Tanda Lulus (STL) / Ijazah (Kelas XII)</li>
                              </ol>',
                'link_url' => 'https://docs.google.com/forms/d/e/1FAIpQLSeUOfWMbz7hSHf1YmESB7QbxFuTFy3h-5bEWP9Uhzmq8hHA9A/viewform'
            ],
        ];
    @endphp
    {{-- ====================================================== --}}
    {{-- == AKHIR BLOK PERBAIKAN == --}}
    {{-- ====================================================== --}}


    <div class="container-xxl py-5">
        <div class="container">
            
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8">
                    <form action="/pengumuman" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control form-control-lg" placeholder="Cari pengumuman..." value="{{ request('search') }}">
                            <button class="btn btn-primary px-4" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Daftar Pengumuman --}}
            <div class="row g-4 justify-content-center">
                @forelse ($pengumuman as $item)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="card h-100 shadow-sm border-0 d-flex flex-column">
                            <div class="card-body p-4 d-flex flex-column">
                                <small class="text-primary"><i class="fa fa-calendar-alt me-2"></i>{{ $item['date'] }}</small>
                                <h5 class="card-title mt-2 mb-3">{{ $item['title'] }}</h5>

                                {{-- ============================================== --}}
                                {{-- == LOGIKA BARU UNTUK EXCERPT & READ MORE (JS) == --}}
                                {{-- ============================================== --}}
                                @php
                                    $fullExcerpt = $item['excerpt'];
                                    $limit = 100; // Batas karakter
                                    $strippedExcerpt = strip_tags($fullExcerpt);
                                    $isLong = strlen($strippedExcerpt) > $limit;
                                    $excerptContainerId = 'excerpt-' . $item['id']; // ID unik untuk container
                                @endphp

                                {{-- Container untuk teks excerpt --}}
                                <div id="{{ $excerptContainerId }}" class="card-text text-muted mb-3 excerpt-container">
                                    @if ($isLong)
                                        {{-- Teks terpotong (awalnya terlihat) --}}
                                        <span class="truncated-text">
                                            {{ Str::limit($strippedExcerpt, $limit, '...') }}
                                        </span>
                                        {{-- Teks lengkap (awalnya disembunyikan) --}}
                                        <span class="full-text" style="display: none;">
                                            {!! $fullExcerpt !!}
                                        </span>
                                        {{-- Link Read More --}}
                                        <a href="#"
                                           class="read-more-link ms-1"
                                           data-target-id="{{ $excerptContainerId }}"> {{-- Atribut data untuk JS --}}
                                            Read More
                                        </a>
                                    @else
                                        {{-- Tampilkan teks penuh jika pendek --}}
                                        {!! $fullExcerpt !!}
                                    @endif
                                </div>
                                {{-- ============================================== --}}
                                {{-- == AKHIR LOGIKA BARU == --}}
                                {{-- ============================================== --}}

                                {{-- Tombol utama untuk navigasi (Selalu "Lihat") --}}
                                <a href="{{ $item['link_url'] ?? '/pengumuman/' . $item['id'] }}"
                                   class="btn btn-outline-primary btn-sm mt-auto">
                                    Lihat <i class="fa fa-eye ms-2"></i>
                                </a>

                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted fs-5">Pengumuman tidak ditemukan.</p>
                    </div>
                @endforelse
            </div>

            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-center">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            {{-- Ganti ini dengan $pengumuman->links() saat sudah terhubung ke Controller --}}
                            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a></li>
                            <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>

<script>
            document.addEventListener('DOMContentLoaded', function () {
                
                // --- KODE UNTUK SLIDER ---
                // ... (kode slider Anda tetap di sini) ...
                // --- AKHIR KODE SLIDER ---


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
                                fullText.style.display = 'inline'; // Tampilkan teks lengkap
                                this.style.display = 'none'; // Sembunyikan link "Read More" itu sendiri
                            }
                        }
                    });
                });
                // --- AKHIR KODE READ MORE ---

            }); // <-- AKHIR DARI BLOK DOMContentLoaded
        </script>
@endsection