<?php

namespace App\Http\Controllers\SaleManager;

use App\Http\Controllers\Controller;

use App\Models\MediaVideos;

use Illuminate\Http\Request;

class MediaVideoUserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = MediaVideos::orderBy('created_at', 'desc');
        if ($search) {
            $query->where('name', 'like', '%'. $search. '%');
        }
        $Videos = $query->paginate(12);
        return view('sale_manager.media_videos', compact('Videos','search'));
    }
}