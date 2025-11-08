@extends('master')

@section('title', 'Form Pendaftaran Alumni')

@push('styles')
<style>
    /* Style tambahan untuk form */
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
</style>
@endpush

@section('content')
<!-- Header -->
<div class="container-fluid bg-primary py-5 mb-5 page-header">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="display-3 text-white animated slideInDown">
                    Formulir Alumni
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-white" href="{{ route('beranda') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a class="text-white" href="{{ route('tracer_study') }}">Alumni</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Pendaftaran</li>
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
                    <h6 class="section-title bg-white text-center text-primary px-3">Tracer Study</h6>
                    <h1 class="mb-3">Form Pendaftaran Alumni</h1>
                    <p class="mb-5 text-muted">Silakan isi data Anda dengan benar untuk keperluan pendataan alumni dan konfirmasi kehadiran acara.</p>
                </div>

                <div class="card p-4 p-md-5 form-card wow fadeInUp" data-wow-delay="0.3s">
                    <div class="card-body">
                        
                        {{-- Arahkan ke rute 'alumni.store' --}}
                        <form action="{{ route('alumni.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- === Data Diri === -->
                            <h5 class="form-section-header">Data Diri</h5>
                            
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="nisn" class="form-label">NISN <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nisn') is-invalid @enderror" id="nisn" name="nisn" value="{{ old('nisn') }}" required>
                                @error('nisn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- === Data Kelulusan === -->
                            <h5 class="form-section-header">Data Kelulusan</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="tahun_masuk" class="form-label">Tahun Masuk <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('tahun_masuk') is-invalid @enderror" id="tahun_masuk" name="tahun_masuk" value="{{ old('tahun_masuk') }}" placeholder="Contoh: 2018" required>
                                    @error('tahun_masuk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tahun_lulus" class="form-label">Tahun Lulus <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('tahun_lulus') is-invalid @enderror" id="tahun_lulus" name="tahun_lulus" value="{{ old('tahun_lulus') }}" placeholder="Contoh: 2021" required>
                                    @error('tahun_lulus')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="jurusan" class="form-label">Jurusan <span class="text-danger">*</span></label>
                                <select class="form-select @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan" required>
                                    <option value="" disabled selected>-- Pilih Jurusan --</option>
                                    <option value="RPL" {{ old('jurusan') == 'RPL' ? 'selected' : '' }}>Rekayasa Perangkat Lunak (RPL)</option>
                                    <option value="TKJ" {{ old('jurusan') == 'TKJ' ? 'selected' : '' }}>Teknik Komputer dan Jaringan (TKJ)</option>
                                    <option value="Multimedia" {{ old('jurusan') == 'Multimedia' ? 'selected' : '' }}>Multimedia (MM)</option>
                                    {{-- Tambahkan jurusan lain sesuai kebutuhan --}}
                                </select>
                                @error('jurusan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- === Data Kontak === -->
                            <h5 class="form-section-header">Data Kontak</h5>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Aktif <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="no_wa" class="form-label">No. WhatsApp <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control @error('no_wa') is-invalid @enderror" id="no_wa" name="no_wa" value="{{ old('no_wa') }}" placeholder="Contoh: 08123456789" required>
                                @error('no_wa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- === Status Saat Ini === -->
                            <h5 class="form-section-header">Status Saat Ini</h5>
                            <div class="mb-3">
                                <label for="status_saat_ini" class="form-label">Status Saat Ini <span class="text-danger">*</span></label>
                                <select class="form-select @error('status_saat_ini') is-invalid @enderror" id="status_saat_ini" name="status_saat_ini" required>
                                    <option value="" disabled selected>-- Pilih Status --</option>
                                    <option value="Bekerja" {{ old('status_saat_ini') == 'Bekerja' ? 'selected' : '' }}>Bekerja</option>
                                    <option value="Kuliah" {{ old('status_saat_ini') == 'Kuliah' ? 'selected' : '' }}>Kuliah</option>
                                    <option value="Wirausaha" {{ old('status_saat_ini') == 'Wirausaha' ? 'selected' : '' }}>Wirausaha</option>
                                    <option value="Bekerja sambil Kuliah" {{ old('status_saat_ini') == 'Bekerja sambil Kuliah' ? 'selected' : '' }}>Bekerja sambil Kuliah</option>
                                    <option value="Mencari Kerja" {{ old('status_saat_ini') == 'Mencari Kerja' ? 'selected' : '' }}>Mencari Kerja</option>
                                </select>
                                @error('status_saat_ini')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="instansi" class="form-label">Nama Perusahaan / Universitas / Usaha</label>
                                <input type="text" class="form-control" id="instansi" name="instansi" value="{{ old('instansi') }}">
                            </div>

                            <!-- === Konfirmasi Acara === -->
                            <h5 class="form-section-header">Konfirmasi Kehadiran Acara</h5>
                            <div class="mb-3 @error('status') is-invalid @enderror">
                                <label class="form-label d-block">Apakah Anda akan hadir di acara [Nama Acara]? <span class="text-danger">*</span></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="hadir" value="Hadir" {{ old('status') == 'Hadir' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="hadir">Ya, saya akan Hadir</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="tidak_hadir" value="Tidak Hadir" {{ old('status') == 'Tidak Hadir' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="tidak_hadir">Tidak, saya tidak bisa hadir</label>
                                </div>
                                @error('status')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- === Data Opsional === -->
                            <h5 class="form-section-header">Data Tambahan (Opsional)</h5>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto Profil</label>
                                <input class="form-control @error('foto') is-invalid @enderror" type="file" id="foto" name="foto">
                                @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="instagram" class="form-label"><i class="fab fa-instagram me-2"></i>Instagram</label>
                                    <input type="text" class="form-control" id="instagram" name="instagram" value="{{ old('instagram') }}" placeholder="Contoh: @username">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="linkedin" class="form-label"><i class="fab fa-linkedin me-2"></i>LinkedIn</label>
                                    <input type="text" class="form-control" id="linkedin" name="linkedin" value="{{ old('linkedin') }}" placeholder="Contoh: /in/username">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="pesan" class="form-label">Kesan & Pesan</label>
                                <textarea class="form-control" id="pesan" name="pesan" rows="4">{{ old('pesan') }}</textarea>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary btn-lg" style="border-radius: 50px; padding: 12px 30px;">
                                    <i class="fas fa-paper-plane me-2"></i> Kirim Pendaftaran
                                </button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection