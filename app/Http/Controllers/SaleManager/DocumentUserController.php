<?php

namespace App\Http\Controllers\SaleManager;

use App\Http\Controllers\Controller;

class DocumentUserController extends Controller
{
    public function index()
    {
        return view('sale_manager.document_portal');
    }
}