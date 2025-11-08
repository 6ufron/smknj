<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Support\Facades\Log;

class KelulusanController extends Controller
{
    /**
     * Tampilkan halaman form cek kelulusan
     */
    public function showCheckForm()
    {
        return view('cek-kelulusan');
    }

    /**
     * Proses cek kelulusan siswa berdasarkan NISN dan tanggal lahir
     */
    public function processCheck(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nisn' => 'required|numeric',
            'tanggal_lahir' => 'required|date',
        ]);

        try {
            // --- Logika dummy / bisa diganti query ke database ---
            $siswa = null;
            if ($validated['nisn'] == '1234567890' && $validated['tanggal_lahir'] == '2007-05-10') {
                $siswa = (object)['nama' => 'Budi Santoso', 'status_lulus' => true];
            } elseif ($validated['nisn'] == '0987654321' && $validated['tanggal_lahir'] == '2007-08-15') {
                $siswa = (object)['nama' => 'Ani Lestari', 'status_lulus' => false];
            }

            if ($siswa) {
                // Tampilkan hasil langsung di halaman yang sama
                return $siswa->status_lulus
                    ? back()->with('status', "Selamat {$siswa->nama}, Anda dinyatakan **LULUS**.")
                    : back()->with('error', "Mohon maaf {$siswa->nama}, Anda dinyatakan **TIDAK LULUS**.");
            }

            // Data tidak ditemukan
            Log::warning('Data siswa tidak ditemukan', $validated);
            return back()->with('error', 'Data siswa dengan NISN dan Tanggal Lahir tersebut tidak ditemukan.');

        } catch (\Exception $e) {
            // Tangani error server
            Log::error('Kesalahan saat proses cek kelulusan', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan pada server. Silakan coba lagi nanti.');
        }
    }
}
