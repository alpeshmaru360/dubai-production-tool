<?php

namespace App\Http\Controllers\SaleManager;

use App\Http\Controllers\Controller;

use App\Models\MediaImages;

use Illuminate\Http\Request;

class MediaImgUserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = MediaImages::orderBy('created_at', 'desc');
        if ($search) {
            $query->where('name', 'like', '%'. $search. '%');
        }
        $Images = $query->paginate(12);
        return view('sale_manager.media_images', compact('Images','search'));
    }
}