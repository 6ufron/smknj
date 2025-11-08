{{-- 
    File ini HANYA berisi tabel, empty state, dan paginasi.
    Ini adalah konten yang akan di-load oleh AJAX.
--}}

<div class="table-responsive">
    <table class="table table-alumni" id="alumniTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="alumniTableBody">
            @forelse ($alumni as $a)
            <tr class="alumni-row"> 
                {{-- Nomor sekarang sudah benar dari Paginator --}}
                <td>{{ $loop->iteration + ($alumni->currentPage() - 1) * $alumni->perPage() }}</td>
                
                <td class="alumni-name">
                    {{-- Logika highlight pencarian --}}
                    @if(!empty($search))
                        {!! str_ireplace($search, '<mark class="search-highlight">'.$search.'</mark>', $a->nama) !!}
                    @else
                        {{ $a->nama }}
                    @endif
                </td>
                <td class="alumni-jurusan">
                    @if(!empty($search))
                        {!! str_ireplace($search, '<mark class="search-highlight">'.$search.'</mark>', $a->jurusan) !!}
                    @else
                        {{ $a->jurusan }}
                    @endif
                </td>
                <td>
                    @if ($a->status == null)
                        <span class="status-badge status-belum">Belum Mengisi</span>
                    @elseif ($a->status == 'Hadir')
                        <span class="status-badge status-hadir">Hadir</span>
                    @else
                        <span class="status-badge status-tidak-hadir">Tidak Hadir</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('change_status', $a) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>
                </td>
            </tr>
            @empty
            {{-- Kosongkan tbody jika tidak ada hasil --}}
            @endforelse
        </tbody>
    </table>
</div>

<!-- Empty State (Tampil jika @forelse kosong) -->
@if($alumni->isEmpty())
<div id="emptyState" class="empty-state">
    <i class="fas fa-search"></i>
    <h4>Tidak Ada Hasil</h4>
    <p id="emptyStateMessage">Tidak ditemukan alumni yang sesuai dengan kriteria pencarian.</p>
    <a href="{{ route('tracer_study') }}" class="btn btn-primary mt-3">
        Tampilkan Semua
    </a>
</div>
@endif

<!-- Pagination (Tampil jika ada data) -->
@if($alumni->hasPages())
    <div class="pagination-container wow fadeInUp" data-wow-delay="0.4s">
        <div class="d-flex justify-content-center">
            {{-- Paginasi ini akan memiliki link AJAX secara otomatis --}}
            {!! $alumni->links('pagination::bootstrap-5') !!}
        </div>
    </div>
@endif

<!-- Search Stats (Tampil jika ada data) -->
@if($alumni->total() > 0)
<div class="search-stats mt-3" id="searchStats">
    Menampilkan {{ $alumni->firstItem() }} sampai {{ $alumni->lastItem() }} dari total {{ $alumni->total() }} alumni
</div>
@endif