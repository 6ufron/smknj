@extends('master')

@section('title', 'Download')

@php
    use Carbon\Carbon;
@endphp

@push('styles')
@endpush

@section('content')
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

<div class="container-xxl py-5 document-section">
    <div class="container">
        {{-- Header Halaman --}}
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-primary px-3 d-inline-block">Arsip</h6>
            <h1 class="mb-5">Download Dokumen</h1>
        </div>

        <!-- Search & Filters -->
        <form id="filterForm" method="GET" action="{{ route('download.index') }}" class="wow fadeInUp" data-wow-delay="0.2s">
            <div class="filter-group">
                <div class="search-box">
                    <input type="text" id="documentSearch" name="search" placeholder="Cari Dokumen..." value="{{ $search ?? '' }}">
                    <i class="fas fa-search"></i>
                </div>
                <nav class="filter-buttons">
                    <a href="#" class="filter-btn {{ ($filter ?? 'all') == 'all' ? 'active' : '' }}" data-filter="all">Semua</a>
                    <a href="#" class="filter-btn {{ ($filter ?? 'all') == 'pdf' ? 'active' : '' }}" data-filter="pdf">PDF</a>
                    <a href="#" class="filter-btn {{ ($filter ?? 'all') == 'doc' ? 'active' : '' }}" data-filter="doc">DOC</a>
                    <a href="#" class="filter-btn {{ ($filter ?? 'all') == 'xls' ? 'active' : '' }}" data-filter="xls">Excel</a>
                    <a href="#" class="filter-btn {{ ($filter ?? 'all') == 'zip' ? 'active' : '' }}" data-filter="zip">Archive</a>
                    <input type="hidden" name="filter" id="filterInput" value="{{ $filter ?? 'all' }}">
                </nav>
            </div>
        </form>

        <!-- Documents Grid -->
        {{-- Ini adalah Target AJAX --}}
        <div id="documentDataContainer" class="wow fadeInUp" data-wow-delay="0.3s">
            {{-- Memuat tampilan tabel parsial untuk pertama kali --}}
            @include('download_partials', ['downloads' => $downloads, 'search' => $search ?? ''])
        </div>

    </div>
</div>
@endsection

@push('scripts')
{{-- === SELURUH JAVASCRIPT DIGANTI DENGAN LOGIKA AJAX === --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        const dataContainer = document.getElementById('documentDataContainer');
        const filterForm = document.getElementById('filterForm');
        const searchInput = document.getElementById('documentSearch');
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
                // Pastikan parameter 'page' dihapus saat melakukan pencarian baru
                formData.delete('page'); 
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
                // Pastikan parameter 'page' dihapus saat ganti filter
                formData.delete('page'); 
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
                    // Ambil URL dan tambahkan #documentDataContainer agar halaman scroll ke atas
                    const urlWithFragment = new URL(url);
                    urlWithFragment.hash = 'documentDataContainer';
                    fetchData(urlWithFragment.href);

                    // Scroll ke atas container
                    document.getElementById('documentDataContainer').scrollIntoView({ behavior: 'smooth' });
                }
            }
        });
        
        // Fungsi ini tidak lagi diperlukan karena controller yang menangani
        // function incrementDownloadCount(downloadId) { ... }
    });
</script>
@endpush