@extends('master')

@section('title', 'Daftar Alumni')

@push('styles')
@endpush

@section('content')
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

<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h3 class="section-title bg-white text-center text-primary px-3 mb-5">Daftar Alumni SMK Nurul Jadid</h3>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4 wow fadeInUp" data-wow-delay="0.2s">
            <div class="col-lg-4 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-user-check fa-2x text-success mb-3"></i>
                        <h5 class="card-title">Alumni Hadir</h5>
                        <p class="card-text fs-4 fw-bold text-success">{{ $hadir }} Siswa (Alumni)</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-user-times fa-2x text-danger mb-3"></i>
                        <h5 class="card-title">Alumni Tidak Hadir</h5>
                        <p class="card-text fs-4 fw-bold text-danger">{{ $tidak_hadir }} Siswa (Alumni)</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-user-clock fa-2x text-warning mb-3"></i>
                        <h5 class="card-title">Belum Mengisi</h5>
                        <p class="card-text fs-4 fw-bold text-warning">{{ $belum_mengisi }} Siswa (Alumni)</p>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show wow fadeInUp" data-wow-delay="0.3s">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Search & Filters -->
        <div class="alumni-filters wow fadeInUp" data-wow-delay="0.3s">
            {{-- DIUBAH: Dibungkus dengan <form id="filterForm"> --}}
            <form id="filterForm" method="GET" action="{{ route('alumni') }}">
                <div class="filter-group">
                    <div class="search-box">
                        {{-- DIUBAH: Tambahkan name="search" --}}
                        <input type="text" id="alumniSearch" name="search" placeholder="Cari Nama atau Jurusan... " value="{{ $search ?? '' }}">
                        <i class="fas fa-search"></i>
                    </div>
                    
                    {{-- DIUBAH: Tombol filter sekarang adalah link <a> --}}
                    <nav class="filter-buttons">
                        <a href="#" class="filter-btn {{ ($filter ?? 'all') == 'all' ? 'active' : '' }}" data-filter="all">
                            <i class="fas fa-layer-group"></i> Semua
                        </a>
                        <a href="#" class="filter-btn {{ ($filter ?? 'all') == 'hadir' ? 'active' : '' }}" data-filter="hadir">
                            <i class="fas fa-user-check"></i> Hadir
                        </a>
                        <a href="#" class="filter-btn {{ ($filter ?? 'all') == 'tidak_hadir' ? 'active' : '' }}" data-filter="tidak_hadir">
                            <i class="fas fa-user-times"></i> Tidak Hadir
                        </a>
                        <a href="#" class="filter-btn {{ ($filter ?? 'all') == 'belum' ? 'active' : '' }}" data-filter="belum">
                            <i class="fas fa-user-clock"></i> Belum Mengisi
                        </a>
                        {{-- Input tersembunyi untuk menyimpan filteraktif --}}
                        <input type="hidden" name="filter" id="filterInput" value="{{ $filter ?? 'all' }}">
                    </nav>

                    <!-- Search Stats (dihapus dari sini, karena akan di-load oleh AJAX) -->
                </div>
            </form>
        </div>

        <!-- Alumni Table -->
        <div class="row g-4 justify-content-center wow fadeInUp" data-wow-delay="0.4s">
            <div class="col-12">
                {{-- 
                    DIUBAH: Ini adalah Target AJAX. 
                    Konten tabel, empty state, dan paginasi akan dimuat di sini.
                --}}
                <div id="alumniDataContainer">
                    {{-- 
                        Memuat tampilan tabel parsial untuk pertama kali.
                        Variabel $alumni dan $search otomatis didapat dari controller.
                    --}}
                    @include('alumni.partials.alumni_table', ['alumni' => $alumni, 'search' => $search ?? ''])
                </div>
            </div>
        </div>

        <!-- CTA Pendaftaran Alumni -->
        <div class="row justify-content-center mt-5 wow fadeInUp" data-wow-delay="0.5s">
            <div class="col-lg-10">
                <div class="alumni-cta-box">
                    <p>Data Anda belum terdaftar? Silahkan daftarkan diri Anda di form ini.</p>
                    <a href="{{ route('alumni.form') }}" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i> Buka Form Pendaftaran
                    </a>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection

@push('scripts')
{{-- === SELURUH JAVASCRIPT DIGANTI DENGAN LOGIKA AJAX === --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        const dataContainer = document.getElementById('alumniDataContainer');
        const filterForm = document.getElementById('filterForm');
        const searchInput = document.getElementById('alumniSearch');
        const filterButtons = document.querySelectorAll('.filter-btn');
        const filterInput = document.getElementById('filterInput');
        
        // Fungsi timer untuk debounce (menunggu user selesai mengetik)
        let searchTimer;

        // Fungsi utama untuk mengambil data via AJAX
        async function fetchData(url) {
            // Tampilkan loading
            dataContainer.classList.add('loading');
            
            try {
                const response = await fetch(url, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest' // Penting agar Controller tahu ini AJAX
                    }
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const html = await response.text();
                
                // Ganti konten tabel dengan HTML baru
                dataContainer.innerHTML = html;
                
                // Perbarui URL di browser
                window.history.pushState(null, '', url);

            } catch (error) {
                console.error('Error fetching data:', error);
                // Tampilkan pesan error jika gagal (opsional)
                dataContainer.innerHTML = '<p class="text-center text-danger">Gagal memuat data. Silakan coba lagi.</p>';
            } finally {
                // Hapus loading
                dataContainer.classList.remove('loading');
            }
        }

        // 1. Handle pencarian (dengan debounce 300ms)
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => {
                const formData = new FormData(filterForm);
                const params = new URLSearchParams(formData);
                params.delete('page'); // Reset paginasi ke halaman 1
                const url = `${filterForm.action}?${params.toString()}`;
                fetchData(url);
            }, 300);
        });

        // 2. Handle klik tombol filter
        filterButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault(); // Hentikan link <a>

                // Update UI tombol
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                // Set nilai filter ke input tersembunyi
                const filterValue = this.dataset.filter;
                filterInput.value = filterValue;

                // Submit form
                const formData = new FormData(filterForm);
                const params = new URLSearchParams(formData);
                params.delete('page'); // Reset paginasi ke halaman 1
                const url = `${filterForm.action}?${params.toString()}`;
                fetchData(url);
            });
        });

        // 3. Handle klik link paginasi
        // Kita gunakan event delegation karena link paginasi di-load dinamis
        dataContainer.addEventListener('click', function(e) {
            // Cek apakah yang diklik adalah link paginasi
            const paginationLink = e.target.closest('.pagination .page-link');
            
            if (paginationLink) {
                e.preventDefault(); // Hentikan link <a>
                const url = paginationLink.getAttribute('href');
                if (url) {
                    fetchData(url);
                }
            }
        });

    });
</script>
@endpush