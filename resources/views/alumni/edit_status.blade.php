@extends('master')

@section('title', 'Edit Biodata Alumni')

@push('styles')
<style>
    .form-section-header {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--primary);
        border-bottom: 2px solid var(--primary);
        padding-bottom: 0.5rem;
        margin-bottom: 1.5rem;
        margin-top: 2rem;
    }
    .form-card {
        border-radius: 7px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        border: none;
    }
    .form-check-input:checked {
        background-color: var(--primary);
        border-color: var(--primary);
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.2rem rgba(var(--primary-rgb), 0.25);
    }
    .input-group-text {
        background-color: #f8f9fa;
        border: 1px solid #e1e5ee;
        border-radius: 8px;
    }
    .field-icon {
        color: var(--primary);
        font-size: 1.1rem;
    }
    .info-box {
        background-color: #e8f4fd;
        border-left: 4px solid var(--info);
        padding: 1rem;
        border-radius: 0 8px 8px 0;
        margin-bottom: 1.5rem;
    }
    .info-box i {
        color: var(--info);
        margin-right: 10px;
    }
</style>
@endpush

@section('content')
<!-- Header -->
<div class="container-fluid bg-primary py-5 mb-5 page-header">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="display-3 text-white animated slideInDown">
                    Edit Biodata Alumni
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-white" href="{{ route('beranda') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a class="text-white" href="{{ route('alumni') }}">Alumni</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Edit Biodata</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Content -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">

                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title bg-white text-center text-primary px-3">Update Data</h6>
                    <h1 class="mb-3">Edit Biodata Alumni</h1>
                    <p class="mb-5 text-muted">Perbarui informasi biodata alumni dengan data yang valid dan terbaru.</p>
                </div>

                <div class="card p-4 p-md-5 form-card wow fadeInUp" data-wow-delay="0.3s">
                    <div class="card-body">
                        
                        {{-- Notifikasi Sukses/Gagal --}}
                        @if(session('success'))
                            <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: "{{ session('success') }}",
                                    timer: 1500,
                                    showConfirmButton: false,
                                    didClose: () => {
                                        window.location.href = "{{ route('alumni') }}";
                                    }
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

                        <div class="info-box">
                            <i class="fas fa-info-circle"></i>
                            <span>Pastikan data yang Anda masukkan sudah benar sebelum menyimpan perubahan.</span>
                        </div>

                        <form id="updateForm" action="{{ route('update_biodata', $alumni) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- === Informasi Pribadi === -->
                            <h5 class="form-section-header">Informasi Pribadi</h5>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user field-icon"></i></span>
                                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $alumni->nama) }}" required>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">NIK <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-id-card field-icon"></i></span>
                                        <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik', $alumni->nik) }}" required>
                                        @error('nik')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Orang Tua</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-users field-icon"></i></span>
                                        <input type="text" name="orang_tua" class="form-control @error('orang_tua') is-invalid @enderror" value="{{ old('orang_tua', $alumni->orang_tua) }}">
                                        @error('orang_tua')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jurusan <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-graduation-cap field-icon"></i></span>
                                        <select class="form-select @error('jurusan') is-invalid @enderror" name="jurusan" required>
                                            <option value="" disabled selected>-- Pilih Jurusan --</option>
                                            <option value="Rekayasa Perangkat Lunak" {{ old('jurusan', $alumni->jurusan) == 'Rekayasa Perangkat Lunak' ? 'selected' : '' }}>Rekayasa Perangkat Lunak (RPL)</option>
                                            <option value="Teknik Komputer dan Jaringan" {{ old('jurusan', $alumni->jurusan) == 'Teknik Komputer dan Jaringan' ? 'selected' : '' }}>Teknik Komputer dan Jaringan (TKJ)</option>
                                            <option value="Desain Komunikasi Visual" {{ old('jurusan', $alumni->jurusan) == 'Desain Komunikasi Visual' ? 'selected' : '' }}>Desain Komunikasi Visual (DKV)</option>
                                            <option value="Teknik Pembangkit Tenaga Listrik" {{ old('jurusan', $alumni->jurusan) == 'Teknik Pembangkit Tenaga Listrik' ? 'selected' : '' }}>Teknik Pembangkit Tenaga Listrik (TPTL)</option>
                                            <option value="Desain Produksi Busana" {{ old('jurusan', $alumni->jurusan) == 'Desain Produksi Busana' ? 'selected' : '' }}>Desain Produksi Busana (DPB)</option>
                                            <option value="Agribisnis Pengolahan Hasil Perikanan" {{ old('jurusan', $alumni->jurusan) == 'Agribisnis Pengolahan Hasil Perikanan' ? 'selected' : '' }}>Agribisnis Pengolahan Hasil Perikanan (APHPi)</option>
                                        </select>
                                        @error('jurusan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- === Data Kelulusan === -->
                            <h5 class="form-section-header">Data Kelulusan</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tahun Masuk</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-calendar-plus field-icon"></i></span>
                                        <input type="text" name="tahun_masuk" class="form-control @error('tahun_masuk') is-invalid @enderror" value="{{ old('tahun_masuk', $alumni->tahun_masuk) }}">
                                        @error('tahun_masuk')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tahun Lulus</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-calendar-check field-icon"></i></span>
                                        <input type="text" name="tahun_lulus" class="form-control @error('tahun_lulus') is-invalid @enderror" value="{{ old('tahun_lulus', $alumni->tahun_lulus) }}">
                                        @error('tahun_lulus')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- === Data Kontak === -->
                            <h5 class="form-section-header">Data Kontak</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email Aktif</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope field-icon"></i></span>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $alumni->email) }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">No. WhatsApp</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fab fa-whatsapp field-icon"></i></span>
                                        <input type="text" name="no_wa" class="form-control @error('no_wa') is-invalid @enderror" value="{{ old('no_wa', $alumni->no_wa) }}">
                                        @error('no_wa')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- === Status Saat Ini === -->
                            <h5 class="form-section-header">Status & Informasi Lainnya</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status Saat Ini <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user-tie field-icon"></i></span>
                                        <select class="form-select @error('status_saat_ini') is-invalid @enderror" name="status_saat_ini" required>
                                            <option value="" disabled selected>-- Pilih Status --</option>
                                            <optgroup label="Pendidikan">
                                                <option value="Kuliah" {{ old('status_saat_ini', $alumni->status_saat_ini) == 'Kuliah' ? 'selected' : '' }}>Kuliah</option>
                                                <option value="Kuliah sambil Bekerja" {{ old('status_saat_ini', $alumni->status_saat_ini) == 'Kuliah sambil Bekerja' ? 'selected' : '' }}>Kuliah sambil Bekerja</option>
                                                <option value="Melanjutkan Studi" {{ old('status_saat_ini', $alumni->status_saat_ini) == 'Melanjutkan Studi' ? 'selected' : '' }}>Melanjutkan Studi</option>
                                            </optgroup>
                                            <optgroup label="Pekerjaan">
                                                <option value="Bekerja" {{ old('status_saat_ini', $alumni->status_saat_ini) == 'Bekerja' ? 'selected' : '' }}>Bekerja</option>
                                                <option value="Bertani" {{ old('status_saat_ini', $alumni->status_saat_ini) == 'Bertani' ? 'selected' : '' }}>Bertani</option>
                                                <option value="Bekerja sambil Kuliah" {{ old('status_saat_ini', $alumni->status_saat_ini) == 'Bekerja sambil Kuliah' ? 'selected' : '' }}>Bekerja sambil Kuliah</option>
                                                <option value="Wirausaha" {{ old('status_saat_ini', $alumni->status_saat_ini) == 'Wirausaha' ? 'selected' : '' }}>Wirausaha</option>
                                                <option value="Pegawai Negeri Sipil (PNS)" {{ old('status_saat_ini', $alumni->status_saat_ini) == 'Pegawai Negeri Sipil (PNS)' ? 'selected' : '' }}>Pegawai Negeri Sipil (PNS)</option>
                                                <option value="TNI/Polri" {{ old('status_saat_ini', $alumni->status_saat_ini) == 'TNI/Polri' ? 'selected' : '' }}>TNI/Polri</option>
                                                <option value="Karyawan Swasta" {{ old('status_saat_ini', $alumni->status_saat_ini) == 'Karyawan Swasta' ? 'selected' : '' }}>Karyawan Swasta</option>
                                                <option value="Karyawan BUMN/BUMD" {{ old('status_saat_ini', $alumni->status_saat_ini) == 'Karyawan BUMN/BUMD' ? 'selected' : '' }}>Karyawan BUMN/BUMD</option>
                                                <option value="Freelancer" {{ old('status_saat_ini', $alumni->status_saat_ini) == 'Freelancer' ? 'selected' : '' }}>Freelancer</option>
                                            </optgroup>
                                            <optgroup label="Belum/Tidak Bekerja">
                                                <option value="Mencari Kerja" {{ old('status_saat_ini', $alumni->status_saat_ini) == 'Mencari Kerja' ? 'selected' : '' }}>Mencari Kerja</option>
                                                <option value="Belum Bekerja" {{ old('status_saat_ini', $alumni->status_saat_ini) == 'Belum Bekerja' ? 'selected' : '' }}>Belum Bekerja</option>
                                                <option value="Tidak Bekerja" {{ old('status_saat_ini', $alumni->status_saat_ini) == 'Tidak Bekerja' ? 'selected' : '' }}>Tidak Bekerja</option>
                                            </optgroup>
                                            <optgroup label="Lainnya">
                                                <option value="Ibu Rumah Tangga" {{ old('status_saat_ini', $alumni->status_saat_ini) == 'Ibu Rumah Tangga' ? 'selected' : '' }}>Ibu Rumah Tangga</option>
                                                <option value="Menjadi Relawan" {{ old('status_saat_ini', $alumni->status_saat_ini) == 'Menjadi Relawan' ? 'selected' : '' }}>Menjadi Relawan</option>
                                                <option value="Bekerja di Luar Negeri" {{ old('status_saat_ini', $alumni->status_saat_ini) == 'Bekerja di Luar Negeri' ? 'selected' : '' }}>Bekerja di Luar Negeri</option>
                                                <option value="Lainnya" {{ old('status_saat_ini', $alumni->status_saat_ini) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                            </optgroup>
                                        </select>
                                        @error('status_saat_ini')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Instansi / Universitas / Usaha</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-building field-icon"></i></span>
                                        <input type="text" name="instansi" class="form-control @error('instansi') is-invalid @enderror" value="{{ old('instansi', $alumni->instansi) }}">
                                        @error('instansi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status Kehadiran</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt field-icon"></i></span>
                                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                            <option value="Hadir" {{ old('status', $alumni->status) === 'Hadir' ? 'selected' : '' }}>Hadir</option>
                                            <option value="Tidak Hadir" {{ old('status', $alumni->status) === 'Tidak Hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="col-md-6 mb-3">
                                    <label class="form-label">NISN</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-fingerprint field-icon"></i></span>
                                        <input type="text" class="form-control" value="{{ $alumni->nisn }}" readonly>
                                    </div>
                                    <small class="form-text text-muted">NISN tidak dapat diubah</small>
                                </div> --}}
                            </div>

                            <!-- === Media Sosial === -->
                            <h5 class="form-section-header">Media Sosial</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Instagram</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fab fa-instagram field-icon"></i></span>
                                        <input type="text" name="instagram" class="form-control @error('instagram') is-invalid @enderror" value="{{ old('instagram', $alumni->instagram) }}">
                                        @error('instagram')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">LinkedIn</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fab fa-linkedin field-icon"></i></span>
                                        <input type="text" name="linkedin" class="form-control @error('linkedin') is-invalid @enderror" value="{{ old('linkedin', $alumni->linkedin) }}">
                                        @error('linkedin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- === Kesan & Pesan === -->
                            <h5 class="form-section-header">Kesan & Pesan</h5>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-edit field-icon"></i></span>
                                    <textarea name="pesan" class="form-control @error('pesan') is-invalid @enderror" rows="4" placeholder="Bagikan kesan dan pesan Anda...">{{ old('pesan', $alumni->pesan) }}</textarea>
                                    @error('pesan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                {{-- <a href="{{ route('alumni') }}" class="btn btn-outline-secondary me-3">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a> --}}
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nisnModal" align-item="right">
                                    <i class="fas fa-save me-2"></i>Update Biodata
                                </button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Konfirmasi NISN --}}
<div class="modal fade" id="nisnModal" tabindex="-1" aria-labelledby="nisnModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-shield-alt me-2"></i>Konfirmasi NISN</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-3">
                    <i class="fas fa-lock text-primary fs-1 mb-3"></i>
                    <h6 class="fw-semibold">Verifikasi Keamanan</h6>
                    <p class="text-muted mb-0">Masukkan NISN Anda untuk mengonfirmasi perubahan data</p>
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
@endsection