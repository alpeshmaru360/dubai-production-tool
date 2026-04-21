<?php

namespace App\Http\Controllers\SaleManager;

use App\Http\Controllers\Controller;

use App\Models\MediaDocs;

use Illuminate\Http\Request;

class MediaDocsUserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = MediaDocs::orderBy('created_at', 'desc');
        if ($search) {
            $query->where('name', 'like', '%'. $search. '%');
        }
        $Documents = $query->paginate(12);
        return view('sale_manager.media_documents', compact('Documents', 'search'));
    }
}