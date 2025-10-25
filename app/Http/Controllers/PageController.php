<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Nanti Anda akan panggil Model Anda di sini
// use App\Models\Pengumuman; 
// use App\Models\Dokumen;

class PageController extends Controller
{
    public function pengumuman(Request $request)
    {
        // Ganti bagian ini untuk mengambil data asli dari database
        // $query = Pengumuman::query();

        // // Logika untuk search
        // if ($request->has('search')) {
        //     $query->where('title', 'like', '%' . $request->search . '%');
        // }

        // $data = $query->orderBy('date', 'desc')->paginate(9);

        // return view('pengumuman', ['pengumuman' => $data]);
        
        // Untuk saat ini, kita return view-nya saja
        return view('pengumuman');
    }

    public function download(Request $request)
    {
        // Ganti bagian ini untuk mengambil data asli dari database
        // $query = Dokumen::query();

        // // Logika untuk search
        // if ($request->has('search')) {
        //     $query->where('title', 'like', '%' . $request->search . '%');
        // }

        // $data = $query->orderBy('created_at', 'desc')->paginate(10);

        // return view('download', ['dokumen' => $data]);
        
        // Untuk saat ini, kita return view-nya saja
        return view('download');
    }
}