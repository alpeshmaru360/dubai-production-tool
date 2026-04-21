<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class MediaDbController extends Controller
{
    public function index()
    {
        return view('Admin.media_db');
    }
}