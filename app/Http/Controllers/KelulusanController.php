<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Support\Facades\Log;

class KelulusanController extends Controller
{
    /**
     * Menampilkan halaman form cek kelulusan
     */
    public function showCheckForm()
    {
        return view('cek-kelulusan');
    }

    /**
     * Memproses data form cek kelulusan
     */
    public function processCheck(Request $request)
    {
        // 1. Validasi input
        $validated = $request->validate([
            'nisn' => 'required|numeric',
            'tanggal_lahir' => 'required|date',
        ]);

        try {
            // 2. Cari data siswa di database berdasarkan NISN dan Tanggal Lahir
            // $siswa = Siswa::where('nisn', $validated['nisn'])
            //               ->where('tanggal_lahir', $validated['tanggal_lahir'])
            //               ->first();

            // --- Logika Dummy ---
            $siswa = null;
            if ($validated['nisn'] == '1234567890' && $validated['tanggal_lahir'] == '2007-05-10') {
                $siswa = (object)['nama' => 'Budi Santoso', 'status_lulus' => true];
            } elseif ($validated['nisn'] == '0987654321' && $validated['tanggal_lahir'] == '2007-08-15') {
                $siswa = (object)['nama' => 'Ani Lestari', 'status_lulus' => false];
            }

            // 3. Cek hasil
            if ($siswa) {
                if ($siswa->status_lulus) {
                    // Redirect ke halaman hasil LULUS (buat halaman ini nanti)
                    // return redirect()->route('hasil-kelulusan.sukses')->with('siswa', $siswa); 

                    // Atau tampilkan pesan sukses di halaman ini saja
                    return back()->with('status', "Selamat {$siswa->nama}, Anda dinyatakan **LULUS**.");
                } else {
                    // Redirect ke halaman hasil TIDAK LULUS (buat halaman ini nanti)
                    // return redirect()->route('hasil-kelulusan.gagal')->with('siswa', $siswa);

                    // Atau tampilkan pesan gagal di halaman ini saja
                    return back()->with('error', "Mohon maaf {$siswa->nama}, Anda dinyatakan **TIDAK LULUS**.");
                }
            } else {
                Log::warning('Data siswa tidak ditemukan', [
                    'nisn' => $validated['nisn'], 
                    'tanggal_lahir' => $validated['tanggal_lahir']
                ]);
                return back()->with('error', 'Data siswa dengan NISN dan Tanggal Lahir tersebut tidak ditemukan.');
            }

        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan saat memproses cek kelulusan', [
                'error' => $e->getMessage()
            ]);
            return back()->with('error', 'Terjadi kesalahan pada server. Silakan coba lagi nanti.');
        }
    }
}
