@extends('master')

@section('title', 'Identitas')

@section('content')

{{-- Header --}}
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

{{-- Konten Identitas --}}
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="section-title bg-white text-primary px-3">Identitas Sekolah</h5>
            <h2 class="mb-5 fw-bold text-dark">SMK Nurul Jadid</h2>
        </div>

        @foreach ($identi as $b)
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="table-responsive wow fadeInUp" data-wow-delay="0.2s">
                    <table class="table table-bordered table-striped align-middle">
                        <tbody>
                            <tr>
                                <th class="bg-light w-25">Nama Sekolah</th>
                                <td class="py-3">
                                    <strong class="text-primary fs-5 d-block mb-1">
                                        {{ $b->nama }}
                                        <span class="badge bg-info text-dark ms-1">SMKNJ</span>
                                    </strong>
                                    <small class="text-secondary fst-italic">
                                        Nama resmi lembaga pendidikan
                                    </small>
                                </td>
                            </tr>

                            <tr><th class="bg-light">Tahun Berdiri</th>        <td>{{ $b->tahun_berdiri }}</td></tr>
                            <tr><th class="bg-light">Tahun Beroperasi</th>     <td>{{ $b->tahun_beroperasi }}</td></tr>
                            <tr><th class="bg-light">NSM</th>                  <td>{{ $b->nsm }}</td></tr>
                            <tr><th class="bg-light">NPSN</th>                 <td>{{ $b->npsn }}</td></tr>
                            <tr><th class="bg-light">NPWP</th>                 <td>{{ $b->npwp }}</td></tr>
                            <tr><th class="bg-light">Status Akreditasi</th>    <td>{{ $b->status_akreditasi }}</td></tr>
                            <tr><th class="bg-light">Yayasan Penyelenggara</th><td>{{ $b->yayasan_penyelenggara }}</td></tr>
                            <tr><th class="bg-light">Nomor Telepon</th>        <td>{{ $b->nomer_telepon }}</td></tr>
                            <tr><th class="bg-light">Email</th>                <td>{{ $b->email }}</td></tr>
                            <tr><th class="bg-light">Website</th>              <td>{{ $b->website }}</td></tr>
                            <tr><th class="bg-light">Alamat</th>               <td>{{ $b->alamat }}</td></tr>
                            <tr><th class="bg-light">Desa</th>                 <td>{{ $b->desa }}</td></tr>
                            <tr><th class="bg-light">Kecamatan</th>            <td>{{ $b->kecamatan }}</td></tr>
                            <tr><th class="bg-light">Kota</th>                 <td>{{ $b->kota }}</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
