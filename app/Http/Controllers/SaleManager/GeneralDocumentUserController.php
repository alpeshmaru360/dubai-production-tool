<?php

namespace App\Http\Controllers\SaleManager;

use App\Http\Controllers\Controller;

use App\Models\GeneralDocuments;
use Illuminate\Http\Request;

class GeneralDocumentUserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = GeneralDocuments::orderBy('created_at', 'desc');

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $documents = $query->paginate(12);
        return view('sale_manager.genral_documents', compact('documents', 'search'));
    }
}