{{-- Info Jumlah Data --}}
@if($alumni->total() > 0)
<div class="search-stats mt-3" id="searchStats">
    Menampilkan {{ $alumni->firstItem() }} sampai {{ $alumni->lastItem() }} dari total {{ $alumni->total() }} alumni
</div>
@endif

{{-- Tabel Alumni --}}
<div class="table-responsive">
    <table class="table table-alumni" id="alumniTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Tahun Lulus</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="alumniTableBody">
            @php $search = $search ?? ''; @endphp
            @forelse ($alumni as $a)
            <tr class="alumni-row"> 
                <td>{{ $loop->iteration + ($alumni->currentPage() - 1) * $alumni->perPage() }}</td>
                
                {{-- Kolom Nama --}}
                <td class="alumni-name">
                    @if(!empty($search))
                        {!! str_ireplace($search, '<mark class="search-highlight">'.$search.'</mark>', $a->nama) !!}
                    @else
                        {{ $a->nama }}
                    @endif
                </td>

                {{-- Kolom Jurusan --}}
                <td class="alumni-jurusan">
                    @if(!empty($search))
                        {!! str_ireplace($search, '<mark class="search-highlight">'.$search.'</mark>', $a->jurusan) !!}
                    @else
                        {{ $a->jurusan }}
                    @endif
                </td>

                {{-- ✅ Kolom Tahun Lulus --}}
                <td class="alumni-tahun">
                    @if(!empty($search))
                        {!! str_ireplace($search, '<mark class="search-highlight">'.$search.'</mark>', $a->tahun_lulus) !!}
                    @else
                        {{ $a->tahun_lulus ?? '-' }}
                    @endif
                </td>

                {{-- Kolom Status --}}
                <td>
                    @if ($a->status == null)
                        <span class="status-badge status-belum">Belum Mengisi</span>
                    @elseif ($a->status == 'Hadir')
                        <span class="status-badge status-hadir">Hadir</span>
                    @else
                        <span class="status-badge status-tidak-hadir">Tidak Hadir</span>
                    @endif
                </td>

                {{-- Kolom Aksi --}}
                <td>
                    <a href="{{ route('change_status', $a) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">
                    <div id="emptyState" class="empty-state text-center p-4">
                        <i class="fas fa-search fa-2x mb-3"></i>
                        <h4>Tidak Ada Hasil</h4>
                        <p id="emptyStateMessage">Tidak ditemukan alumni yang sesuai dengan kriteria pencarian.</p>
                        <a href="{{ route('alumni') }}" class="btn btn-primary mt-3">
                            Tampilkan Semua
                        </a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Pagination --}}
@if($alumni->hasPages())
<div class="pagination-container wow fadeInUp" data-wow-delay="0.4s">
    <div class="d-flex justify-content-center">
        {!! $alumni->links('pagination::bootstrap-5') !!}
    </div>
</div>
@endif


