<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function prestasi()
    {
        $prestasi = Prestasi::all();
        return view('prestasi', compact('prestasi'));
    }
}