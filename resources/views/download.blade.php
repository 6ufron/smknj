{{-- resources/views/download.blade.php --}}

@extends('master')

@section('title', 'Daftar Download')

@section('content')

    {{-- <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Daftar Download</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="/">Beranda</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Download</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- Data Dummy - Ganti ini dengan data dari Controller Anda --}}
    @php
        $dokumen = [
            ['id' => 1, 'title' => 'Brosur PPDB 2024/2025', 'size' => '2.5 MB', 'type' => 'PDF', 'file_url' => '/files/brosur-ppdb-2024.pdf'],
            ['id' => 2, 'title' => 'Kalender Akademik Semester Genap 2023/2024', 'size' => '800 KB', 'type' => 'PDF', 'file_url' => '/files/kalender-akademik.pdf'],
            ['id' => 3, 'title' => 'Formulir Pendaftaran Ulang', 'size' => '120 KB', 'type' => 'DOCX', 'file_url' => '/files/form-daftar-ulang.docx'],
        ];
    @endphp

    <div class="container-xxl py-5">
        <div class="container">

            <div class="row justify-content-center mb-5">
                <div class="col-lg-8">
                    <form action="/download" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control form-control-lg" placeholder="Cari dokumen..." value="{{ request('search') }}">
                            <button class="btn btn-primary px-4" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="table-responsive shadow-sm rounded">
                        <table class="table table-striped table-hover align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" class="py-3 px-4">Nama Dokumen</th>
                                    <th scope="col" class="py-3">Ukuran File</th>
                                    <th scope="col" class="py-3">Tipe</th>
                                    <th scope="col" class="py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dokumen as $doc)
                                    <tr>
                                        <td class="py-3 px-4">
                                            <i class="fa fa-file-alt text-primary me-2"></i>
                                            <strong>{{ $doc['title'] }}</strong>
                                        </td>
                                        <td class="py-3">{{ $doc['size'] }}</td>
                                        <td class="py-3">
                                            @if ($doc['type'] == 'PDF')
                                                <span class="badge bg-danger">{{ $doc['type'] }}</span>
                                            @else
                                                <span class="badge bg-info">{{ $doc['type'] }}</span>
                                            @endif
                                        </td>
                                        <td class="py-3 text-center">
                                            <a href="{{ $doc['file_url'] }}" class="btn btn-primary btn-sm" download>
                                                <i class="fa fa-download me-2"></i>Download
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">Dokumen tidak ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-center">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            {{-- Ganti ini dengan $dokumen->links() saat sudah terhubung ke Controller --}}
                            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a></li>
                            <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>
    @endsection