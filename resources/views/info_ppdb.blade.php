@extends('master')

@section('title', 'Info PPDB SMK Nurul Jadid')

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h1 class="mb-5">Timeline PPDB Tahun Pelajaran 2024/2025</h1>
        </div>
        <div class="container-fluid py-5">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="horizontal-timeline">
                        <ul class="list-inline items">
                            <li class="list-inline-item items-list">
                                <div class="px-4">
                                    <div class="event-date badge bg-info">20 Januari - 8 Juli 2024</div>
                                    <h5 class="pt-2">Pendaftaran Online</h5>
                                    <p class="text-muted">Pendaftaran dapat dilakukan secara online dengan mengunjungi link berikut <a href="https://psb.nuruljadid.net" target="_blank" class="btn btn-sm btn-success">PPDB SMKNJ</a></p>
                                </div>
                            </li>
                            <li class="list-inline-item items-list">
                                <div class="px-4">
                                    <div class="event-date badge bg-success">Jum'at, 5 Juli 2024</div>
                                    <h5 class="pt-2">Penyerahan Santri (Herregistrasi)</h5>
                                    <p class="text-muted">Santri yang telah berhasil mendaftar secara online kemudian diantar ke PP Nurul Jadid sesuai tanggal yang tertera.</p>
                                </div>
                            </li>
                            <li class="list-inline-item items-list">
                                <div class="px-4">
                                    <div class="event-date badge bg-danger">10 - 13 Juli 2024</div>
                                    <h5 class="pt-2">Orientasi Santri Baru (OSABAR)</h5>
                                    <p class="text-muted">Selama 3 hari santri baru akan diajak mengenal tentang pesantren.</p>
                                </div>
                            </li>
                            <li class="list-inline-item items-list">
                                <div class="px-4">
                                    <div class="event-date badge bg-warning">14 - 16 Juli 2024</div>
                                    <h5 class="pt-2">Tes Furudhul Ainiyah (FA)</h5>
                                    <p class="text-muted">Santri akan diuji tentang pengetahuan Furudhul Ainiyah dari hasil tersebut akan dibentuk kelompok belajar intensif.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-xxl bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-auto col-lg-5">
                <img src="{{ asset('img/psb.jpeg') }}" alt="" class="img-fluid" style="border-radius: 25px">
            </div>
            <div class="col-8 col-lg-7">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-3">Persyaratan Pendaftaran:</h1>
                </div>
                <p class="ms-5 px-5">Terdapat beberapa berkas yang perlu dipersiapkan sebagai persyaratan pendaftaran santri baru di PP Nurul Jadid diantaranya:</p>
                <ul class="list-unstyled ms-5 px-5 mb-3">
                    <li class="mb-3"><i class="fas fa-check-circle text-success"></i> Fotokopi KTP Orang Tua / Wali Sebanyak 3 Lembar</li>
                    <li class="mb-3"><i class="fas fa-check-circle text-success"></i> Fotokopi Kartu Keluarga Sebanyak 3 Lembar</li>
                    <li class="mb-3"><i class="fas fa-check-circle text-success"></i> Fotokopi Akta Kelahiran Sebanyak 3 Lembar</li>
                    <li class="mb-3"><i class="fas fa-check-circle text-success"></i> Fotokopi SKHU / STL / Ijazah Terligalisir Sebanyak 3 Lembar</li>
                    <li class="mb-3"><i class="fas fa-check-circle text-success"></i> Surat Keterangan Sehat dari Fasilitas Kesehatan</li>
                </ul>
                <p class="ms-5 px-5 mt-5">Belum memiliki akun santri baru, silahkan klik tombol dibawah ini untuk mendaftarkan diri.</p>
                <div class="ms-5 px-5">
                    <a href="https://psb.nuruljadid.net" class="btn btn-success px-3" target="_blank">Buat Akun</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
