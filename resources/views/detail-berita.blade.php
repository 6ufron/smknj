@extends('master')

@section('title', 'Detail Berita')

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-4 justify-content-center">
            <div class="col-lg-12">
                <div class="card mb-3">
                    <img src="{{ asset('storage/'.$berita->foto) }}" class="card-img-top w-50 h-50 mx-auto mt-3" alt="{{ $berita->judul }}">
                    <div class="card-body">
                        <h4 class="card-title text-center mt-3 w-75 mx-auto">{{ $berita->judul }}</h4>
                        <p class="card-text w-75 mx-auto my-5">{!! nl2br(e($berita->kalimat)) !!}</p>
                        <div class="d-flex border-top">
                            <small class="flex-fill text-center border-end mt-2 py-2"><i class="fa fa-calendar text-primary me-2"></i>{{ $berita->created_at }} WIB</small>
                            <small class="flex-fill text-center border-end  mt-2 py-2"><i class="fas fa-tag text-primary me-2"></i>{{ $berita->kategori }}</small>
                            <small class="flex-fill text-center py-2 mt-2">
                                <a href="{{ route('berita-sekolah') }}" class="text-danger"><b>Kembali</b></a>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection