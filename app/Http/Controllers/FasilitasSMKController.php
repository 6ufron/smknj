<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fasilitas;

class FasilitasSMKController extends Controller
{
    /**
     * Tampilkan halaman fasilitas SMK dengan paginasi.
     */
    public function index(Request $request)
    {
        $limit = 6; // Item per halaman

        // Fasilitas Utama
        $fasilitasUtama = Fasilitas::where('kategori', 'utama')
                            ->orderBy('nama', 'asc')
                            ->paginate($limit, ['*'], 'utama_page');

        // Fasilitas Pendukung
        $fasilitasPendukung = Fasilitas::where('kategori', 'pendukung')
                                ->orderBy('nama', 'asc')
                                ->paginate($limit, ['*'], 'pendukung_page');

        return view('fasilitas', compact('fasilitasUtama', 'fasilitasPendukung'));
    }

    /**
     * Tampilkan detail fasilitas.
     * Route Model Binding otomatis mendapatkan $fasilitas.
     */
    public function show(Fasilitas $fasilitas)
    {
        return view('fasilitas-detail', ['item' => $fasilitas]);
    }
}
