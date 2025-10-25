{{-- resources/views/cek-kelulusan.blade.php --}}

@extends('master')

@section('title', 'Cek Informasi Kelulusan - SMK Nurul Jadid')

@section('content')

    <!-- Header Halaman Start -->
    {{-- <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Informasi Kelulusan</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="/">Beranda</a></li>
                            <li class="breadcrumb-item text-white">Pages</li> {{-- Sesuai screenshot --}}
                            <li class="breadcrumb-item text-white active" aria-current="page">Informasi Kelulusan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Header Halaman End -->

    <!-- Form Cek Kelulusan Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="text-center mb-5">
                        <h6 class="section-title bg-white text-center text-primary px-3">Cek Kelulusan</h6>
                        <h1 class="mb-4">Informasi Kelulusan Siswa Kelas XII</h1>
                    </div>
                    
                    {{-- Form Aksi --}}
                    {{-- Ganti action="/hasil-kelulusan" dengan route yang akan memproses data ini --}}
                    <form action="/hasil-kelulusan" method="POST"> 
                        @csrf {{-- Penting untuk keamanan Laravel --}}
                        
                        <div class="mb-4">
                            <label for="nisn" class="form-label">NISN</label>
                            <input type="text" class="form-control form-control-lg" id="nisn" name="nisn" placeholder="Masukkan NISN Anda" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control form-control-lg" id="tanggal_lahir" name="tanggal_lahir" required>
                            <div class="form-text">Format: mm/dd/yyyy</div>
                        </div>
                        
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg py-3">Cek Kelulusan</button>
                        </div>
                    </form>
                    
                    {{-- Area untuk menampilkan hasil (opsional, bisa dibuat di halaman terpisah) --}}
                    {{-- @if (session('status'))
                        <div class="alert alert-success mt-4">
                            {{ session('status') }} 
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger mt-4">
                            {{ session('error') }}
                        </div>
                    @endif --}}

                </div>
            </div>
        </div>
    </div>
    <!-- Form Cek Kelulusan End -->
    
@endsection