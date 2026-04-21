<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DocumentController extends Controller
{
    public function index()
    {
        return view('Admin.document_portal');
    }
}