<?php

namespace App\Http\Controllers;

use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadSMKNJController extends Controller
{
    /**
     * Menampilkan halaman download dengan filter, search, dan paginasi AJAX.
     */
    public function index(Request $request)
    {
        $limit  = 6;
        $search = $request->input('search');
        $filter = $request->input('filter', 'all');

        $query = Download::query();

        // Filter pencarian
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter tipe file
        if ($filter === 'pdf') {
            $query->where('file_path', 'like', '%.pdf');
        } elseif ($filter === 'doc') {
            $query->where(function ($q) {
                $q->where('file_path', 'like', '%.doc')
                  ->orWhere('file_path', 'like', '%.docx');
            });
        } elseif ($filter === 'xls') {
            $query->where(function ($q) {
                $q->where('file_path', 'like', '%.xls')
                  ->orWhere('file_path', 'like', '%.xlsx');
            });
        } elseif ($filter === 'zip') {
            $query->where(function ($q) {
                $q->where('file_path', 'like', '%.zip')
                  ->orWhere('file_path', 'like', '%.rar')
                  ->orWhere('file_path', 'like', '%.7z');
            });
        }

        $downloads = $query->orderBy('created_at', 'desc')
                           ->paginate($limit)
                           ->appends($request->all());

        if ($request->ajax()) {
            return view('download_partials', compact('downloads', 'search', 'filter'))->render();
        }

        return view('download', compact('downloads', 'search', 'filter'));
    }

    /**
     * Menangani download file dan menghitungnya.
     */
    public function download(Request $request, $id)
    {
        $document = Download::findOrFail($id);

        $filePath = storage_path('app/public/' . $document->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        $fileName = $document->title . '.' . pathinfo($document->file_path, PATHINFO_EXTENSION);

        return response()->download($filePath, $fileName);
    }
}
