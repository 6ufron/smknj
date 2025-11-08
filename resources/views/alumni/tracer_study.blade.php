@extends('master')

@section('title', 'Daftar Alumni')

@push('styles')
<style>
    /* Search & Filter Styles */
    .alumni-filters {
        margin-bottom: 2rem;
    }
    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    .search-box {
        position: relative;
        max-width: 500px;
        margin: 0 auto 1rem;
    }
    .search-box input {
        width: 100%;
        padding: 12px 45px 12px 20px;
        border: 2px solid #e9ecef;
        border-radius: 50px;
        font-size: 13px;
        transition: all 0.3s ease;
    }
    .search-box input:focus {
        border-color: #06bbcc;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        outline: none;
    }
    .search-box i {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
    }
    
    /* Style untuk filter buttons (sekarang <a>) */
    .filter-buttons {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }
    .filter-btn {
        padding: 8px 16px;
        border: 2px solid #e9ecef;
        background: white;
        border-radius: 25px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        color: #6c757d;
        text-decoration: none; /* Baru */
    }
    .filter-btn:hover {
        border-color: #06bbcc;
        color: #06bbcc; /* Diubah */
        background: #f8f9fa; /* Baru */
    }
    .filter-btn.active {
        background: #06bbcc;
        border-color: #06bbcc;
        color: white;
    }
    .filter-btn i {
        margin-right: 5px;
    }

    /* Search highlight */
    .search-highlight {
        background-color: #ffeb3b;
        padding: 0.1em 0.2em;
        border-radius: 3px;
        font-weight: bold;
    }

    /* Quick stats */
    .search-stats {
        text-align: center;
        margin-bottom: 1rem;
        color: #6c757d;
        font-size: 0.9rem;
        font-weight: 500;
    }

    /* Status badges */
    .status-badge {
        font-size: 0.75rem;
        padding: 4px 8px;
        border-radius: 12px;
        font-weight: 600;
    }
    .status-hadir {
        background: #d1fae5;
        color: #065f46;
    }
    .status-tidak-hadir {
        background: #fee2e2;
        color: #991b1b;
    }
    .status-belum {
        background: #fef3c7;
        color: #92400e;
    }

    /* Table improvements */
    .table-alumni {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    .table-alumni th {
        background: #06bbcc;
        color: white;
        font-weight: 600;
        border: none;
        padding: 15px;
    }
    .table-alumni td {
        padding: 12px 15px;
        vertical-align: middle;
    }
    .table-alumni tbody tr {
        transition: all 0.3s ease;
    }
    .table-alumni tbody tr:hover {
        background-color: #f8f9fa;
        transform: translateY(-2px);
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
        background: #f8f9fa;
        border-radius: 15px;
        border: 2px dashed #dee2e6;
        margin: 2rem 0;
    }
    .empty-state i {
        font-size: 3rem;
        color: #6c757d;
        margin-bottom: 1rem;
        opacity: 0.7;
    }
    .empty-state h4 {
        color: #495057;
        margin-bottom: 1rem;
        font-weight: 600;
    }
    .empty-state p {
        color: #6c757d;
        max-width: 400px;
        margin: 0 auto;
    }

    .alumni-cta-box {
        margin-top: 3rem;
        padding: 2.5rem;
        background: #f8f9fa; /* Latar belakang senada */
        border-radius: 7px; /* Sesuai style Anda */
        border: 1px solid #e9ecef;
        text-align: center;
    }
    .alumni-cta-box p {
        font-size: 1.1rem;
        color: #495057;
        margin-bottom: 1.5rem;
        font-weight: 500;
    }
    .alumni-cta-box .btn-primary {
        border-radius: 50px; /* Menyamakan dengan style tombol filter */
        padding: 12px 28px;
        font-weight: 600;
        font-size: 1rem;
    }
    
    /* PENTING: Tambahkan CSS untuk loading state */
    #alumniDataContainer.loading {
        opacity: 0.5;
        pointer-events: none;
        transition: opacity 0.3s ease;
    }
    
    /* CSS Paginasi dari ekstrakurikuler (sudah rapi) */
    .pagination-container {
        margin-top: 2rem; /* Mengurangi margin atas */
    }
    .pagination {
        display: flex;
        padding-left: 0;
        list-style: none;
        justify-content: center; 
    }
    .pagination .page-link {
        border: none;
        color: var(--primary);
        padding: 10px 18px;
        margin: 0 4px;
        border-radius: 1px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none !important; 
        display: block; 
        box-shadow: none;
    }
    .pagination .page-link:hover {
        background: var(--primary);
        color: white;
    }
    .pagination .page-item.active .page-link {
        background: var(--primary);
        color: white;
        border: none;
        z-index: 3;
    }
    .pagination .page-item.disabled .page-link {
        color: #6c757d;
        background: #f8f9fa;
        pointer-events: none;
    }
    .page-item {
        margin: 0 0.25rem;
    }

</style>
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