<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ProfilSMKNJController;
use App\Http\Controllers\ProgramSMKNJController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\AlumniSmkController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\DownloadSMKNJController;
use App\Http\Controllers\KelulusanController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\FasilitasSMKController;
use App\Http\Controllers\PrestasiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Beranda
Route::get('/', [BerandaController::class, 'index'])->name('beranda');

// Profil SMKNJ (Tidak ada parameter, aman)
Route::prefix('profil-smknj')->group(function () {
    Route::get('/', [ProfilSMKNJController::class, 'index'])->name('smknj.index');
    Route::get('visi-misi', [ProfilSMKNJController::class, 'vimisi'])->name('smknj.vimisi');
    Route::get('identitas', [ProfilSMKNJController::class, 'identitas'])->name('smknj.identitas');
});

// Fasilitas SMKNJ
Route::get('fasilitas', [FasilitasSMKController::class, 'index'])->name('fasilitas.index');
Route::get('fasilitas/{id}', [FasilitasSMKController::class, 'show'])->name('fasilitas.show');

// Program Keahlian
Route::get('program-keahlian', [ProgramSMKNJController::class, 'keahlian'])->name('program.keahlian');
// DIUBAH: dari {id} menjadi {jurusan} (sesuai nama model Jurusan.php)
Route::get('program/{jurusan}', [ProgramSMKNJController::class, 'detail'])->name('program.detail');

// Ekstrakurikuler (Jika ada detail page, harus diubah juga)
Route::get('ekstrakurikuler', [EkstrakurikulerController::class, 'ekstrakurikuler'])->name('ekstrakurikuler');
// PENTING: Jika Anda punya route detail ekstrakurikuler, ubah dari {id} -> {ekstrakurikuler}

// Alumni
Route::prefix('alumni-smknj')->group(function () {
    Route::get('/', [AlumniSmkController::class, 'tracer_study'])->name('alumni');
    // DIUBAH: dari {id} menjadi {alumni} (sesuai nama model Alumni.php)
    Route::get('change_status/{alumni}', [AlumniSmkController::class, 'status_kehadiran'])->name('change_status');
    Route::put('update_status/{alumni}', [AlumniSmkController::class, 'update_status'])->name('update_status');
    Route::put('updateNisn/{alumni}', [AlumniSmkController::class, 'updateNisn'])->name('updateNisn');
});

// Galeri (Jika ada detail page, harus diubah juga)
Route::get('galeri-foto', [GaleriController::class, 'foto'])->name('galeri.foto');
Route::get('galeri-video', [GaleriController::class, 'video'])->name('galeri.video');
Route::get('galeri-prestasi', [PrestasiController::class, 'prestasi'])->name('galeri.prestasi');
// PENTING: Jika Anda punya route detail galeri, ubah dari {id} -> {gafoto} atau {gavideo}

// Berita
Route::get('daftar-berita', [BeritaController::class, 'index'])->name('berita-sekolah');
// DIUBAH: dari {id} menjadi {berita} (sesuai nama model Berita.php)
Route::get('detail-berita/{berita}', [BeritaController::class, 'detail_berita'])->name('detail-berita');

// Pengumuman & Download
Route::get('/pengumuman', [PengumumanController::class, 'pengumuman'])->name('pengumuman');
Route::get('/download', [DownloadSMKNJController::class, 'index'])->name('download.index');
// PENTING: Jika Anda punya route detail untuk ini, ubah dari {id} -> {pengumuman} atau {download}

// Cek Kelulusan (Aman)
Route::get('/cek-kelulusan', [KelulusanController::class, 'showCheckForm'])->name('cek-kelulusan');
Route::post('/hasil-kelulusan', [KelulusanController::class, 'processCheck'])->name('hasil-kelulusan');

// Chatbot AI (Aman)
Route::post('/ai-chat', [ChatbotController::class, 'handleChat'])->name('ai.chat');

// Kontak (Aman)
Route::view('kontak', 'kontak')->name('kontak_kami');

// PPDB (Aman)
Route::view('ppdb-smknj', 'info_ppdb')->name('ppdb');