<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Download;

class DownloadSMKNJController extends Controller
{
    public function index()
    {
        // $downloads = Download::orderBy('created_at', 'desc')->get();
        $downloads = Download::orderBy('created_at', 'desc')->paginate(6);
        return view('download', compact('downloads'));
    }
}