@php
    use Carbon\Carbon;
    use Illuminate\Support\Str;
@endphp


@if($pengumumans->total() > 0)
<div class="search-stats mt-3 text-center" id="searchStats">
    Menampilkan {{ $pengumumans->firstItem() }} sampai {{ $pengumumans->lastItem() }} dari total {{ $pengumumans->total() }} pengumuman
</div>
@endif

<div class="row g-4 justify-content-center" id="pengumumanCardRow">
    @forelse ($pengumumans as $item)
        @php
            // Batasi deskripsi - maksimal 120 karakter
            $cleanContent = strip_tags($item->content);
            $isLong = strlen($cleanContent) > 120;
            $excerpt = $isLong ? Str::limit($cleanContent, 120) : $cleanContent;
            $id = 'item-'.$item->id;
        @endphp

        <div class="col-lg-4 col-md-6 col-12 pengumuman-card wow fadeInUp">
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
                        @if(!empty($search))
                            {!! str_ireplace($search, '<mark class="search-highlight">'.$search.'</mark>', $item->title) !!}
                        @else
                            {{ $item->title }}
                        @endif
                    </h5>

                    <!-- Content Excerpt -->
                    <div id="{{ $id }}" class="excerpt-container text-muted mb-3 flex-grow-1">
                        <span class="truncated-text">
                            @if(!empty($search) && !$isLong)
                                {!! str_ireplace($search, '<mark class="search-highlight">'.$search.'</mark>', $excerpt) !!}
                            @else
                                {{ $excerpt }}
                            @endif
                        </span>
                        <span class="full-text" style="display:none;">
                            @if(!empty($search))
                                {!! str_ireplace($search, '<mark class="search-highlight">'.$search.'</mark>', $item->content) !!}
                            @else
                                {!! $item->content !!}
                            @endif
                        </span>

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
                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                <h4 class="mb-3">Pengumuman Tidak Ditemukan</h4>
                <p class="text-muted fs-5">Tidak ada pengumuman yang cocok dengan filter atau pencarian Anda.</p>
                <a href="{{ route('pengumuman') }}" class="btn btn-primary mt-3">
                    Tampilkan Semua
                </a>
            </div>
        </div>
    @endforelse
</div>

@if($pengumumans->hasPages()) 
<div class="pagination-container wow fadeInUp" data-wow-delay="0.4s">
    <div class="d-flex justify-content-center">
        {!! $pengumumans->links('pagination::bootstrap-5') !!}
    </div>
</div>
@endif
