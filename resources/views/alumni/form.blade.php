@extends('master')

@section('title', 'Form Pendaftaran Alumni')

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
                        <li class="breadcrumb-item"><a class="text-white" href="{{ route('alumni') }}">Alumni</a></li>
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
                        
                        <form action="{{ route('alumni.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- === Data Diri === -->
                            <h5 class="form-section-header">Data Diri</h5>

                            <div class="mb-3">
                                <label for="nik" class="form-label">NIK <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-id-card field-icon"></i></span>
                                    <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ old('nik') }}" required>
                                    @error('nik')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user field-icon"></i></span>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="nisn" class="form-label">NISN <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-fingerprint field-icon"></i></span>
                                    <input type="text" class="form-control @error('nisn') is-invalid @enderror" id="nisn" name="nisn" value="{{ old('nisn') }}" required>
                                    @error('nisn')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- === Tambahan: Nama Orang Tua === -->
                            <div class="mb-3">
                                <label for="orang_tua" class="form-label">Nama Orang Tua <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-users field-icon"></i></span>
                                    <input type="text" class="form-control @error('orang_tua') is-invalid @enderror" id="orang_tua" name="orang_tua" value="{{ old('orang_tua') }}" required>
                                    @error('orang_tua')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- === Data Kelulusan === -->
                            <h5 class="form-section-header">Data Kelulusan</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="tahun_masuk" class="form-label">Tahun Masuk <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-calendar-plus field-icon"></i></span>
                                        <input type="number" class="form-control @error('tahun_masuk') is-invalid @enderror" id="tahun_masuk" name="tahun_masuk" value="{{ old('tahun_masuk') }}" placeholder="Contoh: 2018" required>
                                        @error('tahun_masuk')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tahun_lulus" class="form-label">Tahun Lulus <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-calendar-check field-icon"></i></span>
                                        <input type="number" class="form-control @error('tahun_lulus') is-invalid @enderror" id="tahun_lulus" name="tahun_lulus" value="{{ old('tahun_lulus') }}" placeholder="Contoh: 2021" required>
                                        @error('tahun_lulus')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="jurusan" class="form-label">Jurusan <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-graduation-cap field-icon"></i></span>
                                    <select class="form-select @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan" required>
                                        <option value="" disabled selected>-- Pilih Jurusan --</option>
                                        <option value="Rekayasa Perangkat Lunak" {{ old('jurusan') == 'Rekayasa Perangkat Lunak' ? 'selected' : '' }}>Rekayasa Perangkat Lunak (RPL)</option>
                                        <option value="Teknik Komputer dan Jaringan" {{ old('jurusan') == 'Teknik Komputer dan Jaringan' ? 'selected' : '' }}>Teknik Komputer dan Jaringan (TKJ)</option>
                                        <option value="Desain Komunikasi Visual" {{ old('jurusan') == 'Desain Komunikasi Visual' ? 'selected' : '' }}>Desain Komunikasi Visual (DKV)</option>
                                        <option value="Teknik Pembangkit Tenaga Listrik" {{ old('jurusan') == 'Teknik Pembangkit Tenaga Listrik' ? 'selected' : '' }}>Teknik Pembangkit Tenaga Listrik (TPTL)</option>
                                        <option value="Desain Produksi Busana" {{ old('jurusan') == 'Desain Produksi Busana' ? 'selected' : '' }}>Desain Produksi Busana (DPB)</option>
                                        <option value="Agribisnis Pengolahan Hasil Perikanan" {{ old('jurusan') == 'Agribisnis Pengolahan Hasil Perikanan' ? 'selected' : '' }}>Agribisnis Pengolahan Hasil Perikanan (APHPi)</option>
                                    </select>
                                    @error('jurusan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- === Data Kontak === -->
                            <h5 class="form-section-header">Data Kontak</h5>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Aktif <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope field-icon"></i></span>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="whatsapp" class="form-label">No. WhatsApp <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fab fa-whatsapp field-icon"></i></span>
                                    <input type="tel" class="form-control @error('whatsapp') is-invalid @enderror"
                                        id="whatsapp" name="whatsapp" value="{{ old('whatsapp') }}" placeholder="Contoh: 08123456789" required>
                                    @error('whatsapp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- === Status Saat Ini === -->
                            <h5 class="form-section-header">Status Saat Ini</h5>
                            <div class="mb-3">
                                <label for="status_saat_ini" class="form-label">Status Saat Ini <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user-tie field-icon"></i></span>
                                    <select class="form-select @error('status_saat_ini') is-invalid @enderror" id="status_saat_ini" name="status_saat_ini" required>
                                        <option value="" disabled selected>-- Pilih Status --</option>
                                        <optgroup label="Pendidikan">
                                            <option value="Kuliah" {{ old('status_saat_ini') == 'Kuliah' ? 'selected' : '' }}>Kuliah</option>
                                            <option value="Kuliah sambil Bekerja" {{ old('status_saat_ini') == 'Kuliah sambil Bekerja' ? 'selected' : '' }}>Kuliah sambil Bekerja</option>
                                            <option value="Melanjutkan Studi" {{ old('status_saat_ini') == 'Melanjutkan Studi' ? 'selected' : '' }}>Melanjutkan Studi</option>
                                        </optgroup>

                                        <optgroup label="Pekerjaan">
                                            <option value="Bekerja" {{ old('status_saat_ini') == 'Bekerja' ? 'selected' : '' }}>Bekerja</option>
                                            <option value="Bertani" {{ old('status_saat_ini') == 'Bertani' ? 'selected' : '' }}>Bertani</option>
                                            <option value="Bekerja sambil Kuliah" {{ old('status_saat_ini') == 'Bekerja sambil Kuliah' ? 'selected' : '' }}>Bekerja sambil Kuliah</option>
                                            <option value="Wirausaha" {{ old('status_saat_ini') == 'Wirausaha' ? 'selected' : '' }}>Wirausaha</option>
                                            <option value="Pegawai Negeri Sipil (PNS)" {{ old('status_saat_ini') == 'Pegawai Negeri Sipil (PNS)' ? 'selected' : '' }}>Pegawai Negeri Sipil (PNS)</option>
                                            <option value="TNI/Polri" {{ old('status_saat_ini') == 'TNI/Polri' ? 'selected' : '' }}>TNI/Polri</option>
                                            <option value="Karyawan Swasta" {{ old('status_saat_ini') == 'Karyawan Swasta' ? 'selected' : '' }}>Karyawan Swasta</option>
                                            <option value="Karyawan BUMN/BUMD" {{ old('status_saat_ini') == 'Karyawan BUMN/BUMD' ? 'selected' : '' }}>Karyawan BUMN/BUMD</option>
                                            <option value="Freelancer" {{ old('status_saat_ini') == 'Freelancer' ? 'selected' : '' }}>Freelancer</option>
                                        </optgroup>

                                        <optgroup label="Belum/Tidak Bekerja">
                                            <option value="Mencari Kerja" {{ old('status_saat_ini') == 'Mencari Kerja' ? 'selected' : '' }}>Mencari Kerja</option>
                                            <option value="Belum Bekerja" {{ old('status_saat_ini') == 'Belum Bekerja' ? 'selected' : '' }}>Belum Bekerja</option>
                                            <option value="Tidak Bekerja" {{ old('status_saat_ini') == 'Tidak Bekerja' ? 'selected' : '' }}>Tidak Bekerja</option>
                                        </optgroup>

                                        <optgroup label="Lainnya">
                                            <option value="Ibu Rumah Tangga" {{ old('status_saat_ini') == 'Ibu Rumah Tangga' ? 'selected' : '' }}>Ibu Rumah Tangga</option>
                                            <option value="Menjadi Relawan" {{ old('status_saat_ini') == 'Menjadi Relawan' ? 'selected' : '' }}>Menjadi Relawan</option>
                                            <option value="Bekerja di Luar Negeri" {{ old('status_saat_ini') == 'Bekerja di Luar Negeri' ? 'selected' : '' }}>Bekerja di Luar Negeri</option>
                                            <option value="Lainnya" {{ old('status_saat_ini') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </optgroup>
                                    </select>
                                    @error('status_saat_ini')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="instansi" class="form-label">Nama Perusahaan / Universitas / Usaha</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-building field-icon"></i></span>
                                    <input type="text" class="form-control @error('instansi') is-invalid @enderror" id="instansi" name="instansi" value="{{ old('instansi') }}">
                                    @error('instansi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- === Konfirmasi Kehadiran Acara === -->
                            <h5 class="form-section-header">Konfirmasi Kehadiran</h5>
                            <div class="mb-3 @error('hadir') is-invalid @enderror">
                                <label class="form-label d-block">Apakah Anda berkenan mau hadir? <span class="text-danger">*</span></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="hadir" id="hadir_ya" value="Ya" {{ old('hadir') == 'Ya' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="hadir_ya">Ya, saya akan Hadir</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="hadir" id="hadir_tidak" value="Tidak" {{ old('hadir') == 'Tidak' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="hadir_tidak">Tidak, saya tidak bisa hadir</label>
                                </div>
                                @error('hadir')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- === Data Opsional === -->
                            <h5 class="form-section-header">Data Tambahan (Opsional)</h5>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto Profil</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-camera field-icon"></i></span>
                                    <input class="form-control @error('foto') is-invalid @enderror" type="file" id="foto" name="foto">
                                    @error('foto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="instagram" class="form-label">Instagram</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fab fa-instagram field-icon"></i></span>
                                        <input type="text" class="form-control @error('instagram') is-invalid @enderror" id="instagram" name="instagram" value="{{ old('instagram') }}" placeholder="Contoh: @username">
                                        @error('instagram')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="linkedin" class="form-label">LinkedIn</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fab fa-linkedin field-icon"></i></span>
                                        <input type="text" class="form-control @error('linkedin') is-invalid @enderror" id="linkedin" name="linkedin" value="{{ old('linkedin') }}" placeholder="Contoh: /in/username">
                                        @error('linkedin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="kesan_pesan" class="form-label">Kesan & Pesan</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-edit field-icon"></i></span>
                                    <textarea class="form-control @error('kesan_pesan') is-invalid @enderror" id="kesan_pesan" name="kesan_pesan" rows="4">{{ old('kesan_pesan') }}</textarea>
                                    @error('kesan_pesan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
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