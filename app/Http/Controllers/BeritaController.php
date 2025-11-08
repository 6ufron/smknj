<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Tampilkan daftar berita terbaru dengan pagination.
     */
    public function index()
    {
        $berita = Berita::latest()->paginate(6);
        return view('daftar-berita', compact('berita'));
    }

    /**
     * Tampilkan detail satu berita beserta berita lain (10 berita terbaru, kecuali yang dibuka).
     */
    public function detail_berita(Berita $berita)
    {
        $beritaLainnya = Berita::where('id', '!=', $berita->id)
                               ->latest()
                               ->take(10)
                               ->get();

        return view('detail-berita', compact('berita', 'beritaLainnya'));
    }
}
