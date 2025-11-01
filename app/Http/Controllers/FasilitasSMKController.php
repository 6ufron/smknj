<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fasilitas;

class FasilitasSMKController extends Controller
{
    public function index()
    {
        // Ambil SEMUA fasilitas untuk diproses di View
        $fasilitas = Fasilitas::orderBy('kategori', 'asc')
            ->orderBy('nama', 'asc')
            ->get();

        // Kirim data dengan nama variabel yang dibutuhkan View
        return view('fasilitas', compact('fasilitas'));
    }

    public function show($id) // Method detail Fasilitas
    {
        $item = Fasilitas::findOrFail($id);
        return view('fasilitas-detail', compact('item'));
    }
}