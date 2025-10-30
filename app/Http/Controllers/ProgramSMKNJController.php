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

    /**
     * Menampilkan halaman detail untuk satu program keahlian.
     *
     * === INI BAGIAN YANG DIPERBAIKI ===
     */
    public function detail(Jurusan $jurusan) // <-- 1. Ubah parameter dari ($id) menjadi (Jurusan $jurusan)
    {
        // 2. HAPUS BARIS INI:
        // $jurusan = Jurusan::findOrFail($id); 

        // Penjelasan:
        // Laravel sekarang OTOMATIS mengambil data $jurusan dari hash.
        // Ini bisa terjadi karena:
        // A) Route di web.php adalah 'program/{jurusan}'
        // B) Parameter method ini adalah 'Jurusan $jurusan'
        // C) Model 'Jurusan' memiliki fungsi 'resolveRouteBinding'
        
        // 3. Langsung tampilkan view. Variabel $jurusan sudah berisi data yang benar.
        return view('program-detail', compact('jurusan'));
    }
}
