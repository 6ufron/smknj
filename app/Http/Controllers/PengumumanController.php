<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;

class PengumumanController extends Controller
{
    public function pengumuman(Request $request)
    {
        $query = Pengumuman::query()
            ->where('is_published', true)
            ->whereDate('published_at', '<=', now());

        // Search title + content dengan grouped OR
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Order terbaru dan paginasi
        $pengumumans = $query
            ->orderBy('published_at', 'desc')
            ->paginate(6)
            ->withQueryString(); // agar search tetap pada tiap halaman

        return view('pengumuman', compact('pengumumans'));
    }

    public function download(Request $request)
    {
        return view('download');
    }
}
