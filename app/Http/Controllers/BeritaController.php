<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Kode ini sudah benar (menampilkan daftar).
     */
    public function index() {
        $berita = Berita::latest()->paginate(6);
        return view('daftar-berita', compact('berita'));
    }
    
    /**
     * Menampilkan halaman detail untuk satu berita.
     *
     * === INI BAGIAN YANG DIPERBAIKI ===
     */
    public function detail_berita(Berita $berita) // <-- 1. Ubah parameter dari ($id) menjadi (Berita $berita)
    {
        // 2. HAPUS BARIS INI:
        // $berita = Berita::findOrFail($id);
        
        // Penjelasan:
        // Laravel sekarang OTOMATIS mengambil data $berita dari hash.
        // Ini bisa terjadi karena:
        // A) Route di web.php adalah 'detail-berita/{berita}'
        // B) Parameter method ini adalah 'Berita $berita'
        // C) Model 'Berita' memiliki fungsi 'resolveRouteBinding'

        // 3. Langsung tampilkan view. Variabel $berita sudah berisi data yang benar.
        // dd($berita); // Anda bisa uncomment ini untuk cek datanya
        return view('detail-berita', compact('berita'));
    }
}
