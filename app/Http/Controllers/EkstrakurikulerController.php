<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler; 
use App\Models\EkstraKategori; 
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class EkstrakurikulerController extends Controller
{
    /**
     * Tampilkan halaman ekstrakurikuler dengan paginasi per kategori.
     */
    public function index(Request $request)
    {
        $limitPerKategori = 6;

        // Ambil semua kategori yang memiliki program
        $kategoriEkstra = EkstraKategori::whereHas('programEkstra')
                            ->with('programEkstra')
                            ->orderBy('nama_bidang', 'asc')
                            ->get();

        foreach ($kategoriEkstra as $kategori) {
            $allPrograms = $kategori->programEkstra;
            $pageName = 'kategori_' . $kategori->id . '_page';
            $currentPage = $request->input($pageName, 1);

            // Slice koleksi untuk halaman saat ini
            $currentPageItems = $allPrograms->slice(($currentPage - 1) * $limitPerKategori, $limitPerKategori);

            // Paginator manual
            $kategori->programEkstra = new LengthAwarePaginator(
                $currentPageItems,
                $allPrograms->count(),
                $limitPerKategori,
                $currentPage,
                [
                    'path' => $request->url(),
                    'pageName' => $pageName,
                ]
            );
        }

        // Ekstra tanpa kategori
        $allTanpaKategori = Ekstrakurikuler::whereNull('ekstra_kategori_id')
                                ->orderBy('nama', 'asc')
                                ->get();
        $pageNameTanpaKategori = 'tanpa_kategori_page';
        $currentPageTanpaKategori = $request->input($pageNameTanpaKategori, 1);
        $itemsTanpaKategori = $allTanpaKategori->slice(($currentPageTanpaKategori - 1) * $limitPerKategori, $limitPerKategori);

        $ekstraTanpaKategori = new LengthAwarePaginator(
            $itemsTanpaKategori,
            $allTanpaKategori->count(),
            $limitPerKategori,
            $currentPageTanpaKategori,
            [
                'path' => $request->url(),
                'pageName' => $pageNameTanpaKategori,
            ]
        );

        return view('ekstrakurikuler', [
            'kategoriEkstra' => $kategoriEkstra,
            'ekstraTanpaKategori' => $ekstraTanpaKategori
        ]);
    }
}
