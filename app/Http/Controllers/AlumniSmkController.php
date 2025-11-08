<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
// PENTING: Tambahkan ini untuk validasi
use Illuminate\Validation\Rule; 

class AlumniSmkController extends Controller
{
    // Halaman daftar alumni
    public function tracer_study(Request $request)
    {
        // Ambil input 'search' dan 'filter' dari URL
        $search = $request->input('search');
        $filter = $request->input('filter', 'all'); // Default 'all'

        // Mulai query ke database
        $alumniQuery = Alumni::query();

        // 1. Terapkan filter PENCARIAN
        if ($search) {
            $alumniQuery->where(function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%")
                      ->orWhere('jurusan', 'like', "%{$search}%");
            });
        }

        // 2. Terapkan filter STATUS
        if ($filter === 'hadir') {
            $alumniQuery->where('status', 'Hadir');
        } elseif ($filter === 'tidak_hadir') {
            $alumniQuery->where('status', 'Tidak Hadir');
        } elseif ($filter === 'belum') {
            $alumniQuery->whereNull('status');
        }
        // Jika 'all', tidak perlu filter status

        // 3. Paginasi hasil query (10 item per halaman)
        $alumni = $alumniQuery->orderBy('nama', 'asc')->paginate(10)->appends($request->all());

        // 4. Hitung statistik (ini tetap menghitung total, tidak terpengaruh filter)
        $hadir = Alumni::where('status', 'Hadir')->count();
        $tidak_hadir = Alumni::where('status', 'Tidak Hadir')->count();
        $belum_mengisi = Alumni::whereNull('status')->count();

        // 5. Cek jika ini adalah request AJAX
        if ($request->ajax()) {
            // Jika AJAX, kirim HANYA bagian tabel-nya saja
            return view('alumni.partials.alumni_table', compact('alumni', 'search'))->render();
        }

        // Jika request biasa (load halaman pertama kali), kirim view lengkap
        return view('alumni.tracer_study', compact('alumni', 'hadir', 'tidak_hadir', 'belum_mengisi', 'search', 'filter'));
    }

    // Form edit status kehadiran
    public function status_kehadiran(Alumni $alumni)
    {
        return view('alumni.edit_status', compact('alumni'));
    }

    // Update biodata alumni (tanpa mengubah NISN)
    public function update_biodata(Request $request, Alumni $alumni)
    {
        $request->validate([
            'nama' => 'required|string',
            'jurusan' => 'required|string',
            'nomor_induk' => 'required|string',
            'orang_tua' => 'required|string',
            'status' => 'required|in:Hadir,Tidak Hadir',
        ]);

        $alumni->update([
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
            'nomor_induk' => $request->nomor_induk,
            'orang_tua' => $request->orang_tua,
            'status' => $request->status
        ]);

        return redirect()->route('change_status', $alumni)
                         ->with('success', 'Biodata berhasil diperbarui');
    }

    /**
     * Menampilkan halaman form pendaftaran alumni baru.
     */
    public function create()
    {
        // Pastikan Anda memiliki view di 'resources/views/alumni/form.blade.php'
        return view('alumni.form'); 
    }

    /**
     * Menyimpan data alumni baru dari form.
     */
    public function store(Request $request)
    {
        // 1. Validasi data (sesuai diskusi kita)
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nisn' => 'required|string|max:50|unique:alumni,nisn', // Pastikan unik
            'tahun_masuk' => 'required|integer|digits:4',
            'tahun_lulus' => 'required|integer|digits:4|gte:tahun_masuk', // Lulus >= Masuk
            'jurusan' => 'required|string|max:100',
            'email' => 'required|email|max:255|unique:alumni,email', // Pastikan unik
            'no_wa' => 'required|string|max:20',
            'status_saat_ini' => 'required|string',
            'instansi' => 'nullable|string|max:255',
            'status' => 'required|in:Hadir,Tidak Hadir', // Untuk konfirmasi acara
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Opsional foto
            'instagram' => 'nullable|string|max:100',
            'linkedin' => 'nullable|string|max:255',
            'pesan' => 'nullable|string',
        ]);

        // (Opsional) Handle upload foto jika ada
        if ($request->hasFile('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('alumni_photos', 'public');
        }
        
        // 2. Simpan ke Database
        // (Pastikan Model Alumni Anda punya $fillable untuk semua kolom ini)
        Alumni::create($validatedData);

        // 3. Arahkan kembali ke halaman daftar alumni dengan pesan sukses
        return redirect()->route('alumni')
            ->with('success', 'Terima kasih! Data Anda telah berhasil terdaftar.');
    }
}