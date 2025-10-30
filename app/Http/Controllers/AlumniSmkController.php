<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;

class AlumniSmkController extends Controller
{
    /**
     * Menampilkan halaman tracer study alumni dengan filter pencarian dan statistik.
     * * (Method ini SUDAH BENAR karena tidak menerima ID dari URL)
     */
    public function tracer_study(Request $request)
    {
        $alumni = Alumni::when($request->has('search'), function ($query) use ($request) {
            $search = $request->get('search');
            $query->where(function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%")
                      ->orWhere('jurusan', 'like', "%{$search}%");
            });
        })->paginate(25);

        // Statistik kehadiran alumni
        $hadir = Alumni::where('status', 'Hadir')->count();
        $tidak_hadir = Alumni::where('status', 'Tidak Hadir')->count();
        $belum_mengisi = Alumni::whereNull('status')->count();

        return view('alumni.tracer_study', compact('alumni', 'hadir', 'tidak_hadir', 'belum_mengisi'));
    }

    /**
     * Menampilkan form edit status kehadiran alumni.
     *
     * === DIPERBAIKI ===
     */
    public function status_kehadiran(Alumni $alumni) // <-- 1. Ubah ($id) -> (Alumni $alumni)
    {
        // 2. HAPUS BARIS INI:
        // $alumni = Alumni::findOrFail($id);
        
        // $alumni sudah otomatis didapat dari URL hash
        return view('alumni.edit_status', compact('alumni'));
    }

    /**
     * Memperbarui status kehadiran alumni.
     *
     * === DIPERBAIKI ===
     */
    public function update_status(Request $request, Alumni $alumni) // <-- 3. Ubah ($id) -> (Alumni $alumni)
    {
        // 4. HAPUS BARIS INI:
        // $alumni = Alumni::findOrFail($id);
        
        // $alumni sudah otomatis didapat dari URL hash
        $alumni->nama = $request->nama;
        $alumni->nisn = $request->nisn;
        $alumni->jurusan = $request->jurusan;
        $alumni->status = $request->status;

        // ... (Logika lain biarkan saja) ...
        /*
        $alumni->tempat_lahir = $request->tempat_lahir;
        ...
        */

        $alumni->save();

        return redirect()->route('alumni')->with('success', 'Status berhasil diubah');
    }

    /**
     * Memperbarui NISN alumni.
     *
     * === DIPERBAIKI ===
     */
    public function updateNisn(Request $request, Alumni $alumni) // <-- 5. Ubah ($id) -> (Alumni $alumni)
    {
        // 6. HAPUS BARIS INI:
        // $alumni = Alumni::findOrFail($id);
        
        // $alumni sudah otomatis didapat dari URL hash
        $alumni->nisn = $request->nisn;
        $alumni->save();

        return redirect()->route('alumni')->with('success', 'NISN berhasil diubah');
    }
}
