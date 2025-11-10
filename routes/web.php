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

// Profil SMKNJ
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
Route::get('/ekstrakurikuler', [EkstrakurikulerController::class, 'index'])
     ->name('ekstrakurikuler');
// PENTING: Jika punya route detail ekstrakurikuler, ubah dari {id} -> {ekstrakurikuler}

// Alumni
Route::prefix('alumni-smknj')->group(function () {
    // (/alumni-smknj)
    Route::get('/', [AlumniSmkController::class, 'tracer_study'])->name('alumni'); // <== DIGANTI DARI 'alumni'
    
    // (/alumni-smknj/change_status/{alumni})
    Route::get('change_status/{alumni}', [AlumniSmkController::class, 'status_kehadiran'])->name('change_status');
    
    // (/alumni-smknj/update_biodata/{alumni})
    Route::put('update_biodata/{alumni}', [AlumniSmkController::class, 'update_biodata'])->name('update_biodata');
    
    // (/alumni-smknj/daftar)
    Route::get('daftar', [AlumniSmkController::class, 'create'])->name('alumni.form');
    
    // (/alumni-smknj/store)
    Route::post('store', [AlumniSmkController::class, 'store'])->name('alumni.store');
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

// Route untuk frontend
Route::get('/download', [DownloadSMKNJController::class, 'index'])->name('download.index');
// Route::get('/dokumen/{id}', [DownloadSMKNJController::class, 'show'])->name('dokumen.show');
Route::get('/dokumen/{id}/download', [DownloadSMKNJController::class, 'download'])->name('dokumen.download');

// Route untuk API increment download count
// Route::post('/downloads/{id}/increment', [DownloadSMKNJController::class, 'incrementDownloadCount']);

// Cek Kelulusan 
Route::get('/cek-kelulusan', [KelulusanController::class, 'showCheckForm'])->name('cek-kelulusan');
Route::post('/hasil-kelulusan', [KelulusanController::class, 'processCheck'])->name('hasil-kelulusan');

// Chatbot AI 
Route::post('/ai-chat', [ChatbotController::class, 'handleChat'])->name('ai.chat');

// Kontak 
Route::view('kontak', 'kontak')->name('kontak_kami');

// PPDB 
Route::view('ppdb-smknj', 'info_ppdb')->name('ppdb');