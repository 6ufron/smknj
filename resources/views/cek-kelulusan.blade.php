@extends('master')

@section('title', 'Informasi Kelulusan')

@push('styles')
@endpush

@section('content')
<!-- Header -->
<div class="container-fluid bg-primary py-5 mb-5 page-header">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="display-3 text-white">@yield('title')</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-white" href="{{ route('beranda') }}">Beranda</a></li>
                        <li class="breadcrumb-item text-white">Pages</li>
                        <li class="breadcrumb-item text-white active" aria-current="page">@yield('title')</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <!-- Form -->
                <div class="graduation-card p-5 mb-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold" style="color: var(--primary);">Cek Kelulusan</h2>
                        <p class="text-muted">Masukkan data diri Anda untuk melihat informasi kelulusan</p>
                        <span class="info-badge"><i class="fas fa-info-circle me-2"></i>Data bersifat rahasia dan aman</span>
                    </div>

                    {{-- === BLOK ALERT DI DALAM KARTU DIHAPUS === --}}
                    {{-- @if (session('status')) ... @endif --}}
                    {{-- @elseif (session('error')) ... @endif --}}

                    <form id="graduationForm" action="{{ route('hasil-kelulusan') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="nisn" class="form-label-modern"><i class="fas fa-id-card me-2"></i>NISN</label>
                            <input type="text" class="form-control form-control-modern" id="nisn" name="nisn"
                                placeholder="Contoh: 0038123456" required pattern="[0-9]{10}" title="Masukkan 10 digit NISN">
                        </div>
                        <div class="mb-4">
                            <label for="tanggal_lahir" class="form-label-modern"><i class="fas fa-calendar-alt me-2"></i>Tanggal Lahir</label>
                            <input type="date" class="form-control form-control-modern" id="tanggal_lahir" name="tanggal_lahir" required max="{{ date('Y-m-d') }}">
                        </div>
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-modern" id="submitBtn">
                                <i class="fas fa-search me-2"></i>Cek Status Kelulusan
                            </button>
                            <div class="loading-spinner" id="loadingSpinner"></div>
                        </div>
                    </form>
                </div>

                {{-- ==============================
                     HASIL KELULUSAN (BLOK BARU YANG DIPERBAIKI)
                =============================== --}}
                
                {{-- === Jika Lulus === --}}
                @if (session('status_lulus'))
                    @php $siswa = session('status_lulus'); @endphp
                    <div class="result-card p-5 mt-4 text-center wow fadeInUp">
                        <div class="success-card p-4 mb-4">
                            <i class="fas fa-graduation-cap text-success mb-3" style="font-size: 4rem;"></i>
                            <h3 class="text-success fw-bold mb-3">SELAMAT DAN SUKSES!</h3>
                            <p class="fs-5 text-dark fw-semibold mb-3">
                                Selamat {{ $siswa->nama }}, Anda dinyatakan <strong>LULUS</strong>.
                            </p>
                            <p class="text-secondary mb-4">
                                <i class="fas fa-quote-left me-2 text-primary"></i>
                                Semoga sukses dalam menempuh pendidikan berikutnya dan menjadi alumni yang membanggakan!
                            </p>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-4">
                                {{-- Asumsi ada kolom 'file_skl' di tabel siswa --}}
                                @if($siswa->file_skl)
                                <a href="{{ asset('storage/' . $siswa->file_skl) }}" 
                                class="btn btn-success px-4 py-2 rounded-pill me-md-2" target="_blank">
                                    <i class="fas fa-download me-2"></i>Unduh SKL
                                </a>
                                @endif
                                <a href="{{ url('/cek-kelulusan') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                                    <i class="fas fa-redo me-2"></i>Cek Lagi
                                </a>
                            </div>
                        </div>
                    </div>
                
                {{-- === Jika Tidak Lulus === --}}
                @elseif (session('status_gagal'))
                    @php $siswa = session('status_gagal'); @endphp
                    <div class="result-card p-5 mt-4 text-center wow fadeInUp">
                        <div class="warning-card p-4 mb-4 border border-warning rounded-4 bg-light">
                            <i class="fas fa-exclamation-circle text-warning mb-3" style="font-size: 4rem;"></i>
                            <h3 class="text-warning fw-bold mb-3">MOHON MAAF</h3>
                            <p class="fs-5 text-dark fw-semibold mb-3">
                                Mohon maaf {{ $siswa->nama }}, Anda dinyatakan <strong>TIDAK LULUS</strong>.
                            </p>
                            <p class="text-secondary mb-4">
                                <i class="fas fa-info-circle me-2 text-warning"></i>
                                Tetap semangat! Jangan menyerah, masih banyak kesempatan untuk memperbaiki hasil.
                            </p>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-3">
                                <a href="{{ url('/cek-kelulusan') }}" class="btn btn-outline-warning rounded-pill px-4 py-2">
                                    <i class="fas fa-redo me-2"></i>Cek Lagi
                                </a>
                            </div>
                        </div>
                    </div>

                {{-- === Jika Data Tidak Ditemukan (NISN/Tgl Lahir Salah) === --}}
                @elseif (session('error'))
                    <div class="result-card p-5 mt-4 text-center wow fadeInUp">
                        <div class="error-card p-4 mb-4 border border-danger rounded-4 bg-light">
                            <i class="fas fa-times-circle text-danger mb-3" style="font-size: 4rem;"></i>
                            <h3 class="text-danger fw-bold mb-3">Data Tidak Ditemukan</h3>
                            <p class="fs-5 text-dark fw-semibold mb-3">{!! session('error') !!}</p>
                            <p class="text-secondary mb-4">
                                <i class="fas fa-info-circle me-2 text-danger"></i>
                                Pastikan NISN dan tanggal lahir yang Anda masukkan sudah benar.
                            </p>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-3">
                                <a href="{{ url('/cek-kelulusan') }}" class="btn btn-outline-danger rounded-pill px-4 py-2">
                                    <i class="fas fa-redo me-2"></i>Coba Lagi
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- === AKHIR BLOK HASIL === --}}


                <!-- Additional Info -->
                <div class="text-center mt-5 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="p-4 bg-light rounded-3">
                                <i class="fas fa-clock text-primary mb-3 fs-2"></i>
                                <h6 class="fw-bold">Waktu Pengumuman</h6>
                                <p class="text-muted small mb-0">Hasil kelulusan dapat diakses 24 jam</p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="p-4 bg-light rounded-3">
                                <i class="fas fa-headset text-primary mb-3 fs-2"></i>
                                <h6 class="fw-bold">Bantuan</h6>
                                <p class="text-muted small mb-0">Hubungi admin jika mengalami kendala</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('graduationForm');
    const submitBtn = document.getElementById('submitBtn');
    const loadingSpinner = document.getElementById('loadingSpinner');
    
    form.addEventListener('submit', function(e) {
        const nisn = document.getElementById('nisn').value;
        const tanggalLahir = document.getElementById('tanggal_lahir').value;
        
        // Hapus alert lama jika ada
        const oldAlert = form.querySelector('.alert');
        if(oldAlert) {
            oldAlert.remove();
        }

        // Validasi JS Sederhana
        if (!/^\d{10}$/.test(nisn)) {
            e.preventDefault();
            showAlert('error', 'NISN harus terdiri dari 10 digit angka');
            return;
        }
        if (!tanggalLahir) {
            e.preventDefault();
            showAlert('error', 'Tanggal lahir harus diisi');
            return;
        }

        // Tampilkan loading
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
        // loadingSpinner.style.display = 'block'; // Spinner di tombol lebih baik
    });
    
    // Fungsi untuk menampilkan alert di dalam kartu form
    function showAlert(type, message) {
        const alertClass = type === 'error' ? 'alert-danger' : 'alert-success';
        const icon = type === 'error' ? 'exclamation-triangle' : 'check-circle';
        const alertHtml = `
            <div class="alert ${alertClass} d-flex align-items-center mb-4" role="alert">
                <i class="fas fa-${icon} me-3 fs-4"></i>
                <div class="fw-semibold">${message}</div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`;
        
        // Sisipkan alert di atas form
        form.insertAdjacentHTML('beforebegin', alertHtml);
    }

    // Paksa 10 digit angka untuk NISN
    document.getElementById('nisn').addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '').slice(0, 10);
    });
});
</script>
@endpush