@extends('master')

@section('title', 'Pendaftaran Peserta Didik Baru (PPDB)')

@section('content')
<div class="container-fluid bg-primary py-5 mb-5 page-header">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="display-3 text-white animated slideInDown">
                    @yield('title')
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item">
                            <a class="text-white" href="{{ route('beranda') }}">Beranda</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-white" href="#">Pages</a>
                        </li>
                        <li class="breadcrumb-item text-white active" aria-current="page">
                            @yield('title')
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-xxl py-5">
    <div class="container">
        {{-- Header Timeline --}}
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h1 class="mb-5">Timeline PPDB Tahun Pelajaran 2025/2026</h1>
        </div>

        {{-- Timeline --}}
        <div class="horizontal-timeline container-fluid py-5">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <ul class="list-inline items">
                        @php
                            $timeline = [
                                [
                                    'date' => '01 Maret - 09 Juli 2025',
                                    'title' => 'Pendaftaran Online',
                                    'badge' => 'bg-info',
                                    'desc' => 'Pendaftaran dapat dilakukan secara online dengan mengunjungi link berikut <a href="https://psb.nuruljadid.net" target="_blank" class="btn btn-sm btn-success">PPDB SMKNJ</a>'
                                ],
                                [
                                    'date' => "05 - 09 Juli 2025",
                                    'title' => 'Penyerahan Santri (Herregistrasi)',
                                    'badge' => 'bg-success',
                                    'desc' => 'Santri yang telah berhasil mendaftar secara online kemudian diantar ke PP Nurul Jadid sesuai tanggal yang tertera.'
                                ],
                                [
                                    'date' => '14 - 17 Juli 2025',
                                    'title' => 'Orientasi Santri Baru (OSABAR)',
                                    'badge' => 'bg-danger',
                                    'desc' => 'Selama 3 hari santri baru akan diajak mengenal tentang pesantren.'
                                ],
                                [
                                    'date' => '12 - 13 Juli 2025',
                                    'title' => 'Tes Furudhul Ainiyah (FA)',
                                    'badge' => 'bg-warning',
                                    'desc' => 'Santri akan diuji tentang pengetahuan Furudhul Ainiyah dari hasil tersebut akan dibentuk kelompok belajar intensif.'
                                ],
                            ];
                        @endphp

                        @foreach ($timeline as $event)
                            <li class="list-inline-item items-list px-4 mb-4">
                                <div>
                                    <div class="event-date badge {{ $event['badge'] }}">{{ $event['date'] }}</div>
                                    <h5 class="pt-2">{{ $event['title'] }}</h5>
                                    <p class="text-muted">{!! $event['desc'] !!}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Persyaratan Pendaftaran --}}
<div class="container-xxl bg-light py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5 mb-4 mb-md-0">
                <img src="{{ asset('img/psb.jpeg') }}" alt="PPDB SMK Nurul Jadid" class="img-fluid rounded-4 shadow-sm">
            </div>
            <div class="col-md-7">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-3">Persyaratan Pendaftaran</h1>
                </div>
                <p class="px-3">Berikut beberapa berkas yang perlu dipersiapkan sebagai persyaratan pendaftaran santri baru di PP Nurul Jadid:</p>
                <ul class="list-unstyled px-3 mb-4">
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Fotokopi KTP Orang Tua / Wali Sebanyak 3 Lembar</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Fotokopi Kartu Keluarga Sebanyak 3 Lembar</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Fotokopi Akta Kelahiran Sebanyak 3 Lembar</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Fotokopi SKHU / STL / Ijazah Terlegalisir Sebanyak 3 Lembar</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Surat Keterangan Sehat dari Fasilitas Kesehatan</li>
                </ul>
                <p class="px-3">Belum memiliki akun santri baru? Silahkan klik tombol dibawah ini untuk mendaftarkan diri.</p>
                <div class="px-3 text-center text-md-start">
                    <a href="https://psb.nuruljadid.net" class="btn btn-success px-4" target="_blank">Buat Akun</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
