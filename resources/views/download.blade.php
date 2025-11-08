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
        {{-- Header Halaman - TETAP SAMA seperti semula --}}
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-primary px-3 d-inline-block">Arsip</h6>
            <h1 class="mb-5">Download Dokumen</h1>
        </div>

        <!-- Search & Filters -->
        <div class="filter-group">
            <div class="search-box">
                <input type="text" id="documentSearch" placeholder="Cari Dokumen...">
                    <i class="fas fa-search"></i>
            </div>
                 <div class="filter-buttons">
                    <button class="filter-btn active" data-filter="all">Semua</button>
                    <button class="filter-btn" data-filter="pdf">PDF</button>
                    <button class="filter-btn" data-filter="doc">DOC</button>
                    <button class="filter-btn" data-filter="xls">Excel</button>
                    {{-- <button class="filter-btn" data-filter="csv">CSV</button> --}}
                    {{-- <button class="filter-btn" data-filter="audio">Audio</button>
                    <button class="filter-btn" data-filter="video">Video</button>
                    <button class="filter-btn" data-filter="image">Gambar</button> --}}
                    <button class="filter-btn" data-filter="zip">Archive</button>
                </div>
            </div>   

        <!-- Documents Grid -->
        <div class="documents-grid">
            @forelse ($downloads as $index => $item)
                @php
                    $ext = pathinfo($item->file_path, PATHINFO_EXTENSION);
                    $fileType = match(strtolower($ext)) {
                        'pdf' => 'pdf',
                        'doc', 'docx' => 'doc',
                        'xls', 'xlsx' => 'xls',
                        'csv' => 'csv',
                        'zip', 'rar', '7z' => 'zip',
                        // 'mp3', 'wav', 'aac', 'ogg', 'flac' => 'audio',
                        // 'mp4', 'avi', 'mov', 'wmv', 'mkv', 'flv' => 'video',
                        // 'jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'svg' => 'image',
                        default => 'default',
                    };
                    
                    $iconClass = match($fileType) {
                        'pdf' => 'fas fa-file-pdf',
                        'doc' => 'fas fa-file-word',
                        'xls' => 'fas fa-file-excel',
                        'csv' => 'fas fa-file-csv',
                        'zip' => 'fas fa-file-archive',
                        // 'audio' => 'fas fa-file-audio',
                        // 'video' => 'fas fa-file-video',
                        // 'image' => 'fas fa-file-image',
                        default => 'fas fa-file',
                    };

                    // Calculate file size
                    $fileSize = '—';
                    if ($item->file_path && file_exists(storage_path('app/public/' . $item->file_path))) {
                        $size = filesize(storage_path('app/public/' . $item->file_path));
                        if ($size >= 1073741824) {
                            $fileSize = number_format($size / 1073741824, 1) . ' GB';
                        } elseif ($size >= 1048576) {
                            $fileSize = number_format($size / 1048576, 1) . ' MB';
                        } elseif ($size >= 1024) {
                            $fileSize = number_format($size / 1024, 1) . ' KB';
                        } else {
                            $fileSize = $size . ' B';
                        }
                    }
                @endphp

                <div class="document-card wow fadeInUp" data-wow-delay="{{ 0.3 + ($index * 0.1) }}s" 
                     data-file-type="{{ $fileType }}" data-title="{{ strtolower($item->title) }}"
                     style="animation-delay: {{ $index * 0.1 }}s">
                    
                    <div class="document-card-header">
                        <div class="document-icon {{ $fileType }}">
                            <i class="{{ $iconClass }} text-white"></i>
                        </div>
                        <div class="document-info">
                            <h3 class="document-title">{{ $item->title }}</h3>
                            @if($item->description)
                                <p class="document-description">{{ $item->description }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="document-card-body">
                        <div class="document-meta">
                            <div class="document-type">
                                <span class="file-badge {{ $fileType }}">
                                    {{ strtoupper($ext) }}
                                </span>
                            </div>
                            <div class="document-details">
                                <div class="document-date">
                                    <i class="far fa-calendar me-1"></i>
                                    {{ Carbon::parse($item->created_at)->isoFormat('D MMM Y') }}
                                </div>
                                <div class="document-size">
                                    <i class="fas fa-weight-hanging me-1"></i>
                                    {{ $fileSize }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="document-actions">
                        @if ($item->file_path && file_exists(storage_path('app/public/' . $item->file_path)))
                            <a href="{{ asset('storage/' . $item->file_path) }}" 
                               class="btn btn-outline-primary btn-sm rounded-pill px-3 w" 
                               target="_blank" 
                               download
                               onclick="incrementDownloadCount({{ $item->id }})">
                                <i class="fa fa-download me-1"></i>
                                Download
                            </a>
                            {{-- <a href="
                            {{ route('dokumen.show', $item->id) }}
                             " class="view-btn">
                                <i class="fas fa-eye me-1"></i>
                                Lihat Detail
                            </a> --}}
                        @else
                            <span class="download-btn missing">
                                <i class="fas fa-exclamation-triangle me-1"></i>
                                File Tidak Tersedia
                            </span>
                        @endif
                        
                        {{-- <div class="download-count">
                            <i class="fas fa-download"></i>
                            {{ $item->download_count ?? 0 }}
                        </div> --}}
                    </div>
                </div>
            @empty
                <div class="empty-state wow fadeInUp" data-wow-delay="0.3s">
                    <i class="fas fa-folder-open"></i>
                    <h4>Belum Ada Dokumen Tersedia</h4>
                    <p>Dokumen akan segera diupload dan dapat diunduh di sini.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if(method_exists($downloads, 'links') && $downloads->count())  
            <div class="pagination-container wow fadeInUp" data-wow-delay="0.4s">
                <div class="d-flex justify-content-center">
                    {{ $downloads->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Elements
        const filterButtons = document.querySelectorAll('.filter-btn');
        const documentCards = document.querySelectorAll('.document-card');
        const searchInput = document.getElementById('documentSearch');
        const documentsContainer = document.getElementById('documentsContainer');
        
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

        // Search functionality - improved
        searchInput.addEventListener('input', function() {
            currentSearch = this.value.toLowerCase().trim();
            applyFilters();
        });

        // Combined filter function
        function applyFilters() {
            let visibleCount = 0;
            let hasVisibleItems = false;

            documentCards.forEach(card => {
                const fileType = card.getAttribute('data-file-type');
                const title = card.querySelector('.document-title').textContent.toLowerCase();
                const description = card.querySelector('.document-description')?.textContent.toLowerCase() || '';
                
                // Check if card matches both filter and search
                const matchesFilter = currentFilter === 'all' || fileType === currentFilter;
                const matchesSearch = currentSearch === '' || 
                                   title.includes(currentSearch) || 
                                   description.includes(currentSearch);
                
                if (matchesFilter && matchesSearch) {
                    card.style.display = 'block';
                    visibleCount++;
                    hasVisibleItems = true;
                    
                    // Highlight search term in title
                    if (currentSearch !== '') {
                        highlightText(card.querySelector('.document-title'), currentSearch);
                    } else {
                        removeHighlight(card.querySelector('.document-title'));
                    }
                } else {
                    card.style.display = 'none';
                }
            });

            // Show/hide empty state
            showEmptyState(!hasVisibleItems);
            
            // Add animation to visible cards
            animateVisibleCards();
        }

        // Highlight search term in text
        function highlightText(element, searchTerm) {
            const text = element.textContent;
            const regex = new RegExp(`(${searchTerm})`, 'gi');
            const highlighted = text.replace(regex, '<mark class="search-highlight">$1</mark>');
            element.innerHTML = highlighted;
        }

        // Remove highlight
        function removeHighlight(element) {
            element.innerHTML = element.textContent;
        }

        // Show empty state when no results
        function showEmptyState(show) {
            let emptyState = document.querySelector('.empty-state-search');
            
            if (show && !emptyState) {
                emptyState = document.createElement('div');
                emptyState.className = 'empty-state wow fadeInUp empty-state-search';
                emptyState.innerHTML = `
                    <i class="fas fa-search"></i>
                    <h4>Tidak Ada Hasil Pencarian</h4>
                    <p>Tidak ditemukan dokumen dengan kata kunci "<strong>${currentSearch}</strong>"${currentFilter !== 'all' ? ` dalam kategori ${currentFilter.toUpperCase()}` : ''}.</p>
                    <button class="btn btn-primary mt-3" onclick="clearSearch()">
                        <i class="fas fa-times me-2"></i>Hapus Pencarian
                    </button>
                `;
                documentsContainer.appendChild(emptyState);
            } else if (!show && emptyState) {
                emptyState.remove();
            }
        }

        // Animate visible cards with staggered effect
        function animateVisibleCards() {
            const visibleCards = Array.from(documentCards).filter(card => 
                card.style.display !== 'none'
            );
            
            visibleCards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
                card.classList.add('wow', 'fadeInUp');
            });
        }

        // Clear search function
        window.clearSearch = function() {
            searchInput.value = '';
            currentSearch = '';
            applyFilters();
        };

        // Initialize
        applyFilters();
    });

    // Function to increment download count (tetap sama)
    function incrementDownloadCount(downloadId) {
        fetch(`/api/downloads/${downloadId}/increment`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).catch(error => console.error('Error:', error));
    }
</script>
@endpush