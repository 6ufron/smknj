<?php

namespace App\Http\Controllers;

use App\Models\Vimisi;
use Illuminate\Http\Request;
use App\Models\IdentiSekolah;
use App\Models\ProfilSekolah;

class ProfilSMKNJController extends Controller
{
    public function index()
    {
        $profil = ProfilSekolah::all();
        return view('profil-smknj', compact('profil'));
    }

    public function vimisi()
    {
        $vimisi = Vimisi::all();
        return view('vimisi-smknj', compact('vimisi'));
    }

    public function identitas()
    {
        $identi = IdentiSekolah::all();
        return view('identi-smknj', compact('identi'));
    }
}
