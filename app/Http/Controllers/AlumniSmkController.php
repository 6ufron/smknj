<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; 

class AlumniSmkController extends Controller
{
    // ==============================
    // 1️⃣ Halaman Daftar Alumni
    // ==============================
    public function tracer_study(Request $request)
    {
        $search = $request->input('search');
        $filter = $request->input('filter', 'all');

        $alumniQuery = Alumni::query();

        if ($search) {
            $alumniQuery->where(function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%")
                      ->orWhere('jurusan', 'like', "%{$search}%")
                      ->orWhere('status', 'like', "%{$search}%")
                      ->orWhere('orang_tua', 'like', "%{$search}%");
            });
        }

        if ($filter === 'hadir') {
            $alumniQuery->where('hadir', 'Ya');
        } elseif ($filter === 'tidak_hadir') {
            $alumniQuery->where('hadir', 'Tidak');
        }

        $alumni = $alumniQuery->orderBy('nama', 'asc')->paginate(10)->appends($request->all());

        $hadir = Alumni::where('hadir', 'Ya')->count();
        $tidak_hadir = Alumni::where('hadir', 'Tidak')->count();
        $belum_mengisi = Alumni::whereNull('hadir')->count();

        if ($request->ajax()) {
            return view('alumni.partials.alumni_table', compact('alumni', 'search'))->render();
        }

        return view('alumni.tracer_study', compact('alumni', 'hadir', 'tidak_hadir', 'belum_mengisi', 'search', 'filter'));
    }

    // ==============================
    // 2️⃣ Form Edit Status
    // ==============================
    public function status_kehadiran(Alumni $alumni)
    {
        return view('alumni.edit_status', compact('alumni'));
    }

    // ==============================
    // 3️⃣ Update Biodata (Admin Side)
    // ==============================
    public function update_biodata(Request $request, Alumni $alumni)
    {
        $request->validate([
            'nama'       => 'required|string|max:255',
            'orang_tua'  => 'nullable|string|max:255',
            'jurusan'    => 'required|string|max:100',
            'status'     => 'required|in:Hadir,Tidak Hadir',
        ]);

        $alumni->update([
            'nama'       => $request->nama,
            'orang_tua'  => $request->orang_tua,
            'jurusan'    => $request->jurusan,
            'status'     => $request->status,
        ]);

        return redirect()->route('alumni')
                         ->with('success', 'Biodata berhasil diperbarui');
    }

    // ==============================
    // 4️⃣ Halaman Form Daftar Alumni
    // ==============================
    public function create()
    {
        return view('alumni.form'); 
    }

    // ==============================
    // 5️⃣ Simpan Data Form Alumni
    // ==============================
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nik'             => 'nullable|string|max:20|unique:alumni,nik',
            'nama'            => 'required|string|max:255',
            'orang_tua'       => 'nullable|string|max:255',
            'nisn'            => 'required|string|max:50|unique:alumni,nisn',
            'tahun_masuk'     => 'required|integer|digits:4',
            'tahun_lulus'     => 'required|integer|digits:4|gte:tahun_masuk',
            'jurusan'         => 'required|string|max:100',
            'email'           => 'required|email|max:150|unique:alumni,email',
            'whatsapp'        => 'required|string|max:20',
            'status_saat_ini' => 'required|string|max:100',
            'instansi'        => 'nullable|string|max:255',
            'hadir'           => 'required|in:Ya,Tidak',
            'foto'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'instagram'       => 'nullable|string|max:100',
            'linkedin'        => 'nullable|string|max:100',
            'kesan_pesan'     => 'nullable|string',
        ]);

        if ($request->hasFile('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('alumni_photos', 'public');
        }

        Alumni::create([
            'nik'             => $validatedData['nik'] ?? null,
            'nama'            => $validatedData['nama'],
            'orang_tua'       => $validatedData['orang_tua'] ?? null,
            'nisn'            => $validatedData['nisn'],
            'tahun_masuk'     => $validatedData['tahun_masuk'],
            'tahun_lulus'     => $validatedData['tahun_lulus'],
            'jurusan'         => $validatedData['jurusan'],
            'email'           => $validatedData['email'],
            'whatsapp'        => $validatedData['whatsapp'],
            'status'          => $validatedData['status_saat_ini'],
            'instansi'        => $validatedData['instansi'] ?? null,
            'hadir'           => $validatedData['hadir'],
            'foto'            => $validatedData['foto'] ?? null,
            'instagram'       => $validatedData['instagram'] ?? null,
            'linkedin'        => $validatedData['linkedin'] ?? null,
            'kesan_pesan'     => $validatedData['kesan_pesan'] ?? null,
        ]);

        return redirect()->route('alumni')->with('success', 'Terima kasih! Data Anda berhasil didaftarkan.');
    }
}
