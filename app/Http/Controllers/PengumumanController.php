<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;

class PengumumanController extends Controller
{
    /**
     * Tampilkan daftar pengumuman dengan kategori unik
     */
    public function index()
    {
        $pengumumans = Pengumuman::latest()->paginate(6);  
        $categories = Pengumuman::select('kategori')->distinct()->pluck('kategori');

        return view('frontend.pengumuman', compact('pengumumans', 'categories'));
    }

    /**
     * Tampilkan pengumuman yang dipublikasikan dengan search dan paginasi
     */
    public function pengumuman(Request $request)
    {
        $query = Pengumuman::where('is_published', true)
                            ->whereDate('published_at', '<=', now());

        // Filter pencarian (title & content)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $pengumumans = $query->orderBy('published_at', 'desc')
                              ->paginate(6)
                              ->withQueryString();

        return view('pengumuman', compact('pengumumans'));
    }

    /**
     * Halaman download pengumuman
     */
    public function download(Request $request)
    {
        return view('download');
    }
}
