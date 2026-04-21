<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ProductDocumentController extends Controller
{
    public function index()
    {
        return view('Admin.product_documents');
    }
}