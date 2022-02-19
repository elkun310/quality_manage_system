<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        return view('admin.documents.index');
    }

    public function create()
    {
        return view('admin.documents.create');
    }
}
