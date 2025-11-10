<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumni as Siswa; 
use Illuminate\Support\Facades\Log;
use Carbon\Carbon; 

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
            'nisn' => 'required|numeric|digits:10', // Pastikan 10 digit
            'tanggal_lahir' => 'required|date',
        ]);

        try {
            // 1. Cari Siswa berdasarkan NISN
            // Memanggil model 'Siswa' (yang merupakan alias dari 'Alumni')
            // $siswa = Siswa::where('nisn', $validated['nisn'])->first();

            // --- MULAI DATA DUMMY ---
            // Kita buat daftar siswa bohongan di sini
            $dummySiswaData = [
                [
                    'nisn' => '1234567890',
                    'nama' => 'Budi Santoso (Dummy)',
                    'tanggal_lahir' => '2007-05-10',
                    'status_lulus' => true, // Siswa ini LULUS
                    'file_skl' => 'dummy/skl-lulus.pdf' // Path bohongan untuk tes tombol download
                ],
                [
                    'nisn' => '0987654321',
                    'nama' => 'Ani Lestari (Dummy)',
                    'tanggal_lahir' => '2007-08-15',
                    'status_lulus' => false, // Siswa ini TIDAK LULUS
                    'file_skl' => null
                ],
            ];
            
            // Ubah array asosiatif menjadi objek (agar ->nisn berfungsi)
            $dummySiswa = array_map(function($data) {
                return (object) $data;
            }, $dummySiswaData);

            $siswa = collect($dummySiswa)->where('nisn', $validated['nisn'])->first();

            // 2. Cek apakah siswa ditemukan
            if (!$dummySiswa) {
                Log::warning('Data siswa tidak ditemukan (NISN)', $validated);
                // Kirim 'error' jika NISN tidak ada
                return back()->with('error', 'Data siswa dengan NISN tersebut tidak ditemukan.');
            }

            // 3. Normalisasi & Cek Tanggal Lahir
            // Gunakan Carbon untuk perbandingan yang andal
            $tanggalInput = Carbon::parse($validated['tanggal_lahir'])->format('Y-m-d');
            
            // Asumsi nama kolom di DB adalah 'tanggal_lahir'
            $tanggalDb = Carbon::parse($siswa->tanggal_lahir)->format('Y-m-d'); 

            if ($tanggalInput !== $tanggalDb) {
                Log::warning('NISN ditemukan, tapi tanggal lahir tidak cocok', $validated);
                // Kirim 'error' jika tanggal lahir salah
                return back()->with('error', 'NISN ditemukan, tetapi Tanggal Lahir tidak cocok.');
            }

            // 4. Cek Status Kelulusan
            // Asumsi 'status_lulus' adalah nama kolom di DB Anda
            if ($siswa->status_lulus) { 
                // Kirim 'status_lulus' (berisi objek siswa) jika LULUS
                return back()->with('status_lulus', $siswa);
            } else {
                // Kirim 'status_gagal' (berisi objek siswa) jika TIDAK LULUS
                return back()->with('status_gagal', $siswa);
            }

        } catch (\Exception $e) {
            Log::error('Kesalahan saat proses cek kelulusan', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan pada server. Silakan coba lagi nanti.');
        }
    }
}