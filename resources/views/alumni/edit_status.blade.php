@extends('master')

@section('title', 'Daftar Alumni SMKNJ')

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-4 justify-content-center">
            <div class="col">
                <h1 class="text-center mb-3">Edit Status Kehadiran</h1>

                {{-- Notifikasi Error --}}
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Jika NISN belum ada --}}
                @if ($alumni->nisn == null)
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Info</h4>
                                        <p class="card-text">
                                            Masukkan NISN terlebih dahulu agar dapat melakukan update status kehadiran. 
                                            Jika sudah memiliki NISN, klik tombol di bawah untuk memperbarui NISN Anda.
                                        </p>
                                        <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateNisnModal">Update NISN</a>
                                        <a href="https://nisn.data.kemdikbud.go.id/index.php/Cindex/caribynama/" target="_blank" class="btn btn-warning">Cari NISN</a>
                                        <a href="{{ route('alumni') }}" class="btn btn-danger">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- Form Update Status Kehadiran --}}
                    <form id="updateForm" action="{{ route('update_status', $alumni->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="nisn" value="{{ $alumni->nisn }}">

                        {{-- Data Alumni --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Nama & Jurusan</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" name="nama" class="form-control" value="{{ $alumni->nama }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="jurusan" class="form-control" value="{{ $alumni->jurusan }}" required placeholder="Jurusan">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Nomor Induk Keluarga</h4>
                                        <input type="text" name="nomor_induk" class="form-control" value="{{ $alumni->nomor_induk }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Orang Tua</h4>
                                        <input type="text" name="orang_tua" class="form-control" value="{{ $alumni->orang_tua }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Status Kehadiran --}}
                        <div class="row mt-3 justify-content-center">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Status Kehadiran</h4>
                                        <select class="form-select" name="status" id="status" required>
                                            <option value="Hadir" {{ $alumni->status === 'Hadir' ? 'selected' : '' }}>Hadir</option>
                                            <option value="Tidak Hadir" {{ $alumni->status === 'Tidak Hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                                        </select>
                                        <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#nisnModal">
                                            Update Biodata
                                        </button>
                                        <a href="{{ route('alumni') }}" class="btn btn-danger mt-3">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Modal Konfirmasi NISN --}}
<div class="modal fade" id="nisnModal" tabindex="-1" aria-labelledby="nisnModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nisnModalLabel">Konfirmasi NISN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="nisnForm">
                    <div class="mb-3">
                        <label for="inputNisn" class="form-label">Masukkan NISN</label>
                        <input type="text" class="form-control" id="inputNisn" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Update NISN --}}
<div class="modal fade" id="updateNisnModal" tabindex="-1" aria-labelledby="updateNisnModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateNisnModalLabel">Update NISN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateNisnForm" action="{{ route('updateNisn', $alumni->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label text-danger"><small>**NISN Harus Sama Dengan Data Di Kementrian Pendidikan.</small></label>
                        <input type="text" class="form-control" id="uNisn" name="nisn" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Script --}}
<script>
    // Konfirmasi NISN sebelum submit update
    document.getElementById('nisnForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const inputNisn = document.getElementById('inputNisn').value;
        const originalNisn = "{{ $alumni->nisn }}";

        if (inputNisn === originalNisn) {
            document.getElementById('updateForm').submit();
        } else {
            alert('NISN tidak cocok. Silakan coba lagi.');
        }
    });

    // Validasi Update NISN
    document.getElementById('updateNisnForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const updNisn = document.getElementById('uNisn').value;

        if (updNisn === '') {
            alert('NISN harus diisi');
        } else if (isNaN(updNisn) || !/^\d+$/.test(updNisn)) {
            alert('NISN hanya berupa angka');
        } else {
            document.getElementById('updateNisnForm').submit();
        }
    });
</script>
@endsection
