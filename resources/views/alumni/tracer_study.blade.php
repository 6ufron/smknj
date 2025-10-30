@extends('master')

@section('title', 'Daftar Alumni')

@section('content')
<div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">@yield('title')</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="{{ route('beranda') }}">Beranda</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">@yield('title')</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h3 class="section-title bg-white text-center text-primary px-3 mb-5">Daftar Alumni SMK Nurul Jadid</h3>
        </div>
        <div class="row mb-3">
            <div class="col-12 mb-2">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Siswa Akan Hadir</h5>
                        <p class="card-text">Jumlah : {{ $hadir }} Siswa</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Siswa Tidak Akan Hadir</h5>
                        <p class="card-text">Jumlah : {{ $tidak_hadir }} Siswa</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Belum Mengisi</h5>
                        <p class="card-text">Jumlah : {{ $belum_mengisi }} Siswa</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col">
                <form method="GET" action="{{ route('alumni') }}">
                    <div class="input-group mb-3">
                        <input type="text" name="search" class="form-control" placeholder="Cari sesuai nama anda..." value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </form>
            
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-borderless table-primary align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Status (Hadir/Tidak Hadir)</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($alumni as $a)
                            <tr class="table-primary">
                                <td scope="row">{{ ($alumni->currentPage() - 1) * $alumni->perPage() + $loop->iteration }}</td>
                                <td>{{ $a->nama }}</td>
                                <td>{{ $a->jurusan }}</td>
                                @if ($a->status == NULL)
                                <td>Belum Mengisi</td>
                                @else
                                <td>{{ $a->status }}</td>
                                @endif
                                <td>
                                    <a href="{{ route('change_status', $a) }}" class="btn btn-warning"><i class="fa fa-eye"></i> Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            
                <div class="d-flex justify-content-center">
                    {{ $alumni->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection