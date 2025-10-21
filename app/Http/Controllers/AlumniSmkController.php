<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;

class AlumniSmkController extends Controller
{

    public function tracer_study(Request $request)
    {
        $alumni = Alumni::when($request->has('search'), function ($query) use ($request) {
            $search = $request->get('search');
            $query->where(function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('jurusan', 'like', "%{$search}%");
            });
        })->paginate(25);

        // Menghitung jumlah alumni yang hadir
        $hadir = Alumni::where('status_hadir', 'Hadir')->count();

        // Menghitung jumlah alumni yang tidak hadir
        $tidak_hadir = Alumni::where('status_hadir', 'Tidak Hadir')->count();
        
        $belum_mengisi = Alumni::whereNull('status_hadir')->count();
        
        
        return view('alumni.tracer_study', compact('alumni', 'hadir', 'tidak_hadir', 'belum_mengisi'));
    }


    public function status_kehadiran($id)
    {
        $alumni = Alumni::findOrFail($id);
        return view('alumni.edit_status', compact('alumni'));
    }

    public function update_status(Request $request, $id)
    {
        // Cari data alumni berdasarkan ID
        $alumni = Alumni::findOrFail($id);

        // Validasi IPK
        $ipk = $request->ipk;
        if ($ipk > 4) {
            return redirect()->back()->with('error', 'Nilai IPK maksimal adalah 4');
        } elseif ($ipk < 1) {
            return redirect()->back()->with('error', 'Nilai IPK minimum adalah 1');
        }

        // Update data alumni dengan input dari form
        $alumni->nama = $request->nama;
        $alumni->nisn = $request->nisn;
        $alumni->tempat_lahir = $request->tempat_lahir;
        $alumni->tanggal_lahir = $request->tanggal_lahir;
        $alumni->alamat = $request->alamat;
        $alumni->orang_tua = $request->orang_tua;
        $alumni->nomor_induk = $request->nomor_induk;
        $alumni->jurusan = $request->jurusan;
        $alumni->status_hadir = $request->status_hadir;
        $alumni->ipk = $ipk;

        // Update data tambahan berdasarkan status kerja
        if ($request->status_kerja === 'Kuliah') {
            $alumni->nama_kampus = $request->nama_kampus;
            $alumni->prodi = $request->prodi;
            $alumni->tahun_masuk = $request->tahun_masuk;
            $alumni->tahun_lulus = $request->tahun_lulus;
            if ($alumni->status_kerja === 'Bekerja') {
                $alumni->nama_perusahaan = null;
                $alumni->jabatan = null;
                $alumni->nomer_perusahaan = null;
                $alumni->alamat_kantor = null;
            }
        } elseif ($request->status_kerja === 'Bekerja') {
            $alumni->nama_perusahaan = $request->nama_perusahaan;
            $alumni->jabatan = $request->jabatan;
            $alumni->alamat_kantor = $request->alamat_kantor;
            $alumni->nomer_perusahaan = $request->nomer_perusahaan;
            if ($alumni->status_kerja === 'Kuliah') {
                $alumni->nama_kampus = null;
                $alumni->prodi = null;
                $alumni->tahun_masuk = null;
                $alumni->tahun_lulus = null;
            }
        }

        // Simpan perubahan
        $alumni->save();

        // Redirect ke halaman daftar alumni dengan pesan sukses
        return redirect()->route('alumni')->with('success', 'Status berhasil diubah');
    }


    public function updateNisn(Request $request, $id)
    {
        // Cari data alumni berdasarkan ID
        $alumni = Alumni::findOrFail($id);

        // Update data alumni dengan input dari form
        $alumni->nisn = $request->nisn;

        // Simpan perubahan
        $alumni->save();

        // Redirect ke halaman daftar alumni dengan pesan sukses
        return redirect()->route('alumni')->with('success', 'NISN berhasil diubah');
    }
}
