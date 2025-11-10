@extends('master')

@section('title', 'Pengumuman')

@push('styles')
@endpush

@section('content')

<!-- Header -->
<div class="container-fluid bg-primary py-5 mb-5 page-header">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="display-3 text-white animated slideInDown">
                    @yield('title')
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item">
                            <a class="text-white" href="{{ route('beranda') }}">Beranda</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-white" href="#">Pages</a>
                        </li>
                        <li class="breadcrumb-item text-white active" aria-current="page">
                            @yield('title')
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Content -->
<div class="container-xxl py-5">
    <div class="container-xxl py-5 pengumuman-section">
    <div class="container">

        <!-- Header Section -->
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-primary px-3 d-inline-block">Informasi</h6>
            <h1 class="mb-5">Daftar Pengumuman</h1>
        </div>

        <!-- Search & Filters -->
        <form id="filterForm" method="GET" action="{{ route('pengumuman') }}" class="wow fadeInUp" data-wow-delay="0.2s">
            <div class="pengumuman-filters">
                <div class="filter-group">
                    <div class="search-box">
                        <input type="text" id="pengumumanSearch" name="search" placeholder="Cari Pengumuman... " value="{{ $search ?? '' }}">
                        <i class="fas fa-search"></i>
                    </div>
                    
                    <nav class="filter-buttons">
                        <a href="#" class="filter-btn {{ ($filter ?? 'all') == 'all' ? 'active' : '' }}" data-filter="all">
                            <i class="fas fa-layer-group"></i> Semua
                        </a>
                        <a href="#" class="filter-btn {{ ($filter ?? 'all') == 'month' ? 'active' : '' }}" data-filter="month">
                            <i class="fas fa-calendar-alt"></i> Bulan Ini
                        </a>
                        <a href="#" class="filter-btn {{ ($filter ?? 'all') == 'week' ? 'active' : '' }}" data-filter="week">
                            <i class="fas fa-calendar-week"></i> Minggu Ini
                        </a>
                        <a href="#" class="filter-btn {{ ($filter ?? 'all') == 'recent' ? 'active' : '' }}" data-filter="recent">
                            <i class="fas fa-clock"></i> 30 Hari Terakhir
                        </a>
                        <input type="hidden" name="filter" id="filterInput" value="{{ $filter ?? 'all' }}">
                    </nav>

                </div>
            </div>
        </form>


        <div id="pengumumanDataContainer" class="wow fadeInUp" data-wow-delay="0.3s">
        
            @include('pengumuman_partials', ['pengumumans' => $pengumumans, 'search' => $search ?? ''])
        </div>
</div>
    </div>
</div>

@endsection

@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        const dataContainer = document.getElementById('pengumumanDataContainer');
        const filterForm = document.getElementById('filterForm');
        const searchInput = document.getElementById('pengumumanSearch');
        const filterButtons = document.querySelectorAll('.filter-btn');
        const filterInput = document.getElementById('filterInput');
        
        let searchTimer;

        // Fungsi utama untuk mengambil data via AJAX
        async function fetchData(url) {
            dataContainer.classList.add('loading');
            
            try {
                const response = await fetch(url, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const html = await response.text();
                dataContainer.innerHTML = html;
                window.history.pushState(null, '', url);

            } catch (error) {
                console.error('Error fetching data:', error);
                dataContainer.innerHTML = '<div class="empty-state"><i class="fas fa-exclamation-triangle"></i><h4>Gagal Memuat Data</h4><p>Silakan coba muat ulang halaman.</p></div>';
            } finally {
                dataContainer.classList.remove('loading');
            }
        }

        // 1. Handle pencarian (dengan debounce 300ms)
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => {
                const formData = new FormData(filterForm);
                formData.delete('page'); // Hapus paginasi saat search
                const params = new URLSearchParams(formData);
                const url = `${filterForm.action}?${params.toString()}`;
                fetchData(url);
            }, 300);
        });

        // 2. Handle klik tombol filter
        filterButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault(); 
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                const filterValue = this.dataset.filter;
                filterInput.value = filterValue;

                const formData = new FormData(filterForm);
                formData.delete('page'); // Hapus paginasi saat ganti filter
                const params = new URLSearchParams(formData);
                const url = `${filterForm.action}?${params.toString()}`;
                fetchData(url);
            });
        });

        // 3. Handle klik link paginasi (menggunakan event delegation)
        dataContainer.addEventListener('click', function(e) {
            const paginationLink = e.target.closest('.pagination .page-link');
            
            if (paginationLink) {
                e.preventDefault(); 
                const url = paginationLink.getAttribute('href');
                if (url) {
                    fetchData(url);
                    // Scroll ke atas container
                    document.getElementById('pengumumanDataContainer').scrollIntoView({ behavior: 'smooth' });
                }
            }
        });

        // 4. Handle klik "Read More" (menggunakan event delegation)
        dataContainer.addEventListener('click', function(e) {
            const readMoreLink = e.target.closest('.read-more-link');
            if (!readMoreLink) return;

            e.preventDefault();
            const container = document.getElementById(readMoreLink.dataset.id);
            if (container) {
                const truncatedText = container.querySelector('.truncated-text');
                const fullText = container.querySelector('.full-text');
                
                if (truncatedText && fullText) {
                    truncatedText.style.display = 'none';
                    fullText.style.display = 'inline';
                    readMoreLink.style.display = 'none';
                }
            }
        });

    });
</script>
@endpush