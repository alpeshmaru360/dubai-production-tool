<?php

namespace App\Http\Controllers\SaleManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product_type_docs\BoosterDocs;
use App\Models\Product_type_docs\ControlDocs;
use App\Models\Product_type_docs\NormDocs;
use App\Models\Product_type_docs\SplitCaseDocs;
use App\Models\Product_type_docs\HelixDocs;
use App\Models\Product_type_docs\PumpMotorDocs;
use App\Models\Product_type_docs\BoreoleDocs;
use App\Models\Product_type_docs\FireDocs;

class ProductTypeDocumentUserController extends Controller
{
    public function index()
    {
        return view('sale_manager.product_type_docs');
    }

    public function booster_docs(Request $request)
    {
        $search = $request->input('search');
        $query = BoosterDocs::orderBy('created_at', 'desc');
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }
        $documents = $query->paginate(12);
        return view('sale_manager.Product_type_docs.booster_docs', compact('documents', 'search'));
    }
    public function control_docs(Request $request)
    {
        $search = $request->input('search');
        $query = ControlDocs::orderBy('created_at', 'desc');

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $documents = $query->paginate(12);
        return view('sale_manager.Product_type_docs.control_docs', compact('documents', 'search'));
    }
    public function norm_docs(Request $request)
    {
        $search = $request->input('search');
        $query = NormDocs::orderBy('created_at', 'desc');
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }
        $documents = $query->paginate(12);
        return view('sale_manager.Product_type_docs.norm_docs', compact('documents', 'search'));
    }
    public function split_case_docs(Request $request)
    {
        $search = $request->input('search');
        $query = SplitCaseDocs::orderBy('created_at', 'desc');
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }
        $documents = $query->paginate(12);
        return view('sale_manager.Product_type_docs.split_case_docs', compact('documents', 'search'));
    }
    public function helix_docs(Request $request)
    {
        $search = $request->input('search');
        $query = HelixDocs::orderBy('created_at', 'desc');
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }
        $documents = $query->paginate(12);
        return view('sale_manager.Product_type_docs.helix_docs', compact('documents', 'search'));
    }
    public function pump_motor_docs(Request $request)
    {
        $search = $request->input('search');
        $query = PumpMotorDocs::orderBy('created_at', 'desc');
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }
        $documents = $query->paginate(12);
        return view('sale_manager.Product_type_docs.pump_motor_docs', compact('documents', 'search'));
    }
    public function borehole_docs(Request $request)
    {
        $search = $request->input('search');
        $query = BoreoleDocs::orderBy('created_at', 'desc');
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }
        $documents = $query->paginate(12);
        return view('sale_manager.Product_type_docs.borehole_docs', compact('documents', 'search'));
    }
    public function fire_docs(Request $request)
    {
        $search = $request->input('search');
        $query = FireDocs::orderBy('created_at', 'desc');
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }
        $documents = $query->paginate(12);
        return view('sale_manager.Product_type_docs.fire_docs', compact('documents', 'search'));
    }
}
