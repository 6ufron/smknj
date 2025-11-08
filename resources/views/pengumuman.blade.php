@extends('master')

@section('title', 'Daftar Pengumuman')

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
    <div class="container">

        <!-- Header Section -->
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-primary px-3 d-inline-block">Informasi</h6>
            <h1 class="mb-5">Daftar Pengumuman</h1>
        </div>

        <!-- Search & Filters -->
        <div class="pengumuman-filters wow fadeInUp" data-wow-delay="0.2s">
            <div class="filter-group">
                <div class="search-box">
                    <input type="text" id="pengumumanSearch" placeholder="Cari Pengumuman... " value="{{ request('search') }}">
                    <i class="fas fa-search"></i>
                </div>
                
                <div class="filter-buttons">
                    <button class="filter-btn active" data-filter="all">
                        <i class="fas fa-layer-group"></i> Semua
                    </button>
                    <button class="filter-btn" data-filter="month">
                        <i class="fas fa-calendar-alt"></i> Bulan Ini
                    </button>
                    <button class="filter-btn" data-filter="week">
                        <i class="fas fa-calendar-week"></i> Minggu Ini
                    </button>
                    <button class="filter-btn" data-filter="recent">
                        <i class="fas fa-clock"></i> 30 Hari Terakhir
                    </button>
                </div>

                <!-- Search Stats -->
                <div class="search-stats" id="searchStats">
                    Menampilkan semua pengumuman
                </div>
            </div>
        </div>

        <!-- Daftar Pengumuman -->
        <div class="row g-4 justify-content-center" id="pengumumanContainer">
            @forelse ($pengumumans as $item)
                @php
                    // Determine status based on dates
                    $now = now();
                    $publishedAt = \Carbon\Carbon::parse($item->published_at);
                    $expiredAt = $item->expired_at ? \Carbon\Carbon::parse($item->expired_at) : null;
                    
                    $status = 'active';
                    if ($expiredAt && $now->gt($expiredAt)) {
                        $status = 'expired';
                    } elseif ($publishedAt->gt($now)) {
                        $status = 'upcoming';
                    }

                    // Check if within current month/week/recent
                    $isThisMonth = $publishedAt->month == $now->month && $publishedAt->year == $now->year;
                    $isInLast7Days = $publishedAt->diffInDays($now) <= 7;
                    $isRecent = $publishedAt->diffInDays($now) <= 30;

                    // Status badge class
                    $statusClass = match($status) {
                        'active' => 'status-active',
                        'expired' => 'status-expired',
                        'upcoming' => 'status-upcoming',
                        default => 'status-active'
                    };

                    // $statusText = match($status) {
                    //     'active' => 'Aktif',
                    //     'expired' => 'Kadaluarsa',
                    //     'upcoming' => 'Mendatang',
                    //     default => 'Aktif'
                    // };

                    // Batasi deskripsi - maksimal 120 karakter
                    $cleanContent = strip_tags($item->content);
                    $isLong = strlen($cleanContent) > 120;
                    $excerpt = $isLong ? substr($cleanContent, 0, 120) . '...' : $cleanContent;
                    $id = 'item-'.$item->id;
                @endphp

                <div class="col-lg-4 col-md-6 col-12 pengumuman-card wow fadeInUp"
                    data-month="{{ $isThisMonth ? 'true' : 'false' }}"
                    data-week="{{ $isInLast7Days ? 'true' : 'false' }}"
                    data-recent="{{ $isRecent ? 'true' : 'false' }}"
                    data-full-date="{{ $publishedAt->format('Y-m-d H:i:s') }}"
                    data-month-name="{{ $publishedAt->format('M') }}"
                    data-year="{{ $publishedAt->format('Y') }}"
                    data-title="{{ Str::slug($item->name) }}"
                    data-date="{{ $publishedAt->format('d/m/Y') }}"
                    data-reader="{{ $item->reader }}"
                >
                    <div class="card shadow border-0 h-100 d-flex flex-column">
                        <div class="card-body d-flex flex-column p-4">

                            <!-- Date -->
                            <div class="mb-2">
                                <small class="text-primary">
                                    <i class="fa fa-calendar-alt me-2"></i>
                                    {{ $item->formatted_published_at }}
                                </small>
                            </div>

                            <!-- Title -->
                            <h5 class="card-title mb-3 text-dark pengumuman-title">
                                {{ $item->title }}
                            </h5>

                            <!-- Content Excerpt -->
                            <div id="{{ $id }}" class="excerpt-container text-muted mb-3 flex-grow-1">
                                <span class="truncated-text">{{ $item->excerpt }}</span>
                                <span class="full-text" style="display:none;">{!! $item->content !!}</span>

                                @if($isLong)
                                    <a href="#" class="read-more-link" data-id="{{ $id }}">
                                        Selengkapnya »
                                    </a>
                                @endif
                            </div>

                            <!-- Button fixed bottom -->
                            <a href="{{ $item->link_url ?? route('pengumuman-detail', $item->id) }}"
                            class="btn btn-outline-primary btn-sm w-100 mt-auto"
                            @if(!empty($item->link_url) && Str::startsWith($item->link_url, 'http')) target="_blank" @endif>
                                Lihat Detail <i class="fa fa-eye ms-1"></i>
                            </a>

                        </div>
                    </div>


                </div>

            @empty
                <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                    <div class="empty-state">
                        <i class="fas fa-bullhorn fa-3x text-muted mb-3"></i>
                        <p class="text-muted fs-5">Belum ada pengumuman tersedia.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination (akan disembunyikan saat menggunakan client-side search) -->
        @if(method_exists($pengumumans, 'links') && $pengumumans->count())
            <div class="pagination-container wow fadeInUp" data-wow-delay="0.4s">
                <div class="d-flex justify-content-center">
                    {{ $pengumumans->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif

    </div>
</div>

@endsection

@push('scripts')
<script>
    // FUNGSI READ-MORE YANG SUDAH ADA - DIPERBAIKI
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

    // FUNGSI SEARCH & FILTER BARU - DIPERBAIKI
    document.addEventListener('DOMContentLoaded', function() {
        // Elements
        const filterButtons = document.querySelectorAll('.filter-btn');
        const pengumumanCards = document.querySelectorAll('.pengumuman-card');
        const searchInput = document.getElementById('pengumumanSearch');
        const pengumumanContainer = document.getElementById('pengumumanContainer');
        const searchStats = document.getElementById('searchStats');
        
        let currentFilter = 'all';
        let currentSearch = '';

        // Filter functionality
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Update active button
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                currentFilter = this.getAttribute('data-filter');
                applyFilters();
            });
        });

        // Search functionality
        searchInput.addEventListener('input', function() {
            currentSearch = this.value.toLowerCase().trim();
            applyFilters();
            
            // Hide server-side pagination when using client-side search
            const pagination = document.querySelector('.pagination');
            if (pagination) {
                pagination.style.display = currentSearch ? 'none' : 'flex';
            }
        });

        // Combined filter function - DIPERBAIKI
        function applyFilters() {
            let visibleCount = 0;

            pengumumanCards.forEach(card => {
                const title = card.getAttribute('data-title');
                const content = card.getAttribute('data-content');
                const isThisMonth = card.getAttribute('data-month') === 'true';
                const isThisWeek = card.getAttribute('data-week') === 'true';
                const isRecent = card.getAttribute('data-recent') === 'true';
                
                // Check if card matches filter - DIPERBAIKI
                let matchesFilter = true;
                switch(currentFilter) {
                    case 'month':
                        matchesFilter = isThisMonth;
                        break;
                    case 'week':
                        matchesFilter = isThisWeek;
                        break;
                    case 'recent':
                        matchesFilter = isRecent;
                        break;
                    default: // 'all'
                        matchesFilter = true;
                }
                
                // Check if card matches search
                const matchesSearch = currentSearch === '' || 
                                   title.includes(currentSearch) || 
                                   content.includes(currentSearch);
                
                if (matchesFilter && matchesSearch) {
                    card.style.display = 'block';
                    visibleCount++;
                    
                    // Highlight search term
                    if (currentSearch !== '') {
                        highlightText(card.querySelector('.pengumuman-title'), currentSearch);
                        highlightText(card.querySelector('.pengumuman-content'), currentSearch);
                    } else {
                        removeHighlight(card.querySelector('.pengumuman-title'));
                        removeHighlight(card.querySelector('.pengumuman-content'));
                    }
                } else {
                    card.style.display = 'none';
                }
            });

            // Update search stats
            updateSearchStats(visibleCount);
            
            // Show/hide empty state
            showEmptyState(visibleCount === 0);
            
            // Re-initialize read more for visible cards
            initReadMoreForVisibleCards();
        }

        // Highlight search term in text
        function highlightText(element, searchTerm) {
            if (!element) return;
            
            const text = element.textContent;
            const regex = new RegExp(`(${escapeRegExp(searchTerm)})`, 'gi');
            const highlighted = text.replace(regex, '<mark class="search-highlight">$1</mark>');
            element.innerHTML = highlighted;
        }

        // Remove highlight
        function removeHighlight(element) {
            if (!element) return;
            element.innerHTML = element.textContent;
        }

        // Escape regex special characters
        function escapeRegExp(string) {
            return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        }

        // Update search statistics
        function updateSearchStats(visibleCount) {
            const totalCount = pengumumanCards.length;
            let statsText = '';
            
            if (currentSearch && currentFilter !== 'all') {
                statsText = `Menampilkan ${visibleCount} dari ${totalCount} pengumuman (filter: ${getFilterText()} + pencarian)`;
            } else if (currentSearch) {
                statsText = `Menampilkan ${visibleCount} dari ${totalCount} pengumuman (pencarian: "${currentSearch}")`;
            } else if (currentFilter !== 'all') {
                statsText = `Menampilkan ${visibleCount} dari ${totalCount} pengumuman (filter: ${getFilterText()})`;
            } else {
                statsText = `Menampilkan semua ${totalCount} pengumuman`;
            }
            
            searchStats.textContent = statsText;
        }

        // Get filter text for display
        function getFilterText() {
            const filterTexts = {
                'all': 'Semua',
                'month': 'Bulan Ini',
                'week': 'Minggu Ini',
                'recent': '30 Hari Terakhir'
            };
            return filterTexts[currentFilter] || currentFilter;
        }

        // Show empty state when no results
        function showEmptyState(show) {
            let emptyState = document.querySelector('.empty-state-search');
            
            if (show && !emptyState) {
                emptyState = document.createElement('div');
                emptyState.className = 'empty-state-search';
                emptyState.innerHTML = `
                    <i class="fas fa-search"></i>
                    <h4>Tidak Ada Hasil</h4>
                    <p>Tidak ditemukan pengumuman ${getEmptyStateText()}.</p>
                    <button class="btn btn-primary mt-3" onclick="clearSearchAndFilter()">
                        Tampilkan Semua
                    </button>
                `;
                pengumumanContainer.appendChild(emptyState);
            } else if (!show && emptyState) {
                emptyState.remove();
            }
        }

        // Get text for empty state
        function getEmptyStateText() {
            if (currentSearch && currentFilter !== 'all') {
                return `dengan kata kunci "<strong>${currentSearch}</strong>" dalam kategori <strong>${getFilterText()}</strong>`;
            } else if (currentSearch) {
                return `dengan kata kunci "<strong>${currentSearch}</strong>"`;
            } else if (currentFilter !== 'all') {
                return `dalam kategori <strong>${getFilterText()}</strong>`;
            }
            return '';
        }

        // Initialize read more for visible cards
        function initReadMoreForVisibleCards() {
            document.querySelectorAll('.pengumuman-card').forEach(card => {
                if (card.style.display !== 'none') {
                    const readMoreLink = card.querySelector('.read-more-link');
                    if (readMoreLink) {
                        readMoreLink.addEventListener('click', function(e) {
                            e.preventDefault();
                            const container = document.getElementById(this.dataset.id);
                            if (container) {
                                const truncatedText = container.querySelector('.truncated-text');
                                const fullText = container.querySelector('.full-text');
                                
                                if (truncatedText && fullText) {
                                    truncatedText.style.display = 'none';
                                    fullText.style.display = 'inline';
                                    this.style.display = 'none';
                                }
                            }
                        });
                    }
                }
            });
        }

        // Clear search and filter function
        window.clearSearchAndFilter = function() {
            searchInput.value = '';
            currentSearch = '';
            filterButtons.forEach(btn => {
                if (btn.getAttribute('data-filter') === 'all') {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            });
            currentFilter = 'all';
            applyFilters();
        };

        // Initialize filters
        applyFilters();
    });

    // Helper function untuk init read more
    function initReadMore() {
        document.querySelectorAll('.read-more-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const container = document.getElementById(this.dataset.id);
                if (container) {
                    const truncatedText = container.querySelector('.truncated-text');
                    const fullText = container.querySelector('.full-text');
                    
                    if (truncatedText && fullText) {
                        truncatedText.style.display = 'none';
                        fullText.style.display = 'inline';
                        this.style.display = 'none';
                    }
                }
            });
        });
    }
</script>
@endpush