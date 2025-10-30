{{-- resources/views/cek-kelulusan.blade.php --}}

@extends('master')

@section('title', 'Informasi Kelulusan')

@section('content')
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">@yield('title')</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item">
                                <a class="text-white" href="{{ route('beranda') }}">Beranda</a>
                            </li>
                            <li class="breadcrumb-item text-white">Pages</li>
                            <li class="breadcrumb-item text-white active" aria-current="page">
                                @yield('title')
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Cek Kelulusan Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 wow fadeInUp" data-wow-delay="0.1s">

                    <div class="text-center mb-5">
                        <h6 class="section-title bg-white text-center text-primary px-3">Cek Kelulusan</h6>
                        <h1 class="mb-4">Informasi Kelulusan Siswa Kelas XII</h1>
                    </div>

                    <form action="{{ route('hasil-kelulusan') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="nisn" class="form-label">NISN</label>
                            <input type="text" class="form-control form-control-lg" 
                                   id="nisn" name="nisn" 
                                   placeholder="Masukkan NISN Anda" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control form-control-lg" 
                                   id="tanggal_lahir" name="tanggal_lahir" required>
                            <div class="form-text">Format: yyyy-mm-dd</div>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg py-3">Cek Kelulusan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Form Cek Kelulusan End -->
@endsection
