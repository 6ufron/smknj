<?php

namespace App\Http\Controllers;

use App\Models\Gafoto;
use App\Models\Gavideo;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function foto()
    {
        $foto = Gafoto::all();
        return view('galeri-foto', compact('foto'));
    }
    public function video()
    {
        $video = Gavideo::all();
        return view('galeri-video', compact('video'));
    }
}
