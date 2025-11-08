@extends('master')

@section('title', 'Edit Biodata Alumni')

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="mb-3">Edit Biodata Alumni</h1>
            <p class="text-muted">Perbarui informasi biodata alumni dengan data yang valid dan terbaru</p>
        </div>

        {{-- Notifikasi Sukses/Gagal --}}
        @if(session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    timer: 2500,
                    showConfirmButton: false
                });
            </script>
        @endif

        @if(session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: "{{ session('error') }}",
                    timer: 2500,
                    showConfirmButton: false
                });
            </script>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white py-3">
                <h4 class="mb-0"><i class="fas fa-user-edit me-2"></i>Formulir Edit Biodata</h4>
            </div>
            <div class="card-body p-4">
                {{-- Form update biodata --}}
                <form id="updateForm" action="{{ route('update_biodata', $alumni) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="alert alert-info border-0 bg-light-info">
                        <div class="d-flex">
                            <div class="me-3">
                                <i class="fas fa-info-circle text-info fs-5"></i>
                            </div>
                            <div>
                                <h6 class="alert-heading mb-1">Informasi Penting</h6>
                                Pastikan data yang Anda masukkan sudah benar sebelum menyimpan perubahan. Field dengan tanda <span class="text-danger">*</span> wajib diisi.
                            </div>
                        </div>
                    </div>

                    <div class="row g-4">
                        {{-- Informasi Pribadi --}}
                        <div class="col-12">
                            <h5 class="text-primary mb-3 pb-2 border-bottom"><i class="fas fa-user me-2"></i>Informasi Pribadi</h5>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label fw-semibold">Nama <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-user text-primary"></i>
                                    </span>
                                    <input type="text" name="nama" class="form-control border-start-0 ps-2" value="{{ $alumni->nama }}" required placeholder="Masukkan nama lengkap">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label fw-semibold">Jurusan <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-graduation-cap text-primary"></i>
                                    </span>
                                    <input type="text" name="jurusan" class="form-control border-start-0 ps-2" value="{{ $alumni->jurusan }}" required placeholder="Masukkan jurusan">
                                </div>
                            </div>
                        </div>

                        {{-- Data Identitas --}}
                        <div class="col-12 mt-4">
                            <h5 class="text-primary mb-3 pb-2 border-bottom"><i class="fas fa-id-card me-2"></i>Data Identitas</h5>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label fw-semibold">NIK (Nomor Induk) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-id-card text-primary"></i>
                                    </span>
                                    <input type="text" name="nomor_induk" class="form-control border-start-0 ps-2" value="{{ $alumni->nomor_induk }}" required placeholder="Masukkan NIK">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label fw-semibold">Orang Tua <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-users text-primary"></i>
                                    </span>
                                    <input type="text" name="orang_tua" class="form-control border-start-0 ps-2" value="{{ $alumni->orang_tua }}" required placeholder="Masukkan nama orang tua">
                                </div>
                            </div>
                        </div>

                        {{-- Status & Informasi Lainnya --}}
                        <div class="col-12 mt-4">
                            <h5 class="text-primary mb-3 pb-2 border-bottom"><i class="fas fa-info-circle me-2"></i>Status & Informasi Lainnya</h5>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label fw-semibold">Status Kehadiran <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-calendar-check text-primary"></i>
                                    </span>
                                    <select name="status" class="form-select border-start-0 ps-2" required>
                                        <option value="Hadir" {{ $alumni->status === 'Hadir' ? 'selected' : '' }}>Hadir</option>
                                        <option value="Tidak Hadir" {{ $alumni->status === 'Tidak Hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- NISN (tidak bisa diedit) --}}
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label fw-semibold">NISN</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-fingerprint text-primary"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0 ps-2 bg-light" value="{{ $alumni->nisn }}" readonly>
                                </div>
                                <small class="form-text text-muted mt-1">
                                    <i class="fas fa-lock me-1"></i>NISN tidak dapat diubah
                                </small>
                            </div>
                        </div> --}}
                    </div>

                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('alumni') }}" class="btn btn-outline-secondary px-4">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>
                                <button type="button" class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#nisnModal">
                                    <i class="fas fa-save me-2"></i>Update Biodata
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Konfirmasi NISN --}}
<div class="modal fade" id="nisnModal" tabindex="-1" aria-labelledby="nisnModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-shield-alt me-2"></i>Konfirmasi NISN
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-3">
                    <i class="fas fa-lock text-primary fs-1 mb-3"></i>
                    <h6 class="fw-semibold">Verifikasi Keamanan</h6>
                    <p class="text-muted mb-0">Untuk keamanan, masukkan NISN Anda untuk mengonfirmasi perubahan data</p>
                </div>
                <form id="nisnForm">
                    <div class="mb-3">
                        <label for="inputNisn" class="form-label fw-semibold">NISN</label>
                        <input type="text" class="form-control" id="inputNisn" required placeholder="Masukkan NISN Anda">
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-outline-secondary px-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-check me-1"></i>Konfirmasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Script Validasi NISN sebelum submit --}}
<script>
document.getElementById('nisnForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const inputNisn = document.getElementById('inputNisn').value.trim();
    const originalNisn = "{{ $alumni->nisn }}";

    if(inputNisn === originalNisn) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'NISN cocok, biodata akan diperbarui...',
            timer: 1500,
            showConfirmButton: false,
            didClose: () => {
                // Submit form utama setelah SweetAlert tutup
                document.getElementById('updateForm').submit();
            }
        });
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'NISN tidak cocok. Silakan coba lagi.',
            timer: 2500,
            showConfirmButton: false
        });
    }
});
</script>

<style>
.card {
    border: none;
    border-radius: 7px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
}

.card-header {
    border-radius: 7px 7px 0 0 !important;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.mb-0 {
    color: #fff;
}

.form-control, .form-select {
    border-radius: 1px;
    border: 1px solid #dee2e6;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
}

.input-group-text {
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    border-right: none;
}

.form-control.border-start-0 {
    border-left: none;
}

.btn {
    border-radius: 7px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #0d6efd, #0a58ca);
    border: none;
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
}

.alert {
    border-radius: 7px;
}

.border-bottom {
    border-color: #e9ecef !important;
}

.text-muted {
    color: #6c757d !important;
}

.bg-light-info {
    background-color: rgba(13, 110, 253, 0.05) !important;
}
</style>
@endsection