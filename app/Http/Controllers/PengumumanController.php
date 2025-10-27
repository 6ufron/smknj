<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman; // Panggil model Pengumuman

class PengumumanController extends Controller
{
    public function pengumuman(Request $request)
    {
        $query = Pengumuman::query()
                    ->where('is_published', true) // Hanya tampilkan yang sudah terbit
                    ->whereDate('published_at', '<=', now()); // Hanya tampilkan yang tanggal terbitnya sudah lewat

        // Logika untuk search
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%'); // Cari juga di konten
        }

        // Ambil data, urutkan terbaru, dan gunakan pagination
        $pengumumans = $query->orderBy('published_at', 'desc')->paginate(6); // Tampilkan 6 per halaman

        return view('pengumuman', ['pengumumans' => $pengumumans]); // Kirim data ke view
    }

    // ... (method download Anda) ...
    public function download(Request $request)
    {
        // ...
        return view('download');
    }
}