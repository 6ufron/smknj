@php
    use Carbon\Carbon; 
@endphp

@if($downloads->total() > 0)
<div class="search-stats mt-3 text-center" id="searchStats">
    Menampilkan {{ $downloads->firstItem() }} sampai {{ $downloads->lastItem() }} dari total {{ $downloads->total() }} dokumen
</div>
@endif
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
                default => 'default',
            };
            
            $iconClass = match($fileType) {
                'pdf' => 'fas fa-file-pdf',
                'doc' => 'fas fa-file-word',
                'xls' => 'fas fa-file-excel',
                'csv' => 'fas fa-file-csv',
                'zip' => 'fas fa-file-archive',
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

        <div class="document-card wow fadeInUp" data-wow-delay="{{ 0.1 + (($index % 6) * 0.1) }}s"
             style="animation-delay: {{ ($index % 6) * 0.1 }}s">
            
            <div class="document-card-header">
                <div class="document-icon {{ $fileType }}">
                    <i class="{{ $iconClass }} text-white"></i>
                </div>
                <div class="document-info">
                    <h3 class="document-title">
                        @if(!empty($search))
                            {!! str_ireplace($search, '<mark class="search-highlight">'.$search.'</mark>', $item->title) !!}
                        @else
                            {{ $item->title }}
                        @endif
                    </h3>
                    @if($item->description)
                        <p class="document-description">
                        @if(!empty($search))
                            {!! str_ireplace($search, '<mark class="search-highlight">'.$search.'</mark>', $item->description) !!}
                        @else
                            {{ $item->description }}
                        @endif
                        </p>
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
                    {{-- Panggil rute download yang benar --}}
                    <a href="{{ route('dokumen.download', $item->id) }}" 
                       class="btn btn-outline-primary btn-sm rounded-pill px-3 w" 
                       {{-- Hapus target="_blank" dan download agar rute controller yang bekerja --}}
                       >
                        <i class="fa fa-download me-1"></i>
                        Download
                    </a>
                @else
                    <span class="download-btn missing">
                        <i class="fas fa-exclamation-triangle me-1"></i>
                        File Tidak Tersedia
                    </span>
                @endif
            </div>
        </div>
    @empty

        <div class="col-12" style="grid-column: 1 / -1;">
            <div class="empty-state wow fadeInUp" data-wow-delay="0.3s">
                <i class="fas fa-folder-open"></i>
                <h4>Tidak Ada Dokumen Ditemukan</h4>
                <p>Tidak ada dokumen yang cocok dengan filter atau pencarian Anda.</p>
                <a href="{{ route('download.index') }}" class="btn btn-primary mt-3">
                    Tampilkan Semua
                </a>
            </div>
        </div>
    @endforelse
</div>

@if($downloads->hasPages()) 
<div class="pagination-container wow fadeInUp" data-wow-delay="0.4s">
    <div class="d-flex justify-content-center">
        {!! $downloads->links('pagination::bootstrap-5') !!}
    </div>
</div>
@endif