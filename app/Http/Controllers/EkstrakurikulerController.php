<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;

class EkstrakurikulerController extends Controller
{
    public function ekstrakurikuler()
    {
        $ekstrakurikulers = Ekstrakurikuler::all();
        return view('ekstrakurikuler', compact('ekstrakurikulers'));
    }
}