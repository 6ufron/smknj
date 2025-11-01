@extends('master')

@section('title', 'Dokumen Download')

@php
    use Carbon\Carbon;
@endphp

@section('content')
<div class="container-fluid bg-primary py-5 mb-5 page-header">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="display-3 text-white animated slideInDown">@yield('title')</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center bg-transparent p-0 m-0">
                        <li class="breadcrumb-item"><a class="text-white" href="{{ route('beranda') }}">Beranda</a></li>
                        <li class="breadcrumb-item text-white">Pages</li>
                        <li class="breadcrumb-item text-white active" aria-current="page">@yield('title')</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-xxl py-5">
    <div class="container">
        {{-- Header Halaman --}}
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-primary px-3 d-inline-block">Arsip</h6>
            <h1 class="mb-5">Download Dokumen</h1>
        </div>

        <div class="row wow fadeInUp" data-wow-delay="0.3s">
            <div class="col-lg-12">
                <div class="table-responsive shadow-sm rounded">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-primary text-center">
                            <tr>
                                <th style="width: 5%;" class="py-3">No</th>
                                <th class="py-3">Nama Dokumen</th>
                                <th style="width: 15%;" class="py-3">Tipe File</th>
                                <th style="width: 15%;" class="py-3">Tanggal Upload</th>
                                <th style="width: 10%;" class="py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($downloads as $index => $item)
                                <tr class="align-middle">
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>
                                        <i class="fa fa-file-alt text-primary me-2"></i>
                                        <strong>{{ $item->title }}</strong>
                                        @if($item->description)
                                            <p class="text-muted small mb-0">{{ $item->description }}</p>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $ext = pathinfo($item->file_path, PATHINFO_EXTENSION);
                                            $badgeClass = match(strtolower($ext)) {
                                                'pdf' => 'bg-danger',
                                                'doc', 'docx' => 'bg-primary',
                                                'zip', 'rar' => 'bg-secondary',
                                                default => 'bg-info',
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }} px-3 py-2">{{ strtoupper($ext) }}</span>
                                    </td>
                                    <td class="text-center">{{ Carbon::parse($item->created_at)->isoFormat('D MMMM Y') }}</td>
                                    <td class="text-center">
                                        @if ($item->file_path && file_exists(storage_path('app/public/' . $item->file_path)))
                                            <a href="{{ asset('storage/' . $item->file_path) }}" class="btn btn-primary btn-sm" target="_blank" download>
                                                <i class="fa fa-download me-1"></i>Download
                                            </a>
                                        @else
                                            <span class="text-muted small">File Hilang</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-danger">
                                        Tidak ada dokumen yang tersedia saat ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination (opsional) --}}
                @if(method_exists($downloads, 'links'))
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $downloads->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
