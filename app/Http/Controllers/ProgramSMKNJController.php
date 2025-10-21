<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class ProgramSMKNJController extends Controller
{
    public function keahlian(){
        $keahlian = Jurusan::all();

        return view('program-keahlian', compact('keahlian'));
    }
}
