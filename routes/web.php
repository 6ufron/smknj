<?php

use App\Http\Controllers\AlumniSmkController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ChatbotController;
use App\Admin\Controllers\JurusanController;
use App\Http\Controllers\KelulusanController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfilSMKNJController;
use App\Http\Controllers\ProgramSMKNJController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [BerandaController::class, 'index'])->name('beranda');

Route::get('profil-smknj', [ProfilSMKNJController::class, 'index'])->name('smknj.index');
Route::get('visi-misi-smknj', [ProfilSMKNJController::class, 'vimisi'])->name('smknj.vimisi');
Route::get('identitas-smknj', [ProfilSMKNJController::class, 'identitas'])->name('smknj.identitas');

Route::get('program-keahlian', [ProgramSMKNJController::class, 'keahlian'])->name('program.keahlian');
Route::get('/admin/konsentrasikeahlian', [JurusanController::class, 'index'])->name('admin.konsentrasi.index');

// alumni
Route::get('alumni-smknj', [AlumniSmkController::class, 'tracer_study'])->name('alumni');

Route::get('alumni-smknj/change_status/{id}', [AlumniSmkController::class, 'status_kehadiran'])->name('change_status');
Route::put('alumni-smknj/update_status/{id}', [AlumniSmkController::class, 'update_status'])->name('update_status');
Route::put('alumni-smknj/updateNisn/{id}', [AlumniSmkController::class, 'updateNisn'])->name('updateNisn');

Route::get('galeri-foto', [GaleriController::class, 'foto'])->name('galeri.foto');
Route::get('galeri-video', [GaleriController::class, 'video'])->name('galeri.video');

Route::get('daftar-berita', [BeritaController::class, 'index'])->name('berita-sekolah');
Route::get('detail-berita/{id}', [BeritaController::class, 'detail_berita'])->name('detail-berita');

Route::get('/pengumuman', [PageController::class, 'pengumuman'])->name('pengumuman');
Route::get('/download', [PageController::class, 'download'])->name('download');

// Rute untuk menampilkan halaman form cek kelulusan
Route::get('/cek-kelulusan', [KelulusanController::class, 'showCheckForm'])->name('cek-kelulusan'); 

// Rute untuk memproses data form (saat tombol 'Cek Kelulusan' diklik)
Route::post('/hasil-kelulusan', [KelulusanController::class, 'processCheck'])->name('hasil-kelulusan');

Route::post('/ai-chat', [ChatbotController::class, 'handleChat'])->name('ai.chat');

Route::get('kontak', function () {
    return view('kontak');
})->name('kontak_kami');

Route::get('ppdb-smknj', function(){
    return view('info_ppdb');
})->name('ppdb');