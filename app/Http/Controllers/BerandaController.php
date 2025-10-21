<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kepsek;
use App\Models\Gavideo;
use App\Models\Layanan;
use App\Models\KataAlumni;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index() {
        $layanan = Layanan::all();
        $kepsek = Kepsek::all();
        $berita = Berita::latest()->take(6)->get();
        $video = Gavideo::all();
        $katalum = KataAlumni::all();

        return view('beranda', compact(['layanan', 'kepsek', 'berita', 'katalum', 'video']));
    }
}
