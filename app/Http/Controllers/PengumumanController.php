<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;
use Carbon\Carbon; // <-- Pastikan Carbon di-import

class PengumumanController extends Controller
{
    /**
     * Tampilkan pengumuman yang dipublikasikan dengan search, filter, dan paginasi
     */
    public function pengumuman(Request $request)
    {
        $limit = 6; // 6 item per halaman
        $search = $request->input('search');
        $filter = $request->input('filter', 'all'); // Default 'all'

        $query = Pengumuman::where('is_published', true)
                           ->whereDate('published_at', '<=', now());

        // 1. Filter PENCARIAN (Title & Content)
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // 2. Filter TANGGAL
        if ($filter === 'month') {
            // Bulan ini → dari awal bulan sampai akhir bulan
            $query->whereBetween('published_at', [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
            ]);
        } elseif ($filter === 'week') {
            // 7 hari terakhir (minggu ini)
            $query->whereBetween('published_at', [
                Carbon::now()->subDays(7)->startOfDay(),
                Carbon::now()->endOfDay()
            ]);
        } elseif ($filter === 'recent') {
            // 30 hari terakhir
            $query->whereBetween('published_at', [
                Carbon::now()->subDays(60)->startOfDay(),
                Carbon::now()->endOfDay()
            ]);
        }
        // Jika 'all', tidak perlu filter tanggal

        $pengumumans = $query->orderBy('published_at', 'desc')
                             ->paginate($limit)
                             ->withQueryString(); // withQueryString() akan menyimpan filter & search saat pindah halaman

        // 5. Cek jika ini adalah request AJAX
        if ($request->ajax()) {
            // Jika AJAX, kirim HANYA bagian tabel-nya saja
            return view('pengumuman_partials', compact('pengumumans', 'search', 'filter'))->render();
        }

        // Jika request biasa (load halaman pertama kali), kirim view lengkap
        return view('pengumuman', compact('pengumumans', 'search', 'filter'));
    }

    /**
     * Tampilkan daftar pengumuman dengan kategori unik
     * (Method ini sepertinya tidak terpakai, tapi saya biarkan)
     */
    public function index()
    {
        $pengumumans = Pengumuman::latest()->paginate(6); 
        $categories = Pengumuman::select('kategori')->distinct()->pluck('kategori');
        return view('frontend.pengumuman', compact('pengumumans', 'categories'));
    }

    /**
     * Halaman download pengumuman
     * (Method ini sepertinya tidak terpakai, tapi saya biarkan)
     */
    public function download(Request $request)
    {
        return view('download');
    }
}